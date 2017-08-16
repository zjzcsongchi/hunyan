<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 短信发送接口配置文件
 * 
 */
$config = array(
	
    'sms_config' => array(
            'sn'    => 'SDK-WSS-010-08943',         //序列号
            'pwd'   => '7460Bdef',                  //密码
            'request_url'   => 'sdk.entinfo.cn',    //请求地址
            'request_port'  => 8061,
            
            'return_url'    => 'http://utf8.sms.webchinese.cn/?Uid=ziyouzhuwu&Key=82a42e39abd7406e09bb&smsMob=',   // 发送后获取结果地址
            'time_out'      => 10,          //超时时间
            
            'waring'        => '，1分钟内有效，请您尽快输入！（温馨提醒：为了您的账户安全，请勿告知他人）',
            'company_symbol'=> '【百年婚宴】',    //公司标识符
            
            'nvalidation_time' => 3600,      //验证码失效时间 一个小时后
    ),
                
    'sms_config_huaxing' => array(
            'sn'    => '101100-WEB-HUAX-670180',    //注册码
            'pwd'   => 'FRYAKODA',                  //密码
            'request_url'   => 'http://www.stongnet.com/sdkhttp/sendsms.aspx',          //即时请求地址
            'request_timing_url'  => 'http://www.stongnet.com/sdkhttp/sendschsms.aspx', //定时短信请求地址
            'waring'        => '，1分钟内有效，请您尽快输入！（温馨提醒：为了您的账户安全，请勿告知他人）',
            'company_symbol'=> '【百年婚宴】',    //公司标识符
            'nvalidation_time' => 3600,    //验证码失效时间 一个小时后
            'repeat_send_time' => 30,      //验证码发送间隔不小于60秒
    ),
                
    //短信 - 档期通知
    'sms_config_schedule' => array(
            'sn'    => '101100-WEB-HUAX-670180',    //注册码
            'pwd'   => 'FRYAKODA',                  //密码
            'request_url'   => 'http://www.stongnet.com/sdkhttp/sendsms.aspx',          //即时请求地址
            'request_timing_url'  => 'http://www.stongnet.com/sdkhttp/sendschsms.aspx', //定时短信请求地址
            'waring'        => '，1分钟内有效，请您尽快输入！（温馨提醒：为了您的账户安全，请勿告知他人）',
            'company_symbol'=> '【百年婚宴】',    //公司标识符
            'nvalidation_time' => 3600,    //验证码失效时间 一个小时后
            'repeat_send_time' => 30,      //验证码发送间隔不小于60秒
    ),
    
    //阿里大鱼短信
    'sms_config_alidayu' => array(
                    'appKey'          => '23540428',                              //App Key
                    'secret'          => '4dc30d5595ed3a098578de698d0ee503',      //App Secret
                    'SmsType'         => 'normal',                                //短信类型，传入值请填写normal
                    'SmsFreeSignName' => '百年婚宴',                                //短信签名
                    'SmsTemplateCode' => 'SMS_27770034',                          //短信模板ID
                    'nvalidation_time' => 3600,                                   //验证码失效时间 一个小时后
                    'repeat_send_time' => 30,                                     //验证码发送间隔不小于60秒
                    
                    'SmsTemplate' => array(
                            'verification_code' => array(
                                            'id' => 'SMS_27770034',
                                            'content' => '您的验证码为：${number}，为了安全，请勿告知他人！'
                            ),
                            'contract_sign_remind' => array(
                                            'id' => 'SMS_58920018',
                                            'content' => '尊敬的百年客户您好，您于${contract_date}在百年婚宴签订宴会合同， 查看合同详情请点击 http://img.bai-nian.com/files/${pdf_url}'
                            ),
                            'receipt_examined_remind' => array(
                                            'id' => 'SMS_59035034',
                                            'content' => '您在 ${venue} 的执行任务已审核，请登录后查看详情 http://admin.bai-nian.com/milanschedule'
                            ),
                            'schedule_cancel' => array(
                                            'id' => 'SMS_58955040',
                                            'content' => '您于${solar_time}在${venue} 的档期预约已取消，请登录后查看详情 http://admin.bai-nian.com/milanschedule'
                            ),
                            'schedule_assign' => array(
                                            'id' => 'SMS_58995044',
                                            'content' => '您于 ${solar_time} ,在 ${venue} 有一场米兰档期预约，请登录后查看详情 http://admin.bai-nian.com/milanschedule'
                            ),
                            'schedule_remind_week' => array(
                                            'id' => 'SMS_59075020',
                                            'content' => '您好，你于 ${solar_time} 有一场档期未确认，请及时确认订单，否则米兰婚礼将取消您的档期重新派发订单，点击链接确认 http://admin.bai-nian.com/milanschedule'
                            ),
                            'receipt_remind_tomorrow' => array(
                                            'id' => 'SMS_58900080',
                                            'content' => '您好，明天（${solar_time}）你有一个待执行的的订单，请提前准备准时到场执行，如有疑问，请及时联系米兰婚礼！点击链接查看 http://admin.bai-nian.com/milanschedule'
                            ),
                            'venue_reserve' => array(
                                            'id' => 'SMS_58975038',
                                            'content' => '亲爱的小主，您来了真好！ 世界上最幸福的事莫过于你喜欢我，我也喜欢你！您预约的场馆已经成功，稍后客户经理会与您联系。'
                            ),
                            'schedule_time_change' => array(
                                            'id' => 'SMS_58945102',
                                            'content' => '您于${old_solar_time}, 在${venue} 的米兰档期预约, 时间更改为${new_solar_time}, 请登录后查看详情 http://admin.bai-nian.com/milanschedule'
                            ),
                            'schedule_venue_change' => array(
                                            'id' => 'SMS_59105058',
                                            'content' => '您于${solar_time}, 在${venue} 的米兰档期预约宴会场馆发生变更, 请登录后查看详情 http://admin.bai-nian.com/milanschedule'
                            ),
                                    'receipt_assign' => array(
                                                    'id' => 'SMS_59040102',
                                                    'content' => '您在${venue} 有新的执行任务，请登录后查看详情 http://admin.bai-nian.com/milanschedule'
                                    ),
                                 
                    )
    ),
                
    

);
