<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 手工分类model
 * 
 * @author huangjialin
 *
 */
class Model_about_us extends MY_Model {

    private $_table = 't_about_us';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    /**
     * 获取关于我们信息
     * @author chaokai@gz-zc.cn
     *  
     */
    public function info(){
        $info = $this->get_one('*');
        
        $info['vedio_img'] = get_img_url($info['vedio_img']);
        
        return $info;
    }
    
}