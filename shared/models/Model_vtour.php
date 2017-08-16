<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * VR全景model
 * 
 * @author huangjialin
 *
 */
use DiDom\Element;
use DiDom\Document;
class Model_vtour extends MY_Model {

    private $_table = 't_vtour';

    public function __construct() {
        parent::__construct($this->_table);

        $this->load->model(array(
            'Model_vtour_include_scene' => 'Mvtour_include_scene',
            'Model_vtour_view' => 'Mvtour_view',
            'Model_vtour_hotspot' => 'Mvtour_hotspot'
        ));

    }
    
    /**
     * 根据大厅id获取大厅的全景
     * @param $ids array/int 大厅id，数组或id
     * @author chaokai@gz-zc.cn
     */
    public function get_by_venue($ids){
        $field = 'id,venue_id';
        $where = array(
                        'is_del' => 0
        );
        if(is_array($ids)){
            $where['in'] = array(
                            'venue_id' => $ids
            );
        }elseif(is_int($ids)){
            $where['venue_id'] = $ids;
        }
        
        $list = $this->get_lists($field, $where);
        
        $return_arr = array();
        if(is_array($ids)){
            foreach ($ids as $k => $v){
                foreach ($list as $key => $value){
                    if($v == $value['venue_id']){
                        $return_arr[$v] = $value['id'];
                    }
                }
            }
        }else{
            $return_arr[$ids] = $list[0]['id'];
        }
        
        return $return_arr;
    }

    /**
     * 获取xml数据
     * @author chaokai@gz-zc.cn
     */
    public function load_xml($id, $is_mobile = false){

        $field = 'id,name,scene_ids,bgmusic,xml_string,json';
        $where = array('id' => $id);
        $info = $this->get_one($field, $where);
        
        if(empty($info)){
            show_404();
        }
        
        //xml模板文件
        $xml_temp = BASEPATH.'../static/krpano/vtour.xml';
        $xml_temp_str = file_get_contents($xml_temp);
        
        //xml对象
        $document = new Document($xml_temp_str);
        
        $action_node = $document->find('action')[0]->remove();
        
        //插件加载
        $plugins = C('vr_plugins');
        foreach ($plugins as $k => $v){
            foreach ($v as $key => $value){
                if(isset($value['url'])){
                    $value['url'] = $this->data['domain']['static']['url'].'/krpano/'.$value['url'];
                }
                if(isset($value['alturl'])){
                    $value['alturl'] = $this->data['domain']['static']['url'].'/krpano/'.$value['alturl'];
                }
                $ele = new Element($k, null, $value);
                $document->find('krpano')[0]->appendChild($ele);
            }
        }
        $document->find('krpano')[0]->appendChild($action_node);

        //data节点存储用户头像
        $head_img = '';
        if(!empty($_SESSION['user'])){
            $user_data = decrypt($_SESSION['user']);
            $user_info = $this->Muser->get_one('head_img', array('id' => $user_data['id']));
            $head_img = !empty($user_info['head_img']) ? get_img_url($user_info['head_img']) : '';
        }
        $data_node = new Element('data', null, array('name' => 'head_img', 'content' => $head_img));
        $document->find('krpano')[0]->appendChild($data_node);

        //查询全景包含的场景
        $scenes = $this->Mvtour_include_scene->get_lists('*', array('vtour_id' => $id));
        //查询全景包含的视角配置
        $view = $this->Mvtour_view->get_lists('*', array('vtour_id' => $id));

        foreach($scenes as $k => $v){
            $scene_arr = array(
                'name' => $v['name'],
                'thumburl' => get_img_url($v['thumb_img'])
            );
            $scene_node = new Element('scene', null, $scene_arr);
            //预览图节点
            $preview_arr = array(
                'url' => get_img_url($v['preview_img'])
            );
            $preview_node = new Element('preview', null, $preview_arr);

            $scene_node->appendChild($preview_node);
            //图片节点
            $image_node = new Element('image');
            //cube节点
            $cube_pc_arr = array(
                'url' => get_img_url($v['cube_pc_img']),
            );
            $cube_pc_node = new Element('cube', null, $cube_pc_arr);
            $image_node->appendChild($cube_pc_node);
            $cube_wap_arr = array(
                'url' => get_img_url($v['cube_wap_img']),
                'devices' => 'mobile'
            );
            $cube_wap_node = new Element('cube', null, $cube_wap_arr);
            $image_node->appendChild($cube_wap_node);
            $scene_node->appendChild($image_node);

            foreach ($view as $key => $value) {
                if($value['scene'] == $v['name']){
                    unset($value['id'], $value['vtour_id'], $value['scene']);
                    $view_node_arr = $value;
                    $view_node = new Element('view', null, $view_node_arr);
                    $scene_node->appendChild($view_node);
                    break;
                }
            }

            $document->find('krpano')[0]->appendChild($scene_node);
        }
        
        //查询场景热点
        $hotspot = $this->Mvtour_hotspot->get_lists('*', array('vtour_id' => $id));

        foreach ($hotspot as $key => $value) {
            if($value['hotspot_type'] == 'video'){
                $hotspot_id = $value['id'];
                unset($value['id'], $value['vtour_id'], $value['create_time'], $value['create_admin'], $value['linkedscene'], $value['dynamic_param']);

                $videourl = get_video_url($value['source_url']);
                $posterurl = !empty($value['posterurl']) ? get_img_url($value['posterurl']) : '';
                $value['onclick'] = "togglepause();jscall($('.bgmusic_btn').trigger('click', 'video');)";
                $value['edge'] = "center";
                $value['loop'] = true;
                $value['rx'] = 0;
                $value['ry'] = 0;
                $value['rz'] = 0;
                $value['ox'] = 0;
                $value['oy'] = 0;
                $value['distorted'] = true;
                $value['pausedonstart'] = true;
                //判断是手机还是pc端
                if($is_mobile){
                    //手机端
                    $value['url'] = $this->data['domain']['static']['url'].'/krpano/skin/media_playback_start.png';
                    // $value['onclick'] = "looktohotspot(get(name),90); videoplayer_open('".$videourl."', '".$posterurl."', 0.5);jscall($('.bgmusic_btn').trigger('click', 'mobile');)";
                    $value['onclick'] = "js(show_layer({$hotspot_id}, 'playvideo'));jscall($('.bgmusic_btn').trigger('click', 'mobile');)";
                    $value['scale'] = 0.6;
                }else{
                    //pc浏览器
                    $value['videourl'] = $videourl;
                    $value['posterurl'] = $posterurl;
                    $value['url.html5'] = $this->data['domain']['static']['url'].'/krpano/plugins/videoplayer.js';
                    $value['url.flash'] = $this->data['domain']['static']['url'].'/krpano/plugins/videoplayer.swf';
                    $value['onhover'] = 'add_control_btn()';
                    $value['onout'] = 'remove_control_btn()';
                }
                if($document->find('scene[name='.$value['scene'].']')){
                    $scene_node = $document->find('scene[name='.$value['scene'].']')[0];
                    unset($value['scene'], $value['source_url']);
                    $video_hotspot = new Element('hotspot', null, $value);
                    $scene_node->appendChild($video_hotspot);
                }
            }
        }
        

        return $document->find('krpano')[0]->xml();
    }

    /**
     * 获取详情信息
     * @author chaokai@gz-zc.cn
     */
    public function get_scan_info($id, $is_mobile = false){
        $info = $this->Mvtour->get_one('logo,name,bgmusic,scan_count,venue_id,zan,scene_ids,place,location', array('id' => intval($id)));
        if(empty($info)){
            return false;
        }
        if(!empty($info['location'])){
            $info['location'] = explode(',', $info['location']);
        }

        //场景
        $scene = $this->Mvtour_include_scene->get_lists('*', array('vtour_id' => $id));
        $scene_param = [];
        foreach ($scene as $k => $v) {
            $scene_param[$k]['name'] = $v['scene_name'];
            $scene_param[$k]['thumb'] = get_img_url($v['thumb_img']);
            $scene_param[$k]['value'] = $v['name'];
        }
        //视角
        $view = $this->Mvtour_view->get_lists('*', array('vtour_id' => $id));
        // foreach($view as $k => $v){
            // unset($view[$k]['id'], $view[$k]['vtour_id']);
        // }
        //热点
        $hotspot = $this->Mvtour_hotspot->get_lists('*', array('vtour_id' => $id));

        // $json = json_decode($info['json'], true);
        if(!empty($hotspot)){
            foreach ($hotspot as $k => $value){
                if($value['hotspot_type'] == 'voice'){
                    $hotspot[$k]['music_url'] = get_img_url($value['source_url']);
                    $hotspot[$k]['onclick'] = 'playsound('.$value['name'].','.get_img_url($value['source_url']).'); jscall($(".voice_btn").show();$(".voice_btn").attr("data-name", "'.$value['name'].'"));)';
                }
    
                if($value['hotspot_type'] == 'video'){
                    $videourl = get_video_url($value['source_url']);
                    $posterurl = !empty($value['posterurl']) ? get_img_url($value['posterurl']) : '';
    
                    if($is_mobile){
                        //手机端
                        $hotspot[$k]['url'] = $this->data['domain']['static']['url'].'/krpano/skin/media_playback_start.png';
                        $hotspot[$k]['onclick'] = "looktohotspot(get(name),90); videoplayer_open('".$videourl."', '".$posterurl."', 0.5);";
                        $hotspot[$k]['scale'] = 0.6;
                    }else{
                        $hotspot[$k]['videourl'] = $videourl;
                        $hotspot[$k]['posterurl'] = $posterurl;
                        $hotspot[$k]['url.html5'] = $this->data['domain']['static']['url'].'/krpano/plugins/videoplayer.js';
                        $hotspot[$k]['url.flash'] = $this->data['domain']['static']['url'].'/krpano/plugins/videoplayer.swf';
    
                    }
                }
                $hotspot[$k]['dynamic_param'] = str_replace(';', ',', $value['dynamic_param']);
                // unset($hotspot[$k]['id']);
            }
        
        }else{
            $hotspot = [];
        }
        $info['json'] = array(
            'scene' => $scene_param,
            'view' => $view,
            'hotspot' => $hotspot
        );
        // $info['json'] = json_encode($info['json']);

        return $info;
    }
}