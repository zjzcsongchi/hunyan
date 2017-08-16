<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
    // 登陆前不需要权限验证的页面
    'public_page_no_login' => array(
        'login/code', // 后台验证码
        'login/login', // 登录
        'login/index', // 登录
        'login/out', // 注册
        'milanschedule/login',
        'milanschedule/schedule',
        'milanschedule/all_message',
        'milanschedule/unread_message',
        'milanschedule/confirm_schedule',
        'milanschedule/schedule_detail',
        'milanschedule/logout',
        'milanschedule/receipt_detail',
        'milanschedule/confirm_receipt',
        'milanschedule/add_receipt', // 自填执行单
        'milanschedule/save_receipt', // 自填执行单，保存
        'milanschedule/message_by_kinds_of_if',
        'milanschedule',
        'vtour/scan',
        'vtourvideo/scan',
        'vtourvideo/load_xml',
        'vtour/bn_scan',
        'vtour/zan',
        'vtour/talk',
        'vtour/load_xml',
        'publicservice/qr_code'
    ),
    
    // 登陆后不需要权限验证的页面
    'public_page' => array(
        'home',
        'common/left',
        'common',
        'common/top',
        'common/bottom',
        'admin/set_admin',
        'file/upload',
        'publicservice/qr_code'
    )
     
);