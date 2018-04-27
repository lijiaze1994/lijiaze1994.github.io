<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/Public/home/css/details.css?12">
	<link href="/Public/home/css/comment.css?123" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/Public/home/css/page.css">
</head>
<body>
	<div class="container">
		<header>
			<div class="nav">
					<h1>Lee By HTML5 up</h1>
					<ul class="nav-ul">
						<a href="/Article/index"><li class="home">Home</li></a>
						<a href="#" style="color: #ffffff">
							<li class="top-li-xia">菜单
								<div class="erji">
									<ul class="erji-ul">
										<li class="sanjiao"></li>
											<a href="h5.html"><li class="erji-li erji-li1">HTML5/CSS3</li></a>
											<a href="js.html"><li class="erji-li">JS实例</li></a>
											<a href="php.html"><li class="erji-li">PHP</li></a>
											<a href="linux.html"><li class="erji-li">Linux</li></a>
											<a href="link.html"><li class="erji-li">联系</li></a> 
											<a href="about.html"><li class="erji-li erji-li6">关于我</li></a>
									</ul>
								</div>
							</li>		
						</a>
						<a href="#"><li class="top-li-btn">顶部</li></a>
						<?php if(empty($_SESSION['username'])): else: ?>
						<a href="/Login/dealLogout"><li class="top-li-btn out"><?php echo ($_SESSION['username']['username']); ?>,注销登录</li></a><?php endif; ?>
					</ul>
				</div>
			</header>
		<section>
			<div class="sec-l">
				<h1 class="sec-l-h1">
					<?php echo ($currentArticle['title']); ?>
				</h1>
				<div style="text-align: center; padding-top: 20px;">
				<span class="sec-span">作者:<?php echo ($currentArticle['author']); ?></span></div>
				<div style="text-align: center; padding-top: 10px;">
				<span>发布时间：<?php echo (date("Y-m-d H:i:s",$currentArticle["created_at"])); ?></span></div>
				<!-- <span>发布时间：<?php echo ($currentArticle['created_at']); ?></span></div> -->
				<p class="sec-l-p1">			
					<?php echo htmlspecialchars_decode($currentArticle['content']);?>
				</p>
			</div>
			<div class="sec-r">
			</div>	
		</section>	
			<?php if(empty($_SESSION['username'])): ?><span class="y mtm mrm tp-sp">(账号未登录不能评论)&gt;&gt;&gt;去 <a class="tp-sp-a" href="/Login/index" >登录</a></span>
			<?php else: ?>
			
								<!-- 作品详情页评论 -->
				<div class="wpn">    		
	 			<div class="main">
	 				<form class="comment-form" action="/Detail/commentinsert" method="post">
	 					<input type="hidden" name="article_id" value="<?php echo ($currentArticle['id']); ?>">
	 					<input type="hidden" name="publish_user_name" value="<?php echo ($_SESSION['username']['username']); ?>">
	 					<input type="hidden" name="publish_user_id" value="<?php echo ($_SESSION['username']['id']); ?>">
	 					<textarea id="" class="" name="content"></textarea>
	 					<div class="mtm cl">
	 						<button class="y btn btn-primary btn-fixed-n" type="submit">评论</button>
	 					</div>
	 				</form>
	 				<h2 class="comment-tit">评论列表</h2>
					<ul class="comment comment-inner cl">
						<?php if(is_array($commentlist)): foreach($commentlist as $key=>$vo): ?><li class="cl">							
									<a class="avatar" title="" href="javascript:;">
										<img src="/Public/home/images/avatar.jpg" alt="<?php echo ($vo['publish_user_name']); ?>">
									</a>
									<div class="comment-cont">
										<h5 class="user"><a href="">&nbsp;</a></h5>
										<p class="text"><a href=""><?php echo ($vo['publish_user_name']); ?></a>：<?php echo ($vo["content"]); ?></p>
										<p class="data cl">
											<time><?php echo (date("Y-m-d H:i:s",$vo['created_at'])); ?></time>
				                            <a class="op y" href="javascript:;">已赞(<em>1</em>)</a>
											<a class="op comment-toggle y" href="javascript:;">回复</a>
												<span class="oper y">
					                            <a href="javascript:;">从首页删除</a>
					                        	<a class="inform-toggle" href="javascript:;">举报(<em>1</em>)</a>
					                        </span>
										</p>
										<?php if(empty($vo['quote_id'])): else: ?>
											
											<div class="com-reply">
				 								<p class="text"><a href="">@<?php echo ($vo["quoteInfo"]['publish_user_name']); ?></a>：<?php echo ($vo["quoteInfo"]["content"]); ?></p><span><?php echo (date("Y-m-d H:i:s",$vo['created_at'])); ?></span>
				 								<a class="all allreply-toggle" href="javascript::">全部对话</a>
	 										</div><?php endif; ?>

				


					                    <form class="comment-form comment-form-inner" action="/Detail/dealreply" method="post">
					                    	<input type="hidden" name="quote_id" value="<?php echo ($vo['id']); ?>">
					                    	<input type="hidden" name="article_id" value="<?php echo ($currentArticle['id']); ?>">
					                    	<input type="hidden" name="publish_user_name" value="<?php echo ($_SESSION['username']['username']); ?>">
					                    	<input type="hidden" name="publish_user_id" value="<?php echo ($_SESSION['username']['id']); ?>">
					                        <textarea class="" name="content" id=""></textarea>
					                        <p class="mtm">                 	
					                            <button class="btn btn-primary y" type="submit">回复</button>
					                            <a href="javascript:;" class="btn btn-nature mrn y">取消 </a>
					                        </p>
					                    </form>
									</div><?php endforeach; endif; ?>
						</li>
					</ul>	
					<div class="pu_page mtm" >
          				  <?php echo ($page); ?>
           			</div>
					
	 				
	 			</div><?php endif; ?>
















		<footer>
			<div class="foot-img">
				<ul>
					<a href="https://github.com/lijiaze1994" title="Github"><li class="foot-img-li1"></li></a>
					<a href="https://weibo.com/5935977551/profile?topnav=1&wvr=6&is_all=1" title="新浪微博"><li class="foot-img-li2"></li></a>
					<a href="javascript:void(0)" title="微信"><li class="foot-img-li3">
						<div class="erweima">
							<img src="/Public/home/images/weixinerweima.jpg">
						</div>
					</li></a>
					<a href="javascript:void(0)" title="联系电话"><li class="foot-img-li4"></li></a>
					<a href="http://www.renren.com/897660114/profile" title="人人"><li class="foot-img-li5"></li></a>
				</ul>
			</div>
		</footer>
	</div>
</body>
<script src="/Public/home/js/jquery.js"></script>
	<script>
		//详情页回复评论框显示隐藏
		$(".comment-toggle").on("click",function(){
			$(this).parents(".comment-cont").find(".comment-form-inner").slideDown();
			$(".comment-form-inner .btn-nature").on("click",function(){
				$(this).parents(".comment-form-inner").slideUp();
			});
		});
		// 滑过显示 回复 已赞 举报
	    $('.comment li').hover(function(){
	        $(this).find('.oper').show();
	    }, function(){
	        $(this).find('.oper').hide();
	    });
		//展开全部对话
		var allReplyToggle = true
	    $(".allreply-toggle").on("click",function(){
	    	if( allReplyToggle == true ) {
	    		$(this).parent(".com-reply").next(".com-reply-inner").show();
	    		allReplyToggle = false;
	    	} else{
	    		$(this).parent(".com-reply").next(".com-reply-inner").hide();
	    		allReplyToggle = true;
	    	}
			
		});

	</script>
</html>