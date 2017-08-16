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
    <link href="<?php echo css_js_url('m-h5list.css', 'wap');?>" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="page-main">
       
        <ul class="lists">
        <?php if(isset($lists) && $lists):?>
        <?php foreach ($lists as $k=> $v):?>
            <li>
                <?php if(!$status):?>
                <a href="/h5album/edit/0/<?php echo $v['id']?>">
                <?php else :?>
                <a href="/h5album/template_info/<?php echo $v['id']?>">
                <?php endif;?>
                <img src="<?php echo get_img_url($v['cover_img'])?>">
                </a><p class="name"><?php echo $v['name']?></p>
            </li>
        <?php endforeach;?>
        <?php endif;?>
        </ul>
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
</body>
</html>
