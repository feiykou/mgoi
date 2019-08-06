<?php /*a:3:{s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\category\list.html";i:1562983728;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
		
		<div class="layui-inline" onclick="add('添加商品分类','<?php echo url('add'); ?>')">
			<a class="layui-btn layui-btn-normal newsAdd_btn">添加商品分类</a>
		</div>
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的文章外所有操作无效，关闭页面所有数据重置</div>
		</div>
	</blockquote>
            <form action="lst?XDEBUG_SESSION_START=11472" method="post">
		         <!-- 操作日志 -->
                <div class="layui-form news_list">
                     <table class="layui-table">
                        <thead>
                            <tr>
                                <th width="30">ID</th>
                                <th>分类名称</th>
                                <th width="100">显示到导航栏</th>
                                <th width="100">排序</th>
                                <th width="200">操作</th>
                            </tr>
                        </thead>
                        <tbody class="news_content list-box-body">
                            <?php if(is_array($tbData) || $tbData instanceof \think\Collection || $tbData instanceof \think\Paginator): $i = 0; $__LIST__ = $tbData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center"><?php echo htmlentities($data['id']); ?></td>
                                <td><?php if($data['pid'] != 0): ?>┞<?php endif; ?><?php echo htmlentities(str_repeat('┄',$data['level']*2)); ?><?php echo htmlentities($data['name']); ?></td>
                                <td align="center"><input data-url="<?php echo url('status',['id'=>$data->id]); ?>" data-status="show_cate" lay-skin="switch" lay-text="" lay-filter="isShow" type="checkbox" <?php if($data['show_cate'] == 1): ?>checked<?php endif; ?>>
                                    <div class="layui-unselect layui-form-switch" lay-skin="_switch"><em></em><i></i></div>
                                </td>
                                <td align="center" class="tc tb-sort">
                                    <input type="input" data-url="<?php echo url('status',['id'=>$data->id]); ?>" name="sort[<?php echo htmlentities($data['id']); ?>]" value="<?php echo htmlentities($data['sort']); ?>" autocomplete="off" class="layui-input">
                                </td>
                                <td align="center">
                                    <a class="layui-btn layui-btn-mini tb_edit" onclick="edit('编辑分类','<?php echo url('edit',['id'=>$data['id']]); ?>')"><i class="fa fa-pencil fa-fw"></i> 编辑</a>
                                    <a class="layui-btn layui-btn-danger layui-btn-mini tb_del" onclick="product_del(this,<?php echo htmlentities($data->id); ?>)"><i class="layui-icon"></i> 删除</a>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr class="sort-tr-wrap none">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="center"><button type="submit" class="layui-btn layui-btn-mini">排序</button></td>
                                <td></td>
                            </tr>
                        </tbody>
                     </table>

                     <div class="larry-table-page clearfix">
                          <div class="paging">
                          </div>
                     </div>
			    </div>
            </form>
		    </div>
		</div>
	
</section>

<script type="text/javascript" src="/static/admin/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/common.js"></script>

<script type="text/javascript">

    $(function(){
        if($(".list-box-body tr").length <= 1){
            $(".sort-tr-wrap").hide();
        }else{
            $(".sort-tr-wrap").show();
        }
    });


    /*产品-删除*/
    function product_del(obj,id){
        var url = "<?php echo url('del'); ?>?id="+id+"&XDEBUG_SESSION_START=11511";
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'get',
                url: url,
                success: function(data){
                    if(data.code == 1){
                        layer.close(index);
                        layer.msg('已删除!',{icon:1,time:1000});
                        window.location = "<?php echo url('lst'); ?>";
                    }
                },
                error:function(data) {
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