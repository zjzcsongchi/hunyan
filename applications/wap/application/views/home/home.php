<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('m-wap.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('m-banquet.css', 'wap')?>">
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                <!-- home -->
                    <div class="video-cont">                        
                        <video loop src="<?php echo get_vedio_url($about['index_vedio_url'])?>" id="media" style="position: absolute; width: 100%;left: 50%;margin-left: -50%;top:0;z-index: 2; object-fit:cover;" type="video/mp4">
                            <source src="<?php echo get_vedio_url($about['index_vedio_url'])?>" type="video/mp4">
                        </video>
                        <img class="act" src="<?php echo $domain['static']['url'].'/wap/images/m-banner.jpg'?>">
                        <i class="act"></i>
                        <div class="baner-title"><img src="<?php echo $domain['static']['url'].'/wap/images/baner-title.png'?>"></div>       
                    </div>
 

                    <div class="search"><input type="text"><p class="act">百年幸福厅</p></div>
                    <?php if(isset($dinner) && $dinner):?>
                    <ul class="banquet-list">
                        <?php foreach ($dinner as $k=>$v):?>
                            <li>
                                <p class="top-bg"></p>
                                <?php if($v['venue_type'] == C('party.wedding.id')):?>
                                    <a href="/today/detail?id=<?php echo $v['id']?>">
                                            <i class="click-but"></i>
                                            <img src="<?php echo !empty($v['img']) ?  get_img_url($v['img'][0]) : $domain['static']['url'].'/wap/images/default-banner1.jpg'?>">
                                    </a>
                                    <p class="name">新郎：<?php echo $v['roles_main']?>  &  新娘：<?php echo $v['roles_wife']?></p>
                                    <p><span class="icon1">直</span><span class="icon2">互</span><span class="icon3">￥</span></p>
                                <?php elseif ($v['venue_type'] == C('party.birthday.id')):?>
                                    <a href="/venue/detail?id=<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?><?php echo $vv['id']?><?php endforeach;?><?php endif;?><?php endforeach;?>">
                                            <i class="click-but"></i>
                                            <img src="<?php echo !empty($v['img']) ?  get_img_url($v['img'][0]) : $domain['static']['url'].'/wap/images/default-birthday.jpg'?>">
                                    </a>
                                    <p class="name">生日：<?php echo $v['roles_main']?></p>
                                    
                                <?php elseif ($v['venue_type'] == C('party.shouyan.id')):?>
                                    <a href="/venue/detail?id=<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?><?php echo $vv['id']?><?php endforeach;?><?php endif;?><?php endforeach;?>">
                                            <i class="click-but"></i>
                                            <img src="<?php echo !empty($v['img']) ?  get_img_url($v['img'][0]) : $domain['static']['url'].'/wap/images/default-old.jpg'?>">
                                    </a>
                                    <p class="name">寿星：<?php echo $v['roles_main']?></p>
                                    
                                <?php elseif ($v['venue_type'] == C('party.champion.id')):?>
                                    <a href="/venue/detail?id=<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?><?php echo $vv['id']?><?php endforeach;?><?php endif;?><?php endforeach;?>">
                                            <i class="click-but"></i>
                                            <img src="<?php echo !empty($v['img']) ?  get_img_url($v['img'][0]) : $domain['static']['url'].'/wap/images/default-champion.jpg'?>">
                                    </a>
                                    <p class="name">状元：<?php echo $v['roles_main']?></p>
                                    
                                <?php elseif ($v['venue_type'] == C('party.bairiyan.id')):?>
                                    <a href="/venue/detail?id=<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?><?php echo $vv['id']?><?php endforeach;?><?php endif;?><?php endforeach;?>">
                                            <i class="click-but"></i>
                                            <img src="<?php echo !empty($v['img']) ?  get_img_url($v['img'][0]) : $domain['static']['url'].'/wap/images/default-hundred.jpg'?>">
                                    </a>
                                    <p class="name">宝贝：<?php echo $v['roles_main']?></p>    
                               
                                <?php elseif ($v['venue_type'] == C('party.manyuejiu.id')):?>
                                    <a href="/venue/detail?id=<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?><?php echo $vv['id']?><?php endforeach;?><?php endif;?><?php endforeach;?>">
                                            <i class="click-but"></i>
                                            <img src="<?php echo !empty($v['img']) ?  get_img_url($v['img'][0]) : $domain['static']['url'].'/wap/images/default-baby.jpg'?>">
                                    </a>
                                    <p class="name">宝贝：<?php echo $v['roles_main']?></p>    
                               
                                <?php elseif ($v['venue_type'] == C('party.qiaoqianyan.id')):?>
                                    <a href="/venue/detail?id=<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?><?php echo $vv['id']?><?php endforeach;?><?php endif;?><?php endforeach;?>">
                                            <i class="click-but"></i>
                                            <img src="<?php echo !empty($v['img']) ?  get_img_url($v['img'][0]) : $domain['static']['url'].'/wap/images/default-home.jpg'?>">
                                    </a>
                                    <p class="name">房主：<?php echo $v['roles_main']?></p>  
                                    
                                <?php elseif ($v['venue_type'] == C('party.nianhui.id')):?>
                                    <a href="/venue/detail?id=<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?><?php echo $vv['id']?><?php endforeach;?><?php endif;?><?php endforeach;?>">
                                            <i class="click-but"></i>
                                            <img src="<?php echo !empty($v['img']) ?  get_img_url($v['img'][0]) : $domain['static']['url'].'/wap/images/default-qiye.jpg'?>">
                                    </a>
                                    <p class="name">企业：<?php echo $v['roles_main']?></p>
                                    
                                 <?php elseif ($v['venue_type'] == C('party.lingcan.id')):?>
                                    <a href="/venue/detail?id=<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?><?php echo $vv['id']?><?php endforeach;?><?php endif;?><?php endforeach;?>">
                                            <i class="click-but"></i>
                                            <img src="<?php echo !empty($v['img']) ?  get_img_url($v['img'][0]) : $domain['static']['url'].'/wap/images/default-food.jpg'?>">
                                    </a>
                                    <p class="name">零餐：<?php echo $v['roles_main']?></p>  
                                    
                                <?php endif;?>
                                <p class="text">时间：<?php echo $v['solar_time'].' '.$v['banquet_time']?></p>
                                <p class="text">地址：安顺市中华东路103号百年婚宴</p>
                                <div class="text"><a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&output=html&src=百年婚宴"><i></i></a></div>
                                <p class="date"><?php echo $v['solar_time']?></p>
                                <p class="icon">宴会厅：<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?> <?php echo $vv['name']?><?php endforeach;?> <?php endif;?> <?php endforeach;?></p>
                                <a href="/bless/index?id=<?php echo $v['id'];?>" class="but">
                                    <i class="myfirst"></i>
                                    <p class="send-text">发送祝福</p>
                                </a>                            
                            </li>
                          <?php endforeach;?>
                    </ul>
                      <?php else:?>
                      <div class="no-banquet"><img src="<?php echo $domain['static']['url']?>/wap/images/m-no_dinner.jpg"></div>
                      <?php endif;?>
                    <!-- footer -->
                    <?php $this->load->view('common/new_footer')?>
                    <!-- footer -->

                </div>   
            </div>
        </div>
        
    </div>
    <?php $this->load->view('common/jsfooter')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <script type="text/javascript">
    seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>'], function(p){
		p.load();
    $(function(){
          $(".search input").focusin(function() {
              $(this).parent().children("p").removeClass("act");
          });
          $(".search input").focusout(function() {
              $(this).parent().children("p").addClass("act");
          });
    
          var myVideo=document.getElementById("media");
          $(".video-cont i").click(function() {
              $(this).removeClass("act");
              $(".video-cont img").removeClass("act");
              myVideo.play();
          });

          $(".video-cont").click(function() {
               $(".video-cont i").removeClass("act");
               $(".video-cont img").removeClass("act");
               myVideo.play();
          });
          
      });
    })
    </script>
</body>
</html>
