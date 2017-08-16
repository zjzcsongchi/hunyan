<?php
if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 消息配置
 */
$config = array(
    //审核
    'audit' => array(
        //半价购房
        'buy' => array(
            //审核通过
            'yes' => array(
                'title' => '半价购房申请订单审核通过',
                'content' => '尊敬的用户您好，您的惠民安居半价购 房在线申请已成功提交，回执编号为：__receipt__，详情请到您的个人中心查看，如有任何疑问请拨打:400-851-8771。'
            ),

            //审核未通过
            'no' => array(
                'title' => '半价购房申请订单审核未通过',
                'content' => '尊敬的用户您好，你的惠民安居半价购 房申请订单未通过初审，未通过原因：__remark__，请您重新提交申请。'
            )
        ),
    ),

    //会员身份认证
    'identity' => array(
        //审核通过
        'yes' => array(
            'title' => '身份认证信息审核通过',
            'content' => '尊敬的用户您好，您的身份认证信息已审核通过。'
        ),
        
        //审核未通过
        'no' => array(
            'title' => '身份认证信息审核未通过',
            'content' => '尊敬的用户您好，您的身份认证信息未通过我们的审核，未通过审核原因：__remark__，请您重新提交认证申请。'
        )
    ),


    //注册
    'reg' => array(
        'title' => '欢迎注册惠民安居平台',
        'content' => '尊敬的用户您好，欢迎您注册惠民安居半价购房半价装修平台。'
    ),
    
)
;
