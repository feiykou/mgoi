<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27
 * Time: 23:56
 */

namespace app\admin\validate;


class CouponsValidate extends BaseValidate
{

    protected $rule = [
        'name' => 'require|max:30|min:2',
        'num' => 'require|number',
        'least_cost' => 'require|number',
        'reduce_cost' => 'require|number',
        'end_date' => 'require|date',
        'start_date' => 'require|date'
    ];

    protected $message = [
        'name.require' => '优惠券必须填写',
        'name.max' => '优惠券不能超过30个字符',
        'name.min' => '优惠券至少2个字符',
        'num.require' => '库存必须填写',
        'num.number' => '库存必须是数字',
        'least_cost.require' => '限制条件必须填写',
        'least_cost.number' => '限制条件必须是数字',
        'reduce_cost.require' => '优惠额度必须填写',
        'reduce_cost.number' => '优惠额度必须是数字',
        'end_date.require' => '结束日期必须填写',
        'end_date.date' => '日期格式不对',
        'start_date.require' => '开始日期必须填写',
        'start_date.date' => '日期格式不对'
    ];
}