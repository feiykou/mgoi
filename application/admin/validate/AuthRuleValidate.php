<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/23
 * Time: 21:31
 */

namespace app\admin\validate;

class AuthRuleValidate extends BaseValidate
{

    protected $rule = [
        'name' => 'require',
        'pid' => 'require|number',
        'condition' => 'require',
        'show' => 'number',
    ];

    protected $message = [
        'name' => '规则名必须填写',
        'pid.require' => '上级规则必须填写',
        'pid.number' => '上级规则值必须是数字',
        'condition' => '规则必须填写',
        'show.number' => '是否启用必须是数字'
    ];

}