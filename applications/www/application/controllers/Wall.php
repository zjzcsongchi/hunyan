<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Wall extends MY_Controller{
    //每页显示数量
    private $pagesize;
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_venue' => 'Mvenue',
                'Model_dinner' => 'Mdinner',
                'Model_dinner_venue' => 'Mdinner_venue',
        ]);
        $this->pagesize = 3;
         
    }

    //新人墙
    public function index() {
        //统计总数
        $this->count();
        $data = $this->data;        
        $venue = $this->Mvenue->get_lists('id, name', array('is_del'=>0));
        $data['venue'] = $venue;
        $time = date("Y-m-d",time());
        $data['lists'] = $this->search_dinner_list(0,0,0,1);
        if($data['lists']){
            foreach ($data['lists'] as $k=>$v){
                $data['lists'][$k]['m_cover_img'] = $v['m_cover_img'] ? $v['m_cover_img']:$v['cover_img'];
            }
        }
        $dinner_id = array_column($data['lists'], 'id');
        if($dinner_id){
            $venue_id = $this->Mdinner_venue->get_lists('venue_id, dinner_id', array('in'=>array('dinner_id'=>$dinner_id)));
            $venue_tmp = array();
            foreach ($venue_id as $k=>$v){
                $venue_tmp[$v['dinner_id']][] = $v['venue_id'];
            }
            
            $venue_name = $this->Mvenue->get_lists('id, name', array('is_del'=>0));
            $venue_name = array_column($venue_name, 'name', 'id');
            foreach ($venue_tmp as $k=>$v){
                foreach ($v as $key=>$val){
                    $venue_tmp[$k][$key] = $venue_name[$val];
                }
            }
            $data['venue_name'] = $venue_tmp;
        }
        $this->load->view('wall/index',$data);
    }
    
    public function search(){
        $data = $this->data;
        $post_data['name'] = $this->input->get_post('name');
        $post_data['time'] = $this->input->get_post('time');
        $post_data['venue'] = $this->input->get_post('venue');
        $page = $this->input->get_post('page');
        $page = $page ? $page: '1';
        
        $data['lists'] = $this->search_dinner_list($post_data['time'], $post_data['name'], $post_data['venue'], $page);
        if($data['lists']){
            foreach ($data['lists'] as $k=>$v){
                $data['lists'][$k]['m_cover_img'] = $v['m_cover_img'] ? $v['m_cover_img']:$v['cover_img'];
            }
            foreach ($data['lists'] as $k=>$v){
                if($v['m_cover_img']){
                    $img = explode(';', $v['m_cover_img']);
                    $data['lists'][$k]['m_cover_img'] = $img[0];
                }
            }
        }
        else{
            echo 'nodata';exit;
        }
        if($post_data['venue']){
            $data['venue_new'] = $this->Mvenue->get_one('id, name', array('id'=>$post_data['venue']));
        }
        $dinner_id = array_column($data['lists'], 'id');
        
        if($dinner_id){
            $venue_id = $this->Mdinner_venue->get_lists('venue_id, dinner_id', array('in'=>array('dinner_id'=>$dinner_id)));
            $venue_tmp = array();
            foreach ($venue_id as $k=>$v){
                $venue_tmp[$v['dinner_id']][] = $v['venue_id'];
            }
            
            $venue_name = $this->Mvenue->get_lists('id, name', array('is_del'=>0));
            $venue_name = array_column($venue_name, 'name', 'id');
            foreach ($venue_tmp as $k=>$v){
                foreach ($v as $key=>$val){
                    if(isset($venue_name[$val]) && $venue_name[$val]){
                        $venue_tmp[$k][$key] = $venue_name[$val];
                    }
                }
            }
            $data['venue'] = $venue_tmp;
        }
        
        $this->load->view('wall/load_more', $data);
        
    }
    
    
    public function search_dinner_list($time, $name, $venue, $page = '1', $pagesize='9'){
        $dinner_where['is_del'] = 0;
        $dinner_where['like'] = array();
        
        if($time){
            $dinner_where['solar_time'] = $time;
        }
    
        if($name)
        {
            $dinner_where['or_like'] = array_merge($dinner_where['like'], array(
                'roles_main' => $name,
                'roles_wife' => $name
            ));
        }
        
        if(!empty($venue)){
            $dinner_id = $this->Mdinner_venue->get_lists('dinner_id', array('venue_id'=>$venue));
            $dinner_id = array_column($dinner_id, 'dinner_id');
            
            if($dinner_id){
                $dinner_where['in'] = array('id'=>$dinner_id);
            }
        }
        
        $this->db->order_by('solar_time', 'DESC');
        
        $this->db->from("t_dinner");
        if(isset($dinner_where['or_like']) && $dinner_where['or_like']){
            $this->db->group_start();
            foreach ($dinner_where['or_like'] as $k => $v){
                $this->db->or_like($k, $v);
            }
            $this->db->group_end();
        }
        
        if($time){
            $this->db->where(array('solar_time' => $time));
        }
        
        $this->db->where(array('solar_time<=' => date("Y-m-d")));
        
        if($venue){
            $this->db->join('t_dinner_venue', 't_dinner_venue.dinner_id = t_dinner.id');
            $this->db->where(array('t_dinner_venue.venue_id' => $venue));
        }
        
        $this->db->where(array('is_del' => 0, 'venue_type'=>1,'is_show'=>0));
        if($pagesize > 0) {
            $this->db->limit($pagesize, $pagesize * ($page - 1));
        }
        
        $field = '*';
        $this->db->select($field);
        $result = $this->db->get();
        $lists = $result->result_array();
        
        if(! $lists)
        {
            return false;
        }else{
            return $lists;
        }
    
    
    }
}

