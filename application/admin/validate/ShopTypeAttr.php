<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27
 * Time: 23:56
 */

namespace app\admin\validate;


class ShopTypeAttr extends BaseValidate
{
    protected $rule = [
        'name' => 'require|max:50',
        'spg_id' => 'require',
        'segements' => 'requireIf:type,1',
        'type' => 'require|number'
    ];

    protected $message = [
        'name.require' => '名称必须填写',
        'name.max' => '名称不能超过50个字',
        'segements' => '单选属性值必须',
        'spg_id' => '所属分类必须',
    ];

    protected $scene = [
        'type' => ['name'],
        'property' => ['name','spg_id','segements']
    ];
}