<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Admin extends Model
{
    public function login($data){
    	$captcha = new \think\captcha\Captcha();
    	if(!$captcha->check($data['code'])){
    		return 3;
    	}
    	$user = Db::name('admin')->where('username','=',$data['username'])->find();
    	if($user){
    		if($user['password']==md5($data['password'])){
    			session('username',$user['username']);
    			session('uid',$user['id']);
    			return 1;//登录成功
    		}else{
    			return 2;//密码错误
    		}
    	}else{
    		return 0;//用户不存在
    	}
    }
}
