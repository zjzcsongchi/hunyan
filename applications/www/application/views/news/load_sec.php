<li>
    <img src="<?php if(isset($head_img)){echo get_img_url($head_img);}else{echo C('domain.static.url').'/wap/images/touxiang.png';}?>"/>
    <div class="list-cont">
        <div class="cont">
            <div class="name"><?php if(isset($user_name)){echo $user_name;}?><p><?php echo date('Y-m-d H:i');?></p></div>
            <p data="<?php echo $news_comment_id;?>" class="icon icon1">0</p>
        </div>
        <p class="text"><?php echo $content?></p>
    </div>
</li>
