<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('public.css', 'www');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('index.css', 'www');?>">
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body class="today">
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>

    <!-- 内容 -->
    <div class="container">
        

        <div class="page-main">
            <ul class="banquet-list">
            <?php if (isset($lists)):?>
            <?php foreach ($lists as $k=>$v):?>
                <a href="/today/detail?id=<?php echo $v['id']?>">
                <li>
                    <div class="tip-icon"><i></i>
                    <?php echo '今日'.$type[$v['venue_type']]?>
                    </div>
                    <div class="img-cont">
                        <img src="<?php echo !empty($v['cover_img']) ? get_img_url($v['cover_img']) : $domain['static']['url'].'/www/images/default-banner1.jpg'?>">
                        <p class="bg"></p>
                        <p class="rect"></p>
                        <p class="brife"><img src="<?php echo $domain['static']['url']?>/www/images/banquet-title.png"></p>
                    </div>
                    <div class="info">
                        <i class="triangle"></i>
                        <div class="cont">
                            <p class="date"><?php echo $v['solar_time']?></p>
                            <?php if($v['venue_type'] == C('party.wedding.id')):?>
                            <p class="name">新郎：<?php echo $v['roles_main']?></p>
                            <p class="name">新娘：<?php echo $v['roles_wife']?></p>
                            <?php endif;?>
                            
                            <?php if($v['venue_type'] == C('party.birthday.id')):?>
                            <p class="name">寿星：<?php echo $v['roles_main']?></p>
                            <?php endif;?>
                            
                            <?php if($v['venue_type'] == C('party.champion.id')):?>
                            <p class="name">状元：<?php echo $v['roles_main']?></p>
                            <?php endif;?>
                            
                            <?php if($v['venue_type'] == C('party.bairiyan.id')):?>
                            <p class="name">百日宴：<?php echo $v['roles_main']?></p>
                            <?php endif;?>
                            
                            <span></span>
                            <p class="icon">宴会厅：<?php foreach ($venue as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?> <?php echo $vv?><?php endforeach;?> <?php endif;?> <?php endforeach;?></p>
                            <p class="text">时间：<?php echo $v['banquet_time']?></p>
                            <p class="text">地址：<?php echo $about['address']?></p>
                        </div>
                        <i class="arrow"></i>
                    </div>
                </li>
                </a>
                <?php endforeach;?>
           <?php endif;?>
            </ul>
        </div>        

    </div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['public','<?php echo css_js_url('news.js', 'www')?>'], function(a){
			a.load();
        })
    </script>
</body>
</html>
