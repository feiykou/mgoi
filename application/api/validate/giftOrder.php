<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-06-14
 * Time: 16:14
 */

namespace app\api\validate;


class giftOrder extends BaseValidate
{
    protected $rule = [
        'order_id' => 'require|isPositiveInteger',
        'address_id' => 'isPositiveInteger'
    ];

    protected $message = [
        'order_id.require' => '订单id必须填写',
        'address_id.require' => '地址id必须填写',
    ];

    protected $scene = [
        'gift' => 'order_id',
        'gift_taken' => ['order_id','address_id']
    ];
}