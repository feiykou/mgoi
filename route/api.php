<?php

// Banner
Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');

/*
 * Product
 */
// 首页推荐
Route::get('api/:version/product/recoIndex/:rescid', 'api/:version.Product/getRecoIndex',[],['rescid'=>'\d+']);

// 获取产品详情
Route::get('api/:version/product/:id/detail', 'api/:version.Product/getOne',[],['id'=>'\d+']);
// 获取产品下的属性
Route::get('api/:version/product/singleProp', 'api/:version.Product/getSingleProp');
// 推荐分类产品
Route::get('api/:version/product/getRecoIndexByCate', 'api/:version.Product/getProductsByCateID');
// 产品分类
Route::get('api/:version/product/cateProducts/[:cateid]', 'api/:version.Product/getProductByCate');
// 搜索
Route::get('api/:version/product/search', 'api/:version.Product/search');


/*
 * 分类
 */
Route::get('api/:version/cate/topCate', 'api/:version.Category/getTopCate');
Route::get('api/:version/cate/sonCate/[:cateid]', 'api/:version.Category/getSonCate',[],['cateid'=>'\d+']);
//Route::get('api/:version/cate/getProducts','api/:version.Category/getProductsByCate');
//Route::get('api/:version/cate/filteCate','api/:version.Category/filteCate');
//Route::get('api/:version/cate/indexRescCate','api/:version.Category/getIndexRescCate');
Route::get('api/:version/cate/sonAllCate/[:cateid]', 'api/:version.Category/getAllSonCate',[],['cateid'=>'\d+']);


/*
 * 礼物分类
 */
Route::get('api/:version/giftCate/sonCate/[:cateid]', 'api/:version.GiftCategory/getSonCate',[],['cateid'=>'\d+']);


/*
 * 主题
 */
// 首页推荐
Route::get('api/:version/theme/recoIndex', 'api/:version.Theme/getRecoIndex');
Route::get('api/:version/theme/:id/detail', 'api/:version.Theme/getOne',[],['id'=>'\d+']);
Route::get('api/:version/theme/list', 'api/:version.Theme/getList');


// 微信
Route::put('api/:version/wx/wxcode', 'api/:version.WxController/wxcode');

// Token
Route::post('api/:version/token/user','api/:version.Token/getToken');
Route::post('api/:version/token/verify', 'api/:version.Token/verifyToken');

// User 获取用户信息 - no
Route::post('api/:version/login','api/:version.User/updateUser');
// 获取用户信息
Route::get('api/:version/user/:id', 'api/:version.User/getUserInfo',[],['id'=>'\d+']);
// 用户添加评论 - no
Route::post('api/:version/user/commentAdd','api/:version.UserComment/addComment');
// 获取
Route::get('api/:version/product/comment', 'api/:version.UserComment/productComments');
Route::get('api/:version/user/comment', 'api/:version.UserComment/UserComments');


// 收藏
Route::post('api/:version/favorite/add','api/:version.UserFavorite/add');
Route::get('api/:version/favorite/list','api/:version.UserFavorite/flist');
Route::put('api/:version/favorite/delete','api/:version.UserFavorite/delete');
Route::get('api/:version/favorite/checkFavo','api/:version.UserFavorite/checkFavo');


// Address
Route::put('api/:version/address/:id/delete','api/:version.Address/delete',[],['id'=>'\d+']);
Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');
Route::put('api/:version/address','api/:version.Address/createOrUpdateAddress');
Route::get('api/:version/address/:id','api/:version.Address/editAddress',[],['id'=>'\d+']);
Route::get('api/:version/address/all','api/:version.Address/getUserAddress');
Route::get('api/:version/getDefaultAddress','api/:version.Address/getDefaultAddress');


// Order
Route::post('api/:version/order','api/:version.Order/placeOrder');
Route::post('api/:version/placeGiftOrder','api/:version.Order/giftPlaceOrder');
Route::get('api/:version/order/:id','api/:version.Order/getDetail',[],['id'=>'\d+']);
Route::put('api/:version/order/delivery', 'api/:version.Order/delivery');
//不想把所有查询都写在一起，所以增加by_user，很好的REST与RESTFul的区别
Route::get('api/:version/order/by_user','api/:version.Order/getSummaryByUser');
Route::get('api/:version/order/paginate','api/:version.Order/getSummary');
Route::put('api/:version/order/cancel','api/:version.Order/cancel');
Route::put('api/:version/order/remove','api/:version.Order/remove');
Route::get('api/:version/order/giftOrder','api/:version.Order/findOrder');


// Pay
Route::post('api/:version/pay/pre_order','api/:version.Pay/getPreOrder');
Route::post('api/:version/pay/notify','api/:version.Pay/receiveNotify');
Route::post('api/:version/pay/re_notify', 'api/:version.Pay/redirectNotify');


// Message
//Route::post('api/:version/message/delivery','api/:version.Message/delivery');


// 上传和删除文件
Route::post('api/:version/uploadImg', 'api/BaseController/uploadImg');
Route::delete('api/:version/deleteFile', 'api/BaseController/delFile');


// 卡劵
//Route::get('api/:version/card/ticket','api/:version.CardCoupon/getticket');
//Route::get('api/:version/card/addCard','api/:version.CardCoupon/addCard');
Route::get('api/:version/couponsTaken/list','api/:version.Coupons/getCoupons');
Route::get('api/:version/couponsTaken/add','api/:version.Coupons/receiveCoupon');
