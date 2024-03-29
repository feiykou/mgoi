<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27
 * Time: 23:56
 */

namespace app\admin\validate;


class CommonValidate extends BaseValidate
{

    protected $rule = [
        'name' => 'require|max:30',
        'description' => 'max:255'
    ];

    protected $message = [
        'name.require' => '名称必须填写',
        'name.max' => '名称不能超过30个字',
        'description.max' => '名称不能超过255个字'
    ];

    protected $scene = [
        'name' => ['name'],
        'name_desc' => ['name','description']
    ];

}