<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/26
 * Time: 22:23
 */

namespace app\admin\controller;


use Auth\Auth;
use think\Controller;
use think\facade\Request;

class Base extends Controller
{
    public function initialize()
    {
        $isLogin = $this->isLogin();
        if(!$isLogin){
            $this->redirect('/login');
        }

        // 权限认证
//        $this->rule();
    }

    private function rule(){
        $module = Request::module();
            $controller = Request::controller();
            $action = Request::action();
            $auth = new Auth();
            $name = $module . '/' . strtolower($controller) . '/' . $action;
            if(substr_count($name, "admin/index") == 1){
                return;
            }

            if(!$auth->check($name, session('uid'))){
                $this->error('没有该操作权限！');
        }
    }

    protected function isLogin(){
        if(session('uid') && session('uname')){
            return true;
        }
        return false;
    }

    public function status(){
        // 获取值
        $data = input('param.');
        $status = 'status';
        if(isset($data['attr'])){
            $status =$data['attr'];
        }

        // 利用tp5 validate 去做严格检验
        if(empty($data['id'])){
            $this->error("id不合法");
        }
        if(!is_numeric($data[$status])){
            $this->error($status."不合法");
        }

        // 获取控制器
        $model = request()->controller();
        $result = model($model)->where('id',intval($data['id']))->update([
            $status => $data[$status]
        ]);


        if($result){
            $this->result('','1','更新成功');
        }else{
            $this->result('','0','更新失败');
        }
    }


    public function is_unique($name=[],$id=0){
        $data = array_merge([
            ['id','<>',$id]
        ], $name);
        $model = request()->controller();
        $result = model($model)->where($data)->find();
        return $result ? true : false;
    }

    public function uploadImg(){
//        var_dump($file = Request::instance()->file('file'));die;
        if($_FILES['file']['tmp_name']){
            $file = request()->file('file');
            $info = $file->move('upload/images');
            if($info){
                $img_url = '/' . str_replace('\\','/',$info->getSaveName());
            }
        }

        if(!empty($img_url)){
            return $this->result($img_url,'1','上传成功','json');
        }else{
            return $this->result('','2','上传失败','json');
        }
    }

    public function delFile(){
        $delsrc = input('delsrc');
        $delsrc = DEL_FILE_URL . $delsrc;
        if(file_exists($delsrc)){
            if(@unlink($delsrc)){
                return $this->result('','1','删除文件成功','json');
            }else{
                return $this->result('','2','删除文件失败','json');
            }
        }else{
            return $this->result('','3','删除的文件不存在','json');
        }
    }

    /**
     * 异常处理
     * @url
     * @http
     * @param $ex
     */
    function handleException($ex){
        if($ex->getCode() == 10501){
            $this->result('',0,'存在同名类型名');
        }
        $this->result('',0,'存在异常');
    }

}