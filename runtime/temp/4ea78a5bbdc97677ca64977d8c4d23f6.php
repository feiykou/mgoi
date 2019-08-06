<?php /*a:3:{s:85:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\product\edit.html";i:1564675730;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\header.html";i:1536755456;s:86:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\common\footer.html";i:1535296431;}*/ ?>
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
                <li>描述信息</li>
                <li>会员价格</li>
                <li>商品属性</li>
            </ul>
            <div class="layui-tab-content product-add-content">
                <div class="layui-tab-item layui-show">
                    <input type="hidden" name="id" value="<?php echo htmlentities($productData['id']); ?>">
                    <div class="layui-form-item">
                        <label class="layui-form-label">商品名称</label>
                        <div class="layui-col-md2">
                            <input type="text" name="name" value="<?php echo htmlentities($productData['name']); ?>" lay-verify="name" autocomplete="off" placeholder="请输入商品名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">商品描述</label>
                        <div class="layui-col-md4">
                            <textarea placeholder="请输入描述内容" name="description" class="layui-textarea"><?php echo htmlentities($productData['description']); ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">上传主图</label>
                        <div class="layui-input-block upload-img-wrap">
                                        <div id="uploader" class="uploader-item">
                <div class="uploader_btns">
                    <div class="filePicker"></div><div class="uploadBtn">上传图片</div>
                </div>
                <!--用来存放item-->
                <div class="queueList">
                            <ul class="filelist filelist-exist clearfix">
                                <?php foreach($productData['main_img_url'] as $k=>$v):?>
                                <li class="state-complete" data-src="<?php echo htmlentities($v); ?>">
                                    <p class="imgWrap"><img src="/upload/images/<?php echo htmlentities($v); ?>" width="110" height="110"></p>
                                    <div class="file-panel"><span class="cancel">删除</span></div>
                                    <span class="success"></span>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            </div>
            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">上传产品图（多图）</label>
                        <div class="layui-input-block upload-img-wrap">
                                        <div id="productImgs" class="uploader-item">
                <div class="uploader_btns">
                    <div class="filePicker"></div><div class="uploadBtn">上传产品图</div>
                </div>
                <!--用来存放item-->
                <div class="queueList">
                            <?php if($productImgData): ?>
                            <ul class="filelist filelist-exist clearfix">
                                <?php foreach($productImgData as $k=>$v): if($v['img_url']):?>
                                <li class="state-complete" data-src="<?php echo htmlentities($v['img_url']); ?>">
                                    <p class="imgWrap"><img src="/upload/images/<?php echo htmlentities($v['img_url']); ?>" width="110" height="110"></p>
                                    <div class="file-panel"><span class="cancel" data-imgid="<?php echo htmlentities($v['id']); ?>">删除</span></div>
                                    <span class="success"></span>
                                </li>
                                <?php endif; endforeach;?>
                            </ul>
                            <?php endif; ?>
                            </div>
            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">推荐位</label>
                        <div class="layui-input-block">
                            <?php if(is_array($productRecposRes) || $productRecposRes instanceof \think\Collection || $productRecposRes instanceof \think\Paginator): $i = 0; $__LIST__ = $productRecposRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$recpos): $mod = ($i % 2 );++$i;if(in_array($recpos['id'],$curProductRecposRes)){
                                $checked = 'checked';
                            }else{
                                $checked = '';
                            }?>
                            <input type="checkbox" name="recpos[]" value="<?php echo htmlentities($recpos['id']); ?>" lay-skin="primary" title="<?php echo htmlentities($recpos['name']); ?>" <?php echo $checked;?>><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary"><span><?php echo htmlentities($recpos['name']); ?></span><i class="layui-icon"></i></div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">上架</label>
                        <div class="layui-input-block">
                            <input type="radio" name="on_sale" value="1" title="上架" <?php if($productData['on_sale'] == 1): ?>checked<?php endif; ?>>
                            <input type="radio" name="on_sale" value="0" title="下架" <?php if($productData['on_sale'] == 0): ?>checked<?php endif; ?>>
                        </div>
                        </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">所属栏目</label>
                        <div class="layui-inline">
                            <select name="category_id">
                                <option value="0">顶级分类</option>
                                <?php if(is_array($CategoryRes) || $CategoryRes instanceof \think\Collection || $CategoryRes instanceof \think\Paginator): $i = 0; $__LIST__ = $CategoryRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resData): $mod = ($i % 2 );++$i;?>
                                <option <?php if($productData['category_id'] == $resData['id']): ?>selected<?php endif; ?> value="<?php echo htmlentities($resData['id']); ?>"><?php if($resData['pid'] != 0): ?>┞<?php endif; ?><?php echo htmlentities(str_repeat('┄',$resData['level']*2)); ?><?php echo htmlentities($resData['name']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-form layui-form-pane">
                            <div class="layui-form-item">
                                <div>
                                    <label class="layui-form-label" style="height: 38px;">礼品分类</label>
                                </div>
                                <div class="layui-input-block">
                                    <select xm-select="product-sel">
                                        <?php if(is_array($giftCategoryRes) || $giftCategoryRes instanceof \think\Collection || $giftCategoryRes instanceof \think\Paginator): $i = 0; $__LIST__ = $giftCategoryRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                                        <option value="id:<?php echo htmlentities($data['id']); ?>;name:<?php echo htmlentities($data['name']); ?>" <?php if(in_array($data['id'],$selGiftCate)): ?>selected<?php endif; ?>><?php echo htmlentities($data['name']); ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">所属主题</label>
                        <div class="layui-inline">
                            <select name="theme_id">
                                <option value="">顶级分类</option>
                                <?php if(is_array($themeData) || $themeData instanceof \think\Collection || $themeData instanceof \think\Paginator): $i = 0; $__LIST__ = $themeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo htmlentities($data['id']); ?>" <?php if($data['id'] == $productData['theme_id']): ?>selected<?php endif; ?>><?php echo htmlentities($data['name']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">市场价</label>
                        <div class="layui-col-md2">
                            <input type="text" name="market_price" value="<?php echo htmlentities($productData['market_price']); ?>" lay-verify="market_price" autocomplete="off" placeholder="请输入市场价" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">本店价</label>
                        <div class="layui-col-md2">
                            <input type="text" name="price" value="<?php echo htmlentities($productData['price']); ?>" lay-verify="price" autocomplete="off" placeholder="请输入本店价" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">重量</label>
                        <div class="layui-col-md1">
                            <input type="text" name="weight" value="<?php echo htmlentities($productData['weight']); ?>" lay-verify="weight" autocomplete="off" placeholder="请输入重量" class="layui-input">
                        </div>
                        <div class="layui-inline" style="width: 50px; margin-left: 6px; text-align: center;">
                            <input type="text" name="unit" value="<?php echo htmlentities($productData['unit']); ?>" lay-verify="unit" autocomplete="off" class="layui-input" value="kg">
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
                        <label class="layui-form-label">商品详情</label>
                        <div class="layui-input-block">
                            <textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"><?php echo htmlentities($productData['content']); ?></textarea>
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
                    <?php if(is_array($mlRes) || $mlRes instanceof \think\Collection || $mlRes instanceof \think\Paginator): $i = 0; $__LIST__ = $mlRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mlData): $mod = ($i % 2 );++$i;?>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo htmlentities($mlData['name']); ?></label>
                        <div class="layui-col-md2">
                            <input type="text" name="mp[<?php echo htmlentities($mlData['id']); ?>]" autocomplete="off" placeholder="级别价格" class="layui-input" value="<?php if(isset($mbArr[$mlData['id']]['mprice'])){ echo $mbArr[$mlData['id']]['mprice']; } else{ echo ''; } ?>">
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>

                <div class="layui-tab-item">
                    <div class="layui-form-item">
                        <label class="layui-form-label">商品类型</label>
                        <div class="layui-inline">
                            <select name="type_id" lay-filter="type_id" <?php if($productData['type_id'] != 0): ?>disabled<?php endif; ?>>
                                <option value="0">请选择</option>
                                <?php if(is_array($typeRes) || $typeRes instanceof \think\Collection || $typeRes instanceof \think\Paginator): $i = 0; $__LIST__ = $typeRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resData): $mod = ($i % 2 );++$i;?>
                                <option <?php if($productData['type_id'] == $resData['id']): ?>selected<?php endif; ?> value="<?php echo htmlentities($resData['id']); ?>"><?php echo htmlentities($resData['name']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div id="prop_list">
                        <!-- 显示属性 -->
                        <?php foreach($propRes as $k => $v):if($v['type'] == 1):
                                $propRadio = explode(',', $v['segements']);
                            ?>
                                <!-- 单选 start -->
                                <div class="layui-form-item">
                                    <label class="layui-form-label"><?php echo htmlentities($v['name']); ?></label>
                                    <div class="layui-col-md6">
                                        <?php if(isset($ppropRes[$v['id']])):foreach($ppropRes[$v['id']] as $k0 => $v0):?>
                                        <div data-propid="<?php echo htmlentities($v0['id']); ?>">
                                            <a href="javascript:;" class="btn-add-reduce" onclick="addrow(this);"><?php if($k0==0){ echo '[+]';}else{ echo '[-]';}?></a>
                                            <div class="layui-inline" style="width: 160px; margin-left: 6px;">
                                                <select name="old_product_prop[<?php echo htmlentities($v['id']); ?>][]" lay-filter="ss">
                                                    <option value="">请选择</option>
                                                    <?php foreach($propRadio as $k1=>$v1):?>
                                                    <option <?php if($v1 == $v0['prop_value']): ?>selected<?php endif; ?> value="<?php echo htmlentities($v1); ?>"><?php echo htmlentities($v1); ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="layui-inline">
                                                <input type="text" name="old_prop_price[<?php echo htmlentities($v0['id']); ?>]" value="<?php echo htmlentities($v0['prop_price']); ?>" autocomplete="off" placeholder="请输入自定义价格" class="layui-input">
                                                <input class="prop_name" type="hidden" name="old_prop_name[<?php echo htmlentities($v0['id']); ?>]" value="<?php echo htmlentities($v0['prop_name']); ?>" autocomplete="off" class="layui-input">
                                            </div>
                                            <?php if($v['is_add_img'] == 1):?>
                                            <div class="layui-inline upload-file-wrap">点击上传图片
                                                <input type="file" onclick="sfile_upload(this)" class="file-input-inline" name="image" />
                                                <input class="propImage" type="hidden" name="old_propImage[<?php echo htmlentities($v['id']); ?>][]" value="<?php echo htmlentities($v0['img_url']); ?>" />
                                            </div>
                                            <?php if(isset($v0['img_url']) && $v0['img_url']):?>
                                                <div class="layui-inline file-img-wrap">
                                                    <div class="img" data-src="<?php echo htmlentities($v0['img_url']); ?>">
                                                        <img src="/upload/images/<?php echo htmlentities($v0['img_url']); ?>" alt="">
                                                    </div>
                                                    <div class="file-img-mask">删除</div>
                                                </div>
                                            <?php else:?>
                                                <div class="layui-inline file-img-wrap none">
                                                    <div class="img">
                                                        <img alt="">
                                                    </div>
                                                    <div class="file-img-mask">删除</div>
                                                </div>
                                            <?php endif;?>

                                            <?php endif;?>
                                        </div>
                                        <?php endforeach;else:?>
                                            <div>
                                                <a href="javascript:;" class="btn-add-reduce" onclick="addrow(this);">[+]</a>
                                                <div class="layui-inline" style="width: 160px; margin-left: 6px;">
                                                    <select name="product_prop[<?php echo htmlentities($v['id']); ?>][]" lay-filter="ss">
                                                        <option value="">请选择</option>
                                                        <?php foreach($propRadio as $k1=>$v1):?>
                                                        <option value="<?php echo htmlentities($v1); ?>"><?php echo htmlentities($v1); ?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <div class="layui-inline">
                                                    <input type="text" name="prop_price[]" autocomplete="off" placeholder="请输入自定义价格" class="layui-input">
                                                </div>
                                                <?php if($v['is_add_img'] == 1):?>
                                                <div class="layui-inline upload-file-wrap">点击上传图片
                                                    <input type="file" onclick="sfile_upload(this)" class="file-input-inline" name="image" />
                                                    <input type="hidden" name="propImage[<?php echo htmlentities($v['id']); ?>][]" />
                                                </div>
                                                <div class="layui-inline file-img-wrap"><div class="img"></div><div class="file-img-mask">删除</div></div>
                                                <?php endif;?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <!-- 单选 end -->


                            <?php else:if(isset($ppropRes[$v['id']])):?>
                                    <!-- 唯一 start -->
                                    <?php if($v['segements'] == ''):?>
                                    <!-- 无值 input -->
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo htmlentities($v['name']); ?></label>
                                        <div class="layui-col-md2">
                                            <input type="text" name="old_product_prop[<?php echo htmlentities($v['id']); ?>]" value="<?php echo htmlentities($ppropRes[$v['id']][0]['prop_value']); ?>" autocomplete="off" placeholder="请输入自定义属性值" class="layui-input">
                                            <input type="hidden" name="old_prop_price[<?php echo $ppropRes[$v['id']][0]['id']?>]">
                                        </div>
                                    </div>
                                    <?php else:
                                        $propRadio = explode(',', $v['segements']);
                                    ?>
                                    <!-- 有值 select -->
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo htmlentities($v['name']); ?></label>
                                        <div class="layui-inline" style="width: 160px; margin-left: 6px;">
                                            <select name="old_product_prop[<?php echo htmlentities($v['id']); ?>]" lay-filter="ss">
                                                <option value="">请选择</option>
                                                <?php foreach($propRadio as $k1=>$v1):?>
                                                <option <?php if($v1 == $ppropRes[$v['id']][0]['prop_value']): ?>selected<?php endif; ?> value="<?php echo htmlentities($v1); ?>"><?php echo htmlentities($v1); ?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <input type="hidden" name="old_prop_price[<?php echo $ppropRes[$v['id']][0]['id']?>]">
                                        </div>
                                    </div>
                                    <?php endif;else:?>
                                    <!-- 唯一 start -->
                                    <?php if($v['segements'] == ''):?>
                                    <!-- 无值 input -->
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo htmlentities($v['name']); ?></label>
                                        <div class="layui-col-md2">
                                            <input type="text" name="product_prop[<?php echo htmlentities($v['id']); ?>]" autocomplete="off" placeholder="请输入自定义属性值" class="layui-input">
                                        </div>
                                    </div>
                                    <?php else:
                                        $propRadio = explode(',', $v['segements']);
                                    ?>
                                    <!-- 有值 select -->
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"><?php echo htmlentities($v['name']); ?></label>
                                        <div class="layui-inline" style="width: 160px; margin-left: 6px;">
                                            <select name="product_prop[<?php echo htmlentities($v['id']); ?>]" lay-filter="ss">
                                                <option value="">请选择</option>
                                                <?php foreach($propRadio as $k1=>$v1):?>
                                                <option value="<?php echo htmlentities($v1); ?>"><?php echo htmlentities($v1); ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php endif;?>

                        <?php endforeach;?>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                    <!--<div class="layui-form-item">-->
                    <!--<div class="layui-input-block">-->
                    <!--<button class="layui-btn" lay-submit="" lay-filter="demo2">立即提交</button>-->
                    <!--<button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
                    <!--</div>-->
                    <!--</div>-->
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
        fileNumLimit: 3
    });
    feiy_upload.init({
        wrap: $("#productImgs"),
        filePicker: $("#productImgs").find(".filePicker"),
        uploadId: "#productImgs",
        server: config.upload_server,
        fileNumLimit: 5
    });


</script>
<script>
    $(function () {
        checkUpload();

    });

    function checkUpload(){
        var $uploader = $("#uploader .filelist > li");
        var $productImgs = $("#productImgs .filelist > li");
        setTimeout(function(){
            setNoDrop($uploader,3);
            setNoDrop($productImgs,10);
        },500);
    }


    function sfile_upload(obj) {
        var mark = true;
        $(obj).on('change',function(){
            if(mark){
                var formData = new FormData();
                formData.append('file',$(obj)[0].files[0]);
                $.ajax({
                    url: "<?php echo url('uploadImg'); ?>",
                    data: formData,
                    type: "POST",
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (res) {
                        if(res.code == 1){
                            $(obj).next().val(res.data);
                            var imgBox = $(obj).parent().next();
                            var $imgWrap = imgBox.find('.img');
                            $imgWrap.data('src',res.data);

                            var img = new Image();
                            img.src = "/upload/images/"+res.data;
                            $imgWrap.html(img);
                            imgBox.css('display','inline-block');
                            mark = false;
                        }
                    }
                })
            }
        });
    }

    // 删除属性图片
    $("#prop_list").on('click','.file-img-mask',function(){
        $delsrc = $(this).prev().data('src');
        var $this = $(this);
        layer.confirm('确定要删除图片吗？', {icon: 3, title:'提示'}, function(index){
            $.ajax({
                url: "<?php echo url('delFile'); ?>",
                type: "post",
                data: {
                    delsrc: "/upload/images/"+$delsrc
                },
                success: function(res){
                    if(res.code == 1){
                        layer.msg(res.msg, {icon: 1,time:1000,anim:1});
                        $this.prev().data('src','');
                        $this.parent().prev().find('input[type="hidden"]').val('');
                        $this.parent().prev().find('input[type="file"]').val('');
                        $this.prev().html('');
                        $this.parent().hide();
                    }else{
                        layer.msg(res.msg, {icon: 5,time:1000,anim:6});
                    }
                }
            });
            layer.close(index);
        });
    });


    var formSelects = layui.formSelects;
    var giftCateId = [];
    formSelects.on('product-sel',function (id, vals) {
        giftCateId = []
        vals.forEach(function (val) {
            valueJson = resolveStr(val);
            if(valueJson.id){
                giftCateId.push(valueJson.id);
            }
        });
    },true);

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

        // 删除上传图片
        cancelImg(function ($obj) {
            var imgId = $obj.data('imgid');
            if(imgId){
                $.ajax({
                    url: '<?php echo url("ajaxDelPic"); ?>',
                    type: 'POST',
                    data: {
                        id: imgId
                    }
                });
            }
        });

        window.addrow = function(o){
            var $div=$(o).parent();
            if($(o).html() == '[+]'){
                var newdiv=$div.clone();
                newdiv.attr('data-propid','');
                newdiv.find('a').html('[-]');
                // 修改价格old_prop_price[]为prop_price[]
                newdiv.find('input[type=text]').attr('name','prop_price[]');
                newdiv.find('.prop_name').attr('name','prop_name[]');
                // 修改old_product_prop[$v.id][]为product_prop[$v.id][]
                var sel = newdiv.find('select');
                var oldname = sel.attr('name');
                var newname = oldname.replace('old_','');
                sel.attr('name',newname);
                // 清空缩略图
                newdiv.find('.img').html('');
                var fileDom = newdiv.find('input[type="file"]');
                fileDom.next().val('');
                if(fileDom.next().attr('name')){
                    var filenewname = fileDom.next().attr('name').replace('old_','');
                    fileDom.next().attr('name',filenewname);
                    fileDom.val('');
                }
                $div.parent().append(newdiv);
            }else{
                var propid = $div.data('propid');
                if(propid){
                    layer.confirm('确定要删除吗？', {icon: 3, title:'提示'}, function(index){
                        $.ajax({
                            url: '<?php echo url("ProductProp/ajaxDelProductProp"); ?>',
                            type: 'POST',
                            data: {
                                id: propid
                            },
                            success: function(res){
                                var msgParams = {
                                    iconNum: 6,
                                    anim: 0
                                };
                                if(res.code == 0){
                                    msgParams.iconNum = 5;
                                    msgParams.anim = 6;
                                }else{
                                    $div.remove();
                                }
                                layer.msg(res.msg, {icon: msgParams.iconNum,time:1000,anim:msgParams.anim});
                            }
                        });
                    });
                }else{
                    $div.remove();
                }

            }
            form.render('select');
        }

        //自定义验证规则
        form.verify({
            name: function(value) {
                if (value.length < 2) {
                    return '标题至少得2个字符啊';
                }
            }
        });

        form.on('select(type_id)',function (data) {
            var type_id = $(data.elem).val();
            $.ajax({
                type:"POST",
                url:"<?php echo url('spec_param/ajaxGetAttr'); ?>",
                data:{type_id:type_id},
                dataType:"json",
                success:function(res){
                    var html = '';
                    res.data.forEach(function(data){
                        if(data.type == 1){
                            html+='<div class="layui-form-item">';
                            html+='<label class="layui-form-label">'+data.name+'</label>';
                            html+='<div class="layui-col-md6">';
                            html+='<div>';
                            var attrValuesArr = data.segements.split(',');
                            html+='<a href="javascript:;" class="btn-add-reduce" onclick="addrow(this);">[+]</a>';
                            html+='<div class="layui-inline" style="width: 160px; margin-left: 6px;">';
                            html+='<select name="product_prop['+data.id+'][]" lay-filter="ss">';
                            html+='<option value="">请选择</option>';
                            for(var i=0; i<attrValuesArr.length; i++){
                                html+="<option value='"+attrValuesArr[i]+"'>"+attrValuesArr[i]+"</option>";
                            }
                            html+='</select>';
                            html+='</div>';
                            html+='<div class="layui-inline">';
                            html+='<input type="text" name="prop_price[]" autocomplete="off" placeholder="请输入自定义价格" class="layui-input">';
                            html+='<input class="prop_name" type="hidden" name="prop_name[]" value="'+data.name+'" autocomplete="off" class="layui-input">';
                            html+='</div>';
                            if(data.is_add_img == 1){
                                html+='<div class="layui-inline upload-file-wrap">点击上传图片';
                                html+='<input type="file" onclick="sfile_upload(this)" class="file-input-inline" name="image" />';
                                html+='<input class="propImage" type="hidden" name="propImage['+data.id+'][]" />';
                                html+='</div>';
                                html+='<div class="layui-inline file-img-wrap"><div class="img"></div><div class="file-img-mask">删除</div></div>';
                            }
                            html+='</div>';
                            html+='</div>';
                            html+='</div>';
                        }else{
                            if(data.segements != ''){
                                html+='<div class="layui-form-item">';
                                html+='<label class="layui-form-label">'+data.name+'</label>';
                                var attrValuesArr = data.segements.split(',');
                                html+='<div class="layui-inline" style="width: 160px; margin-left: 6px;">';
                                html+='<select name="product_prop['+data.id+']" lay-filter="ss">';
                                html+='<option value="">请选择</option>';
                                for(var i=0; i<attrValuesArr.length; i++){
                                    html+="<option value='"+attrValuesArr[i]+"'>"+attrValuesArr[i]+"</option>";
                                }
                                html+='</select>';
                                html+='</div>';
                                html+='</div>';
                            }else{
                                html+='<div class="layui-form-item">';
                                html+='<label class="layui-form-label">'+data.name+'</label>';
                                html+='<div class="layui-col-md2">';
                                html+='<input type="text" name="product_prop['+data.id+']"  autocomplete="off" placeholder="请输入自定义属性值" class="layui-input">';
                                html+='</div>';
                                html+='</div>';
                            }
                        }


                    });
                    $("#prop_list").html(html);
                    form.render('select');
                }
            });
        });



        //监听提交
        form.on('submit(demo1)', function(data) {
            layedit.sync(editIndex);
            var formDom = data.form;
            var main_img_lists = $("#uploader .filelist > li");
            var product_img_lists = $("#productImgs .filelist > li");
            var main_img_url = setUpdateUrl(main_img_lists);
            var product_img_url = setUpdateUrl(product_img_lists);
            var params = "&main_img_url="+main_img_url+'&product_img_url='+product_img_url;
            params += '&gift_cate='+giftCateId.join(',')
            $.ajax({
                url: "<?php echo url('save'); ?>",
                type: "post",
                data: $(formDom).serialize()+params,
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