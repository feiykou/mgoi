<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9
 * Time: 12:14
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\Favorite as FavoriteValidate;
use app\api\service\Token as TokenService;
use app\api\model\UserFavorite as UserFavoriteModel;
use app\api\model\User as UserModel;
use app\api\validate\PagingParameter;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class UserFavorite extends BaseController
{

    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'add,flist,delete'],
    ];

    public function add(){
        if(request()->isPost()){
            $uid = $this->_public();
            $data = input('post.');
            $favo_id = $data['favo_id'];
            $type = 1;
            if(isset($data['type'])){
                $type = $data['type'];
            }
            $isExist = UserFavoriteModel::checkIsExist($uid,$favo_id,$type);
            if($isExist){
                return json(new SuccessMessage(),201);
            }

            $result = UserModel::saveFavo($uid,['favo_id' => $favo_id,'type'=>$type]);
            if(!$result){
                throw new UserException([
                    'code'  =>  404,
                    'msg'   =>  '用户收藏失败',
                    'errorCode' =>  60003
                ]);
            }
            return json(new SuccessMessage(),201);
        }
    }

    public function flist($page=1,$size=10){
        (new PagingParameter())->goCheck();
        $uid = TokenService::getCurrentUid();
        if(!UserModel::isExistUser($uid)){
            throw new UserException();
        }
        $data = UserFavoriteModel::listFavo($uid,$page,$size)->toArray();
        return json($data);
    }

    public function delete(){
        $uid = $this->_public();
        $data = input('put.');
        $favo_id = $data['favo_id'];
        $type = 1;
        if(isset($data['type'])){
            $type = $data['type'];
        }
        $result = UserFavoriteModel::updateFavo($uid, $favo_id,$type,1);
        if(!$result){
            throw new UserException([
                'code'  =>  404,
                'msg'   =>  '用户收藏删除失败',
                'errorCode' =>  60004
            ]);
        }
        return json(new SuccessMessage(),201);
    }

    public function checkFavo(){
        $uid = $this->_public();
        $favo_id = input('favo_id',0, 'intval');
        $type = input('type',1, 'intval');
        $result = UserFavoriteModel::where([
            'user_id' => $uid,
            'favo_id' => $favo_id,
            'type' => $type,
            'is_delete' => 0
        ])->find();
        if($result){
            return json(new SuccessMessage(),201);
        }else{
            return json(new SuccessMessage([
                'msg' => 'error'
            ]),201);
        }
    }

    private function _public(){
        (new FavoriteValidate())->goCheck();
        $uid = TokenService::getCurrentUid();
        if(!UserModel::isExistUser($uid)){
            throw new UserException();
        }
        return $uid;
    }

}