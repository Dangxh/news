<?php
namespace app\admin\controller;
// use think\Controller;
use app\admin\controller\Base;
use app\admin\model\Admin as Adminmodel;
use think\Db;
class Admin extends Base
{
    public function lst()
    {
        $list = Adminmodel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	if(request()->isPost()){
    		$data=[
    			'username'=>input('username'),
    			'password'=>md5(input('password')),
    		];
    		$validate = \think\Loader::validate('Admincheck');
    		if(!$validate->scene('add')->check($data)){
    			$this->error($validate->geterror());
    			die;
    		}
    		if(Db::name('admin')->insert($data)){
    			return $this->success('添加成功！','lst');
    		}else{
    			return $this->error('添加失败');
    		}
    	}
        return $this->fetch();
    }
    public function edit()
    {
        $name = Db::name('admin')->where('id',input('id'))->find();
        $this->assign('name',$name);
        if(request()->isPost()){
            $data = [
                'id'=>input('id'),
                'username'=>input('username'),
            ];
            if(input('password')){
                $data['password']=md5(input('password'));
            }
            else{
                $data['password']=$name['password'];
            }  
            $validate = \think\Loader::validate('Admincheck');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->geterror());
                die;
            }              
            if(Db::name('admin')->update($data)){
                $this->success('修改管理员信息成功','lst');
            }
            else{
                $this->error('修改管理员信息失败');
            }
            // return;
        }
        return $this->fetch();
    }
    public function del(){
        $id = input('id');
        if($id != 26){
            if(Db::name('admin')->where('id',$id)->delete()){
                $this->success('删除管理员成功','lst');
            }else{
                $this->error('删除管理员信息失败');
            }
        }
        else{
            $this->error('超级管理员不能删除');
        }
    }
    public function logout(){
        session(null);
         $this->success('退出成功','login/login');
    }
}
