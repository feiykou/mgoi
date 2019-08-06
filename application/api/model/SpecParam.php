<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 17:27
 */

namespace app\api\model;


class SpecParam extends BaseModel
{
    protected $hidden = [
        'delete_time', 'is_add_img', 'numeric', 'searching'
    ];

}