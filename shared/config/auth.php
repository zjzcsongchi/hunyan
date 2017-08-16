<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 审核状态
 */
$config = array(
    'checking' => array(
        'id' => 0,
        'name' => '审核中' 
    ),
    'success' => array(
        'id' => 1,
        'name' => '审核通过' 
    ),
    'failed' => array(
        'id' => 2,
        'name' => '审核失败' 
    ),
    'send_success' => array(
        'id' => 3,
        'name' => '补贴发放成功' 
    ),
    'new' => array(
        'id' => 4,
        'name' => '待审核'
    )
);