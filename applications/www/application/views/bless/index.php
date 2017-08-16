<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('bless.css', 'www');?>">
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body>
    <div class="page-main" style="background-image: url(<?php echo $domain['static']['url'].'/www/images/bless_bg.jpg'?>);">
        <div class="main">
            <div class="left-cont">
                <ul class="list1">
                    <li><span >共收到祝福</span><b id="count" ><?php echo $bless_count;?></b></li>
                    <li style="margin-right: 0px;"><?php echo $bless_info['solar_time']?></li>
                    <li><span>共收到桃心</span><b id="zan_count" ><?php echo $bless_info['zan_count']?></b></li>
                    <li style="margin-right: 0px;"><?php echo $bless_info['lunar_time']?></li>
                </ul>
                <div class="fg-box" id="box">
                    <dl>
                         

                    </dl>
                </div>
                
                <input type="hidden" id="last_id" value="0">
                <input type="hidden" id="flower_last_id" value="0">
            </div>
            <div class="right-cont">
                <div class="tip">
                    <p class="title">温馨提示</p>
                    <ul class="line" id="tip_info">
                        <?php foreach ($tips as $k => $v):?>   
                            <li><i></i><?php echo $v;?></li>
                        <?php endforeach;?>    
                    </ul>
                </div>
                <div class="rank">
                    <p class="head">-经典祝福排行-</p>
                    <ul id="bless_rank">
                    <?php foreach ($thumbup as $k => $v):?>   
                        <li>
                            <i class="<?php echo $k == 0 ? 'first' : 'second'?>" ></i><img src="<?php echo $v['head_img'];?>"> <span><?php echo $v['name'];?></span><p>收到<?php echo $v['zan_count'];?>个赞</p>
                        </li>
                    <?php endforeach;?>    
                        
                    </ul>
                </div>
                <div class="img-cont">
                    <img src="<?php echo !empty($bless_info['cover_img']) ? get_img_url($bless_info['cover_img']) : $domain['static']['url'].'/www/images/default-banner1.jpg'?>">
                    <div class="name"><i class="men"></i><span><?php echo $bless_info['roles_main']?></span><span>＆</span><i class="women"></i><span><?php echo $bless_info['roles_wife']?></span></div>
                    <div class="get-cont">
                        <i class="flower"></i>
                        <span>共收到的鲜花  <b id="flower_count"><?php echo $bless_info['flower_count']?><b></span>
                        <i class="icon"></i>
                    </div>
                    <div class="praises"><i></i></div>
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
            </div>
        </div>        
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        var dinner_id = "<?php echo $dinner_id;?>";
    		
        seajs.use(['<?php echo css_js_url('bless.js', 'www')?>'], function(a){
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
