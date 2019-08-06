<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/13
 * Time: 12:41
 */

namespace app\admin\controller;


use app\admin\validate\CouponsValidate;

class Coupons extends Base
{

    public function __construct()
    {
        parent::__construct();
        $this->model = model('coupons');
    }


    public function lst(){
        $data = $this->model->paginate();
        $this->assign([
            'couponsData' => $data
        ]);
        return view();
    }

    public function add(){
        return view();
    }

    public function edit($id=0){
        if(intval($id) < 1){
            $this->error("参数不合法");
        }
        $data = $this->model->where('status',1)->find(['id'=>$id]);
        $this->assign([
            'couponData' => $data
        ]);
        return view();
    }


    public function save(){
        if(!request()->post()){
            $this->error("请求失败");
        }
        (new CouponsValidate())->goCheck();

        // 获取请求数据
        $data = input('post.');
        $is_exist_id = empty($data['id']);
        // 判断是否存在同名
//        $is_unique = $this->is_unique($data['name'], $is_exist_id ? 0 : $data['id'],'name');
//        if($is_unique){
//            $this->result('','0','存在同名分类名');
//        }

        // 数据处理
        $data['start_date'] = strtotime($data['start_date']);
        $data['end_date'] = strtotime($data['end_date']);
        if($data['start_date'] > $data['end_date']){
            $this->result('','0','开始日期和结束日期时间不对');
        }


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

    //删除
    public function del($id=-1){
        if(request()->isPost()){
            $id = request()->post()['idsArr'];
            if($id == []){
                $this->error("无选中的数据！");
            }
        }else{
            if(intval($id)<1){
                $this->error("参数不合法");
            }
        }

        if(!is_array($id)){
            $id = [$id];
        }
        $result = $this->model->where(['id'=> ['in',$id]])->update(['status' => 0]);
        // 返回状态码
        if($result){
            $this->result($_SERVER['HTTP_REFERER'], 1, '删除完成');
        }else{
            $this->result($_SERVER['HTTP_REFERER'], 0, '删除失败');
        }
    }
}