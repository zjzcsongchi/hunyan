<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 米兰国际档期状态  <=> status的映射关系
 */
$config = array(

    'unread' =>array(
        'status' => 0,
        'name' => '未确认',
        'color_name' => '<o style="color:#fb2046">未确认</o>'
    ),
                
    'confirm' =>array(
        'status' => 1,
        'name' => '已确认',
        'color_name' => '<o style="color:green">已确认</o>'
    ),
                
    'refuse' =>array(
        'status' => 2,
        'name' => '拒绝',
        'color_name' => '<o style="color:#fb2046">拒绝</o>'
    )


);