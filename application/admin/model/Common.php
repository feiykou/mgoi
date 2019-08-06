<?php


namespace app\admin\model;


use think\Db;
use think\Model;

class Common extends Model
{
    protected $hidden = ['delete_time','is_delete'];

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    /**
     * 获取一条数据
     * @param array $where
     * @param string $field
     * @param string $order
     * @return Model
     */
    public function getOne($where=[],$field='*',$order=''){
        return self::where($where)
            ->order($order)
            ->field($field)
            ->find();
    }

    /**
     * 添加一条数据的公用方法
     * @url
     * @http
     * @param array $data
     * @return int|string
     */
    public function addData($data = []){
        return Db::name($this->getName())
            ->insert($data);
    }

    /**
     * 获取全部数据
     * @url
     * @http
     * @return mixed
     */
    public function findAll($where = [], $order='', $field = '*', $is_exist_delete=true){
        if($is_exist_delete){
            $where = array_merge(['is_delete' => 0 ],$where);
        }
        return self::where($where)
            ->field($field)
            ->order($order)
            ->select();
    }

    /**
     * 获取指定字段的值
     * @param array $where
     * @param string $field
     * @return mixed
     */
    public function getValue($where = [], $field = '*'){
        return Db::name($this->getName())
            ->where($where)
            ->value($field);
    }


    /**
     * 修改数据的公用方法
     * @param array $where
     * @param array $data
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function saveData($data = [], $where = []){
        return Db::name($this->getName())
            ->where($where)
            ->update($data);
    }

    /**
     * 删除数据的公用方法
     * @url
     * @http
     * @param array $where
     * @return int
     */
    public function delData($where = []){
        return Db::name($this->getName())
            ->where($where)
            ->delete();
    }

    /**
     * 软删除
     */
    public function softDel($id=0){
        return self::get($id)
            ->delete();
    }


    /**
     * 设置字段自增
     * @param array $where
     * @param string $field
     * @param int $step
     * @return int|true
     * @throws \think\Exception
     */
    public function setIncData($where = [], $field = '', $step = 1){
        return Db::name($this->getName())
            ->where($where)
            ->setInc($field,$step);
    }

    /**
     * 设置字段自减
     * @param array $where
     * @param string $field
     * @param int $step
     * @return int|true
     * @throws \think\Exception
     */
    public function setDecData($where = [], $field = '', $step = 1){
        return Db::name($this->getName())
            ->where($where)
            ->setDec($field,$step);
    }


}