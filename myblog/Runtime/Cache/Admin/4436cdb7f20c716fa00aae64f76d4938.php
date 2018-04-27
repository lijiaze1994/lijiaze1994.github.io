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
    <link rel="stylesheet" href="/Public/admin/css/page.css">
    <script src="/Public/admin/js/jquery.js"></script>
    <script src="/Public/admin/js/pintuer.js"></script>
    <script src="/Public/admin/js/respond.js"></script>
    <script src="/Public/admin/js/admin.js"></script>
    <!-- <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" /> -->
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
    <li <?php if((CONTROLLER_NAME) == "Type"): ?>class="active"<?php endif; ?>>
		<a href="/Admin/typelist">分类管理</a>
	</li>
	
    <li <?php if((CONTROLLER_NAME) == "Article"): ?>class="active"<?php endif; ?>>
		<a href="/Admin/articlelist">文章管理</a>
	</li>

    <li <?php if((CONTROLLER_NAME) == "Comment"): ?>class="active"<?php endif; ?>>
        <a href="/Admin/commentlist">评论管理</a>
    </li>
    <!-- <li><a href="#">评论管理</a></li>
    <li class="active"><a href="#">相册管理</a></li>
    <li><a href="#">页面管理</a></li>
    <li><a href="#">站长管理</a></li>
    <li><a href="#">友情链接</a></li> -->
</ul>
                </li>
                <li><a href="/Admin/type" class="icon-cog"> 分类</a>
            		<ul><li><a href="#">全局设置</a></li><li class="active"><a href="#">系统设置</a></li><li><a href="#">会员设置</a></li><li><a href="#">积分设置</a></li></ul>
                </li>
                <li><a href="/Admin/article" class="icon-file-text">文章管理</a>
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
<script>
	//定义页面载入事件
	$(function(){
		//获取btnAdd按钮
		$('#btnAdd').bind('click',function(){
			// 添加分类的链接
			window.location.href = 'index.html';
		});
	});
</script>


<div class="admin">
    <?php if(empty($deletedat)): ?><form method="post" action="/Admin/dealcommentdeletes">
    <?php else: ?>
        <form method="post" action="/Admin/dealcommentrecoveryss"><?php endif; ?>
    <div class="panel admin-panel">
        <div class="panel-head"><strong>评论列表</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" name="checkall" checkfor="id[]" value="全选" />
             <?php if(empty($deletedat)): ?><input type="submit" class="button button-small border-yellow" value="批量删除" />
                 <a href="/Admin/commentlist/deletedat/1">
                      <input type="button" class="button button-small border-blue" value="回收站" />
                </a>
            <?php else: ?>
                <input type="submit" class="button button-small border-yellow" value="批量恢复" />
                <a href="/Admin/commentlist">
                <input type="button" class="button button-small border-yellow"  value="返回评论列表" />
                </a><?php endif; ?>
            
        </div>
        <table class="table table-hover">
		     <tr>
                <th width="45">选择</th>
                <th width="120">ID</th>
                <th width="120">所属文章</th>
                <th width="240">评论人</th>
                <th width="240">评论时间</th>
                <th width="*">评论描述</th>
                <th width="100">操作</th>
            </tr>
            <?php if(is_array($commentlist)): foreach($commentlist as $key=>$val): ?><tr>
                <td><input type="checkbox" name="id[]" value="<?php echo ($val['id']); ?>" /></td>
                <td>
                    <?php echo ($val["id"]); ?>
                </td>
                <td>
                    <?php echo ($val["article"]["title"]); ?>
                </td>
                <td>
                    <?php echo ($val["publish_user_name"]); ?>
                </td>
                <td>
                    <?php echo (date("Y-m-d H:i:s",$val["created_at"])); ?>
                </td>
                <td>
                    <?php echo ($val["content"]); ?>
                </td>
                <td>
                    <?php if(empty($deletedat)): ?><a class="button border-yellow button-little" href="/Admin/dealCommentdelete/<?php echo ($val['id']); ?>" >删除</a>
                    <?php else: ?>
                     <a class="button border-yellow button-little" href="/Admin/dealcommentrecovery/<?php echo ($val['id']); ?>" >恢复</a><?php endif; ?>
                </td>
            </tr><?php endforeach; endif; ?>
        </table>
        <div class="pu_page mtm">
            <?php echo ($page); ?>
        </div>
    </div>
    </form>
    <br />
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>


</body>
</html>