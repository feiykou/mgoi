<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12 0012
 * Time: 下午 16:48
 */

namespace app\admin\model;


use catetree\Catetree;

class ThemeCategory extends Common
{
    protected $field = true;

    protected function getCateImgAttr($val){
        return $this->handleImgUrl($val);
    }

    private function handleImgUrl($val){
        $val = str_replace('\\','/',$val);
        return explode(';',$val);
    }

    protected static function init()
    {
        self::afterInsert(function ($category){
            // 接收表单数据
            $categoryData = input('post.');
            // 商品id
            $categoryId = $category->id;
            // 处理商品推荐位
            // 处理推荐位
            if(isset($categoryData['recpos'])){
                foreach ($categoryData['recpos'] as $k=>$v){
                    db('rec_item')->insert([
                        'recpos_id' => $v,
                        'value_id' => $categoryId,
                        'value_type' => 5,
                    ]);
                }
            }
        });

        self::beforeUpdate(function ($category){
            // 接收表单数据
            $categoryData = input('post.');
            if(isset($categoryData['sort']) && is_array($categoryData['sort'])){
                return;
            }
            // 商品id
            $categoryId = $category->id;
            // 处理推荐位
            db('rec_item')->where([
                'value_id' => $categoryId,
                'value_type' => 5
            ])->delete();
            if(isset($categoryData['recpos'])){
                foreach ($categoryData['recpos'] as $k=>$v){
                    db('rec_item')->insert([
                        'recpos_id' => $v,
                        'value_id' => $categoryId,
                        'value_type' => 5
                    ]);
                }
            }
        });

        self::event("after_delete",function ($category){
            // 商品id
            $categoryId = $category->id;
            $catetree = new Catetree();
            $sonids = $catetree->childrenids($categoryId,new self());
            $sonids[] = intval($categoryId);
            // 处理推荐位
            db('rec_item')->where([
                'value_id' => ['in',$sonids],
                'value_type' => 5
            ])->delete();
        });

    }
}