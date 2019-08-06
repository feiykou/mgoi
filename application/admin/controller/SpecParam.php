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

class SpecParam extends Base
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = model('spec_param');
    }

    public function lst(){
        (new IDMustBePositiveInt())->goCheck('integer');
        $typeId = input('id','','intval');
        $map = [];
        $data = [];
        if($typeId){
            $map[] = ['spg_id','=',$typeId];
            $data['group_id'] = $typeId;
        }
        $result = $this->model->findAll($map);
        $data['tbData'] = $result;
        $this->assign($data);
        return $this->fetch('list');
    }

    public function add(){
        $categoryRes = model('spec_group')->select();
        if(!$categoryRes){
            $this->error('品类不能没有',url('spec_group/lst'));
        }
        $this->setGroupID();
        $this->assign(['CategoryRes' => $categoryRes]);
        return view();
    }

    private function setGroupID(){
        (new IDMustBePositiveInt())->goCheck('integer');
        $typeId = input('group_id','','intval');
        if(empty($typeId)) return;
        $this->assign(['groupId' => $typeId]);
    }

    public function edit(){
        (new IDMustBePositiveInt())->goCheck();
        $id = input('id',0,'intval');
        $this->setGroupID();
        $editData = $this->model->getOne(['id'=>$id]);
        $categoryRes = model('spec_group')->select();
        if(!$categoryRes){
            $this->error('品类不能没有',url('spec_group/lst'));
        }
        if(!$editData){
            // 数据不存在
            $this->error('修改的数据不存在');
        }
        $this->assign([
            'editData' => $editData,
            'categoryRes' => $categoryRes
        ]);
        return view();
    }

    public function save(){
        if(!request()->post()){
            $this->error("请求失败");
        }
        (new ShopTypeAttr())->goCheck('property');
        // 获取请求数据
        $data = input('post.');
        $is_exist_id = empty($data['id']);
        $data['segements'] = str_replace('，',',',$data['segements']);

        // 判断是否存在同名
        $is_unique = $this->is_unique([
            ['name','=',$data['name']],
            ['spg_id','=',$data['spg_id']],
        ],$is_exist_id ? 0 : $data['id']);
        if($is_unique){
            $this->result('','0','存在同类型属性名');
        }

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
            $this->result(url('lst',['id'=>$data['spg_id']]),'1','添加成功');
        }else{
            $this->result('','0','添加失败');
        }
    }

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
        $result = $this->model->softDel($id);
        // 返回状态码
        if($result){
            $this->result($_SERVER['HTTP_REFERER'], 1, '删除完成');
        }else{
            $this->result($_SERVER['HTTP_REFERER'], 0, '删除失败');
        }
    }


    // 异步获取指定属性下的属性
    public function ajaxGetAttr(){
        $typeId = input('type_id');
        $attrRes = $this->model->where(['spg_id'=>$typeId])->select();
        if($attrRes){
            $this->result($attrRes, 1, '获取成功');
        }else{
            $this->result($_SERVER['HTTP_REFERER'], 0, '获取失败');
        }
    }

}