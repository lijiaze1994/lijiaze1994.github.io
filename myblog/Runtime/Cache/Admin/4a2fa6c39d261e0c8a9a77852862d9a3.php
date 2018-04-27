<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>个人博客后台管理系统</title>
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
<div class="lefter">
    <div class="logo"><a href="/Admin/"><img src="/Public/admin/images/logo.png" alt="后台管理系统" /></a></div>
</div>
<div class="righter nav-navicon" id="admin-nav">
    <div class="mainer">
        <div class="admin-navbar">
            <span class="float-right">
            	<a class="button button-little bg-main" href="/Home/index" target="_blank">前台首页</a>
                <a class="button button-little bg-yellow" href="/Admin/dealLogout">注销登录</a>
            </span>
            <ul class="nav nav-inline admin-nav">
                <li class="active"><a href="index.html" class="icon-home"> 开始</a>
                    <ul>
                        <li><a href="/Admin/typelist">分类管理</a></li>
                        <li><a href="/Admin/articlelist">文章管理</a></li>
                        <li><a href="/Admin/commentlist">评论管理</a></li>
                        <!-- <li><a href="#">评论管理</a></li><li class="active"><a href="#">相册管理</a></li> -->
                       <!--  <li><a href="#">页面管理</a></li><li><a href="#">站长管理</a></li> -->
                        <!-- <li><a href="#">友情链接</a></li> -->
                    </ul>
                </li>
                <li><a href="/Admin/typelist" class="icon-cog"> 分类</a>
            		<ul><li><a href="#">全局设置</a></li><li class="active"><a href="#">系统设置</a></li><li><a href="#">会员设置</a></li><li><a href="#">积分设置</a></li></ul>
                </li>
                <li><a href="/Admin/articlelist" class="icon-file-text">文章管理</a>
					<ul><li><a href="#">添加内容</a></li><li class="active"><a href="#">内容管理</a></li><li><a href="#">分类设置</a></li><li><a href="#">链接管理</a></li></ul>
                </li>
            </ul>
        </div>
        <div class="admin-bread">
            <span>您好，<?php echo ($_SESSION['adminuser']['username']); ?>，欢迎您的光临。</span>
            <ul class="bread">
                <li><a href="index.html" class="icon-home"> 开始</a></li>
                <li>后台首页</li>
            </ul>
        </div>
    </div>
</div>

<div class="admin">
	<div class="line-big">
    	<div class="xm3">
        	<div class="panel border-back">
            	<div class="panel-body text-center">
                	<img src="/Public/admin/images/face.jpg" width="120" class="radius-circle" /><br />
                    <?php echo $_SESSION['loginUser']['username'];?>
                </div>
                <div class="panel-foot bg-back border-back">您好，<?php echo ($_SESSION['adminuser']['username']); ?>，这是您第100次登录，上次登录为2016-10-1。</div>
            </div>
            <br />
        	<div class="panel">
            	<div class="panel-head"><strong>站点统计</strong></div>
                <ul class="list-group">
                	<li><span class="float-right badge bg-red">88</span><span class="icon-user"></span> 会员</li>
                    <li><span class="float-right badge bg-main">828</span><span class="icon-file"></span> 文章</li>
                    <li><span class="float-right badge bg-main">828</span><span class="icon-shopping-cart"></span> 订单</li>
                    <li><span class="float-right badge bg-main">828</span><span class="icon-database"></span> 数据库</li>
                </ul>
            </div>
            <br />
        </div>
        <div class="xm9">
            <div class="alert">
                <div class="alert alert-yellow"><span class="close"></span><strong>提示：</strong>欢迎使用ICFrame框架！</div>
                <h4>基于ICFrame框架的blog介绍</h4>
                <p class="text-gray padding-top">该播客系统基于ICFrame框架，高效、简洁……</p>
            	<a target="_blank" class="button bg-dot icon-code" href="#"> 下载示例代码</a> 
            	<a target="_blank" class="button bg-main icon-download" href="#"> 下载ICFrame框架</a> 
            	<a target="_blank" class="button border-main icon-file" href="#"> ICFrame框架使用教程</a>
            </div>
            <div class="panel">
            	<div class="panel-head"><strong>系统信息</strong></div>
                <table class="table">
                	<tr><th colspan="2">服务器信息</th><th colspan="2">系统信息</th></tr>
                    <tr><td width="110" align="right">操作系统：</td><td>Ubuntu 18.04</td><td width="90" align="right">系统开发：</td><td><a href="#" target="_blank">ICFrame框架</a></td></tr>
                    <tr><td align="right">Web服务器：</td><td>Apache/2 PHP/5</td><td align="right">主页：</td><td><a href="#" target="_blank">#</a></td></tr>
                    <tr><td align="right">服务器IP：</td><td>127.0.0.1</td><td align="right">演示：</td><td><a href="#" target="_blank">http://www.blog.com</a></td></tr>
                    <tr><td align="right">数据库：</td><td>MySQL</td><td align="right">群交流：</td><td><a href="#" target="_blank">12345678</a> (点击加入)</td></tr>
                </table>
            </div>
        </div>
    </div>
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建   来源:<a href="http://www.itcast.cn/" target="_blank">Lee</a></p>
</div>
</body>
</html>