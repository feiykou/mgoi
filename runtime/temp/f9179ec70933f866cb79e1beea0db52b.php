<?php /*a:3:{s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\user_cms\edit.html";i:1563261354;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
    <!--引入webuploaderCss-->
    <link href="/static/admin/plugins/webuploader/webuploader.css" rel="stylesheet">

    <style>
        .form-container{ padding-top: 30px;}
        .layui-tab{ padding: 0 30px; }
        .layui-tab-item{ padding: 30px 0; }
    </style>
</head>

<body>
<div class="form-container">
    <form class="layui-form" action="">
        <input type="hidden" name="id" value="<?php echo htmlentities($editData['id']); ?>">
        <div class="layui-tab layui-form">
            <ul class="layui-tab-title">
                <li class="layui-this">修改信息</li>
                <li>修改密码</li>
            </ul>
            <div class="layui-tab-content product-add-content">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form-item">
                        <label class="layui-form-label">所属用户组</label>
                        <div class="layui-inline">
                            <select name="group_id" lay-verify="required">
                                <?php if(is_array($groupData) || $groupData instanceof \think\Collection || $groupData instanceof \think\Paginator): $key = 0; $__LIST__ = $groupData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($key % 2 );++$key;?>
                                <option value="<?php echo htmlentities($data['id']); ?>" <?php if($editData['auth_group_access']['group_id'] == $data['id']): ?>selected<?php endif; ?>><?php echo htmlentities($data['name']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-col-xs6">
                            <input type="text" name="name" lay-verify="name" value="<?php echo htmlentities($editData['name']); ?>" autocomplete="off" placeholder="用户名" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item">
                    <div class="layui-form-item">
                        <label class="layui-form-label">密码</label>
                        <div class="layui-col-xs6">
                            <input type="password" name="password" lay-verify="pass" autocomplete="off" placeholder="密码" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">确认密码</label>
                        <div class="layui-col-xs6">
                            <input type="password" name="repassword" lay-verify="pass" autocomplete="off" placeholder="确认密码" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </form>
</div>

<script type="text/javascript" src="/static/admin/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery.js"></script>
<script src="/static/admin/js/common.js"></script>
<!--引入webuploaderJS-->
<script type="text/javascript" src="/static/admin/plugins/webuploader/webuploader.js"></script><script type="text/javascript" src="/static/admin/plugins/webuploader/feiy_upload.js"></script>

<script>
    layui.use(['form', 'layedit', 'laydate','element'], function() {
        var form = layui.form,
            element = layui.element,
            layer = layui.layer;

        //自定义验证规则
        form.verify({
            name: function(value) {
                if (value.length < 2) {
                    return '标题至少得2个字符啊';
                }
            },
            pass: function (value) {
                if(value && !/^[\S]{6,12}$/.test(value)){
                    return '密码必须是6-12位';
                }
            }
        });

        //监听提交
        form.on('submit(demo1)', function(data) {
            var formDom = data.form;
            $.ajax({
                url: "<?php echo url('save'); ?>",
                type: "post",
                data: $(formDom).serialize(),
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