<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *CI框架分页类配置文件
 */
$config = array(
        'config_maker' => array(
                'first_link' => '<<',
                'last_link' => '>>',
                'prev_link' => '<',
                'next_link' => '>',
                'use_page_numbers' => TRUE,
                'cur_tag_open' => '<a class="page_num act">',
                'cur_tag_close' => '</a>',
                'page_query_string' => TRUE,
                //'display_pages'=>FALSE,
                'attributes' => array('class' => 'page_num','rel'=>FALSE),
                'per_page' => 12// 每页条目数
        ),
        'config_project' => array(
                'first_link' => '<<',
                'last_link' => '>>',
                'prev_link' => '<',
                'next_link' => '>',
                'use_page_numbers' => TRUE,
                'cur_tag_open' => '<a class="page_num act">',
                'cur_tag_close' => '</a>',
                'page_query_string' => FALSE,
                'prefix' => '',
                'use_global_url_suffix' => TRUE,
                'attributes' => array('class' => 'page_num','rel'=>FALSE),
                'per_page' =>5// 每页条目数
 
        ),
        //nengfu@gz-zc.cn
        'config_log' => array(
            'first_link' => '<<',
            'last_link' => '>>',
            'prev_link' => '<',
            'next_link' => '>',
            'use_page_numbers' => TRUE,
            'prev_tag_open' => '<li class="paginItem">',
            'prev_tag_close' => '</li>',
            'next_tag_open' => '<li class="paginItem">',
            'next_tag_close' => '</li>',
            'first_tag_open' => '<li class="paginItem">',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li class="paginItem">',
            'last_tag_close' => '</li>',
            'num_tag_open' => '<li class="paginItem">',
            'num_tag_close' => '</li>',
            'cur_tag_open' => ' <li class="paginItem current"><a >', //当前也标签
            'cur_tag_close' => '</a></li>',
            'page_query_string' => TRUE,
            'attributes' => array('class' => 'paginItem','rel'=>FALSE),
            'per_page' =>15// 每页条目数

        ),
         //songchi@gz-zc.cn
        'config_food' => array(
            'first_link' => '<<',
            'last_link' => '>>',
            'prev_link' => '<',
            'next_link' => '>',
            'use_page_numbers' => TRUE,
            'prev_tag_open' => '<li class="paginItem">',
            'prev_tag_close' => '</li>',
            'next_tag_open' => '<li class="paginItem">',
            'next_tag_close' => '</li>',
            'first_tag_open' => '<li class="paginItem">',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li class="paginItem">',
            'last_tag_close' => '</li>',
            'num_tag_open' => '<li class="paginItem">',
            'num_tag_close' => '</li>',
            'cur_tag_open' => ' <li class="paginItem current"><a >', //当前也标签
            'cur_tag_close' => '</a></li>',
            'page_query_string' => TRUE,
            'attributes' => array('class' => 'paginItem','rel'=>FALSE),
            'per_page' =>18// 每页条目数
        
        ),
        'config_media' => array(
            'first_link' => '<<',
            'last_link' => '>>',
            'prev_link' => '<',
            'next_link' => '>',
            'use_page_numbers' => TRUE,
            'cur_tag_open' => '<a href="javascript:;" class="page_num act">',
            'cur_tag_close' => '</a>',
            'page_query_string' => TRUE,
            //'display_pages'=>FALSE,
            'attributes' => array('class' => 'page_num','rel'=>FALSE),
            'per_page' => 8// 每页条目数

        ),
        'config_center' => array(
            'first_link' => '<<',
            'last_link' => '>>',
            'prev_link' => '<',
            'next_link' => '>',
            'use_page_numbers' => TRUE,
            'cur_tag_open' => '<a class="page_num act">',
            'cur_tag_close' => '</a>',
            'page_query_string' => TRUE,
            //'display_pages'=>FALSE,
            'attributes' => array('class' => 'page_num','rel'=>FALSE),
            'per_page' =>6// 每页条目数
        ),
                //bootstrap样式的分页
                'config_bootstrap' => array(
                                'first_link' => '第一页',
                                'last_link' => '最后一页',
                                'prev_link' => '&laquo;',
                                'next_link' => '&raquo;',
                                'use_page_numbers' => TRUE,
                                'prev_tag_open' => '<li>',
                                'prev_tag_close' => '</li>',
                                'next_tag_open' => '<li>',
                                'next_tag_close' => '</li>',
                                'first_tag_open' => '<li>',
                                'first_tag_close' => '</li>',
                                'last_tag_open' => '<li>',
                                'last_tag_close' => '</li>',
                                'num_tag_open' => '<li>',
                                'num_tag_close' => '</li>',
                                'cur_tag_open' => ' <li class="active"><a>', //当前也标签
                                'cur_tag_close' => '</a></li>',
                                'page_query_string' => TRUE,
                                'attributes' => array('class' => 'paginItem','rel'=>FALSE),
                                'per_page' =>10// 每页条目数
                )
        
);
