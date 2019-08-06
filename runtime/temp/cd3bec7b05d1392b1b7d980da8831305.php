<?php /*a:3:{s:88:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\spec_param\edit.html";i:1563880381;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
    </style>
</head>

<body>
<div class="form-container">
    <form class="layui-form" action="">
        <input type="hidden" value="<?php echo htmlentities($editData['id']); ?>" name="id">
        <div class="layui-form-item">
            <label class="layui-form-label">父级分类</label>
            <div class="layui-inline">
                <select name="spg_id" lay-verify="required">
                    <option value="0">顶级分类</option>
                    <?php if(is_array($categoryRes) || $categoryRes instanceof \think\Collection || $categoryRes instanceof \think\Paginator): $i = 0; $__LIST__ = $categoryRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resData): $mod = ($i % 2 );++$i;?>
                    <option <?php if($editData['spg_id'] == $resData['id']): ?>selected <?php endif; if(isset($groupId) && $groupId != $resData['id']): ?>disabled=""<?php endif; ?>  value='<?php echo htmlentities($resData['id']); ?>'><?php echo htmlentities($resData['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">属性名称</label>
            <div class="layui-col-xs4">
                <input type="text" name="name" value="<?php echo htmlentities($editData['name']); ?>" lay-verify="name" autocomplete="off" placeholder="请输入属性名称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">属性类型</label>
            <div class="layui-col-xs4">
                <input type="radio" name="type" value="1" title="单选" <?php if($editData['type'] == 1): ?>checked<?php endif; ?>>
                <input type="radio" name="type" value="2" title="唯一" <?php if($editData['type'] == 2): ?>checked<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">属性值</label>
            <div class="layui-col-md4 layui-col-sm6">
                <textarea placeholder="请输入属性值（多个值以'，'逗号分开）" lay-verify="segements" name="segements" class="layui-textarea"><?php echo htmlentities($editData['segements']); ?></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">属性值单位</label>
            <div class="layui-col-md2 layui-col-sm3">
                <input type="text" name="unit" autocomplete="off" value="<?php echo htmlentities($editData['unit']); ?>" placeholder="属性值单位" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item switch-item">
            <label class="layui-form-label">添加图片</label>
            <div class="layui-input-block">
                <input type="checkbox" name="is_add_img" lay-skin="switch" value="1" lay-text="OFF|NO" <?php if($editData['is_add_img'] == 1): ?>checked<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item switch-item">
            <label class="layui-form-label">可搜索</label>
            <div class="layui-input-block">
                <input type="checkbox" name="searching" lay-skin="switch" value="1" lay-text="OFF|NO" <?php if($editData['searching'] == 1): ?>checked<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item switch-item">
            <label class="layui-form-label">参数是否为数字</label>
            <div class="layui-input-block">
                <input type="checkbox" name="numeric" lay-skin="switch" value="1" lay-text="OFF|NO" <?php if($editData['numeric'] == 1): ?>checked<?php endif; ?>>
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
    layui.use(['form', 'layedit', 'laydate'], function() {
        var form = layui.form,
            layer = layui.layer;

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
            $.ajax({
                url: "<?php echo url('save'); ?>",
                type: "post",
                data: $(formDom).serialize(),
                success: function(res){
                    var msgParams = {
                        iconNum: 6,
                        anim: 0
                    };
                    if(res.code == 0){
                        msgParams.iconNum = 5;
                        msgParams.anim = 6;
                    }
                    layer.msg(res.msg, {icon: msgParams.iconNum,time:1000,anim:msgParams.anim});
                    setTimeout(function(){
                        if(res.data){
                            parent.window.location = res.data;
                        }
                    },1000);
                }
            });


            return false;
        });


    });
</script>

</body>

</html>