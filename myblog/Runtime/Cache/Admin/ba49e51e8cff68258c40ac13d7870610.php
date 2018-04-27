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
  <div class="tab">
    <div class="tab-head"> <strong>文章管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">添加文章</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
          <form method="POST" class="form-x" action="/Admin/dealarticleedit" 
                enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo ($currentArticle['id']); ?>">
          <div class="form-group">
            <div class="label">
              <label for="sitename">文章标题</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="title" name="title" 
                     size="50" placeholder="文章标题" data-validate="required:请填写您的文章标题" 
                     value="<?php echo ($currentArticle['title']); ?>"/>
            </div>
          </div>
         <div class="form-group">
            <div class="label">
              <label for="logo">缩略图</label>
            </div>
            <div class="field"> <a class="button input-file" href="javascript:void(0);">上传文件
              <input size="100" type="file" name="cover" onchange="preview(this)" 
                    />
              </a> </div>
          </div>


          <div class="form-group">
            <div class="label">
              <label for="sitename"></label>
            </div>
            <div class="field">
                <div id="preview" >
                    <img style="width:150px;height:150px;" src="<?php echo ($currentArticle['cover']); ?>">
                    
                    
                </div>

                <script type="text/javascript">
                        function preview(file) {
                            var prevDiv = document.getElementById('preview');
                            if (file.files && file.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(evt) {
                                    prevDiv.innerHTML = '<img style="width:150px;height:150px;" src="' + evt.target.result + '" />';
                                }
                                reader.readAsDataURL(file.files[0]);
                            } else {
                                prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
                            }
                        }
                </script>
            </div>
          </div>

          <div class="form-group">
            <div class="label">
              <label for="siteurl">文章作者</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="author" name="author" 
                     size="50" placeholder="请填写文章作者" data-validate="required:请填写文章作者" 
                     value="<?php echo ($currentArticle['author']); ?>"/>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="sitename">所属类别</label>
            </div>
            <div class="field">
              <select name="typeid" class="select">
                        <?php if(is_array($typelist)): foreach($typelist as $key=>$vo): if(($currentArticle['typeid']) == $vo['id']): ?><option value="<?php echo ($vo['id']); ?>" selected="selected"><?php echo ($vo['name']); ?></option> 
                            <?php else: ?>
                                <option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endif; endforeach; endif; ?>
                        
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="readme">文章描述</label>
            </div>
            <div class="field">
              <textarea name="desc" class="input" rows="2" cols="50" 
                        placeholder="请填写文章描述" 
                        data-validate="required:请填写文章描述"><?php echo ($currentArticle['desc']); ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="readme">文章内容</label>
            </div>
            <div class="field">
            
                <textarea name="content" style="width:700px;height:200px;visibility:hidden;">
                 
                    <?php echo ($currentArticle['content']); ?>
                </textarea>
            </div>
          </div>
          <div class="form-button">
            <button name="submit" class="button bg-main" type="submit">提交</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div style='height:40px; border-bottom:1px #DDD solid'></div>
  <p class="text-right text-gray" style="float:right">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>
    
        <script charset="utf-8" src="/Public/kindeditor/kindeditor-all.js"></script>
	<script charset="utf-8" src="/Public/kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="/Public/kindeditor/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '/Public/kindeditor/plugins/code/prettify.css',
				uploadJson : '/Admin/addeditorimg',
				fileManagerJson : '/Public/kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>

</body>
</html>