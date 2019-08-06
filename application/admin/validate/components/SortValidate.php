<?php
namespace app\admin\validate\components;

use app\admin\validate\BaseValidate;
use app\lib\exception\ParameterException;

class SortValidate extends BaseValidate
{
    protected $rule = [
        'sort' => 'checkSorts',
    ];

    protected $singleRule = [
        'id' => 'require|isPositiveInteger',
        'sort' => 'require|isInteger'
    ];

    protected function checkSorts($values){
        if(empty($values)){
            throw new ParameterException([
                'msg' => '排序参数不能为空'
            ]);
        }

        if(!is_array($values)){
            throw new ParameterException([
                'msg' => '排序参数必须是数组'
            ]);
        }

        foreach ($values as $k => $v){
            $this->checkSort([
                'id' => $k,
                'sort' => $v
            ]);
        }

        return true;
    }

    private function checkSort($value){
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if(!$result){
            throw new ParameterException([
                'msg' => '排序参数错误',
            ]);
        }
    }
    
}
