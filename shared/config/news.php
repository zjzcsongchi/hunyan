<?php
/**
 * 资讯分类配置
 * @author chaokai@gz-zc.cn
 */
$config = array(
    'in_bainian' => array(
        'id' => 1,
        'name' => '走进百年',
        'children' => array(
            'gold_service' => array(
                'id' => 3,
                'name' => '金牌服务',
                'media_id'=>14
            ),
            'king_env' => array(
                'id' => 10,
                'name' => '皇家环境',
                'media_id'=>15
            ),
            'bainian_taste' => array(
                'id' => 4,
                'name' => '百年味道' ,
                'media_id'=>16
            ),
            'company_impression' => array(
                'id' => 5,
                'name' => '企业印象' ,
                'media_id'=>17
            ) 
        ) 
    ),
    'milan' => array(
        'id' => 2,
        'name' => '米兰国际',
        'children' => array(
            'very_marry' => array(
                'id' => 6,
                'name' => '非常婚事' 
            ),
            'front_info' => array(
                'id' => 7,
                'name' => '前沿资讯' 
            ),
            'marry_method' => array(
                'id' => 8,
                'name' => '备婚攻略' 
            ),
            'following_shot' => array(
                'id' => 18,
                'name' => '最美跟拍',        
            ),
            'cars' => array(
                'id' => 21,
                'name' => '婚车租赁',        
            ),
            'case' => array(
                'id' => 19,
                'name' => '案例欣赏'
            )
        ) 
    ) 
);