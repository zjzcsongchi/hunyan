<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_dinner_images extends MY_Model {

    private $_table = 't_dinner_images';

    public function __construct() {
        parent::__construct($this->_table);
        
        $this->load->model(array(
                        'Model_dinner_album' => 'Mdinner_album'
        ));
    }    
    
    /**
     * 获取某场宴会所有相册及相片
     * @author chaokai@gz-zc.cn
     */
    public function all_images($dinner_id){
        //获取宴会相册
        $album_where = array('is_del' => 0, 'dinner_id' => $dinner_id);
        $album_field = 'id,name';
        $album = $this->Mdinner_album->get_lists($album_field, $album_where);
        if(!$album){
            return false;
        }
        
        //获取相册中的相片
        $album_ids = array_column($album, 'id');
        $image_where = array('is_del' => 0, 'in' => array('album_id' => $album_ids));
        $image_field = 'id,album_id,thumb,sy_img';
        $images = $this->get_lists($image_field, $image_where);
        
        foreach ($album as $k => $v){
            foreach ($images as $key => $value){
                if($v['id'] == $value['album_id']){
                    $album[$k]['images'][] = $value;
                }
            }
        }
        
        return $album;
    }
}