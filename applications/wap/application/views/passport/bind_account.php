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
    <link href="<?php echo css_js_url('wap_bind.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body class="login-page">
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainHeader">
                <div class="headTitle">绑定手机号</div>
                <div id="menu-toggle">
                    
                    <div id="cross">
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="mainContainer">
                <div class="mainfix">
                    <ul class="forme" id="reg_form">
                        
                        <input type="hidden" name="open_id" value="<?php echo $open_id; ?>">
                        <input type="hidden" name="state" value="<?php echo $state; ?>" >
                        <input type="hidden" name="nickname" value="<?php echo $nickname; ?>" >
                        <input type="hidden" name="sex" value="<?php echo $sex; ?>" >
                        <input type="hidden" name="head_img" value="<?php echo $head_img; ?>" >
                        <input type="hidden" name="address" value="<?php echo $address; ?>" >
                        <input type="hidden" name="token" value="<?php echo $token ?>">
                        
                        <li><i class="user"></i><input type="text" name="mobile" placeholder="请输入您的手机号"></li>
                        <li>
                            <i class="code"></i>
                            <input type="text" name="code" class="code" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x6536;&#x5230;&#x7684;&#x624B;&#x673A;&#x9A8C;&#x8BC1;&#x7801;">
                            <button class="code" id="reg_code">获取验证码</button>
                        </li>
                    </ul>
                
                    <p class="message" id="reg_msg"></p>
                    <a href="javascript:;" class="but submit" id="bind_account_btn">立即绑定</a>
                </div>   
            </div>
        </div>
        <!-- 左边栏 -->
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
