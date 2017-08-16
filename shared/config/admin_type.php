<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 管理员类型 <=> t_admin.type 的映射关系
*/
$config = array(

    'common_admin' =>array(
        'id' => 1,
        'name' => '普通管理员'
    ),

    'venue_admin' =>array( 
        'id' => 2,
        'name' => '场馆管理员'
    ),

    'milan_staff' =>array(
        'id' => 3,
        'name' => '米兰国际职员'
    ),

);
