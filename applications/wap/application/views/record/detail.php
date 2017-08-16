<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title[0]?>-<?php echo $title[1]?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('record.css', 'wap')?>">
</head>

<body>
    <div class="mainfix">
        <div class="name"><?php if(isset($info['husband'])){echo $info['husband'];}elseif(isset($roles)){echo $roles['roles_main'];}?>&<?php if(isset($info['wife'])){echo $info['wife'];}elseif(isset($roles)){echo $roles['roles_wife'];}?></div>
        <ul>
            <li>
                <p class="title">你们的职业？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['profession'])){echo $info['info']['profession'];}?></p>
            </li>
            <li>
                <p class="title">你们相识于年月日？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['first_meet_time'])){echo $info['info']['first_meet_time'];}?></p>
            </li>
            <li>
                <p class="title">初次约会是在什么时候？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['appointmen_time'])){echo $info['info']['appointmen_time'];}?></p>
            </li>
            <li>
                <p class="title">在哪里？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['appointmen_addr'])){echo $info['info']['appointmen_addr'];}?></p>
            </li>
            <li>
                <p class="title">恋爱时的情人节是怎么过的？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['qingrenjie'])){echo $info['info']['qingrenjie'];}?></p>
            </li>
            <li>
                <p class="title">您两人是否有相同的兴趣爱好？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['hobby'])){echo $info['info']['hobby'];}?></p>
            </li>
            <li>
                <p class="title">您觉得他（她）的优点是什么？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['merit'])){echo $info['info']['merit'];}?></p>
            </li>
            <li>
                <p class="title">他（她）让你最感动的一件事？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['touch'])){echo $info['info']['touch'];}?></p>
            </li>
            <li>
                <p class="title">婚礼上想为他/她做些什么？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['do_what'])){echo $info['info']['do_what'];}?></p>
            </li>
            <li>
                <p class="title">对于父母您想说点什么吗？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['say_for_parent'])){echo $info['info']['say_for_parent'];}?></p>
            </li>
            <li>
                <p class="title">你想怎么对父母表达感恩之情？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['thanks_parent'])){echo $info['info']['thanks_parent'];}?></p>
            </li>
            <li>
                <p class="title">婚礼的来宾有要关照的人吗？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['care'])){echo $info['info']['care'];}?></p>
            </li>
            <li>
                <p class="title">你们的生日是不是在婚礼当天？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['is_today'])){echo $info['info']['is_today'];}?></p>
            </li>
            <li>
                <p class="title">有没有特殊的纪念日？</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['jinianri'])){echo $info['info']['jinianri'];}?></p>
            </li>
            <li>
                <p class="title">备注：</p>
                <p class="text"><?php if(isset($info['info'])&&isset($info['info']['remark'])){echo $info['info']['remark'];}?></p>
            </li>
        </ul>
    </div>
</body>
</html>
