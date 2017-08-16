<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title><?php echo $info['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('m-wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-media.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('weui.css', 'wap')?>" type="text/css" rel="stylesheet" />
    <style type="text/css">
    .weui-picker__item{padding:0;line-height:34px;}
    .weui-dialog__btn{ line-height: 48px;font-size: 18px;}
    </style>
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="mainfix">
            <div class="media-detail" id = "art_id" data="<?php echo $info['id']?>">
                
                
                <?php if($info['video_url']):?><div class="detail-video">
                
                <video webkit-playsinline controls playsinline src="<?php echo get_vedio_url($info['video_url'])?>" id="media" style="width:15rem; object-fit:cover;" poster="<?php echo get_img_url($info['cover_img'])?>"></video>
                <p class="title">标题：<?php echo $info['title']?></p>
                <div class="info">
                    <p class="l">发布者：<?php echo $info['agency']?></p>
                    <p class="r">时间：<?php echo $info['publish_time']?></p>
                </div>
                </div><?php else:?>
                <p class="title"><?php echo $info['title']?></p>
                <div class="info">
                    <p class="l">发布者：<?php echo $info['agency']?></p>
                    <p class="r">时间：<?php echo $info['publish_time']?></p>
                </div>
                <img class="bigsize-img" src="<?php echo get_img_url($info['cover_img'])?>">
                <?php endif;?>
                <div id="text" class="detail-con content">
                    <?php echo $info['content']?>
                    <p><img alt="" src="<?php echo $domain['static']['url']?>/wap/images/smewm.gif"></p>
                </div>
                <a href="javascript:;" class="all" data="0" style="display:none">余下全文</a>
                <p class="line"></p>
                <a href="javascript:;" data-num="<?php if(isset($info['zan_number'])):?> <?php  echo $info['zan_number'];?> <?php endif;?>" class="land"><i>+1</i></a>
                <p class="list-bg"></p>
                <p class="coment-title">精彩评论</p>
                <ul class="coment-list">
                    <?php if(isset($say)):?>
                    <?php foreach ($say as $k => $v):?>
                    <li>
                        <img src="<?php if(!empty($v['head_img'])){echo get_img_url($v['head_img']);}else{ echo $domain['static']['url'].'/wap/images/touxiang.png';}?>">
                        <div class="cont">
                            <p class="name"><?php if(!empty($v['realname'])){echo $v['realname'];}else{echo '无名小卒';}?></p>
                            <p class="text"><?php echo $v['content']?></p>
                            <div class="con">
                                <span class="l"><?php echo $v['create_time']?></span>
                                <span type="p_son" data="<?php echo $v['id']?>" class="r icon1  but">回复</span>
                                <span dataid='p_zan' num = "<?php echo $v['zan_count']?>" data="<?php echo $v['id']?>" class="r icon2"><?php echo $v['zan_count']?></span> 
                            </div>
                            <div class="coment-cont" id="erji_<?php echo $v['id']?>">
                                <p>回复Ta：</p>
                                <input type="hidden" class="er_news_id" value="<?php echo $info['id']?>" />
                                <input type="hidden" class="news_comment_id" value="<?php echo $v['id']?>" />
                                <?php if(isset($user_info)):?>
                                <input type="hidden" class="er_user_id" data="<?php if(isset($user_info['realname']) && !empty($user_info['realname'])){echo $user_info['realname'];}else{echo $user_info['nickname'];}?>" value="<?php if(isset($user_info['id'])){echo $user_info['id'];}?>"/>
                                <?php endif;?>
                                <textarea class='msg'></textarea>
                                <a href="javascript:;" class="send">发表</a>
                            </div>
                            <?php if(isset($v['son'])):?>
                            <?php foreach ($v['son'] as $kk => $vv):?>
                            <p class="text"><span class="user"><?php if(isset($vv['realname'])&& !empty($vv['realname'])){echo $vv['realname'];}else{echo '无名小卒';}?>：</span><?php echo $vv['content']?><span class="time"><?php echo $vv['create_time']?></span></p>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </div>
            <?php if(isset($user_info)):?>
            <div class="page-coment">
                <img src="<?php if(isset($user_info['head_img'])){echo get_img_url($user_info['head_img']);}else{ echo $domain['static']['url'].'/wap/images/touxiang.png';}?>">
                <input id="user_id" newsid="<?php if(isset($info['id'])){echo $info['id'];}?>" type="hidden" img="<?php if(isset($user_info['head_img'])){echo get_img_url($user_info['head_img']);}else{ echo $domain['static']['url'].'/wap/images/touxiang.png';}?>" data="<?php if(isset($user_info['realname']) && !empty($user_info['realname'])){echo $user_info['realname'];}else{echo $user_info['nickname'];}?>" value="<?php if(isset($user_info['id'])){echo $user_info['id'];}?>">
                <input id="say" value="" type="text">
                <a class="say">发表</a>
            </div>
            <?php else:?>
            <div class="page-coment">
                <img src="<?php echo $domain['static']['url']?>/wap/images/touxiang.png">
                <input type="text">
                <a class="say">发表</a>
            </div>
            <?php endif;?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    
    <script type="text/javascript">
    var id = "<?php echo $info['id']?>";
    seajs.use(['<?php echo css_js_url('new.js', 'wap')?>','<?php echo css_js_url('m-public.js', 'wap')?>', "http://res.wx.qq.com/open/js/jweixin-1.0.0.js"], function(a,b,wx){
		a.load();
        a.start();
        b.load();
        a.zan();//文章点赞
        a.say();//评论
        a.say_er();//二级评论
        a.p_zan();//评论点赞 
        wx.config(<?php echo $jssdk;?>);
        wx.ready(function(){
            //分享到朋友圈
			wx.onMenuShareTimeline({
			    title: '<?php echo $info['title']?>', // 分享标题
			    link: '<?php echo $domain['mobile']['url'].'/news/detail?id='.$info['id'];?>', // 分享链接
			    imgUrl: '<?php echo get_img_url($info['cover_img'])?>', // 分享图标
			    success: function () { 
			        // 用户确认分享后执行的回调函数
			    },
			    cancel: function () { 
			        // 用户取消分享后执行的回调函数
			    }
			});
            //分享给朋友
            wx.onMenuShareAppMessage({
                title: '<?php echo $info['title']?>', // 分享标题
                desc: '<?php echo !empty($info['summary']) ? $info['summary'] : $info['title'] ?>', // 分享描述
                link: '<?php echo $domain['mobile']['url'].'/news/detail?id='.$info['id'];?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: '<?php echo get_img_url($info['cover_img'])?>', // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });

        })
        $(document).on('click', '[type="p_son"]', function(){
			var id = $(this).attr('data'); 
			$('#erji_'+id).toggleClass('act');
        })
    });
    </script>
</body>
</html>

