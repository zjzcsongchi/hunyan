<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 用户分类
 * 
 * @author huangjialin
 */
class Userclass extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
        	  'Model_user_class' => 'Muserclass'
        ));
    }
    
    /**
     * 根据媒体id获取详细信息
     */
    public function get_info(){
        try
        {
            $id = $this->input->post('id');
            $where = $this->input->post('where');
            $id = intval($id);
            if (! $id){
                $this->return_failed();
            }
            
            $default_where = array(
                   'id' => $id
            );
            
            if (! is_null($where)){
                $where = array_merge($default_where, $where);
            }else{
                $where = $default_where;
            }
            
            $info = $this->Muserclass->get_one('*', $where);
            if(!empty($info)){
                $this->return_success($info);
            }else{
                $this->return_failed();
            }
            
        }catch (Exception $e){
            $this->return_failed($e->getMessage());
        }
        
        
    }
    
    /**
     * 获取媒体列表
     */
    public function get_list(){
        try
        {
            $where = $this->input->post('where');
            $order = $this->input->post('order');
            
            $field = $this->input->post('field');
            if(empty($field)){
                $field = '*';
            }
            
            $default_where = ['is_del'=>0,'is_show'=>1];
            $default_order = ['id'=>'desc'];
            if (! is_null($where)){
                $where = array_merge($where, $default_where);
            }else{
                $where = $default_where;
            }
            
            if (! is_null($order)){
                $order = array_merge($order, $default_order);
            }else{
                $order = $default_order;
            }
            
            $lists = $this->Muserclass->get_lists($field, $where, $order);
            
            if(!empty($lists)){
                $this->return_success($lists);
            }else{
                $this->return_failed();
            }
        }catch (Exception $e){
            $this->return_failed($e->getMessage());
        }
       
    }
    
    
}