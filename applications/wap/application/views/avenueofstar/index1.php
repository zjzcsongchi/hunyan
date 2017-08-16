<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>《CCTV-星光大道》 贵州安顺赛区参赛报名</title>
    <meta name="keywords" content="《CCTV-星光大道》 贵州安顺赛区参赛报名">
    <meta name="description" content="《CCTV-星光大道》 贵州安顺赛区报名参赛报名">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('style.css', 'avenueofstar');?>">
</head>
<body>
    <div class="page-main">
        <div class="banner"><img src="<?php echo $domain['static']['url']?>/avenueofstar/images/banner.jpg"></div>
        <div class="wait-cont">
            <img src="<?php echo $domain['static']['url']?>/avenueofstar/images/<?php echo $auth_status_img ?>.png">
            <div class="text">
                <?php echo $auth_status_res ?>
                <?php if($auth_status != 0):?>                          
                    <span class="view-detail"><?php echo $auth_suggestion ?></span>
                <?php endif?>
                
            </div>
           
            <a href="/avenueofstar/apply1" class="return">返回修改</a>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <script src="<?php echo css_js_url('jquery.min.js', 'avenueofstar');?>"></script>
</body>
</html>
