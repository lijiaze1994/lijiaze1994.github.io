<?php 
namespace Admin\Controller;

use Think\Controller;

class CommentController extends Controller
{
    //如果没有登录 只能展示登录界面
    public function _before_index()
    {
        if (!session("adminuser")) {
            $this->redirect("/Admin/login");
        }
    }
    public function index()
    {
        //获取当前分页
        $currentPage = isset($_GET["page"])?$_GET["page"]:1;

        $model = D("Comment");
         //判断一下当前是否是通过点击回收站进来
        $map = ['deleted_at'=>0];
        if(I('get.deletedat')==1){
            $map = ['deleted_at'=>1];
            $this->assign('deletedat',1);//用于页面去判断显示哪一按钮，
        }
        //var_dump($model);die;
        $commentlist = $model->getCommentlist($currentPage,$map);
        // dd($commentlist);die;
        $total = $model->getCommentTotal($map);
        //dd($total);die;
        $page = page($total,$currentPage,$pnum = 10,$pagenum = 5,$currenUrl='/Admin/commentlist?',$pagename = 'page');
        $this->assign("commentlist",$commentlist);
        $this->assign("page",$page);
        $this->display();
    }

    //执行删除操作
    public function dealCommentdelete()
    {
        $model = D("Comment");
        $id = I("get.id");
        //判断是否删除成功
        if (FALSE != $model->where(["id"=>$id])->setField("deleted_at",1)) {
            //删除成功
            $this->success("删除成功！");
        }else{
            //删除失败
            $this->error("删除失败！".$model->getError());
        }

    }

    //事务的批量删除操作
    public function commentdeletes()
    {
        $model = D("Comment");
        $idArr = I("post.id");
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
            $this->error("批量删除失败！".$model->getLastSql());
        }else{
            $model->commit();
            $this->success("批量删除成功！");
        }
    }

    //恢复删除的类别
    public function commentrecovery()
    {   
        $model = D("Comment");
        $id = I("get.id");
        // var_dump($id);die;
        if (false != $model->where(["id"=>$id])->setField("deleted_at",0)) {
            //恢复成功
            $this->success("恢复评论成功！","/Admin/commentlist/deletedat/1");
        }else{
            $this->error("恢复评论失败！","/Admin/commentlist/deletedat/1");
        }
    }

    //批量恢复类别
    public function commentrecoveryss()
    {
        
        $model = D("Comment");
        $idArr = I("post.id");
        //var_dump($idArr);die;
        //开启事务
        $model->startTrans();
        $tranResult = TRUE;

        foreach ($idArr as $key => $value) {
            $result = $model->where(["id"=>$value])->setField("deleted_at",0);
            if ($result == 0) {
                $tranResult = FALSE;
            }
        }

        if ($tranResult === false) {
            $model->rollback();
            $this->error("批量恢复失败！".$model->getError(),"/Admin/commentlist/deletedat/1");
        }else{
            $model->commit();
            $this->success("批量恢复成功！","/Admin/commentlist/deletedat/1");
        }

    }


}