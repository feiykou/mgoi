<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/29
 * Time: 5:34
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\GiftCategory as GiftCategoryModel;
use app\api\validate\CateIDMustBePositiveInt;

class GiftCategory extends BaseController
{

    /**
     * 获取下一级分类
     * @url   /giftCate/sonCate/[:cateid]
     * @http
     * @param int $cateid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getSonCate($cateid=0){
        (new CateIDMustBePositiveInt())->goCheck('cate');
        if($cateid == 0){
            $data = $this->getTopCate();
        }else{
            $data = GiftCategoryModel::getSonData($cateid);
        }
        return json($data);
    }


    /**
     * 获取一级分类
     */
    public function getTopCate(){
        $data = GiftCategoryModel::getTopCate();
        return $data;
    }

}