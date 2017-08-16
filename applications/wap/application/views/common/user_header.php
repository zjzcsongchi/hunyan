<div class="user-top">
	<img src="<?php if(isset($user_info['head_img'])){echo $user_info['head_img'];}?>">
	<p class="name"><?php if(isset($user_info['nickname'])){ echo $user_info['nickname'];}?></p>
	<a href="/usercenter/info" class="edit">个人资料</a>
</div>
<ul class="user-nav">
	<li><a href="/usercenter/wedding" <?php if($url == 'wedding') echo 'class="act"'?>>我的婚礼</a></li>
	<li><a href="/usercenter/mycard" <?php if($url == 'mycard') echo 'class="act"'?>>微请帖</a></li>
	<li><a href="/usercenter/coupon" <?php if($url == 'coupon') echo 'class="act"'?>>我的优惠券</a></li>
	<li><a href="/usercenter/myorder" <?php if($url == 'myorder') echo 'class="act"'?>>我的预约</a></li>
</ul>