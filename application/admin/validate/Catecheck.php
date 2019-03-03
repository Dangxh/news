<?php
namespace app\admin\validate;
use think\Validate;

class Catecheck extends Validate
{
    protected $rule = [
    	'catename'=>'require|max:25|unique',
    ];
    protected $message = [
    	'catename.require'=>'栏目标题必须填写',
    	'catename.max'=>'栏目标题长度不得大于25位',
        'catename.unique'=>'栏目标题不能重复',
    ];
    protected $scene = [
    	'add' =>'catename',
    	'edit' =>'catename',
    ];
}
