<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('pc-public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('pl_media.css', 'www');?>">
    <link href="<?php echo css_js_url('my_dialog.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo css_js_url('new_media.css', 'www');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('video-js.min.css', 'www');?>">
    <?php $this->load->view('common/baidu_tongji')?>
    <style>
    .video-js .vjs-tech{
    	position:relative;
    }
</style>

</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">    
        
        <div class="page-main">
            <ul class="page-nav">
                <p>当前位置：</p>
                <li class="first"><a href="/news/home">百年资讯</a></li>
                <?php if(isset($now_class)):?>
                <?php foreach ($now_class as $k => $v):?>
                <li><a href="/news/index?class_id=<?php echo $v['id'];?>" target="_self"><?php echo $v['name'];?></a></li>
                <?php endforeach;?>
                <li><?php echo $info['title']?></li>
                <?php endif;?>
            </ul>
            <div class="left-cont">
                <div class="media-detail">
                <p class="title"><?php echo $info['title']?></p>
                <div class="info">
                    <p>发布者：百年婚宴</p>
                    <p class="t-center">时间：<?php echo $info['publish_time']?></p>
                    <p class="r">阅读  <?php echo $info['read']?></p>
                    <p class="l" style="display:none">点赞  <i><?php echo $info['zan_number']?></i></p>
                </div>
                <div class= "content">
                <?php if(isset($info['video_url']) && $info['video_url']):?>
                    <div class="video-cont">
                        <video controls="controls" style="height:auto;width:100%;" class="video-js vjs-big-play-centered" loop="" id="media"  style="width:710px;" poster="<?php echo get_img_url($info['cover_img'])?>">
                            <source src="<?php echo get_vedio_url($info['video_url'])?>" type='video/mp4' />
                        <video>
                    </div>
                <?php else:?>
                
                <?php if(!empty($info['cover_img'])):?>
                 <img src="<?php echo get_img_url($info['cover_img'])?>" />
                 <?php endif;?>
                 <?php endif;?>
                 <?php echo $info['content']?>
                <p class="line"></p>
                </div>
                <a href="javascript:;" class="laud" data="<?php echo $info['id']?>"></a>
                <ul>
                    <li>上一篇：<?php if(isset($before[0]['title'])):?><a href="/news/detail/<?php echo $before[0]['id']?>"> <?php echo $before[0]['title']?></a><?php endif;?></li>
                    <li>下一篇：<?php if(isset($next[0]['title'])):?><a href="/news/detail/<?php echo $next[0]['id']?>"> <?php echo $next[0]['title']?></a><?php endif;?></li>
                </ul>
                <div class="sharebtnbox">
            			<span class="share-label" style="margin-top:5px">分享到：</span>
            			<div class="bdsharebuttonbox bdshare_t bds_tools get-codes-bdshare bdshare-button-style0-16" id="bdshare" data-tag="arti-bottom" data-bd-bind="787878">
                			<a href="javascript:void(0);"  target="_self" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                			<a href="javascript:void(0);"  target="_self" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                			<a href="javascript:void(0);"  target="_self" class="bds_sqq" data-cmd="sqq" title="分享给QQ好友"></a>
                			<a href="javascript:void(0);"  target="_self" class="bds_weixin" data-cmd="weixin" target="_self" title="微信二维码"></a>
            			</div>
    			</div>
            </div>
            <div class="media-comment">
                    <div class="cont">
                        <p class="head">热门评论</p>
                        <?php if(isset($total_page)):?>
                        <div data="1" class="pages">
                            <span class="flag">第1页</span><span>/共<?php echo $total_page;?>页</span>
                            <a type="p_back" href="javascript:;" class="but">上一页</a>
                            <?php for($i=1;$i<=$total_page;$i++):?>
                            <a class="get-page <?php if($i == 1){echo 'act';}?>" href="javascript:;"><?php echo $i;?></a>
                            <?php endfor;?>
                            <a type="p_go" href="javascript:;" class="but">下一页</a>
                        </div>
                        <?php endif;?>
                    </div>
                    <textarea id="content" placeholder="&#x8F93;&#x5165;&#x4F60;&#x7684;&#x8BC4;&#x8BBA;&#x2026;&#x2026;"></textarea>
                    <div class="cont">
                        <span type="content" class="text_long"></span>                      
                        <a href="javascript:;" id="say" class="coment">评论</a>
                        <div id="p_code">
                        <?php if(isset($have_two)):?>
                            <input id="article_code" type="text" />
                            <img id="article" data="<?php echo $info['id']?>" src="/news/code/<?php echo $info['id']?>">
                        <?php endif;?>
                        </div>
                    </div>
                    <ul class="coment-list">
                        <?php if(isset($say)):?>
                        <?php foreach ($say as $k => $v):?>
                        <li>
                            <img src="<?php if(isset($v['head_img'])){echo get_img_url($v['head_img']);}else{echo C('domain.static.url').'/wap/images/touxiang.png';}?>">
                            <div class="list-cont">
                                <div class="cont">
                                    <div class="name"><?php if(isset($v['realname'])){echo $v['realname'];}?><p><?php echo $v['create_time']?></p></div>
                                    <p data="<?php echo $v['id']?>" class="icon icon1"><?php echo $v['zan_count']?></p>
                                    <p id="toatal_<?php echo $v['id']?>" data="<?php echo $v['id']?>" class="icon icon2"><?php if(isset($v['son'])){echo count($v['son']);}else{echo 0;}?></p>
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
                    </ul>
                </div>
            </div>
            
            <div class="right-cont">
                <div class="right-con">
                    <p class="head">热门标签</p>
                    <ul class="hot-list">
                        <?php if(isset($tags)):?>
                        <?php foreach ($tags as $k=>$v):?>
                            <?php if($v['parent_id'] != 0):?>
                            <li value="<?php echo $v['id']?>" class="<?php if(isset($class_id) && $class_id == $v['id']){echo 'act';}elseif (isset($parent_class_id)&&$parent_class_id == $v['id']){echo 'act';}?>">
                            <a <?php if($v['parent_id'] == 0){echo 'href="/news?parent_class_id='.$v['id'].'"';}else{echo 'href="/news?class_id='.$v['id'].'"';}?> target="_self"> <?php echo $v['name']?></a>
                            </li>
                            <?php endif;?>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="right-con">
                    <p class="head">百年资讯</p>
                    <ul class="right-list">
                    <?php if(isset($bainian_list)):?>
                        <?php foreach ($bainian_list as $k=>$v):?>
                        <li>
                            <a href ="/news/detail/<?php echo $v['id']?>">
                            <p class="title"><?php echo $v['title']?></p>
                            <?php if($k == 0):?>
                                <img src="<?php if(!empty($v['cover_img'])){echo get_img_url($v['cover_img']);}?>">
                                <?php endif;?>
                            <p class="text"><?php echo $v['summary']?></p>
                        </a>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="right-con">
                    <p class="head">米兰婚礼</p>
                    <ul class="right-list diamond">
                        <?php if(isset($milan_list)):?>
                        <?php foreach ($milan_list as $k=>$v):?>
                        <li>
                            <a href ="/news/detail/<?php echo $v['id']?>">
                            <p class="title"><?php echo $v['title']?></p>
                            <?php if($k == 0):?>
                                <img src="<?php if(!empty($v['cover_img'])){echo get_img_url($v['cover_img']);}?>">
                                <?php endif;?>
                            <p class="text"><?php echo $v['summary']?></p>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="right-con ewm">
                    <div><img src="<?php echo $domain['static']['url']?>/www/images/ewm.jpg"></div>
                    <p>微信扫一扫，关注百年婚宴</p>
                </div>
            </div>
        </div>
        

    </div>
    <input id="user_id" newsid="<?php if(isset($info['id'])){echo $info['id'];}?>" type="hidden" img="<?php if(isset($user_info['head_img'])){echo get_img_url($user_info['head_img']);}else{ echo $domain['static']['url'].'/wap/images/touxiang.png';}?>"
		data="<?php if(isset($user_info['realname']) && !empty($user_info['realname'])){echo $user_info['realname'];}elseif(isset($user_info['nickname'])){echo $user_info['nickname'];}?>"
		value="<?php if(isset($user_info['id'])){echo $user_info['id'];}?>" /> 
    <div class="to-top"></div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('pc-new.js', 'www')?>','public', '<?php echo css_js_url('video.min.js', 'www')?>'], function(a,p){
			p.load();
			a.start();
			a.say();//文章留言
			a.say_er();//二级评论
			a.zan();//评论点赞
			a.article_zan();//文章点赞
			a.get_page();//一级ajax分页
			a.sec_page();//二级ajax分页
			a.back_go();//上下页
			a.get_article_code();

			//播放器配置
			var player = videojs('media', {
			});
// 			player.addChild('BigPlayButton');
        })
    </script>
    
   
    <script>
    window._bd_share_config = {
        common : {
            bdText : "<?php echo $info['title'];?>", 
            bdDesc : "<?php echo preg_replace('/\s/','',$info['summary']);?>", 
            bdUrl : "<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>",   
            bdPic : ""
        },
        share : [{
            "bdSize" : 30
        }],
    }
    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
</body>
</html>
