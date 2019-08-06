<?php

namespace app\api\validate;

class RescIDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'rescid' => 'require|isPositiveInteger',
    ];
}
