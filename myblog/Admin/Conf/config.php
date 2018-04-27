<?php
return array(
	//'配置项'=>'配置值'
	//开启路由
	"URL_ROUTER_ON" => TRUE,//是否开启URL路由
	"URL_ROUTE_RULES" => array(
	"login" => "Login/index",//展示登录页面
	"dealLogin" => "Login/dealLogin",
	"dealLogout" => "Login/dealLogout",


	//显示类别列表
	'typelist'=>'Type/index',
	 //展示添加页面
	'typeadd'=>'Type/add', 
	// 执行添加操作
	'dealtypeadd'=>'Type/insert',
	//展示编辑页面
	"typeedit/:id" => "Type/edit",
	//执行修改操作
	'dealtypeedit' => "Type/update",
	//删除单个类别
	'dealtypedelete/:id'=>'Type/delete',
	 //批量删除类别(事务)
	'dealtypedeletes'=>'Type/deletes',   
	//恢复被删除的类别
    'typerecovery/:id'=>'Type/recovery',
    //批量恢复类别
    "typerecoverys" => "Type/recoverys",

	//展示文章列表
	'articlelist'=>'Article/index',  
	//展示文章添加页面
	"articleadd"=> "Article/add", 
	// 执行文章添加操作 
	'dealarticleadd'=>'Article/insert',
	//编辑器单张图片上传 
	'addeditorimg'=>'File/uploadEditorImage',
	//展示文章编辑页面
	'articleedit/:id'=>'Article/edit',
	//执行文章编辑操作
	"dealarticleedit"=>"Article/update",
	//删除单个文章
	"dealarticledelete/:id" =>"Article/delete",
	//批量删除文章
	"dealarticledeletes"=>"Article/deletes",
	//恢复被删除的文章
	"articlerecovery/:id" => "Article/recovery",
	//批量恢复删除的文章
	'articlerecoverys' => "Article/recoverys",

	//展示评论列表页面
	"commentlist" => "Comment/index",
	//执行删除评论
	"dealcommentdelete/:id" => "Comment/dealCommentdelete",
	//执行批量删除
	'dealCommentdeletes' => "Comment/commentdeletes",
	//恢复评论
	"dealcommentrecovery/:id"=>"Comment/commentrecovery",
	"dealcommentrecoveryss"=>"Comment/commentrecoveryss",
	),
);