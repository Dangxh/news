<?php
namespace app\admin\controller;
// use think\Controller;
use app\admin\controller\Base;
use app\admin\model\Links as linksmodel;
use think\Db;
class Links extends Base
{
    public function lst()
    {
        $list = linksmodel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	if(request()->isPost()){
    		$data=[
    			'title'=>input('title'),
    			'url'=>input('url'),
                'desc'=>input('desc'),
    		];
    		$validate = \think\Loader::validate('Linkscheck');
    		if(!$validate->scene('add')->check($data)){
    			$this->error($validate->geterror());
    			die;
    		}
    		if(Db::name('links')->insert($data)){
    			return $this->success('添加成功！','lst');
    		}else{
    			return $this->error('添加失败');
    		}
    	}
        return $this->fetch();
    }
    public function edit()
    {
        $name = Db::name('links')->where('id',input('id'))->find();
        $this->assign('name',$name);
        if(request()->isPost()){
            $data = [
                'id'=>input('id'),
                'title'=>input('title'),
                'url'=>input('url'),
                'desc'=>input('desc'),
            ];
            $validate = \think\Loader::validate('Linkscheck');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->geterror());
                die;
            }              
            if(Db::name('links')->update($data)){
                $this->success('修改链接信息成功','lst');
            }
            else{
                $this->error('修改链接信息失败');
            }
            // return;
        }
        return $this->fetch();
    }
    public function del(){
        $id = input('id');
        if(Db::name('links')->where('id',$id)->delete()){
            $this->success('删除链接成功','lst');
        }
        else{
            $this->error('删除链接信息失败');
        }
    }
}
