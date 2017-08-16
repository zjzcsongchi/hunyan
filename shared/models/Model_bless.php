<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 祝福model
 * 
 * @author songchi
 *
 */
class Model_bless extends MY_Model {

    private $_table = 't_bless';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
    /**
     * 获取祝福列表
     * @author chaokai@gz-zc.cn
     */
    public function lists($where = array(), $pagesize = 10, $offset = 0, $order_by = array()){
        
        $default_where = array('is_del' => 0);
        $where = array_merge($where, $default_where);
        $default_order_by = array('create_time' => 'desc');
        $order_by = array_merge($order_by, $default_order_by);
        
        $list = $this->get_lists('*', $where, $order_by, $pagesize, $offset);
        
        if(!$list){
            return false;
        }
        
        //客户信息
        $user_ids = array_column($list, 'user_id');
        $user_list = $this->Muser->get_lists('id,nickname, realname, head_img', array('in' => array('id' => $user_ids)));
        foreach ($list as $k => $v){
            foreach ($user_list as $key => $value){
                if($v['user_id'] == $value['id']){
                    $list[$k]['head_img'] = $value['head_img'] ? get_img_url($value['head_img']) : C('domain.static.url').'/wap/images/touxiang.png';
                    $list[$k]['name'] = $value['realname'] ? $value['realname'] : $value['nickname'];
                    break;
                }
            }
            $list[$k]['time'] = $this->deal_time($v['create_time']);
        }
        
        return $list;
    }
    
    /**
     * 处理时间
     * @author cahokai@gz-zc.cn
     */
    private function deal_time($time){
        
        $time_num = time() - strtotime($time);
        
        if($time_num > 0 && $time_num < 30){
            $time_text = '刚刚';
        }elseif($time_num >= 30 && $time_num < 60){
            $time_text = '一分钟前';
        }elseif($time_num/60 >= 1 && $time_num/60 < 30){
            $time_text = intval($time_num/60).'分钟前';
        }elseif($time_num/60 >= 30 && $time_num/60 < 60){
            $time_text = '一小时前';
        }elseif($time_num/60/60 >= 1 && $time_num/60/60 < 12){
            $time_text = '半天前';
        }elseif($time_num/60/60 >= 12 && $time_num/60/60 < 24){
            $time_text = '一天前';
        }elseif($time_num/60/60/24 >= 1 && $time_num/60/60/24 < 30){
            $time_text = intval($time_num/60/60/24).'天前';
        }elseif($time_num/60/60/24/30 >= 1){
            $time_text = intval($time_num/60/60/24/30).'月前';
        }else{
            $time_text = '未知';
        }
        
        return $time_text;
    }
}