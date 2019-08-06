<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/29
 * Time: 5:35
 */

namespace app\api\model;


use catetree\Catetree;
use think\Model;

class GiftCategory extends BaseModel
{

    protected $hidden = ['sort','show_cate','keywords'];

    public function product(){
        return $this->belongsToMany('product','product_giftcategory','gcate_id','product_id');
    }



    public static function getProducts($size=1,$page=5){
        $result = self::with('product')
            ->paginate($size,'',['page' => $page]);
        return $result;
    }

    public function getCateImgAttr($value,$data){
        $arr = explode(';',$value);
        foreach ($arr as &$val){
            $val = $this->prefixImgUrl($val, $data);
        }
        return $arr;
    }

    // 获取分类下的所有上架产品
    public static function getProductAndCate($id){
        $data = self::with(['product' => function($query){
            $query->where('on_sale','=',1);
        }])->where('id',$id)->find();
        return $data;
    }

    // 获取顶级分类
    public static function getTopCate(){
        $where = [
            'pid' => 0,
            'is_delete' => 0,
        ];
        $data = self::where($where)
            ->order([
                'sort' => 'desc',
                'id' => 'desc'
            ])
            ->field('name,id,cate_img')
            ->select();
        return $data;
    }

    // 获取分类下的子类
    public static function getRecIndexCate($recposId, $pid){
        $data = [
            'recpos_id' => $recposId,
            'value_type' => 2
        ];
        $_cateRes = db('rec_item')->where($data)
            ->select();
        $cateIdArr = [];
        foreach ($_cateRes as $k => $v){
            array_push($cateIdArr, $v['value_id']);
        }
        $data = self::where([
            ['id','in', $cateIdArr],
            ['pid', '=', $pid]
        ])->order('sort desc')
          ->select();

        return $data;
    }

    /*
     * 获取分类信息  --- 多个分类
     */
    private static function _getSelCate($ids=[],$fieldStr=''){
        $field = 'id,pid,name,cate_img';
        if($fieldStr) $field .= $fieldStr;
        $data = self::where('show_cate','=','1')
            ->field($field)
            ->order([
                'sort' => 'desc',
                'id' => 'desc'
            ])->select($ids);
        return $data;
    }


    public static function getSonData($cateId){
        $cateTree = new Catetree();
        $ids = $cateTree->sonids($cateId, new self(),['is_delete'=>0]);
        $data = [];
        if(count($ids) > 0){
            $data = self::_getSelCate($ids,',description');
        }
        return $data;
    }

    public static function getAllSonData($cateId){
        $cateTree = new Catetree();
        $ids = $cateTree->childrenids($cateId, new self());
        $data = [];
        if(count($ids) > 0){
            $data = self::_getSelCate($ids)->toArray();
            $data = $cateTree->generateTree($data);

        }
        return $data;
    }
}