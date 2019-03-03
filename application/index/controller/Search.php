<?php
namespace app\index\controller;
// use think\Controller;
use think\Db;
use app\index\controller\Base;
// use app\index\model\Users;
class Search extends Base
{
    public function search()
    {
    	$keywords=input('keywords');
    	if($keywords){
    		$map['title']=['like','%'.$keywords.'%'];
    		$search=Db::name('article')->where($map)->order('id desc')->paginate($listRows = 3,$simple=false,$config=[
    			'query'=>array('keywords'=>$keywords),
                ]);
    		$this->assign(array(
    			'search'=>$search,
    			'keywords'=>$keywords
    			));
    	}else{
    		$this->assign(array(
    			'search'=>null,
    			'keywords'=>$keywords
    			));
    	}
    	return $this->fetch();
    }
}
