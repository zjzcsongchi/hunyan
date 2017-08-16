<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
    常用正则表达式
 */
$config = array(
	 
    'email' => '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i',
    'mobile' => '/^1[3|4|5|8|7][0-9]\d{8}$/',
    
);
