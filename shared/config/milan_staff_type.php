<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 米兰国际工作人员 职位 <=> t_admin.group_id的映射关系
*/
$config = array(

//     'supervisor' =>array(
//         'id' => 19,
//         'name' => '婚礼督导'
//     ),

    'emcee' =>array( 
        'id' => 20,
        'name' => '主持人',
        'template' => ' ◆主持执行过程中如有以下问题出现，每项100元过失处罚，从当天执行费中扣除：
1. 主持人在主持过程中报错新人的名字或读音不准。
2. 主持人开场及退场未介绍：我是米兰婚礼主持人XXX  
3. 与新人预先沟通确定好的流程，在主持过程中忘记或随意更改；
4. 与新人预约见面、沟通、彩排、迟到，迟到10分钟以上（含10分钟）；
5. 因主持人出现严重失误，被新人投诉或新人拒绝付费，主持人负责承担所有经济损失。',

    ),

    'photographer' =>array(
        'id' => 21,
        'name' => '摄像师'
    ),

    'light_technician' =>array(
        'id' => 22,
        'name' => '灯光师'
    ),

    'cosmetician' =>array(
        'id' => 23,
        'name' => '化妆师'
    ),
    
    'following_photographer' =>array(
        'id' => 24,
        'name' => '跟拍师'
    ),
                
    'florist' =>array(
        'id' => 26,
        'name' => '花艺师'
    ),
                
    'layout' =>array(
        'id' => 30,
        'name' => '场布师'
    )

);
