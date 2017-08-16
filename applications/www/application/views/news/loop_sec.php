<?php if(isset($say)):?>
<?php foreach ($say as $k =>$v):?>
<li>
    <img src="<?php if(isset($v['head_img'])){echo get_img_url($v['head_img']);}else{echo C('domain.static.url').'/wap/images/touxiang.png';}?>">
    <div class="list-cont">
        <div class="cont">
            <div class="name"><?php if(isset($v['realname'])){echo $v['realname'];}?><p><?php echo $v['create_time']?></p></div>
            <p data="<?php echo $v['id']?>" class="icon icon1"><?php echo $v['zan_count']?></p>
        </div>
        <p class="text"><?php echo $v['content']?></p>
    </div>
</li>
<?php endforeach;?>
<?php endif;?>