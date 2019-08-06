<?php /*a:3:{s:84:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\coupons\lst.html";i:1562989838;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
	    <div class="layui-tab">
            <blockquote class="layui-elem-quote news_search">
		
		<div class="layui-inline" onclick="add('添加优惠券','<?php echo url('add'); ?>')">
			<a class="layui-btn layui-btn-normal newsAdd_btn">添加优惠券</a>
		</div>
		<div class="layui-inline" onclick="delMore()">
			<a class="layui-btn layui-btn-danger batchDel">批量删除</a>
		</div>
	</blockquote>
            
		         <!-- 操作日志 -->
                <div class="layui-form news_list">
                     <table class="layui-table">
                        <colgroup>
                            <col width="10">
                            <col width="30">
                            <col width="200">
                            <col width="200">
                            <col width="200">
                            <col width="200">
                            <col width="200">
                            <col width="200">
                            <col width="200">
                            <col width="200">
                            <col width="300">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: center;"><input name="" lay-skin="primary" lay-filter="allChoose" id="allChoose" type="checkbox">
                                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div>
                                </th>
                                <th>id</th>
                                <th style="text-align: left;">优惠券标题</th>
                                <th>库存</th>
                                <th>已领取</th>
                                <th>优惠条件</th>
                                <th>减免价格</th>
                                <th>开始日期</th>
                                <th>截止日期</th>
                                <th>描述</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody class="news_content list-box-body">
                            <?php if(is_array($couponsData) || $couponsData instanceof \think\Collection || $couponsData instanceof \think\Paginator): $i = 0; $__LIST__ = $couponsData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center"><input name="checked" data-id="<?php echo htmlentities($coupon['id']); ?>" lay-skin="primary" lay-filter="choose" type="checkbox">
                                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div>
                                </td>
                                <td><?php echo htmlentities($coupon['id']); ?></td>
                                <td><?php echo htmlentities($coupon['name']); ?></td>
                                <td align="center"><?php echo htmlentities($coupon['num']); ?></td>
                                <td align="center"><?php echo htmlentities($coupon['taken_num']); ?></td>
                                <td align="center"><?php echo htmlentities($coupon['least_cost']); ?></td>
                                <td align="center"><?php echo htmlentities($coupon['reduce_cost']); ?></td>
                                <td align="center"><?php echo htmlentities(date("Y-m-d",!is_numeric($coupon['start_date'])? strtotime($coupon['start_date']) : $coupon['start_date'])); ?></td>
                                <td align="center"><?php echo htmlentities(date("Y-m-d",!is_numeric($coupon['end_date'])? strtotime($coupon['end_date']) : $coupon['end_date'])); ?></td>
                                <td><?php echo htmlentities($coupon['description']); ?></td>
                                <td align="center">
                                    <a class="layui-btn layui-btn-mini tb_edit" onclick="editFull('编辑品牌','<?php echo url('edit',['id'=>$coupon['id']]); ?>')"><i class="fa fa-pencil fa-fw"></i> 编辑</a>
                                    <?php if($coupon['status'] == 1): ?>
                                    <a class="layui-btn layui-btn-danger layui-btn-mini tb_del" onclick="product_del(this,<?php echo htmlentities($coupon['id']); ?>)"><i class="layui-icon"></i> 禁用</a>
                                    <?php else: ?>
                                    <span class="layui-btn layui-btn-warm layui-btn-mini tb_del"><i class="layui-icon"></i>已禁用</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                     </table>
                     <div class="larry-table-page clearfix">
                          <div class="paging">
                              <?php echo htmlentities($couponsData->render()); ?>
                          </div>
                     </div>
			    </div>

		    </div>
		</div>
	
</section>

<script type="text/javascript" src="/static/admin/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/common.js"></script>

<script type="text/javascript">
    /*产品-删除*/
    function product_del(obj,id){
        var url = "<?php echo url('del'); ?>?id="+id;
        layer.confirm('确认要禁用吗？',function(index){
            $.ajax({
                type: 'get',
                url: url,
                success: function(data){
                    layer.msg('已禁用!',{icon:1,time:1000});
                    window.location = '<?php echo url("lst"); ?>';
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }


    function delMore() {
        var idsArr = getCheckedId().idsArr;
        var $checkDoms = getCheckedId().checkDoms;
        reqChangeStutas({
            idsArr: idsArr,
            url:"<?php echo url('del'); ?>",
            msgTip:'请先选择要删除的产品!',
            confirmTip:'确认要删除吗？',
            sCallback: function(data){
                console.log(data);
                $checkDoms.each(function(index,item){
                    $(item).parents('tr').remove();
                });
                layer.msg('已删除!',{icon:1,time:1000});
            }
        });
    }

    function getCheckedId() {
        var $checkDoms = $('.list-box-body').find('input[type="checkbox"][name="checked"]:checked');
        var idsArr = [];
        $checkDoms.each(function (index,item) {
            idsArr.push($(item).data('id'));
        });
        return {
            idsArr:idsArr,
            checkDoms:$checkDoms
        };
    }
    
    function reqChangeStutas(opts) {
        var idsArr = opts.idsArr || [];
        if(idsArr.length == 0){
            layer.msg(opts.msgTip||'请先选择',{icon:1,time:1500});
            return false;
        }
        layer.confirm(opts.confirmTip||'确认吗？',function(index){
            console.log(index);
            $.ajax({
                url: opts.url,
                type: opts.method || "POST",
                data: {idsArr:idsArr},
                success: function(data){
                    opts.sCallback && opts.sCallback(data);
                },
                error:function(data) {
                    opts.eCallback && opts.eCallback(data);
                }
            });
        });
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