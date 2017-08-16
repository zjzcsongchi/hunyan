<?php
use OSS\OssClient;
use OSS\Core\OssException;
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 公共文件上传服务接口
 * 
 * @author jianming@gz-zc.cn
 *
 */
class File extends MY_Controller{

    public function __construct(){
            parent::__construct();
            //ajax 文件上传判断来源请求 设置跨域
            $origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
            $allow_origin =  array_column(array_reverse($this->data['domain']),  'url');
            if(in_array($origin, $allow_origin)){
                header('Access-Control-Allow-Origin:'.$origin);
                header('Access-Control-Allow-Credentials:true');
                header('Access-Control-Allow-Headers: Content-Type,Accept,X-Requested-With,X_Requested_With');  
            }
            
            $this->avatar_config = C('avatar');
    }

    
    
    /**
     * 指定上传文件的服务器端程序
     */
    public function upload_php(){
        $file_dir = $this->input->post('type') == 'image' ? 'image/' : 'video/';
        $config = array(
            'upload_path'   => '../../uploads/'.$file_dir,
            'allowed_types' => 'gif|jpg|jpeg|png|bmp|swf|flv|doc|docx|xls|xlsx|ppt|mp4',
//             'max_size'     => 1024*20,
            'max_width'    => 2000,
            'max_height'   => 2000,
            'encrypt_name' => TRUE,
            'remove_spaces'=> TRUE,
            'use_time_dir'  => TRUE,      //是否按上传时间分目录存放
            'time_method_by_day'=> TRUE, //分目录存放的方式：按天
        );
        if($file_dir == 'video/'){
            $config['max_size'] = 1024*50;
        }else{
            $config['max_size'] = 1024*2;
        }
        
        $this->load->library('upload', $config);
         
        if ( ! $this->upload->do_upload('Filedata')){
            $error = $this->upload->display_errors();
            echo json_encode(array('error' => 1, 'message' => '上传错误！'.$error));
        } else {
            $data = $this->upload->data();
            echo json_encode(array('error' => 0, 'url' => $data['file_name'],'full_url' => $this->data['domain']['img']['url'].'/'.$file_dir.'/'.$data['file_name']));
        }
        exit();
    }
    
    
    
    /**
     * 处理nginx upload module上传成功后返回的文件数据
     * 
     * @author jianming@gz-zc.cn
     */
    public function upload(){
            $file_path = $_POST['file_path'];
        	if (is_file($file_path)) 
        	{
        	    $file_dir = $this->input->post('type');
        	    $is_editor = $this->input->post('source') == 'editor' ? true : false;
    			//上传的文件夹
    			$folder =  C('upload.folder');
    			
    			if (! in_array($file_dir, $folder)) {
    			    if($is_editor) {
    			        die('error|上传参数错误');
    			    }
    				$this->return_json(array('error' => 1, 'message' => "上传参数错误！"));
    			}
    
        		//允许上传的文件扩展名字典
    			$ext_arr =  array_merge(C('upload.ext.img') ,C('upload.ext.other'), C('upload.ext.video'));
    			
    			//获得文件扩展名
    			$temp_arr = explode(".", $_POST['file_name']);
    			$file_ext = strtolower(trim(array_pop($temp_arr)));
    
    			//如果扩展名不在允许上传的扩展名内，则从服务器删掉该文件
    			if (!in_array('.'.$file_ext, $ext_arr)) {
    				unlink($file_path);
    				$is_editor && die('error|不允许上传的文件类型');
    				$this->return_json(array('error' => 1, 'message' => "不允许上传的文件类型！"));
    			}
    			
    			//如果文件超过限制大小，则从服务器删除该文件
    			if($file_dir == 'image'){
    			    $max_size = 1024 * 1024 * 10;
    			}else if($file_dir == 'video'){
    			    $max_size = 1024 * 1024 * 100;
    			}
    			if($max_size < $this->input->post('file_size')){
    			    unlink($file_path);
    			    $is_editor && die('error|文件大小超过限制');
    			    $this->return_json(array('error' => 1, 'message' => '文件大小超过限制'));
    			}
    
    			$src = $file_path;
    			
    			$date = date('Ymd');
    			$dir = C('upload.upload_dir').'/'.$file_dir.'/'.$date;
    			
    			//如果目录不存在，则创建目录
    			if (!is_dir($dir))
    			{
    			    mkdir($dir, 0777);
    			}
    			
			    //新的文件名
			    $new_file_name = md5(date("YmdHis").rand(10000, 99999)).'.'.$file_ext;
			    
			    $result = rename($file_path, $dir.'/'.$new_file_name);                                       //把nginx上传的文件移动到自定义的目录
			    if ($result == false)
			    {
			        unlink($file_path);
			        $is_editor && die('error|上传失败');
			        $this->return_json(array('error' => 1, 'message' => '上传失败！'));
			    }
			    	
                //上传到oss的图片数组
                $return_arr = array(
                                'url' => $date.'/'.$new_file_name
                );
                $this->save_to_oss($return_arr, $file_dir);
			    $is_editor && die($this->data['domain']['img']['url'].'/'.$file_dir.'/'.$date.'/'.$new_file_name);
			    $this->return_json(array_merge(array('error' => 0, 'full_url' => $this->data['domain']['img']['url'].'/'.$file_dir.'/'.$date.'/'.$new_file_name ), $return_arr));
    			}
    			
    			
    		else 
    		{
    			$this->return_json(array('error' => 1, 'message' => '上传失败！'));
    		}
    }
    
    
    
    /**
     * 处理nginx upload module上传成功后返回的文件数据 水印处理
     *
     * @author songchi@gz-zc.cn
     */
    public function upload_shuiyin($direction = 0){
        $this->load->library('thumb');
        $file_path = $_POST['file_path'];
        if (is_file($file_path))
        {
            $file_dir = $this->input->post('type');
            //上传的文件夹
            $folder =  C('upload.folder');
             
            if (! in_array($file_dir, $folder)) {
                $this->return_json(array('error' => 1, 'message' => "上传参数错误！"));
            }
    
            //允许上传的文件扩展名字典
            $ext_arr =  array_merge(C('upload.ext.img') ,C('upload.ext.other'), C('upload.ext.video'));
             
            //获得文件扩展名
            $temp_arr = explode(".", $_POST['file_name']);
            $file_ext = strtolower(trim(array_pop($temp_arr)));
    
            //如果扩展名不在允许上传的扩展名内，则从服务器删掉该文件
            if (!in_array('.'.$file_ext, $ext_arr)) {
                unlink($file_path);
                $this->return_json(array('error' => 1, 'message' => "不允许上传的文件类型！"));
            }
             
            //如果文件超过限制大小，则从服务器删除该文件
            if($file_dir == 'image'){
                $max_size = 1024 * 1024 * 10;
            }else if($file_dir == 'video'){
                $max_size = 1024 * 1024 * 50;
            }
            if($max_size < $this->input->post('file_size')){
                unlink($file_path);
                $this->return_json(array('error' => 1, 'message' => '文件大小超过限制'));
            }
    
            $src = $file_path;
             
            $date = date('Ymd');
            $dir = C('upload.upload_dir').'/'.$file_dir.'/'.$date;
             
            //如果目录不存在，则创建目录
            if (!is_dir($dir))
            {
                mkdir($dir, 0777);
            }
             
            //如果是图片
            if($file_dir == 'image'){
                	
                //新的文件名
                $new_file_name = md5(date("YmdHis").rand(10000, 99999)).'.'.$file_ext;
                	
                $depart = explode('.', $new_file_name);
                //把nginx上传的文件移动到自定义的目录
                $result = rename($file_path, $dir.'/'.$new_file_name);  
                /*CI自带的生成缩略图方法
                $config['image_library'] = 'gd2';
                $config['source_image'] = $dir.'/'.$new_file_name;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 1000;
                $config['height']   = 800;
                $this->load->library('image_lib', $config);
                
                $this->image_lib->resize();
                $this->image_lib->clear();
                */
                if ($result == false)
                {
                    unlink($file_path);
                    $this->return_json(array('error' => 1, 'message' => '上传失败！'));
                }
                
                $new_img_path = $dir.'/'.$new_file_name;
                
                //图片压缩
                $new_file_name_ys = md5(date("YmdHis").rand(10000, 99999));
                
                //上传的图片宽度和高度都小于规定生成的图片尺寸则不压缩
                $resize_flag = 1;
                $pic_width = getimagesize($new_img_path)[0];
                $pic_height = getimagesize($new_img_path)[1];
                if($pic_width<1000 && $pic_height<800){
                    $resize_flag == 0;
                }
                if($resize_flag == 1){
                    $new_img_name = $this->thumb->resizeimg($new_img_path, 1000, 800, $new_file_name_ys);
                    rename($new_img_name, $dir.'/'.$new_img_name); //移动资源到指定目录下
                    
                    //图片水印
                    if($direction == 1){
                        $water_img = BASEPATH.'../static/www/images/shuiyin1.png';
                    }else{
                        $water_img = BASEPATH.'../static/www/images/shuiyin.png';
                    }
                    $new_file_name_sy = md5(date("YmdHis").rand(10000, 99999));
                    
                    
                    $sy_img_url = $this->thumb->shuiyin($dir.'/'.$new_img_name, $new_file_name_sy, $water_img, $direction); //压缩加水印
                    $sy_img_name = rename($sy_img_url, $dir.'/'.$sy_img_url); //移动资源到指定目录下
                    
                    //原图加水印
                    $yt_sy_file_name = md5(date("YmdHis").rand(10000, 99999));
                    $yt_sy_url = $this->thumb->shuiyin($new_img_path, $yt_sy_file_name, $water_img, $direction); //原图加水印
                    $yt_sy_name = rename($yt_sy_url, $dir.'/'.$yt_sy_url); //移动资源到指定目录下
                }
                //需要上传到oss的文件
                $return_arr = array(
                                'url' => $date.'/'.$new_file_name,
                                'ys_url'=>$date.'/'.$new_img_name, 
                                'sy_url'=>$date.'/'.$sy_img_url,
                                'yt_sy'=>$date.'/'.$yt_sy_url
                );
                //保存到oss
                $this->save_to_oss($return_arr);
                $this->return_json(array_merge(array('error' => 0, 'full_url' => $this->data['domain']['img']['url'].'/'.$file_dir.'/'.$date.'/'.$new_file_name, 'yt_sy'=>$date.'/'.$yt_sy_url), $return_arr));
                	
            }else{
                //新的文件名
                $new_file_name = md5(date("YmdHis").rand(10000, 99999)).'.'.$file_ext;
                	
                $result = rename($file_path, $dir.'/'.$new_file_name);                                       //把nginx上传的文件移动到自定义的目录
                if ($result == false)
                {
                    unlink($file_path);
                    $this->return_json(array('error' => 1, 'message' => '上传失败！'));
                }
                //需要上传到oss的文件
                $return_arr = array(
                                'url' => $date.'/'.$new_file_name
                );
                //保存到oss
                $this->save_to_oss($return_arr);
    
                $this->return_json(array_merge(array('error' => 0,  'full_url' => $this->data['domain']['img']['url'].'/'.$file_dir.'/'.$date.'/'.$new_file_name ), $return_arr));
            }
             
             
        }
        else
        {
            $this->return_json(array('error' => 1, 'message' => '上传失败！'));
        }
    }
    
    
    /**
     * 头像上传
     */
    public function set_portrait(){
        $portrait_config = C('upload.portraint');
        $portrait = upload_file('portrait',  $portrait_config);
        if ($portrait['flag']){
            $save_data['portrait'] = $portrait['data']['file_name'];
            list($width, $height) = getimagesize($this->avatar_config['path']. $save_data['portrait']);
            if ($width > $this->avatar_config['resize']['width'] || $height >$this->avatar_config['resize']['height']){
                //压缩到裁剪框制定大小(600x300)
                $this->load->library('image_lib');
                $config['image_library'] = $this->avatar_config['image_library'];
                $config['quality'] = $this->avatar_config['quality'];
                $config['source_image'] = $this->avatar_config['path']. $save_data['portrait'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] =  $this->avatar_config['resize']['width'];
                $config['height'] = $this->avatar_config['resize']['height'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
            }
            list($width, $height) = getimagesize($this->avatar_config['path']. $save_data['portrait']);
            $this->return_json(array('status'=>0,'width'=> $width,'height'=>$height,'url'=> $this->data['domain']['img']['url'] .'/portrait/'.$portrait['data']['file_name']));
        }else{
            $this->return_json(array('status'=>1,'width'=> 0,'height'=>0,'url'=>'','msg'=>'图片只能是：'.$portrait_config['allowed_types'].'类型,大小不能超过：'.$portrait_config['max_size'].'kb，宽高不能超过:'.$portrait_config['max_width'].'X'.$portrait_config['max_height']));
        }
    }
    
    
    /**
     * 头像裁剪
     */
    public function cut_img(){
        $x = (int) $this->input->post('x');
        $y = (int) $this->input->post('y');
        $w = (int) $this->input->post('w');
        $h = (int) $this->input->post('h');
        $img_url = $this->input->post('img_url');
        if (empty($img_url) || ! $w){
            $this->return_json("参数错误");
        }
    
        $this->load->library('image_lib');
        $file_name = substr($img_url, strpos($img_url, "/portrait")+9);
        $url = '/uploads/'.substr($img_url, strpos($img_url, '/portrait'));
        $source_file = $this->avatar_config['path'].$file_name;
    
        list($width, $height) = getimagesize($source_file);
        if ($width > $w || $height > $h){
            $config['image_library'] = $this->avatar_config['image_library'];
            $config['quality'] = $this->avatar_config['quality'];
            $config['source_image'] = $source_file;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = $w ;
            $config['height'] = $h ;
            $config['x_axis'] = $x;
            $config['y_axis'] = $y;
    
            $this->image_lib->initialize($config);
    
            $this->image_lib->crop();
        }
    
        $this->return_json(array('status'=>0,'url'=> $url, 'full_url' => get_portrait_url($file_name), 'msg'=>'保存成功'));
    }
    
    
    /**
     * ueditor 配置项
     */
    public function config() {
        $config_arr = array(
                        /* 上传图片配置项 */
                        "imageActionName" => "file/ueditor_upload",
                        "imageFieldName" => "upfile", /* 提交的图片表单名称 */
                        "imageAllowFiles" => C('upload.ext.img'),
    
                        /* 上传文件配置 */
                        "fileActionName" => "file/ueditor_upload",
                        "fileFieldName" => "upfile", /* 提交的文件表单名称 */
                        "fileAllowFiles" =>  array_merge(C('upload.ext.img') ,C('upload.ext.other'))
        );
        $config_json = json_encode($config_arr);
        if (preg_match("/^[\w_]+$/", $_GET["callback"]))
        {
            echo htmlspecialchars($_GET["callback"]).'('.$config_json.')';
        }
        else
        {
            echo $config_json;
        }
        exit();
    }
    
    /**
     * ueditor 文件上传
     */
    public function ueditor_upload() {
        $ue_config = C('upload.ue_config');
        $upfile = upload_file('upfile',  $ue_config);
        if ($upfile['flag'])
        {
            $this->return_json(array('state'=>'SUCCESS','url'=> $this->data['domain']['img']['url'] .'/image/'.$upfile['data']['file_name']));
        }
        else
        {
            $this->return_json(array('state'=>strip_tags($upfile['data']),'url'=>''));
        }
    }
    
    /**
     * 将图片上传到阿里云对象存储
     * @param $arr array 需要保存到oss的文件数组
     * @param $file_type string 文件类型，默认为图片
     * @author chaokai@gz-zc.cn
     */
    private function save_to_oss($arr, $file_type = 'image'){
        if(ENVIRONMENT == 'development'){
            return true;
        }
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
