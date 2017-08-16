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
                <div class="headTitle">登录</div>
            </div>
            <div class="mainContainer">
                <div class="mainfix">
                    <ul class="forme" id="login_form">
                        <li><i class="user"></i><input type="text" name="mobile" placeholder="请输入您的手机号"></li>
                        <li><i class="pass"></i><input type="password" name="password" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x5BC6;&#x7801;"></li>
                    </ul>
                    <p class="info"><i id="login_auto"></i>记住我<a href="/passport/forget_password" class="r">忘记密码？</a></p>
                    <p class="message" id="login_msg"></p>
                    <a href="javascript:;" class="but submit" id="login_btn">立即登录</a>
                    <a href="<?php echo $weixin_url?>" class="but weix-login">微信登录</a>
                    <p class="text">还没有帐号？ <a href="/passport/register">立即注册</a></p>
                </div>   
            </div>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('passport.js', 'wap')?>', '<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('iscroll.min.js', 'wap')?>'], function(a,b){
    			a.load();
    			b.load();
        });
    </script>
</body>
</html>
