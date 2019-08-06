<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/23
 * Time: 21:31
 */

namespace app\admin\model;

use think\Db;
use think\Exception;

class UserCms extends Common
{

    // auth_group多对多关系 添加
    public function groupAccess(){
        return $this->belongsToMany('auth_group','auth_group_access','group_id','uid');
    }


    // auth_group_access一对多关系  获取和更新
    public function authGroupAccess(){
        return $this->belongsTo('auth_group_access','id','uid');
    }


    public static function getLoginStatus($loginData){
        $data = [
            'name' => $loginData['ac'],
            'is_delete' => 0
        ];
        $userData = self::getUser($data);
        if($userData){
            if($userData['password'] == md5($loginData['se'])){
                session('uid',$userData['id']);
                session('uname',$userData['name']);
                return 2; // 登录成功
            }else{
                return 3; // 登录密码错误
            }
        }else{
            return 1; // 用户名不存在
        }
    }


    public static function getUser($data){
        $userData = self::where($data)->find();
        return $userData;
    }


    public function getUserWithGroup($data){
        $userData = self::where($data)
            ->withJoin(['authGroupAccess' => function($query){
                $query->withField('group_id');
            }])->find();
        return $userData;
    }


    public function addUser($data,$group_id){
        Db::startTrans();
        try {
            $userData = self::create($data);
            $userData->groupAccess()->save($group_id);
            // 提交事务
            Db::commit();
            return true;
        } catch (Exception $e){
            // 回滚事务
            Db::rollback();
            return false;
        }
    }


    public function updateUser($data,$group_id){
        Db::startTrans();
        try {
            $userData = self::update($data,['id' => $data['id']]);
            $userData->authGroupAccess->save(['group_id' => $group_id]);
            // 提交事务
            Db::commit();
            return true;
        } catch (Exception $e){
            // 回滚事务
            Db::rollback();
            return false;
        }
    }


}