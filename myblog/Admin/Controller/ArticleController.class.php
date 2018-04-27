<?php 
namespace Admin\Controller;

use Think\Controller;

class ArticleController extends CommonController
{
	//如果没有登录 只能展示登录界面
	public function _before_index()
    {
        if (!session("adminuser")) {
            $this->redirect("/Admin/login");
        }
    }
	//展示列表页
	public function index()
	{	
		//获取当前分页
		$currentPage = isset($_GET['page'])?$_GET['page']:1;
        $articleModel = D('Article'); 
        //判断一下当前是否通过点击回收站进来
        $map = ['deleted_at'=>0];
        if (I("get.deletedat") == 1) {
      		$map =["deleted_at"=>1];
      		// 用于页面判断显示哪一个按钮
      		$this->assign("deletedat",1);
        }
        // var_dump($map);die;
        $list = $articleModel->getArticlelist($currentPage,$map);
        // var_dump($list);die;
        $total = $articleModel->getArticleTotal($map);
        $page = page($total,$currentPage,$pnum = 6,$pagenum = 5,
                $currenUrl='/Admin/articlelist?',$pagename = 'page');
      
      
        //获取文章数据，并在页面上显示
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->display();

	}


	//展示文章添加页面
	public function add(){

		$typeModel = D("Type");
		$typelist = $typeModel->getAllType();
		$this->assign("typelist",$typelist);
		$this->display();
	}

	//执行添加操作
	public function insert()
	{
		$articleModel = D("Article");
		//创建数据对象
		if (FALSE === $data = $articleModel->create()) {
			$this->error($articleModel->getError());
		}
		//加一步文件上传操作处理
		$file = A("File");
		$savePath = $file->uploadOneImage("cover");
		$data["cover"] = "/Public/uploads".$savePath;
		$data["created_at"] = time();
		//执行添加操作
		if ($result = $articleModel->data($data)->add()) {
			//添加成功
			$this->success("新增文章成功！","/Admin/articlelist");
		}else{
			//添加失败
			$this->error("新增文章失败！".$articleModel->getLastSql());
		}
	}

	//展示编辑页面
	public function edit()
	{
		$id = I("get.id");
		$model = D("Article");
		$currentArticle = $model->find($id);
		$this->assign("currentArticle",$currentArticle);

		//获取文章信息展示到页面
		$typeModel = D("Type");
		$typelist = $typeModel->getAllType();
		$this->assign("typelist",$typelist);
		$this->display();

	}

	//执行编辑操作
	public function update()
	{
		$articleModel = D("Article");
		//获取编辑页面中的文章内容
		$data = I("post.");
		//创建数据对象
		if (FALSE === $articleModel->create()) {
			$this->error($articleModel->getError());
		}
		if ($_FILES["cover"]["error"] != 4) {
			//加一步文件上传处理
			$file = A("File");
			$savePath = $file->uploadOneImage("cover");
			$data["cover"] = "/Public/uploads".$savePath;
		}
		//执行添加操作
		if ($result = $articleModel->data($data)->save()) {
			//编辑成功
			$this->success("编辑文章成功！","/Admin/articlelist");
		}else{
			//编辑失败
			$this->error("编辑文章失败！".$articleModel->getLastSql());
		}
	}

	//执行删除操作
	public function delete()
	{
		$model = D("Article");
		$id = I("get.id");
		//判断是否成功删除
		if (FALSE != $model->where(["id"=>$id])->setField("deleted_at",1)) {
			//删除成功
			$this->success("删除文章成功！","/Admin/articlelist");
		}else{
			//删除失败
			$this->error("删除文章失败！".$model->getError());
		}
	}

	//执行批量删除操作(事务)
	public function deletes()
	{	
		$model = D("Article");
		$idArr = I("post.id");
		//var_dump($idArr);die;
		//开启事务
		$model->startTrans();
		$tranResult = TRUE;

		foreach ($idArr as $key => $val) {
			$result = $model->where(["id"=>$val])->setField("deleted_at",1);
			if ($result == 0) {
				$tranResult = FALSE;
			}
		}

		if ($tranResult === false) {
			$model->rollback();
			$this->error("批量删除失败".$model->getLastSql(),"/Admin/Articlelist");
		}else{
			$model->commit();
			$this->success("批量删除成功！","/Admin/Articlelist");
		}


	}


	//执行恢复操作
	public function recovery()
	{
		$model = D("Article");
		$id = I("get.id");
		//判断
		if (FALSE != $model->where(["id"=>$id])->setField("deleted_at",0)) {
			//恢复成功
			$this->success("恢复文章成功！","/Admin/articlelist/deletedat/1");
		}else{
			//恢复失败
			$this->error("恢复文章失败！".$model->getError());
		}
	}

	//批量恢复操作
	public function recoverys()
	{
		$model = D("Article");
		$idArr = I("post.id");

		//开启事务
		$model->startTrans();
		$tranResult = TRUE;

		foreach ($idArr as $key => $value) {
			$result = $model->where(["id"=>$value])->setField("deleted_at",0);
			if ($result == 0) {
				$tranResult = false;
			}
		}

		if ($tranResult === FALSE) {
			$model->rollback();
			$this->error("批量恢复失败!".$model->getError(),"/Admin/articlelist/deletedat/1");
		}else{
			$model->commit();
			$this->success("批量恢复成功！","/Admin/articlelist/deletedat/1");
		}

	}
}
