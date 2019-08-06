<?php /*a:3:{s:83:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\theme\edit.html";i:1564708544;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
    <link rel="stylesheet" href="/static/admin/css/formSelects-v4.css">
    <style>
        .form-container{ padding: 30px 60px;}
        .product-add-content{ margin-top: 30px;}
        .btn-add-reduce{ display: inline-block; width: 20px; text-align: center;}
    </style>
</head>

<body>
<div class="form-container">
    <form class="layui-form" action="">
        <div class="layui-tab layui-form">
            <ul class="layui-tab-title">
                <li class="layui-this">基本信息</li>
                <li>主题内容</li>
                <li>关联商品</li>
            </ul>
            <div class="layui-tab-content product-add-content">
                <input type="hidden" value="<?php echo htmlentities($themeData['id']); ?>" name="id">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form-item">
                        <label class="layui-form-label">主题名称</label>
                        <div class="layui-col-md2">
                            <input type="text" name="name" value="<?php echo htmlentities($themeData['name']); ?>" lay-verify="name" autocomplete="off" placeholder="请输入主题名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">主题描述</label>
                        <div class="layui-col-md4">
                            <textarea placeholder="请输入描述内容" name="description" class="layui-textarea"><?php echo htmlentities($themeData['description']); ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">上传封面图</label>
                        <div class="layui-input-block upload-img-wrap">
                                        <div id="uploader" class="uploader-item">
                <div class="uploader_btns">
                    <div class="filePicker"></div><div class="uploadBtn">上传封面图</div>
                </div>
                <!--用来存放item-->
                <div class="queueList">
                            <?php if($themeData['main_img_url'] != ''): ?>
                            <ul class="filelist filelist-exist clearfix">
                                <li class="state-complete" data-src="<?php echo htmlentities($themeData['main_img_url']); ?>">
                                    <p class="imgWrap"><img src="/upload/images/<?php echo htmlentities($themeData['main_img_url']); ?>" width="110" height="110"></p>
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
                        <label class="layui-form-label">上传头图</label>
                        <div class="layui-input-block upload-img-wrap">
                                        <div id="headImg" class="uploader-item">
                <div class="uploader_btns">
                    <div class="filePicker"></div><div class="uploadBtn">上传头图</div>
                </div>
                <!--用来存放item-->
                <div class="queueList">
                            <?php if($themeData['head_img_url'] != ''): ?>
                            <ul class="filelist filelist-exist clearfix">
                                <li class="state-complete" data-src="<?php echo htmlentities($themeData['head_img_url']); ?>">
                                    <p class="imgWrap"><img src="/upload/images/<?php echo htmlentities($themeData['head_img_url']); ?>" width="110" height="110"></p>
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
                        <label class="layui-form-label">主题分类</label>
                        <div class="layui-inline">
                            <select name="category_id">
                                <option value="0">顶级分类</option>
                                <?php if(is_array($CategoryRes) || $CategoryRes instanceof \think\Collection || $CategoryRes instanceof \think\Paginator): $i = 0; $__LIST__ = $CategoryRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resData): $mod = ($i % 2 );++$i;?>
                                <option <?php if($themeData['category_id'] == $resData['id']): ?>selected<?php endif; ?> value="<?php echo htmlentities($resData['id']); ?>"><?php if($resData['pid'] != 0): ?>┞<?php endif; ?><?php echo htmlentities(str_repeat('┄',$resData['level']*2)); ?><?php echo htmlentities($resData['name']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <?php if(!empty($recposRes)): ?>
                    <div class="layui-form-item">
                        <label class="layui-form-label">推荐位</label>
                        <div class="layui-input-block">
                            <?php if(is_array($recposRes) || $recposRes instanceof \think\Collection || $recposRes instanceof \think\Paginator): $i = 0; $__LIST__ = $recposRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$recpos): $mod = ($i % 2 );++$i;?>
                            <input type="checkbox" name="recpos[]" value="<?php echo htmlentities($recpos['id']); ?>" <?php if(in_array($recpos['id'],$selRescIds)): ?>checked<?php endif; ?> lay-skin="primary" title="<?php echo htmlentities($recpos['name']); ?>"><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary"><span><?php echo htmlentities($recpos['name']); ?></span><i class="layui-icon"></i></div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="layui-form-item">
                        <label class="layui-form-label">上架</label>
                        <div class="layui-input-block">
                            <input type="radio" name="on_sale" <?php if($themeData['on_sale'] == 1): ?>checked<?php endif; ?> value="1" title="上架">
                            <input type="radio" name="on_sale" <?php if($themeData['on_sale'] == 0): ?>checked<?php endif; ?> value="0" title="下架">
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
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">主题内容</label>
                        <div class="layui-input-block">
                            <textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"><?php echo htmlentities($themeData['content']); ?></textarea>
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
                    <div class="layui-form layui-form-pane">
                        <div class="layui-form-item">
                            <div>
                                <label class="layui-form-label" style="height: 38px;">选择商品</label>
                            </div>
                            <div class="layui-input-block">
                                <select name="" xm-select="product-sel">
                                    <?php if(is_array($productDatas) || $productDatas instanceof \think\Collection || $productDatas instanceof \think\Paginator): $i = 0; $__LIST__ = $productDatas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                                    <option <?php if(isset($selProductData[$data['id']])): ?>selected<?php endif; ?> value="id:<?php echo htmlentities($data['id']); ?>;name:<?php echo htmlentities($data['name']); ?>;main_img_url:<?php echo htmlentities($data['main_img_url']); ?>;price:<?php echo htmlentities($data['price']); ?>"><?php echo htmlentities($data['name']); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div style="display: none;" id="selProduct" selProduct='<?php echo implode("@",$selProductData); ?>'></div>
                        <div style="display: none;" id="totalPriceId" totalPriceId='<?php echo htmlentities($themeData['price']); ?>'></div>
                        <div class="layui-form news_list">
                            <table class="layui-table">
                                <thead>
                                <tr>
                                    <th width="30">ID</th>
                                    <th>产品名</th>
                                    <th>封面图</th>
                                    <th>描述</th>
                                    <th width="80">价格</th>
                                    <th width="50">排序</th>
                                    <th width="100">位置</th>
                                </tr>
                                </thead>
                                <tbody id="product-body-id" class="news_content list-box-body">
                                <!--<tr>-->
                                <!--<td align="center">1</td>-->
                                <!--<td align="center">1</td>-->
                                <!--<td align="center">1</td>-->
                                <!--<td align="center">1</td>-->
                                <!--<td align="center">1</td>-->
                                <!--<td align="center"><input type="input" name="sort[1]" value="50" autocomplete="off" class="layui-input"></td>-->
                                <!--<td align="center"><input type="input" name="position" value="" autocomplete="off" class="layui-input"></td>-->
                                <!--</tr>-->

                                </tbody>
                            </table>
                            <div class="larry-table-page clearfix">
                                <div class="paging">
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
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
<script src="/static/admin/js/formSelects-v4.min.js"></script>
<script>
    var config = {
        "upload_server": "<?php echo url('uploadImg'); ?>"
    };

    feiy_upload.init({
        server: config.upload_server,
        fileNumLimit: 1
    });
    feiy_upload.init({
        wrap: $("#headImg"),
        filePicker: $("#headImg").find(".filePicker"),
        uploadId: "#headImg",
        server: config.upload_server,
        fileNumLimit: 1
    });

    // 检查图片数量是否超过设置值，超出则禁止
    $(function () {
        checkUpload();
    });

    function checkUpload(){
        var main_img = $("#uploader .filelist > li");
        var headImg = $("#headImg .filelist > li");

        setTimeout(function(){
            setNoDrop(main_img,1);
            setNoDrop(headImg,1);
        },500);
    }

    function setNoDrop($dom,num){
        var num = num?num:1;
        var length = $dom.length;
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


</script>
<script>
    // 删除上传图片
    cancelImg();
    $(function(){
        var $selProductData = $("#selProduct").attr('selProduct').split('@');
        var $selProJson = {};
        var json = {};
        $selProductData.forEach(function (val) {
            json = JSON.parse(val);
            $selProJson[json.product_id] = json;
        });
        console.log($selProJson);


        function insertProduct($obj) {
            if(!$obj){
                return false;
            }
            if(!$selProJson){
                $selProJson = {};
            }
            var curSelData = $selProJson[$obj.id];
            if(!curSelData){
                curSelData = {
                    position: "",
                    sort: 50
                };
            }

            var html = "<tr>"+
                "   <td align='center' valign='middle'><input type='hidden' name='product_id[]' value='"+$obj.id+"'>"+$obj.id+"</td>"+
                "    <td align='center' valign='middle'>"+$obj.name+"</td>"+
                "    <td align='center' valign='middle'><img src='/upload/images/"+$obj.main_img_url+"'></td>"+
                "    <td align='center' valign='middle'>不错哦</td>"+
                "    <td align='center' valign='middle'>"+$obj.price+"</td>"+
                "    <td align='center' valign='middle'><input type='input' name='sort[]' value='"+curSelData.sort+"' autocomplete='off' style='padding: 0;' class='layui-input tc'></td>"+
                "    <td align='center' valign='middle'><input type='input' name='position[]' value='"+curSelData.position+"' autocomplete='off' class='layui-input'></td>"+
                "    </tr>";
            $("#product-body-id").append(html);
        }

        function getTotalPriceTemple(totalPrice) {
            var html = '<tr class="sort-tr-wrap">'+
                '    <td colspan="4" style="border:0;"></td>'+
                '    <td align="center"><input type="input" name="price" value="'+totalPrice+'" autocomplete="off" style="padding: 0;" class="layui-input tc"></td>'+
                '    <td colspan="2" style="border:0;"></td>'+
                '    </tr>';
            $("#product-body-id").append(html);
        }

        function resolveStr(val) {
            var spl1 = val.value.split(';');
            var valjson = {};
            var key,value='';
            spl1.forEach(function(str){
                key = str.split(':')[0];
                value = str.split(':')[1] || '';
                valjson[key] = value;
            });
            return valjson;
        }

        // 选择商品
        var formSelects = layui.formSelects;
        formSelects.on('product-sel',function (id, vals, val, isAdd, isDisabled) {
            addProduct(vals);
        },true);

        addProduct(formSelects.value('product-sel'));

        function addProduct(vals) {
            $("#product-body-id").html('');
            var valueJson = {};
            var totalPrice = 0;
            vals.forEach(function (val) {
                valueJson = resolveStr(val);
                totalPrice+=parseFloat(valueJson.price);
                insertProduct(valueJson);
            });
            var theme_price = $("#totalPriceId").attr('totalPriceId');
            totalPrice = theme_price?parseFloat(theme_price):totalPrice;
            getTotalPriceTemple(totalPrice.toFixed(2));
        }


    });







    layui.use(['form', 'layedit', 'element', 'laydate', 'jquery'], function() {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            element = layui.element,
            $ = layui.jquery;


        layedit.set({
            uploadImage: {
                url: "<?php echo url('edituploadImg'); ?>", //接口url
                type: 'post'
            },
            height: 560
        });
        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');

        //自定义验证规则
        form.verify({
            name: function(value) {
                if (value.length < 2) {
                    return '标题至少得2个字符啊';
                }
            },
            sort: function (value) {
                if(value == []){
                    return '请选择商品！';
                }
            }
        });




        //监听提交
        form.on('submit(demo1)', function(data) {
            layedit.sync(editIndex);
            var formDom = data.form;
            var main_img_lists = $("#uploader .filelist > li");
            var head_img_lists = $("#headImg .filelist > li");
            var main_img_url = setUpdateUrl(main_img_lists);
            var head_img_url = setUpdateUrl(head_img_lists);
            var params = "&main_img_url="+main_img_url+'&head_img_url='+head_img_url;
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