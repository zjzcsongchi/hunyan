<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?> - 我的优惠卷</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('m-wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-user_coupon.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                    <ul class="user-nav borbot">
                        <li><a href="/usercenter/coupon" class="<?php if($status == 0) echo 'act';?>" >全部</a></li>
                        <li><a href="/usercenter/coupon/<?php echo C('coupon.status.no_use.id')?>" class="<?php if($status == C('coupon.status.no_use.id')) echo 'act';?>">待使用</a></li>
                        <li><a href="/usercenter/coupon/<?php echo C('coupon.status.timeout.id')?>" class="<?php if($status == C('coupon.status.timeout.id')) echo 'act';?>">已过期</a></li>
                    </ul>
                    <ul class="coupon-list">
                        <?php if(isset($coupon)):?>
                        <?php foreach ($coupon as $k => $v):?>
                        <li class="<?php if($v['end_time'] > $now): echo 'wait'; else: echo 'over'; endif;?>">
                            <i></i>
                            <p class="top-bg"></p>
                            <div class="left-cont"><?php echo $v['name']?><br><span>￥<?php echo $v['favorable']?></span></div>
                            <div class="right-cont">
                                <p><span>百年婚宴-婚宴代金券</span></p>
                                <p>使用平台：百年婚宴客户端平台</p>
                                <p>适用类型：适用于百年婚宴-婚礼宴席的折扣</p>
                            </div>
                            <p class="line"></p>
                            <p class="date">有效期：<?php echo $v['create_time']?>至<?php echo $v['end_time']?></p>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>

                    <?php $this->load->view('common/new_footer')?>
                </div>   
            </div>
        </div> 
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>'], function(p){
            p.load();

        })
    </script>
</body>
</html>
