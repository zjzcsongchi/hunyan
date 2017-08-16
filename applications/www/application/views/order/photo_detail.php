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
                <p class="max-title borno">立即结算
                    <a href="javascript:window.history.go(-1)">
                        <i class="arow"></i>
                    </a>
                </p>
                <div class="album-order">
                    <div class="brife"><p class="z">总</p>共选中<span><?php echo $photo_count;?></span>张照片<p class="h">惠</p>百年婚宴免费赠送<span><?php echo $free_photo_num;?></span>张</div>
                    <ul class="album-info">
                        <li>
                            <p class="head">联系人：</p>
                            <p><?php echo $addr['name']?></p>
                        </li>
                        <li>
                            <p class="head">联系电话：</p>
                            <p><?php echo $addr['mobile_phone']?></p>
                        </li>  
                        <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                        <li>
                            <p class="head">收货地址：</p>
                            <p><?php echo $addr['address']?></p>
                        </li>
                        <?php endif?>
                        
                        <li>
                            <p class="head">当前积分：</p>
                            <p><span><?php echo isset($score['score']) ? $score['score'] : 0?></span></p>
                            <a href="javascript:;" class="text rule-but">积分兑换规则？</a>
                        </li>
                        <li>
                            <p class="head">已使用：</p>
                            <p><span><?php echo (int)$order['score_favorable']?></span></p>
                            <a href="javascript:;" class="but unable">已使用<i></i></a>
                        </li>
                    </ul>
                </div>
                <div class="album-order">
                    <div class="price">
                        <del>原价：￥<?php echo number_format($need_pay + $score_favorable + $favorable - $delivery_price, 2);?></del>
                        <span>优惠：￥<?php echo $favorable?></span>
                    </div>
                    <?php if($order['status'] == C('order.pay_status.success.id') ):?>
                        <a href="javascript:;" class="but-buy unable">已支付</a>
                    <?php else:?>   
                        <a href="javascript:;" class="but-buy checkout">立即付款</a>
                    <?php endif?>
                    
                    <p class="count">￥<?php echo $need_pay?></p>
                </div>
                <p class="max-title borno">订单所含照片</p>
                <ul class="album-list order-buy">
                <?php foreach ($album_photos as $k => $v) :?>
                    <li style="width:268px" data-id="<?php echo $v['id']?>">
                        <img src="<?php echo get_img_url($v['sy_img'])?>">
                        <div class="bg"></div>
                        <a href="javascript:;" class="down">查看原图</a>
                    </li>
                <?php endforeach;?>
                </ul>
                <input type="hidden" name='order_id' id='order_id' value="<?php echo $order['id']?>" />
            </div>
        </div>
    </div>

    
    
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([
           '<?php echo css_js_url('order.js', 'www')?>'
        ], function(order){
          order.load();
          order.view_HD_picture();

		})
    </script>

</body>
</html>
