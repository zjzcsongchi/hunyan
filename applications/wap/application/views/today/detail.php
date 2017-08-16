<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>项目名称</title>
    <meta name="keywords" content="&#x9879;&#x76EE;&#x5173;&#x952E;&#x8BCD;">
    <meta name="description" content="&#x9879;&#x76EE;&#x63CF;&#x8FF0;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('m-wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-banquet.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                    <div class="video-cont">                        
                        <video loop src="<?php echo get_vedio_url($about['index_vedio_url'])?>" id="media" style="position: absolute; width: 100%;left: 50%;margin-left: -50%;top:0;z-index: 2; object-fit:cover;"></video>
                        <img class="act" src="<?php echo $domain['static']['url'].'/wap/images/m-banner.jpg'?>">
                        <i class="act"></i>
                        <div class="baner-title"><img src="<?php echo $domain['static']['url'].'/wap/images/baner-title.png'?>"></div>                        
                    </div>
                    <div class="banqute-detail">
                        <p class="name"><span class="l-text">新郎：<?php echo $dinner['roles_main']?></span><span class="r-text">新娘：<?php echo $dinner['roles_wife']?></span></p>
                        <p class="adres">【<?php echo $venue['name']?>】</p>
                        <p class="text">最大桌数：<span><?php echo $venue['max_table']?></span>桌&nbsp;&nbsp;&nbsp;&nbsp;容纳人数：<span><?php echo $venue['container']?></span>人</p>
                        <p class="text">开席时间：<span><?php echo $dinner['banquet_time']?></span>&nbsp;&nbsp;设备支持：<?php echo $venue['device']?></p>
                        <p class="text">地址：安顺市中华中路103号百年婚宴</p>
                        <p class="icon">农历：<?php echo $dinner['lunar_time']?></p>
                        <p class="icon">公历：<?php echo $dinner['solar_time']?></p>
                        <p class="top-bg"></p>
                        
                        <p class="title">婚礼照片</p>
                        <?php if(isset($dinner['cover_img']) && $dinner['cover_img']):?>
                        <?php foreach ($dinner['cover_img'] as $k=>$v):?>
                        <img src="<?php echo $v?>">
                        <?php endforeach;?>
                        <?php endif;?>
                        <p class="top-bg"></p>
                        <p class="title">我收到的祝福</p>
                        <p class="bless-title">共收到祝福：<?php echo $data_count?>条</p>
                        <ul class="bless-lists">
                        <?php foreach($lists as $k=>$v):?>
                            <li>
                                <img src="<?php echo $v['user_info']['head_img']?>">
                                <p><span><?php echo $v['user_info']['nickname']?>：</span><?php echo $v['content']?></p>
                            </li>
                        <?php endforeach;?>
                        </ul>
                        
                        <?php if(isset($exist) && $exist):?>
                            <a href="javascript:;" class="more bless_more" next_page="2" id="load_more">查看更多</a>
                        <?php else:?>
                            <a href="javascript:;" class="more" style="background:#CDC5BF">没有数据</a>
                        <?php endif;?>
                        
                    </div>
                    <div class="suspend">
                        <a href="<?php echo $first_url.$id.$tail_url?>"><span></span><p>发送祝福</p></a>
                        <a href="http://statics.holdfun.cn/live/material/live-list.html?enterId=a1a70d774bf44011a52927a82f5180d8"><span></span><p>观看直播</p></a>
                    </div>
                    <!-- footer -->
                    <?php $this->load->view('common/new_footer')?>
                    <!-- footer -->
                </div>   
            </div>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script>
    seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('iscroll.min.js', 'wap')?>'], function(a){
        a.load();
    $(function(){
        var myVideo=document.getElementById("media");
        $(".video-cont i").click(function() {
            $(this).removeClass("act");
            $(".video-cont img").removeClass("act");
            myVideo.play();
        });
        
    });
    
    $('.bless_more').click(function(){
		var next_page = $(this).attr("next_page");
		var new_page = parseInt(next_page)+1;
		$(this).attr("next_page", new_page);
		$.post("", {page:next_page}, function(data){
			if(data){
				html = '';
				$.each(data, function(i, v){

					html += '<li><img src="'+v.user_info.head_img+'">';
					html += '<p><span>'+v.user_info.nickname+'：</span>'+v.content+'</p></li>';
				})
				$('.bless-lists').append(html);
			}
			if(data.length <= 0){
				$("#load_more").text('没有更多了');
				$("#load_more").css("background", "#CDC5BF");
			}

		})
		
		
    })
    })
    </script>
</body>
</html>
