<?php
class Weixinjssdk {
  private $appId;
  private $appSecret;
  private $cacheDir;

  public function __construct($config) {
    $this->config   = $config;
   
    $this->appId    =  $this->config['app_id'];
    $this->appSecret    = $this->config['app_secret'];
    $this->cacheDir     = $this->config['cache_dir'];
    
  }

  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode(file_get_contents($this->cacheDir."jsapi_ticket.json"));
    if ($data->expire_time < time()) {
      $accessToken = $this->getAccessToken();
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));
      if($res->errcode != 0){
          $accessToken = $this->refresh_token();
          $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
          $res = json_decode($this->httpGet($url));
      }
      $ticket = $res->ticket;
      if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->jsapi_ticket = $ticket;
        $fp = fopen($this->cacheDir."/jsapi_ticket.json", "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $ticket = $data->jsapi_ticket;
    }

    return $ticket;
  }

  public function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode(file_get_contents($this->cacheDir."access_token.json"));
    if ($data->expire_time < time()) {
      // 如果是企业号用以下URL获取access_token
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
      $access_token = $this->refresh_token();
    } else {
      $access_token = $data->access_token;
    }
    return $access_token;
  }
  
  /**
   * 刷新acess_token
   * @param unknown $url
   */
  public function refresh_token(){
      
      $data = json_decode(file_get_contents($this->cacheDir."access_token.json"));
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
      $res = json_decode($this->httpGet($url));
       
      $access_token = $res->access_token;
      if ($access_token) {
          $data->expire_time = time() + $res->expires_in;
          $data->access_token = $access_token;
          $fp = fopen($this->cacheDir."access_token.json", "w");
          fwrite($fp, json_encode($data));
          fclose($fp);
      }
      return $access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    /*curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);*/
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }
  
  //从微信服务器端下载图片到本地服务器
  public function wxDownImg($media_id) {
      
      //调用 多媒体文件下载接口
      $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token={$this->getAccessToken()}&media_id=$media_id";
      //用curl请求，返回文件资源和curl句柄的信息
      $info = $this->curl_request($url);
      //文件类型
      $types = array('image/bmp'=>'.bmp', 'image/gif'=>'.gif', 'image/jpeg'=>'.jpg', 'image/png'=>'.png');
      //判断响应首部里的的content-type的值是否是这四种图片类型
      if (isset($types[$info['header']['content_type']])) {
          //文件的uri
          $file_ext = $types[$info['header']['content_type']];
      } else {
          return false;
      } 
      
      $file_dir = 'image';
      $date = date('Ymd');
      $dir = C('upload.upload_dir').$file_dir.'/'.$date;
      
      //如果目录不存在，则创建目录
      if (!is_dir($dir)) {
          mkdir($dir, 0777);
      }
       
      //新的文件名
      $new_file_name = md5(date("YmdHis").rand(10000, 99999)).$file_ext;
      
      //将资源写入文件里
      if ($this->saveFile($dir.'/'.$new_file_name, $info['body'])) {
          return $date.'/'.$new_file_name;
      }
  
      return false;

  }
  
  /**
   * curl请求资源
   * @param  string $url 请求url
   * @return array
   */
  private function curl_request($url = '') {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);    
        curl_setopt($ch, CURLOPT_NOBODY, 0);    //对body进行输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
       
        curl_close($ch);
        $media = array_merge(array('body' => $package), array('header' => $httpinfo));
        
        return $media;

  }
  
  /**
   * 将资源写入文件
   * @param  string 资源uri
   * @param  source 资源
   * @return boolean
   */
  private function saveFile($path, $fileContent) {
      $fp = fopen($path, 'w');
      if (false !== $fp) {
          if (false !== fwrite($fp, $fileContent)) {
              fclose($fp);
              return true;
          }
      }
      return false;
  }
}

