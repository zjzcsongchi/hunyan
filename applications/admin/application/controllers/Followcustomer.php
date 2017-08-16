<?php
/**
 * 跟拍客户
 * @author chaokai@gz-zc.cn
 */

class Followcustomer extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model(array(
                        'Model_dinner_album' => 'Mdinner_album',
                        'Model_dinner' => 'Mdinner'
        ));
        $this->load->library('pagination');
    }
    
    /**
     * 显示有相册的客户列表
     * @author chaokai@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $pageconfig = C('page.config_bootstrap');
        
        $data['pagesize'] = $pagesize = $pageconfig['per_page'] = 15;
        $data['page'] = $page = intval($this->input->get('per_page')) ? : 1;
        $offset = ($page - 1) * $pagesize;
        
        $where = array(
                        'is_del' => 0
        );
        $query_data = [];
        $dinner_ids = '';
        $solar_time = trim($this->input->get('solar_time'));
        $data['solar_time'] = '';
        if($solar_time){
            $dinner_ids = $this->Mdinner->get_lists('*', array('solar_time' => $solar_time, 'is_del' => 0));
            
            $dinner_ids = $dinner_ids ? array_column($dinner_ids, 'id') : '';
        
            $where['in'] = ['dinner_id' => $dinner_ids];
        
            $query_data['solar_time'] = $data['solar_time'] = $solar_time;
        }
        
        
        $fullname = trim($this->input->get('fullname'));
        $data['fullname'] = '';
        if($fullname){
            $where2 = [
                'is_del' => 0, 
                'or' => ['roles_main' => $fullname, 'roles_wife' => $fullname],
            ];
            if ($dinner_ids) {
                $where2['in'] = ['id' => $dinner_ids];
            }
            
            $dinner_ids = $this->Mdinner->get_lists('id', $where2);
            $dinner_ids = $dinner_ids ? array_column($dinner_ids, 'id') : '';
            
            $where['in'] = ['dinner_id' => $dinner_ids];

            $query_data['fullname'] = $data['fullname'] = $fullname;
        }
        
        $data['list'] = [];
        $data['count'] = $this->Mdinner_album->count($where);
        $dinner_list = $this->Mdinner_album->get_lists('*', $where, '', $pagesize, $offset);
        
        if($dinner_list){
            //获取订单信息
            $dinner = $this->Mdinner->get_dinner_by_ids(array_column($dinner_list, 'dinner_id'));
            
            foreach ($dinner_list as $k => $v){
                foreach ($dinner as $key => $value){
                    if($v['dinner_id'] == $value['id']){
                        $dinner_list[$k] = array_merge($v, $value);
                        break;
                    }
                }
            }
            $data['list'] = $dinner_list;
        
            $pageconfig['base_url'] = '/followcustomer/index?'.http_build_query($query_data);
            $pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        $this->load->view('followcustomer/index', $data);
    }
}