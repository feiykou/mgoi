<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-06-13
 * Time: 17:46
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\ThemeCategory;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\ProductRescCount;
use app\api\model\Theme as ThemeModel;
use app\lib\exception\ThemeException;

class Theme extends BaseController
{
    /**
     * 获取首页推荐主题，包括主题下的产品
     * @url     /theme/recoIndex?count=:count
     * @http    get
     * @param   int $rescid  推荐id
     * @param   int $count   显示数量
     * @return  false|\PDOStatement|string|\think\Collection
     * @throws  ThemeException
     */
    public function getRecoIndex($rescid= 10,$count = 4)
    {
        (new ProductRescCount())->goCheck();
        $themes = ThemeModel::getIndex($rescid,$count);
        if($themes->isEmpty()){
            throw new ThemeException();
        }
        $themes = $themes->hidden([
            'content', 'head_img_url', 'product.pivot'
        ]);
        return $themes;
    }

    /**
     * 获取主题详情
     * @url     /theme/:id/detail
     * @http    get
     * @param   $id
     * @return  array|false|\PDOStatement|string|\think\Model
     * @throws  ThemeException
     */
    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $themes = ThemeModel::getThemeDetail($id);
        $themes = $themes->hidden([
            'product.pivot', 'sort'
        ]);
        if(!$themes){
            throw new ThemeException();
        }
        return $themes;
    }

    /**
     * 获取主题列表
     */
    public function getList(){
        $data = ThemeCategory::getCateAndTheme();
        if(!$data){
            throw new ThemeException([
                'msg' => '主题列表不存在'
            ]);
        }
        return $data;
    }
}