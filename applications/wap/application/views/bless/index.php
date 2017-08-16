<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
    <title>送祝福-<?php echo $dinner['roles_main'].'&'.$dinner['roles_wife'].'的婚礼'?></title>
    <?php elseif($dinner['venue_type'] == C('party.nianhui.id')):?>
    <title>送祝福-<?php echo $dinner['roles_main']?></title>
    <?php else:?>
    <title>百年婚宴-送祝福</title>
    <?php endif;?>
    <meta name="keywords" content="&#x9879;&#x76EE;&#x5173;&#x952E;&#x8BCD;">
    <meta name="description" content="&#x9879;&#x76EE;&#x63CF;&#x8FF0;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    
    <link href="<?php echo css_js_url('swiper.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo css_js_url('m-bless.css', 'wap')?>">
    <?php $this->load->view('common/tongji')?>
</head>
<body>
    <div class="mainfix">
        <div class="banner">
            <img src="<?php echo $dinner['m_cover_img_url']?>">
            <div class="tip">
                <p class="folwer"></p>
                <p class="text">共收到的鲜花&nbsp;&nbsp;&nbsp;&nbsp;<o id='flower_count'><?php echo $dinner['flower_count']?></o></p>
                <i></i>
            </div>
            <div class="count zan_count"><o style="line-height: 1.1rem;"><?php echo $dinner['zan_count']?></o><p><i></i></p></div>
            <div class="name-cont">
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
                <i class="men"></i><?php echo $dinner['roles_main']?><span>&</span><i class="women"></i><?php echo $dinner['roles_wife']?>
                <?php else:?>
                <?php echo $dinner['roles_main']?>
            <?php endif;?>
            </div>
        </div>

        <div class="flower-cont">
            <img src="<?php echo $domain['static']['url']?>/wap/images/m-flower.png">
            <div class="cont">
                <p class="text">数量：</p>
                <a href="javascript:;" class="but1">-</a>
                <input value="1" id='send_flower_count' type="number">
                <a href="javascript:;" class="but2">+</a>
                <button id='send_flower'>赠送</button>
            </div>
            <p class="text" style=" width: 100%;text-align: center;">您当前可送鲜花：<b id='remain_available_flower'><?php echo $remain_available_flower?></b> 朵</p>
        </div>
        
        <!-- 百年婚宴年会显示 （送蛋糕） -->
        <?php if($is_own_party):?>
        <div class="birthday-cont">
            <p class="list-bg"></p>
            <p class="page-title">本月寿星</p>
            <p class="bless-title">共有 <?php echo count($birthday_girl)?> 位寿星</p>
            <ul>
                <?php foreach ($birthday_girl as $v):?>
                <li>
                    <a href="/usercenter/resume?user_id=<?php echo $v['user_id']?>">
                    <img src="<?php echo isset($v['head_img']) && !empty($v['head_img']) ? get_img_url($v['head_img']) : C('domain.static.url').'/wap/images/touxiang.png'?>">
                    <p class="name"><?php echo $v['fullname']?></p>
                    </a>
                    <p class="count">共收到<?php echo $v['all_num']?>份</p>
                    <a href="javascript:;" class="but" data-id="<?php echo $v['id']?>">赠送</a>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <!-- 送蛋糕弹框 -->
        <div class="popup-birthday">
            <p class="close"></p>
            <div class="img-cont"><img src="<?php echo $domain['static']['url']?>/wap/images/m-blessicon2.png"></div>
            <div style="margin: 0 auto;margin-top: 5px;display: block;text-align: center;color: red;" id="warning"></div>
            <div class="cont">
                <p>数量：</p>
                <a href="javascript:;" class="but but1" id="but_reduce">-</a>
                <input type="text" id="cake_count" value="1">
                <a href="javascript:;" class="but but2" id="but_plus">+</a>
                <a href="javascript:;" class="give" id="send_cake">赠送</a>
            </div>
        </div>
        <?php endif;?>
        <!-- 送蛋糕end -->

        <div class="coment-cont">
            <p class="list-bg"></p>
            <p class="page-title">收到的祝福</p>
            <p class="bless-title">共收到祝福：<?php echo $bless_count?> 条</p>
            <ul class="coment-list">

                <?php if($bless):?>
                <?php foreach ($bless as $k => $v):?>
                <li>
                    <div class="head1"><img src="<?php echo $v['head_img']?>"></div>
                    <div class="cont">
                        <div class="con" >
                            <a  href="javascript:;"class="name"><?php echo $v['name']?><span><?php echo $v['time']?></span></a>
                            <a  href="javascript:;"class="laud <?php echo $v['is_had_zan'] ? 'act' : '' ?>"><i>+1</i><span><?php echo $v['zan_count']?></span></span></a>
                            <span class="line"></span>
                            <p class="coment" is_had_view="0" ><?php echo $v['comment_count']?></p>
                        </div>
                        <p class="text"><?php echo $v['content']?></p>
                        <div class="detail-cont" blessid="<?php echo $v['id']?>">
                            <div class="con">
                                <input class="comment_content">
                                <button blessid="<?php echo $v['id']?>" class="send_comment">发送</button>
                            </div>
                            
                        </div>
                    </div>
                </li>
                <?php endforeach;?>
                <?php endif;?>

            </ul>
            <?php if($bless_count > 3):?>
                <a href="javascript:;" class="more more_bless" >查看更多</a>
            <?php endif;?>
            <input type="hidden" name="dinner_id" value="<?php echo $dinner_id ?>"/>
            <input type="hidden" name="offset" value="2"/>
        </div>
        <p class="list-bg"></p>
        <?php if(!empty($ad)): ?>
        <!-- Swiper -->
        <div class="wap-banner wap-banner1">
            <div class="swiper-wrapper">
                <?php foreach ($ad as $k=>$v):?>
                <div class="swiper-slide">
                    <a href="<?php echo $v['url'] ?>"><img src="<?php echo get_img_url($v['img_url'])?>" style="width:100%"></a>
                </div>
                <?php endforeach;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination1"></div>
        </div>
        <p class="list-bg"></p>
        <?php endif; ?>
        <div class="bless-cont" id="bless">            
            <div class="info-cont">
                <div class="img-cont"><img src="<?php echo $user['head_img']?>"></div>
                <div class="cont">
                    <p class="name">昵称：</p>
                    <p class="cont-text">用真名让新人看见你的祝福</p>
                    <p class="now-name act"><span><?php echo $user['nickname']?></span><a href="javascript:;" class="to-edit"></a></p>
                    <div class="edit-cont">
                        <input type="text" placeholder="请输入您的姓名" name="realname" >
                        <a href="javascript:;" class="but">确定</a>
                    </div>
                </div>
            </div>
            <textarea maxlength="28" id="textareaValidate" placeholder="请输入祝福信息"></textarea>
            <span id="length_tip" style="display: none; color: #FFC107;">祝福语至多输入28个字符</span>
            <a href="javascript:;" class="submit">提交祝福</a>
        </div>
        <div class="page-bless" style="z-index:2"><a href="#bless"></a></div>
        <div class="page-bg"></div>
        <div class="popup-message custom">
            <p class="close"></p>
            <img src="<?php echo $domain['static']['url']?>/wap/images/m-msg1.png">
            <p class="text">请勿重复操作</p>
            <a href="javascript:;" class="confirm">确定</a>
        </div>
        <div class="popup-message error">
            <p class="close"></p>
            <img src="<?php echo $domain['static']['url']?>/wap/images/m-msg1.png">
            <p class="text">内容不能为空</p>
            <a href="javascript:;" class="confirm">确定</a>
        </div>
        <div class="popup-message succes">
            <p class="close"></p>
            <img src="<?php echo $domain['static']['url']?>/wap/images/m-msg2.png">
            <p class="text">发送成功</p>
            <a href="javascript:;" class="confirm">确定</a>
        </div>
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <script type="text/javascript">
    var dinner_id = '<?php echo $dinner_id?>';
        seajs.use(['<?php echo css_js_url('bless.js', 'wap')?>','<?php echo css_js_url('m-public.js', 'wap')?>',"http://res.wx.qq.com/open/js/jweixin-1.0.0.js", '<?php echo css_js_url('swiper.min.js', 'wap')?>'], function(a,b, wx){
    			a.load();
    			b.load();
    			a.submit();
    			a.load_more();
    			a.thumb_up();
    			a.send_flower();
    			//送蛋糕
    			a.send_cake();
    			a.send_comment();
    			a.view_comment();
    			a.view_more_comment();
    			a.zan_bless();
    			a.zan_comment();
    			a.comment_length_limit();

                var swiper = new Swiper('.wap-banner1', {
                    paginationClickable: true,
                    autoplay:2500
                });
                <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
                <?php $title = '送祝福-'.$dinner['roles_main'].'&'.$dinner['roles_wife'].'的婚礼' ?>
                <?php elseif($dinner['venue_type'] == C('party.nianhui.id')):?>
                <?php $title = '送祝福-'.$dinner['roles_main']?>
                <?php else:?>
                <?php $title = '百年婚宴-送祝福'; ?>
                <?php endif;?>
                wx.config(<?php echo $jssdk;?>);
                wx.ready(function(){
                    //分享给朋友
                    wx.onMenuShareAppMessage({
                        title: '<?php echo $title ?>', // 分享标题
                        desc: '', // 分享描述
                        link: '<?php echo $domain['mobile']['url'].'/bless/index/'.$dinner_id?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                        imgUrl: '<?php echo $dinner['m_cover_img_url']?>' // 分享图标
                        
                    });
                    //分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: '<?php echo $title ?>', // 分享标题
                        link: '<?php echo $domain['mobile']['url'].'/bless/index/'.$dinner_id?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                        imgUrl: '<?php echo $dinner['m_cover_img_url']?>', // 分享图标
                        
                    });
                })

        })
    </script>
    
</body>
</html>
