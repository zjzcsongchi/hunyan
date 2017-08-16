<?php
/**
 * VR需要加载的插件配置
 * @author chaokai@gz-zc.cn
 */
$config = array(
    'include' => array(
        array(
            'url' => 'skin/pc_vtourskin.xml' 
        ),
        array(
            'url' => 'plugins/textadd.xml' 
        ),
        array(
            'url' => 'plugins/video-player.xml'
        ),
        array(
            'url' => 'plugins/dynamic_spot.xml'
        )
    ),
    'plugin' => array(
        array(
            'url' => 'plugins/videoplayer.swf',
            'alturl' => 'plugins/videoplayer.js',
            'preload' => true,
            'keep' => true 
        ),
        array(
            'name' => 'soundinterface',
            'url' => 'plugins/soundinterface.swf',
            'alturl' => 'plugins/soundinterface.js',
            'preload' => true,
            'keep' => true 
        ) 
    ) 
);