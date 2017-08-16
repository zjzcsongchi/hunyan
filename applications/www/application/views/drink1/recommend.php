<?php if(isset($recommend_lists)):?>
<?php foreach ($recommend_lists as $k=>$v):?>


    <li <?php if($k == 4):?>style="margin-right: 0px;"<?php endif;?> data-id="<?php echo $v['id']?>" class="about_li">
        <em>促<br>销</em>
        <img src="<?php echo get_img_url($v['cover_img'])?>">
        <p class="title"><?php echo $v['title']?></p>
        <div class="price">¥<span><?php echo number_format($v['present_price'], 2)?></span>/<?php echo $v['unit']?><p>批发价<i></i></p></div>
    </li>
    
<?php endforeach;?>
<?php endif;?>