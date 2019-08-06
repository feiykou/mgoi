<?php /*a:3:{s:91:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\theme_category\add.html";i:1562983685;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
            <div class="layui-form-item">
                <label class="layui-form-label">选择框</label>
                <div class="layui-inline">
                    <select name="pid" lay-verify="required">
                        <option value="0">顶级分类</option>
                        <?php if(is_array($CategoryRes) || $CategoryRes instanceof \think\Collection || $CategoryRes instanceof \think\Paginator): $i = 0; $__LIST__ = $CategoryRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resData): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities($resData['id']); ?>"><?php if($resData['pid'] != 0): ?>┞<?php endif; ?><?php echo htmlentities(str_repeat('┄',$resData['level']*2)); ?><?php echo htmlentities($resData['name']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">分类名称</label>
                <div class="layui-col-xs4">
                    <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">推荐位</label>
                <div class="layui-input-block">
                    <?php if(is_array($productRecposRes) || $productRecposRes instanceof \think\Collection || $productRecposRes instanceof \think\Paginator): $i = 0; $__LIST__ = $productRecposRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$recpos): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="recpos[]" value="<?php echo htmlentities($recpos['id']); ?>" lay-skin="primary" title="<?php echo htmlentities($recpos['name']); ?>"><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary"><span><?php echo htmlentities($recpos['name']); ?></span><i class="layui-icon"></i></div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">显示到导航</label>
                <div class="layui-input-block">
                    <input type="radio" name="show_cate" value="1" title="是">
                    <input type="radio" name="show_cate" value="0" title="否" checked="">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">上传图片</label>
                <div class="layui-input-block upload-img-wrap">
                                <div id="uploader" class="uploader-item">
                <div class="uploader_btns">
                    <div class="filePicker"></div><div class="uploadBtn">上传图片</div>
                </div>
                <!--用来存放item-->
                <div class="queueList"></div>
            </div>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">关键词</label>
                <div class="layui-col-xs6">
                    <textarea placeholder="请输入关键词内容" name="keywords" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-col-xs6">
                    <textarea placeholder="请输入描述内容" name="description" class="layui-textarea"></textarea>
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
    <!--引入webuploaderJS-->
    <script type="text/javascript" src="/static/admin/plugins/webuploader/webuploader.js"></script><script type="text/javascript" src="/static/admin/plugins/webuploader/feiy_upload.js"></script>
    <script>
        var config = {
            "upload_server": "<?php echo url('uploadImg'); ?>"
        };

        feiy_upload.init({
            server: config.upload_server,
            fileNumLimit: 2
        });
    </script>
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
                var cate_img_lists = $("#uploader .filelist > li");
                var cate_img_url = setUpdateUrl(cate_img_lists);
                var params = "&cate_img="+cate_img_url;1
                $.ajax({
                    url: "<?php echo url('save'); ?>",
                    type: "post",
                    data: $(formDom).serialize()+params,
                    success: function(res){
                        console.log(res)
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