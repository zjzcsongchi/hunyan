<?php
/**
 * 头像替换
 * @author songchi@gz-zc.cn
 */
class Head extends MY_Controller {
    
    private $appid, $appsecret;
    public function __construct(){
        
        parent::__construct();
        
        $this->load->model(array(
            'Model_user' => 'Muser',
            'Model_access_token' => 'Maccess_token'
        ));
        
        $this->appid = C('wechat_app.app_id.value');
        $this->appsecret = C('wechat_app.app_secret.value');
        
        $param = array(
            'app_id' => $this->appid,
            'app_secret' => $this->appsecret,
            'cache_dir' => APPPATH.'cache/'
        );
        $this->load->library('weixinjssdk', $param);
    }
    
    public function index(){
        
        $open_id = $this->Muser->get_lists('id, open_id',array('is_del'=>0, 'open_id !='=>''));
        $open_id = array_column($open_id, 'open_id', 'id'); 
        
        $count = 0;
        foreach ($open_id as $k=>$v){
            $access_token = $this->weixinjssdk->getAccessToken();
            //获取用户信息
            $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$v.'&lang=zh_CN';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
            $data = curl_exec($ch);
            curl_close($ch);
            $user_info = json_decode($data, true);
            
            if(isset($user_info['headimgurl']) && $user_info['headimgurl']){
                $where['open_id'] = $user_info['openid'];
                $update_data['head_img'] = $user_info['headimgurl'];
                $update_id = $this->Muser->update_info($update_data, $where);
                echo "$update_id $v 头像已更新 \n";
                $count++;
            }
            
        }
        echo "总计更新 $count 人\n";
    }
   
}