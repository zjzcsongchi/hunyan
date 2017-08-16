<?php if($news_list):?>
<?php foreach ($news_list as $k => $v):?>
<a href="/news/detail?id=<?php echo $v['id']?>">
<li>
    <img src="<?php echo get_img_url($v['cover_img'])?>">
    <div class="cont">
        <p class="title"><?php echo $v['title']?></p>
        <p class="text"><?php echo $v['summary']?></p>
        <div class="con">
            <p class="l"><?php echo $v['agency']?></p>
            <p class="r icon1"><?php echo $v['read']?></p>
            <p class="r icon2"><?php echo $v['zan_number']?></p>
        </div>
    </div>
</li>
</a>
<?php endforeach;?>
<?php endif;?>