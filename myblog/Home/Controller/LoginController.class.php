<?php 
namespace Home\Controller;
use Think\Controller;

class LoginController extends CommonController
{	
	//展示登录页面
	public function index()
	{
		$this->display();
	}
	//执行登录操作
	public function dealLogin()
	{	
		$url = I("post.lasturl");
		//var_dump($url);die;
		//比对验证码是否正确
		$verifycode = I("post.verifycode");
		$verify = new \Think\Verify();
		$result = $verify->check($verifycode);
		if (!$result) {
			$this->error("验证码错误！");
		}
		//判断是否为空
		$model = D("User");
		if (FALSE == $data = $model->create($_POST,4)) {
			//判断错误
			$this->error($model->getError());
		}
		//判断用户名和密码是否一致
		//去数据库里面根据用户名先查找到用户信息
		$userInfo = $model->getUserInfo(["username"=>$data["username"]]);
		if (!$userInfo) {
			$this->error("用户名或密码错误！");
		}
		 //存在该用户则比对密码：
		$requirePasswod = md5(md5($data['password']).$userInfo['salt']);
		if ($requirePasswod == $userInfo['password']) {
			//记录session
			session("username",$userInfo);
			//操作成功
			$this->success("成功登录！欢迎".$userInfo["username"],$url);
		}else{
			//操作失败
			$this->error("用户名或密码错误！");
		}
	}
	//执行注销操作
	public function dealLogout()
	{
		//清除session
		session("username",null);
		//跳转到列表页
		$this->success("注销成功！","/Article/index");
	}

}