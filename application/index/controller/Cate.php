<?php
namespace app\index\controller;
// use think\Controller;
use think\Db;
use app\index\model\Users;
use app\index\controller\Base;
class Cate extends Base
{
    public function cate()
    {
    	$id=input('id');
    	$catename=Db::name('cate')->find($id);
    	$name = Db::name('article')->where(array('cateid'=>$id))->paginate(3);
    	$this->assign('names',$name); 
    	$this->assign('catename',$catename);
        return $this->fetch();
    }
}
