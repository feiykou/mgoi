<?php /*a:3:{s:88:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\auth_group\edit.html";i:1563265166;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="/static/admin/css/global.css" media="all">
<link rel="stylesheet" href="/static/admin/plugins/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/static/admin/css/style.css" media="all">
    <title>layui</title>
    <style>
        .form-container{ padding-top: 30px;}
    </style>
</head>

<body>
<div class="form-container">
    <form class="layui-form" action="">
        <input type="hidden" value="<?php echo htmlentities($editData['id']); ?>" name="id">
        <div class="layui-form-item">
            <label class="layui-form-label">用户组名</label>
            <div class="layui-col-xs4">
                <input type="text" name="name" lay-verify="require" value="<?php echo htmlentities($editData['name']); ?>" autocomplete="off" placeholder="用户组名" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">是否启用</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="是" <?php if($editData['status'] == 1): ?>checked<?php endif; ?>>
                <input type="radio" name="status" value="0" title="否" <?php if($editData['status'] == 0): ?>checked<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">选择权限</label>
            <div class="layui-input-block">
                <div id="LAY-auth-tree-index"></div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="/static/admin/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/common.js"></script>
<script>
    layui.config({
        base: '/static/admin/plugins/layui/lay/modules/',
    }).extend({
        authtree: 'authtree',
    });
    layui.use(['form', 'layedit', 'laydate', 'authtree'], function() {
        var form = layui.form,
            authtree = layui.authtree,
            layer = layui.layer;

        // 一般来说，权限数据是异步传递过来的
        $.ajax({
            url: "<?php echo url('getRuleIds',['id'=>$editData['id']]); ?>",
            dataType: 'json',
            success: function (data) {
                console.log(data)
                var resData = data.data
                var trees = resData.trees
                trees = authtree.listConvert(resData.trees, {
                    primaryKey: trees.id
                    ,startPid: 0
                    ,parentKey: trees.pid
                    ,nameKey: trees.name
                    ,valueKey: trees.id
                    ,checkedKey: resData.checkedId
                });
                // 如果后台返回的不是树结构，请使用 authtree.listConvert 转换
                authtree.render('#LAY-auth-tree-index', trees, {
                    inputname: 'authids[]',
                    layfilter: 'lay-check-auth',
                    autowidth: true
                });
            }
        });

        //自定义验证规则
        form.verify({
            name: function(value) {
                if (value.length < 2) {
                    return '标题至少得2个字符啊';
                }
            },
            content: function(value) {

            }
        });


        //监听提交
        form.on('submit(demo1)', function(data) {
            var formDom = data.form;
            var authids = authtree.getChecked('#LAY-auth-tree-index')
            authids = authids.join();
            console.log($(formDom).serialize())
            $.ajax({
                url: "<?php echo url('save'); ?>",
                type: "post",
                data: $(formDom).serialize()+'&rules='+authids,
                success: function(res){
                    var msgParams = {
                        iconNum: 6,
                        anim: 0
                    };
                    if(Number(res.code) == 0){
                        msgParams.iconNum = 5;
                        msgParams.anim = 0;
                    }else{
                        setTimeout(function(){
                            if(res.data){
                                parent.window.location = res.data;
                            }
                        },1000);
                    }

                    layer.msg(res.msg, {icon: msgParams.iconNum,time:1000,anim:msgParams.anim});
                }
            });


            return false;
        });


    });
</script>

</body>

</html>