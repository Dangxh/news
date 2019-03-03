<?php
namespace app\admin\validate;
use think\Validate;

class Admincheck extends Validate
{
    protected $rule = [
    	'username'=>'require|max:25',
    	'password'=>'require',
    ];
    protected $message = [
    	'username.require'=>'用户名必须填写',
    	'username.max'=>'用户名长度不得大于25位',
    	'password.require'=>'密码必须填写',
    ];
    protected $scene = [
    	'add' => ['username','password'],
    	'edit' => ['username'],
    ];
}
