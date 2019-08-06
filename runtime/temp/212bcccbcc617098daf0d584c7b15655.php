<?php /*a:3:{s:90:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\member_level\list.html";i:1562987175;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
		
		<div class="layui-inline" onclick="add('添加会员级别','<?php echo url('add'); ?>')">
			<a class="layui-btn layui-btn-normal newsAdd_btn">添加会员级别</a>
		</div>
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的文章外所有操作无效，关闭页面所有数据重置</div>
		</div>
	</blockquote>
            <form action="" method="post">
		         <!-- 操作日志 -->
                <div class="layui-form news_list">
                     <table class="layui-table">
                        <thead>
                            <tr>
                                <th width="30">ID</th>
                                <th>会员级别名称</th>
                                <th>级别积分下限</th>
                                <th>级别积分上限</th>
                                <th>级别折扣率</th>
                                <th width="300">操作</th>
                            </tr>
                        </thead>
                        <tbody class="news_content list-box-body">
                            <?php if(is_array($tbData) || $tbData instanceof \think\Collection || $tbData instanceof \think\Paginator): $i = 0; $__LIST__ = $tbData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center"><?php echo htmlentities($data['id']); ?></td>
                                <td align="center"><?php echo htmlentities($data['name']); ?></td>
                                <td align="center"><?php echo htmlentities($data['bom_point']); ?></td>
                                <td align="center"><?php echo htmlentities($data['top_point']); ?></td>
                                <td align="center"><?php echo htmlentities($data['rate']); ?></td>
                                <td align="center">
                                    <a class="layui-btn layui-btn-mini tb_edit" onclick="edit('编辑分类','<?php echo url('edit',['id'=>$data['id']]); ?>')"><i class="fa fa-pencil fa-fw"></i> 编辑</a>
                                    <a class="layui-btn layui-btn-danger layui-btn-mini tb_del" onclick="product_del(this,<?php echo htmlentities($data->id); ?>)"><i class="layui-icon"></i> 删除</a>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
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
        var url = "<?php echo url('del'); ?>?id="+id;
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'get',
                url: url,
                success: function(data){
                    console.log(data);
                    if(data.code == 1){
                        layer.close(index);
                        layer.msg('已删除!',{icon:1,time:1000});
                        window.location = "<?php echo url('lst'); ?>";
                    }
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