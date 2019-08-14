<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/4
 * Time: 20:59
 */

namespace app\api\service;


/*
 * 订单类
 *
 * 思考：
 *  创建订单时检测库存量，但并不会预扣库存量，因为这需要队列支持
 *  未支付的订单再次支付时可能会出现库存不足的情况
 *
 * 项目采用3次检测：
 *  1：创建订单时检测库存
 *  2：支付前检测库存
 *  3：支付成功后检测库存
 */
use app\api\model\Coupons;
use app\api\model\CouponsTaken;
use app\api\model\OrderProduct;
use app\api\model\Product;
use app\api\model\ProductProp;
use app\api\model\UserAddress;
use app\api\model\Order as OrderModel;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use think\Db;
use think\Exception;


class Order
{

    protected $oProducts;
    protected $products;
    protected $uid;
    protected $addressId;
    protected $extraData;
    protected $giftData;
    protected $couponId;

    function __construct()
    {

    }

    public function place($uid,$data){
        $this->uid = $uid;
        $this->oProducts = $data['oProducts'];
        $this->addressId = $data['addressId'];
        $this->extraData = $data['extraData'];
        $this->couponId = $data['extraData']['couponId'];
        if(isset($data['giftData'])){
            $this->giftData = $data['giftData'];
        }
        $this->products = $this->getProductsByOrder($this->oProducts);
        $status = $this->getOrderStatus();
        if(!$status['pass']){
            $status['order_id'] = -1;
            return $status;
        }

        $orderSnap = $this->snapOrder($status);
        $status = self::createOrderByTrans($orderSnap);
        $status['pass'] = true;
        return $status;
    }

    // 创建订单时没有预扣除库存量，简化处理
    // 如果预扣除了库存量需要队列支持，且需要使用锁机制
    private function createOrderByTrans($snap){
        Db::startTrans();
        try{
            $orderNo = $this->makeOrderNo();
            $order = new OrderModel();
            $order->user_id = $this->uid;
            $order->order_no = $orderNo;
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['totalCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapName'];
            $order->snap_prop_val = $snap['snap_prop_val'];
            $order->snap_address = $snap['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);
            $order->coupon_price = $snap['coupon_price'];

            $extraData = $this->setExtraData();
            foreach ($extraData as $k=>$v){
                $order[$k] = $v;
            }

            $order->save();



            $orderID = intval($order->id);
            $create_time = date('Y-m-d H:i:s', time());

            if(isset($extraData['gift_type']) && $extraData['gift_type'] == 1){
                $this->saveGiftShare($orderID);
            }

            foreach ($this->oProducts as &$p){
                $p['order_id'] = $orderID;
            }
            $orderProduct = new OrderProduct;
            $orderProduct->saveAll($this->oProducts);

            // 修改优惠券使用状态
//            if($snap['coupon_price']){
//                CouponsTaken::updateStatus($this->uid,$this->couponId);
//            }

            Db::commit();
            return [
                'orderNo' => $orderNo,
                'order_id' => $orderID,
                'create_time' => $create_time
            ];
        }catch (Exception $ex){
            Db::rollback();
            throw $ex;
        }
    }

    // 礼物保存
    private function saveGiftShare($order_id){
        $giftData = $this->giftData;
        $giftData['user_id'] = $this->uid;
        $giftData['order_id'] = $order_id;
        if(!$giftData['timing_time']){
            unset($giftData['timing_time']);
        }
        $result = model('gift_share')->save($giftData);
        if(!$result){
            throw new OrderException([
                'msg' => '订单礼物保存失败'
            ]);
        }
    }

    // 解析额外的订单数据
    private function setExtraData(){
        $extraData = $this->extraData;
        $data = [];
        if(!empty($extraData['message'])){
            $data['message'] = $extraData['message'];
        }
        if(isset($extraData['gift_type']) && !empty($extraData['gift_type'])){
            $data['gift_type'] = $extraData['gift_type'];
        }
        $data['couponId'] = $extraData['couponId'];

        return $data;
    }

    public static function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
            $yCode[intval(date('Y')) - 2018] . strtoupper(dechex(date('m'))) . date(
                'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
                '%02d', rand(0, 99));
        return $orderSn;
    }

    // 预检测并生成订单快照
    private function snapOrder($status){
        $couponPrice = $this->getCouponPrice();
        // status可以单独定义一个类
        $addressData = json_encode($this->getUserAddress());
        if(empty($this->getUserAddress())){
            $addressData = '';
        }
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => $addressData,
            'coupon_price' => $couponPrice,
            'snapName' => $this->products[0]['name'],
            'snapImg' => $this->products[0]['main_img_url'][0],
            'snap_prop_val' => ''
        ];

        if(count($this->products) > 1){
            $snap['snapName'] .= '等';
        }

        if(!empty($status['pStatusArray'])){
            $statusArray = $status['pStatusArray'];
        }else{
            $statusArray = [];
        }

        for($i=0; $i < count($this->products); $i++){
            $product = $this->products[$i];
            $oProduct = $this->oProducts[$i];
            if(empty($statusArray[$i]) && !array_key_exists('prop_value',$statusArray[$i]) && !array_key_exists('prop_ids',$statusArray[$i])){
                $status = null;
            }else{
                $status = $statusArray[$i];
                $snap['snap_prop_val'] = $statusArray[0]['prop_value'];
            }

            $pStatus = $this->snapProduct($product, $oProduct['counts'], $status);
            $snap['orderPrice'] += $pStatus['totalPrice'];
            $snap['totalCount'] += $pStatus['counts'];

            array_push($snap['pStatus'], $pStatus);
        }
        return $snap;
    }

    // 单个商品订单
    private function snapProduct($product, $oCount, $status){
        $pStatus = [
            'id' => null,
            'name' => null,
            'main_img_url' => null,
            'counts' => $oCount,
            'totalPrice' => 0,
            'price' => 0,
            'prop_value' => null,
            'prop_ids' => null
        ];

        // 以服务器价格为准，生成订单
        $pStatus['totalPrice'] = $oCount * $product['price'];
        $pStatus['name'] = $product['name'];
        $pStatus['main_img_url'] = $product['main_img_url'][0];
        $pStatus['price'] = $product['price'];
        $pStatus['id'] = $product['id'];
        if($status){
            $pStatus['prop_value'] = $status['prop_value'];
            $pStatus['prop_ids'] = $status['prop_ids'];
        }

        return $pStatus;
    }

    private function getUserAddress(){
        if(!isset($this->addressId) || empty($this->addressId)){
            return [];
        }
        $data = [
            'id' => $this->addressId,
            'user_id' => $this->uid,
            'status' => 1
        ];
        $userAddress = UserAddress::where($data)
            ->find();

        if(!$userAddress){
            throw new UserException([
                'msg' => '用户收货地址不存在，下单失败',
                'errorCode' => 60001
            ]);
        }
        return $userAddress->toArray();
    }

    private function getCouponPrice(){
        if($this->couponId == 0){
            return 0;
        }
        $data = Coupons::getCouponPrice($this->uid,$this->couponId);
        if(!$data){
            new UserException([
                'msg' => '优惠券无效',
                'errorCode' => '60008'
            ]);
        }
        return $data[0];
    }

    private function getOrderStatus(){
        $status = [
            'pass'  =>  true,
            'orderPrice' => 0,
            'pStatusArray' => []
        ];

        foreach ($this->oProducts as $oProducts){
            $pStatus = $this->getProductStatus(
                $oProducts['product_id'],
                $oProducts['counts'],
                $oProducts['product_prop_ids'],
                $this->products);

            if(!$pStatus['haveStock']){
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }

    private function getProductStatus($oPID, $oCount, $oPropIds, $products){
        $pIndex = -1;
        $pStatus = [
            'id' => null,
            'haveStock' => false,
            'counts' => 0,
            'name' => '',
            'totalPrice' => 0
        ];

        for ($i=0; $i<count($products) ;$i++){
            $oPids = explode(',',$oPropIds);
            sort($oPids);
            $pids = $products[$i]['propIds'];
            $mark = $oPID == $products[$i]['id'];
            if($mark && $pids == $oPids){
                $pIndex = $i;
            }
        }

        if($pIndex == -1){
            throw new OrderException([
                'msg' => 'id为' . $oPID . '的商品不存在或者所选参数不存在，订单创建失败'
            ]);
        }else{
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['name'] = $product['name'];
            $pStatus['prop_value'] = $product['product_prop'];
            $pStatus['prop_ids'] = $oPropIds;
            $pStatus['stockId'] = $product['stockId'];
            $pStatus['counts'] = $oCount;
            $pStatus['totalPrice'] = $product['price'] * $oCount;
            if($product['stock_num'] - $oCount >= 0){
                $pStatus['haveStock'] = true;
            }
        }
        return $pStatus;
    }

    private function getProductsByOrder($oProducts){
        $oPIDs = [];
        $oPropIDs = [];
        foreach ($oProducts as $k => $item){
            array_push($oPIDs,$item['product_id']);
            $oPropIDs[$item['product_id'].'-'.$k] = $item['product_prop_ids'];
        }
        $prducts = Product::getProductOrProStock($oPIDs)
            ->visible(['id', 'name', 'price', 'market_price', 'main_img_url','product_stock'])
            ->toArray();

        $productArr = [];
        foreach ($prducts as $k => $v){
            $productArr[$v['id']] = $v;
        }
        // 获取产品，属性和库存
        $productData = $this->resolveProduct($oPropIDs,$productArr);

        return $productData;
    }

    // 解析产品，属性和库存
    private function resolveProduct($oPropIDs,$productArr){
        $productData = [];
        foreach ($oPropIDs as $k=>$v){
            $product_id = explode('-',$k)[0];
            $product = $productArr[$product_id];
            // 获取库存
            foreach ($product['product_stock'] as $sk=>$sv){
                // 判断是否有属性
                if(empty($sv['product_prop'])){
                    $product['stock_num'] = $sv['stock_num'];
                    $product['propIds'] = [""];
                    $product['stockId'] = $sv['id'];
                    unset($product['product_stock']);
                    break;
                }
                // 获取库存
                $product_propArr = explode(',',$sv['product_prop']);
                $ov = explode(',',$v);
                sort($ov);
                sort($product_propArr);
                if($ov == $product_propArr){
                    $product['stock_num'] = $sv['stock_num'];
                    $product['propIds'] = $product_propArr;
                    $product['stockId'] = $sv['id'];
                    $product['price'] = $sv['price'];
                    unset($product['product_stock']);
                    break;
                }
            }
            // 获取属性和价格
            $ProductProps = ProductProp::getProductPropByIds($v)->toArray();
            $proStr = '';
            foreach ($ProductProps as $ppk => $ppv){
                $proStr .= $ppv['prop_value'].',';
                if($ppv['img_url']){
                    $curPropImg = $ppv['img_url'];
                }

            }
            $product['product_prop'] = trim($proStr,',');
            $product['main_img_url'] = isset($curPropImg)?[$curPropImg]:$product['main_img_url'];
            $productData[] = $product;
        }
        return $productData;
    }

    public function checkOrderStock($orderID){
        // 一定要从订单商品表中直接查询
        // 不能从商品表中查询订单商品，这将导致被删除的商品无法查询出订单商品来
        $oProducts = OrderProduct::where('order_id','=',$orderID)
            ->select();
        $this->products = $this->getProductsByOrder($oProducts);
        $this->oProducts = $oProducts;
        $status = $this->getOrderStatus();
        return $status;
    }

    public function delivery($orderID, $tplJumpPage='', $expressNum=''){
        $order = OrderModel::where('id','=',$orderID)
            ->find();
        if(!$order){
            throw new OrderException();
        }
        if($order->status != OrderStatusEnum::PAID && $order->status != OrderStatusEnum::PAID_BUT_OUT_OF){
            throw new OrderException([
                'msg' => '还没付款呢，想干嘛？ 或者你已经更新过订单了，不要再刷了',
                'errorCode' => 80002,
                'code' => 403
            ]);
        }
        $order->status = OrderStatusEnum::DELIVERED;
        $order->save();
        $message = new DeliveryMessage();
        return $message->sendDeliveryMessage($order,$tplJumpPage, $expressNum);

    }
}