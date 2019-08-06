<?php
namespace app\admin\validate;

class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];

    public function sceneInteger(){
        return $this->remove('id','require');
    }
}
