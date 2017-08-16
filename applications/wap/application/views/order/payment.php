<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('new_m_wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body class="grey">
    <div class="page-main padbot100">
    
        <div class="drink-pay">
            <p>提交订单成功，请尽快支付！</p>
            <p>请您在提交订单后<span>24小时</span>内完成支付，否则订单将自动取消。</p>
        </div>
        
        <p class="max-title title1">订单信息</p>
        <ul class="pay-list">
            <?php foreach ($product_name as $k => $v):?>
                <li>
                    <p class="head">商品：</p>
                    <p class="text"><?php echo $v ?></p>
                </li>
            <?php endforeach;?>
            
            <li>
                <p class="head">联系人：</p>
                <p class="text"><?php echo isset( $addr['name']) ?  $addr['name'] : '未填写'?></p>
            </li>
            <li>
                <p class="head">联系电话：</p>
                <p class="text"><?php echo isset($addr['mobile_phone']) ? $addr['mobile_phone']: '未填写'?></p>
                </li></p>
            </li>
            <li>
                <p class="head">送货方式：</p>
                <p class="text"><?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                            <?php echo C('order.delivery_type.express.name')?>
                        <?php else:?>
                            <?php echo C('order.delivery_type.ziti.name')?>
                        <?php endif?></p>
            </li>
            <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                <li>
                    <p class="head">邮费：</p>
                    <p class="text"><span>￥<?php echo C('order.delivery_type.express.price') ?></span></p>
                </li>
                <li>
                    <p class="head">收货地址：</p>
                    <p class="addres"><?php echo isset($addr['address']) ? $addr['address'] : '未填写'?></p>
                </li>
                <?php endif?>
        </ul>
        <?php if($order['order_type'] == C('order.order_type.image.id')):?>
            <ul class="pay-list">
                <li>
                    <p class="head">总       计：</p>
                    <p class="text"><?php echo $photo_count;?>张</p>
                </li>
                <li>
                    <p class="head">单       价：</p>
                    <p class="text">￥<?php echo C('order.product_type.image.unit_price')?> / 张</p>
                </li>
                <li>
                    <p class="head">赠       送：</p>
                    <p class="text"><?php echo $free_photo_num;?>张</p>
                </li>
                <li>
                    <p class="head">总       价： </p>
                    <p class="text"><span>￥<?php echo $order['need_pay'] + $order['score_favorable'] + $order['favorable'] - $delivery_price;?></span></p>
                </li>
                <li>
                    <p class="head">优       惠： </p>
                    <p class="text"><span><?php echo $order['favorable'] != 0 ? '￥'.$order['favorable'] : '无' ?></span></p>
                </li>
                <li>
                    <p class="head">积分抵换：</p>
                    <p class="text"><span><?php echo $order['score_favorable'] != 0 ? '￥'.$order['score_favorable'] : '无' ?></span></p>
                </li>
            </ul>
        <?php elseif($order['order_type'] == C('order.order_type.album.id')):?>
            <ul class="pay-list">
                <li>
                    <p class="head">单       价：</p>
                    <p class="text">￥<?php echo $product_price ?> / 册</p>
                </li>
                <li>
                    <p class="head">总       价： </p>
                    <p class="text"><span>￥<?php echo $order['need_pay'] + $order['score_favorable'] + $order['favorable'] - $delivery_price;?></span></p>
                </li>
                <li>
                    <p class="head">入册相片： </p>
                    <p class="text"><span>￥<?php echo $photo_count;?> 张</span></p>
                </li>
                <li>
                    <p class="head">优       惠： </p>
                    <p class="text"><span><?php echo $order['favorable'] != 0 ? '￥'.$order['favorable'] : '无' ?></span></p>
                </li>
                <li>
                    <p class="head">积分抵换：</p>
                    <p class="text"><span><?php echo $order['score_favorable'] != 0 ? '￥'.$order['score_favorable'] : '无' ?></span></p>
                </li>
            </ul>
        <?php elseif($order['order_type'] == C('order.order_type.all_image.id')):?>
            <ul class="pay-list">
                <li>
                    <p class="head">总       计： </p>
                    <p class="text"><span><?php echo $photo_count;?>张</span></p>
                </li>
                <li>
                    <p class="head">单       价： </p>
                    <p class="text"><span>￥<?php echo number_format($photo_unit_price, 2);?></span></p>
                </li>
                <li>
                    <p class="head">总       价： </p>
                    <p class="text"><span>￥<?php echo number_format($photo_unit_price * $photo_count, 2);?></span></p>
                </li>
                <li>
                    <p class="head">优       惠： </p>
                    <p class="text"><span>￥<?php echo number_format($photo_unit_price * $photo_count - $order['need_pay'], 2) ?></span></p>
                </li>
                <li>
                    <p class="head">积分抵换：</p>
                    <p class="text"><span><?php echo $order['score_favorable'] != 0 ? '￥'.$order['score_favorable'] : '无' ?></span></p>
                </li>
            </ul>
        <?php endif?>

        <div class="bottom-cont">
            <p class="count">应付金额：<span>￥ <?php echo $order['need_pay'];?> </span></p>

            <a href="javascript:;" class="weix checkout"  id="pay">立即付款</a>

        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->

    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([
           '<?php echo css_js_url('pay.js', 'wap')?>'
        ], function(pay){
			pay.init('<?php echo $jsbridge_str?>', '<?php echo $order_id?>')
		})
    </script>
</body>
</html>

