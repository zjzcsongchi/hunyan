<?php if(isset($news_lists) && $news_lists):?>
        <div class="swiper-container swiper-container1 ">
            <div class="swiper-wrapper">
            <?php foreach ($news_lists as $k=>$v):?>
                <div class="swiper-slide">
                    <a href="/news/detail/<?php echo $v['id']?>">
                    <img src="<?php echo get_img_url($v['cover_img'])?>">
                    </a>
                    <p class="icon2">阅读  <?php echo $v['read']?></p>
                    <?php 
                        if(mb_strlen($v['title'])>15){
                            $v['title'] = mb_substr($v['title'],0,15,'utf-8').'..';
                        }
                    
                    ?>
                    <p class="title"><?php echo $v['title']?></p>
                    <p class="text"><?php echo $v['summary']?></p>
                </div>
            <?php endforeach;?>    
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-next1"></div>
            <div class="swiper-button-prev swiper-button-prev1"></div>
        </div>
        <ul class="site-piclist ">
        <?php foreach ($news_lists as $k=>$v):?>
        <a href="/news/detail/<?php echo $v['id']?>">
            <li>
                <img src="<?php echo get_img_url($v['cover_img'])?>">
                <p class="icon2">阅读  <?php echo $v['read']?></p>
                <p class="title"><?php echo $v['title']?></p>
                <p class="text"><?php echo $v['summary']?></p>
            </li>
        </a>
       <?php endforeach;?>    
       </ul>
<?php endif;?>