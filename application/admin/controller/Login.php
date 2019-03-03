<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Admin;
class Login extends Controller
{
    public function login()
    {
        if(request()->isPost()){
            $admin=new Admin();
            $data = input('post.');
            $num=$admin->login($data);
            if($num==3){
                $this->error('验证码错误');
            }elseif($num==1){
                $this->success('登录成功,正在跳转','index/index');
            }else{
                $this->error('信息错误');
            }
        }
        return $this->fetch();
    }
}
