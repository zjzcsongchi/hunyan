<div class="user-top">
    <img src="<?php echo $domain['static']['url'];?>/www/images/user-top-bg.jpg" data-src="./assets/images/user.jpg">
    <div class="user-cont">
        <div class="head"><img src="<?php echo $info['portrait'] ? get_full_img_url($info['portrait']) : $domain['static']['url'].'/www/images/user-head.png';?>"></div>
        <div class="brife">
            <p class="name"><?php echo $info['real_name'] ? $info['real_name'] : $info['phone_number'];?></p>
            <?php if($info['auth_status'] == 2):?>
            <p class="text success"><i></i>已认证</p>
            <?php elseif($info['auth_status'] == 1):?>
            <p class="text wait"><i></i>审核中</p>
            <?php else:?>
            <p class="text"><i></i>您还没有进行身份证认证哦！为了方便您申请半价购房和半价装修，</p>
            <a href="/usercenter/authenticate">马上认证身份></a>
            <?php endif;?>
        </div>
        <ul>
            <li>
                <a href="/usercenter/message" class="mesg">
                    <div></div>
                    <p>未读消息<span><?php echo $count_no_read;?></span></p>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="grde">
                    <div></div>
                    <p>积分<span>0</span></p>
                </a>
            </li>
        </ul>
    </div>
</div>