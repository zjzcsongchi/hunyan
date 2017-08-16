<?php
/**
 * 场景制作
 * @author chaokai@gz-zc.cn
 */
use DiDom\Document;
use DiDom\Element;
use OSS\OssClient;
use OSS\Core\OssException;
require_once(BASEPATH.'../shared/libraries/aliyunoss/autoload.php');
class Vtourscene extends MY_Controller{

    public function __construct(){
        
        parent::__construct();
        
        $this->load->model(array(
                        'Model_vtour_scene' => 'Mvtour_scene'
        ));
        
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Document.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Errors.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Element.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Query.php');
        
        $this->vtour_type = array_column(C('vtour'), 'name', 'id');
        
        $this->load->library('pagination');
        $this->load->file(BASEPATH.'../shared/libraries/Krpano.php');
        
        $access_key = C('aliyun.oss.access_key');
        $access_secret = C('aliyun.oss.access_secret');
        $endpoint = C('aliyun.oss.endpoint');
        
        try {
            $this->ossclient = new OssClient($access_key, $access_secret, $endpoint, true);
        }catch (OssException $e){
            echo $e->getMessage();
            log_message('ERROR', $e->getMessage());
        }
    }
    
    /**
     * 场景列表
     */
    public function index(){
        $data = $this->data;
        
        $pageconfig = C('page.config_bootstrap');
        $pagesize = $pageconfig['per_page'];
        $page = intval($this->input->get('per_page'))?:1;
        $offset = $pagesize*($page - 1);
        
        $field = 'id,name,type,create_time';
        $where = array('is_del' => 0);
        $order_by = array('create_time' => 'desc');
        $list = $this->Mvtour_scene->get_lists($field, $where, $order_by, $pagesize, $offset);
        $data['data_count'] = $count = $this->Mvtour_scene->count($where);
        
        if(!empty($list)){
            $pageconfig['total_rows'] = $count;
            $pageconfig['base_url'] = '/vtourscene/index';
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        
        foreach ($list as $k => $v){
            $list[$k]['type_text'] = $this->vtour_type[$v['type']];
        }
        $data['list'] = $list;
        
        $this->load->view('vtourscene/index', $data);
    }
    
    /**
     * 制作场景
     * @author chaokai@gz-zc.cn
     */
    public function add(){

        $data = $this->data;
        
        $data['type'] = $this->vtour_type;
        
        if(IS_POST){
            $file_name = $this->input->post('img');
            if(empty($file_name)){
                $this->return_failed('请先上传图片');
            }
            $upload_dir = C('upload.upload_dir');
            $file_path = '';//文件路径
            //图片文件夹名称
            foreach ($file_name as $v){
                if(strtolower(substr($v, -3)) != 'jpg'){
                    $this->return_failed('图片类型需要为JPG格式');
                }
            }
            
            $krpano = Krpano::get_instance();
            $vtour_arr = [];
            foreach ($file_name as $v){
                $vtour = $krpano->to_vtour($v);
                //如果过程中出现错误，删除之前制作成功的全景图
                if(!$vtour){
                    array_map(function($k, $v){delete_dir($v['vtour_path']); unlink($v['xml_path']); }, $vtour_arr);
                    $this->return_failed('制作失败');
                }else{
                    $vtour_arr[] = $vtour;
                }
            }
            //查询数据库中最大场景id
            $max = $this->Mvtour_scene->get_one('max(id) as max_id', array());
            $scene_data = array();
            foreach ($vtour_arr as $k => $v){
                $xml_str = file_get_contents($v['xml_path']);
                $document = new Document($xml_str);
                $document->find('scene')[0]->attr('name', uniqid('s_'));
                
                $source_path = str_replace(C('upload.upload_dir').'image/', '', $v['vtour_path']);
                $document->find('scene')[0]->attr('thumburl', $source_path.'/thumb.jpg');

                $scene = $document->find('scene')[0];
                $scene_name = $scene->attr('name');
                $scene_thumburl = $scene->attr('thumburl');
                
                $preview_url = $scene->first('preview')->attr('url');
                
                $image = $scene->first('image');
                foreach ($image->children() as $item) {
                    if ($item->attr('devices')) {
                        $mobile_image = $item->attr('url');
                    } else {
                        $pc_image = $item->attr('url');
                    }
                }

                $view = $scene->first('view');
                $view_fov = $view->attr('fov');
                $view_fovmax = $view->attr('fovmax');
                $view_fovmin = $view->attr('fovmin');
                $view_fovtype = $view->attr('fovtype');
                
                $scene_data[] = array(
                    'name' => $this->input->post('name'),
                    //'content' => $document->find('scene')[0]->xml(),
                    'scene_name' => $scene_name,
                    'scene_thumburl' => $scene_thumburl,
                    'preview_url' => $preview_url,
                    'mobile_image' => $mobile_image,
                    'pc_image' => $pc_image,
                    'view_fov' => $view_fov,
                    'view_fovmax' => $view_fovmax,
                    'view_fovmin' => $view_fovmin,
                    'view_fovtype' => $view_fovtype,
                    'source_img' => $source_path.'.jpg',
                    'thumb_img' => $source_path.'/thumb.jpg',
                    'type' => $this->input->post('type'),
                    'create_time' => date('Y-m-d H:i:s'),
                    'create_admin' => $this->data['userInfo']['id'],
                    'update_time' => date('Y-m-d H:i:s'),
                    'update_admin' => $this->data['userInfo']['id']
                );
            }
            
            if($this->Mvtour_scene->create_batch($scene_data)){
                
                //上传到oss
                foreach ($file_name as $k => $v){
                    $this->save_to_oss('image/'.substr($v, 0, 41));
                }
                //删除xml文件
                foreach ($vtour_arr as $k => $v){
                    unlink($v['xml_path']);
                }
                $this->return_success();
            }else{
                $this->return_failed('保存失败');
            }
        }
        
        $this->load->view('vtourscene/add', $data);
    }
    
    /**
     * 修改场景
     * @author chaokai@gz-zc.cn
     */
    public function edit(){
        $id = intval($this->input->get('id'));
        $data = $this->data;
        $data['type'] = $this->vtour_type;
        
        if(IS_POST){
            $file_name = $this->input->post('img');
            if(empty($file_name)){
                $this->return_failed('请先上传图片');
            }
            $upload_dir = C('upload.upload_dir');
            $file_path = '';//文件路径
            //图片文件夹名称
            if(strtolower(substr($file_name, -3)) != 'jpg'){
                $this->return_failed('图片类型需要为JPG格式');
            }
            
            $krpano = Krpano::get_instance();
            $vtour = $krpano->to_vtour($file_name);
            //如果过程中出现错误，删除之前制作成功的全景图
            if(!$vtour){
                delete_dir($vtour['vtour_path']); 
                unlink($vtour['xml_path']);
                $this->return_failed('制作失败');
            }
            //查询数据库中最大场景id
            $max = $this->Mvtour_scene->get_one('max(id) as max_id', array());
            
            $xml_str = file_get_contents($vtour['xml_path']);
            $document = new Document($xml_str);
            $document->find('scene')[0]->attr('name', uniqid('s_'));
        
            $source_path = str_replace(C('upload.upload_dir').'image/', '', $vtour['vtour_path']);
            $document->find('scene')[0]->attr('thumburl', $source_path.'/thumb.jpg');
        
            $scene = $document->find('scene')[0];
            //$scene_name = $scene->attr('name');
            $scene_thumburl = $scene->attr('thumburl');
            
            $preview_url = $scene->first('preview')->attr('url');
            
            $image = $scene->first('image');
            foreach ($image->children() as $item) {
                if ($item->attr('devices')) {
                    $mobile_image = $item->attr('url');
                } else {
                    $pc_image = $item->attr('url');
                }
            }
            
            $view = $scene->first('view');
            $view_fov = $view->attr('fov');
            $view_fovmax = $view->attr('fovmax');
            $view_fovmin = $view->attr('fovmin');
            $view_fovtype = $view->attr('fovtype');
            
            $scene_data = array(
                'name' => $this->input->post('name'),
                //'content' => $document->find('scene')[0]->xml(),
                //'scene_name' => $scene_name,
                'scene_thumburl' => $scene_thumburl,
                'preview_url' => $preview_url,
                'mobile_image' => $mobile_image,
                'pc_image' => $pc_image,
                'view_fov' => $view_fov,
                'view_fovmax' => $view_fovmax,
                'view_fovmin' => $view_fovmin,
                'view_fovtype' => $view_fovtype,
                'source_img' => $source_path.'.jpg',
                'thumb_img' => $source_path.'/thumb.jpg',
                'type' => $this->input->post('type'),
                'update_time' => date('Y-m-d H:i:s'),
                'update_admin' => $this->data['userInfo']['id']
            );
            
            if($this->Mvtour_scene->update_info($scene_data, array('id' => $this->input->post('id')))){
            
                //上传到oss
                $this->save_to_oss('image/'.substr($file_name, 0, 41));
                //删除xml文件
                unlink($vtour['xml_path']);
                $this->return_success();
            }else{
                $this->return_failed('保存失败');
            }
        }
        
        $field = 'id,name,type,source_img';
        $where = array(
                        'id' => $id,
                        'is_del' => 0
        );
        $info = $this->Mvtour_scene->get_one($field, $where);
        empty($info) && show_404();
        $data['info'] = $info;
        $this->load->view('vtourscene/edit', $data);
    }
    
    /**
     * 删除场景
     * @author chaokai@gz-zc.cn
     */
    public function del(){
        $id = intval($this->input->get('id'));
        !$id && $this->return_failed('参数错误');
        
        $where = array('id' => $id);
        
        $this->Mvtour_scene->delete($where);
        $this->return_success();
    }
    
    public function scan($id = 0){
        $id = intval($id);
        !$id && show_404();
        
        $data = $this->data;
        
        $field = 'id,name,content,thumb_img,source_img';
        $where = array('id' => $id);
        $info = $this->Mvtour_scene->get_one($field, $where);
        
        if(empty($info)){
            show_404();
        }
        $data['info'] = $info;
        
        $this->load->view('vtourscene/scan', $data);
    }
    
    /**
     * 查看场景
     * @author chaokai@gz-zc.cn
     */
    public function load_xml($id = 0){
        $id = intval($id);
        !$id && show_404();
        
        $field = 'id,name,content,thumb_img,source_img,scene_name,scene_thumburl,preview_url,mobile_image,pc_image,view_fov,view_fovmax,view_fovmin,view_fovtype';
        $where = array('id' => $id);
        $info = $this->Mvtour_scene->get_one($field, $where);
        
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
        
        //xml模板文件
        $xml_temp = BASEPATH.'../static/krpano/vtour_scene_content.xml';
        $xml_temp_str = file_get_contents($xml_temp);
        
        $scene_xml = new Document($xml_temp_str);
        
        foreach ($scene_xml->find('preview') as $v){
            $v->attr('url', get_img_url($info['preview_url']));
        }
        foreach ($scene_xml->find('cube') as $v){
            if ($v->attr('devices')) {
                $v->attr('url', get_img_url($info['mobile_image']));
            } else {
                $v->attr('url', get_img_url($info['pc_image']));
            }
        }
        foreach ($scene_xml->find('scene') as $v){
            $v->attr('thumburl', get_img_url($info['scene_thumburl']));
            $v->attr('name', $info['scene_name']);
        }
        foreach ($scene_xml->find('view') as $v){
            $v->attr('fov', $info['view_fov']);
            $v->attr('fovmin', $info['view_fovmin']);
            $v->attr('fovmax', $info['view_fovmax']);
            $v->attr('fovtype', $info['view_fovtype']);
        }
        
        $document->find('krpano')[0]->appendChild($scene_xml->find('scene')[0]);
        
        header('Content-Type:text/xml');
        echo $document->find('krpano')[0]->xml();
    }
    
    /**
     * 将全景图文件夹上传到oss
     * @author chaokai@gz-zc.cn
     */
    private function save_to_oss($folder){
    
        if(ENVIRONMENT == 'development'){
            return true;
        }
        $bucket = C('aliyun.oss.bucket');
        $file_path = C('upload.upload_dir').$folder;
        try {
            $oss_return = $this->ossclient->uploadDir($bucket, $folder, $file_path, '', true);
            if(!empty($oss_return['failedList'])){
                foreach ($oss_return['failedList'] as $k => $v){
                    $this->ossclient->uploadFile($bucket, $k, C('upload.upload_dir').'/'.$k);
                }
            }
            //删除本地文件
            delete_dir($file_path);
        }  catch(OssException $e) {
            $this->return_failed($e->getMessage());
        }
    
        return true;
    }
}
