<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/23
 * Time: 21:31
 */

namespace app\admin\validate;

class AuthGroupValidate extends BaseValidate
{

    protected $rule = [
        'name' => 'require',
        'rules' => 'require',
        'status' => 'number',
    ];

    protected $message = [
        'name' => '用户组名必须填写',
        'rules' => '权限必须填写',
        'status.number' => '是否启用必须是数字'
    ];

}