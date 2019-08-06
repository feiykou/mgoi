<?php /*a:3:{s:84:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\order\index.html";i:1548325508;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="/static/admin/css/global.css" media="all">
<link rel="stylesheet" href="/static/admin/plugins/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/static/admin/css/style.css" media="all">
    <title>个人信息</title>
    <link rel="stylesheet" type="text/css" href="/static/admin/css/personal.css" media="all">
</head>
<body>
<section class="layui-larry-box">
    <div class="larry-personal">
        <blockquote class="layui-elem-quote news_search">
            <div class="layui-inline" onclick="getStatusOrder(this)" data-status="-1">
                <a class="layui-btn layui-btn-danger newsAdd_btn">查看全部</a>
            </div>
            <div class="layui-inline" onclick="getStatusOrder(this)" data-status="1">
                <a class="layui-btn layui-btn-danger newsAdd_btn">未支付</a>
            </div>
            <div class="layui-inline" onclick="getStatusOrder(this)" data-status="2">
                <a class="layui-btn layui-btn-normal newsAdd_btn">已支付</a>
            </div>
            <div class="layui-inline" onclick="getStatusOrder(this)" data-status="4">
                <a class="layui-btn layui-btn-normal newsAdd_btn">已支付，库存不足</a>
            </div>
            <div class="layui-inline" onclick="getStatusOrder(this)" data-status="3">
                <a class="layui-btn newsAdd_btn">待收货</a>
            </div>
            <div class="layui-inline" onclick="getStatusOrder(this)" data-status="7">
                <a class="layui-btn layui-btn-warm newsAdd_btn">已签收</a>
            </div>
            <div class="layui-inline" onclick="getStatusOrder(this)" data-status="8">
                <a class="layui-btn newsAdd_btn">已评价</a>
            </div>
        </blockquote>
        <div class="layui-tab">
            <!--<form action="">-->
                <!-- 操作日志 -->
                <div class="layui-form news_list">
                    <table class="layui-table">
                        <thead>
                        <tr>
                            <th width="200">id</th>
                            <th width="200">订单号</th>
                            <th>商品名称</th>
                            <th width="60">商品总数</th>
                            <th width="80">商品总价格</th>
                            <th width="100">订单状态</th>
                            <th width="200">下单时间</th>
                            <th width="100">操作</th>
                        </tr>
                        </thead>
                        <tbody class="news_content list-box-body">
                        <?php if(is_array($orderData) || $orderData instanceof \think\Collection || $orderData instanceof \think\Paginator): $i = 0; $__LIST__ = $orderData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td align="center"><?php echo htmlentities($order['id']); ?></td>
                            <td align="center"><?php echo htmlentities($order['order_no']); ?></td>
                            <td><?php echo htmlentities($order['snap_name']); ?><span style="color:#666;">（<?php echo htmlentities($order['snap_prop_val']); ?>）</span></td>
                            <td align="center"><?php echo htmlentities($order['total_count']); ?></td>
                            <td align="center"><?php echo htmlentities($order['total_price']); ?></td>
                            <td align="center" class="status-item"><?php echo orderStatus($order['status']); ?></td>
                            <td align="center"><?php echo htmlentities($order['create_time']); ?></td>
                            <td align="center">
                                <?php if($order['status'] != 1): if($order['status'] == 3):?>
                                        <a class='layui-btn layui-btn-small layui-btn-normal'>查看物流</a>
                                    <?php elseif($order['status'] == 2 || $order['status'] == 4):?>
                                        <a class="layui-btn layui-btn-mini tb_edit" data-id="<?php echo htmlentities($order['id']); ?>" onclick="delivery(this)"><i class="fa fa-pencil fa-fw"></i>发货</a>
                                    <?php elseif($order['status'] == 8):?>
                                    <a class='layui-btn layui-btn-small layui-btn-normal'>查看评价</a>
                                <?php endif;?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>

                    <div class="larry-table-page clearfix">
                        <div class="paging">
                            <?php echo htmlentities($orderData->render()); ?>
                        </div>
                    </div>
                </div>
            <!--</form>-->
        </div>
    </div>

</section>

<script type="text/javascript" src="/static/admin/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/common.js"></script>
<script src="/static/admin/js/reqApiCommon.js"></script>
<script type="text/javascript">

    function getStatusOrder(obj) {
        var status = $(obj).data('status');
        window.location = '<?php echo url("index"); ?>?status='+status;
    }


    // 发货
    function delivery(obj) {
       var orderID = $(obj).data('id');
       var index = layer.load(2);
       var params = {
           url: 'order/delivery',
           type: 'put',
           data: {id:orderID},
           sCallback: function (res) {
               layer.close(index);
               if(res.code.toString().indexOf('2') == 0){
                  $(obj).parents('tr').find('.status-item span')
                      .removeClass()
                      .addClass('layui-btn layui-btn-small layui-btn-normal')
                      .html('已发货');
                   $(obj).html('<a class="layui-btn layui-btn-small layui-btn-normal">查看物流</a>');
                   layer.msg('操作成功!',{icon:1,time:1000});
               }else{
                   if(res.msg){
                       layer.msg(res.msg,{icon:1,time:1000});
                   }else{
                       layer.msg('操作失败!',{icon:1,time:1000});
                   }

               }
           },
           eCallback:function(){
               layer.close(index);
               layer.msg('操作失败!',{icon:1,time:1000});
           }
       };

       window.base.getData(params)
    }

    layui.config({
        base: '/static/admin/js/'
    }).use(['form','layer','element','laypage'],function(){
        window.layer = layui.layer;
        var element = layui.element,
            form = layui.form;

    });
</script>
</body>
</html>