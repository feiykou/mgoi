<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27
 * Time: 23:56
 */

namespace app\admin\validate;


class BrandValidate extends BaseValidate
{

    protected $regex = [
        'brand_url' => '(^#)|(^http(s*):\/\/[^\s]+\.[^\s]+)'
    ];

    protected $rule = [
        'brand_name' => 'require|max:1000',
        'brand_url' => 'require|regex:brand_url',
        'status' => 'number|in:0,1'
    ];

    protected $message = [
        'brand_name.require' => '品牌名必须填写',
        'brand_name.max' => '品牌名不能超过10个字符',
        'brand_url.require' => '品牌链接必须填写',
        'brand_url.regex' => '品牌链接格式不正确',
        'status.number' => '品牌状态必须是数字',
        'status.in' => '品牌状态范围不合法',
    ];

    protected $scene = [
        'save' => ['brand_name','brand_url','status']
    ];
}