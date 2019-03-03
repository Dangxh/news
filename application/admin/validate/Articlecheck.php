<?php
namespace app\admin\validate;
use think\Validate;

class Articlecheck extends Validate
{
    protected $rule = [
    	'title'=>'require|max:25',
    	'cateid'=>'require',
    ];
    protected $message = [
    	'title.require'=>'文章标题必须填写',
    	'title.max'=>'文章标题长度不得大于25位',
    	'cateid.require'=>'文章所属类型必须填写',
    ];
    protected $scene = [
    	'add' => ['title','cateid'],
    	'edit' => ['title','cateid'],
    ];
}
