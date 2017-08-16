<?php
/**
 * VR全景制作
 * @author chaokai@gz-zc.cn
 */
use DiDom\Document;
use DiDom\Element;
use OSS\OssClient;
use OSS\Core\OssException;
require_once(BASEPATH.'../shared/libraries/aliyunoss/autoload.php');
class Vtour extends MY_Controller{
    
    private $vtour_type;
    private $ossclient;
    
    public function __construct(){
        
        parent::__construct();
        
        $this->load->model(array(
                        'Model_vtour' => 'Mvtour',
                        'Model_vtour_scene' => 'Mvtour_scene',
                        'Model_venue' => 'Mvenue',
                        'Model_hotspot_ico' => 'Mhotspot_ico',
                        'Model_vtour_comment' => 'Mvtour_comment',
                        'Model_vtour_view' => 'Mvtour_view',
                        'Model_vtour_include_scene' => 'Mvtour_include_scene'
        ));
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Document.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Errors.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Element.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Query.php');
            
        $this->vtour_type = array_column(C('vtour'), 'name', 'id');
        
        $this->load->library(array('pagination', 'user_agent', 'form_validation'));
        $this->load->file(BASEPATH.'../shared/libraries/Krpano.php');
        $this->load->library('session');
        
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
     * 全景列表
     * @author chaokai@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        
        $pageconfig = C('page.config_bootstrap');
        $pagesize = $pageconfig['per_page'];
        $page = intval($this->input->get('per_page'))?:1;
        $offset = $pagesize*($page - 1);
        
        $field = 'id,name,type,introduce,create_time,venue_id,scan_count,zan';
        $where = array('is_del' => 0);
        $order_by = array('create_time' => 'desc');
        $list = $this->Mvtour->get_lists($field, $where, $order_by, $pagesize, $offset);
        $data['data_count'] = $count = $this->Mvtour->count($where);
        
        if(!empty($list)){
            $pageconfig['total_rows'] = $count;
            $pageconfig['base_url'] = '/vtour/index';
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        
        $data['list'] = $list;
        
        $venue_list = $this->Mvenue->lists();
        $data['venue_list'] = array_column($venue_list, 'name', 'id');
        
        $this->load->view('vtour/index', $data);
    }
    
    /**
     * 添加VR场景
     * @author chaokai@gz-zc.cn
     */
    public function add(){
        
        $data = $this->data;
        
        $data['type'] = $this->vtour_type;
        
        if(IS_POST){
            $insert_data = array(
                            'cover_img' => $this->input->post('cover_img') ? : '',
                            'venue_id' => $this->input->post('venue_id') ? : 0,
                            'name' => $this->input->post('name'),
                            'logo' => $this->input->post('logo') ? : '',
                            'bgmusic' => $this->input->post('bgmusic') ? : '',
                            'introduce' => $this->input->post('introduce'),
                            'place' => $this->input->post('place') ? : '',
                            'location' => $this->input->post('location') ? : '',
                            'create_time' => date('Y-m-d H:i:s')
            );
            $scene_ids = $this->input->post('scene');
            $insert_data['scene_ids'] = implode($scene_ids, ',');
            
            if($id = $this->Mvtour->create($insert_data)){
                //查询出所有的场景xml，并保存相关配置数据
                $this->check_xml($scene_ids, $id);
                $this->return_success();
            }else{
                $this->return_failed('合成失败');
            }
        }
        
        $data['venue_list'] = $this->Mvenue->lists();
        $this->load->view('vtour/add', $data);
    }
    
    /**
     * ajax加载场景列表
     * @author chaokai@gz-zc.cn
     */
    public function ajax_scene(){
        $type = (int)$this->input->get('type');
        $id = intval($this->input->get('id'));
        !$type && $this->return_failed('参数错误');
        
        $field = 'id,thumb_img,name';
        $where = array('type' => $type, 'is_del' => 0);
        $data['list'] = $this->Mvtour_scene->get_lists($field, $where);
        
        if(!empty($id)){
            $vtour_info = $this->Mvtour->get_one('scene_ids', array('id' => $id));
            $vtour_ids = explode(',', $vtour_info['scene_ids']);
            foreach ($data['list'] as $k => $v){
                if(in_array($v['id'], $vtour_ids)){
                    $data['list'][$k]['is_checked'] = true;
                }
            }
            //重新排序
            $tmp_list = [];
            foreach ($vtour_ids as $key => $value) {
                foreach ($data['list'] as $k => $v) {
                    if($value == $v['id']){
                        $tmp_list[] = $v;
                        unset($data['list'][$k]);
                    }
                }
            }
            $data['list'] = array_merge($tmp_list, $data['list']);
        }
        
        empty($data['list']) && $this->return_failed('不存在数据');
        
        $list_view = $this->load->view('vtour/ajax_scene', $data, true);
        
        $this->return_success($list_view);
    }
    
    /**
     * 修改场景关联数据
     * @author chaokai@gz-zc.cn
     */
    public function modify(){
        $id = (int)$this->input->get('id');
        !$id && show_404();
        $data = $this->data;
        $data['type'] = $this->vtour_type;
        $field = 'id,name,type,introduce,logo,bgmusic,venue_id,cover_img,scene_ids,place,location';
        $where = array(
                        'id' => $id,
                        'is_del' => 0
        );
        $info = $this->Mvtour->get_one($field, $where);
        if(empty($info)){
            show_404();
        }
        
        if(IS_POST){
            //表单验证
            $this->form_validation->set_rules('name', '名称', 'required', array('required' => '请输入名称'));
            if($this->form_validation->run() == false){
                $this->error(validation_errors());
            }
            $post_data = $this->input->post();
            
            empty($post_data['cover_img']) && $post_data['cover_img'] = '';
            empty($post_data['logo']) && $post_data['logo'] = '';
            empty($post_data['venue_id']) && $post_data['venue_id'] = 0;
            empty($post_data['bgmusic']) && $post_data['bgmusic'] = '';
            
            $update_where = array('id' => $id);
            
            //比较已保存的场景和修改后的场景是否有变化
            //如果有变化更新相应字段，否则不更新
            $exist_scene = explode(',', $info['scene_ids']);
            $reverse_diff = array_diff_assoc($exist_scene, $post_data['scene']);
            $diff = array_diff($post_data['scene'], $exist_scene);
            if(!empty($reverse_diff) || !empty($diff)){
                $this->check_xml($post_data['scene'], $id);
                $post_data['scene_ids'] = implode(',', $post_data['scene']);
            }
            unset($post_data['scene']);
            
            $this->Mvtour->update_info($post_data, $update_where);
            $this->success('修改成功', '/vtour/index');
        }
        
        $data['info'] = $info;
        $data['venue_list'] = $this->Mvenue->lists();
        
        //获取已合成的场景
        $scene_ids = explode(',', $info['scene_ids']);
        $scene = $this->Mvtour_scene->lists($scene_ids);
        foreach ($scene_ids as $key => $value) {
            foreach ($scene as $k => $v) {
                if($v['id'] == $value){
                    $data['scene'][$key] = $v;
                    break;
                }
            }
        }
        $this->load->view('vtour/modify', $data);
    }
    

    /**
     * 修改VR场景
     * @author chaokai@gz-zc.cn
     */
    public function edit($id = 0){
        $data = $this->data;
        $id = intval($id);
        $data['id'] = $id;

        $vtour_id = intval($this->input->post('id')) ? : $id;
        if(!$id && !$vtour_id){
            $this->return_failed('保存失败');
        }
        //查询xml配置
        $field = 'logo, bgmusic,name,scan_count';
        $xml_data = $this->Mvtour->get_one($field, array('id' => $vtour_id));
        if(empty($xml_data)){
            $this->return_failed('数据不存在');
        }
        $data['info'] = $xml_data;
        if(IS_POST){
            
            //事务
            $this->db->trans_start();
            #解析json数据
            $vtour_data = $this->input->post('data');
            //删除所有的热点及视角配置
            // $this->Mvtour_view->delete(array('vtour_id' => $vtour_id));
            // $this->Mvtour_hotspot->delete(array('vtour_id' => $vtour_id));


            $view = $vtour_data['view'];
            $delete = !empty($vtour_data['delete']) ? $vtour_data['delete'] : [];
            $hotspot = $vtour_data['hotspot'];
            //计算热点总数
            $get_hotspot_count = count($delete)+count($hotspot);
            $save_hotspot_count = $this->Mvtour_hotspot->count(array('vtour_id' => $vtour_id));
            if($get_hotspot_count < $save_hotspot_count){
                $this->return_failed('上传热点数据不对');
            }
            //计算视角配置总数
            $get_view_count = count($view);
            $save_view_count = $this->Mvtour_view->count(array('vtour_id' => $vtour_id));
            if($get_view_count != $save_view_count){
                $this->return_failed('上传视角数据不对');
            }
            //更新视角信息
            foreach ($view as $key => $value) {
                $view_id = $value['id'];
                unset($value['id']);
                $this->Mvtour_view->update_info($value, array('id' => $view_id));
            }


            $hotspot_insert = array();
            $hotspot_update = array();

            foreach ($hotspot as $key => $value) {
                if(empty($value['id'])){
                    $hotspot_insert[] = array(
                        'vtour_id' => $vtour_id,
                        'dynamic_param' => !empty($value['dynamic_param']) ? str_replace(',', ';', $value['dynamic_param']) : '',
                        'scene' => !empty($value['scene']) ? $value['scene'] : '',
                        'name' => !empty($value['name']) ? $value['name'] : '',
                        'ath' => !empty($value['ath']) ? $value['ath'] : '',
                        'atv' => !empty($value['atv']) ? $value['atv'] : '',
                        'hotspot_name' => !empty($value['hotspot_name']) ? $value['hotspot_name'] : '',
                        'hotspot_type' => $value['hotspot_type'],
                        'ico_url' => !empty($value['ico_url']) ? $value['ico_url'] : '',
                        'url' => !empty($value['url']) ? $value['url'] : '',
                        'source_url' => !empty($value['source_url']) ? $value['source_url'] : '',
                        'distorted' => !empty($value['distorted']) ? $value['distorted'] : '',
                        'tooltip' => !empty($value['tooltip']) ? $value['tooltip'] : '',
                        'scale' => !empty($value['scale']) ? $value['scale'] : '',
                        'linkedscene' => !empty($value['linkedscene']) ? $value['linkedscene'] : '',
                        'posterurl' => !empty($value['posterurl']) ? $value['posterurl'] : '',
                        'article_content' => !empty($value['article_content']) ? $value['article_content'] : '',
                    );
                }else{
                    $hotspot_update[] = array(
                        'id' => $value['id'],
                        'vtour_id' => $value['vtour_id'],
                        'dynamic_param' => !empty($value['dynamic_param']) ? str_replace(',', ';', $value['dynamic_param']) : '',
                        'scene' => !empty($value['scene']) ? $value['scene'] : '',
                        'name' => !empty($value['name']) ? $value['name'] : '',
                        'ath' => !empty($value['ath']) ? $value['ath'] : '',
                        'atv' => !empty($value['atv']) ? $value['atv'] : '',
                        'hotspot_name' => !empty($value['hotspot_name']) ? $value['hotspot_name'] : '',
                        'hotspot_type' => $value['hotspot_type'],
                        'ico_url' => !empty($value['ico_url']) ? $value['ico_url'] : '',
                        'url' => !empty($value['url']) ? $value['url'] : '',
                        'source_url' => !empty($value['source_url']) ? $value['source_url'] : '',
                        'distorted' => !empty($value['distorted']) ? $value['distorted'] : '',
                        'tooltip' => !empty($value['tooltip']) ? $value['tooltip'] : '',
                        'scale' => !empty($value['scale']) ? $value['scale'] : '',
                        'linkedscene' => !empty($value['linkedscene']) ? $value['linkedscene'] : '',
                        'posterurl' => !empty($value['posterurl']) ? $value['posterurl'] : '',
                        'article_content' => !empty($value['article_content']) ? $value['article_content'] : '',
                    );
                }
                
            }
            //循环更新
            foreach ($hotspot_update as $key => $value) {
                $hotspot_id = $value['id'];
                unset($value['id']);
                $this->Mvtour_hotspot->update_info($value, array('id' => $hotspot_id));
            }
            if(!empty($hotspot_insert)){
                $this->Mvtour_hotspot->create_batch($hotspot_insert);
            }
            //删掉已删除的
            if(!empty($delete)){
                $this->Mvtour_hotspot->delete(array('in' => ['id' => $delete]));
            }
            $this->db->trans_complete();
            
            $this->return_success([], '修改成功');
            
        }
        
        $vtour_data = $this->Mvtour->get_scan_info($id);
        $data['vtour_data'] = json_encode($vtour_data['json']);
        //默认热点加载
        $data['default_ico'] = json_encode($this->get_default_ico());
        //弹框模板加载
        //添加图文热点模板
        $add_article = $this->load->view("vtour/template/add_article", array('default_ico' => $this->get_default_ico()), true);
        $data['add_article'] = str_replace(array("\r\n", "\r", "\n"), "", $add_article);
        //修改图文热点模板
        $edit_article = $this->load->view("vtour/template/edit_article", array('default_ico' => $this->get_default_ico()), true);
        $data['edit_article'] = str_replace(array("\r\n", "\r", "\n"), "", $edit_article);
        //添加场景切换热点模板
        $add_vtour = $this->load->view("vtour/template/add_vtour", $vtour_data['json'], true);
        $data['add_vtour'] = str_replace(array("\r\n", "\r", "\n"), "", $add_vtour);
        //修改场景切换热点模板
        $edit_vtour = $this->load->view("vtour/template/edit_vtour", $vtour_data['json'], true);
        $data['edit_vtour'] = str_replace(array("\r\n", "\r", "\n"), "", $edit_vtour);
        //添加链接热点模板
        $add_link = $this->load->view("vtour/template/add_link", array('default_ico' => $this->get_default_ico()), true);
        $data['add_link'] = str_replace(array("\r\n", "\r", "\n"), "", $add_link);
        //修改链接热点模板
        $edit_link = $this->load->view("vtour/template/edit_link", array('default_ico' => $this->get_default_ico()), true);
        $data['edit_link'] = str_replace(array("\r\n", "\r", "\n"), "", $edit_link);
        //添加音乐热点模板
        $add_voice = $this->load->view("vtour/template/add_voice", array('default_ico' => $this->get_default_ico()), true);
        $data['add_voice'] = str_replace(array("\r\n", "\r", "\n"), "", $add_voice);
        //修改音乐热点模板
        $edit_voice = $this->load->view("vtour/template/edit_voice", array('default_ico' => $this->get_default_ico()), true);
        $data['edit_voice'] = str_replace(array("\r\n", "\r", "\n"), "", $edit_voice);
        //添加音乐热点模板
        $add_video = $this->load->view("vtour/template/add_video", null, true);
        $data['add_video'] = str_replace(array("\r\n", "\r", "\n"), "", $add_video);
        //修改视频热点模板
        $edit_video = $this->load->view("vtour/template/edit_video", null, true);
        $data['edit_video'] = str_replace(array("\r\n", "\r", "\n"), "", $edit_video);

        $this->load->view('vtour/edit', $data);
    }

    /**
     * 加载视频播放
     * @author chaokai@gz-zc.cn
     * @param $id int t_vtour_hotspot表主键id
     */
    public function playvideo(){
        try {
            $id = intval($this->input->get('id'));
            if(!$id){
                throw new Exception("参数错误");
            }

            $info = $this->Mvtour_hotspot->get_one("id,source_url", array('id' => $id));
            if(empty($info)){
                throw new Exception("数据不存在");
            }

            $data['info'] = $info;
            $this->return_success($this->load->view('vtour/ajax_playvideo', $data, true));
        } catch (Exception $e) {
            $this->return_failed($e->getMessage());
        }

    }
    
    /**
     * 加载xml
     * @author chaokai@gz-zc.cn
     */
    public function load_xml($id){
        $id = intval($id);
        !$id && show_404();
        
        $is_mobile = $this->agent->is_mobile();
        
        header('Content-Type:text/xml');
        echo $this->Mvtour->load_xml($id, $is_mobile);
    }
    
    /**
     * 删除场景
     * @author chaokai@gz-zc.cn
     */
    public function del(){
        $id = intval($this->input->get('id'));
        !$id && $this->return_failed('参数错误');
        
        $where = array('id' => $id);
        
        $this->Mvtour->delete($where);
        $this->return_success();
    }
    
    /**
     * 注册krpano
     * @author chaokai@gz-zc.cn
     */
    public function register_krpano(){
        $return_arr = [];
        $return_val = 0;
        exec("/data/krpano/krpanotools register ruza4tk2X4MdHuE7djJQGr9QTftMFHiSH2ac5jkIlFgGqG0K0IVQnh5vF/cicLpwedsURI0QTg+UluEgysRLUytpeVFyBTxdwREEIGquRh1Hp2BY2EtZ8kdO2r6CHLJAFlzY5w6au1rnHwRhJXgaK8J75RwK1DYb/OEZ4tD2pniUrnMrpFwGWwcKnxGyNSmMktsU6qadFjKbMH3HUKNXa7Y59lEzbDZJbsTuP+UynwwBhogv8K+byjs2LDvU48sx4/CNHWi26g==", $return_arr, $reutrn_val);
        if($return_val !== 0){
            p($return_arr);
        }else{
            die('注册成功');
        }
        
    }

    /**
     * 场景说一说
     * @author chaokai@gz-zc.cn
     */
    public function talk(){
        if(IS_POST){
            $this->form_validation->set_rules('vtour_id', '参数', 'integer|required', array('integer' => '参数错误', 'required' => '参数错误'));
            $this->form_validation->set_rules('content', '评论内容', 'required', array('required' => '%s不能为空'));

            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }

            $post_data = $this->input->post();
            $insert_data = array(
                'create_time' => date('Y-m-d H:i:s'),
                'hotspot_name' => uniqid('h_')
            );

            $inser_data = array_merge($post_data, $insert_data);
            if($this->Mvtour_comment->create($inser_data)){
                $this->return_success(array('hotspot_name' => $inser_data['hotspot_name']));
            }else{
                $this->return_failed('评论失败');
            }


        }
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
    
    /**
     * 查询所选场景的xml，把全景相关数据保存到对应表
     * @author chaokai@gz-zc.cn
     */
    private function check_xml($scene_ids, $id){
        $scene_str = '';
        $field = 'id,name,content,scene_name,scene_thumburl,preview_url,mobile_image,pc_image,view_fov,view_fovmax,view_fovmin,view_fovtype';
        $scene_list = $this->Mvtour_scene->get_lists($field, array('in' => array('id' => $scene_ids)));
        $scene = array();
        foreach ($scene_ids as $key => $value) {
            foreach ($scene_list as $k => $v) {
                if($v['id'] == $value){
                    $scene[$key] = $v;
                    break;
                }
            }
        }
        #修改场景
        //删除全景中原来场景
        $this->Mvtour_include_scene->delete(array('vtour_id' => $id));
        $scenes = array();
        foreach ($scene as $v){
            $scenes[] = array(
                'vtour_id' => $id,
                'name' => $v['scene_name'],
                'thumb_img' => $v['scene_thumburl'],
                'preview_img' => $v['preview_url'],
                'cube_pc_img' => $v['pc_image'],
                'cube_wap_img' => $v['mobile_image'],
                'scene_name' => $v['name'],
            );
        }
        $this->Mvtour_include_scene->create_batch($scenes);
        #修改场景参数配置
        //查询原来的场景
        $exist_scene = $this->Mvtour_view->get_lists('scene', array('vtour_id' => $id));
        if(!empty($exist_scene)){
            $exist_scene_ids = array_column($exist_scene, 'scene');
            $scene_names = array_column($scene, 'scene_name');
            //删除的场景
            $delete_scene_ids = array_diff($exist_scene_ids, $scene_names);
            !empty($delete_scene_ids) && $this->Mvtour_view->delete(array('in' => ['scene' => $delete_scene_ids]));
            //添加的场景
            $add_scene_ids = array_diff($scene_names, $exist_scene_ids);
            if(!empty($add_scene_ids)){

                $add_view = array();
                foreach ($scene as $key => $value) {
                    if(in_array($value['scene_name'], $add_scene_ids)){
                        $add_view[] = array(
                            'vtour_id' => $id,
                            'scene' => $value['scene_name'],
                            'fov' => $value['view_fov'],
                            'fovmax' => $value['view_fovmax'],
                            'fovmin' => $value['view_fovmin'],
                            'fovtype' => $value['view_fovtype'],
                        );
                    }
                }
                $this->Mvtour_view->create_batch($add_view);
            }

        }else{
            $view = array();
            foreach ($scene as $v){
                $view[] = array(
                    'vtour_id' => $id,
                    'scene' => $v['scene_name'],
                    'fov' => $v['view_fov'],
                    'fovmax' => $v['view_fovmax'],
                    'fovmin' => $v['view_fovmin'],
                    'fovtype' => $v['view_fovtype'],
                );

            }
            $this->Mvtour_view->create_batch($view);

        }

        
        
    }
    
    
    /**
     * 获取系统内置图标
     */
    private function get_default_ico(){
        $field = 'id,url,dynamic_url,is_default,is_dynamic,dynamic_param';
        $where = array('is_del' => 0);
        $list = $this->Mhotspot_ico->get_lists($field, $where);

        //热点类型 英文/数字转换
        // $type_list = array_column(C('hotspotico'), 'en_name', 'id');
        // $new_list = array();
        // foreach ($list as $key => $value) {
        //     $new_list[$type_list[$value['type']]][] = $value;
        // }

        return $list;

    }

    /**
     * 将图文类型的文章内容中的图片地址替换
     * @author chaokai@gz-zc.cn
     */
    private function trim_img_url(&$hotspot){
        foreach ($hotspot as $key => $value) {
            if($value['hotspot_type'] == 'article'){
                $hotspot[$key]['article_content'] = strip_content_domain_text($value['article_content']);
            }
        }
    }
}