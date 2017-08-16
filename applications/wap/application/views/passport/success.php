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
    <link href="<?php echo css_js_url('m-user.css', 'wap');?>" type="text/css" rel="stylesheet" />
</head>

<body class="login-page">
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainHeader">
                <div class="headTitle" style="color: #3c9e80;">系统提示</div>
                <a></a>
                <div id="menu-toggle">
                    <div id="cross">
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="mainContainer">
                <div class="mainfix">
                    <div class="user-top" style="height: 10rem;     background-image: url();">
                        <img src="<?php echo $domain['static']['url']?>/www/images/success.png" style="width: 4.0rem;height: 4.0rem; border: solid 0 #fbd268;">
                    </div>
                    <div style="color: #3c9e80;text-align: center;white-space: nowrap;font-size: 0.8rem;">登录成功 :)</div>
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
