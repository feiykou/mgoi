<?php /*a:4:{s:84:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\index\index.html";i:1564706655;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:84:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\left.html";i:1564707864;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="/static/admin/css/global.css" media="all">
<link rel="stylesheet" href="/static/admin/plugins/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/static/admin/css/style.css" media="all">
    <title>TBAUP</title>
    <link rel="stylesheet" href="/static/admin/css/app.css" media="all">
    <style>
        .layui-layer-tips{
            display: none;
        }
     
    </style>
</head>

<body>
    <div class="layui-layout layui-layout-admin kit-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">BIGWU TBAUP</div>
            <div class="layui-logo kit-logo-mobile">K</div>
            <ul class="layui-nav layui-layout-left kit-nav head-nav-tit" kit-navbar>
                <li class="layui-nav-item"><a href="javascript:;" data-url="<?php echo url('product/lst'); ?>" data-title="商品分类" data-id="101" data-icon="&#xe658;" kit-target>控制台</a></li>
                <li class="layui-nav-item"><a href="javascript:;" kit-target data-url="<?php echo url('product/lst'); ?>"  data-icon="&#xe658;" data-title="商品" data-id="54">商品</a></li>
                <!--<li class="layui-nav-item">-->
                    <!--<a href="javascript:;">设置</a>-->
                    <!--<dl class="layui-nav-child">-->
                        <!--<dd><a href="javascript:;">邮件管理</a></dd>-->
                        <!--<dd><a href="javascript:;">消息管理</a></dd>-->
                        <!--<dd><a href="javascript:;">授权管理</a></dd>-->
                    <!--</dl>-->
                <!--</li>-->
            </ul>
            <ul class="layui-nav layui-layout-right kit-nav">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <?php echo session('uname'); ?>
                    </a>
                    <!--<dl class="layui-nav-child">-->
                        <!--<dd><a href="javascript:;">基本资料</a></dd>-->
                        <!--<dd><a href="javascript:;">安全设置</a></dd>-->
                    <!--</dl>-->
                </li>
                <li class="layui-nav-item"><a href="<?php echo url('login/loginOut'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a></li>
            </ul>
        </div>

        <!--.layui-bg-black,.layui-bg-blue,.layui-bg-cyan,.layui-bg-green,.layui-bg-orange,.layui-bg-red-->
<style>
    .layui-nav{
        background-color: transparent;
    }
    .layui-nav-itemed .layui-nav-child{
        background-color: #293846!important;
    }
</style>
<div class="layui-side layui-bg-cyan kit-side">
    <div class="layui-side-scroll">
        <div class="kit-side-fold"><i class="fa fa-navicon" aria-hidden="true"></i></div>
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" kit-navbar>
            <li class="layui-nav-item">
                <a class="" href="javascript:;"><i class="fa fa-heartbeat" aria-hidden="true"></i><span> 品牌</span></a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="javascript:;" data-url="<?php echo url('brand/lst'); ?>" data-icon="&#xe66e;" data-title="品牌分类" data-id="50" kit-target><i class="fa fa-puzzle-piece"></i><span> 品牌分类</span></a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="" href="javascript:;"><i class="fa fa-briefcase" aria-hidden="true"></i><span> 主题</span></a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="javascript:;" data-url="<?php echo url('theme/lst'); ?>" data-icon="&#xe6c6;" data-title="主题" data-id="20" kit-target><i class="fa fa-reorder"></i><span> 主题</span></a>
                    </dd>
                    <dd>
                        <a href="javascript:;" data-url="<?php echo url('theme_category/lst'); ?>" data-icon="&#xe6c6;" data-title="主题分类" data-id="21" kit-target><i class="fa fa-reorder"></i><span> 主题分类</span></a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-id-badge" aria-hidden="true"></i><span> 商品</span></a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('category/lst'); ?>"  data-icon="&#xe658;" data-title="商品分类" data-id="51"><i class="fa fa-life-buoy"></i><span> 商品分类</span></a></dd>
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('gift_category/lst'); ?>"  data-icon="&#xe658;" data-title="商品分类" data-id="51"><i class="fa fa-life-buoy"></i><span> 礼品分类</span></a></dd>
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('spec_group/lst'); ?>"  data-icon="&#xe658;" data-title="商品类型" data-id="52"><i class="fa fa-magic"></i><span> 商品类型</span></a></dd>
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('spec_param/lst'); ?>"  data-icon="&#xe658;" data-title="商品属性" data-id="53"><i class="fa fa-microchip"></i><span> 商品属性</span></a></dd>
                    <dd><a href="javascript:;" kit-target data-url="<?php echo url('product/lst'); ?>"  data-icon="&#xe658;" data-title="商品" data-id="54"><i class="fa fa-id-badge"></i><span> 商品</span></a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-user" aria-hidden="true"></i><span> 会员管理</span></a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('category/lst'); ?>"  data-icon="&#xe658;" data-title="会员列表" data-id="61"><i class="fa fa-navicon"></i><span> 会员列表</span></a></dd>
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('MemberLevel/lst'); ?>"  data-icon="&#xe658;" data-title="会员级别" data-id="62"><i class="fa fa-paper-plane"></i><span> 会员级别</span></a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;" data-url="<?php echo url('recpos/lst'); ?>" data-name="table"  data-icon="&#xe658;" data-title="推荐位" data-id="81" kit-target><i class="fa fa-thumbs-up" aria-hidden="true"></i><span> 推荐位</span></a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-magnet" aria-hidden="true"></i><span> 轮播</span></a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('banner/lst'); ?>"  data-icon="&#xe658;" data-title="轮播位" data-id="101"><i class="fa fa-map-pin"></i><span> 轮播位</span></a></dd>
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('banner_item/lst'); ?>"  data-icon="&#xe658;" data-title="轮播" data-id="52"><i class="fa fa-podcast"></i><span> 轮播</span></a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-map-o" aria-hidden="true"></i><span> 订单</span></a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('order/index'); ?>"  data-icon="&#xe658;" data-title="订单列表" data-id="201"><i class="fa fa-motorcycle"></i><span> 订单列表</span></a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-pencil-square" aria-hidden="true"></i><span> 优惠券</span></a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" kit-target data-url="<?php echo url('coupons/lst'); ?>"  data-icon="&#xe658;" data-title="优惠券列表" data-id="301"><i class="fa fa-reorder"></i><span> 优惠券列表</span></a></dd>
                </dl>
            </li>
<!--            layui-nav-itemed-->
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-signing" aria-hidden="true"></i><span> 权限管理</span></a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('user_cms/lst'); ?>"  data-icon="&#xe658;" data-title="用户管理" data-id="601"><i class="fa fa-user"></i><span> 用户管理</span></a></dd>
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('auth_group/lst'); ?>"  data-icon="&#xe658;" data-title="分组管理" data-id="602"><i class="fa fa-users"></i><span> 分组管理</span></a></dd>
                    <dd><a href="javascript:;" kit-target  data-url="<?php echo url('auth_rule/lst'); ?>"  data-icon="&#xe658;" data-title="规则" data-id="603"><i class="fa fa-sitemap"></i><span> 规则</span></a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
        <div class="layui-body" id="container">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">主体内容加载中,请稍等...</div>
        </div>

        <div class="layui-footer">
            <!-- 底部固定区域 -->
            2019 &copy;
            <a href="http://yue.mgoi.net">yue.mgoi.net</a> MIT license

        </div>
    </div>

    <script type="text/javascript" src="/static/admin/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/common.js"></script>
    <script>
        var message;
        layui.config({
            base: '/static/admin/js/'
        }).use(['app', 'message'], function() {
            var app = layui.app,
                $ = layui.jquery,
                layer = layui.layer;
            //将message设置为全局以便子页面调用
            message = layui.message;
            //主入口
            app.set({
                type: 'iframe'
            }).init();
            $('#pay').on('click', function() {
                layer.open({
                    title: false,
                    type: 1,
                    content: '<img src="/static/admin/images/pay.png" />',
                    area: ['500px', '250px'],
                    shadeClose: true
                });
            });
        });
    </script>
</body>

</html>