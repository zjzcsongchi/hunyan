<?php 
/**
 * 场馆表
 * @author chaokai@gz-zc.cn
 */
class Model_venue extends MY_Model{
    private $_table = 't_venue';
    
    public function __construct(){
        
        parent::__construct($this->_table);
    }
    
    /**
     * 获取列表
     * @author chaokai@gz-zc.cn
     */
    public function lists($where = array(), $orderby = array()){
        $default_where = array('is_del' => 0);
        $where = array_merge($where, $default_where);
        $field = 'id,name,introduce,floor,height,min_consume,max_consume,fit_type,area_size,container,max_table,cover_img,is_recommend,device';
        
        $list = $this->get_lists($field, $where, $orderby);
        foreach($list as $k => $v){
            $list[$k]['cover_img'] = get_img_url($v['cover_img']);
            $list[$k]['is_recommend_text'] = $v['is_recommend'] ? '是' : '否';
        }
        
        return $list;
    }
    
    /**
     * 获取详细信息
     * @author chaokai@gz-zc.cn
     */
    public function info($id){
        $where = array('is_del' => 0, 'id' => $id);
        $field = 'id,name,introduce,floor,height,min_consume,max_consume,fit_type,area_size,container,max_table,cover_img,images,is_recommend,device,combo_ids, venue_video,video_cover_img,venue_class_id';
        
        $info = $this->get_one($field, $where);
        
        $info['cover_img_url'] = get_img_url($info['cover_img']);
        if(!empty($info['images'])){
            $info['images'] = explode(',', $info['images']);
        }else{
            $info['images'] = array();
        }
        $info['images_url'] = array();
        if($info['images']){
            foreach ($info['images'] as $k => $v){
                $info['images_url'][] = array('img' => $v, 'img_url' => get_img_url($v));
            }
        }
        
        if(!empty($info['combo_ids'])){
            $info['combo_ids'] = explode(',', $info['combo_ids']);
        }else{
            $info['combo_ids'] = array();
        }
        
        return $info;
    }
}