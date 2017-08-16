<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cookie 加密
 */
if ( ! function_exists('encrypt')) {
	function encrypt($array = array()){
		$info = base64_encode(json_encode($array));
		$num = ceil(strlen($info)/1.5);
		$key1 = substr($info,0,$num);
		$result = strtr($info,array($key1=>strrev($key1)));
		$key2 = substr($result, -$num,$num-2);
		$result = strtr($result,array($key2=>strrev($key2)));
		return $result;
	}
}

/**
 * Cookie 解密
 */
if ( ! function_exists('decrypt')) {
	function decrypt($str = ''){
		$num = ceil(strlen($str)/1.5);
		$key2 = substr($str, -$num,$num-2);
		$str = strtr($str,array($key2=>strrev($key2)));
		$key1 = substr($str,0,$num);
		$result = strtr($str,array($key1=>strrev($key1)));
		$info = json_decode(base64_decode($result),true);
		return $info;
	}
}


/**
 *发送短信
 */
if ( ! function_exists('send_msg')) {
    function send_msg($tel, $template_name, $msg = ''){
        if (empty($tel) || empty($msg)){
            return false;
        }
        $CI=&get_instance();
        $CI->load->library('sms', array(C("sms")));
        if (is_array($tel)){
            $tel = implode(',', $tel);
        }
        
        if (is_array($msg)){
            $msg = json_encode($msg);
        }
        
        try {
            return $CI->sms->send_sms_alidayu($tel, $template_name, $msg);
        }catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }

}



/**
 *旧版本发送短信
 */
if ( ! function_exists('send_msg_huaxing')) {
    function send_msg_huaxing($tel, $msg = ''){
        if (empty($tel) || empty($msg)){
            return false;
        }
        $CI=&get_instance();
        $CI->load->library('sms', array(C("sms")));
        if (is_array($tel)){
            $tel = implode(',', $tel);
        }

        try {
            return $CI->sms->send_sms_huaxing($tel, $msg,'');
        }catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }

}


/**
 * 获取随机数
 */
if (! function_exists('get_code')){
    function get_code(){
        return  rand(100000, 999999);
    }
}


/**
 * 更复杂的获取随机数
 */
if (! function_exists('get_complex_code')){
    function  get_complex_code($length = 6){
        $str = '';
        $pa = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        for($i=0; $i<$length; $i++){
             $str .= $pa{mt_rand(0,35)};
        }
        return $str;
     }
}


/**
 * 图片上传
 * @param string $file_name
 */
if (! function_exists('upload_file')){
    function upload_file($file_name, $config=''){
        $return_msg = array();
        $CI=&get_instance();
        $CI->load->library('upload', $config);
        if ( ! $CI->upload->do_upload($file_name)){
            $return_msg['flag'] = FALSE;
            $return_msg['data'] = $CI->upload->display_errors();
        }else{
            $return_msg['flag'] = TRUE;
            $return_msg['data'] = $CI->upload->data();
        }
        return $return_msg;
    }
}


/**
 * 获取加密用户密码
 *
 * @param string $file_name
 */
if (! function_exists('get_encode_pwd')){
    function get_encode_pwd($password){
        if (empty($password)){
            return FALSE;
        }
        $password = md5(strtolower($password));
        return $password;
    }
}


/**
 * 将二维数组中的第一维转换为和某个第二维字段值关联
 */
if (! function_exists('change_arr_key_by_somekey')){
    function change_arr_key_by_somekey($arr = array(), $somekey){
        $arr_somekey = array();
        if ($arr){
            foreach ($arr as $key=>$v){
                $arr_somekey[$v[$somekey]] = $v;
            }
        }
        return $arr_somekey;
    }


}

/**
 * 显示图片优化函数
 */
if (! function_exists('optim_image')){
    function optim_image($img_full_url = '', $size = array(0, 0), $type = '', $watermark = FALSE){
        
        //地址为空 或者优化配置关闭直接返回 
        if ($img_full_url == '' || !C('images_optim.optim')){
            return $img_full_url;
        } 
        
        $extension =  substr($img_full_url, strrpos($img_full_url, '.'));
        
        $replace_str = '_t';
        if ($type){
            $replace_str .= $type;
        }
        if ($watermark){
            $replace_str .= '_w';
        }
        if ($size[0] && $size[1]){
            $replace_str .= '_s'.$size[0] . 'x' . $size[1];
        }
        
        $img_full_url = str_replace($extension, $replace_str . $extension,  $img_full_url);
        
        return $img_full_url;
    }
   
}
  
/**
 * nengfu@gz-zc.cn
 * 操作日志
 * @param string $id 操作人ID
 * @param string $info 操作信息
 * @return void
 */
function operate_log($id , $info = ""){
    $CI = get_instance();
    $data = array(
        "operate_id" => $id,
        "operate_content" => $info,
        "create_time" => time()
    );
    $CI->db->insert("t_operate_log",$data);
  
}




    
/**
 * 获取随机奖品
 *
 * @param array $data  奖品数据
 *
 * @return number  中奖奖项
 */
if (! function_exists('get_rand')){
    function get_rand($data) {
        $result = '';
        $pro_sum = array_sum($data);
        foreach ($data as $key => $pro_cur) {
            $rand_num = mt_rand(1, $pro_sum);
            if ($rand_num <= $pro_cur) {
                $result = $key;
                break;
            } else {
                $pro_sum -= $pro_cur;
            }
        }
        unset ($data);
        return $result;
    }
}

/**
 * 是否移动设备访问
 * @author yuanxiaolin@global28.com
 * @return boolean
 * @ruturn boolean
 */
if(!function_exists('ismobile')){
    function ismobile() {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
            return true;

        //此条摘自TPM智能切换模板引擎，适合TPM开发
        if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
            return true;
        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
            //找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
        //判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
            );
            //从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        //协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }
}


/**
 *  删除非站内链接
 *
 * @access    public
 * @param     string  $body  内容
 * @param     array  $allow_urls  允许的超链接
 * @return    string
 */
if(!function_exists('replace_links')){
    function replace_links($body, $allow_urls=array('global28.com')){
        $host_rule = join('|', $allow_urls);
        $host_rule = preg_replace("#[\n\r]#", '', $host_rule);
        $host_rule = str_replace('.', "\\.", $host_rule);
        $host_rule = str_replace('/', "\\/", $host_rule);
        $arr = '';
        preg_match_all("#<a([^>]*)>(.*)<\/a>#iU", $body, $arr);
        if( is_array($arr[0]) )
        {
            $rparr = array();
            $tgarr = array();
            foreach($arr[0] as $i=>$v)
            {
                if( $host_rule != '' && preg_match('#'.$host_rule.'#i', $arr[1][$i]) )
                {
                    continue;
                } else {
                    $rparr[] = $v;
                    $tgarr[] = $arr[2][$i];
                }
            }
            if( !empty($rparr) )
            {
                $body = str_replace($rparr, $tgarr, $body);
            }
        }
        return $body;
    }
}
/**
 * 获取客户端ip
 *
 */
if(!function_exists('get_client_ip')){
    function get_client_ip($type = 0) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
}

/**
 * URL重定向
 * @param string $url 重定向的URL地址
 * @param integer $time 重定向的等待时间（秒）
 * @param string $msg 重定向前的提示信息
 * @return void
 */
if(!function_exists('tp_redirect')){
    function tp_redirect($url, $time=0, $msg='') {
        //多行URL地址支持
        $url        = str_replace(array("\n", "\r"), '', $url);
        if (empty($msg))
            $msg    = "系统将在{$time}秒之后自动跳转到{$url}！";
        if (!headers_sent()) {
            // redirect
            if (0 === $time) {
                header('Location: ' . $url);
            } else {
                header("refresh:{$time};url={$url}");
                echo($msg);
            }
            exit();
        } else {
            $str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
            if ($time != 0)
                $str .= $msg;
            exit($str);
        }
    }
}


/**
 *递归处理数组（将子分类与上级分类合并）
 *
 *@param string $data
 *@param string $parent
 *@param int page_number
 *@return array
 */
if(!function_exists('class_loop')){
    function class_loop($data,$parent=0){

        $result = array();
        if($data)
        {
            foreach($data as $key=>$val)
            {
                if($val['parent_id']==$parent)
                {
                    $temp = class_loop($data,$val['id']);
                    if($temp) $val['child'] = $temp;
                    $result[] = $val;
                }
            }
        }
        return $result;
    }
}

/**
 *递归处理数组（将子分类与上级分类合并）
 *
 *@param string $data
 *@param string $parent
 *@param int page_number
 *@return array
 */
if(!function_exists('class_loop_list')) {
    function class_loop_list($data, $level = 0)
    {

        $level++;
        $result = array();
        if ($data) {
            foreach ($data as $v) {
                $v['level'] = $level;
                $child = array();
                if (!empty($v['child'])) {
                    $child = $v['child'];
                }
                unset($v['child']);
                $result[] = $v;
                if (!empty($child)) {
                    $result = array_merge($result, class_loop_list($child, $level));
                }
            }
        }
        return $result;
    }
}

/**
 *根据身份证号计算年龄
 *
 *@param string $birthday
 *@return int
 */
if(!function_exists('get_age_by_ID')) {
    function get_age_by_ID($ID){ 
        if(empty($ID)) return ''; 
        $date = strtotime(substr($ID, 6, 8));
        $today = strtotime('today');
        $diff = floor(($today-$date)/86400/365);
        $age = strtotime(substr($ID, 6, 8).' +'.$diff.'years') > $today ? ($diff + 1) : $diff; 
        return $age; 
    }
}
    

/**
 *身份证验证
 *
 *@param string $idcard
 *@return bool
 */
if(!function_exists('checkIdCard')) {
     function checkIdCard($idcard){
    
        // 只能是18位
        if(strlen($idcard)!=18){
            return false;
        }
    
        // 取出本体码
        $idcard_base = substr($idcard, 0, 17);
    
        // 取出校验码
        $verify_code = substr($idcard, 17, 1);
    
        // 加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
    
        // 校验码对应值
        $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
    
        // 根据前17位计算校验码
        $total = 0;
        for($i=0; $i<17; $i++){
            $total += substr($idcard_base, $i, 1)*$factor[$i];
        }
    
        // 取模
        $mod = $total % 11;
    
        // 比较校验码
        if($verify_code == $verify_code_list[$mod]){
            return true;
        }else{
            return false;
        }
    
    }   
    
}

/**
 * 根据阳历获取阴历
 * @param [String | Array] 
 *
 * @return String  阴历日期
 */
if ( ! function_exists('solar_to_lunar')) {
    function solar_to_lunar($solar_time = ''){
        if(!is_array($solar_time)){
            $solar_time = explode('-', $solar_time);
        }else{
            $solar_time[0] = isset($solar_time['year']) ? $solar_time['year'] : $solar_time[0];
            $solar_time[1] = isset($solar_time['month']) ? $solar_time['month'] : $solar_time[1];
            $solar_time[2] = isset($solar_time['day']) ? $solar_time['day'] : $solar_time[2];
        }
        
        $year  = intval($solar_time[0]);
        $month = intval($solar_time[1]);
        $day   = intval($solar_time[2]);
        #不再使用聚合数据查询农历接口
//         $key = '41fe4bbde8923e3a9e302581207abcb8';
//         $param = array(
//                         'date' => $year.'-'.$month.'-'.$day,
//                         'key' => $key
//         );
        
//         $url = 'http://v.juhe.cn/calendar/day';
        
//         $result = Http::Request($url, $param);
        
//         $result = json_decode($result, true);
//         if($result['error_code'] != 0){
//             return false;
//         }

        $ci = &get_instance();
        $ci->load->library('mycalendar');
        $result = $ci->mycalendar->Cal($year, $month, $day);
        
//         $result_data['week'] = $result['result']['data']['weekday'];
//         $result_data['lunar_time'] = $result['result']['data']['lunar'];
        
        $length = mb_strlen($result['month']);
        $month_pos = mb_strpos($result['month'], '月');
        $month = mb_substr($result['month'], 0, $month_pos);
        $day = $result['day'];
        //星期
        $week = array('日', '一', '二', '三', '四', '五', '六');
        $result_data['week'] = '星期'.$week[$result['week']];
        
        $date_arr = C('date.date');
        $month = $date_arr[$month];
        $day = $date_arr[$day];
        
        $result_data['lunar_time'] = $month.'月'.$day.'日';
        
        return $result_data;
    }
    
    /**
     * 格式化打印
     */
    if ( ! function_exists('p')) {
        function p($data = '', $is_pause = true){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            if ($is_pause) {
                exit;
            }
        }
    }
    

    /**
     *生成订单编号
     *@return string
     */
    if(!function_exists('get_orderid')) {
        function get_orderid(){
            $rand_code = get_code();
            return 'bn'.date('YmdHis').$rand_code;
        }
    }
}

/**
 *生成订单编号
 *@return string
 */
if(!function_exists('get_orderid')) {
    function get_orderid(){
        $rand_code = get_code();
        return 'bn'.date('YmdHis').$rand_code;
    }
}


/**
 *生成字母数字随机数
 */
if ( ! function_exists('random_alphanum')) {
    function random_alphanum($length = 6){

        $CI=&get_instance();
        $CI->load->library('Coupons');

        try {
            return $CI->coupons->generate($length, '', '', true, true);
        }catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }

}

/**
 * 循环 删除文件夹
 * @author chaokai@gz-zc.cn
 */
 if(!function_exists('delete_dir')){
     function delete_dir($dir){
         if(@rmdir($dir) == false && is_dir($dir)){
             if($dp = opendir($dir)){
                 while (false !== ($file = readdir($dp))){
                     if($file == '.' || $file == '..'){
                         continue;
                     }
                     if(is_dir($dir.'/'.$file)){
                         delete_dir($dir.'/'.$file);
                     }else{
                         unlink($dir.'/'.$file);
                     }
                 }
                 closedir($dp);
                 @rmdir($dir);
             }else{
                 exit('not permission');
             }
         }
     }
 }
    
 /**
  * 发送邮件函数
  * @author chaokai@gz-zc.cn
  * 
  */
  if(!function_exists('send_email')){
      function send_email($emails, $title, $content){
      
          require_once BASEPATH.'../shared/libraries/PHPMailer/PHPMailerAutoload.php';
          $mail				=	new PHPMailer();
          $mail->CharSet		=	"UTF-8";		//设定编码
          $mail->IsSMTP();						//确定使用smtp
          $mail->WordWrap		=	50;				//确定多少字换行
          $mail->SMTPAuth		=	true;			//打开 SMTP 认证
          $mail->IsHTML(true);					//以 HTML 格式发送
          #SMTPSecure
      
          //SMTP服务器地址
          $mail->Host			=	C('email.server');
      
          //登录用户名、密码
          $mail->Username		=	C('email.username');
          $mail->Password		=	C('email.password');
      
          //发件人地址、姓名
          $mail->From			=	C('email.from');
          $mail->FromName		=   C('email.fromname');
      
          if(is_array($emails))
          {
              foreach($emails as $v)
              {
                  if(is_mail($v))
                  {
                      $mail->AddAddress($v);
                  }
                  else
                  {
                      echo '--'.$v.'--';
                  }
              }
          }
          else
          {
              if(is_mail($emails))
              {
                  $mail->AddAddress($emails);
              }
          }
      
          //标题、内容
          $mail->Subject      = $title;
          $mail->Body         = $content;
      
          //结束
          if($mail->Send()){
              return true;
          }else{
              return $mail->ErrorInfo;
          }
      }
  }
  /**
   * 判断是否为邮箱
   * @author chaokai@gz-zc.cn
   */
  if(!function_exists('is_mail')){
      function is_mail($email_address){
          $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
          return preg_match( $pattern, $email_address );
      }
  }
  
  
/**
* 将图片上传到阿里云对象存储
* @param $arr array 需要保存到oss的文件数组
* @param $file_type string 文件类型，默认为图片
* @author chaokai@gz-zc.cn
*/
if(!function_exists('save_to_oss')){
    function save_to_oss($arr, $file_type = 'image'){
      if(ENVIRONMENT == 'development'){
          return true;
      }

      require_once BASEPATH.'../shared/libraries/aliyunoss/autoload.php';

      
      $access_key = C('aliyun.oss.access_key');
      $access_secret = C('aliyun.oss.access_secret');
      $endpoint = C('aliyun.oss.endpoint');
      $bucket = C('aliyun.oss.bucket');
    
      try {
          $ossclient = new OSS\OssClient($access_key, $access_secret, $endpoint, true);
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

/**
 * 金额大写转换
 * @author louhang@gz-zc.cn
 */
if(!function_exists('convert_money')){
    function convert_money ($price = 0) {
        $price = (string) $price;
    
        $strOutput = "";
        $strUnit = '仟佰拾亿仟佰拾万仟佰拾元角分';
        $price .= "00";
        $intPos = strpos($price, '.');
    
        if ($intPos !== false)
            $price = substr($price, 0, $intPos). substr($price, $intPos + 1, 2);
    
        $strUnit = mb_substr($strUnit, mb_strlen($strUnit) - strlen($price));
    
        for ($i=0; $i < strlen($price); $i++)
            $strOutput .= mb_substr('零壹贰叁肆伍陆柒捌玖', substr( $price, $i, 1), 1). mb_substr($strUnit, $i, 1);
        mb_regex_encoding('utf-8');
        $patterns = array();
        $replacements = array();
    
        $patterns[0] = '/零角零分$/';
        $replacements[0] = '整';
    
        $patterns[1] = "/零(仟|佰|拾)/";
        $replacements[1] = '零';
    
        $patterns[2] = "/(零){2,}/";
        $replacements[2] = '零';
    
        $patterns[3] = "/零([亿|万])/";
        $replacements[3] = '$1';
    
        $patterns[4] = "/(零)+元/";
        $replacements[4] = '元';
    
        $patterns[5] = "/亿零{0,3}万/";
        $replacements[5] = '亿';
    
        $patterns[5] = "/^元/";
        $replacements[5] = '零元';
    
        $strOutput = preg_replace($patterns, $replacements, $strOutput);
    
        return $strOutput;
    }
}