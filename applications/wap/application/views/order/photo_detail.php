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

<body>
    <div class="page-main padbot100">
        <div class="user-cont album-order">
            <div class="brife"><p class="z">总</p>共选中<span><?php echo $photo_count;?></span>张照片</div>
            <div class="brife"><p class="h">惠</p>百年婚宴免费赠送<span><?php echo $free_photo_num;?></span>张</div>
            <ul class="album-info">
                <li>
                    <p class="head">联系人：</p>
                    <p><?php echo $addr['name']?></p>
                </li>
                <li>
                    <p class="head">联系电话：</p>
                    <p><?php echo $addr['mobile_phone']?></p>
                </li>
                <li>
                    <p class="head">当前积分：</p>
                    <p><span><?php echo isset($score['score']) ? $score['score'] : 0?></span></p>
                    <a href="javascript:;" class="text">积分兑换规则？</a>
                </li>
                <li>
                    <p class="head">已使用：</p>
                    <p><?php echo (int)$order['score_favorable']?></p>
                    <a href="javascript:;" class="but used">已使用</a>
                </li>
            </ul>
        </div>
        <div class="album-cont">
            <p class="max-title">订单所含照片</p>
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
            <div class="car"><p><?php echo count($album_photos)?></p></div>
            <p class="text">剩余免费张数<span><?php echo $available_quota ?></span></p>
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
           
        ], function(order){
          order.load();
          order.view_HD();
		})
    </script>

</body>
</html>
