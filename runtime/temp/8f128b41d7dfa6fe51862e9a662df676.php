<?php /*a:3:{s:89:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\banner_item\edit.html";i:1562988825;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
        <input type="hidden" name="id" value="<?php echo htmlentities($editData['id']); ?>">
        <div class="layui-form-item">
            <label class="layui-form-label">轮播图位置</label>
            <div class="layui-inline">
                <select name="banner_id" lay-verify="banner_bit">
                    <option value="0">请选择</option>
                    <?php if(is_array($bannerBit) || $bannerBit instanceof \think\Collection || $bannerBit instanceof \think\Paginator): $i = 0; $__LIST__ = $bannerBit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resData): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($resData['id']); ?>" <?php if($editData['banner_id'] == $resData['id']): ?>selected<?php endif; ?>><?php echo htmlentities($resData['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">轮播图标题</label>
            <div class="layui-col-xs4">
                <input type="text" name="name" lay-verify="name"  value="<?php echo htmlentities($editData['name']); ?>" autocomplete="off" placeholder="请输入轮播图标题" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">上传轮播图</label>
            <div class="layui-input-block upload-img-wrap">
                            <div id="uploader" class="uploader-item">
                <div class="uploader_btns">
                    <div class="filePicker"></div><div class="uploadBtn">上传轮播图</div>
                </div>
                <!--用来存放item-->
                <div class="queueList">
                <?php if($editData['img_url'] != ''): ?>
                <ul class="filelist filelist-exist clearfix">
                    <li class="state-complete" data-src="<?php echo htmlentities($editData['img_url']); ?>">
                        <p class="imgWrap"><img src="/upload/images/<?php echo htmlentities($editData['img_url']); ?>" width="110" height="110"></p>
                        <div class="file-panel"><span class="cancel">删除</span></div>
                        <span class="success"></span>
                    </li>
                </ul>
                <?php endif; ?>
                </div>
            </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">轮播图类型</label>
            <div class="layui-input-block banner-type-item">
                <input type="radio" lay-filter="radio-type-filter" name="url_type" value="1" title="图片" <?php if($editData['url_type'] == 1): ?>checked<?php endif; ?>>
                <input type="radio" lay-filter="radio-type-filter" name="url_type" value="2" title="视频" <?php if($editData['url_type'] == 2): ?>checked<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item upload-video <?php if($editData['url_type'] == 1): ?>none<?php endif; ?>">
            <label class="layui-form-label">上传视频</label>
            <div class="layui-input-block">
                <div class="layui-upload-drag">
                    <?php if($editData['video_url'] != ''): ?>
                    <div class="video-add-item none" id="videoItem" data-videosrc="<?php echo htmlentities($editData['video_url']); ?>">
                        <i class="layui-icon"></i>
                        <p>点击上传，或将文件拖拽到此处</p>
                    </div>
                    <div class="video-wrap pr">
                        <video controls id="videoattr" width="250" src="/upload/videos/<?php echo htmlentities($editData['video_url']); ?>" ></video>
                        <i class="video-close fa fa-window-close font16"></i>
                    </div>
                    <?php else: ?>
                    <div class="video-add-item" id="videoItem">
                        <i class="layui-icon"></i>
                        <p>点击上传，或将文件拖拽到此处</p>
                    </div>
                    <div class="video-wrap pr none">
                        <video controls id="videoattr" width="250" ></video>
                        <i class="video-close fa fa-window-close font16"></i>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">跳转类型</label>
            <div class="layui-input-block">
                <?php if(is_array($typeArr) || $typeArr instanceof \think\Collection || $typeArr instanceof \think\Paginator): $i = 0; $__LIST__ = $typeArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?>
                <input type="radio" lay-verify="typeVerify" <?php if($key == $editData['type']): ?>checked<?php endif; ?> name="type" value="<?php echo htmlentities($key); ?>" title="<?php echo htmlentities($type); ?>">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">跳转id</label>
            <div class="layui-col-xs2">
                <input type="text" name="key_word" lay-verify="key_word_verify" autocomplete="off" value="<?php echo htmlentities($editData['key_word']); ?>" placeholder="请输入跳转id" class="layui-input">
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
        "upload_server": "<?php echo url('uploadImg'); ?>",
        'video_upload_server': "<?php echo url('uploadVideo'); ?>"
    };

    feiy_upload.init({
        server: config.upload_server,
        fileNumLimit: 1
    });
</script>
<script>

    // 检查图片数量是否超过设置值，超出则禁止
    $(function () {
        checkUpload();
    });

    function checkUpload(){
        var logo_img = $("#uploader .filelist > li");
        setTimeout(function(){
            setNoDrop(logo_img,1);
        },500);
    }

    function setNoDrop($dom,num){
        var num = num?num:1;
        var length = $dom.length;
        console.log(length,num);
        if(length >=num){
            $dom.parents(".queueList").prev().find(".webuploader-pick").css({
                'position': 'relative',
                'zIndex': 1,
                'background': '#f0f0f0',
                'cursor': 'no-drop'
            });
        }
    }
    // 图片编辑
    $(".filelist-exist").parents(".queueList").css({
        'display': 'block',
        'opacity': 1
    });
    $(".filelist-exist").find("li").hover(function(){
        $(this).find(".file-panel").stop(true).animate({height:"30px"},300);
    },function(){
        $(this).find(".file-panel").stop(true).animate({height:0},300);
    });

    $(".filelist-exist").on("click","span.cancel",function(){
        $btnDom = $(this).parents(".queueList").prev().find(".webuploader-pick");
        $btnDom.css({
            'background': "none",
            'cursor': 'pointer',
            'z-index': 0});
        $li = $(this).parents("li");
        $parents = $li.parents('.filelist-exist');
        $li.remove();
        if($parents.find("li").length == 0){
            $parents.remove();
        }
    });

    // 删除视频
    $(".video-close").on('click',function(){
        $delsrc = $(this).prev().attr('src');
        var $this = $(this);
        layer.confirm('确定要删除视频吗？', {icon: 3, title:'提示'}, function(index){
            $.ajax({
                url: "<?php echo url('delFile'); ?>",
                type: "post",
                data: {
                    delsrc: $delsrc
                },
                success: function(res){
                    if(res.code == 1){
                        layer.msg(res.msg, {icon: 1,time:1000,anim:1});
                        $this.prev().attr('src','');
                        $this.parent().hide().parent().find('.video-add-item').show();
                    }else{
                        layer.msg(res.msg, {icon: 5,time:1000,anim:6});
                    }
                }
            });
            layer.close(index);
        });
    });


    layui.use(['form', 'layedit', 'laydate','upload'], function() {
        var form = layui.form,
            layer = layui.layer,
            upload = layui.upload;

        form.on('radio(radio-type-filter)',function(data){
            if(data.value != 1){
                $('.upload-video').show();
            }else{
                $('.upload-video').hide();
            }
        });



        // 视频上传
        var uploadInst = upload.render({
            elem: '#videoItem' //绑定元素
            ,url: "<?php echo url('uploadVideo'); ?>" //上传接口
            ,done: function(res){
                //上传完毕回调
                if(res.code == 1){
                    $(".video-add-item").hide();
                    $(".video-wrap").show().find('video').attr('src','/upload/videos/'+res.data);
                    $("#videoItem").data('videosrc',res.data);
                }else{
                    $("#videoItem").data('videosrc','');
                }
            }
            ,accept: 'video'
            ,error: function(){
                $("#videoItem").data('videosrc','');
            }
        });

        //自定义验证规则
        form.verify({
            name: function(value) {
                if (value.length < 2) {
                    return '标题至少得2个字符啊';
                }
            },
            banner_bit: function(value, item){
                if(value == 0){
                    return '轮播图位置不能为空！';
                };
            },
            key_word_verify: function (value, item) {
                if($("input[name='type']:checked").val() != 0){
                    if(value == ''){
                        return  '跳转id必须添加';
                    }
                    console.log(value);
                    if(!/^\d+$/.test(value)){
                        return  '跳转id必须是正整数或者0';
                    }
                }

            },
            content: function(value) {

            }
        });

        //监听提交
        form.on('submit(demo1)', function(data) {
            var formDom = data.form;
            // 获取轮播图字符串地址
            var banner_img_lists = $("#uploader .filelist > li");
            var banner_img_url = setUpdateUrl(banner_img_lists);

            if(banner_img_url == ''){
                layer.msg('轮播图不能为空', {icon: 5,time:1000,anim:6});
                return false;
            };

            // 图片和视频参数
            var params = "&img_url="+banner_img_url;

            // 验证视频视频添加
            $radioTypeVal = $("input[type='radio'][name='url_type']:checked").val();
            if($radioTypeVal == 2){
                // 获取视频字符串地址
                var video_url = $("#videoItem").data('videosrc');
                if(video_url == '' || video_url == undefined){
                    layer.msg('视频不能不能为空', {icon: 5,time:1000,anim:6});
                    return false;
                };
                params += "&video_url="+video_url;
            }else{
                params += "&video_url="+'';
            }
            $.ajax({
                url: "<?php echo url('save'); ?>",
                type: "post",
                data: $(formDom).serialize()+params,
                success: function(res){
                    console.log(res);
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