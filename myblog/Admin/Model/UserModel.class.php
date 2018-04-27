<?php 

namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{
	protected $_validate = array(
		array("valifycode","require","验证码必须!"),
		array("username","require","用户名必须!"),
		array("password","require","密码必须!"),
	);

  

	 public function getUserInfo($map=[])
    {
        return $this->where($map)->find();
    }
}