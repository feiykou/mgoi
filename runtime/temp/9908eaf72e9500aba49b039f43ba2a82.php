<?php /*a:3:{s:89:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\banner_item\list.html";i:1562988835;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
    <form action="" method="post">
	<div class="larry-personal">
	    <div class="layui-tab">
            <blockquote class="layui-elem-quote news_search">
                <div class="layui-inline" onclick="add('添加轮播','<?php echo url('add'); ?>')">
                    <a class="layui-btn layui-btn-normal newsAdd_btn">添加轮播</a>
                </div>
                <div class="layui-form layui-inline" style="padding: 0 0 0 30px; font-size: 14px; background-color: transparent;">
                    <div class="layui-inline">
                        <select name="banner_id" lay-filter="sel-bannerBit-filter">
                            <option value="">请选择</option>
                            <?php if(is_array($bannerBitDatas) || $bannerBitDatas instanceof \think\Collection || $bannerBitDatas instanceof \think\Paginator): $i = 0; $__LIST__ = $bannerBitDatas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bannerBit): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($bannerBit['id']); ?>" <?php if(isset($bannerBitArr['id']) && $bannerBit['id'] == $bannerBitArr['id']): ?>selected<?php endif; ?>><?php echo htmlentities($bannerBit['name']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <!--isset($bannerBitArr['banner_id']) &&-->
                </div>
            </blockquote>
            <!-- 操作日志 -->
            <div class="layui-form news_list">
                 <table class="layui-table">
                    <thead>
                        <tr>
                            <th width="30">ID</th>
                            <th>轮播图名称</th>
                            <th>封面图</th>
                            <th>轮播图类型</th>
                            <th>跳转类型</th>
                            <th>跳转类型id</th>
                            <th>轮播图位</th>
                            <th width="100">排序</th>
                            <th width="200">操作</th>
                        </tr>
                    </thead>
                    <tbody class="news_content list-box-body">
                        <?php if(is_array($bannerItemData) || $bannerItemData instanceof \think\Collection || $bannerItemData instanceof \think\Paginator): $i = 0; $__LIST__ = $bannerItemData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td align="center"><?php echo htmlentities($data['id']); ?></td>
                            <td align="center"><?php echo htmlentities($data['name']); ?></td>
                            <td align="center"><a href="/upload/images/<?php echo htmlentities($data['img_url']); ?>"><img src="/upload/images/<?php echo htmlentities($data['img_url']); ?>" alt=""></a></td>
                            <td align="center">
                                <?php switch($data['url_type']): case "2": ?>视频<?php break; default: ?> 图片
                                <?php endswitch; ?>
                            </td>
                            <td align="center"><?php echo htmlentities($typeArr[$data['type']]); ?></td>
                            <td align="center"><?php if($data['key_word'] != ''): ?><?php echo htmlentities($data['key_word']); else: ?>暂无<?php endif; ?></td>
                            <td align="center"> <?php if(isset($bannerBitArr['name'])): ?><?php echo htmlentities($bannerBitArr['name']); else: ?>未定义轮播位<?php endif; ?> </td>

                            <td align="center" class="tc tb-sort">
                                <input type="input" name="sort[<?php echo htmlentities($data['id']); ?>]" value="<?php echo htmlentities($data['sort']); ?>" autocomplete="off" class="layui-input">
                            </td>
                            <td align="center">
                                <a class="layui-btn layui-btn-mini tb_edit" onclick="edit('编辑轮播图','<?php echo url('edit',['id'=>$data['id']]); ?>')"><i class="fa fa-pencil fa-fw"></i> 编辑</a>
                                <a class="layui-btn layui-btn-danger layui-btn-mini tb_del" onclick="product_del(this,<?php echo htmlentities($data->id); ?>)"><i class="layui-icon"></i> 删除</a>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <tr class="sort-tr-wrap none">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
		</div>
	</div>
    </form>
	
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

        form.on('select(sel-bannerBit-filter)',function (data) {
            window.location = "<?php echo url('lst'); ?>?banner_id="+data.value;
        });

    });
</script>
</body>
</html>