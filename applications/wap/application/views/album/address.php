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
    <link href="<?php echo css_js_url('wap-user-new.css', 'wap');?>" type="text/css" rel="stylesheet" />
</head>

<body>
    <div class="page-main padbot100">        
        <div class="album-cont">
            <p class="max-title">订单所含照片<a href="javascript:;" class="del" id="del">删除</a></p>
            <ul class="user-list1 album-list order">
            <?php foreach ($album_photos as $k=>$v):?>
                <li class="list" id="<?php echo $v['id']?>" data-id="<?php echo $v['id']?>">
                    <img src="<?php echo get_img_url($v['sy_img'])?>" data-id="<?php echo $v['id']?>"><i class="active"></i>
                    <i class="active"></i>

                </li>
            <?php endforeach;?>
            </ul>
        </div>
        <div class="page-bg"></div>
        <div class="rule-popup">
            <p class="title">积分兑换规则</p>
            <div class="cont">
                <p class="head">如何积分获取</p>
                <div class="close"></div>
                <p class="text">1.钻石小鸟会员凭卡消费可累计积分，100元置换1分，积分累计无上限；消费完成后即自动激活成为可用积分；积分的数值精确到个位（小数点后全部舍弃，不进行四舍五入）例如购买商品实际支付总价为999元，积分累计9分；</p>
                <p class="text">2.推荐好友成功消费一次，可获相当于好友消费积分0.5倍的推荐积分；</p>
                <p class="text">3.登陆小鸟官网，参与小鸟积分活动，可获得活动积分（详情规则可参考活动细则）；</p>
                <p class="text">4.完善用户资料，所有选项均填写保存成功后可获得10分；</p>
                <p class="text">5.用户在钻石小鸟体验中心完成交易日起一个月内或货品签收日起后的一个月内成功提交评论可获得2分； </p>                
            </div>
        </div>
        <div class="bottom-cont">
            <input id="dinner_id" name="dinner_id" type="hidden" value="<?php echo isset($dinner_id) ? $dinner_id : 0?>" >
            <div class="car"><p id="car">0</p></div>
            <p class="text">剩余免费张数<span id='available_quota' data-available_quota="<?php echo $available_quota;?>"><?php echo $available_quota;?></span></p>
            <a href="javascript:;" class="but address">立即结算</a>
            <a href="javascript:;" class="but payment" style="display: none">去付款</a>
            <p class="price"><span>￥</span><span id='pay_price'>0.00</span></p>
        </div>
        
        <div class="popup-bottom">
            <div class="close"></div>
            <div class="user-cont album-order">
                <p class="max-title">填写收货信息</p>
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
                </ul>
            </div>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
	var unitPrice = <?php echo C('order.product_type.image.unit_price');?>; 
        seajs.use([
           '<?php echo css_js_url('address.js', 'wap')?>',
        ], function(address){
          	address.load();
        	address.deletePhoto();
          	address.removePhoto();
          	address.address();
          	address.payment();
		})
    </script>
    
</body>
</html>
