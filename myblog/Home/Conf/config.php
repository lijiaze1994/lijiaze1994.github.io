<?php
return array(
	//'配置项'=>'配置值'
	//开启session
	// "SESSION_AUTO_START" => false, //默认不开启
	// "SESSION_OPTIONS" => array(
	// 	"expire" => 60, //默认60s
	// ),
	//开启路由
	"URL_ROUTER_ON" => TRUE,
	"URL_ROUTE_RULES" =>array(
		"code" => "Code/showCode",//展示验证码

		//展示文章详情页
		"articledetail/:id" => "Detail/index",
		//展示登录页面
		 "dealLogin" => "Login/login",
		//展示注册页面
		 "dealregister"=>"Register/index",
		//展示文章列表页
		 "articlelist" => "Article/index",
		 //执行查询操作
		 "articlelike" => "Article/search",
		 //执行登录操作
		 "deallogin" => "Login/dealLoign",
		 //执行注销登录
		 "dealLogout"=> "Login/deallogout",
		 //执行注册
		 'dealRegister' => "Register/dealregister",

		 //执行评论
		 "dealcomment" => "Detail/commentinsert",
		 //执行回复
		 "dealreply" => "Detail/dealreply",
	),
);