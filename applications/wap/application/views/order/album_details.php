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
        <p class="max-title title1">订单信息</p>        
        <ul class="pay-list">
            <li>
                <p class="head">商品：</p>
                <p class="text"><?php echo $album['title']?></p>
            </li>
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
                    <p class="text">￥<?php echo C('order.delivery_type.express.price') ?></p>
                </li>
                <li>
                    <p class="head">收货地址：</p>
                    <p class="text"><?php echo isset($addr['address']) ? $addr['address'] : '未填写'?></p>
                </li>
                <?php endif?>
        </ul>
        <ul class="pay-list">            
            <li>
                <p class="head">单       价：</p>
                <p class="text">￥<?php echo $price?></p>
            </li>
            <li>
                <p class="head">数       量：</p>
                <p class="text"><?php echo $count?><?php echo $album['unit']?></p>
            </li>
            <li>
                <p class="head">总       价：</p>
                <p class="text"><span>￥<?php echo $order['need_pay']?></span></p>
            </li>            
            <li>
                <p class="head">优       惠： </p>
                <p class="text"><?php echo $order['favorable']?></p>
            </li>
            <li>
                <p class="head">当前积分：</p>
                <p class="text"><?php echo isset($score['score']) ? $score['score'] : 0?></p>
            </li>
        </ul>

        <div class="bottom-cont">
            <p class="count">应付金额：<span>￥<?php echo $order['need_pay']?></span></p>
            <input id="order_id" name="order_id" type="hidden" value="<?php echo isset($order['id']) ? $order['id'] : 0?>" >
            <?php if($order['status'] == C('order.pay_status.success.id') ):?>
                <a href="javascript:;" class="weix unable">已付款</a>
            <?php else:?>   
                <a href="javascript:;" class="weix checkout">立即付款</a>
            <?php endif?>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([
           '<?php echo css_js_url('order.js', 'wap')?>',
           
        ], function(order){
          order.load();
          order.view_HD();
		})
    </script>
</body>
</html>
