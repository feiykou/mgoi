<?php /*a:3:{s:84:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\coupons\add.html";i:1562990044;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
            <div class="layui-form-item">
                <label class="layui-form-label">优惠劵标题</label>
                <div class="layui-col-xs4">
                    <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="优惠劵标题" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">库存</label>
                <div class="layui-col-xs2">
                    <input type="text" name="num" lay-verify="required|number" autocomplete="off" placeholder="库存量" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">优惠条件</label>
                <div class="layui-col-xs4">
                    <input type="text" name="least_cost" lay-verify="required|number" autocomplete="off" placeholder="优惠条件" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">减免价格</label>
                <div class="layui-col-xs4">
                    <input type="text" name="reduce_cost" lay-verify="required|number" autocomplete="off" placeholder="减免价格" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">开始日期</label>
                <div class="layui-col-xs4">
                    <input type="text" name="start_date" id="date1" lay-verify="required|date" autocomplete="off" placeholder="开始时间" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">结束日期</label>
                <div class="layui-col-xs4">
                    <input type="text" name="end_date" id="date2" lay-verify="required|date" autocomplete="off" placeholder="结束时间" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">跳转链接</label>
                <div class="layui-col-xs6">
                    <input type="text" name="url" autocomplete="off" placeholder="跳转链接" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">优惠券说明</label>
                <div class="layui-col-xs6">
                    <textarea placeholder="优惠券说明" name="description" class="layui-textarea"></textarea>
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
                layer = layui.layer,
                laydate = layui.laydate;

            laydate.render({
                elem: '#date1'
            });
            laydate.render({
                elem: '#date2'
            });

            //自定义验证规则
            form.verify({
                name: function(value) {
                    if (value.length < 2) {
                        return '标题至少得2个字符啊';
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