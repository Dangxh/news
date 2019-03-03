<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Base extends Controller
{
	public function _initialize(){
		$this->right();
		$category=Db::name('cate')->order('id Asc')->select();
		$tag=Db::name('tags')->order('id Asc')->select();
		$this->assign('tag',$tag);
    	$this->assign('category',$category);
	}
	public function right(){
		$clicker=Db::name('article')->order('click desc')->limit(4)->select();
		$tuijian=Db::name('article')->where(array('state'=>1))->order('click desc')->limit(4)->select();
		$this->assign(array(
			"clicker"=>$clicker,
			"tuijian"=>$tuijian
			));
	}
}
