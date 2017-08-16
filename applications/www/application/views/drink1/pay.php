<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-<?php echo $title?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
     <link rel="stylesheet" href="<?php echo css_js_url('new_index.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('new_public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('detail.css', 'www')?>">
</head>
<body class="grey">
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container padtop100">     
        <div class="page-main">
            <div class="pay-info">
                <div class="cont1">
                    <p class="title">提交订单成功，请尽快支付！</p>
                    <p class="text">请您在提交订单后<span>24小时内</span>完成支付，否则订单将自动取消。</p>
                </div>
                <p class="number">订单号：<?php echo $order['order_id']?></p>
                <p class="price">应付总额：<span>¥<?php echo $order['need_pay']?></span></p>
            </div>
            <div class="pay-cont">
                <div class="pay-left">
                    <p class="title">打开微信 - 扫一扫 </p>
                    <img src="<?php echo $domain['static']['url']?>/www/images/wechat-scan-guide.png">
                </div>
                <div class="pay-right" id="pay">
                    <p class="price">支付金额：<span>￥<?php echo $order['need_pay']?></span></p>
                    <img src="/publicservice/qr_code?link=<?php echo $code_url?>" class="ewm">
                    <p class="text">请使用微信扫描二维码完成支付</p>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script >
    	var new_order_id = "<?php echo $order['id']?>";
    	seajs.use([
    	           '<?php echo css_js_url('car.js', 'www')?>'
    	        ], function(pay){
    	          	//定时请求订单状态
    	          	pay.pay_status();
    			})
    </script>
</body>
</html>
