<?php 
    /**
    * 套餐控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Combo extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_manual_class' => 'Mmanualclass',
               'Model_manual' => 'Mmanual',
               'Model_admins' => 'Madmins',
               'Model_dish' => 'Mdish',  
               'Model_combo' => 'Mcombo'      
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;

        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $size = $this->pageconfig['per_page'];
        
        $name = $this->input->get_post('combo_name');
        if($name){
            $where['like'] = array('combo_name'=>$name);
            
        }

        $data['combo_name'] = $name;
        
        $order_by = array('sort'=>'desc');
        $where['is_del'] = 0;

        $data['list'] = $this->Mcombo->get_lists('*', $where, $order_by, $size, ($page-1)*$size);
        if($data['list']){
            foreach ($data['list'] as $k => $v){
                $relevance_id['id'] =explode(',', $v['relevance_id']);
                //重新组装
                $list_tmp = $this->Mdish->get_lists('id, name, cover_img', ['in'=>$relevance_id ]);
                $list_tmp= array_column($list_tmp, NULL, 'id');
                foreach ($relevance_id['id'] as $key=>$val){
                    if(isset($list_tmp[$val]) && $list_tmp[$val]){
                        $data['list'][$k]['foods'][0][] = $list_tmp[$val];
                    }
                }
        
            }
        
        }
        $data_count = $this->Mcombo->count($where);
        if($data['list']){
            $this->pageconfig['base_url'] = "/combo/index?combo_name=".$name;
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        
        $this->load->view("combo/index", $data);

        
    }
    
   
    
    public function add(){
        $data = $this->data;
        $data['foods'] = $this->Mdish->get_lists('*', array('is_del'=>0));
        
        if(IS_POST){
            $post_data = $this->input->post();
            if($post_data){
                $post_data['create_time'] = date("Y-m-d h:i:s", time());
                $post_data['update_time'] = date("Y-m-d h:i:s", time());
                $add = $this->Mcombo->create($post_data);
                if($add){
                    $this->success('添加成功', '/combo');
                }else{
                    $this->error('添加失败', '/combo');
                }
            }

        }
        
        $this->load->view('combo/add', $data);
    }
    
    
    public function edit($id='0'){
        $data = $this->data;
        $id = intval($id);
        $data['info'] = $this->Mcombo->get_one('*' ,array('id'=>$id));
        if($data['info']){
            $relevance_id = explode(',',  $data['info']['relevance_id']);
            $exsit_id = 0;
            if($relevance_id){
                $exsit_id = $this->Mdish->get_lists('id', array('in'=>array('id'=>$relevance_id), 'is_del'=>0)); 
                $exsit_id = array_column($exsit_id, 'id');
                $dish_tmp_id = array();
                foreach ($relevance_id as $k=>$v){
                    if(in_array($v, $exsit_id)){
                        $dish_tmp_id[] = $v;
                    }
                }
            }
            
            if($dish_tmp_id){
                $str = '';
                foreach ($dish_tmp_id as $k=>$v){
                    $str .= $v.',';
                }
                $data['info']['relevance_id'] = substr($str,0,strlen($str)-1);
            }
        }
        $data['foods'] = $this->Mdish->get_lists('*', array('is_del'=>0));
        
        if(IS_POST){
            $post_data = $this->input->post();
            if($post_data){
                $update = $this->Mcombo->update_info($post_data, array('id'=>$id));
                if($update){
                    $this->success('修改成功', '/combo');
                }else{
                    $this->error('修改失败', '/combo');
                }
            }
            
        }
        $this->load->view('combo/edit', $data);
    }
    
    
    public function del(){
        $id = intval($this->input->get_post('id'));
        $where['id'] = $id;
        $get_data['is_del'] = 1; 
        $del = $this->Mcombo->update_info($get_data, $where);
        if($del){
            $this->success('删除成功', '/combo');
        }else{
            $this->error('删除失败', '/combo');
        }
        
    }
    
}

