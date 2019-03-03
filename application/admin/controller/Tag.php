<?php
namespace app\admin\controller;
// use think\Controller;
use app\admin\controller\Base;
// use app\admin\model\Links as linksmodel;
use think\Db;
class Tag extends Base
{
    public function lst()
    {
        $list =Db::name('tags')->paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	if(request()->isPost()){
    		$data=[
    			'tagname'=>input('tagname'),
    		];
    		$validate = \think\Loader::validate('Tagcheck');
    		if(!$validate->scene('add')->check($data)){
    			$this->error($validate->geterror());
    			die;
    		}
    		if(Db::name('tags')->insert($data)){
    			return $this->success('添加标签成功！','lst');
    		}else{
    			return $this->error('添加标签失败');
    		}
    	}
        return $this->fetch();
    }
    public function edit()
    {
        $name = Db::name('tags')->where('id',input('id'))->find();
        $this->assign('name',$name);
        if(request()->isPost()){
            $data = [
                'id'=>input('id'),
                'tagname'=>input('tagname'),
            ];
            $validate = \think\Loader::validate('Tagcheck');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->geterror());
                die;
            }              
            if(Db::name('tags')->update($data)){
                $this->success('修改标签信息成功','lst');
            }
            else{
                $this->error('修改标签信息失败');
            }
            // return;
        }
        return $this->fetch();
    }
    public function del(){
        $id = input('id');
        if(Db::name('tags')->where('id',$id)->delete()){
            $this->success('删除标签信息成功','lst');
        }
        else{
            $this->error('删除标签信息失败');
        }
    }
}
