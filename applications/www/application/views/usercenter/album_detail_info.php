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

    <link href="<?php echo css_js_url('pc-public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('pc-user.css', 'www');?>" type="text/css" rel="stylesheet" />
    
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
                <p class="max-title borno">立即购买<i onclick="window.history.back()" class="arow"></i></p>
                <div class="album-order">
                    <div class="frame-info">
                        <img src="<?php echo get_img_url($msg['cover_img'])?>">
                        <p class="text">
                            <span><?php echo $msg['title']?></span><br>
                                                                      购买数量：<?php if(isset($num)){echo $num;}else{echo 1;}?><br>
                            <?php if(isset($info_list)):?>
                            <?php foreach ($info_list as $k => $v):?>
                            <?php echo $v['attribute']?>: <?php echo $v['value']?><br>
                            <?php endforeach;?>
                            <?php endif;?>
                        </p>
                        <p class="price">￥<?php if(isset($type)){echo $type['version_price'];}else{echo $msg['present_price'];}?></p>
                    </div>
                    <ul class="album-info">
                        <li>
                            <p class="head">联系人：</p>
                            <input type="text" id="name" value="<?php if(isset($addr['name'])){echo $addr['name'];}?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x771F;&#x5B9E;&#x59D3;&#x540D;">
                        </li>
                        <li>
                            <p class="head">联系电话：</p>
                            <input type="text" id="mobile_phone"  value="<?php if(isset($addr['mobile_phone'])){echo $addr['mobile_phone'];}?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x8054;&#x7CFB;&#x7535;&#x8BDD;">
                        </li>
                        <li>
                            <p class="head">送货方式：</p>
                            <select name="delivery_type">
                                <?php foreach (C('order.delivery_type') as $k => $v):?>
                                <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                                <?php endforeach;?>
                            </select>
                            <p id="post_title" class="head">邮费：</p>
                            <p><span id="post_price" data="<?php echo C('order.delivery_type.express.price')?>">￥<?php echo C('order.delivery_type.express.price')?></span></p>
                        </li>
                        <li id="addr">
                            <p class="head">收货地址：</p>
                            <input type="text" id="address" value="<?php if(isset($addr['address'])){echo $addr['address'];}?>" class="type1" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x6536;&#x8D27;&#x5730;&#x5740;">
                        </li>
                    </ul>
                </div>
                <p class="max-title borno">选择入册照片</p>
                <ul class="album-list order-album">
                  <?php if(isset($img_list)):?>
                  <?php foreach ($img_list as $k => $v):?>
                  <li data-id="<?php echo $v['id'];?>"><img src="<?php echo get_img_url($v['sy_img']);?>"><i></i><a href="javascript:;" data-img="<?php echo get_img_url($v['img']);?>" data-id="<?php echo $v['id'];?>" class="see">查看</a></li>
                  <?php endforeach;?>
                  <?php endif;?>
                </ul>
               
                <div class="album-order">
                    <input type="hidden" id="type_id" value="<?php if(isset($type)){echo $type['id'];}?>" />
                    <input type="hidden" id="product_id" value="<?php echo $product_id;?>">
                    <input type="hidden" id="num" value="<?php echo $num;?>">
                    <input type="hidden" id="cover_img_id" value="" />
                    <div class="price">优惠：￥<?php if(isset($msg['hui'])){echo $msg['hui'];}else{echo '0.00';}?></div>
                    <a id="but-buy" href="javascript:;" class="but-buy">立即支付</a>
                    <p class="count" data="<?php if(isset($price)){echo $price;}?>">￥<?php if(isset($price)){echo $price + C('order.delivery_type.express.price');}?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-bg"></div>
    <div class="frame-popup">
        <p class="title">立即支付</p>
        <img src="<?php echo $domain['static']['url']?>/www/images/ewm1.jpg">
    </div>
    
    <div class="see-bigimg">
        <div class="close"></div>
        <a href="javascript:;" id="set_cover_img_id" data-id="" style="z-index: 1" class="set">设置为相册封面</a>
        <div class="img"><img id="bigimg" data-id="" src=""></div>
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    seajs.use(['public', '<?php echo css_js_url('user_pc.js', 'www')?>','<?php echo css_js_url('pinterest_grid.js', 'www')?>', '<?php echo css_js_url('pic-tab.js', 'www')?>'], function(a,b){
		a.load();
		b.hidden();
		b.jump();
		b.select();
		b.submit();
		b.see(event);
		b.set_cover_img();
		$(".user-banner .edit").click(function() {
            $(".page-bg").addClass("act");
            $(".popup-userinfo").addClass("act");
        });
        $(".popup-userinfo .close").click(function() {
            $(".page-bg").removeClass("act");
            $(".popup-userinfo").removeClass("act");
        });

        $(".album-list li").click(function() {
            $(this).toggleClass("act");
        });
        
        $(".album-list li:nth-child(3n)").css("margin-right", "0");

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
