<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 通用model
 * @author: yuanxiaolin@global28.com
 * @version: 1.0.0
 * @since: datetime
 */
class MY_Model extends CI_Model {

    private $_table = NULL;

    public function __construct($table = NULL) {
        $this->_table = $table;
        parent::__construct();
    }

    /**
     * @author: yuanxiaolin@global28.com
     * @description 创建记录
     */
    public function create($data) {
    	
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    /**
     * @author yuanxiaolin@global28.com
     * @description 批量插入
     */
    public function create_batch($data) {
        $this->db->insert_batch($this->_table, $data);
        return $this->db->affected_rows();
    }
    
    /**
     * 插入或更新记录
     * @author yuanxiaolin@global28.com
     * @param  array $data
     * @ruturn return_type
     */
    public function replace_into($data){
    	//var_dump($data);exit;
    	$this->db->replace($this->_table, $data);
    	return $this->db->affected_rows();
    }

    /**
     * @author: yuanxiaolin@global28.com
     * @description 更新信息
     */
    public function update_info($data, $where) {
    	
    	if (isset($where['in'])) {
    		foreach ($where['in'] as $key => $value){
    			$this->db->where_in($key,$value);
    		}
    		unset($where['in']);
    	}
    	if(isset($where['like'])) {
    		foreach($where['like'] as $k => $v) {
    			$this->db->like($k, $v);
    		}
    		unset($where['like']);
    	}
    	
    	if(isset($where['or'])) {
    	    $where_or = $where['or'];
    	    unset($where['or']);
    	}
    	
    	if (!empty($where)){
    		$this->db->where($where);
    	}
    	
    	if(isset($where_or) && ! empty($where_or)) {
    	    foreach($where_or as $k => $v) {
    	        $this->db->or_where($k, $v);
    	    }
    	}
    	
    	//字段加上某个值
    	if (isset($data['incr'])){
    	    foreach ($data['incr'] as $key => $value){
    	         $this->db->set("{$key}", "{$key}" . "+" . "{$value}", FALSE);
    	    }
    	    unset($data['incr']);
    	}
    	
    	//字段减去某个值
    	if (isset($data['decr'])){
    	    foreach ($data['decr'] as $key => $value){
    	         $this->db->set("{$key}", "{$key}" . "-" . "{$value}", FALSE);
    	    }
    	    unset($data['decr']);
    	}
        //update方法无论执行成功与否都返回true，注释
    	// return  $this->db->update($this->_table, $data);
    	return  $this->db->update($this->_table, $data);

    }
    
    /**
     * 删除信息
     * @author yuanxiaolin@global28.com
     * @param unknown $where
     * @return number
     */
    public function delete($where){
    	
    	if(!empty($where)){
    		if (isset($where['in'])) {
    			foreach ($where['in'] as $key => $value){
    				$this->db->where_in($key,$value);
    			}
    			unset($where['in']);
    		}
    		if(!empty($where)){
    			$this->db->where($where);
    		}
    		$this->db->delete($this->_table);
    		return $this->db->affected_rows();
    	}
 		return 0;
    }
    
    /**
     * @author: yuanxiaolin@global28.com
     * @description 获取所有信息
     * @param: mixed $fields array('uid', '..')
     * @param: array $where array('name' => 'aaa', 'uid >' => $id);
     */
    public function count_group($fields = array(), $where = array(), $group_by) {
        $this->db->from($this->_table);
        if(!empty($where)) {
            foreach($where as $k => $v) {
                if($k == "in") {
                    foreach($v as $key => $value) {
                        $this->db->where_in($key, $value);
                    }
                } else {
                    $this->db->where($k, $v);
                }
            }
        }
        $this->db->group_by($group_by);
        if(empty($fields)) {
            $this->db->select("COUNT(*) num");
        } else {
            $this->db->select( implode(",", $fields) );
        }
        return $this->db->get()->result_array();
    }

    /**
     * @author: yuanxiaolin@global28.com
     * @description 获取所有信息
     * @param: mixed $fields array('uid', '..')
     * @param: array $where array('name' => 'aaa', 'uid >' => $id);
     */
    public function count($where = array()) {
        $this->db->from($this->_table);
        if(!empty($where)) {
            if(isset($where['like'])) {
                foreach($where['like'] as $k => $v) {
                    $this->db->like($k, $v);
                }
                unset($where['like']);
            }
            if(isset($where['in'])) {
                foreach($where['in'] as $k => $v) {
                    $this->db->where_in($k, $v);
                }
                unset($where['in']);
            }
            if(isset($where['not_in'])) {
                foreach($where['not_in'] as $k => $v) {
                    $this->db->where_not_in($k, $v);
                }
                unset($where['not_in']);
            }
            if($where){
                $this->db->where($where);
            }
        }
        return $this->db->count_all_results();
    }


    /**
     * @author: yuanxiaolin@global28.com
     * @description 获取列表
     * @param: array fields 查询的字段
     * @param: array where 查询条件
     * @param: array join 多表查询
     * @param: string  order_by  排序
     * @param: string limit 限制查多少条
     * @param: string  group_by  分组
     * @return: array
     */
    public function get_lists($fields = array(), $where = array(), $order_by = array(), $pagesize = 0,$offset = 0,  $group_by = array()) {
        if(!empty($fields)) {
            if(is_array($fields)) {
                $fields = implode(',', $fields);
            }
        } else {
            $fields = '*';
        }
        $this->db->from($this->_table);
        if($fields) {
            $this->db->select($fields);
        }
        if(isset($where['like'])) {
            foreach($where['like'] as $k => $v) {
                $this->db->like($k, $v);
            }
            unset($where['like']);
        }
        
        if(isset($where['or_like'])) {
            foreach($where['or_like'] as $k => $v) {
                $this->db->or_like($k, $v);
            }
            unset($where['or_like']);
        }
        
        if(isset($where['in'])) {
            foreach($where['in'] as $k => $v) {
                $this->db->where_in($k, $v);
            }
            unset($where['in']);
        }
        if(isset($where['not_in'])) {
            foreach($where['not_in'] as $k => $v) {
                $this->db->where_not_in($k, $v);
            }
            unset($where['not_in']);
        }
      
        if(isset($where['or'])) {
            $this->db->group_start();
            foreach($where['or'] as $k => $v) {
                $this->db->or_where($k, $v);
            }
            unset($where['or']);
            $this->db->group_end();
        }
        
        if($where){
            $this->db->where($where);
        }
        
        if($order_by) {
            foreach($order_by as $k => $v) {
                $this->db->order_by($k, $v);
            }
        }
        if($group_by) {
            $this->db->group_by($group_by);
        }
        if($pagesize > 0) {
            $this->db->limit($pagesize, $offset);
        }
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * 查询符合某个字段要求的结果
     * @author: caiyilong@ymt360.com
     * @version: 1.0.0
     * @since: 2015-01-06
     */
    public function get_by($name, $value) {
        if(!empty($value) && is_array($value)) {
            $this->db->where_in($name, $value);
        } else {
            $this->db->where($name, $value);
        }
        return $this->db->get($this->_table)->result_array();
    }

    /**
     * @author: yuanxiaolin@global28.com
     * @description 查询单条记录
     */
    public function get_one($fields, $query, $order_by='') {
        if(is_array($fields)) {
            $fields = implode(',', $fields);
        }
        if(isset($query['in'])) {
            foreach($query['in'] as $k => $v) {
                $this->db->where_in($k, $v);
            }
            unset($query['in']);
        }
        if(isset($query['not_in'])) {
            foreach($query['not_in'] as $k => $v) {
                $this->db->where_not_in($k, $v);
            }
            unset($query['not_in']);
        }
        
        if(isset($query['or'])) {
            $where_or =  $query['or'];
            unset($query['or']);
        }
        if($query){
            $this->db->where($query);
        }
        
        if(isset($where_or) && ! empty($where_or)) {
            foreach($where_or as $k => $v) {
                $this->db->or_where($k, $v);
            }
        }
       
        $this->db->from($this->_table)->select($fields);

        if($order_by) {
            $this->db->order_by($order_by);
        }
        $result = $this->db->get();
        if($result) {
            $data = $result->result_array();
        }
        if(!isset($data[0])) {
            return $data;
        }
        return $data[0];
    }


    /**
     * @author: yuanxiaolin@global28.com
     * @description
     * @param: array arr 需要转成json的数组
     */
    public function _return_json($arr) {
        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Headers: X-Requested-With');
        echo  json_encode($arr);exit;
    }

}
/* End of file MY_Model.php */

