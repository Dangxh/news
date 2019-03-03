<?php
namespace app\index\controller;
// use think\Controller;
use app\index\controller\Base;
use think\Db;
use app\index\model\Users;
class Article extends Base
{
    public function article()
    {
    	$id=input('id');
    	Db::name('article')->where(array('id'=>$id))->setInc('click',1);
    	$name=Db::name('article')->find($id);
        $relat=$this->relat($name['keywords'],$name['id']);
    	$cate=Db::name('cate')->find($name['cateid']);
    	$res=Db::name('article')->where(array('cateid'=>$name['cateid'],'state'=>1))->limit(8)->select();
    	$this->assign('res',$res);
    	$this->assign('cate',$cate);
    	$this->assign('name',$name);
        $this->assign('relat',$relat);
        return $this->fetch();
    }
    public function relat($keywords,$id){
        $arr=explode(',',$keywords);
        static $relatres=array();
        foreach ($arr as $k => $v) {
            $map['keywords']=['like','%'.$v.'%'];
            $map['id']=['neq',$id];
            $relatres=Db::name('article')->where($map)->order('id desc')->limit(8)->select();
        }
        if($relatres){
            $relatres=unique($relatres);
            return $relatres;
        }
    }
}
