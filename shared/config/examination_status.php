<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 米兰国际审核状态  <=> examination_status 的映射关系
 */
$config = array(
    'checking' =>array(
        'id' => 0,
        'name' => '待审核',
        'color_name' => '<o style="color:#fb2046">待审核</o>'
    ),
                
    'confirm' =>array(
        'id' => 1,
        'name' => '审核通过',
        'color_name' => '<o style="color:green">审核通过</o>'
    ),
                
    'refuse' =>array(
        'id' => 2,
        'name' => '审核失败',
        'color_name' => '<o style="color:#fb2046">审核失败</o>'
    ),
                
);
