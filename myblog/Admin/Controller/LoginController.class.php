<?php 

namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller
{
	//展示登录页面
	public function index()
	{
		$this->display();
	}


	//执行登录
	public function dealLogin()
	{
		//比对验证码
		$verifycode = I('post.verifycode');
		$verify = new \Think\Verify();
		$result = $verify->check($verifycode);
		if(!$result)
		{
			$this->error("验证码错误");
		}

		//自动验证 创建数据集
		$model =  D('User');
       if(FALSE  == $data = $model->create())
        {
             $this->error($model->getError());
        }
        //判断用户名和密码是否一致
       //去数据库里面根据用户名先查找到用户信息
       $userInfo =  $model->getUserInfo(['username'=>$data['username']]);
       
        if(!$userInfo)
        {
            $this->error('用户或者密码错误！');
        }
        //存在该用户则比对密码：
        $requirePasswod = md5(md5($data['password']).$userInfo['salt']);
       if( $requirePasswod == $userInfo['password'])
       {
           //记录session
            session('adminuser',$userInfo);
           //跳转到后台首页
            $this->success('登录成功！','/Admin');
           //echo "登录成功";
       }else{
            $this->error('用户或者密码错误！');
          
       }



	}

	//注销登录
	public function dealLogout()
	{
		//清楚session
		session("adminuser",null);
		//跳转到登录页面
		$this->redirect("/Admin/login");
	}

}