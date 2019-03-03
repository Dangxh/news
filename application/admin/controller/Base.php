<?php
namespace app\admin\controller;
use think\Controller;

class Base extends Controller
{
	public function _initialize(){
		// echo '10';
		if(!session('username')){
			return $this->error('请先登录系统','login/login');
		}
	}
}
