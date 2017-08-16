<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('wap-user.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>

</head>

<body class="grey">
    <div class="page-main">
        <ul class="top-nav">
            <li id="status"><a href="/usercenter/coupon">全部</a></li>
            <li <?php if($status == C('coupon.status.no_use.id')){echo 'class="act"';}?>><a class="get" data="/usercenter/coupon?status=<?php echo C('coupon.status.no_use.id');?>"><?php echo C('coupon.status.no_use.name')?></a></li>
            <li <?php if($status == C('coupon.status.timeout.id')){echo 'class="act"';}?>><a class="get" data="/usercenter/coupon?status=<?php echo C('coupon.status.timeout.id');?>"><?php echo C('coupon.status.timeout.name')?></a></li>
        </ul>
        <div class="user-cont">
            <ul class="coupon-list">
                <?php if(isset($coupon)):?>
                <?php foreach ($coupon as $k => $v):?>
                <li class="<?php if(C('coupon.status.no_use.id') == $v['status'] && $v['end_time'] >= $now ){echo 'touse';}else{echo 'used';}?>">
                    <div class="line"></div>
                    <p class="tip">
                        <?php if($v['status'] == C('coupon.status.no_use.id') && $v['end_time'] >= $now):?>
                            <?php echo C('coupon.status.no_use.name');?>
                        <?php elseif($v['status'] == C('coupon.status.use.id')):?>
                            <?php echo C('coupon.status.use.name');?>
                        <?php else:?>
                            <?php echo '已过期';?>
                        <?php endif;?>
                    </p>
                    <p class="title"><?php echo $v['name']?></p>
                    <p class="price"><span>￥<?php echo $v['favorable']?></span>元</p>
                    <p class="date">有效期至：<?php echo $v['end_time']?></p>
                </li>
                <?php endforeach;?>
                <?php endif;?>

            </ul>
        </div>
    </div>
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('coupon.js', 'wap')?>'], function(p,k){
            p.load();
            k.get();
            $(function(){
				if(!$('#status').siblings().hasClass('act')){
					$('#status').addClass('act');
				}
            })
         });
    </script>
</body>
</html>