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
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
<style>
.order-list .cont {
    padding: 0.3rem;
}
.order-list .act{
    border: solid 0.05rem #ffb700;
}
</style>
</head>

<body class="grey">
    <div class="page-main padbot100">
        <div class="frame-info">
            <div class="img-cont"><img src="<?php echo get_img_url($msg['cover_img'])?>"></div>
            <div class="brife">
                <p class="title"><?php echo $msg['title']?></p>
                <p class="price">￥<?php if(isset($type)){echo $type['version_price'];}else{echo $msg['present_price'];}?></p>
            </div>
        </div>
        <div class="page-main order" style=" min-height: 0; padding-bottom: 0.2rem;">
        <p class="max-title">相片订单</p>
            <ul class="frame-order">
            <?php foreach ($list as $k => $v):?>
                <li data-id="<?php echo $v['id'];?>">
                    <i></i><img src="<?php echo get_img_url($v['cover_img'])?>">
                    <div class="cont">
                        <p class="title">订单号  <?php echo $v['order_id'];?></p>
                        <p class="text">总共 <?php echo $v['num'];?> 张照片</p>
                    </div>
                </li>
            <?php endforeach;?>
            </ul>
        </div>
        <div class="user-cont">            
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
                    <select name="delivery_type">
                        <?php foreach (C('order.delivery_type') as $k => $v):?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                        <?php endforeach;?>
                    </select>
                </li>
                <li class="post_method"  data="<?php echo C('order.delivery_type.express.price')?>">
                    <p class="head">邮费：</p>
                    <p><span>￥<?php echo C('order.delivery_type.express.price')?></span></p>
                </li>
                <li class="post_method">
                    <p class="head">收货地址：</p>
                    <textarea id="address" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x6536;&#x8D27;&#x5730;&#x5740;"><?php if(isset($addr['address'])){echo $addr['address'];}?></textarea>
                </li>
            </ul>
        </div>
        
        <input type="hidden" id="product_id" value="<?php echo $product_id;?>">
        <input type="hidden" id="num" value="<?php echo $num;?>">
        <div class="bottom-cont">
            <div class="car"><p><?php echo $num?></p></div>
            <p class="text">皮质相册</p>
            <a href="javascript:;"  class="but payment">立即结算</a>
            <p id="price" class="price">￥<?php echo $price;?></p>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('album_detail.js', 'wap')?>'], function(p,album){
            p.load();
            album.select();
            album.add();
            album.select_order();
        })
    </script>
</body>
</html>