<?php 
namespace Admin\Controller;
use Think\Controller;

class TypeController extends \Think\Controller
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
		//获取当前的分页
        $currentPage = isset($_GET['page'])?$_GET['page']:1;
     //取数据  typeModel
        $typeModel = D('Type');
        //判断一下当前是否是通过点击回收站进来
         $map = ['is_delete'=>0];
        if(I('get.isdelete')==1){
            $map = ['is_delete'=>1];
            $this->assign('isdelete',1);//用于页面去判断显示哪一按钮，
        }
       
        $typelist = $typeModel->getTypeList($currentPage,$map);
       //根据查询出来的结果，处理一下
        //处理 父类的名称
        foreach($typelist as $key =>$v)
        {
            $typelist[$key]['pname'] = $typeModel->getNameById($v['pid']);
        }
       // var_dump($typelist);
        $total = $typeModel->getTypeTotal($map);
        $page = page($total,$currentPage,$pnum=6,$pagenum = 5,
                $currenUrl='/Admin/typelist?',$pagename = 'page');
        $this->assign('list',$typelist);
        $this->assign('page',$page);
        //去除列表数据，并在页面上显示
        $this->display();
	}

	//展示添加页面
	public function add()
	{
		$typeModel = D("Type");
		$typelist = $typeModel->getAllType();
		//var_dump($typelist);die;
		$this->assign("list",$typelist);

		$this->display();
	}

	//执行添加操作
	public function insert()
	{
		$model = D("Type");
		//创建数据对象
		if (FALSE === $data = $model->create()) {
			$this->error($model->getError());
		}


		//根据传过来的PID拼接path
		if ($data["pid"] == 0) {
			$data["path"] = 0;
		}else{
			$pidPath = $model->getPidPath($data["pid"]);
			$data["path"] = $pidPath."-".$data["pid"];
		}

		//往数据库里添加数据
		if ($res = $model->data($data)->add()) {
			//成功提示
			$this->success("新增类别成功","/Admin/typelist");
		}else{
			$this->error("新增类别失败".$model->getLastSql());
		}
	}

	//展示编辑页面
	public function edit()
	{	
		//根据id拿到当前类别的信息，发送到模板
		$model = D("Type");
		//var_dump($model);die;
		$currentType = $model->find(I("get.id"));
		//取所有的类别数据，发送到模板
		$typelist = $model->getAllType();
		//var_dump($typelist);die;
		$this->assign("list",$typelist);
		$this->assign("currentType",$currentType);
		$this->display();
	}

	//执行编辑操作
	public function update()
	{
		$model = D("Type");
		//判断是否有值
		if (FALSE === $data = $model->create()) {
			//如果没有 弹出错误信息
			$this->error($model->getError());
		}

		//根据pid 拼接path
		if ($data["pid"] == 0) {
			$data["path"] = 0;
		}else{
			$pidPath = $model->getPidPath($data["pid"]);
			$data["path"] = $pidPath."-".$data["pid"];
		}

		//往数据库里添加数据
		if (FALSE != $model->data($data)->save()) {
			//提示成功
			$this->success("修改类别成功！","/Admin/typelist");
		}else{
			$this->error("修改类别失败！".$model->getLastSql());
		}
	}

	//执行删除操作
	public function delete()
	{
		$model = D("Type");
		$id = I("get.id");
		//判断是否删除成功 is_delete = 1
		if (FALSE != $model->where(["id"=>$id])->setField("is_delete",1)) {
			//删除成功
			$this->success("删除成功！","/Admin/typelist");
		}else{
			//删除失败
			$this->error("删除失败！".$model->getError());
		}
	}

	//事务的批量删除操作
	public function deletes()
	{
		$model = D("Type");
		$idArr = I("post.id");
		//开启事务
		$model->startTrans();
		$tranResult = TRUE;

		foreach ($idArr as $key => $val) {
			$result = $model->where(["id"=>$val])->setField("is_delete",1);
			if ($result == 0) {
				$tranResult = FALSE;
			}
		}

		if ($tranResult === false) {
			$model->rollback();
			$this->error("批量删除失败".$model->getLastSql(),"/Admin/typelist");
		}else{
			$model->commit();
			$this->success("批量删除成功！","/Admin/typelist");
		}
	}


	//恢复删除的类别
	public function recovery()
	{	
		$model = D("Type");
		$id = I("get.id");

		if (false != $model->where(["id"=>$id])->setField("is_delete",0)) {
			//恢复成功
			$this->success("恢复类别成功！","/Admin/typelist/isdelete/1");
		}else{
			$this->error("恢复类别失败！","/Admin/typelist/isdelete/1");
		}
	}


	//批量恢复类别
	public function recoverys()
	{
		$model = D("Type");
		$idArr = I("post.id");
		//var_dump($idArr);die;
		//开启事务
		$model->startTrans();
		$tranResult = TRUE;

		foreach ($idArr as $key => $value) {
			$result = $model->where(["id"=>$value])->setField("is_delete",0);
			if ($result == 0) {
				$tranResult = FALSE;
			}
		}

		if ($tranResult === false) {
			$model->rollback();
			$this->error("批量恢复失败！".$model->getError(),"/Admin/typelist/isdelete/1");
		}else{
			$model->commit();
			$this->success("批量恢复成功！","/Admin/typelist/isdelete/1");
		}

	}
}