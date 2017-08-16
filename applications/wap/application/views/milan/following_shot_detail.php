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
    <link rel="stylesheet" href="<?php echo css_js_url('wap-ml.css', 'wap')?>">
    <?php $this->load->view('common/tongji')?>

</head>
<body class="grey">
    <div class="page-main">
        <div class="adhere-detail">
            <p class="title"><?php echo $following_shot['title'];?></p>
            <p class="text"><?php echo $following_shot['desc'];?></p>
            <div class="img-cont">
                <?php foreach ($following_shot['images'] as $v):?>
                     <img src="<?php echo get_img_url($v)?>">
                <?php endforeach;?>

            </div>
        </div>
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
      
</body>
</html>
