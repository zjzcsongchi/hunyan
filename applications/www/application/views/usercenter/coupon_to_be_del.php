<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-我的优惠卷</title>
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
            <?php if(isset($coupon)):?>
            <p class="head">我的优惠券</p>
            <p class="head-s">MY PREFERENTIAL VOLUME<br>百年婚宴-虽然我不是一个善于表达内心情感的人，但我是一个用实际行动去做的人</p>
            <?php endif;?>
            <ul class="volume-list">
                <?php if(isset($coupon)):?>
                <?php foreach ($coupon as $k => $v):?>
                <li <?php if($v['status'] == $status['status']['timeout']['id']){echo 'class="dateline"';}elseif ($v['status'] == $status['status']['use']['id']){echo 'class="used"';} ?>>
                    <i></i>
                    <div class="cont">
                        <p class="title"><?php echo $v['name']?></p>
                        <p class="coupon-num"><?php echo $v['number']?></p>
                        <p class="count">￥<?php echo number_format($v['favorable'],0)?><span>元</span></p>
                        <p class="date">有效期至：<?php echo $v['end_time']?></p>
                    </div>
                </li>
                <?php endforeach;?>
                <?php else:?>
                <div class="user-message">
                       <img src="<?php echo $domain['static']['url']?>/www/images/user.png"><p>您目前还没有优惠卷哦~</p>
                </div>
                <?php endif;?>
            </ul>
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
