<?php


namespace app\api\model;


use app\lib\exception\UserException;
use think\Db;
use think\Exception;
use think\Model;

class GiftShare extends Model
{
    protected $hidden = [
        'create_time', 'timing_time', 'update_time','gift_user_id','user_id'
    ];

    public function user(){
        return $this->belongsTo('user','gift_user_id','id');
    }

    public function sendUser(){
        return $this->belongsTo('user','user_id','id');
    }


    public function order(){
        return $this->belongsTo('order','order_id','id');
    }

    public static function getGiftShare($uid,$order_id){
        $data = [
            'order_id' => $order_id,
            'user_id|gift_user_id'=>$uid
        ];
        $result = self::where($data)
            ->with(['user'=>function($query){
                $query->field('id,avatar_img,nickName');
            },'order'=>function($query){
                $query->field('id,snap_img,snap_address,snap_name,snap_prop_val,status,gift_type,total_count,total_price');
            },'sendUser'=>function($query){
                $query->field('id,avatar_img,nickName');
            }])->find();
        return $result;
    }

    private static function getTakenGiftData($order_id){
        $data = [
            'order_id' => $order_id,
        ];
        $is_taken = self::where($data)
            ->field('is_taken,user_id,order_id')
            ->with(['order'=>function($query){
                $query->field('id,status,gift_type,snap_address');
            }])
            ->find();
        return $is_taken;
    }

    public static function takenInfo($order_id){
        $takenData = self::getTakenGiftData($order_id);
        $data = [
            'is_taken' => $takenData['is_taken'],
            'user_id' => $takenData['user_id']
        ];
        $orderData = $takenData['order'];
        if($orderData){
            if($orderData['status'] != 2){
                return [
                    'msg' => '礼物不能领取'
                ];
            }
            if($orderData['gift_type'] == 0){
                return [
                    'msg' => '该礼物不能被领取'
                ];
            }
            $data['is_exist_address'] = !empty($orderData['snap_address']);
        }else{
            return [
                'msg' => '订单不存在'
            ];
        }
        return $data;
    }

    public static function takenGift($uid, $send_user_id,$order_id,$address_id){
        $data = [
            'order_id' => $order_id,
            'user_id' => $send_user_id
        ];
        Db::startTrans();
        try{
            $adressReesult = 1;
            if(!empty($address_id)){
                $adressReesult = self::updateOrder($uid, $send_user_id, $order_id,$address_id);
            }

            $result = self::where($data)->update([
                'gift_user_id' => $uid,
                'is_taken' => 1
            ]);
            // 提交事务
            Db::commit();
        } catch (Exception $ex){
            // 回滚事务
            Db::rollback();
        }
        return $result && $adressReesult;
    }

    private static function updateOrder($uid, $send_user_id, $order_id,$address_id){
        $address = UserAddress::getAddress($uid,$address_id);
        if(!$address){
            throw new UserException([
                'msg' => '用户收货地址不存在',
                'errorCode' => 60001
            ]);
        }
        $result = Order::changeOrderAddress($send_user_id,$order_id, json_encode($address));
        return $result;
    }
}