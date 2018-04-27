<?php 
	
namespace Home\Controller;
use Think\Controller;

class CodeController extends Controller
{
	//显示验证码
	public function showCode()
	{
		$Verify = new \Think\Verify();
		//防止验证码不显示
		ob_clean();
		$Verify->fontSize = 50;
		$Verify->length = 2;
		$Verify->useNoise = false;
		$Verify->entry();
	}



}