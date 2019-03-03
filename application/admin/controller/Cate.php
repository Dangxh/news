<?php
namespace app\admin\controller;
// use think\Controller;
use app\admin\controller\Base;
use app\admin\model\Cate as Catemodel;
use think\Db;
class Cate extends Base
{
    public function lst()
    {
        $list = Catemodel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	if(request()->isPost()){
    		$data=[
    			'catename'=>input('catename')
    		];
    		$validate = \think\Loader::validate('Catecheck');
    		if(!$validate->scene('add')->check($data)){
    			$this->error($validate->geterror());
    			die;
    		}
    		if(Db::name('cate')->insert($data)){
    			return $this->success('添加成功！','lst');
    		}else{
    			return $this->error('添加失败');
    		}
    	}
        return $this->fetch();
    }
    public function edit()
    {
        $name = Db::name('cate')->where('id',input('id'))->find();
        $this->assign('name',$name);
        if(request()->isPost()){
            $data = [
                'id'=>input('id'),
                'catename'=>input('catename'),
            ];
            $validate = \think\Loader::validate('Catecheck');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->geterror());
                die;
            }              
            if(Db::name('cate')->update($data)){
                $this->success('修改栏目信息成功','lst');
            }
            else{
                $this->error('修改栏目信息失败');
            }
            // return;
        }
        return $this->fetch();
    }
    public function del(){
        $id = input('id');
        if(Db::name('cate')->where('id',$id)->delete()){
            $this->success('删除栏目成功','lst');
        }
        else{
            $this->error('删除栏目信息失败');
        }
    }
}
