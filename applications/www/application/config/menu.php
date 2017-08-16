<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
    'menu' => array(
        '场馆管理' => array(
            'code' => 'venue_manage',
            'class' => 'explode',
            'list' => array(
                array(
                    '/venue',
                    '场馆管理' 
                ),
                array(
                    '/venue/add',
                    '添加场馆' 
                ) 
            )),
            '客户管理' => array(
                'code' => 'kehu',
                'class' => 'explode',
                'list' => array(
                    array(
                        '/user',
                        '客户列表' 
                    ) 
                ) 
            ),
            '手工位管理' => array(
                'code' => 'shougongwei',
                'class' => 'explode',
                'list' => array(
                    array(
                        '/manualclass',
                        '手工位名称' 
                    ),
                    array(
                        '/manual',
                        '手工位内容' 
                    ) 
                ) 
            ),
            '管理员管理' => array(
                'code' => 'admin_user_manage',
                'class' => 'explode',
                'list' => array(
                    array(
                        '/admin',
                        '管理员列表' 
                    ),
                    array(
                        '/admingroup',
                        '角色管理' 
                    ),
                    array(
                        '/adminspurview',
                        '权限管理' 
                    ) 
                ) 
            ),
            '系统管理' => array(
                'code' => 'system_manage',
                'class' => 'explode',
                'list' => array(
                    array(
                        '/version',
                        '静态资源版本号更新' 
                    ) 
                ) 
            ) 
        ) 
);
