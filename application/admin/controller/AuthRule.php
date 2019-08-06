<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21
 * Time: 23:59
 */

namespace app\admin\controller;

use app\admin\validate\AuthRuleValidate;
use app\admin\validate\IDMustBePositiveInt;
use catetree\Catetree;
use think\Exception;

class AuthRule extends Base
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = model('auth_rule');
    }

    public function lst(){
        $catetree=new Catetree();
        $data = $this->model->findAll();
        $data=$catetree->catetree($data);

        $this->assign([
            'tbData'=> $data,
        ]);
        return view('list');
    }

    public function add(){
        // 分类
        $catetree = new Catetree();
        $categoryRes = $this->model->findAll();
        $categoryRes = $catetree->catetree($categoryRes);
        $this->assign([
            'CategoryRes' => $categoryRes
        ]);
        return view();
    }

    public function edit(){
        (new IDMustBePositiveInt())->goCheck();
        $id = input('id',0,'intval');
        $editData = $this->model->getOne(['id'=>$id]);
        // 分类
        $catetree = new Catetree();
        $categoryRes = $this->model->findAll();
        $categoryRes = $catetree->catetree($categoryRes);
        $sonids = $catetree->childrenids($id,$this->model);
        $sonids[] = intval($id);
        if(!$editData){
            // 数据不存在
            $this->error('修改的数据不存在');
        }
        $this->assign([
            'editData' => $editData,
            'categoryRes' => $categoryRes,
            'sonids' => $sonids
        ]);
        return view();
    }

    public function save(){
        if(!request()->post()){
            $this->error("请求失败");
        }
        (new AuthRuleValidate())->goCheck();
        // 获取请求数据
        $data = input('post.');
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