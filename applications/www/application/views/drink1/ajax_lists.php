<?php if(isset($lists) && $lists):?>
    <ul class="venue-list">
    <?php foreach ($lists as $k => $v):?>
    
        <?php 
            if(($k+1)%5 == 0){
                $flag = 1;
            }else{
                $flag = 0;
            }
            
        ?>
        <li <?php if($flag == 1):?>style="margin-right: 0px;"<?php endif;?> data_id="<?php echo $v['id']?>">
            <?php if($v['is_promotion']):?>
                <em>促<br>销</em>
            <?php endif;?>
            <img class="lazy" src="<?php echo get_img_url($v['cover_img']) ?>">
            <p class="title">【<?php echo $v['title'] ;?>】</p>
            <p class="icon">
            <?php if(isset($v['flag']) && $v['flag'] ):?>
            <?php foreach ($v['flag'] as $key=>$val):?>
            <span><?php echo $val?></span>
            <?php endforeach;?>
            <?php endif;?>
            </p>
            <div class="price">¥<span> <?php echo $v['present_price'];?></span>/ <?php echo $v['unit'] ;?><p>批发价<i></i></p></div>
        </li>
    <?php endforeach;?>
    </ul>
<?php endif;?>