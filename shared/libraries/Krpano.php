<?php
/**
 * krpano操作类
 * @author chaokai@gz-zc.cn
 */
class Krpano {
    
    private static $_instance = null;
    
    /**
     * 文件保存路径
     * @var unknown
     */
    private $upload_dir;
    
    private function __construct(){
        
        $this->upload_dir = C('upload.upload_dir');
    }
    
    /**
     * 防止用户克隆实例
     */
    public function __clone(){
        die('Clone is not allowed.' . E_USER_ERROR);
    }
    
    public static function get_instance(){
        if(is_null(self::$_instance)){
            self::$_instance = new Krpano();
        }
        
        return self::$_instance;
    }
    
    /**
     * 制作全景图
     * @author chaokai@gz-zc.cn
     */
    public function to_vtour($file_path){
        
        try {
            //图片文件夹名称
            $crop_name = md5(date('YmdHis').get_code());
            $upload_dir = substr($this->upload_dir.'image/'.$file_path, 0, -4);
            $date_folder = date('YmdHis');
            $config_param = <<<EOT
-panotype=sphere -tilepath=$upload_dir/pano[_c].jpg -previewpath=$upload_dir/preview.jpg -customimage[mobile].path=$upload_dir/mobile/pano_%s.jpg -xmlpath={$this->upload_dir}image/$crop_name.xml -thumbpath=$upload_dir/thumb.jpg
EOT;
            $return_arr = [];
            $return_val = '';
            exec('/data/krpano/krpanotools makepano -config=/data/krpano/templates/vtour-normal.config '.$config_param.' '.$this->upload_dir.'image/'.$file_path, $return_arr, $return_val);
            if($return_val !== 0){
                throw new Exception(json_encode($return_arr));
            }else{
                return array(
                                'vtour_path' => $upload_dir,
                                'xml_path' => $this->upload_dir.'image/'.$crop_name.'.xml'
                );
            }
        }catch (Exception $e){
            log_message('ERROR', $e->getMessage());
            return $upload_dir;
        }
    }
}