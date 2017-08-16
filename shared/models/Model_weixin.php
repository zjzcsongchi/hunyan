<?php
    class Model_weixin extends MY_Model{
        public $appId;
        public $appSecret;
        public $token;

        public function __construct() {
            parent::__construct();
            //审核通过的移动应用所给的AppID和AppSecret
            $this->appId = C('wechat_app.app_id.value');
            $this->appSecret = C('wechat_app.app_secret.value');
            $this->token = '00000000';
        }

        /**
         * 获取jssdk所需参数的所有值
         * @return array
         */
        public function signPackage() {
            $protocol = (!empty($_SERVER['HTTPS'] && $_SERVER['HTTPS'] == 'off' || $_SERVER['port'] == 443)) ? 'https://' : 'http://';
            //当前网页的URL
            $url = $protocol.$_SERVER['host'].$_SERVER['REQUEST_URI'];
            //生成签名的时间戳
            $timestamp = time();
            //生成签名的随机串
            $nonceStr = $this->createNonceStr();
            //获取公众号用于调用微信JS接口的临时票据
            $jsApiTicket = $this->getJsApiTicket();
            //对所有待签名参数按照字段名的ASCII 码从小到大排序（字典序）后，
            //使用URL键值对的格式（即key1=value1&key2=value2…）拼接成字符串$str。
            //这里需要注意的是所有参数名均为小写字符
            $str = "jsapi_ticket=$jsApiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
            //对$str进行sha1签名，得到signature：
            $signature = sha1($str);
            $signPackage = array(
                "appId"     => $this->AppId,
                "nonceStr"  => $nonceStr,
                "timestamp" => $timestamp,
                "url"       => $url,
                "signature" => $signature,
                "rawString" => $string
                );
            return $signPackage;
        }

        /**
         * 创建签名的随机字符串
         * @param  int $length 字符串长度
         * @return string      随机字符串
         */
        private function createNonceStr($length = 16){
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $str = '';
            for ($i=0; $i < $length; $i++) { 
                $str .= substr(mt_rand(0, strlen($chars)), 1);
            }
            return $str;
        }

        /**
         * 获取公众号用于调用微信JS接口的临时票据
         * @return string 
         */
        private function getJsApiTicket() {
            //先查看redis里是否存了jsapi_ticket此值，假如有，就直接返回
            $jsApiTicket = $this->library->redisCache->get('weixin:ticket');
            if (!$jsApiTicket) {
                //先获取access_token（公众号的全局唯一票据）
                $accessToken = $this->getApiToken();
                //通过access_token 采用http GET方式请求获得jsapi_ticket
                $result = $this->callApi("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=jsapi");
                //得到了jsapi_ticket
                $jsApiTicket = $result['ticket'];
                //将jsapi_ticket缓存到redis里面，下次就不用再请求去取了
                $expire = max(1, intval($result['expire']) - 60);
                $this->library->redisCache->set('weixin:ticket', $jsApiTicket, $expire);
            }
            return $jsApiTicket;
        }

        /**
         * 获取众号的全局唯一票据access_token
         * @param  boolean $forceRefresh 是否强制刷新
         * @return string                返回access_token
         */
        private function getApiToken($forceRefresh = false) {
            //先查看redis是否存了accessToken,如果有了，就不用再去微信server去请求了（提高效率）
            $accessToken = $this->library->redisCache->get('weixin:accessToken');
            //强制刷新accessToken或者accessToken为空时就去请求accessToken
            if ($forceRefresh || empty($accessToken)) {
                //请求得到accessToken
                $result = $this->callApi("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret={$this->appSecret}");
                $accessToken = $result['access_token'];
                $expire = max(1, intval($result['expire']) - 60);
                //将其存进redis里面去
                $this->library->redisCache->set('weixin:accessToken', $accessToken, $expire);
            }
            return $accessToken;
        }
    }