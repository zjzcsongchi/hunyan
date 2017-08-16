<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 用户基本信息表配置文件
 */
$config = array(
    'disable' => array(             //用户账号状态
        'code' => array(
                'no' => 0,
                'yes' => 1
        ),
        'text' => array(
                0=>'正常',
                1=>'禁用'
        )
    
    ),

    'auth_status' => array(         //用户认证状态
        'code' => array(
            'no' => 0,
            'to' => 1,
            'done' => 2,
            'not_pass' => 3
        ),
        'text' => array(
            0 => '未认证',
            1 => '待审核',
            2 => '已认证',
            3 => '审核未通过',
        )
    ),
        
);