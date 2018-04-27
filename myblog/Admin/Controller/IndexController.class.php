<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    //如果没有登录 只能展示登录界面
    public function _before_index()
    {
        if (!session("adminuser")) {
            $this->redirect("/Admin/login");
        }
    }
    public function index(){
      	$this->display();
    }
}