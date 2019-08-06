<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27
 * Time: 23:56
 */

namespace app\admin\validate;


class BannerValidate extends BaseValidate
{

    protected $rule = [
        'name' => 'require',
        'img_url' => 'require',
        'key_word' => 'number',
        'url_type' => 'require',
        'type' => 'require'
    ];

    protected $message = [
        'name' => '名称必须添加',
        'img_url' => '轮播图必须添加',
        'key_word' => '跳转id必须是数字',
        'url_type' => '轮播图类型必须添加',
        'type' => '跳转类型必须添加'
    ];

    protected $scene = [
        'bannerItem' => ['name','img_url','key_word','url_type','type']
    ];
}