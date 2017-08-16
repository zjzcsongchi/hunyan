<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--<title><?php echo $seo['title']?>-新人婚礼档案</title>-->
    <title>米兰婚礼新人档案</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    
    <link rel="stylesheet" href="<?php echo css_js_url('swiper.min.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('animate.min.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('h5.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('m-my_dialog.css', 'wap')?>">
    <style>
    @-webkit-keyframes start {
        0%,30% {opacity: 0;-webkit-transform: translate(0,10px);}
        60% {opacity: 1;-webkit-transform: translate(0,0);}
        100% {opacity: 0;-webkit-transform: translate(0,-8px);}
    }
    @-moz-keyframes start {
        0%,30% {opacity: 0;-moz-transform: translate(0,10px);}
        60% {opacity: 1;-moz-transform: translate(0,0);}
        100% {opacity: 0;-moz-transform: translate(0,-8px);}
    }
    @keyframes start {
        0%,30% {opacity: 0;transform: translate(0,10px);}
        60% {opacity: 1;transform: translate(0,0);}
        100% {opacity: 0;transform: translate(0,-8px);}
    }
    </style>
    <?php $this->load->view('common/tongji')?>
</head>

<body>
<form style="height:100%">
<?php if(isset($record)):?>
<input type="hidden" name="record_id" value="<?php echo $record['id'];?>" />
<?php endif;?>
<input type="hidden" name="dinner_id" value="<?php if(isset($dinner_info)){echo $dinner_info['id'];}?>" />
<div class="swiper-container">
    <div class="audio_btn rotate">
        <audio loop="true" src="<?php echo $domain['static']['url']?>/wap/music/audio.mp3" id="media" status="1" autoplay preload=""></audio>
    </div>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="swiper-wrapper">
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/record-bg1.jpg);"></div>
            <ul>
                <li class="ani" style="width: 38px; height: 70px; left: 232px; top: 45px; transform: rotateZ(40deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 58px; height: 92px; left: 260px; top: 210px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont2.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0; top: 225px; transform: rotateZ(2deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 115px; height: 99px; left: 67px; top: 470px; transform: rotateZ(279deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont2.gif"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 82px; top: -21px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 255px; height: 418px; left: 50%;margin-left: -127px; top: 80px;border: 2px solid rgb(168, 168, 168);" swiper-animate-effect="rotateIn" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 225px; height: 262px; left: -68px; top: 44px; transform: rotateZ(337deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.7s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.gif"></li>
                <li class="ani" style="width: 110px; height: 198px; left: -20px; top: 325px; transform: rotateZ(342deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.gif"></li>
                <li class="ani" style="width: 98px; height: 156px; right: 0; top: 79px; transform: rotateZ(16deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont5.gif"></li>
                <li class="ani" style="width: 237px; height: 400px; left: 50%;margin-left: -118px; top: 91px;background-color: #fff;" swiper-animate-effect="puffIn" swiper-animate-duration="1s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0; top: 390px; transform: rotateZ(45deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 237px; top: 169px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 65px; top: 65px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 56px; top: 326px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 244px; top: 73px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.4s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 238px; height: 29px; left: 50%;margin-left: -119px; top: 460px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont5.png"></li>
                <li class="ani" style="width: 165px; height: 165px; left: 50%;margin-left: -82px; top: 250px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.png"></li>
                <li class="ani" style="width: 108px; height: 189px; left: 50%;margin-left: -54px; top: 115px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="3s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.png"></li>
                <li class="ani" style="width: 163px; height: 90px; left: 50%;margin-left: -82px; top: 309px;color: rgb(230, 181, 6); font-size: 24px; background-color: rgba(230, 181, 6, 0);font-weight: bold;text-align: center;" swiper-animate-effect="swing" swiper-animate-duration="2s" swiper-animate-delay="0s">米兰婚礼<br>新人档案</li>
                <li class="ani" style="width: 171px; height: 30px; left: 50%;margin-left: -85px; top: 380px;line-height: 16px; font-size: 12px;color: rgb(103, 103, 103); text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0.9s">-WEDDING ARCHIVES-</li>
                <li class="ani" style="width: 143px; height: 46px; left: 50%;margin-left: -72px; top: 405px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont8.png"></li>
                <li class="ani" style="width: 73px; height: 72px; left: 255px; top: 450px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 223px; top: 472px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
            </ul>  
        </section>  
        <section class="swiper-slide">   
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/record/roles.jpg);"></div>
            <ul>
                <li class="ani" style="width: 38px; height: 70px; left: 229px; top: 50px;transform: rotateZ(40deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0; top: 255px;transform: rotateZ(2deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 115px; height: 99px; left: 80px; top: 480px;transform: rotateZ(279deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont2.gif"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 79px; top: -18px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 255px; height: 418px; left: 50%;margin-left: -127px; top: 90px;border: 2px solid rgb(168, 168, 168);" swiper-animate-effect="rotateIn" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 225px; height: 262px; left: -71px; top: 70px;transform: rotateZ(337deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.7s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.gif"></li>
                <li class="ani" style="width: 110px; height: 198px; left: -23px; top: 325px;transform: rotateZ(342deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.gif"></li>
                <li class="ani" style="width: 98px; height: 156px; right: 0; top: 95px; transform: rotateZ(16deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont5.gif"></li>
                <li class="ani" style="width: 237px; height: 400px; left: 50%;margin-left: -118px; top: 100px;background-color: #fff;" swiper-animate-effect="puffIn" swiper-animate-duration="1s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 85px; height: 141px; left: 270px; top: 410px;transform: rotateZ(45deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 73px; height: 72px; left: 243px; top: 465px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 220px; top: 480px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 216px; height: 40px; left: 50%;margin-left: -108px; top: 415px;border: 1px solid rgb(246, 178, 35); border-radius: 3px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s"><textarea style="line-height: 40px;text-indent: 10px;font-size: 16px;" maxlength="300" name="husband" placeholder="&#x65B0;&#x90CE;"><?php if(isset($record['husband'])){echo $record['husband'];}else if(isset($dinner_info['roles_main'])){echo $dinner_info['roles_main'];}?></textarea></li>
                <li class="ani" style="width: 216px; height: 40px; left: 50%;margin-left: -108px; top: 365px; border: 1px solid rgb(246, 178, 35); border-radius: 3px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><textarea style="line-height: 40px;text-indent: 10px;font-size: 16px;" maxlength="300" name="wife" placeholder="&#x65B0;&#x5A18;"><?php if(isset($record['wife'])){echo $record['wife'];}else if(isset($dinner_info['roles_wife'])){echo $dinner_info['roles_wife'];}?></textarea></li>
                <li class="ani" style="width: 226px; height: 28px; left: 50%;margin-left: -113px; top: 310px;font-size: 14px; color: ;text-align: center;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">新人，您好！请输入你们的姓名！</li>
                <li class="ani" style="width: 143px; height: 46px; left: 50%;margin-left: -80px; top: 200px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont8.png"></li>
            </ul>           
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-color: #E6E9EE;"></div>
            <ul>
                <li class="ani" style="width: 700px; height: 100%; left: 50%;margin-left: -350px; top: 0;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/qingrenjie.jpg"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 17px; top: -24px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0px; bottom: 100px;transform: rotateZ(2deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0px; bottom: 50px; transform: rotateZ(45deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 82%; height: 63%; left: 9%; top: 27.5%;background-color: rgba(255,255,255,0.5);" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.6s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 77%; left: 9%; top: 21%;color: ;background-color: white;border-radius: 5px;padding: 5px 10px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><span style="padding-left:0px;line-height: 1.3;">你们的职业(如不方便可以不填)？</span></li>
                <li class="ani" style="width: 216px; height: 40px; left: 50%;margin-left: -108px; top: 35%;border: 1px solid rgb(246, 178, 35); border-radius: 3px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s"><textarea style="line-height: 40px;text-indent: 10px;font-size: 16px;" maxlength="300" name="profession" placeholder="新郎职业"><?php if(isset($record['info'])&&isset($record['info']['profession'])){echo $record['info']['profession'];}?></textarea></li>
                <li class="ani" style="width: 216px; height: 40px; left: 50%;margin-left: -108px; top: 45%; border: 1px solid rgb(246, 178, 35); border-radius: 3px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><textarea style="line-height: 40px;text-indent: 10px;font-size: 16px;" maxlength="300" name="profession_wife" placeholder="新娘职业"><?php if(isset($record['info'])&&isset($record['info']['profession_wife'])){echo $record['info']['profession_wife'];}?></textarea></li>
                <li class="ani" style="width: 38px; height: 38px; left: 183px; top: 20px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 54px; height: 53px; right: 50px; bottom: 50px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 6px; top: 32px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 10px; top: 280px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
            </ul>
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="ani" style="width: 552px; height: 100%; left: 50%;margin-left: -266px; top: 0px;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/love.jpg"></li>
                <li class="ani" style="width: 92%; height: 75%; left: 4%; top: 6%; opacity: 0.72;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont10.png"></li>
                <li class="ani" style="width: 260px; height: 76px; left: 50%;margin-left: -130px; top: 65%;border: 1px solid rgb(246, 178, 35); border-radius: 3px;overflow: hidden;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.4s"><textarea style="border-radius: 3px;padding: 5px;line-height: 25px;font-size: 16px;" maxlength="300" name="appointmen_addr" placeholder="初次约会是在哪里"><?php if(isset($record['info'])&&isset($record['info']['appointmen_addr'])){echo $record['info']['appointmen_addr'];}?></textarea></li>
                <li class="ani" style="width: 260px;  left: 50%;margin-left: -130px; top: 61%;overflow: hidden;color: ;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.4s">初次约会是在哪里？</li>
                <li class="ani" style="width: 260px; height: 72px; left: 50%;margin-left: -130px; top: 47%; border: 1px solid rgb(246, 178, 35); border-radius: 3px;overflow: hidden;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s"><textarea style="border-radius: 3px;padding: 5px;line-height: 25px;font-size: 16px;" maxlength="300" name="first_meet_addr" placeholder="第一次见面在什么地方"><?php if(isset($record['info'])&&isset($record['info']['first_meet_addr'])){echo $record['info']['first_meet_addr'];}?></textarea></li>
                <li class="ani" style="width: 260px; left: 50%;margin-left: -130px; top: 43%;overflow: hidden;color: ;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">在什么地方？</li>
                <li class="ani" style="width: 260px; height: 70px; left: 50%;margin-left: -130px; top: 30%;border: 1px solid rgb(246, 178, 35); border-radius: 3px;overflow: hidden;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><textarea style="border-radius: 3px;padding: 5px;line-height: 25px;font-size: 16px;" maxlength="300" name="first_meet_time" placeholder="你们什么时候相识的"><?php if(isset($record['info'])&&isset($record['info']['first_meet_time'])){echo $record['info']['first_meet_time'];}?></textarea></li>
                <li class="ani" style="width: 260px; left: 50%;margin-left: -130px; top: 26%;overflow: hidden;color: ;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s">你们什么时候相识的？</li>
                <li class="ani" style="width: 292px; height: 46px; left: 50%;margin-left: -146px; top: 18%;color: rgb(230, 181, 6);font-size: 24px;text-align: center;font-weight: bold;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1s" swiper-animate-delay="0s">-讲讲你们的爱情故事-</li>
            </ul>                 
        </section>
        
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-color: #E6E9EE;"></div>
            <ul>
                <li class="ani" style="width: 590px; height: 100%; left: 50%;margin-left: -295px; top: 0px;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/todo.jpg"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 17px; top: 15px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0px; top: 250px;transform: rotateZ(2deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0px; top: 410px;transform: rotateZ(45deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 82%; height: 382px; left: 50%; top: 58%;margin: -190px 0 0 -40%; background-color: rgba(255,255,255,0.5);" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.6s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 77%; left: 50%; top: 49%;margin: -190px 0 0 -40%;color: ;background-color: white;border-radius: 5px;padding: 5px 10px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><span style="padding-left:0px; line-height: 1.4;">你觉得对方是个什么样的人</span></li>
                <li class="ani" style="width: 76%; height: 360px; left: 50%; top: 58%;margin: -180px 0 0 -37.3%;border-radius: 3px; border: 1px solid rgb(246, 178, 35);" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><textarea style="width: 96.6%; height: 350px;border-radius: 3px;font-size: 16px;line-height: 25px;padding: 5px;" maxlength="300" name="eyes" placeholder="你眼中的对方是个什么样的人"><?php if(isset($record['info'])&&isset($record['info']['eyes'])){echo $record['info']['eyes'];}?></textarea></li>
                <li class="ani" style="width: 38px; height: 38px; left: 268px; top: 40px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 54px; height: 53px; right: 50px; top: 465px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 6px; top: 70px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 8px; top: 260px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
            </ul>
        </section>
        
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-color: #E6E9EE;"></div>
            <ul>
                <li class="ani" style="width: 700px; height: 100%; left: 50%;margin-left: -350px; top: 0;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/qingrenjie.jpg"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 17px; top: -24px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0px; bottom: 100px;transform: rotateZ(2deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0px; bottom: 50px; transform: rotateZ(45deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 82%; height: 63%; left: 9%; top: 29.5%;background-color: rgba(255,255,255,0.5);" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.6s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 77%; left: 9%; top: 15%;color: ;background-color: white;border-radius: 5px;padding: 5px 10px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><span style="padding-left:0px;line-height: 1.3">对于你们来说有没有属于彼此之间特殊的事物(比如一首歌，一句话，一份吃的或是爱好)？</span></li>
                <li class="ani" style="width: 75%; height: 60%; left: 12.5%; top: 31%;border-radius: 3px; border: 1px solid rgb(246, 178, 35);" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><textarea style="border-radius: 3px;font-size: 16px;line-height: 25px;text-indent: 10px;" maxlength="300" name="special_thing" placeholder="彼此之间的特殊事物"><?php if(isset($record['info'])&&isset($record['info']['special_thing'])){echo $record['info']['special_thing'];}?></textarea></li>
                <li class="ani" style="width: 38px; height: 38px; left: 183px; top: 20px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 54px; height: 53px; right: 50px; bottom: 50px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 6px; top: 32px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 10px; top: 280px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
            </ul>
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-color: #E6E9EE;"></div>
            <ul>
                <li class="ani" style="width: 532px; height: 100%; left: 50%;margin-left: -266px; top: 0px;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/hobby.jpg"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 17px; top: 15px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0px; top: 250px;transform: rotateZ(2deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0px; top: 410px;transform: rotateZ(45deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 82%; height: 379px; left: 50%; top: 58%;margin: -190px 0 0 -40%; background-color: rgba(255,255,255,0.5);" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.6s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 77%; left: 50%; top: 50%;margin: -190px 0 0 -40%;color: ;background-color: white;border-radius: 5px;padding: 5px 10px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><span style="line-height: 1.2; padding-left:0px;">讲讲你们恋爱时让你们最难忘的事？</span></li>
                <li class="ani" style="width: 76%; height: 360px; left: 50%; top: 58%;margin: -180px 0 0 -37.3%;border-radius: 3px; border: 1px solid rgb(246, 178, 35);" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><textarea style="width: 96.6%; height: 350px;border-radius: 3px;font-size: 16px;line-height: 25px;padding: 5px;" maxlength="300" name="unforget" placeholder="彼此最难忘的事"><?php if(isset($record['info'])&&isset($record['info']['unforget'])){echo $record['info']['unforget'];}?></textarea></li>
                <li class="ani" style="width: 38px; height: 38px; left: 268px; top: 40px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 54px; height: 53px; right: 50px; top: 465px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 6px; top: 70px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 8px; top: 260px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
            </ul>
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-color: #E6E9EE;"></div>
            <ul>
                <li class="ani" style="width: 586px; height: 100%; left: 50%;margin-left: -293px; top: 0px;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/youdian.jpg"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 17px; top: 15px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0px; top: 250px;transform: rotateZ(2deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0px; top: 410px;transform: rotateZ(45deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 82%; height: 364px; left: 50%; top: 60%;margin: -190px 0 0 -40%; background-color: rgba(255,255,255,0.5);" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.6s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 77%; left: 50%; top: 47%;margin: -190px 0 0 -40%;color: ; background-color:white;border-radius: 5px;padding: 5px 10px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><span style="padding-left:0px;line-height: 1.8">在婚礼上想要对对方说点什么或做点什么？</span></li>
                <li class="ani" style="width: 76%;overflow:hidden; height: 340px; left: 50%; top: 60%;margin: -180px 0 0 -37.3%;border-radius: 3px; border: 1px solid rgb(246, 178, 35);" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><textarea style="width: 96.6%; height: 350px;border-radius: 3px;font-size: 16px;line-height: 25px;padding: 5px;" maxlength="300" name="do_what" placeholder="在婚礼上想要对对方说点什么或做点什么？"><?php echo isset($record['info']['do_what']) && $record['info']['do_what'] ?$record['info']['do_what']:'' ?></textarea></li>
                <li class="ani" style="width: 38px; height: 38px; left: 268px; top: 40px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 54px; height: 53px; right: 50px; top: 465px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 6px; top: 70px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 8px; top: 260px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
            </ul>
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-color: #E6E9EE;"></div>
            <ul>
                <li class="ani" style="width: 480px; height: 100%; left: 50%;margin-left: -240px; top: 0px;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/gandong.jpg"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 17px; top: 15px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0px; top: 250px;transform: rotateZ(2deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0px; top: 410px;transform: rotateZ(45deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 82%; height: 380px; left: 50%; top: 55%;margin: -190px 0 0 -40%; background-color: rgba(255,255,255,0.5);" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.6s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 77%; left: 50%; top: 49%;margin: -190px 0 0 -40%;color: ;background-color:white;border-radius: 5px;padding: 5px 10px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><span style="padding-left:0px;line-height: 1.3;">新人是通过什么方式认识对方的？<span style="font-size:10px;"></span></span></li>
                <li class="ani" style="width: 76%; height: 360px; left: 50%; top: 55%;margin: -180px 0 0 -37.3%;border-radius: 3px; border: 1px solid rgb(246, 178, 35);" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><textarea style="width: 96.6%; height: 350px;border-radius: 3px;font-size: 16px;line-height: 25px;padding: 5px;" maxlength="300" name="how_to_know" placeholder="新人是通过什么方式认识对方的？"><?php if(isset($record['info'])&&isset($record['info']['how_to_know'])){echo $record['info']['how_to_know'];}?></textarea></li>
                <li class="ani" style="width: 38px; height: 38px; left: 268px; top: 40px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 54px; height: 53px; right: 50px; top: 465px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 6px; top: 70px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 8px; top: 260px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
            </ul>
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-color: #E6E9EE;"></div>
            <ul>
                <li class="ani" style="width: 658px; height: 100%; left: 50%;margin-left: -329px; top: 0;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/say_parent.jpg"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 17px; top: 15px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0px; top: 250px;transform: rotateZ(2deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0px; top: 410px;transform: rotateZ(45deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 82%; height: 380px; left: 50%; top: 61%;margin: -190px 0 0 -40%; background-color: rgba(255,255,255,0.5);" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.6s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 77%; left: 50%; top: 52%;margin: -190px 0 0 -40%;color: ;background-color:white;border-radius: 5px;padding: 5px 10px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><span style="padding-left:0px; line-height: 1.2">在婚礼感恩环节有没有特殊情怀想对父母表达？(如有特殊家庭情况请注明)？</span></li>
                <li class="ani" style="width: 76%; height: 360px; left: 50%; top: 61%;margin: -180px 0 0 -37.3%;border-radius: 3px; border: 1px solid rgb(246, 178, 35);" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><textarea style="width: 96.6%; height: 350px;border-radius: 3px;font-size: 16px;line-height: 25px;padding: 5px;" maxlength="300" name="say_for_parent" placeholder="在婚礼感恩环节有没有特殊情怀想对父母表达？(如有特殊家庭情况请注明)？"><?php if(isset($record['info'])&&isset($record['info']['say_for_parent'])){echo $record['info']['say_for_parent'];}?></textarea></li>
                <li class="ani" style="width: 38px; height: 38px; left: 268px; top: 40px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 54px; height: 53px; right: 50px; top: 465px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 6px; top: 70px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 8px; top: 260px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
            </ul>
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-color: #E6E9EE;"></div>
            <ul>
                <li class="ani" style="width: 658px; height: 100%; left: 50%;margin-left: -329px; top: 0;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/care.jpg"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 17px; top: 15px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0px; top: 250px;transform: rotateZ(2deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0px; top: 410px;transform: rotateZ(45deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 82%; height: 380px; left: 50%; top: 58%;margin: -190px 0 0 -40%; background-color: rgba(255,255,255,0.5);" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.6s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 77%; left: 50%; top: 49%;margin: -190px 0 0 -40%;color: ;background-color:white;border-radius: 5px;padding: 5px 10px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><span style="padding-left:0px;line-height: 1.3;">婚礼是否有证婚人或需要特别提到的人？</span></li>
                <li class="ani" style="width: 76%; height: 360px; left: 50%; top: 58%;margin: -180px 0 0 -37.3%;border-radius: 3px; border: 1px solid rgb(246, 178, 35);" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><textarea style="width: 96.6%; height: 350px;border-radius: 3px;font-size: 16px;line-height: 25px;padding: 5px;" maxlength="300" name="care" placeholder="婚礼证婚人或想提到的人"><?php if(isset($record['info'])&&isset($record['info']['care'])){echo $record['info']['care'];}?></textarea></li>
                <li class="ani" style="width: 38px; height: 38px; left: 268px; top: 40px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 54px; height: 53px; right: 50px; top: 465px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 6px; top: 70px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 8px; top: 260px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
            </ul>
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-color: #E6E9EE;"></div>
            <ul>
                <li class="ani" style="width: 590px; height: 100%; left: 50%;margin-left: -295px; top: 0px;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/todo.jpg"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 17px; top: 15px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0px; top: 250px;transform: rotateZ(2deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0px; top: 410px;transform: rotateZ(45deg); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 82%; height: 380px; left: 50%; top: 60%;margin: -190px 0 0 -40%; background-color: rgba(255,255,255,0.5);" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.6s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 77%; left: 50%; top: 48%;margin: -190px 0 0 -40%;color: ; background-color:white;border-radius: 5px;padding: 5px 10px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><span style="padding-left:0px;line-height: 1.3;">关于你们之间的情感经历是否还需要讲述或补充的，信息越多，支持人在表达方面会更丰富哦！<span style="font-size:10px;"></span></span></li>
                <li class="ani" style="width: 76%; height: 360px; left: 50%; top: 60%;margin: -180px 0 0 -37.3%;border-radius: 3px; border: 1px solid rgb(246, 178, 35);" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><textarea style="width: 96.6%; height: 350px;border-radius: 3px;font-size: 16px;line-height: 25px;padding: 5px;" maxlength="300" name="remark" placeholder="备注"><?php if(isset($record['info'])&&isset($record['info']['remark'])){echo $record['info']['remark'];}?></textarea></li>
                <li class="ani" style="width: 38px; height: 38px; left: 268px; top: 40px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 54px; height: 53px; right: 50px; top: 465px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 6px; top: 70px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif" style="display:none;"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 8px; top: 260px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
            </ul>
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 552px; height: 100%; left: 50%;margin-left: -276px; top: 0;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record/story.jpg"></li>
                <li class="ani" style="width: 92%; height: 75%; left: 4%; top: 6%; opacity: 0.72;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont10.png"></li>
                <li class="ani" style="width: 260px; height: 40px; left: 50%;margin-left: -130px; top: 50%;border-radius: 3px; border: 1px solid rgb(246, 178, 35);" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s"><textarea style="line-height: 40px;text-indent: 10px;font-size: 16px;" maxlength="300" name="jinianri" placeholder="&#x6709;&#x6CA1;&#x6709;&#x7279;&#x6B8A;&#x7684;&#x7EAA;&#x5FF5;&#x65E5;&#xFF1F;"><?php if(isset($record['info'])&&isset($record['info']['jinianri'])){echo $record['info']['jinianri'];}?></textarea></li>
                <li class="ani" style="width: 260px; height: 43px; left: 50%;margin-left: -130px; top: 65%; border-radius: 3px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.6s"><input type="submit" id="save" style="width: 260px; height: 43px;background-color: rgb(230, 181, 6);color: rgb(255, 255, 255);text-align: center;line-height: 43px;border:none; border-radius: 3px;font-size: 24px;" value="<?php if(isset($record)){echo '更新';}else{echo '保存';}?>"/></li>
                <li class="ani" style="width: 260px; height: 40px; left: 50%;margin-left: -130px; top: 35%;border: 1px solid rgb(246, 178, 35); border-radius: 3px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><textarea style="line-height: 40px;text-indent: 10px;font-size: 16px;" maxlength="300" name="is_today" placeholder="&#x4F60;&#x4EEC;&#x7684;&#x751F;&#x65E5;&#x662F;&#x4E0D;&#x662F;&#x5728;&#x5A5A;&#x793C;&#x5F53;&#x5929;&#xFF1F;"><?php if(isset($record['info'])&&isset($record['info']['is_today'])){echo $record['info']['is_today'];}?></textarea></li>
                <li class="ani" style="width: 292px; height: 46px; left: 50%;margin-left: -146px; top: 18%;color: rgb(230, 181, 6);font-weight: bold; font-size: 24px;text-align: center;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1s" swiper-animate-delay="0s">-爱情故事-</li>
                <li class="ani" style="width: 109px; height: 153px; right: 1px; bottom: 3%;" swiper-animate-effect="twisterInDown" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont11.png"></li>
            </ul>
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/record-bg.gif);"></div>
            <ul>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 165px;" swiper-animate-effect="puffIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                <li class="ani" style="width: 44px; height: 74px; left: 52px; top: -8px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont13.png"></li>
                <li class="ani" style="width: 37px; height: 63px; right: 0px; bottom: 200px; " swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont13.png"></li>
                <li class="ani" style="width: 37px; height: 63px; left: -7px; bottom: 0px; " swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont13.png"></li>
                <li class="ani" style="width: 322px; height: 38px; left: 50%;margin-left: -156px; top: 500px;text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="1.5s"><a style="color: rgb(255, 222, 117); font-size: 18px; font-weight: bold;">点击访问百年官网</a></li>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 165px;" swiper-animate-effect="zoomIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 165px;" swiper-animate-effect="rollIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 165px; " swiper-animate-effect="flipInY" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                <li class="ani" style="width: 135px; height: 135px; left: 50%;margin-left: -67px; top: 191px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-bg10.jpg"></li>
                <li class="ani" style="width: 40px; height: 40px; right: 50px; top: 50px;"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont14.png"></li>
                <li class="ani" style="width: 59px; height: 59px; left: 50%;margin-left: -30px; top: 415px;" swiper-animate-effect="flash" swiper-animate-duration="2s" swiper-animate-delay="0s"><a href="<?php echo $domain['mobile']['url']?>"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont15.png"></a></li>
                <li class="ani" style="width: 121px; height: 39px; right: 70px; top: 39px;"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont8.png"></li>
            </ul>
        </section>    
    </div>    
  <div class="swiper-pagination"></div>
</div>
        </form>  

<?php $this->load->view('common/jsfooter')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <script type="text/javascript">
    document.addEventListener("WeixinJSBridgeReady", function () {
	      document.getElementById('media').play();
	}, false);
    seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('m-record.js', 'wap')?>',"http://res.wx.qq.com/open/js/jweixin-1.0.0.js",'<?php echo css_js_url('swiper.min.js', 'wap')?>', '<?php echo css_js_url('swiper.animate.min.js', 'wap')?>'], function(p,r,wx){
		p.load();
		r.start();
		r.save();

        wx.config(<?php echo $jssdk;?>);
        wx.ready(function(){
            //分享给朋友
            wx.onMenuShareAppMessage({
                title: '米兰婚礼新人档案', // 分享标题
                desc: '', // 分享描述
                link: '<?php echo $domain['mobile']['url'].'/record/index'?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: '<?php echo !empty($dinner_info['m_cover_img']) ? get_img_url(explode(';', $dinner_info['m_cover_img'])[0]) : $domain['static']['url'].'/wap/images/m_default_img.jpg' ?>' // 分享图标
                
            });
            //分享到朋友圈
            wx.onMenuShareTimeline({
                title: '米兰婚礼新人档案', // 分享标题
                link: '<?php echo $domain['mobile']['url'].'/record/index'?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: '<?php echo !empty($dinner_info['m_cover_img']) ? get_img_url(explode(';', $dinner_info['m_cover_img'])[0]) : $domain['static']['url'].'/wap/images/m_default_img.jpg' ?>', // 分享图标
                
            });
        })
        
    });


    
    </script>
</body>
</html>