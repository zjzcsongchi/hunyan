<?php if(isset($lists) && $lists):?>
<?php foreach ($lists as $k => $v):?>
<li>
    <?php if(isset($v['dinner_id'])):?>
    <a class="project_card" href="/today/detail?id=<?php echo $v['dinner_id']?>">
    <?php else:?>
    <a class="project_card" href="/today/detail?id=<?php echo $v['id']?>">
    <?php endif;?>
        <img src="<?php echo $v['m_cover_img'] ?  get_img_url($v['m_cover_img']) : $domain['static']['url'].'/wap/images/default-banner1.jpg'?>">
        <p class="name"><?php echo $v['roles_main']?> & <?php echo $v['roles_wife']?></p>
        <div class="cont">
            <p class="l">
                <?php if(isset($venue_new) && $venue_new):?>
                <?php echo $venue_new['name']?>
                <?php else:?>
                <?php if(isset($venue[$v['id']][0])):?><?php echo $venue[$v['id']][0]?>
                <?php endif;?>
                <?php endif;?>
            </p>
            <p class="r"><?php echo $v['solar_time']?></p>
        </div>
        <div class="shoadw"></div>
    </a>
</li>
<?php endforeach;?>
<?php endif;?>