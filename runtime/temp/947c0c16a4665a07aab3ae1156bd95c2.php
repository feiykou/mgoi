<?php /*a:1:{s:84:"D:\SoftDownload\PHPTutorial\WWW\mgoi\mgoicms\application\admin\view\login\index.html";i:1563520502;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>零食商贩－登录</title>
    <link href="/static/admin/app_login/css/login.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div class="login-view">
    <div class="login-wrapper" ng-controller="loginCtrl">
        <div class="login-box">
            <div class="login-title">
                <div class="company-name">
                    <img src="/static/admin/app_login/imgs/logo.png">
                    <span>MGOI</span>
                </div>
                <div class="systme-name">
                    <span>Snack Petty Vendor</span>
                </div>
            </div>
            <div class="login-form">
                <div class="form-group form-input">
                    <input type="text" class="normal-input" id="user-name" placeholder="用户名">
                    <div class="common-error-tips"><div></div></div>
                </div>
                <div class="form-group form-input">
                    <input type="password" class="normal-input" id="user-pwd" placeholder="密码">
                    <div class="common-error-tips"><div></div></div>
                </div>
                <div class="form-group form-btn">
                    <input type="button" class="normal-btn" id="login" value="登录">
                </div>
                <div class="form-group form-forget">
                    <label class="error-tips">登录失败</label>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script src="/static/admin/app_login/js/common.js" type="application/javascript"></script>
<script type="text/javascript" src="/static/admin/app_login/js/jquery-1.8.2.min.js"></script>
<script src="/static/admin/app_login/js/login.js" type="application/javascript"></script>
</html>