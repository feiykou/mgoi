<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21
 * Time: 23:44
 */

namespace app\admin\controller;



class Index extends Base
{

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    public function index(){
        return view();
    }

    public function main(){
        return view();
    }
}