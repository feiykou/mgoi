<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21
 * Time: 23:59
 */

namespace app\admin\controller;

use app\admin\validate\IDMustBePositiveInt;
use app\admin\validate\ShopTypeAttr;
use think\Exception;

class SpecGroup extends Base
{
    protected $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = model('spec_group');
    }

    public function lst(){
        $typeData=$this->model->select();
        $this->assign([
            'tbData'=>$typeData,
        ]);
        return view('list');
    }

    public function add(){
        return view();
    }

    public function edit(){
        (new IDMustBePositiveInt())->goCheck();
        $id = input('id',0,'intval');
        $editData = $this->model->getOne(['id'=>$id]);
        if(!$editData){
            // 数据不存在
            $this->error('修改的数据不存在');
        }
        $this->assign([
            'editData' => $editData
        ]);
        return view();
    }

    /**
     *  数据保存或更新
     */
    public function save(){
        if(!request()->post()){
            $this->error("请求失败");
        }
        (new ShopTypeAttr())->goCheck('type');
        // 获取请求数据
        $data = input('post.');
        $is_exist_id = empty($data['id']);

        // 更新数据
        if(!$is_exist_id){
            return $this->update($data);
        }

        // 添加数据
        try{
            $result = $this->model->addData($data);
        }catch (Exception $ex){
            $this->handleException($ex);
        }

        if($result){
            $this->result(url('lst'),1,'添加成功');
        }else{
            $this->result('',0,'添加失败');
        }
    }

    /**
     * 更新数据
     * @param $data
     */
    public function update($data){
        try{
            $result = $this->model->saveData($data,['id' => intval($data['id'])]);
        }catch (Exception $ex){
            $this->handleException($ex);
        }
        if($result == 1){
            $this->result(url('lst'),1,'更新成功');
        }else if($result == 0){
            $this->result(url('lst'),1,'你没有修改数据哦！');
        }else{
            $this->result('',0,'更新失败');
        }
    }

    /**
     * 删除数据
     */
    public function del(){
        (new IDMustBePositiveInt())->goCheck();
        $id = input('id',0, 'intval');
        $result = $this->model->delGroup($id);
        // 返回状态码
        if($result){
            $this->result($_SERVER['HTTP_REFERER'], 1, '删除完成');
        }else{
            $this->result($_SERVER['HTTP_REFERER'], 0, '删除失败');
        }
    }
//
//
//    //删除
//    public function del($id=-1){
//        if(request()->isPost()){
//            $id = request()->post()['idsArr'];
//            if($id == []){
//                $this->error("无选中的数据！");
//            }
//        }else{
//            if(intval($id)<1){
//                $this->error("参数不合法");
//            }
//        }
//
//        if(!is_array($id)){
//            $id = [$id];
//        }
//        $result = db('brand')->delete($id);
//        // 返回状态码
//        if($result){
//            $this->result($_SERVER['HTTP_REFERER'], 1, '删除完成');
//        }else{
//            $this->result($_SERVER['HTTP_REFERER'], 0, '删除失败');
//        }
//    }
}