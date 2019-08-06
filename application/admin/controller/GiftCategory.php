<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21
 * Time: 23:59
 */

namespace app\admin\controller;

use app\admin\validate\CategoryValidate;
use app\admin\validate\components\SortValidate;
use app\admin\validate\IDMustBePositiveInt;
use catetree\Catetree;

class GiftCategory extends Base
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = model('gift_category');
    }

    public function lst(){
        $category=new Catetree();
        if(request()->isPost()){
            (new SortValidate())->goCheck();
            $data=input('post.');
            $category->cateSort($data['sort'],$this->model);
            $this->success('排序成功！',url('lst'),'',1);
        }
        $categoryRes=$this->model->findAll([],'sort DESC');
        $categoryRes=$category->catetree($categoryRes);
        $this->assign([
            'tbData'=>$categoryRes,
        ]);
        return view('list');
    }

    public function add(){
        // 分类
        $category = new Catetree();
        $categoryRes = $this->model->findAll([],'sort DESC');
        $categoryRes = $category->catetree($categoryRes);

        // 商品推荐位
        $productRecposRes = db('recpos')->where('type','=',5)->select();
        $this->assign([
            'CategoryRes' => $categoryRes,
            'productRecposRes' => $productRecposRes
        ]);
        return view();
    }

    public function edit($id=0){
        if(intval($id) < 1){
            $this->error("参数不合法");
        }
        $catetree = new Catetree();
        $categoryRes = $this->model->findAll([],'sort DESC');
        $categoryRes = $catetree->catetree($categoryRes);
        $sonids = $catetree->childrenids($id,$this->model);
        $sonids[] = intval($id);
        $editData = $this->model->find(['id'=>$id]);

        // 产品推荐位
        $categoryRecposRes = db('recpos')->where('type','=',5)->select();
        // 当前产品相关推荐位
        $_curCategoryRecposRes = db('rec_item')->where([
            'value_id' => intval($id),
            'value_type' => 5
        ])->select();
        $curCategoryRecposRes = [];
        foreach ($_curCategoryRecposRes as $k=>$v){
            $curCategoryRecposRes[] = $v['recpos_id'];
        }
        $this->assign([
            'editData' => $editData,
            'CategoryRes' => $categoryRes,
            'sonids' => $sonids,
            'curCategoryRecposRes' => $curCategoryRecposRes,
            'categoryRecposRes' => $categoryRecposRes
        ]);
        return view();
    }

    public function save(){

        if(!request()->post()){
            $this->error("请求失败");
        }
        (new CategoryValidate())->goCheck('save');

        // 获取请求数据
        $data = input('post.');
        $is_exist_id = empty($data['id']);
        // 判断是否存在同名
//        $is_unique = $this->is_unique($data['cate_name'], $is_exist_id ? 0 : $data['id'],'cate_name');
//        if($is_unique){
//            $this->result('','0','存在同名分类名');
//        }

        // 更新数据
        if(!$is_exist_id){
            return $update = $this->update($data);
        }

        // 添加数据
        $result = $this->model->save($data);
        if($result){
            $this->result(url('lst'),'1','添加成功');
        }else{
            $this->result('','0','添加失败');
        }
    }

    public function update($data){
        $result = $this->model->save($data,['id' => intval($data['id'])]);
        if($result){
            $this->result(url('lst'),'1','更新成功');
        }else{
            $this->result('','0','更新失败');
        }
    }

    /**
     * 删除数据
     */
    public function del(){
        (new IDMustBePositiveInt())->goCheck();
        $id = input('id',0, 'intval');
        $catetree = new Catetree();
        $sonids = $catetree->childrenids($id,$this->model);
        $sonids[] = intval($id);

        $result = $this->model->saveData(['is_delete'=>1],['id' => $sonids]);
        // 返回状态码
        if($result){
            $this->result($_SERVER['HTTP_REFERER'], 1, '删除完成');
        }else{
            $this->result($_SERVER['HTTP_REFERER'], 0, '删除失败');
        }
    }
}