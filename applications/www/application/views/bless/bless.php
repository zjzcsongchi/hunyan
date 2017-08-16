<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('bless_new.css', 'www')?>">
    <?php $this->load->view('common/baidu_tongji')?>
</head>
<body>
        <input type="hidden" id="last_id" value="0">
        <input type="hidden" id="flower_last_id" value="0">
    <div class="page-main" style="background-image: url(<?php echo $domain['static']['url'].'/www/images/bless_bg.jpg'?>);">
        <div class="main">
            <div class="left-cont">
                <div class="left-cont1">
                    <p class="title">-收到桃心-</p>
                    <p class="text" id="flower_count"><?php echo $bless_info['zan_count']?></p>
                </div>
                <div class="tip">
                    <p class="title">温馨提示</p>
                    <ul class="line" id="tip_info">
                        <?php foreach ($tips as $k => $v):?>   
                            <li><i></i><?php echo $v;?></li>
                        <?php endforeach;?>    
                    </ul>
                </div>
                <div class="fg-box" id="box">
                    <dl>        
                        
                    </dl>
                </div>
            </div>
            <div class="right-cont">
                <div class="img-cont">
                    <div class="banner slider" id="slider">
                        <ul class="img">
                            <?php if(isset($bless_info['album'])):?>
                            <?php foreach ($bless_info['album'] as $v):?>
                            <li>
                              <img src="<?php echo get_img_url($v);?>">
                            </li>
                            <?php endforeach;?>
                            
                            <?php elseif(isset($bless_info['m_cover_img_url'])):?>
                            <?php foreach ($bless_info['m_cover_img_url'] as $v):?>
                            <li>
                              <img src="<?php echo $v;?>">
                            </li>
                            <?php endforeach;?>
                            <?php else:?>
                            <li>
                              <img src="<?php echo C('domain.static.url').'/www/images/banner.jpg';?>">
                            </li>
                            <?php endif;?>
                        </ul>
                        <ul class="num"></ul>                            
                        <div class="btn btn_l"></div>
                        <div class="btn btn_r"></div>
                    </div>
                    <div class="date"><?php echo date('Y.m.d', strtotime($bless_info['solar_time']))?><span></span><?php echo $bless_info['lunar_time']?></div>
                    <?php if($bless_info['venue_type'] == C('party.wedding.id')):?>
                        <div class="name"><i class="men"></i><span><?php echo $bless_info['roles_main']?></span><span>＆</span><i class="women"></i><span><?php echo $bless_info['roles_wife']?></span></div>
                    <?php else:?>
                        <div class="name" style="text-align: center;"><span style="float: none;"><?php echo $bless_info['roles_main']?></span></div>
                    <?php endif;?>
                    
                    <div class="get-cont">
                        <i class="flower"></i>
                        <span>共收到的鲜花  <b id="flower_count_true"><?php echo $bless_info['flower_count']?><b></span>
                        <i class="icon"></i>
                    </div>
                    <div class="praises"><b id="zan_count" ><?php echo $bless_info['zan_count']?></b></div>
                    <div class="praises-cont">
                        <div class="icon1 left1 myfirst"></div>
                        <div class="icon2 left2 myfirst1"></div>
                        <div class="icon3 left1 myfirst2"></div>
                        <div class="icon4 left2 myfirst3"></div>
                        <div class="icon5 left1 myfirst4"></div>
                        <div class="icon6 left2 myfirst5"></div>
                        <div class="icon7 left1 myfirst6"></div>
                        <div class="icon8 left2 myfirst7"></div>
                        <div class="icon9 left1 myfirst8"></div>
                    </div>
                </div>
                <div class="rank rank1">
                    <p class="head">-献花英雄排行-</p>
                    <ul id="flower_rank">
                    <?php if(isset($flower_up)):?>
                    <?php foreach ($flower_up as $k => $v):?>
                    <li><i class="<?php if($k == 0): echo 'first'; elseif($k ==1): echo 'second'; else: echo 'third'; endif;?>"></i><img src="<?php echo $v['head_img']?>"><span><?php echo $v['name']?></span><p><?php echo $v['flower_num']?></p></li>
                    <?php endforeach;?>
                    <?php endif;?>
                    </ul>
                </div>
                <div class="rank">
                    <p class="head">-经典祝福语排行-</p>
                    <ul id="bless_rank">
                        <?php foreach ($thumbup as $k => $v):?>   
                            <li>
                                <i class="<?php echo $k == 0 ? 'first' : 'second'?>" ></i><img src="<?php echo $v['head_img'];?>"> <span><?php echo $v['name'];?></span><p>收到<?php echo $v['zan_count'];?>个赞</p>
                            </li>
                        <?php endforeach;?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        var dinner_id = "<?php echo $dinner_id;?>";
    		
        seajs.use(['<?php echo css_js_url('bless.js', 'www')?>' ,'<?php echo css_js_url('vmc.slider.full.min.js', 'www')?>'], function(a){
        	a.load();

        })
    </script>
    <script>
    
        function launchFullscreen(element) {
          if(element.requestFullscreen) {
            element.requestFullscreen();
          } else if(element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
          } else if(element.msRequestFullscreen){
            element.msRequestFullscreen();
          } else if(element.webkitRequestFullscreen) {
            element.webkitRequestFullScreen();
          }
        }

        document.onkeydown=function(event){
             var e = event || window.event || arguments.callee.caller.arguments[0];
              if(e && e.keyCode==13){ // enter 键
                 launchFullscreen(document.getElementsByClassName('page-main')[0]);
             }
         }; 
    </script>
</body>
</html>
