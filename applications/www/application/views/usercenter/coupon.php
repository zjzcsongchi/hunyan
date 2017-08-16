<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('pc-public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('pc-user.css', 'www')?>">
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
                <p class="max-title">我的优惠券</p>
                <ul class="coupon-chose">
                    <li class="all act">全部</li>
                    <li class="to-use ">待使用</li>
                    <li class="timeout ">已过期</li>
                </ul>
                <ul class="coupon-list">
                    <?php if(isset($coupon)):?>
                    <?php foreach ($coupon as $k => $v):?>
                        <li class="<?php echo $v['class_name']?>">
                            <p class="tip"><?php echo $v['status_name']?></p>
                            <p class="price">￥<span><?php echo $v['favorable']?></span></p>
                            <p class="title">代金券</p>
                            <p class="text">百年婚宴-<?php echo $v['name']?>代金券</p>
                            <p class="l-text">使用平台：</p>
                            <p class="r-text">百年婚宴客户端平台</p>
                            <p class="l-text">适用类型：</p>
                            <p class="r-text">适用于百年婚宴-<?php echo $v['name']?>宴席的折扣</p>
                            <p class="date">过期时间：<?php echo $v['end_time']?></p>
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
    </div>

    
    
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([
           '<?php echo css_js_url('coupon.js', 'www')?>'
        ], function(coupon){
         	 coupon.load();
		})
    </script>

</body>
</html>
