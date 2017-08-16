<?php if(isset($cake)):?>
    <?php foreach ($cake as $k => $v):?>
        <li>
            <p class="tip"><?php echo (($page-1)*10+($k+1));?></p>
            <img src="<?php echo $v['head_img'];?>">
            <p class="list-name"><?php echo $v['username']?></p>
            <p class="count"><?php echo $v['nums']?></p>
        </li>
    <?php endforeach;?>
<?php endif;?>