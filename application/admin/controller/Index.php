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

//    public function generateToken()
//    {
//        // 32个字符组成一组随机字符串
//        $randChar = $this->getRandChar(32);
//        // 用三组字符串，进行MD5加密
//        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
//        // salt 盐
//        $tokenSalt = config('secure.token_salt');
//        return md5($randChar.$timestamp.$tokenSalt);
//    }
//
//    public function getRandChar($length)
//    {
//        $str = null;
//        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
//        $max = strlen($strPol) - 1;
//
//        for ($i = 0;
//             $i < $length;
//             $i++) {
//            $str .= $strPol[rand(0, $max)];
//        }
//
//        return $str;
//    }

    public function index(){
        return view();
    }

    public function main(){
        return view();
    }
}