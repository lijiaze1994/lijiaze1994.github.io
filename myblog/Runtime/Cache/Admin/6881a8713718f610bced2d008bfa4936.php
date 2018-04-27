<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>个人博客后台登录</title>
    <link rel="stylesheet" href="/Public/admin/css/pintuer.css">
    <link rel="stylesheet" href="/Public/admin/css/admin.css">
    <script src="/Public/admin/js/jquery.js"></script>
    <script src="/Public/admin/js/pintuer.js"></script>
    <script src="/Public/admin/js/respond.js"></script>
    <script src="/Public/admin/js/admin.js"></script>
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />
    <link href="/favicon.ico" rel="bookmark icon" />
</head>

<body>
<div class="container">
    <div class="line">
        <div class="xs6 xm4 xs3-move xm4-move">
            <br /><br />
            <div class="media media-y">
                <a href="#" target="_blank"><img src="/Public/admin/images/logo.png" class="radius" alt="后台管理系统" /></a>
            </div>
            <br /><br />
            <form action="/Admin/dealLogin" method="post">
            <div class="panel">
                <div class="panel-head"><strong>登录个人博客后台管理系统</strong></div>
                <div class="panel-body" style="padding:30px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="text" class="input" name="username" placeholder="登录账号" data-validate="required:请填写账号,length#>=5:账号长度不符合要求" />
                            <span class="icon icon-user"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input" name="password" placeholder="登录密码" data-validate="required:请填写密码,length#>=8:密码长度不符合要求" />
                            <span class="icon icon-key"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input" name="verifycode" placeholder="填写右侧的验证码" data-validate="required:请填写右侧的验证码" />
                            <img style="cursor: pointer;" src="/code?" onclick="this.src = this.src + Math.random();" width="80" height="42" class="passcode" />
                        </div>
                    </div>
                </div>
                <div class="panel-foot text-center"><button type="submit" class="button button-block bg-main text-big">立即登录后台</button></div>
            </div>
            <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
            </form>
        </div>
    </div>
</div>
</body>
</html>