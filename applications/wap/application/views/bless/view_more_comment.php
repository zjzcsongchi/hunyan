
    <?php if($bless_comment):?>
    <?php foreach ($bless_comment as $k => $v):?>
        <div class="list">
            <div class="head2"><img src="<?php echo $v['head_img']?>"></div>
            <div class="list-cont">
                <div class="con">
                    <p class="name"><?php echo $v['name']?><span><?php echo $v['time']?></span></p>
                    <p class="laud <?php echo $v['is_had_zan'] ? 'act' : '' ?>" bless_comment_id=<?php echo $v['id']?> ><i>+1</i><span><?php echo $v['zan_count']?></span></span></p>
                </div>
                <p class="text"><?php echo $v['content']?></p>
            </div>
        </div>
    <?php endforeach;?>
    <?php endif;?>