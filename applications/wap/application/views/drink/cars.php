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
    <link href="<?php echo css_js_url('wap-users.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body class="grey">
    <div class="page-main padbot100">
        <div class="drink-order">
            <div class="top">
                <p class="chose">全选</p>
                <a href="javascript:;" class="empty">清空购物车</a>
            </div>
            <ul class="drink-lists">
            </ul>
        </div>
        <div class="bottom-cont">
            <div class="car"><p id="total_num">0</p></div>
            <p class="text">已选商品<span id="num">0</span>件</p>
            <a href="javascript:;" status="0" class="but">立即结算</a>
            <p class="price" data="0.00">￥ 0.00</p>
        </div>
        <div class="popup-bottom">
            <div class="close"></div>
            <div class="user-cont">
                <p class="max-title">填写收货信息</p>                      
                <ul class="album-info">
                    <li>
                        <p class="head">收货人：</p>
                        <input type="text" id="name" value="<?php if(isset($addr['name'])){echo $addr['name'];}?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x771F;&#x5B9E;&#x59D3;&#x540D;">
                    </li>
                    <li>
                        <p class="head">电话：</p>
                        <input type="tel" id="mobile_phone"  value="<?php if(isset($addr['mobile_phone'])){echo $addr['mobile_phone'];}?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x8054;&#x7CFB;&#x7535;&#x8BDD;">
                    </li>
                    <li>
                        <p class="head">送货方式：</p>
                        <select name="delivery_type" >
                            <?php foreach (C('order.delivery_type') as $k => $v):?>
                            <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </li>
                    <li class="post_method" data="<?php echo C('order.delivery_type.express.price')?>">
                    <p class="head">邮费：</p>
                    <p><span>￥<?php echo C('order.delivery_type.express.price')?></span></p>
                    </li>
                    <li class="post_method">
                        <p class="head">收货地址：</p>
                        <textarea id="address" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x6536;&#x8D27;&#x5730;&#x5740;"><?php if(isset($addr['address'])){echo $addr['address'];}?></textarea>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('cars.js', 'wap')?>','<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('swiper.min.js', 'wap')?>'], function(a, p){
            p.load();
			a.start();
			a.clear();
            a.chose();
            a.select();
            a.pay();
            a.del();
        })
    </script>
</body>
</html>
