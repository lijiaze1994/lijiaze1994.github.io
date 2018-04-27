<?php 

namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller
{
	public function _initialize()
    {
        if(!session('adminuser')){
            $this->redirect('/Admin/login');
        }else{
             $this->assign('adminUser',session('adminuser'));
        }
    }
		
	


}