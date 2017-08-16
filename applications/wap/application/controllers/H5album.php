<?php
use OSS\OssClient;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 手机端 相册详情
 * @author louhang@gz-zc.cn
 */
class H5album extends MY_Controller{
    
    private $appid, $appsecret;
    
    public function __construct(){
        parent::__construct();
        
        $this->appid = C('wechat_app.app_id.value');
        $this->appsecret = C('wechat_app.app_secret.value');
        $this->load->model(array(
                        'Model_template' => 'Mtemplate',
                        'Model_page' => 'Mpage',
                        'Model_user_template' => 'Muser_template',
                        'Model_elements' => 'Melements',
                        'Model_music' => 'Mmusic',
                        'Model_invit_element' => 'Minvit_element',
                        'Model_invit' => 'Minvit',
                        'Model_user_dinner' => 'Muser_dinner',
                        'Model_user' => 'Muser'
        ));
        
        $param = array(
            'app_id' => $this->appid,
            'app_secret' => $this->appsecret,
            'cache_dir' => APPPATH.'cache/'
        );
        $this->load->library('weixinjssdk', $param);

    }

    /**
     * H5相册 制作
     * @author louhang@gz-zc.cn
     * $status 0-电子相册 1-婚礼请帖
     */
    public function edit($status = 0, $id)
    {
        $data = $this->data;
        $data['status'] = $status;
        //获取 t_template.id
        
        //获取模板信息
        $template = $this->Mtemplate->get_one('*', array('id' => $id));
        if (! $template) {
            return false;
        }
        $data['template_id'] = $template['id'];
        
        //模板音乐获取
        $music = $this->Mmusic->get_one('*', array('is_del' => 0, 'id' => $template['music_id']));
        if ($music) {
            $data['music'] = $music['music'];
        } else {
            $data['music'] = 'defaultMusic.mp3';
        }
        
        //判断当前用户是否保存过该模板
        $user_template = $this->Muser_template->get_one('*', 
            array(
                'is_del' => 0, 
                'template_id' => $data['template_id'],
                'user_id' => $data['user_info']['id']
            )
        );


        if ($user_template) {
            $elements = JSON_decode($user_template['content'], true);
            foreach ($elements as $k => $v) {
                unset($elements[$k]);
                $elements[$k]['default'] = $v;
            }
            $data['elements'] = $elements;
        } else {
            //根据模板id 查找 该模板对应的页面
            $where = array(
                            'template_id' => $id,
                            'is_del' => 0
            );
            $pages = $this->Mpage->get_lists('id, sort', $where);
            
            //根据页面页面id 查找 该页面对应的元素
            $page_ids = $pages ? array_column($pages, 'id') : '';
            $where = array(
                            'is_del' => 0,
                            'in' => array('page_id' => $page_ids)
            );
            $elements = $this->Melements->get_lists('*', $where);
            
            //将$date['elements'] 的key 值构造成p1e1(第1页第1个元素), p3e5(第3页第5个元素)…… 样式
            $page_id_to_sort = $pages ? array_column($pages, 'sort', 'id') : '';
            foreach ($elements as $k => $v) {
                $elements[$k]['page_sort'] = isset($page_id_to_sort[$v['page_id']]) ? $page_id_to_sort[$v['page_id']] : 0;
                $page_sort = $elements[$k]['page_sort'];
                $element_sort = $elements[$k]['sort'];
                $data['elements']["p{$page_sort}e{$element_sort}"] = $elements[$k];
            }   
        }
        
        //微信图片上传, 配置参数
        $data['wxConfigJSON'] = json_encode($this->weixinjssdk->getSignPackage(), JSON_UNESCAPED_SLASHES);
        if($status == 0){
            $this->load->view('h5album/edit/'. $id, $data);
        }else{
            $this->load->view('h5album/card_edit/'. $id, $data);
        }
        
    }
    
    
    public function template_info($id){
        $data = $this->data;
        //获取模板信息
        $template = $this->Mtemplate->get_one('*', array('id' => $id));
        $data['template_id'] = $template['id'];
        //模板音乐获取
        $music = $this->Mmusic->get_one('*', array('is_del' => 0, 'id' => $template['music_id']));
        if ($music) {
            $data['music'] = $music['music'];
        } else {
            $data['music'] = 'defaultMusic.mp3';
        }
        
        
        $template = $this->Mtemplate->get_one('*', array('id' => $id));
        $data['template_id'] = $template['id'];
        
        //根据模板id 查找 该模板对应的页面
        $where = array(
            'template_id' => $id,
            'is_del' => 0
        );
        $order_by['sort'] = 'asc';
        $pages = $this->Mpage->get_lists('id, sort', $where, $order_by);
        
        //根据页面页面id 查找 该页面对应的元素
        $page_ids = $pages ? array_column($pages, 'id') : '';
        $data['page_ids'] = $page_ids;
        
        
        $where_element = array(
            'is_del' => 0,
            'in' => array('page_id' => $page_ids)
        );
        $field = 'id, page_id, element_type, default, sort';
        $elements = $this->Melements->get_lists($field, $where_element, $order_by);
        
        $tmp = array();
        foreach ($elements as $k=>$v){
            $tmp[$v['page_id']][] = $v;
        }
        
        $temp_arr = array();
        
        foreach ($page_ids as $k=>$v){
            if(isset($tmp[$v])){
                $temp_arr[$v] = $tmp[$v];
            }
        }
        $data['elements'] = $temp_arr;
        $data['attend_num'] = C('attendance.num');
        
        //微信图片上传, 配置参数
        $data['wxConfigJSON'] = json_encode($this->weixinjssdk->getSignPackage(), JSON_UNESCAPED_SLASHES);
        
        if($data['user_info']['id']){
            $data['is_edit'] = true;
        }else{
            $data['is_edit'] = false;
        }
        $this->load->view('h5album/template_info/'. $id, $data);
    }
    
    public function invit($id, $per_page = 0){
        $data = $this->data;
        if(!$id || !isset($data['user_info']['id']) || !$data['user_info']['id']){
            show_404();
        }
        $data['per_page'] = $per_page;
        //获取模板信息
        $template = $this->Mtemplate->get_one('*', array('id' => $id));
        $data['template_id'] = $template['id'];
        
        //模板音乐获取
        $music = $this->Mmusic->get_one('*', array('is_del' => 0, 'id' => $template['music_id']));
        if ($music) {
            $data['music'] = $music['music'];
        } else {
            $data['music'] = 'defaultMusic.mp3';
        }
        
        
        //根据模板id 查找 该模板对应的页面
        $where = array(
            'template_id' => $id,
            'is_del' => 0
        );
        $order_by['sort'] = 'asc';
        $pages = $this->Mpage->get_lists('id, sort', $where, $order_by);
        
        //根据页面页面id 查找 该页面对应的元素
        $page_ids = $pages ? array_column($pages, 'id') : '';
        $data['page_ids'] = $page_ids;
        //查询是否已经使用过该模板
        $result = $this->Minvit_element->get_one('*', array('template_id'=>$id, 'user_id'=>$data['user_info']['id'], 'is_del'=>0));
        
        if(!$result){
            $where = array(
                'is_del' => 0,
                'in' => array('page_id' => $page_ids)
            );
            $field = 'id, page_id, element_type, default, sort, flag';
            $elements = $this->Melements->get_lists($field, $where, $order_by);
            foreach ($elements as $k=>$v){
                $elements[$k]['template_id'] = $id;
                $elements[$k]['user_id'] = $data['user_info']['id'];
                unset($elements[$k]['id']);
            }
            //写入客户模板表
            if($elements){
                $insert_id = $this->Minvit_element->create_batch($elements);
            }
            
            
        }
        
        $new_where['user_id'] = $data['user_info']['id'];
        $new_where['template_id'] = $id;
        $new_where['is_del'] = 0;
        $new_elements = $this->Minvit_element->get_lists('*', $new_where, $order_by);
        
        $tmp = array();
        foreach ($new_elements as $k=>$v){
            $tmp[$v['page_id']][] = $v;
        }
        
        $temp_arr = array();
        
        foreach ($page_ids as $k=>$v){
            if(isset($tmp[$v])){
                $temp_arr[$v] = $tmp[$v];
            }
        }
        $data['elements'] = $temp_arr;
        
        //微信图片上传, 配置参数
        $data['wxConfigJSON'] = json_encode($this->weixinjssdk->getSignPackage(), JSON_UNESCAPED_SLASHES);
        
        //获取出席人数
        $data['attend_num'] = C('attendance.num');
        $this->load->view('h5album/card_edit/'. $id, $data);
    }
    
    public function show($template_id, $host_id){
        if(!$template_id || !$host_id){
            show_404();
        }
        $data = $this->data;
        $data['host_id'] = $host_id;
        $where['template_id'] = $template_id;
        $where['user_id'] = $host_id;
        $where['is_del'] = 0;
        $order_by['sort'] = 'asc';
        
        $elements = $this->Minvit_element->get_lists('*', $where, $order_by);
        $template_id = array_column($elements, 'template_id');
        $template_id = $template_id[0];
        
        //获取模板信息
        $template = $this->Mtemplate->get_one('*', array('id' => $template_id));
        $data['template_id'] = $template['id'];
        
        //模板音乐获取
        $music = $this->Mmusic->get_one('*', array('is_del' => 0, 'id' => $template['music_id']));
        if ($music) {
            $data['music'] = $music['music'];
        } else {
            $data['music'] = 'defaultMusic.mp3';
        }
        
        //根据模板id 查找 该模板对应的页面
        $page_where = array(
            'template_id' => $template_id,
            'is_del' => 0
        );
        $pages = $this->Mpage->get_lists('id, sort', $page_where, $order_by);
        
        //根据页面页面id 查找 该页面对应的元素
        $page_ids = $pages ? array_column($pages, 'id') : '';
        $data['page_ids'] = $page_ids;
        
        $tmp = array();
        foreach ($elements as $k=>$v){
            $tmp[$v['page_id']][] = $v;
        }
        
        $temp_arr = array();
        
        foreach ($page_ids as $k=>$v){
            if(isset($tmp[$v])){
                $temp_arr[$v] = $tmp[$v];
            }
        }
        $data['elements'] = $temp_arr;
        
        //获取出席人数
        $data['attend_num'] = C('attendance.num');
        //微信图片上传, 配置参数
        $data['wxConfigJSON'] = json_encode($this->weixinjssdk->getSignPackage(), JSON_UNESCAPED_SLASHES);
        $this->load->view('h5album/card_display/'. $template_id, $data);
        
    }
    
    public function save_bless($host_id){
        
        if(!intval($host_id)){
            $this->return_failed();
        }
        $data = $this->data;
        //模拟第三个用户发送祝福
        $post_data = $this->input->post();
        if($post_data){
            $post_data['create_time'] = date("Y-m-d H:i:s", time());
            $post_data['update_time'] = date("Y-m-d H:i:s", time());
            $post_data['user_id'] = $data['user_info']['id'];//当前登录用户
            $post_data['host_id'] = $host_id;
            $add = $this->Minvit->create($post_data);
            if($add){
                $this->return_success();
            }else{
                $this->return_failed();
            }
        }else{
            $this->return_failed();
        }
    }
    
    public function bless($host_id){
        $data = $this->data;
        if($data['user_info']['id'] == $host_id){
            $lists = $this->Minvit->get_lists('*', array('is_del'=>0, 'host_id'=>$host_id));
        }else{
            $lists = $this->Minvit->get_lists('*', array('is_del'=>0, 'user_id'=>$data['user_info']['id'], 'host_id'=>$host_id));
        }
        $data['lists'] = $lists;
        $user_id = array_unique(array_column($lists, 'user_id'));
        if($user_id){
            $field = 'id, nickname, realname, head_img';
            $where['in'] = array('id'=>$user_id);
            $user_info = $this->Muser->get_lists($field, $where);
            foreach ($user_info as $k=>$v){
                $user_info[$k]['name'] = isset($v['nickname']) ? $v['nickname']: $v['realname'];
            }
            
            $user = array();
            foreach ($user_info as $k=>$v){
                $user[$v['id']] = $v;
            }
            $data['user_info'] = $user;
            
        }
        
        //获取出席人数
        $data['attend_num'] = C('attendance.num');
        $this->load->view('h5album/bless_list', $data);
    }
    
    
    /**
     * 客人制作H5相册保存
     * @author louhang@gz-zc.cn
     */
    public function save_album()
    {
        $data = $this->data;
        $post_data = $this->input->post();
        
        //判断当前用户是否保存过该模板
        $user_template = $this->Muser_template->get_one('*',
            array(
                'is_del' => 0,
                'template_id' => (int)$post_data['template_id'],
                'user_id' => $data['user_info']['id']
            )
        );
        
        if ($user_template) {
            //修改模板
            $time = date('Y-m-d H:i:s');
            $add_data = array(
                            'user_id' => $data['user_info']['id'],
                            'name' => 'TO DO',
                            'template_id' => (int)$post_data['template_id'],
                            'content' => json_encode($post_data),
                            'create_time' => $time,
            );
            
            $ret = $this->Muser_template->update_info($add_data, array('id' => $user_template['id']));
            $user_template_id = $user_template['id'];
        } else {
            //新建模板
            $time = date('Y-m-d H:i:s');
            $add_data = array(
                            'user_id' => $data['user_info']['id'],
                            'name' => 'TO DO',
                            'template_id' => (int)$post_data['template_id'],
                            'content' => json_encode($post_data),
                            'create_time' => $time,
                            'update_time' =>$time
            );
            
            $ret = $this->Muser_template->create($add_data);
            $user_template_id = $ret;
        }
        
        
        if ($ret) {
            $this->return_success(['id' => $user_template_id], '保存成功');
        } else {
            $this->return_failed('保存失败，请刷新页面重试! ');
        }

    }
    
    
    public function page_edit($user_id, $template_id, $page_id, $per_page = 0){
        if(!$page_id || !$user_id || !$template_id){
            show_404();
        }
        $data = $this->data;
        $data['per_page'] = $per_page;
        $data['user_id'] = $data['user_info']['id'] ;
        $data['page_id'] = $page_id;
        $data['template_id'] = $template_id;
        
        $data['wxConfigJSON'] = json_encode($this->weixinjssdk->getSignPackage(), JSON_UNESCAPED_SLASHES);
        $order_by['sort'] = 'asc';
        
        $where = array(
            'template_id' => $template_id,
            'page_id' => $page_id,
            'user_id' =>$user_id,
            'is_del' =>0
        );
        $data['element'] = $this->Minvit_element->get_lists('*', $where, $order_by);
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if($post_data){
                //查询重复sort字段
                $arr1 = array_unique($post_data['sort']);
                $arr3 = array_diff_key($post_data['sort'],$arr1);
                $repeat = array_unique($arr3);
                if($repeat){
                    $this->return_failed("排序不能重复");
                }

                $tmp_arr = array();
                $i = 0;
                if(isset($post_data['head_img']) && $post_data['head_img']){
                    foreach ($post_data['head_img'] as $k=>$v){
                        $tmp_arr[$i]['page_id'] = $page_id;
                        $tmp_arr[$i]['element_type'] = 0;
                        $tmp_arr[$i]['default'] = $v;
                        $tmp_arr[$i]['sort'] = $k;
                        $tmp_arr[$i]['user_id'] = $user_id;
                        $tmp_arr[$i]['template_id'] = $template_id;
                        $i++;
                    }
                }
                if(isset($post_data['word']) && $post_data['word']){
                    foreach ($post_data['word'] as $k=>$v){
                        $tmp_arr[$i]['page_id'] = $page_id;
                        $tmp_arr[$i]['element_type'] = 1;
                        $tmp_arr[$i]['default'] = $v;
                        $tmp_arr[$i]['sort'] = $k;
                        $tmp_arr[$i]['user_id'] = $user_id;
                        $tmp_arr[$i]['flag'] = $post_data['flag'][$k];
                        $tmp_arr[$i]['template_id'] = $template_id;
                        $i++;
                    }
                }
                //删除原数据
                
                $del = $this->Minvit_element->delete(array('page_id'=>$page_id, 'template_id'=>$template_id, 'user_id'=>$user_id));
                
                if($del){
                    $add = $this->Minvit_element->create_batch($tmp_arr);
                }
                if(isset($add) && $add){
                    $this->return_success();
                }else{
                    $this->return_failed();
                }
            }
        }
        $this->load->view('h5album/page_edit', $data);
    }
    
    
    
    /**
     * H5相册 用户相册展示
     * @author louhang@gz-zc.cn
     */
    public function display()
    {
        $data = $this->data;
        
        //获取 t_user_template.id
        $id = (int)$this->input->get('id');
        
        //根据模板id 查找 模板页面
        $user_template = $this->Muser_template->get_one('*', array('id' => $id));
        
        //模板音乐获取
        $template = $this->Mtemplate->get_one('*', array('id' => $user_template['template_id']));
        $music = $this->Mmusic->get_one('*', array('is_del' => 0, 'id' => $template['music_id']));
        if ($music) {
            $data['music'] = $music['music'];
        } else {
            $data['music'] = 'defaultMusic.mp3';
        }
        
        //json数据 转为数组后注入模板
        $data['elements'] = json_decode($user_template['content'], true);

        //根据模板id 查找模板
        $id = $template['id'];
        
        $this->load->view("h5album/display/". $id, $data);
    }
    
    public function info($status=0){
        $status = intval($status);
        $data = $this->data;
        $where['is_del'] = 0;
        $where['type_id'] = $status;
        $lists = $this->Mtemplate->get_lists('*', $where);
        $data['status'] = $status;
        $data['lists'] = $lists;
        $data['kid_title'] = $status ? '婚礼请帖':'电子相册';
        $this->load->view('h5album/info', $data);
    }
    
     /**
     * 从微信服务器下载图片后转存到OSS
     * @author louhang@gz-zc.cn
     */
    public function downloadImgFromWx ()
    {
        $serverId = $this->input->get('serverId');
        $path = $this->weixinjssdk->wxDownImg($serverId);
        if (!$path) {
            $this->return_failed('发生错误!请刷新页面重试');
        }

        $this->save_to_oss(array('url' => $path));
        $this->return_success(array(
            'full_url' => get_img_url($path),
            'url' => $path,        
        ));

    }
    
    /**
     * 将图片上传到阿里云对象存储
     * @param $arr array 需要保存到oss的文件数组
     * @param $file_type string 文件类型，默认为图片
     * @author chaokai@gz-zc.cn
     */
    private function save_to_oss($arr, $file_type = 'image'){
        $this->load->file(BASEPATH.'../shared/libraries/aliyunoss/autoload.php');
        $access_key = C('aliyun.oss.access_key');
        $access_secret = C('aliyun.oss.access_secret');
        $endpoint = C('aliyun.oss.endpoint');
        $bucket = C('aliyun.oss.bucket');
    
        try {
            $ossclient = new OssClient($access_key, $access_secret, $endpoint, true);
        }catch (OssException $e){
            p($e->getMessage());
            log_message('ERROR', $e->getMessage());
        }
    
        foreach ($arr as $k => $v){
            $object = $file_type.'/'.$v;
            $file = C('upload.upload_dir').$file_type.'/'.$v;
            try{
                $ossclient->uploadFile($bucket, $object, $file);
                //删除本地文件
                unlink($file);
            }catch (OssException $e){
                log_message('ERROR', $e->getMessage());
            }
        }
    }

}