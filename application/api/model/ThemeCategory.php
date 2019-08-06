<?php


namespace app\api\model;


class ThemeCategory extends BaseModel
{

    protected $hidden = ['sort','pid','if_parent','is_delete'];

    public function theme(){
        return $this->hasMany('theme','category_id');
    }

    public static function getCateAndTheme(){
        $result = self::with(['theme'])->where('is_delete','=',0)
            ->order('sort desc')
            ->visible(['id','name','cate_img','theme'])
            ->select();
        return $result;
    }
}