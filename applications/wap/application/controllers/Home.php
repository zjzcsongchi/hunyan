<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends MY_Controller{
    //每页显示数量
    private $pagesize;
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_about_us' => 'Mabout_us',
                'Model_manual' => 'Mmanual',
                'Model_venue' => 'Mvenue',
                'Model_dinner' => 'Mdinner',
                'Model_theme' => 'Mtheme',
        ]);
        $this->pagesize = 3;
         
    }

    //手机端报名主页
    public function index() {
        $data = $this->data;
        $data['title'] = '今日宴会';
        $data['action'] = "today";
        $cover_img = $this->Mabout_us->get_one('vedio_img', array('id>'=>0));
        $data['cover_img'] = $cover_img['vedio_img'];
        
        //婚宴场馆
        $venue_where = array('is_recommend' => 1);
        $data['venue'] = $this->Mvenue->lists($venue_where);
        
        //今日婚宴
        $dinner_where = array('venue_type' => C('party.wedding.id'), 'contract_type' => 0);
        $data['dinner'] = $this->Mdinner->today($dinner_where);
        $other_where = array('venue_type!='=>C('party.wedding.id'), 'contract_type' => 0);
        $other = $this->Mdinner->today($other_where);
        if($other){
            foreach ($other as $k=>$v){
                $data['dinner'][] = $v;
            }
        }
        
        if($data['dinner']){
            foreach ($data['dinner'] as $k=>$v){
                if(isset($v['m_cover_img']) && $v['m_cover_img']){
                    $data['dinner'][$k]['img'] = $v['m_cover_img'];
                }else{
                    $data['dinner'][$k]['img'] = $v['cover_img'];
                }
            }
        }

        $data['today_venue'] = array_column($data['venue'], 'name', 'id');
        
        //获取宴会厅
        if(!$data['dinner']){
            $data['dinner'] = array();
        }
        $dinner_id = array_column($data['dinner'], 'id');
        if($dinner_id){
            $query['in'] = array('dinner_id'=>$dinner_id);
            $lists = $this->Mdinner_venue->get_lists('venue_id, dinner_id', $query);
            $venue_lists = array_column($lists, 'venue_id');
        
            $venue_name = $this->Mvenue->get_lists('id, name', array('is_del'=>0));
            $venue_name = array_column($venue_name, 'name', 'id');
        
            foreach($lists as $k=>$v){
                $lists[$k]['venue_name'] = isset($venue_name[$v['venue_id']]) ? $venue_name[$v['venue_id']] : '';
            }
           
            $venue = array();
            foreach($dinner_id as $k=>$v){
                foreach($lists as $key=>$val){
                    if($dinner_id[$k] == $val['dinner_id']){
                        $venue[$k]['name'][] = array('name' => $val['venue_name'], 'id' => $val['venue_id']);
                        $venue[$k]['dinner_id'] = $val['dinner_id'];
                    }
                }
            }
        
            $data['venue_name'] = array_column($venue, 'name', 'dinner_id');
        }
        
        $this->load->view('home/home',$data);
    }
    
}

