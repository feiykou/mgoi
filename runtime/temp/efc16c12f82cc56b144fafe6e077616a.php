<?php /*a:3:{s:83:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\theme\list.html";i:1562985918;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
		
		<div class="layui-inline" onclick="add('添加主题','<?php echo url('add'); ?>',true)">
			<a class="layui-btn layui-btn-normal newsAdd_btn">添加主题</a>
		</div>
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux"></div>
		</div>
	</blockquote>
            <form action="" method="post">
                <input type="hidden" name="req_type" value="lst">
		         <!-- 操作日志 -->
                <div class="layui-form news_list">
                     <table class="layui-table">
                        <thead>
                            <tr>
                                <th width="30">ID</th>
                                <th width="174">主题名称</th>
                                <th width="100">封面图</th>
                                <th width="100">主题头图</th>
                                <th>描述</th>
                                <th width="100">上架</th>
                                <th width="200">推荐位</th>
                                <th>排序</th>
                                <th width="240">操作</th>
                            </tr>
                        </thead>
                        <tbody class="news_content list-box-body">
                            <?php if(is_array($themeData) || $themeData instanceof \think\Collection || $themeData instanceof \think\Paginator): $i = 0; $__LIST__ = $themeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center"><?php echo htmlentities($data['id']); ?></td>
                                <td align="center"><?php echo htmlentities($data['name']); ?></td>
                                <td align="center"><?php if($data['main_img_url'] != ''): ?><a target="_blank" href="/upload/images/<?php echo htmlentities($data['main_img_url']); ?>"><img src="/upload/images/<?php echo htmlentities($data['main_img_url']); ?>" height="30"></a><?php else: ?>暂无封面图<?php endif; ?></td>
                                <td align="center"><?php if($data['head_img_url'] != ''): ?><a target="_blank" href="/upload/images/<?php echo htmlentities($data['head_img_url']); ?>"><img src="/upload/images/<?php echo htmlentities($data['head_img_url']); ?>" height="30"></a><?php else: ?>暂无头图<?php endif; ?></td>
                                <td align="center"><?php echo htmlentities($data['description']); ?></td>
                                <td align="center"><?php if($data['on_sale'] == 1): ?>已上架<?php else: ?>未上架<?php endif; ?></td>
                                <td align="center">
                                    <?php if(is_array($data['recpos']) || $data['recpos'] instanceof \think\Collection || $data['recpos'] instanceof \think\Paginator): $k = 0; $__LIST__ = $data['recpos'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$recpos): $mod = ($k % 2 );++$k;if($k < count($data['recpos'])): ?>
                                    <?php echo htmlentities($recpos['name']); ?>，<?php else: ?><?php echo htmlentities($recpos['name']); ?><?php endif; ?>
                                    <?php endforeach; endif; else: echo "" ;endif; ?></td>
                                <td align="center" class="tc tb-sort">
                                    <input type="input" name="sort[<?php echo htmlentities($data['id']); ?>]" value="<?php echo htmlentities($data['sort']); ?>" autocomplete="off" class="layui-input">
                                </td>
                                <td align="center">
                                    <a class="layui-btn layui-btn-mini tb_edit" onclick="editFull('编辑产品','<?php echo url('edit',['id'=>$data['id']]); ?>')"><i class="fa fa-pencil fa-fw"></i> 编辑</a>
                                    <a class="layui-btn layui-btn-danger layui-btn-mini tb_del" onclick="product_del(this,<?php echo htmlentities($data['id']); ?>)"><i class="layui-icon"></i> 删除</a>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr class="sort-tr-wrap none">
                                <td colspan="7"></td>
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