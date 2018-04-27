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
            	<a class="button button-little bg-main" href="/blog/index.php" target="_blank">前台首页</a>
                <a class="button button-little bg-yellow" href="logout.php">注销登录</a>
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
            <span>您好，admin，欢迎您的光临。</span>
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
  <div class="tab">
    <div class="tab-head"> <strong>分类管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">修改分类</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="post" class="form-x" action="/Admin/dealtypeedit">
            <input type="hidden" name="id" value="<?php echo ($currentType['id']); ?>">
          <div class="form-group">
            <div class="label">
              <label for="sitename">分类名称</label>
            </div>
            <div class="field">
              <input type="text" 
                     class="input" 
                     id="name" name="name" 
                     size="50" placeholder="分类名称" 
                     data-validate="required:请填写您的分类名称" value="<?php echo ($currentType['name']); ?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="sitename">所属类别</label>
            </div>
            <div class="field">
              <select name="pid" class="select">
              	  <option value="0">主类别</option>
                        <?php if(is_array($list)): foreach($list as $key=>$vo): if(($currentType['pid']) == $vo['id']): ?><option value="<?php echo ($vo['id']); ?>" selected="selected"><?php echo ($vo['name']); ?></option> 
                            <?php else: ?>
                                <option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endif; endforeach; endif; ?>> 
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="readme">分类描述</label>
            </div>
            <div class="field">
              <textarea name="desc" class="input" rows="5" cols="50" 
                        placeholder="请填写分类描述"
                        data-validate="required:请填写分类描述"><?php echo ($currentType['desc']); ?></textarea>
            </div>
          </div>
       
          <div class="form-button">
            <button class="button bg-main" type="submit">提交</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div style='height:20px; border-bottom:1px #DDD solid'></div>
  <p class="text-right text-gray" style="float:right">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>
    

</body>
</html>