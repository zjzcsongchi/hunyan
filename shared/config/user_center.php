<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 用户中心配置
 */
$config = array(
                
    'url' => array(             
            'login' => '/passport/login',
            'reg' => '/passport/register',
            'user_center' => '/usercenter',
            'logout' => '/register/logout',
            'redirect_wechat_login' => '/passport/redirect_wechat_login',
    ),

    //教育程度
    'education' => array(
    	array(
    		'id' => '1',
    		'name' => '初中'
    	),
    	array(
    		'id' => '2',
    		'name' => '高中'
    	),
    	array(
    		'id' => '3',
    		'name' => '中专'
    	),
    	array(
    		'id' => '4',
    		'name' => '大专'
    	),
    	array(
    		'id' => '5',
    		'name' => '本科',
    	),
    	array(
    		'id' => '6',
    		'name' => '硕士',
    	),
    	array(
    		'id' => '7',
    		'name' => '博士',
    	),
    	array(
    		'id' => '8',
    		'name' => '其他',
    	),
    ),

    //职业
    'occupation' => array(
    	array(
    		'id' => '1',
    		'name' => '政府机关/干部'
    	),
    	array(
    		'id' => '2',
    		'name' => '计算机'
    	),
    	array(
    		'id' => '3',
    		'name' => '网络'
    	),
    	array(
    		'id' => '4',
    		'name' => '商业/贸易'
    	),
    	array(
    		'id' => '5',
    		'name' => '银行/金融/证券/保险',
    	),
    	array(
    		'id' => '6',
    		'name' => '税务',
    	),
    	array(
    		'id' => '7',
    		'name' => '咨询',
    	),
    	array(
    		'id' => '8',
    		'name' => '服务',
    	),
    	array(
    		'id' => '9',
    		'name' => '旅游/饭店',
    	),
    	array(
    		'id' => '10',
    		'name' => '房地产',
    	),
    	array(
    		'id' => '11',
    		'name' => '法律/司法',
    	),
    	array(
    		'id' => '12',
    		'name' => '文化/教育',
    	),
    	array(
    		'id' => '13',
    		'name' => '媒介/广告',
    	),
    	array(
    		'id' => '14',
    		'name' => '农/渔/林/畜牧业',
    	),
    	array(
    		'id' => '15',
    		'name' => '矿业/制造业',
    	),
    	array(
    		'id' => '16',
    		'name' => '学生',
    	),
    	array(
    		'id' => '17',
    		'name' => '自由职业',
    	),
    	array(
    		'id' => '18',
    		'name' => '其他',
    	),
    ),
        
);