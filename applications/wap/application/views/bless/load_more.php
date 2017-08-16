<?php if($bless):?>
<?php foreach ($bless as $k => $v):?>
<li>
    <div class="head1"><img src="<?php echo $v['head_img']?>"></div>
    <div class="cont">
        <div class="con">
            <p class="name"><?php echo $v['name']?><span><?php echo $v['time']?></span></p>
            <p class="laud <?php echo $v['is_had_zan'] ? 'act' : '' ?>"><i>+1</i><span><?php echo $v['zan_count']?></span></p>
            <span class="line"></span>
            <p class="coment" is_had_view="0"><?php echo $v['comment_count']?></p>
        </div>
        <p class="text"><?php echo $v['content']?></p>
        <div class="detail-cont" blessid="<?php echo $v['id']?>">
            <div class="con">
                <input>
                <button blessid="<?php echo $v['id']?>" class="send_comment">发送</button>
            </div>
        </div>
    </div>
</li>
<?php endforeach;?>
<?php endif;?>