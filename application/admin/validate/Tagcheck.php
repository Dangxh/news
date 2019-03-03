<?php
namespace app\admin\validate;
use think\Validate;

class Tagcheck extends Validate
{
    protected $rule = [
    	'tagname'=>'require|max:25|unique:tags',
    ];
    protected $message = [
    	'tagname.require'=>'tag标签必须填写',
    	'tagname.max'=>'tag标签长度不得大于25位',
        'tagname.unique'=>'tag标签不得重复',
    ];
    protected $scene = [
    	'add' => ['tagname'],
    	'edit' => ['tagname'],
    ];
}
