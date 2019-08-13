<?php


namespace app\api\model;


use think\Model;

class GiftShare extends Model
{
    protected $hidden = [
        'create_time', 'timing_time', 'update_time'
    ];

    public function user(){
        return $this->belongsTo('user','gift_user_id','id');
    }
}