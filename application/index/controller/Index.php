<?php
namespace app\index\controller;
// use think\Controller;
use think\Db;
use app\index\controller\Base;
// use app\index\model\Users;
class Index extends Base
{
    public function index()
    {
        $article = cache('article');
        if(empty($article)){
            $article=Db::name('article')->order('click Asc')->select();
//            dump($article);
            cache('article',$article,2000);
        }
//        dump(cache('article'));
    	$this->assign('cateres',cache('article'));
        return $this->fetch();
    }
}
