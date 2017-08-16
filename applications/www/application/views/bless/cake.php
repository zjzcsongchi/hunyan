<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('bless_cake.css', 'www')?>">
    <?php $this->load->view('common/baidu_tongji')?>
</head>
<body>
    <input type="hidden" id="last_id" value="<?php echo $last_id?>">
    <input type="hidden" id="flower_last_id" value="0">
    <input type="hidden" id="cake_last_id" value="0">
    <div class="page-main" style="background-image: url(<?php echo $domain['static']['url'].'/www/images/bless_bg.jpg'?>);">
        <div class="main">
            <div class="left-cont">
                <div class="fg-box annual" id="box">
                    <dl>        

                        <?php foreach ($comment as $k=>$v):?>
                        <dd>
                            <img src="<?php echo get_img_url($v['head_img'])?>">
                            <div class="cont">
                                <p class="name"><?php echo $v['name']?><span class="r"><?php echo $v['time']?></span></p>
                                <p class="text"><?php echo $v['content']?></p>
                            </div>                 
                        </dd>
                        <?php endforeach;?>
                        
                    </dl>
                </div>
            </div>
            <div class="right-cont">
                <div class="img-cont">
                    <div class="banner">
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
                    <div class="name"><?php echo $bless_info['roles_main']?></div>
                    <div class="get-cont">
                        <i class="flower"></i>
                        <span>共收到的鲜花  <i id="flower_count_true"><?php echo $bless_info['flower_count']?></i></span>
                        <i class="icon"></i>
                    </div>
                    <div class="praises" id="zan_count"><?php echo $bless_info['zan_count']?></div>
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
                <div class="rank rank2">
                    <p class="head">-本月寿星-</p>
                    <ul id="cake_rank">
                        <?php foreach ($birth_role as $k=>$v):?>
                        <li id="admin_<?php echo $v['id']?>" data-id="<?php echo $v['all_num']?>"  <?php if($k>4):?> style="display:none"<?php endif;?>>
                        <i <?php if($k == 0):?>class="first"<?php elseif($k == 1):?>class="second"<?php elseif($k == 2):?>class="third"<?php else:?> class="text" <?php endif;?>>
                        </i>
                        <?php if(!empty($v['head_img'])):?>
                        <img src="<?php echo get_img_url($v['head_img'])?>">
                        <?php else:?>
                        <img src="<?php echo C('domain.static.url').'/www/images/user.png';?>">
                        <?php endif;?>
                        <span><?php echo $v['fullname']?></span><p><?php echo $v['all_num']?></p></li>
                        <?php endforeach;?>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div>
        <div class="cake">
        
        </div>
    </div>
    
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    	var dinner_id = "<?php echo $dinner_id;?>";
        seajs.use(['<?php echo css_js_url('cake.js', 'www')?>' ,'<?php echo css_js_url('vmc.slider.full.min.js', 'www')?>', '<?php echo css_js_url('anime.js', 'www')?>'], function(a){
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
