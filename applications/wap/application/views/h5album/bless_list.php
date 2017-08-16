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
    <link href="<?php echo css_js_url('m-msglist.css', 'wap');?>" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="page-main">
        <ul class="lists">
        <?php if(isset($lists)):?>
        <?php foreach ($lists as $k=>$v):?>
            <li>
                <img src="<?php echo $user_info[$v['user_id']]['head_img']?>">
                <div class="cont">
                    <p class="name"><span><?php echo $user_info[$v['user_id']]['name']?></span><?php if($attend_num[$v['wall_num']]  != 11):?><?php echo $attend_num[$v['wall_num']] ?>人出席<?php else:?>不出席 <?php endif;?></p>
                    <p class="text"><?php echo $v['content']?></p>
                </div>
            </li>
        <?php endforeach;?>
        
        <?php else:?>
                         暂无留言
        <?php endif;?>
        </ul>
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
</body>
</html>
