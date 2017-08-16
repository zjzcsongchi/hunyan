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

    <link href="<?php echo css_js_url('pc-public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('pc-user.css', 'www');?>" type="text/css" rel="stylesheet" />
    
    <?php $this->load->view('common/baidu_tongji')?>
    
</head>
<body class="grey">
     <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">
        <!-- 用户信息头部 -->
        <?php $this->load->view('common/user_banner')?>

        <div class="page-main padbot200">
            <!-- 用户中心 左侧菜单栏 -->
            <?php $this->load->view('common/user_leftmenu')?>
            <div class="user-right">
                <div class="img-cont" style="text-align: center;"><img style="width: 550px; margin-top: 100px;" src="<?php echo $domain['static']['url'].'/www/images/no_wedding.png';?>"></div>
            </div>
        </div>
    </div>

    <div class="page-bg"></div>
    

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    seajs.use(['public' ], function(a,b){
		a.load();
		$(".user-banner .edit").click(function() {
            $(".page-bg").addClass("act");
            $(".popup-userinfo").addClass("act");
        });
        $(".popup-userinfo .close").click(function() {
            $(".page-bg").removeClass("act");
            $(".popup-userinfo").removeClass("act");
        });
    });
    </script>
</body>
</html>
