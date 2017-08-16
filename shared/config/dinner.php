<?php
/**
 * 宴会就餐时间配置
 */
$config = array(
                'time' => array(
                    'evening' => array(
                        'id' => 1,
                        'name' => '晚餐',
                    ),
                    'lunch' => array(
                        'id' => 2,
                        'name' => '午餐',
                    ),
                ),
    
                'examine' => array(
                    'not' => array(
                       'id' => 0,
                       'name' => '未审核',
                       'color_name' => '<o style="color:black">未审核</o>'
                    ),
                    'failure' => array(
                        'id' => 1,
                        'name' => '审核失败',
                        'color_name' => '<o style="color:red">审核失败</o>'
                    ),
                    'to_archive' => array(
                        'id' => 2,
                        'name' => '待归档',
                        'color_name' => '<o style="color:orange">待归档</o>'
                    ),
                    'archived' => array(
                        'id' => 3,
                        'name' => '已归档',
                        'color_name' => '<o style="color:green">已归档</o>'
                    ),
                    'backend_add' => array(
                                    'id' => 4,
                                    'name' => '后台添加',
                                    'color_name' => '<o style="color:green">后台添加</o>'
                    ),
                    'to_recheck' => array(
                                    'id' => 5,
                                    'name' => '待复审',
                                    'color_name' => '<o style="color:red">待复审</o>'
                    )
                ),

                'is_del' => array(
                    'normal' => array(
                        'id' => 0,
                        'name' => '正常',
                    ),
                    'delete' => array(
                        'id' => 1,
                        'name' => '删除',
                    ),
                    'unusual' => array(
                        'id' => 2,
                        'name' => '定金延期',
                    ),
                    'return' => array(
                        'id' => 3,
                        'name' => '已退定金',
                    ),
                    'other' => array(
                        'id' => 4,
                        'name' => '其他异常',
                    ),
                ),
                'consume_is_pay' => array(
                    'no_pay' => array(
                        'id' => 0,
                        'name' => '未付款'
                    ),
                    'pay' => array(
                        'id' => 1,
                        'name' => '已付款'
                    )
                )

);
