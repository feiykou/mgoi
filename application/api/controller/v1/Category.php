<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/29
 * Time: 5:34
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\CateFilter;
use app\api\validate\Category as CategoryValidate;
use app\api\model\Category as CategoryModel;
use app\api\model\Product as ProductModel;
use app\api\validate\CateIDMustBePositiveInt;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\CategoryException;
use catetree\Catetree;

class Category extends BaseController
{

    /**
     * 获取分类下的所有产品，包括当前分类信息
     * @url   cate/getProducts
     * @http
     * @param $id  分类id
     * @return array|\PDOStatement|string|\think\Model|null
     * @throws CategoryException
     * @throws \app\lib\exception\ParameterException
     */
    public function getProductsByCate($id){
        (new IDMustBePositiveInt())->goCheck();
        $data = CategoryModel::getProductAndCate($id);
        if(!$data){
            throw new CategoryException();
        }
        return $data;
    }

    /**
     * 获取首页推荐顶级分类（包括子类）  --- 暂时不用
     * @url
     * @http
     * @return array|\PDOStatement|string|\think\Collection
     * @throws CategoryException
     */
//    public static function getIndexRescCate(){
//        $data = CategoryModel::getRecIndexCate(5, 0);
//        foreach ($data as $key => &$val){
//            $sonData = CategoryModel::getRecIndexCate(5, $val['id']);
//            $val['sonData'] = $sonData;
//        }
//        if(!$data){
//            throw new CategoryException();
//        }
//        return $data;
//    }


    /**
     * 分类筛选 ---  暂时未用到
     * @url   cate/filteCate
     * @http
     * @param int $size  数据数量
     * @param int $page  第一页
     * @return \think\Paginator
     * @throws CategoryException
     * @throws \app\lib\exception\ParameterException
     */
//    public function filteCate($size=10,$page=1){
//        $validate = new CateFilter();
//        $validate->goCheck();
//        $data['price'] = input('get.price');
//        $data['category_id'] = input('get.cateid');
//
//        if(intval($data['category_id']) == 0){
//            unset($data['category_id']);
//        }
//        if(strlen($data['price']) == 1 && intval($data['price']) == 0){
//            unset($data['price']);
//        }else{
//            $priceArr = explode('-',$data['price']);
//            $data['price'] = ['between',[intval($priceArr[0]),intval($priceArr[1])]];
//        }
//
//        $resData = ProductModel::filterCate($data,$size,$page);
//        if(!$resData){
//            throw new CategoryException();
//        }
//        return $resData;
//    }

    /**
     * 获取一级分类
     */
    public function getTopCate(){
        $data = CategoryModel::getTopCate();
        return $data;
    }

    /**
     * 获取下一级分类
     * @url
     * @http
     * @param int $cateid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getSonCate($cateid=0){
        (new CateIDMustBePositiveInt())->goCheck('cate');
        if($cateid == 0){
            $data = $this->getTopCate();
        }else{
            $data = CategoryModel::getSonData($cateid);
        }

        return json($data);
    }

    /**
     * 获取当前分类的所有子类
     * @url   cate/sonAllCate/[:cateid]
     * @http
     * @param int $cateid 当前分类id
     * @return \think\response\Json
     * @throws \app\lib\exception\ParameterException
     */
    public function getAllSonCate($cateid=0){
        (new CateIDMustBePositiveInt())->goCheck('cate');
        $data = CategoryModel::getAllSonData($cateid);
        if(!$data){
            throw new CategoryException();
        }
        return json($data);
    }
}