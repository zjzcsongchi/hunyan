<?php
/**
 * 生成全景图
 * @author chaokai@gz-zc.cn
 */
use OSS\OssClient;
use OSS\Core\OssException;
class Vtour extends MY_Controller {
    
    public function __construct(){
        
        parent::__construct();
        
        $this->load->model(array(
                        'Model_vtour' => 'Mvtour'
        ));
        
        $origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
        $allow_origin =  array_column(array_reverse($this->data['domain']),  'url');
        if(in_array($origin, $allow_origin)){
            header('Access-Control-Allow-Origin:'.$origin);
            header('Access-Control-Allow-Credentials:true');
            header('Access-Control-Allow-Headers: Content-Type,Accept,X-Requested-With,X_Requested_With');
        }
        
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
                $max_size = 1024 * 1024 * 50;
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
             
            //新的文件名
            $new_file_name = md5(date("YmdHis").rand(10000, 99999)).'.'.$file_ext;
             
            $result = rename($file_path, $dir.'/'.$new_file_name);                                       //把nginx上传的文件移动到自定义的目录
            if ($result == false)
            {
                unlink($file_path);
                $this->return_json(array('error' => 1, 'message' => '上传失败！'));
            }
    
            //上传到oss的图片数组
            $return_arr = array(
                            'url' => $date.'/'.$new_file_name
            );
            $this->save_to_oss($return_arr, $file_dir);
            $this->return_json(array_merge(array('error' => 0, 'full_url' => $this->data['domain']['img']['url'].'/'.$file_dir.'/'.$date.'/'.$new_file_name ), $return_arr));
        }else
        {
            $this->return_json(array('error' => 1, 'message' => '上传失败！'));
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
            }catch (OssException $e){
                log_message('ERROR', $e->getMessage());
            }
        }
    }
    
    
}