<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/23
 * Time: 21:31
 */

namespace app\admin\validate;

class UserCmsValidate extends BaseValidate
{

    protected $rule = [
        'name' => 'require',
        'password' => 'require|confirm:repassword|min:6|max:10',
    ];

    protected $message = [
        'name.require' => '用户名必须填写',
        'password' => '密码必须填写',
        'password.confirm' => '密码不一致'
    ];

    public function sceneEdit(){
        return $this->remove('password','require');
    }
}