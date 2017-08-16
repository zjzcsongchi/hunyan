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
    <div class="page-main padbot100">
        <div class="frame-info">
            <div class="img-cont"><img src="<?php echo get_img_url($album['cover_img'])?>"></div>
            <div class="brife">
                <p class="title"><?php echo $album['title']?></p>
                <?php if(isset($height) && isset($width)):?>
                <p class="text">大小：<?php echo $height;?>cm X <?php echo $width;?>cm</p>
                <?php endif?>
                <p class="price">￥<?php echo $album['present_price']?></p>
            </div>
        </div>
        <div class="user-cont">
            <ul class="album-info">
                <li>
                    <p class="head">联系人：</p>
                    <p><?php echo isset( $addr['name']) ?  $addr['name'] : '未填写'?></p>
                </li>
                <li>
                    <p class="head">电话：</p>
                    <p><?php echo isset($addr['mobile_phone']) ? $addr['mobile_phone']: '未填写'?></p>
                </li>
                <li>
                    <p class="head">送货方式：</p>
                    <p>
                        <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                            <?php echo C('order.delivery_type.express.name')?>
                        <?php else:?>
                            <?php echo C('order.delivery_type.ziti.name')?>
                        <?php endif?>
 
                    </p>
                </li>
                <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                <li>
                    <p class="head">邮费：</p>
                    <p><span>￥<?php echo C('order.delivery_type.express.price') ?></span></p>
                </li>
                <li>
                    <p class="head">收货地址：</p>
                    <p><?php echo isset($addr['address']) ? $addr['address'] : '未填写'?></p>
                </li>
                <?php endif?>

            </ul>
        </div>
        
        <div class="album-cont">
            <p class="max-title">入册照片</p>
            <ul class="user-list1 view_HD">
                <div class="wall-column">
                <?php if($album_photos_left):?>
                <?php foreach ($album_photos_left as $k => $v):?>
                <div class="list" data-id="<?php echo $v['id']?>">
                    <img src="<?php echo get_img_url($v['sy_img'])?>"/>
                    <i class="active"></i>
                </div>
                <?php endforeach;?>
                <?php endif;?>
                </div>
                <div class="wall-column">
                <?php if($album_photos_right):?>
                <?php foreach ($album_photos_right as $k => $v):?>
                <div class="list" data-id="<?php echo $v['id']?>" >
                    <img src="<?php echo get_img_url($v['sy_img'])?>"/>
                    <i class="active"></i>
                </div>
                <?php endforeach;?>
                <?php endif;?>
                </div>
               
            </ul>
        </div>

        <div class="bottom-cont">
            <div class="car"><p><?php echo $count?></p></div>
            <p class="text"><?php echo $album['title']?></p>
            <?php if($order['status'] == C('order.pay_status.success.id') ):?>
                <a href="javascript:;" class="but unable">已付款</a>
            <?php else:?>   
                <a href="javascript:;" class="but checkout">立即付款</a>
            <?php endif?>
            
            <p class="price">￥<?php echo $order['need_pay']?></p>
            <input id="order_id" name="order_id" type="hidden" value="<?php echo isset($order['id']) ? $order['id'] : 0?>" >
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([
           '<?php echo css_js_url('order.js', 'wap')?>',
        ], function(address){
          	address.load();
		})
    </script>
</body>
</html>
