<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27
 * Time: 23:50
 */

namespace app\admin\validate;


use app\lib\exception\ParameterException;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck($scene=''){
        $params = request()->param();
        if(isset($scene) && !empty($scene)){
            $result = $this->batch()->scene($scene)->check($params);
        }else{
            $result = $this->batch()->check($params);
        }
        if(!$result){
//            return ['msg'=>$this->getError(),'type'=>false];
//            var_dump($this->error);
            $exception = new ParameterException([
                    'code' => 0,
                    // $this->error有一个问题，并不是一定返回数组，需要判断
                    'msg' => is_array($this->getError()) ? implode(
                        '，', $this->getError()) : $this->getError(),
                ]);
            throw $exception;
        }
        return true;
    }

    protected function isPositiveInteger($value,$rule="",$data="",$field=""){
        /*
         * 判断是否为正整数
         */
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
            return true;
        }
        else{
            return false;
        }
    }

    protected function isInteger($value, $rule='', $data='', $field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) >= 0) {
            return true;
        }
        return $field . '必须是正整数包括零';
    }

    protected function isNotEmpty($value,$rule="",$data="",$field=""){
        /*
         * 判断是否为空
         */
        if(!empty($value)){
            return true;
        }
        else{
            return false;
        }
    }

    protected function isMobile($value){
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule,$value);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 功能：对客户端传递来的参数进行筛选
     *
     * @param $arrays  客户端传递来的参数
     */
    public function getDateByRule($arrays){
        if(array_key_exists('user_id',$arrays) | array_key_exists('uid',$arrays)){
            // 不允许包含user_id或者uid，防止恶意覆盖user_id外键
            throw new ParameterException([
                'msg' => '参数中包含有非法的参数名user_id或者uid'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value){
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }
}