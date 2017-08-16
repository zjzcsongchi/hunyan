<?php
/**
 * 档期提醒
 * @author songchi@gz-zc.cn
 */
class Schedule extends MY_Controller {
    
    public function __construct(){
        
        parent::__construct();
        
        $this->load->model(array(
            'Model_user' => 'Muser',
            'Model_staff_schedule' => 'Mstaff_schedule',
            'Model_admins' => 'Madmins',
            'Model_venue'=>'Mvenue',
            'Model_menu'=>'Mmenu',
        ));
        
        $this->load->library('table');
        
    }
    
    public function index(){
        $week = date("Y-m-d", strtotime("+7 day"));
        $next_day = date("Y-m-d", strtotime("+1 day"));
        
        //七天后未确定档期人员发短信
        $this->send_message($week, 0);
        
        $this->send_message($next_day, 1);
        
    }
   
    public function send_message($time, $status = 0){
        $where['schedule_time'] = $week = $time;
        if(!$status){
            $where['status'] = 0;
        }else{
            $where['status>='] = 0;
        }
        $where['is_del'] = 0;
        
        $list = $this->Mstaff_schedule->get_lists('*', $where);
        if($list){
            $menu_id = array_column($list, 'menu_id');
            //获取场馆id
            $venue_id = $this->Mmenu->get_lists('id, venue_id', array('in'=>array('id'=>$menu_id)));
            $venue_id = array_column($venue_id, 'venue_id', 'id');
            $venue = $this->Mvenue->get_lists('name, id', array('in'=>array('id'=>$venue_id)));
            $venue = array_column($venue, 'name', 'id');
        
            $name = array();
            foreach ($venue_id as $k=>$v){
                $name[$k] = $venue[$v];
            }
        
            $admin_id = array_column($list, 'staff_id');
            $default_where = array('type!='=>0, 'is_del' => 1);
            $default_where['in'] = array('id'=>$admin_id);
            $new_tel = $this->Madmins->get_lists('id, fullname, tel', $default_where);
            $new_tel = array_column($new_tel, 'tel', 'id');
        
            //邮件内容数组
            $email_arr = array();
            if($new_tel){
                $solar_time = date('Y年m月d日', strtotime($week));
                $now_time = date('Y-m-d H:i:s');
                foreach ($list as $k=>$v){
                    $list[$k]['tel'] = $new_tel[$v['staff_id']];
                    $list[$k]['venue'] = $name[$v['menu_id']];
                    //邮件内容数组
                    $email_arr[$k] = array(
                                    'tel' => $new_tel[$v['staff_id']],
                                    'venue' => $name[$v['menu_id']],
                                    'execute_time' => $solar_time,
                    );
                }
                if($status == 0){
                    foreach ($list as $k=>$v){
                        //$res = send_msg_huaxing($v['tel'], "您好，你于".date('Y年m月d日', strtotime($week))."有一场档期未确认，请及时确认订单，否则米兰婚礼将取消您的档期重新派发订单，点击链接确认 http://rrd.me/bgcSS");
                        $res = send_msg($v['tel'], 'schedule_remind_week', ['solar_time' => $solar_time]);
                        $email_arr[$k]['type'] = '未确认执行单提醒';
                        $email_arr[$k]['time'] = $now_time;
                        if($res === TRUE){
                            $email_arr[$k]['result'] = '成功';
                        }else{
                            $email_arr[$k]['result'] = '失败';
                        }
                    }
                }else{
                    foreach ($list as $k=>$v){
                        //$res = send_msg_huaxing($v['tel'], "您好，明天（".date('Y年m月d日', strtotime($week))."）你有一个待执行的的订单，请提前准备准时到场执行，如有疑问，请及时联系米兰婚礼！点击链接查看 http://rrd.me/bgcSS");
                        $res = send_msg($v['tel'], 'receipt_remind_tomorrow', ['solar_time' => $solar_time]);
                        $email_arr[$k]['type'] = '执行单通知';
                        $email_arr[$k]['time'] = $now_time;
                        if($res === TRUE){
                            $email_arr[$k]['result'] = '成功';
                        }else{
                            $email_arr[$k]['result'] = '失败';
                        }
                    }
                }
                
                $this->table->set_heading(array(
                                '手机号',
                                '场馆',
                                '执行单时间',
                                '发送短信时间',
                                '短信类型',
                                '发送短信结果'
                ));
                foreach ($email_arr as $v){
                    $this->table->add_row($v);
                }
                $email_content = $this->table->generate();
                send_email(C('email.adminemail'), '米兰婚礼执行单提醒短信发送结果通知', $email_content);
            }
           
                
        }
    }
    
}