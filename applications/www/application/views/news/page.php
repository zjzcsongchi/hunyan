<?php if(isset($say)):?>
<?php foreach ($say as $k => $v):?>
<li>
    <img src="<?php if(isset($v['head_img'])){echo get_img_url($v['head_img']);}else{echo C('domain.static.url').'/wap/images/touxiang.png';}?>">
    <div class="list-cont">
        <div class="cont">
            <div class="name"><?php if(isset($v['realname'])){echo $v['realname'];}?><p><?php echo $v['create_time']?></p></div>
            <p data="<?php echo $v['id']?>" class="icon icon1"><?php echo $v['zan_count']?></p>
            <p id="toatal_<?php echo $v['id']?>" data="<?php echo $v['id'];?>" class="icon icon2"><?php if(isset($v['son'])){echo count($v['son']);}else{echo 0;}?></p>
        </div>
        <p class="text"><?php echo $v['content']?></p>
        <div class="list-detail">
            <textarea id="sec_<?php echo $v['id']?>" placeholder="&#x8F93;&#x5165;&#x4F60;&#x7684;&#x8BC4;&#x8BBA;&#x2026;&#x2026;"></textarea>
            <div class="cont">
                <span class="text_long"></span>
                <a href="javascript:;" class="list-but cancel">关闭</a>
                <a href="javascript:;" type="sec" data-id="<?php echo $v['id']?>" class="list-but but1">评论</a>
                <div id="have_two_<?php echo $v['id']?>">
                    <?php if(isset($have_sec_two)):?>
                    <input id="say_code_<?php echo $v['id'];?>" type="text" />
                    <img class="sec_code" id="sec_code_<?php echo $v['id']?>" data="<?php echo $v['id']?>" src="">
                    <?php endif;?>
                </div>
            </div>
            <?php if(isset($v['son']) && ceil(count($v['son'])/6)>1 ):?>
            <div class="cont">
                <span class="flag">第1页</span><span>/共<?php echo ceil(count($v['son'])/6);?>页</span>
                <div data="1" class="pages"> 
                    <?php for($i=1;$i<=ceil(count($v['son'])/6);$i++):?>
                    <a class="sec-page <?php if($i == 1){echo 'act';}?>" data="<?php echo $v['id']?>" href="javascript:;"><?php echo $i?></a>
                    <?php endfor;?>                                        
                    <a type="back" data="<?php echo $v['id']?>" href="javascript:;" class="but">上一页</a>                                            
                    <a type="go" data="<?php echo $v['id']?>" href="javascript:;" class="but">下一页</a>
                </div>
            </div>
            <?php endif;?>
            <ul id="p_<?php echo $v['id']?>" class="list1">
            <?php if(isset($v['son'])):?>
            <?php foreach ($v['son'] as $kk => $vv):?>
                <?php if($kk <=5):?>
                <li>
                    <img src="<?php if(isset($vv['head_img'])){echo get_img_url($vv['head_img']);}else{echo C('domain.static.url').'/wap/images/touxiang.png';}?>">
                    <div class="list-cont">
                        <div class="cont">
                            <div class="name"><?php if(isset($vv['realname'])){echo $vv['realname'];}?><p><?php echo $vv['create_time']?></p></div>
                            <p data="<?php echo $vv['id']?>" class="icon icon1"><?php echo $vv['zan_count']?></p>
                        </div>
                        <p class="text"><?php echo $vv['content']?></p>
                    </div>
                </li>
                <?php endif;?>
            <?php endforeach;?>
            <?php endif;?>
            </ul>
        </div>
    </div>
</li>
<?php endforeach;?>
<?php endif;?>