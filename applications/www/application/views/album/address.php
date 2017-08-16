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
                    <div class="brife"><p class="z">总</p>共选中<span id="chosen_num">0</span>张照片<p class="h">惠</p>百年婚宴免费赠送<span id="free_num">10</span>张</div>
                    <ul class="album-info">
                        <li>
                            <p class="head">联系人：</p>
                            <input id='addr_name' type="text" value="<?php echo isset($addr['name']) ? $addr['name'] : ''?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x771F;&#x5B9E;&#x59D3;&#x540D;">
                        </li>
                        <li>
                            <p class="head">联系电话：</p>
                            <input id='addr_mobile_phone' type="tel" value="<?php echo isset($addr['mobile_phone']) ? $addr['mobile_phone'] : ''?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x8054;&#x7CFB;&#x7535;&#x8BDD;">
                        </li>
                        <li>
                            <p class="head">当前积分：</p>
                            <p><span id='score'><?php echo isset($score) ? $score : 0?></span></p>
                            <a href="javascript:;" class="text rule-but">积分兑换规则？</a>
                        </li>
                        <li>
                            <p class="head">可使用：</p>
                            <p id='available_score'><?php echo isset($available_score) ? $available_score : 0?></p>
                            <a href="javascript:;" class="but touse">立即使用<i></i></a>
                        </li>
                        <input type="hidden" id='available_quota' value="<?php echo $available_quota;?>">
                        <input id="dinner_id" name="dinner_id" type="hidden" value="<?php echo isset($dinner_id) ? $dinner_id : 0?>" >

                    </ul>
                </div>
                <div class="album-order">
                    <div class="price">
                        <del>原价：￥<b id='original_price'></b></del><span>优惠：￥<b id="free_price"></b></span>
                    </div>
                    <a href="javascript:;" class="but-buy payment">立即支付</a>
                    <p class="count">￥<b id="pay_price">0.00</b></p>
                </div>
                <p class="max-title borno">
                                        订单所含照片
                <!--<a href="javascript:;" class="revoke">撤销删除</a>-->
                </p>
                <ul class="album-list order order-album">
                <?php foreach ($album_photos as $k => $v) :?>
                    <li data-id="<?php echo $v['id']; ?>">
                        <img src="<?php echo get_img_url($v['sy_img'])?>">
                        <i></i>
                    </li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>

    
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
		var unitPrice = <?php echo C('order.product_type.image.unit_price');?>; 
        seajs.use([
           '<?php echo css_js_url('address.js', 'www')?>','<?php echo css_js_url('pinterest_grid.js', 'www')?>'
        ], function(address){
          	address.load();
        	address.deletePhoto();
          	address.payment();
          	$(".order-album").pinterest_grid({
                no_columns: 3,
                padding_x: 10,
                padding_y: 10,
                margin_bottom: 30,
                single_column_breakpoint: 700
            });
		})
    </script>

</body>
</html>
