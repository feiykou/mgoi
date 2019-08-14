<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/2
 * Time: 20:20
 */

namespace app\api\model;



use app\lib\exception\UserException;

class UserAddress extends BaseModel
{
    protected $hidden = ['delete_time','create_time','update_time','user_id'];


    // 获取当前用户全部订单
    public static function getUserAddress($uid, $page=1, $size=10){
        $data = [
            'user_id' => $uid,
            'status' => 1
        ];

        $order = [
            'is_default' => 'desc',
            'update_time' => 'desc'
        ];

        $pagingData = self::where($data)
            ->order($order)
            ->paginate($size, false, ['page' => $page]);
        return $pagingData;
    }

    // 获取用户地址
    public static function getAddress($uid, $addressId){
        $data = [
            'id' => $addressId,
            'user_id' => $uid,
            'status' => 1
        ];
        $userAddress = UserAddress::where($data)
            ->find();

        return $userAddress;
    }

}