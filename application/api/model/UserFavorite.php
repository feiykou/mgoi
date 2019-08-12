<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9
 * Time: 12:24
 */

namespace app\api\model;


class UserFavorite extends BaseModel
{

    protected $visible = ['favo_id','id','type'];

    public function user(){
        return $this->belongsTo('user','user_id','id');
    }
    public function product(){
        return $this->belongsTo('product','favo_id','id');
    }

    public function theme(){
        return $this->belongsTo('theme','favo_id','id');
    }



    // 判断收藏产品是否存在
    public static function checkIsExist($uid, $favo_id,$type=1){
        $data = [
            'user_id' => $uid,
            'favo_id' => $favo_id,
            'type' => $type
        ];
        $isExist = self::where($data)->find();

        if($isExist){
            if($isExist['is_delete'] == 1){
                $result = self::updateFavo($uid,$favo_id, $type,0);
                return $result;
            }
            return true;
        };
        return false;
    }

    public static function updateFavo($uid, $favo_id, $type, $is_delete){
        $data = [
            'user_id' => $uid,
            'type' => $type,
            'favo_id' => $favo_id
        ];
        $result = self::where($data)
            ->update(['is_delete' => $is_delete]);
        return $result;
    }

    // 收藏列表
    public static function listFavo($uid, $page=1,$size=10){
        $data = [
            'user_id' => $uid,
            'is_delete' => 0
        ];

        $result = self::where($data)->with(['product' => function($query){
            $query->where(['on_sale'=>1])->field('name,main_img_url,id,price,description,theme_id');
        }])->paginate($size,false,['page'=>$page]);
        return $result;
    }

}