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
    <link href="<?php echo css_js_url('wap-user.css', 'wap');?>" type="text/css" rel="stylesheet" />
</head>

<body class="grey">
    <div class="page-main">
        <div class="user-cont">
            <ul class="doctary-pay">
                <li>
                    <p class="head">总计：</p>
                    <p><?php echo $photo_count ?>张</p>
                </li>
                <li>
                    <p class="head">单价：</p>
                    <p>￥<?php echo $photo_unit_price ?> / 张</p>
                </li>
                <li>
                    <p class="head">赠送：</p>
                    <p><?php echo $order['favorable']/$photo_unit_price ?> 张</p>
                </li>
                <li>
                    <p class="head">总价： </p>
                    <p><span>￥<?php echo $order['need_pay'] + $order['score_favorable'] + $order['favorable'] - $delivery_price ;?></span></p>
                </li>
                <li>
                    <p class="head">优惠： </p>
                    <p><span>￥<?php echo $order['favorable'] ?></span></p>
                </li>
                <li>
                    <p class="head">邮费： </p>
                    <p><span>￥<?php echo $delivery_price ?></span></p>
                </li>
                <li>
                    <p class="head">积分抵换：</p>
                    <p><span>￥<?php echo $order['score_favorable'] ?> </span></p>
                </li>
                <li>
                    <p class="head"><span class="price">应付：</span></p>
                    <p><span class="price">￥<?php echo $order['need_pay'] ?> </span></p>
                </li>
            </ul>
        </div>
        <a href="javascript:;" class="pay">微信支付</a>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([
           '<?php echo css_js_url('address.js', 'wap')?>',
        ], function(address){

		})
    </script>

</body>
</html>
