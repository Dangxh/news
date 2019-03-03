<?php
namespace app\admin\controller;
// use think\Controller;
use app\admin\controller\Base;
use app\admin\model\Article as Articlemodel;
use think\Db;
class Article extends Base
{
    public function lst()
    {
        // $list = Articlemodel::paginate(3);
        // $list=Db::name('article')->alias('a')->join('cate c','c.id=a.cateid')->field('a.id,a.title,a.pic,a.author,a.state,c.catename')->paginate(3);
        $list = Articlemodel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	if(request()->isPost()){
            // dump($_POST);
            // die;
    		$data=[
    			'title'=>input('title'),
    			'author'=>input('author'),
                'keywords'=>str_replace('，', ',', input('keywords')),
                'desc'=>input('desc'),
                'cateid'=>input('cateid'),
                'content'=>input('content'),
                'time'=>time()
    		];
            if(input('state')=='on'){
                $data['state']=1;
            }
            if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH.'public'.DS.'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            }
    		$validate = \think\Loader::validate('Articlecheck');
    		if(!$validate->scene('add')->check($data)){
    			$this->error($validate->geterror());
    			die;
    		}
    		if(Db::name('Article')->insert($data)){
    			return $this->success('添加文章成功！','lst');
    		}else{
    			return $this->error('添加文章失败');
    		}
    	}
        $catename=Db::name("cate")->select();
        $this->assign('catename',$catename);
        return $this->fetch();
    }
    public function edit()
    {
        $name = Db::name('Article')->where('id',input('id'))->find();
        $this->assign('name',$name);
        if(request()->isPost()){
            $data = [
                'id'=>input('id'),
                'title'=>input('title'),
                'author'=>input('author'),
                'keywords'=>str_replace('，', ',', input('keywords')),
                'desc'=>input('desc'),
                'cateid'=>input('cateid'),
                'content'=>input('content'),
            ];
            if(input('state')=='on'){
                $data['state']=1;
            }else{
                $data['state']=0;
            }
            if($_FILES['pic']['tmp_name']){
                @unlink(SITE_URL.'/static'.$name['pic']);
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH.'public'.DS.'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            }
            $validate = \think\Loader::validate('Articlecheck');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->geterror());
                die;
            }              
            if(Db::name('Article')->update($data)){
                $this->success('修改文章信息成功','lst');
            }
            else{
                $this->error('修改文章信息失败');
            }
            // return;
        }
        $catename=Db::name("cate")->select();
        $this->assign('catename',$catename);
        return $this->fetch();
    }
    public function del(){
        $id = input('id');
        if(Db::name('Article')->where('id',$id)->delete()){
            $this->success('删除文章成功','lst');
        }
        else{
            $this->error('删除文章信息失败');
        }
    }
}
