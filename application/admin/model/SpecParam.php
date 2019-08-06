<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12 0012
 * Time: 下午 16:48
 */

namespace app\admin\model;



use think\model\concern\SoftDelete;

class SpecParam extends Common
{
    // 软删除设置
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = '0000-00-00 00:00:00';

    // 表关系：类型表和属性表 --- 一对多关系
    public function SpecGroup(){
        return $this->belongsTo('spec_group','spg_id');
    }

    /**
     * 查询全部数据列表
     * @url
     * @http
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function findAll($where = [], $hidden = [], $limit = 10, $order = ''){
        $data = self::with(['SpecGroup' => function($query){
            $query->field('id,name');
        }])->where($where)
           ->order($order)
           ->paginate($limit, false, [
               'query' => request()->param()
           ])->hidden($hidden);
        return $data;
    }
}