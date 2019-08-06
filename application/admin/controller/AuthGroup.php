<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21
 * Time: 23:59
 */

namespace app\admin\controller;

use app\admin\validate\AuthGroupValidate;
use app\admin\validate\AuthRuleValidate;
use app\admin\validate\IDMustBePositiveInt;
use catetree\Catetree;
use think\Exception;

class AuthGroup extends Base
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = model('auth_group');
    }

    public function lst(){
        $data = $this->model->findAll();
        $this->assign([
            'tbData'=> $data,
        ]);
        return view('list');
    }

    public function add(){
        return view();
    }

    public function getRuleIds($id=0){
        if(empty($id)){
            $data['checkedId'] = [];
        }else{
            $rules = $this->model->getOne(['id'=>$id],'rules');
            $ruleArr = array_filter(explode(',',$rules['rules']));
            $ruleData = [];
            foreach ($ruleArr as $val){
                if(!empty($val)){
                    array_push($ruleData,intval($val));
                }
            }
            $data['checkedId'] = $ruleData;
        }
        $ruthData = model('auth_rule')->findAll()->hidden(['condition','title','status']);
        $data['trees'] = $ruthData->toArray();
        $this->result($data,1,'成功');
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

    public function reqData($reqData=[])
    {
        $data = [];
        if(isset($reqData['id'])){
            $data['id'] = intval($reqData['id']);
        }
        $data['name'] = $reqData['name'];
        $data['status'] = $reqData['status'];
        $data['rules'] = $reqData['rules'];
        return $data;
    }

    public function save(){
        if(!request()->post()){
            $this->error("请求失败");
        }
        (new AuthGroupValidate())->goCheck();
        // 获取请求数据
        $data = $this->reqData(input('post.'));
        $is_exist_id = empty($data['id']);

        // 判断是否存在同名
        $is_unique = $this->is_unique([
            ['name','=',$data['name']],
            ['is_delete', '=', 0]], $is_exist_id ? 0 : $data['id']);
        if($is_unique){
            $this->result('','0','存在同名规则名');
        }

        // 更新数据
        if(!$is_exist_id){
            return $this->update($data);
        }

        // 添加数据
        try{
            $result = $this->model->addData($data);
        }catch (Exception $ex){
            var_dump($ex);
            $this->handleException($ex);
        }
        if($result){
            $this->result(url('lst'),1,'添加成功');
        }else{
            $this->result('',0,'添加失败');
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
        $result = $this->model->saveData(['is_delete'=>1],['id' => $id]);
        // 返回状态码
        if($result){
            $this->result($_SERVER['HTTP_REFERER'], 1, '删除完成');
        }else{
            $this->result($_SERVER['HTTP_REFERER'], 0, '删除失败');
        }
    }

}