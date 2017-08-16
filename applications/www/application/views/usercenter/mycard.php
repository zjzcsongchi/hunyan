<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-微请帖</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('user.css', 'www');?>" type="text/css" rel="stylesheet" />
    
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/header')?>

    <!-- 内容 -->
    <div class="container">
        <?php $this->load->view('common/user_head')?>

        <div class="user-main">
            <p class="head">微请帖</p>
            <p class="head-s">WEDDING BANQUET HALL<br>百年婚宴-每一道菜都是一种表现，是一种敬业</p>
            <div class="card-cont">
                <div class="con">
                    <p class="title">百年婚宴请帖</p>
                    <div class="cont"><img src="<?php echo  C('domain.static.url')?>/www/images/wedding-p6.jpg"></div>
                    <a href="javascript:;" class="but prve">上一页</a>
                    <a href="javascript:;" class="but next">下一页</a>
                </div>
            </div>
            <div class="bless-cont">
                <p class="title"><span>|</span>朋友们的祝福</p>
                <ul>
                </ul>
                <div class="pages-cont">
                    <div class="pages">
<!--                         <a href="javascript:;" class="but">上一页</a> -->
<!--                         <a href="javascript:;">1</a> -->
<!--                         <a href="javascript:;" class="but act">下一页</a> -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
 		seajs.use(['public'],function(a){
 			$(function(){
 	            $(".volume-list li:nth-child(4n)").css("margin-right", "0");
 	        });
 	        a.load();
 	 	})
        
    </script>
</body>
</html>
