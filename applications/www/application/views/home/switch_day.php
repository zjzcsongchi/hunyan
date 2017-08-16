<ul class="banquet-list">
                    <?php if($dinner):?>
                    <?php foreach ($dinner as $k => $v):?>
                    <li>
                        <?php if($v['venue_type'] == C('party.wedding.id')):?>
                        <a href="/today/detail?id=<?php echo $v['id']?>">
                        <?php else:?>
                        <?php if(isset($v['venue']) && $v['venue']):?>
                            <a href="/venue/detail?id=<?php echo $v['venue'][0]?>">
                            <?php endif;?>
                        <?php endif;?>
                        
                         <?php if($v['venue_type'] == C('party.wedding.id')):?>
                            <img class="lazy" src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-banner1.jpg'?>" >
                            <div class="cont">
                            <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                            <p class="name">新郎：<?php echo $v['roles_main']?><br>新娘：<?php echo $v['roles_wife']?></p>
                         <?php elseif ($v['venue_type'] == C('party.birthday.id')):?>
                         
                            <img class="lazy" src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-birthday.jpg'?>" >
                            <div class="cont">
                            <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                            <p class="name">生日：<?php echo $v['roles_main']?></p>
                        
                        
                         <?php elseif ($v['venue_type'] == C('party.shouyan.id')):?>
                         <img class="lazy" src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-old.jpg'?>" > 
                         <div class="cont">
                         <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                         <p class="name">寿星：<?php echo $v['roles_main']?></p>
                         
                         <?php elseif ($v['venue_type'] == C('party.champion.id')):?>
                          <img class="lazy" src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-champion.jpg'?>" >
                          <div class="cont">
                          <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                          <p class="name">状元：<?php echo $v['roles_main']?></p>
                         
                         
                         <?php elseif ($v['venue_type'] == C('party.bairiyan.id')):?>
                          <img class="lazy" src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-hundred.jpg'?>" >
                          <div class="cont">
                          <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                          <p class="name">宝贝：<?php echo $v['roles_main']?></p>
                          
                          <?php elseif ($v['venue_type'] == C('party.manyuejiu.id')):?>
                          <img class="lazy" src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-baby.jpg'?>" >
                          <div class="cont">
                          <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                          <p class="name">宝贝：<?php echo $v['roles_main']?></p>
                         
                         <?php elseif ($v['venue_type'] == C('party.qiaoqianyan.id')):?>
                         <img class="lazy" src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-home.jpg'?>" >
                         <div class="cont">
                         <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                         <p class="name">房主：<?php echo $v['roles_main']?></p>
                         
                         
                         <?php elseif ($v['venue_type'] == C('party.nianhui.id')):?>
                         <img class="lazy" src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-qiye.jpg'?>" >
                         <div class="cont">
                         <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                         <p class="name">企业：<?php echo $v['roles_main']?></p>
                        
                         <?php elseif ($v['venue_type'] == C('party.lingcan.id')):?>
                         <img class="lazy" src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-food.jpg'?>" >
                         <div class="cont">
                         <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                         <p class="name">零餐：<?php echo $v['roles_main']?></p>
                         <?php endif;?>
                        
                            <em></em>
                            <p class="adres">宴会厅：<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?> <?php echo $vv?><?php endforeach;?> <?php endif;?> <?php endforeach;?></p>
                            <em></em>
                            <p class="text">时间：<?php echo $v['solar_time'].'  '.$v['banquet_time']?><br>地址：安顺市中华中路103号百年婚宴</p>
                            <em></em>
                            <span class="icon1">直</span>
                            <span class="icon2">互</span>
                            <span class="icon3">￥</span>
                            <p class="arrow"></p>
                        </div>
                        </a>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>