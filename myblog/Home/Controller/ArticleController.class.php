<?php 
namespace Home\Controller;
use Think\Controller;

class ArticleController extends CommonController
{
  
	public function index()
	{
		//获取当前分页
		$currentPage = isset($_GET['page'])?$_GET['page']:1;

		$articleModel = D("Article");
		$map = ['deleted_at'=>0];
		$articlelist = $articleModel->getArticlelist($currentPage,$map);
		$total = $articleModel->getArticleTotal($map);
        $page = page($total,$currentPage,$pnum = 6,$pagenum = 5,$currenUrl='',$pagename = 'page');
        //获取文章数据，并在页面上显示
        $this->assign('articlelist',$articlelist);
        $this->assign('page',$page);
        $this->display();
   	}
	

    //查询
    public function search()
    {
        //获取输入的内容
        $like = I("get.search");
        //var_dump($like);die;
        //获取当前分页
        $currentPage = isset($_GET['page'])?$_GET['page']:1;

        $articleModel = D("Article");
        $map["title"] = array("like","%$like%");
        

        // var_dump($map);die;
        // 判断是否存在搜索值
        if (empty($like)) {
            //如果不存在 则输出所有文章
            //得到所有文章
            $total = $articleModel->getArticleTotal();
            $articlelist = $articleModel->getArticlelist($currentPage);
        }else{
            //得到查询的文章
            $total = $articleModel->getLikeTotal($map);
            $articlelist = $articleModel->getLikeArticle($currentPage,$map);
        }
        //获取分页
        $page = page($total,$currentPage,$pnum = 6,$pagenum = 5,
                $currenUrl='',$pagename = 'page');
         //获取文章数据，并在页面上显示
        $this->assign('articlelist',$articlelist);
        $this->assign('page',$page);
        $this->display("index");  
    }
}