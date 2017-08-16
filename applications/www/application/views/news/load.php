<li>
    <img src="<?php if(isset($head_img)){echo get_img_url($head_img);}else{echo C('domain.static.url').'/wap/images/touxiang.png';}?>">
    <div class="list-cont">
        <div class="cont">
            <div class="name"><?php if(isset($user_name)){echo $user_name;}?><p>刚刚</p></div>
            <p data="<?php echo $news_comment_id;?>" class="icon icon1">0</p>
            <p class="icon icon2">0</p>
        </div>
        <p class="text"><?php echo $content?></p>
        <div class="list-detail">
            <textarea id="sec_<?php echo $news_comment_id?>" placeholder="&#x8F93;&#x5165;&#x4F60;&#x7684;&#x8BC4;&#x8BBA;&#x2026;&#x2026;"></textarea>
            <div class="cont">
                <span></span>
                <a href="javascritp:;" class="list-but cancel">关闭</a>
                <a type="sec" href="javascritp:;" data-id="<?php echo $news_comment_id?>" class="list-but but1">评论</a>
                <div id="have_two_<?php echo $news_comment_id?>">
                </div>
            </div>
            <ul id="p_<?php echo $news_comment_id?>" class="list1">
           </ul>
        </div>
    </div>
</li>