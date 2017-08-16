<div class="about-banner">
    <img src="<?php echo $domain['static']['url'];?>/www/images/about_bg.jpg"  />
    <div class="banner-cont">
        <img src="<?php echo $domain['static']['url'];?>/www/images/about.png" />
        <a href="javascript:;">立即前往</a>
    </div>
</div>
<div class="about-nav">
    <div class="nav-cont">
        <a href="/guide/about" <?php if($cur_page == 'about'){ echo "class='act'"; } ?>>关于我们</a>
        <a href="/guide/contact" <?php if($cur_page == 'contact'){ echo "class='act'"; } ?>>联系我们</a>
        <a href="/guide" <?php if($cur_page == 'index'){ echo "class='act'"; } ?>>帮助中心</a>
    </div>
</div>