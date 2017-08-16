<?php
use OSS\OssClient;
use OSS\Core\OssException;
use OSS\Model\CorsConfig;
use OSS\Model\CorsRule;
/**
 * 把硬盘中的图片上传到oss
 * @author chaokai@gz-zc.cn
 */
require_once(BASEPATH.'../shared/libraries/aliyunoss/autoload.php');
class Oss extends MY_Controller{
    
    private $ossclient;
    public function __construct(){
        
        parent::__construct();
        
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
     * 上传文件夹到oss
     * @param unknown $folder
     * @author chaokai@gz-zc.cn
     */
    public function upload($folder){
        $bucket = C('aliyun.oss.bucket');
        $file_path = C('upload.upload_dir').$folder;
        echo "上传中...\n";
        try {
            $this->ossclient->uploadDir($bucket, $folder, $file_path, '', true);
        }  catch(OssException $e) {
            echo $e->getMessage() . "\n";
        }
        
        echo "success\n";
    }
    
    /**
     * 设置bucket的cors配置
     *
     * @param OssClient $ossClient OSSClient实例
     * @param string    $bucket 存储空间名称
     * @return null
     */
    function putBucketCors()
    {
        $bucket = C('aliyun.oss.bucket');
        $corsConfig = new CorsConfig();
        $rule = new CorsRule();
        $rule->addAllowedOrigin("http://admin.dev.bai-nian.com");
        $rule->addAllowedMethod("POST");
        $rule->setMaxAgeSeconds(10);
        $corsConfig->addRule($rule);
        try{
            $this->ossclient->putBucketCors($bucket, $corsConfig);
        } catch(OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
        print(__FUNCTION__ . ": OK" . "\n");
    }
    
    /**
     * 获取并打印bucket的cors配置
     *
     * @param OssClient $ossClient OSSClient实例
     * @param string    $bucket bucket名字
     * @return null
     */
    function getBucketCors()
    {
        $bucket = C('aliyun.oss.bucket');
        $corsConfig = new CorsConfig();
        $corsConfig = null;
        try{
            $corsConfig = $this->ossclient->getBucketCors($bucket);
        } catch(OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
        print(__FUNCTION__ . ": OK" . "\n");
        print($corsConfig->serializeToXml() . "\n");
    }
}