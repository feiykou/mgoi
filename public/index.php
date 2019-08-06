<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';
// 支持事先使用静态方法设置Request对象和Config对象

// 图片路径
define('IMG_URL', '/upload/images/');
// 视频路径
define('VIDEO_URL', '/upload/videos/');
// 二维码路径
define('WX_URL', '/upload/wxcode/');
// 二维码路径
define('API_URL', '/upload/API/');
// 删除文件路径
define('DEL_FILE_URL', __DIR__);
define('PAY_PATH', __DIR__);


// 执行应用并响应
Container::get('app')->run()->send();
