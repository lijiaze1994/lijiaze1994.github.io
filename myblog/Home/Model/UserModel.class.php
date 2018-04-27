<?php 

namespace Home\Model;
use Think\Model;

class UserModel extends Model
{
    protected $_validate = array(
        array("username","","账号已存在!",0,"unique",1),
        array("repeatpassword","password","两次密码不相同!",0,"confirm"),
        array("password","require","密码必须!"),
        array("repeatpassword","require","确认密码必须!"),
    );


     public function getUserInfo($map=[])
    {
        return $this->where($map)->find();
    }

     // 加盐
    public function getSalt()
   {
       $arr = [array_merge(range('0', '9'),  range('A', 'Z'))];
       $salt = '';
       for($i = 0;$i<5;$i++){
           $salt .= (string)$arr[0][floor(mt_rand(0,35))];
       }
       return $salt;
   }
}