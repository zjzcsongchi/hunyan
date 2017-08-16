<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 手工位相关接口
 * 
 * @author huangjialin 
 *
 */
class Manual extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_manual' => 'Mmanual',
            'Model_manual_class' => 'Mmanual_class',
        ]);
    }
    
    /**
     * interface:获取手工内容列表
     * @method:get|post
     * @param number $manual_type 手工位ID
     * @param number $page     偏移量
     * @param number $size     分页大小
     * @ruturn json
     */
    public function get_lists(){
        try 
        {
            $manual_type  = (int)$this->input->get_post('manual_type');
            if($manual_type)
            {
                $where['manual_class_id'] = $manual_type;
            }
            
            $page = $this->input->get_post('page')?: 1;
            $size = $this->input->get_post('pagesize')?: 9;
            $where['is_del'] = 1;
            $order['sort'] = 'desc';
            $result = $this->Mmanual->get_lists('*', $where, $order, $size, ($page-1)*$size);
            $count = $this->Mmanual->count($where);
            $this->return_success($result,$count);
        } 
        catch (Exception $e) 
        {
            $this->return_failed($e->getMessage());
        }
    }
    
    
    /**
     * interface:获取某个手工内容
     * @method:get|post
     * @param number $manual_id 手工内容id
     * 
     * @ruturn json
     */
    public function get_info(){
        try 
        {
            $manual_id  = (int)$this->input->get_post('manual_id');
            if($manual_id)
            {
                $where['id'] = $manual_id;
            }
            $where['is_del'] = 1;
            $result = $this->Mmanual->get_one('*', $where);
            $this->return_success($result);
        } 
        catch (Exception $e) 
        {
            $this->return_failed($e->getMessage());
        }
    }
    
    /**
     * interface:获取某个手名称
     * @method:get|post
     * @param number $id 手工位id
     * 
     * @ruturn json
     */
    public function get_manual_class_info(){
        try 
        {
            $id  = (int)$this->input->get_post('id');
            if($id)
            {
                $where['id'] = $id;
            }
            $where['is_del'] = 1;
            $result = $this->Mmanual_class->get_one('*', $where);
            $this->return_success($result);
        } 
        catch (Exception $e) 
        {
            $this->return_failed($e->getMessage());
        }
    }
    
    

}
