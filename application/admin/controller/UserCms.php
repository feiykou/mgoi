<?php


namespace app\admin\controller;


use app\admin\validate\IDMustBePositiveInt;
use app\admin\validate\UserCmsValidate;
use think\Exception;

class UserCms extends Base
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = model('user_cms');
    }

    public function lst(){
        $data = $this->model->findAll();
        $this->assign([
            'listData'=>$data,
        ]);
        return view('list');
    }

    public function add(){
        $groupData = model('auth_group')->findAll();
        $this->assign([
            'groupData' => $groupData
        ]);
        return view('add');
    }

    public function edit(){
        (new IDMustBePositiveInt())->goCheck();
        $id = input('id',0,'intval');
        $editData = $this->model->getUserWithGroup(['id'=>$id]);
        $groupData = model('auth_group')->findAll();
        if(!$editData){
            // 数据不存在
            $this->error('修改的数据不存在');
        }

        if(!$groupData){
            // 数据不存在
            $this->error('用户组不存在，请先添加');
        }
        $this->assign([
            'editData' => $editData,
            'groupData' => $groupData
        ]);
        return view('edit');
    }

    /**
     *  数据保存或更新
     */
    public function save(){
        if(!request()->post()){
            $this->error("请求失败");
        }
        $data['id'] = input('post.id',0,'intval');
        $is_exist_id = empty($data['id']);
        (new UserCmsValidate())->goCheck(!$is_exist_id?'edit':'');


        // 获取请求数据
        $data['name'] = input('post.name');
        $group_id = input('post.group_id',0,'intval');

        // 判断是否存在同名
        $is_unique = $this->is_unique([
            ['name','=',$data['name']],
            ['is_delete', '=', 0]], $is_exist_id ? 0 : $data['id']);
        if($is_unique){
            $this->result('','0','存在同名用户名');
        }

        // 更新数据
        if(!$is_exist_id){
            if(!empty(input('post.password'))){
                $data['password'] = md5(input('post.password'));
            }
            return $this->update($data, $group_id);
        }

        $data['password'] = md5(input('post.password'));
        // 添加数据
        try{
            $result = $this->model->addUser($data,$group_id);
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
    public function update($data, $group_id){
        try{
            $result = $this->model->updateUser($data,$group_id);
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
        $result = $this->model->saveData(['is_delete'=>1],['id' => $id]);
        // 返回状态码
        if($result){
            $this->result($_SERVER['HTTP_REFERER'], 1, '删除完成');
        }else{
            $this->result($_SERVER['HTTP_REFERER'], 0, '删除失败');
        }
    }

}