<?php
/**
 * 宴会表
 */
class Model_dinner extends MY_Model{
    private $_table = 't_dinner';

    public function __construct(){

        parent::__construct($this->_table);
        
        $this->load->model(array(
            'Model_user' => 'Muser',
            'Model_dinner_detail' => 'Mdinner_detail',
            'Model_venue' => 'Mvenue',
            'Model_customer' => 'Mcustomer',
            'Model_dinner_venue' => 'Mdinner_venue',
            'Model_dinner_venue' => 'Mdinner_venue',
            'Model_dinner_extend' => 'Mdinner_extend',
        ));
    
    }

    /**
     * 获取某月场馆的预约情况
     * @param $month int 月份
     * @param $venue_id array 场馆id
     * @author chaokai@gz-zc.cn
     */
    public function get_appoint($venue_id = array(), $month = 0, $year = 0){

        $year = $year ?  : date('Y');
        $month = $month ?  : date('m');
        
        $this->load->helper('date');
        $days = days_in_month($month, $year);
        
        // 获取预约数据
        $dinner_where = array(
            'is_del' => 0,
            'solar_time >=' => $year . '-' . $month . '-01',
            'solar_time <=' => $year . '-' . $month . '-' . $days,
            /*
            'not_in' => array(
                'is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.failure.id')]
            )
             */
                        
        );
        if($venue_id)
        {
            $venue_where['in'] = array(
                'venue_id' => $venue_id 
            );
        }
        $field = 'id,is_del,venue_type,user_id,solar_time,lunar_time,roles_main,roles_wife,menus_count,contract_type';
        $list = $this->Mdinner->get_lists($field, $dinner_where);
        if($list){
            $dinner_ids = array_column($list, 'id');
            $venue_where['in']['dinner_id'] = $dinner_ids;
            //获取场馆的订单
            $dinner_venues = $this->Mdinner_venue->get_lists('dinner_id,venue_id', $venue_where);
            $lists = array();
            foreach ($list as $k => $v){
                foreach ($dinner_venues as $key => $value){
                    if($value['dinner_id'] == $v['id']){
                        $v['venue_id'] = $value['venue_id'];
                        $lists[] = $v;
                    }
                }
            }
            $list = $lists;
        }
        // 组合类型
        $venue_type = C('party');
        foreach($list as $k => $v)
        {
            foreach($venue_type as $key => $value)
            {
                if($v['venue_type'] == $value['id'])
                {
                    $list[$k]['venue_type_text'] = $value['name'];
                }
            }
        }
        
        $new_list = array();
        foreach($list as $k => $v)
        {
            for($i = 1; $i <= $days; $i ++)
            {
                $i < 10 && $i = '0' . $i;
                if($v['solar_time'] == $year . '-' . $month . '-' . $i)
                {
                    $new_list[$v['venue_id']][$i] = $v;
                }
            }
        }
        
        return $new_list;
    
    }

    /**
     * 获取预约详情
     * @author chaokai@gz-zc.cn
     */
    public function info($id, $where = array()){

        $field = '*';
	$where = array_merge($where, array('id' => $id));
        $info = $this->get_one($field, $where);
        
        if(! $info)
        {
            return false;
        }
        
        //获取场馆信息
        $dinner_venue = $this->Mdinner_venue->get_lists('dinner_id,venue_id', array('dinner_id' => $info['id']));
        $venue_ids = array_column($dinner_venue, 'venue_id');
        $info['venue_ids'] = $venue_ids;
        //处理封面图片
        if($info['cover_img']){
            $info['cover_img'] = explode(';', $info['cover_img']);
            foreach ($info['cover_img'] as $k => $v){
                $info['cover_img_url'][] = get_img_url($v);
            }
        }
        
        //处理手机端封面图片
        if($info['m_cover_img']){
            $info['m_cover_img'] = explode(';', $info['m_cover_img']);
            foreach ($info['m_cover_img'] as $k => $v){
                $info['m_cover_img_url'][] = get_img_url($v);
            }
        }
        //处理相册图片
        if($info['album']){
            $info['album'] = explode(';', $info['album']);
            foreach ($info['album'] as $k => $v){
                $info['album_url'][] = $v;
            }
        }
        // 获取预约菜品详情
        $detail_field = 'id,dinner_id,menus_id,name';
        $detail_where = array(
            'is_del' => 0,
            'dinner_id' => $id 
        );
        $dinner_detail = $this->Mdinner_detail->get_one($detail_field, $detail_where);
        
        $info['detail'] = $dinner_detail;
        
        // 获取用户信息
        $info['user'] = $this->Mcustomer->info($info['user_id']);
        return $info;
    
    }

    /**
     * 今日宴会
     * @author chaokai@gz-zc.cn
     */
    public function today($where = array(), $time = ''){
        
        $time = $time ? $time : date('Y-m-d');
        $default_where = array(
            'is_del' => 0,
            'is_show' => 0,
            'solar_time' => $time 
        );
        $where = array_merge($default_where, $where);
        
        $field = 'id,solar_time,lunar_time,banquet_time,venue_type,roles_main,roles_main_mobile,roles_wife,roles_wife_mobile,cover_img,m_cover_img, user_id';
        
        $list = $this->get_lists($field, $where, array('order' => 'desc'));
        
        if(empty($list))
        {
            return false;
        }
        
        foreach($list as $k => $v)
        {
            if($v['cover_img']){
                $v['cover_img'] = explode(';', $v['cover_img']);
                foreach ($v['cover_img'] as $key => $value){
                    unset($list[$k]['cover_img']);
                    $list[$k]['cover_img'][] = $value;
                }
            }else{
                $list[$k]['cover_img'] = '';
            }
            //手机端封面图
            if($v['m_cover_img']){
                $v['m_cover_img'] = explode(';', $v['m_cover_img']);
                foreach ($v['m_cover_img'] as $key => $value){
                    unset($list[$k]['m_cover_img']);
                    $list[$k]['m_cover_img'][] = $value;
                }
            }else{
                $list[$k]['m_cover_img'] = '';
            }
        }
        
        // 宴会场馆
        $venue_ids = array_column($list, 'venue_id');
        if(empty($venue_ids)) $venue_ids = '';
        $venue_where = array(
            'in' => array(
                'id' => $venue_ids 
            ) 
        );
        
        $venue = $this->Mvenue->lists($venue_where);
        foreach($list as $k => $v)
        {
            foreach($venue as $key => $value)
            {
                if($v['venue_id'] == $value['id'])
                {
                    $list[$k]['venue_name'] = $value['name'];
                }
            }
        }
        
        return $list;
    
    }

    /**
     * 获取订单列表
     * @author chaokai@gz-zc.cn
     */
    public function get_dinner_list($year, $month, $day=''){

        $this->load->helper('date');
        $days = days_in_month($month, $year);
        // 获取预约数据
        $where = array(
            'is_del' => 0,
            'solar_time >=' => $year . '-' . $month . '-01',
            'solar_time <=' => $year . '-' . $month . '-' . $days,
            'not_in' => array(
                'is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.failure.id')]
            )
        );
        if (!empty($day)) {
            $where['solar_time'] = $year . '-' . $month . '-' . $day;
        }
        $field = '*';
        $list = $this->Mdinner->get_lists($field, $where,['solar_time' => 'asc']);



        if(! $list)
        {
            return false;
        }

        $list = $this->deal_dinner($list);

        return $list;
    
    }
    
    /**
     * 获取审核订单
     * @author fengyi@gz-zc.cn
     */
    public function get_dinner_list_examined($where, $order_by, $pagesize = 0, $offset = 0) {
        $list = $this->Mdinner->get_lists('*', $where, $order_by, $pagesize, $offset);
    
        if (!$list) {
            return false;
        }
    
        $list = $this->deal_dinner($list);
    
        return $list;
    
    }
    
    /**
     * 获取接下来day天的订单列表
     * @author louhang@gz-zc.cn
     */
    public function get_netx_days_dinner_list($day = 30){
    
        $today = date('Y-m-d');
        
        $interval = date('Y-m-d',strtotime("+{$day} day"));
        
        // 获取预约数据
        $where = array(
                        'is_del' => 0,
                        'solar_time >=' => $today,
                        'solar_time <=' => $interval,
                        'not_in' => array(
                                        'is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.failure.id')]
                        )
        );
        $field = '*';
        $list = $this->Mdinner->get_lists($field, $where,['solar_time' => 'asc']);

        if(! $list)
        {
            return false;
        }
    
        $list = $this->deal_dinner($list);

        //处理司仪信息
        if ($list) {
            $ids = array_column($list, 'id');
            $mc_lists = $this->Mdinner_extend->get_mc_info_by_dinner_ids($ids);
            foreach ($mc_lists as $k => $v) {
                foreach ($list as $k2 => $v2) {
                    if ($v2['id'] == $v['dinner_id']) {
                        $list[$k2]['mc_need'] = ($v['is_need'] ? '需要' : '不需要');
                        $list[$k2]['mc_remark'] = $v['remark'];
                    }
                }
            }
        }
         
        return $list;
    
    }

    /**
     * 搜索订单信息
     * @author chaokai@gz-zc.cn
     */
    public function search_dinner_list($name = '', $mobile = '', $where_param = array()){
        $dinner_where['is_del'] = 0;

        $dinner_where['like'] = array();
        $where['like'] = array();
        
        if($name != '')
        {
            $where['like'] = array_merge($where['like'], array(
                'name' => $name
            ));
            
            $dinner_where['or_like'] = array_merge($dinner_where['like'], array(
                            'roles_main' => $name,
                            'roles_wife' => $name,
                            'sign_contract' => $name
            ));
        }
        if($mobile != '')
        {
            $where['like'] = array_merge($where['like'], array(
                'mobile_phone' => $mobile
            ));
            $dinner_where['or_like'] = array_merge($dinner_where['like'], array(
                            'roles_main_mobile' => $mobile,
                            'roles_wife_mobile' => $mobile,
                            'sign_contract_mobile' => $mobile
            ));
        }
        
        if($name == '' && $mobile == '')
        {
            return false;
        }

        $customer = $this->Mcustomer->get_lists('id', $where);

        $this->db->from($this->_table);
        $this->db->group_start();
        if($customer){
            $customer_ids = array_column($customer, 'id');
            $this->db->or_where_in('user_id', $customer_ids);
        }
        foreach ($dinner_where['or_like'] as $k => $v){
            $this->db->or_like($k, $v);
        }
        $this->db->group_end();
        if ( !isset($where_param['in']['is_del']) ) {
            $this->db->where(array('is_del' => 0));
        }
        if(!empty($where_param)){
            if(isset($where_param['in'])){
                foreach($where_param['in'] as $k => $v) {
                    $this->db->where_in($k, $v);
                }
                unset($where_param['in']);
            }
            $this->db->where($where_param);
        }
        $field = '*';
        $this->db->select($field);
        
        $result = $this->db->get();
        $list = $result->result_array();
        if(! $list)
        {
            return false;
        }
        $list = $this->deal_dinner($list);
        
        return $list;
    
    }

    
    /**
     * 搜索订单信息
     * @author songchi@gz-zc.cn
     */
    public function search_dinner($name = '', $mobile = ''){
        $dinner_where['is_del'] = 0;
    
        $dinner_where['like'] = array();
        $where['like'] = array();
    
        if($name != '')
        {
            $where['like'] = array_merge($where['like'], array(
                'name' => $name
            ));
    
            $dinner_where['or_like'] = array_merge($dinner_where['like'], array(
                'roles_main' => $name,
                'roles_wife' => $name
            ));
        }
        if($mobile != '')
        {
            $where['like'] = array_merge($where['like'], array(
                'mobile_phone' => $mobile
            ));
            $dinner_where['or_like'] = array_merge($dinner_where['like'], array(
                'roles_main_mobile' => $mobile,
                'roles_wife_mobile' => $mobile
            ));
        }
    
        if($name == '' && $mobile == '')
        {
            return false;
        }
    
        $customer = $this->Mcustomer->get_lists('id', $where);
        $this->db->from($this->_table);
        $this->db->group_start();
        if($customer){
            $customer_ids = array_column($customer, 'id');
            $this->db->or_where_in('user_id', $customer_ids);
        }
        foreach ($dinner_where['or_like'] as $k => $v){
            $this->db->or_like($k, $v);
        }
        $this->db->group_end();
        $this->db->where(array('is_del' => 0));
        $field = 'id';
        $this->db->select($field);
    
        $result = $this->db->get();
        $list = $result->result_array();
        if(!$list)
        {
            return false;
        }
        
        $dinner_id = array_column($list, 'id');
    
        return $dinner_id;
    
    }
    
    /**
     * 获取近三年每个月的订单数量
     * @author chaokai@gz-zc.cn
     */
    public function get_count(){

        $field = 'solar_time';
        $start_year = 2016;
        $year = date('Y');
        $end_year = $year+2;
        $where = array(
            'is_del' => 0,
            'solar_time >=' => ($start_year) . '-01-01',
            'solar_time <=' => ($end_year) . '-12-31' ,
            'not_in' => array(
                'is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.failure.id')]
            )
        );
        $list = $this->get_lists($field, $where);
        
        $result = array();
        foreach($list as $k => $v)
        {
            $date = date('Ym', strtotime($v['solar_time']));
            
            if(isset($result[$date]))
            {
                $result[$date] ++;
            }
            else
            {
                $result[$date] = 1;
            }
        }
        
        return $result;
    
    }
    
    /**
     * 根据dinner_id数组获取宴会订单信息
     * @param $dinner_ids array id数组
     * @author chaokai@gz-zc.cn
     */
    public function get_dinner_by_ids($dinner_ids, $order_by = []){

        if (!$dinner_ids) {
            return array();
        }

        $dinner_where = array(
                        'in' => array('id' => $dinner_ids)
        );
        if(empty($order_by)){
            $order_by = ['solar_time' => 'desc'];
        }
        //$dinner_field = 'id,create_time,following_effect,chess_card,venue_type,solar_time,user_id,lunar_time,roles_main,roles_main_mobile,roles_wife,roles_wife_mobile,menus_count,create_admin,remark,contract_num,deposit,receiver,contract_type,promise_count';
        $dinner_field = '*';
        $list = $this->Mdinner->get_lists($dinner_field, $dinner_where, $order_by);
        
        return $list ? $this->deal_dinner($list) : array();
    }

    /**
     * 处理订单列表信息
     * @author chaokai@gz-zc.cn
     */
    public function deal_dinner($list){
        // 获取客户信息
        $customer_ids = array_column($list, 'user_id');
        $customer_where = array(
            'in' => array(
                'id' => $customer_ids 
            ) 
        );
        $customer_list = $this->Mcustomer->get_lists('id,name,mobile_phone', $customer_where);
        foreach($list as $k => $v)
        {
            foreach($customer_list as $key => $value)
            {
                if($v['user_id'] == $value['id'])
                {
                    $list[$k]['customer_name'] = $value['name'];
                    $list[$k]['customer_mobile'] = $value['mobile_phone'];
                }
            }
        }
        
        //处理场馆名称
        $ids = array_column($list, 'id');
        $dinner_venues = $this->Mdinner_venue->get_lists('dinner_id,venue_id', array('in' => array('dinner_id' => $ids)));

        $venue_ids = array_column($dinner_venues, 'venue_id');
        $venues = $this->Mvenue->get_lists('id,name', array('in' => array('id' => $venue_ids)));
        $venues[] = array('id'=>0,'name'=>'其他');
        foreach ($dinner_venues as $k => $v){
            foreach ($venues as $key => $value){
                if($v['venue_id'] == $value['id']){
                    $dinner_venues[$k]['venue_name'] = $value['name'];
                }
            }
        }
        foreach ($list as $k => $v){
            foreach ($dinner_venues as $key => $value){
                if($value['dinner_id'] == $v['id']){
                    if(isset($list[$k]['venue_name'])){
                        $list[$k]['venue_name'] .= $value['venue_name'].'<br>';
                    }else{
                        $list[$k]['venue_name'] = $value['venue_name'].'<br>';
                    }
                }
            }
        }
        
        //订餐数据
	    $dinner_ids = array_column($list, 'id');
	    $detail_field = 'id,dinner_id,menus_id,name';
        $detail_where = array(
            'is_del' => 0,
	    'in' => array(
            'dinner_id' => $dinner_ids
	    )
        );
        $dinner_detail = $this->Mdinner_detail->get_lists($detail_field, $detail_where);
    	foreach($list as $k => $v){
    		foreach($dinner_detail as $key => $value){
    			if($v['id'] == $value['dinner_id']){
    				$list[$k]['menus_name'] = $value['name'];
    			}
    		}
    	}

        // 计算星期
        $weeks = array(
            '星期日',
            '星期一',
            '星期二',
            '星期三',
            '星期四',
            '星期五',
            '星期六' 
        );
        foreach($list as $k => $v)
        {
            $list[$k]['week'] = $weeks[date('w', strtotime($v['solar_time']))];
        }
        
        //订单状态
        foreach ($list as $k => $v){
            $list[$k]['contract_type_text'] = $v['contract_type'] ? '预留场地' : '订单合同';
        }
        
        return $list;
    
    }

    /**
     * 获取已推送的订单
     * @author fengyi@gz-zc.cn
     */
    public function get_pushed_dinners($push_time) {
        $sql = 'select id from t_dinner where (is_send_menu=1 or is_send_egg=1 or is_send_noodle=1) and is_del=0 and push_time like ? order by push_time asc';
        $query =  $this->db->query($sql, array($push_time.'%'));
        $data = $query->result_array();
        $ids = array_column($data, 'id');
        $list = $this->get_dinner_by_ids($ids);
        return $list;
    }
    
    /**
     * 获取已推送的订单
     * @author fengyi@gz-zc.cn
     */
    public function get_pushed_solar($solar_time) {
        $sql = 'select id from t_dinner where (is_send_menu=1 or is_send_egg=1 or is_send_noodle=1) and is_del=0 and solar_time like ? order by push_time asc';
        $query =  $this->db->query($sql, array($solar_time.'%'));
        $data = $query->result_array();
        $ids = array_column($data, 'id');
        $list = $this->get_dinner_by_ids($ids);
        return $list;
    }
}
