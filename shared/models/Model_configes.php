<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_configes extends MY_Model {

    private $_table = 't_configes';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
    /**
     * 获取所有 组装数组($k=>$v形式)
     * @author songchi@gz-zc.cn
     */
    public function get_all(){
        $list = $this->get_lists("*");
        if($list){
            foreach($list as $k=>$v){
                if($v){
                    $info[$v['key']] = $v['val'];
                }
            }
        }
        return $info;
    }
    
    
    /**
     * 保存数据
     * $arr post提交过来的参数
     * @author songchi@gz-zc.cn
     */
    public function set($arr){
        if($arr)
        {
            $all = $this->get_all();
            foreach($arr as $k=>$v)
            {
                if(isset($all[$k]))
                {
                    $where['key'] = $k;
                    $data['val'] = $arr[$k];
                    $this->update_info($data, $where);
                }
                else
                {
                    $this->create(array('key'=>$k, 'val'=>$v));
                }
            }
        }
    }
    
}