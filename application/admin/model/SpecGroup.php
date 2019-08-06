<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12 0012
 * Time: 下午 16:48
 */

namespace app\admin\model;



use think\model\concern\SoftDelete;

class SpecGroup extends Common
{
    // 软删除设置
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = '0000-00-00 00:00:00';


    // 表关系：类型表和属性表 --- 一对多关系
    public function specParam(){
        return $this->hasMany('SpecParam','spg_id');
    }

    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->name('spec_group');
    }

    public function delGroup($id){
        $data = self::get($id,'spec_param');
        return $data->together('spec_param')->delete();
    }

}