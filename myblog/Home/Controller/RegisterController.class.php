<?php 
namespace Home\Controller;
use Think\Controller;

class RegisterController extends CommonController
{

	//展示页面
	public function index()
	{
		$this->display();
	}

    //执行注册操作
    public function dealregister()
    {
       //比对验证码
       $verifycode = I("post.verifycode");
       $verify = new \Think\Verify();
       $result = $verify->check("$verifycode");
       if (!$result) {
           $this->error("验证码输入错误！");
       }

       //自动验证 创建数据集
       $model = D("User");
       if (FALSE == $data = $model->create()) {
           $this->error($model->getError());
       }
       $salt = $model->getSalt();

       $userInfo = array(
       "username" => I("post.username"),
       "password" => md5(md5(I("post.password")).$salt),
       "repeatpassword" => md5(md5(I("post.repeatpassword")).$salt),
        );

       $userInfo['salt'] = $salt;
       
       if (!$model->validate($userInfo)->create()) {
           $this->error("注册失败！");
       }else{
            if (FALSE === $model->data($userInfo)->add()) {
               $this->error("添加用户失败");
            }else{
                $this->success("注册成功！请登录！","/Login/index");
           }

       }
       
       

    }
}
