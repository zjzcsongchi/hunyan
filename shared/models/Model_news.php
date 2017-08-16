<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_news extends MY_Model {

    private $_table = 't_news';

    public function __construct() {
        parent::__construct($this->_table);
        
        $this->load->model(array(
                        'Model_news_class' => 'Mnews_class',
        ));
    }
    
    /**
     * 推荐到首页资讯
     * @author chaokai@gz-zc.cn
     */
    public function home_news(){
        $where = array(
                        'is_del' => 0,
                        'is_head_recommend' => 1,
                        'is_show' => 1
        );
        $field = 'id,title,news_class_id';
        $order_by = array('publish_time' => 'desc');
        $list = $this->get_lists($field, $where, $order_by, 3);
        
        if(empty($list)){
            return false;
        }
        
        //获取分类名称
        $class_ids = array_column($list, 'news_class_id');
        $classes = $this->Mnews_class->classes($class_ids);
        
        foreach ($list as $k => $v){
            foreach ($classes as $key => $value){
                if($v['news_class_id'] == $value['id']){
                    $list[$k]['news_class_name'] = $value['name'];
                }
            }
        }
        return $list;
    }
}