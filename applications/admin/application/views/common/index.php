<!DOCTYPE html>
<html>
<head>
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('admin_index.css', 'admin')?>">

</head>
<body>
    <div class="page-cont">
        <div class="logo"></div>
        <div class="title"></div>
        <div class="link-list">
            <?php foreach ($list as $k => $v):?>
            <a href="/venue/index/<?php echo $v['id']?>"><?php echo $v['name']?></a>
            <?php endforeach;?>
        </div>
    </div>
    
</body>
</html>
