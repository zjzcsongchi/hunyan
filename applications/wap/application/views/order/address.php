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
            <div class="brife"><p class="z">总</p>共选中<span id="chosen_num"><?php echo isset($photo_count) ? $photo_count : 0?></span>张照片</div>
            <div class="brife"><p class="h">惠</p>百年婚宴免费赠送<span id="free_num">10</span>张</div>
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
                    <p class="head">送货方式：</p>
                    <select id='addr_delivery_type' >
                        <option value=0>快递送货上门</option>
                        <option value=1>到百年婚宴自提</option>
                    </select>
                </li>
                <li class='delivery_type'>
                    <p class="head">邮费：</p>
                    <p><span>￥10.00</span></p>
                </li>
                <li class='delivery_type'>
                    <p class="head">收货地址：</p>
                    <textarea id='addr_address' placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x6536;&#x8D27;&#x5730;&#x5740;"><?php echo isset($addr['address']) ? $addr['address'] : ''?></textarea>
                </li>
                <li>
                    <p class="head">当前积分：</p>
                    <p><span id='score'><?php echo isset($score) ? $score : 0?></span></p>
                    <a href="javascript:;" class="text">积分兑换规则？</a>
                </li>
                <li>
                    <p class="head">可使用：</p>
                    <p id='available_score'><?php echo isset($available_score) ? $available_score : 0?></p>
                    <a href="javascript:;" class="but touse">立即使用<i></i></a>
                </li>
            </ul>
        </div>
        <div class="album-cont">
            <p class="max-title">订单所含照片<a href="javascript:;" class="del">删除</a></p>
            <ul class="user-list1 album-list order">
                <?php foreach ($album_photos as $k => $v) :?>
                    <li data-id="<?php echo $v['id']; ?>">
                        <img class="height200" src="<?php echo get_img_url($v['sy_img'])?>">
                        <i class="active"></i>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="bottom-cont">
            <a href= "#123">
                <div class="car"><p>2</p></div>
            </a>
            <p class="text">剩余免费张数<span id='available_quota' data-available_quota="<?php echo $available_quota;?>"><?php echo $available_quota;?></span></p>
            <a href="javascript:;" class="payment but">立即结算</a>
            <p class="price"><span>￥</span><span id='pay_price'>0.00</span></p>
            
            <input id="dinner_id" name="dinner_id" type="hidden" value="<?php echo isset($dinner_id) ? $dinner_id : 0?>" >
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([
           '<?php echo css_js_url('address.js', 'wap')?>',

        ], function(address){
          	address.load();
        	address.deletePhoto();
          	address.removePhoto();
          	address.payment();
		})
    </script>

</body>
</html>
