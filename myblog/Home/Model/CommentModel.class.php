<?php 
namespace Home\Model;

use Think\Model;
use Home\Model\TypeModel;


class CommentModel extends Model
{       
    public $_auto = array(
        array('updated_at','time',2,'function'),//编辑的时候自动完成 
        array('created_at','time',1,'function'),//新增的时候自动完成 
    );

    public function getCommentlist($currentPage,$map=[])
    {
        //获取当前分页
        $typemodel = new TypeModel;
        $list = $this->where($map)->page($currentPage,10)->order("id desc")->select();

        foreach ($list as $key => $value) {
            $list[$key]["comment"] = $typemodel->getNameById[$value["id"]];     
        }
       
        //dd($quoteInfo);die;
        // $newList = [];

        // foreach ($list as $key => $value) {
        //     if($value['quote_id'] == 0) {
        //         $child = [];
        //         foreach ($list as $ke => $article) {
        //             if($value['id'] == $article['quote_id']) {
        //                 $child[] = $article;
        //             }
        //         }
        //         $value['child'] = $child;
        //         $newList[] = $value;
        //     }
        // }
        return $list;
    }
    //获取评论总数
    public function getCommentTotal($map=[])
    {
        return $this->where($map)->count();
    }

    //回复
    public function getCommentreply($quoteid)
    {
        return  $this->where(["id" => $quoteid])->find();

    }
}