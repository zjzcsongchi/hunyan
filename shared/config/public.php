<?php

if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 公共配置
 */
$config = array(
    "news" => array(
        "custom" => array(
            'id' => 1,
            'name' => '婚嫁习俗' 
        ),
        "diamond" => array(
            'id' => 2,
            'name' => '钻饰常识' 
        ),
        "marriage" => array(
            'id' => 6,
            'name' => '非常婚事'
        ),
        "bak" => array(
            'id' => 8,
            'name' => '备婚攻略'
        ),
        "manual_new" => array(
            'id' => 12,
            'name' => '资讯手工位'
        )
    ),
    
    "baidu" => array(
        "key" => "AF325f772e718fd4e2a00192e7eeb4e6" 
    ),
                
    // 管理员类型  <=> t_admins.group_id
    'type' => array(
        'general' => array(
            'id' => 0,
            'name' => '一般管理员' 
        ),
        'venue' => array(
            'id' => 1,
            'name' => '场馆管理员' 
        ),
        'milan_staff' =>array(
            'id' => 2,
            'name' => '米兰国际职员'
        ),
    ),
                
    // 管理员角色类型  <=> t_admins_group.role_type
    'role_type' => array(
        'general' => array(
            'id' => 0,
            'name' => '一般管理员'
        ),
        'milan' => array(
            'id' => 1,
            'name' => '米兰国际职员'
        ),

    ),
    
    // 场馆类型
    'venue_type' => array(
        'hall' => array(
            'id' => 1,
            'name' => '大厅'
        ),
        'rooms' => array(
            'id' => 2,
            'name' => '包房'
        ),
        'vip' => array(
            'id' => 3,
            'name' => '贵宾房'
        )
    ),
    'manual_class'=>array(
        'drink'=>array(
            'id'=>7,
            'name'=>'video'
        )
    ),
    'vtour' => array(
        'default_id' => 76
    )
)
;