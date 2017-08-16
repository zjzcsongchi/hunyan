<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
    'menu' => array(
        '场馆管理' => array(
            'code' => 'venue_manage',
            'class' => 'explode',
            'list' => array(
                array(
                    '/venue/add',
                    '添加场馆' 
                ) 
            ) 
        ),
        '客户管理' => array(
            'code' => 'kehu',
            'class' => 'explode',
            'list' => array(
                array(
                    '/user',
                    '会员列表' 
                ),
                array(
                    '/customer',
                    '意向客户' 
                ),
                array(
                    '/dinner',
                    '订单客户' 
                ),
                array(
                    '/contract/service',
                    '婚宴服务' 
                ),
                array(
                    '/paystatus',
                    '收银流水' 
                ),
                array(
                    '/consume',
                    '消费清单'
                ),
                array(
                    '/contract/reserved_contract',
                    '预留订单'
                ),
                array(
                    '/contract/unusual_contract',
                    '异常订单',
                ),
                array(
                    '/dinner/is_pushed',
                    '已推送订单',
                ),
            ) 
        ),
        
        '合同管理' => array(
            'code' => 'contract_manage',
            'class' => '',
            'list' => array(
                array(
                    '/contract/not_audit_contract',
                    '未审核合同' 
                ),
                array(
                    '/contract/to_recheck_contract',
                    '待复审合同',
                ),
                array(
                    '/contract/audit_contract',
                    '已审核合同' 
                ),
                array(
                    '/contract/not_archive_contract',
                    '待归档合同' 
                ),
                array(
                    '/contract/archived_contract',
                    '已归档合同' 
                )
            ) 
        ),
        
        '米兰婚礼' => array(
            'code' => 'milan',
            'class' => 'explode',
            'list' => array(
                array(
                    '/menu',
                    '订单管理' 
                ),
                array(
                    '/menu/dinner_of_next_30days',
                    '百年订单' 
                ),
                array(
                    '/theme',
                    '主题管理' 
                ),
                array(
                    '/milan/customer',
                    '意向客户' 
                ),
                array(
                    '/milancombo',
                    '婚礼套餐' 
                ),
                array(
                    '/Milanstaff',
                    '人员档期' 
                ),
                array(
                    '/Receipt',
                    '执行单管理' 
                ),
                array(
                    '/followingshot',
                    '最美跟拍' 
                ),
                array(
                    '/followcustomer',
                    '跟拍客户' 
                ),
                array(
                    '/record',
                    '婚礼档案' 
                ) 
            ) 
        ),
        
        // '商城管理' => array(
        // 'code' => 'drink',
        // 'class' => 'explode',
        // 'list' => array(
        // array(
        // '/drinkclass',
        // '商品分类'
        // ),
        // array(
        // '/drink',
        // '商品列表'
        // ),
        // array(
        // '/order',
        // '预定订单'
        // ),
        // array(
        // '/orders',
        // '酒水订单'
        // )
        // )
        // ),
        '订单管理' => array(
            'code' => 'order',
            'class' => 'explode',
            'list' => array(
                // array(
                // '/paystatus',
                // '支付订单'
                // ),
                array(
                    '/orderimage',
                    '相册订单' 
                ),
                array(
                    '/drinkappoint',
                    '酒水预定' 
                ),
                array(
                    '/drinkorder',
                    '线下酒水订单' 
                ),
                array(
                    '/online',
                    '线上酒水订单' 
                ) 
            ) 
        ),
        // array(
        // '/order',
        // '酒水预定'
        // ),
        // array(
        // '/orders',
        // '酒水订单'
        // )
        
        '商品管理' => array(
            'code' => 'products',
            'class' => 'explode',
            'list' => array(
                array(
                    '/attribute/attributeclass',
                    '商品分类' 
                ),
                array(
                    '/attribute',
                    '商品列表' 
                ) 
            ) 
        ),
        
       '后厨管理' => array(
            'code' => 'kitchen',
            'class' => 'explode',
            'list' => array(
                array(
                    '/kitchen/today',
                    '本月订单' 
                ),
                array(
                     '/kitchen/changed',
                    '变更订单'
                 ),
                array(
                    '/kitchen/egg',
                    '鸡蛋订单'
                ),
                array(
                    '/kitchen/rice_noodles',
                    '米粉订单'
                )
            ) 
        ),
        
        '套餐管理' => array(
            'code' => 'taocan',
            'class' => 'explode',
            'list' => array(
                array(
                    '/dishclass',
                    '菜系列表' 
                ),
                array(
                    '/dish',
                    '菜品列表' 
                ),
                array(
                    '/combo',
                    '套餐列表' 
                ) 
            ) 
        ),
        
        '卡券管理' => array(
            'code' => 'coupon',
            'class' => 'explode',
            'list' => array(
//                 array(
//                     '/coupon/check',
//                     '代金券核销' 
//                 ),
                array(
                    '/coupon/user_coupon',
                    '代金券列表' 
                ),
//                 array(
//                     '/coupon/type',
//                     '代金券类型' 
//                 ),
                /*array(
                    '/coupon/manually_add',
                    '添加代金券'
                )*/
            ) 
        ),
        '资讯管理' => array(
            'code' => 'zixun',
            'class' => 'explode',
            'list' => array(
                array(
                    '/news',
                    '资讯列表' 
                ),
                array(
                    '/news/class_list',
                    '资讯类型' 
                ),
                array(
                    '/news/comment_manage',
                    '评论管理'
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
        '微信客服系统' => array(
            'code' => 'wechat_kefu',
            'class' => 'explode',
            'list' => array(
                array(
                    'https://mpkf.weixin.qq.com/',
                    '多客服系统',
                    '_blank' 
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
        '祝福评论管理' => array(
            'code' => 'bless_manage',
            'class' => 'explode',
            'list' => array(
                array(
                    '/bless',
                    '祝福语列表' 
                ),
                array(
                    '/flowers',
                    '鲜花排行' 
                ),
                array(
                    '/bless/dirty_word',
                    '脏话过滤' 
                ) 
            ) 
        ),
        'VR全景管理' => array(
            'code' => 'vr_manage',
            'class' => 'explode',
            'list' => array(
                array(
                    '/vtourscene',
                    '场景制作' 
                ),
                array(
                    '/vtourvideo',
                    '视频全景制作' 
                ),
                array(
                    '/vtour',
                    '场景合成' 
                ),
                array(
                    '/hotspotico/scene_change',
                    '热点图标管理' 
                ),
                array(
                    '/vtourcomment',
                    '评论管理'
                )
            ) 
        ),
        '电子相册' => array(
            'code' => 'template_manage',
            'class' => 'explode',
            'list' => array(
                array(
                    '/template',
                    '相册模板' 
                ),
                array(
                    '/music',
                    '音乐库' 
                ),
                array(
                    '/invitelement',
                    '微请帖用户' 
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
                ),
                array(
                    '/configes',
                    '系统配置' 
                ),
                array(
                    '/about',
                    '关于我们' 
                ),
                array(
                    '/wapmenus',
                    '手机端菜单' 
                ) 
            ) 
        ) 
    )
);
