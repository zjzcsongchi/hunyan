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
                <p class="max-title">立即结算<span>- 立即支付</span>
                    <a href="javascript:window.history.go(-1)">
                        <i class="arow"></i>
                    </a>
                </p>
                <ul class="doctary-pay">
                    <?php if($is_photo):?>
                    <li>总共购买照片： <?php echo $photo_count?> 张</li>
                    <li>单价： ￥ <?php echo $photo_unit_price?> / 张</li>
                    <li>百年婚宴免费赠送： <?php echo $free_photo_num?> 张</li>
                    <li>积分抵换： <span>￥<?php echo $score_favorable?></span></li>
                    <?php endif?>
                    <li>总计： <span>￥<?php echo number_format($need_pay + $score_favorable + $favorable - $delivery_price, 2);?></span></li>
                    <li>优惠金额： <span>￥<?php echo $favorable?></span></li>
                    <li>邮费： <span>￥<?php echo number_format($delivery_price, 2)?> </span></li>
                    <li>应付金额： <span>￥<?php echo $need_pay?></span></li>
                </ul>
                <div class="doctary-cont1">
                    <p class="title">打开微信 - 扫一扫 </p>
                    <img src="<?php echo $domain['static']['url']?>/www/images/pay-tip.jpg">
                </div>
                <div class="doctary-cont2" id="pay">
                    <p class="price">支付金额：<span>￥<?php echo $need_pay?></span></p>
                    <?php if(!$is_pay):?>
                    <img src="/publicservice/qr_code?link=<?php echo $code_url?>">
                    <p class="text">请使用微信扫描二维码完成支付</p>
                    <?php else:?>
                    <img src="<?php echo $domain['static']['url']?>/www/images/pay_success.jpg">
                    <p class="text">支付成功</p>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>

    
    
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
		var unitPrice = <?php echo C('order.product_type.image.unit_price');?>; 
		var order_id = '<?php echo $order_id?>';
		var is_pay = <?php echo $is_pay?>;
		var staticUrl = '<?php echo $domain['static']['url']?>';
        seajs.use([
           '<?php echo css_js_url('address.js', 'www')?>',
           '<?php echo css_js_url('pay.js', 'www')?>'
        ], function(address, pay){
          	address.load();
        	address.deletePhoto();
          	address.payment();
          	//定时请求订单状态
          	pay.pay_status();
		})
    </script>

</body>
</html>
