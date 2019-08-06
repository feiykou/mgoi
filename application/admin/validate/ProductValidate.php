<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27
 * Time: 23:56
 */

namespace app\admin\validate;


class ProductValidate extends BaseValidate
{

    protected $rule = [
        'name' => 'require|unique:product',
        'category_id' => 'require',
        'market_price' => 'require',
        'price' => 'require'
    ];

    protected $message = [
        'name.require' => '商品名称不能为空',
        'name.unique' => '商品名称不能重复',
        'category_id' => '商品所属栏目不能为空',
        'market_price' => '商品市场价格不能为空',
        'price' => '商品本店价格不能为空'
    ];
}