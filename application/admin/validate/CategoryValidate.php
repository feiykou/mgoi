<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27
 * Time: 23:56
 */

namespace app\admin\validate;


class CategoryValidate extends BaseValidate
{

    protected $rule = [
        'name' => 'require|max:30',
        'show_cate' => 'number|in:0,1'
    ];

    protected $message = [
        'name.require' => '名称必须填写',
        'name.max' => '名称不能超过50个字',
        'show_cate.number' => '是否展示分类必须是数字',
        'show_cate.in' => '是否展示分类范围不合法',
    ];

    protected $scene = [
        'save' => ['name','show_cate']
    ];
}