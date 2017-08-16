<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 婚庆主题model
 * 
 * @author songchi
 *
 */
class Model_theme extends MY_Model {

    private $_table = 't_theme';

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