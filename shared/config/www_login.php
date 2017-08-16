<?php

if(! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 需要强制登录的页面配置
 */
$config = array(
    //个人中心
    'usercenter' => array(
        'index',
        'set_portrait',
        'pro_user_base_info',
        'pro_set_portrait',
        'pro_educational_history',
        'get_educational',
        'pro_work_history',
        'get_work_history',
        //'projects',
        //'details',
        'basic',
        'company',
        'product',
        'files',
        'medias',
        'publish',
    ),
    
)
;
