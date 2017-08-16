<!-- 客户相册视图模板 -->
<?php if(isset($list)):?>
<?php foreach ($list as $k => $v):?>
<?php if(count($list) == 1):?>
<li style="width:100%;">
    <a href="/album/index?id=<?php echo $v['id']?>"><img style="height:8rem" src="<?php echo get_img_url($v['cover_img']);?>">
        <p class="title">
        <?php if(isset($v['roles_main']) && isset($v['roles_wife'])):?>
        <?php echo $v['roles_main']?>&<?php echo $v['roles_wife']?><br>
        <?php endif;?>
        <?php echo $v['name']?>
        </p>
        <p class="num" style="top: 7rem;"><?php echo $v['count']?></p>
    </a>
</li>
<?php else:?>
<li <?php if($k%2 == 0) echo 'style="float:left"';?>>
<a href="/album/index?id=<?php echo $v['id']?>">
    <img class="height200" src="<?php echo get_img_url($v['cover_img']);?>">
    <p class="title">
        <?php if(isset($v['roles_main']) && isset($v['roles_wife'])):?>
        <?php echo $v['roles_main']?>&<?php echo $v['roles_wife']?><br>
        <?php endif;?>
        <?php echo $v['name']?>
    </p>
    <p class="num"><?php echo $v['count']?></p>
</a>
</li>
<?php endif;?>
<?php endforeach;?>
<?php endif;?>