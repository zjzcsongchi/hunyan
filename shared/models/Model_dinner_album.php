<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_dinner_album extends MY_Model {

    private $_table = 't_dinner_album';

    public function __construct() {
        parent::__construct($this->_table);
    }    
    
    /**
     * 获取有相册的宴会列表
     * @author chaokai@gz-zc.cn
     */
    public function get_dinner_list($field, $where, $pagesize, $offset){
        
        $this->db->from($this->_table);
        $this->db->select($field);
        
        $this->db->join('t_dinner', 't_dinner.id = t_dinner_album.dinner_id', 'left outer');
        $this->db->where(array_merge($where, array('t_dinner.is_del' => 0)));
        $this->db->limit($pagesize, $offset);
        $this->db->distinct();
        
        $result = $this->db->get();
       
        return $result->result_array();
    }
    /**
     * 获取有相册的宴会列表
     * @author chaokai@gz-zc.cn
     */
    public function get_dinner_count($where){
        
        $this->db->from($this->_table);
        $this->db->select('dinner_id');
        
        $this->db->join('t_dinner', 't_dinner.id = t_dinner_album.dinner_id', 'left outer');
        $this->db->where(array_merge($where, array('t_dinner.is_del' => 0)));
        $this->db->distinct();
        $result = $this->db->get();
        
        return count($result->result_array());
        
       
    }
    
}