<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 上传服务配置文件
 */
$config = array(
        
        /*头像上传*/
        'portraint' => array(
                'upload_path'   => '../../uploads/portrait/',
                'allowed_types' => 'jpg|png',
                'max_size'      => 1024*5,
                'max_width'     => 2000,
                'max_height'    => 2000,
                'encrypt_name'  => TRUE,
                'remove_spaces' => TRUE,
                'use_time_dir'  => TRUE,      //是否按上传时间分目录存放
                'time_method_by_day'=> FALSE, //分目录存放的方式：按天 或 按月  默认按月
        ),

        /*百度编辑器*/
        'ue_config' => array(
                'upload_path'   => '../../uploads/image/',
                'allowed_types' => 'jpg|png|jpeg',
                'max_size'      => 1024*5,
                'max_width'     => 2000,
                'max_height'    => 2000,
                'encrypt_name'  => TRUE,
                'remove_spaces' => TRUE,
                'use_time_dir'  => TRUE,      //是否按上传时间分目录存放
                'time_method_by_day'=> TRUE, //分目录存放的方式：按天 或 按月  默认按月
        ),
                    
        'upload_dir' => '/data/wwwroot/www.bai-nian.com/uploads/',
        
         //类型文件夹
        'folder' => array('image', 'files', 'portrait', 'video', 'music'),
                    
        //定义允许上传的文件扩展名
        'ext' => array(
                        'img'=>['.gif', '.jpg', '.jpeg', '.png', '.bmp'],
                        'other'=>['.swf','.flv','.doc','.docx','.xls','.xlsx','.ppt','.mp3'],
                        'video' => ['.mp4']
                )
     
);
