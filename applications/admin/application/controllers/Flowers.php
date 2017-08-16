<?php 
    /**
    * 鲜花控制器
    * @author yonghua@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Flowers extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_user' => 'Muser',
               'Model_venue' => 'Mvenue',
               'Model_dinner' => 'Mdinner',
               'Model_flower' => 'Mflowers',
               'Model_dinner_venue' => 'Mdinner_venue'
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }

    /**
     * 首页
     * @author yonghua@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $size = $this->pageconfig['per_page']; 
        $order_by = array('num' => 'desc');
        
        $data['venus'] = $this->Mvenue->get_lists('id, name');
        $venus = array_column($data['venus'], 'name', 'id');
        
        //按场馆查询
        $where = array();
        $venue_id = $this->input->get_post('venue_id');
        if($venue_id){
            $where['venue_id'] = $venue_id;
        }else{
            $where['venue_id'] = isset($data['venus'][0]['id']) ? $data['venus'][0]['id'] : 1; //默认显示该场馆的祝福语
        }
        //按日期
        $time = $this->input->get_post('time');
        if(!$time){
            $time = date('Y-m-d');
        }
        //用于分页显示时保留查询参数
        $data['venue_id'] = $venue_id;
        $data['time'] = $time;
        
        //先拿到所有在 $venue_id 下举办婚礼的 dinner_id
        $dinners = $this->Mdinner_venue->get_lists('dinner_id', array('venue_id' => $venue_id));
        $dinners = array_column($dinners, 'dinner_id');
        
        if(!$dinners){
            $dinners = '';
        }
        $dinner = $this->Mdinner->get_one('id', array('in' => array('id' => $dinners), 'solar_time' => $time, 'is_del' => 0));
        if($dinner){
            $count = $this->db->query('select count(user_id) as num from (select user_id from t_flower where dinner_id = '.$dinner['id'].' GROUP BY user_id) as a;');
            if($count){
                foreach ($count->result() as $k => $v){
                    if($k == 0){ 
                        $data_count = $v->num;
                    }
                }
            }
            $data['flowers'] = $this->Mflowers->get_lists('id,dinner_id,user_id,sum(num) as num', array('dinner_id' => $dinner['id']), $order_by, $size, ($page-1)*$size, 'user_id');
            $user = array_column($data['flowers'], 'user_id');
            $user = $this->Muser->get_lists('id, nickname, mobile_phone, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
            $user = array_column($user, null, 'id');
            foreach($data['flowers'] as $key => $value){
                $data['flowers'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
                $data['flowers'][$key]['mobile_phone'] = isset($user[$value['user_id']]['mobile_phone']) ? $user[$value['user_id']]['mobile_phone'] : '未填写';
                $data['flowers'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : '';
            }
        }else{
            $data_count = 0;
            //该日期下该场馆没有被预定，相应也没有祝福数据
        }
        if(! empty($data['flowers'])){
            $this->pageconfig['base_url'] = "/flowers/index?venue_id=".$venue_id."&time=".$time;
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        $data['page'] = $page;
        $data['data_count'] = $data_count;
        
        $this->load->view("flowers/index", $data);
    }
}