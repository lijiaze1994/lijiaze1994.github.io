<?php 
namespace Home\Controller;
use Think\Controller;

class DetailController extends Controller
{
	//展示详情页
	public function index()
	{	
		$id = I("get.id");
		$model = D("Article");
		//按文章id查找
		$currentArticle = $model->find($id);
		$this->assign("currentArticle",$currentArticle);
		 //获取当前分页
        $currentPage = isset($_GET["page"])?$_GET["page"]:1;
        // 实例化评论
        $commentmodel = D("Comment");   
       // $map = ['article_id'=>$id];
        $map = ['article_id'=>$id];
        $commentlist = $commentmodel->getCommentlist($currentPage,$map);
       //($commentlist);die;
        foreach ($commentlist as $key => $value) {
        	$commentlist[$key]["quoteInfo"] = $commentmodel->getCommentreply($value['quote_id']); 
        }
        //dd($commentlist);die; 
        $total = $commentmodel->getCommentTotal($map);
        //var_dump($total);die;
        $page = page($total,$currentPage,$pnum = 10,$pagenum = 5,
                $currenUrl='/Home/articlelist?',$pagename = 'page');
        //获取评论数据，并在页面上显示
        $this->assign('commentlist',$commentlist);
        // $this->assign("replylist",$replylist);
        $this->assign('page',$page);
		$this->display();
	}

	//执行评论添加
	public function commentinsert()
	{	
		$comment = I("post.");
		$id = I("post.id");
		//var_dump($id);die;
		//var_dump($comment);die;
		$commentmodel = D("Comment");
		// var_dump($commentmodel);die;
		//创建数据对象
		if (FALSE === $data = $commentmodel->create()) {
			$this->error($commentmodel->getError());
		}
		//var_dump($data);die;
		//执行添加操作
		if ($result = $commentmodel->data($data)->add()) {
			//评论成功
			$this->success("评论成功!");
		}else{
			$this->error("失败");
		}
	}

	//执行回复评论
	public function dealreply()
	{	
		$reply = I("post.");
		$id = I("post.quote_id");
		
		//创建数据对象
		$replylist = D("Comment");
		if (FALSE === $data = $replylist->create()) {
			$this->error($replylist->getError());
		}
		//执行回复添加操作
		if ($replylist->data($data)->add()) {
			//回复成功
			$this->success("回复成功！");
		}else{
			//回复失败
			$this->error("回复失败！");
		}

	}


}