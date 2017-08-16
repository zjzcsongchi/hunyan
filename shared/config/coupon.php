<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
    'status' => array(
        'no_use' =>array(
            'id' => 0,
            'name' => '未使用'
        ),
        'use' =>array(
            'id' => 1,
            'name' => '已使用'
        ),
        'timeout' =>array(
            'id' => 2,
            'name' => '已过期'
        ),
    ),
                
    'external_coupon' => array(
                    'id' => 3,
                    'name' => '外部添加优惠券'
    ),
    'type' => array(
        'bainian' =>array(
            'id' => 0,
            'name' => '百年代金券'
        ),
        'milan' =>array(
            'id' => 1,
            'name' => '米兰代金券'
        ),
    ),
);