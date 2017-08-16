<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
</head>

<body class="login-page">
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainHeader">
                <div class="headTitle">找回密码</div>
            </div>
            <div class="mainContainer">
                <div class="mainfix">
                    <ul class="forme" id="repass_form">
                        <input type="hidden" name="token" value="<?php echo $token ?>">
                        <li><i class="user"></i><input type="text" name="mobile" placeholder="请输入注册的手机号"></li>
                        <li>
                            <i class="code"></i>
                            <input type="text" name="code" class="code" placeholder="请输入验证码">
                            <button class="code" id="repass_code">获取验证码</button>
                        </li>
                        <li><i class="pass"></i><input type="password" name="password" placeholder="&#x8BF7;&#x8BBE;&#x7F6E;&#x60A8;&#x7684;&#x5BC6;&#x7801;&#xFF08;6-16&#x4E2A;&#x5B57;&#x7B26;&#xFF09;"></li>
                    </ul>
                    <p class="message" id="repass_msg"></p>
                    <a href="javascript:;" class="but submit" id="repass_btn">确认修改</a>
                </div>   
            </div>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('passport.js', 'wap')?>', '<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('iscroll.min.js', 'wap')?>'], function(a,b){
    			a.load();
    			b.load();
        });
    </script>
</body>
</html>
