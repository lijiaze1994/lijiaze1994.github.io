<?php 
namespace Admin\Model;

use Think\Model;
use Admin\Model\ArticleModel;

class CommentModel extends \Think\Model
{
    //获取评论总条数
    public function getCommentlist($currentPage,$map=[])
    {
        $articlemodel = new ArticleModel;
        $list = $this->where($map)->page($currentPage,10)->order("id desc")->select();
        foreach ($list as $key => $value) {
            $list[$key]["article"] = $articlemodel->getNameById[$value["id"]];
        }
        return $list;
    }

    //获取评论总条数
    public function getCommentTotal($map=[])
    {
        return  $this->where($map)->count();
    }


}