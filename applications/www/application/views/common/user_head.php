<div class="user-banner">
    <div class="cont">
        <div class="head"><img src="<?php if(isset($user_info['head_img']) && !empty($user_info['head_img'])){echo $user_info['head_img'];}else{echo $domain['static']['url'].'/www/images/head.jpg';}?>"></div>
        <div class="info">
            <div class="name">
                <?php if(isset($user_info['nickname'])){echo $user_info['nickname'];}?>
                <p class="phone"><?php if(isset($user_info['mobile_phone'])){echo $user_info['mobile_phone'];}?></p>
            </div>
            <a href="javascript:;" class="edit">编辑资料</a>
        </div>
        <ul>
            <li><span><?php if(isset($bless_num)){echo $bless_num;}else{echo 0;};?></span><br>祝福</li>
            <li><span><?php if(isset($coupon_num)){echo $coupon_num;}else{echo 0;};?></span><br>优惠券</li>
        </ul>
    </div>
</div>
<div class="page-main">
    <ul class="left-nav">
        <li><a href="usercenter/wedding" class="nav1 <?php if(isset($action) && $action == '/usercenter/wedding'){echo 'act';}?>">我的婚礼</a></li>
        <li><a href="/usercenter/user" class="nav2 <?php if(isset($action) && $action == '/usercenter/user'){echo 'act';}?>">婚礼照片</a></li>
        <li><a href="javascript:;" class="nav3">婚礼视频</a></li>
        <li><a href="javascript:;" class="nav4">我的微请帖</a></li>
        <li><a href="usercenter/coupon" class="nav5 <?php if(isset($action) && $action == '/usercenter/coupon'){echo 'act';}?>">我的优惠券</a></li>
        <li><a href="/order/index" class="nav6 <?php if(isset($action) && $action == '/order/index'){echo 'act';}?>">我的订单</a></li>
    </ul>