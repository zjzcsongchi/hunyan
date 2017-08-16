<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Package extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_about_us' => 'Mabout_us',
                'Model_manual' => 'Mmanual',
                'Model_dinner' => 'Mdinner',    
                'Model_venue' => 'Mvenue',
                'Model_combo' => 'Mcombo',
                'Model_dish' => 'Mdish',
        ]);
    }
    
    /**
     * 首页
     */
    public function index(){
        $data = $this->data;
        $data['action'] = 'package';
        $where['is_del'] = 0;

        //获取菜品数据
        $dish = $this->Mdish->get_lists('id, name, price', $where);
        $data['dish'] = array_column($dish, 'name', 'id');
        $price = array_column($dish, 'price', 'id');
        
        //获取套餐数据列表
        $data['lists'] = $this->Mcombo->get_lists('*', $where);
        if($data['lists'] ){
            foreach ($data['lists'] as $k=>$v){
                $data['lists'][$k]['dish'] = $dish = explode(',', $v['relevance_id']);
                $data['lists'][$k]['all_price'] = '';
                foreach ($dish as $key=>$val){
                    $data['lists'][$k]['all_price'] += $price[$val];
                } 
            }
            
        }

        $this->load->view('package/index', $data);
    }
    
    
}

