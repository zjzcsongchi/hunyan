<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config =  array(
	//登陆前不需要权限验证的页面
	'public_page_no_login'=>array(
		'login/code',   #后台验证码
		'login/login',            #登录
		'login/index',            #登录
		'login/out'               #注册
	),

	//登陆后不需要权限验证的页面
	'public_page'=>array(
		'home',
		'common/left',
		'common',
		'common/top',
		'common/bottom',
		'admin/set_admin',
	    'file/upload'
	)
);