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
    <link href="<?php echo css_js_url('viewer.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('wap-user.css', 'wap');?>" type="text/css" rel="stylesheet" />
</head>

<body>
    <div class="page-main padbot100">
        <div class="cover-img">
            <img src="<?php echo get_img_url($album['cover_img']);?>">
            <p class="num" data-num="<?php echo $photo_count;?>"><?php echo $photo_count;?>张</p>
        </div>
        <div class="text-brife">
            <p class="title"><?php echo isset($news['title'])?$news['title']:'';?></p>
            <p class="text"><?php echo isset($news['summary'])?$news['summary']:'';?>
            <?php if(isset($news['id'])): ?><a style="color:#333;" href="/news/detail?id=<?php echo $news['id'];?>">阅读全文</a><?php endif;?>
            </p>
            
        </div>
        <div class="album-cont">
            <p class="max-title" data-id='<?php echo $album['id'];?>'><?php echo $album['name'];?><!-- <a href="javascript:;" class="right-but">更多优惠信息</a> --></p>
            <div class="chose-cont">
                <label><input type="checkbox" id='is_album' ><span id="check_all">全选</span></label>
                <a class="but" id="pay_all_image" data-album_id="<?php echo $album['id']?>" data-order_type="<?php echo C('order.order_type.all_image.id')?>">购买全册</a>
                <div class="chose-right">
                    <p class="text"><span id='price' data-price="<?php echo $album['price'];?>">￥<?php echo $album['price'];?></span> / 册&nbsp;&nbsp;<span>￥<?php echo C('order.product_type.image.unit_price').'.00';?></span> / 张</p>
                    <a href="javascript:;" class="more"></a>
                    <ul class="more-album switch_album">
                        <?php foreach ($switch_album as $k => $v) :?>
                            <li data-id="<?php echo $v['id']?>">
                                <a><?php echo $v['name'];?></a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <ul class="user-list1 album-list" id='see-big'>
                <div class="wall-column">
                <?php if($album_photos_left):?>
                <?php foreach ($album_photos_left as $k => $v):?>
                <div class="list" data-id="<?php echo $v['id']?>" data-is_purchased="<?php echo $v['is_purchased']; ?>">
                    <img src="<?php echo get_img_url($v['sy_img'])?>" alt="<?php echo $v['id']?>" data-is_purchased="<?php echo $v['is_purchased']; ?>" />
                    <?php if($v['is_purchased']):?>
                        <p class="statu" data-original_img="<?php echo get_img_url($v['img'])?>">已购买</p>
                    <?php else:?>
                        <i class="active"></i>
                        <p class="preview">预览</p>
                    <?php endif?>
                    
                </div>
                <?php endforeach;?>
                <?php endif;?>
                </div>
                <div class="wall-column" >
                
                    <?php if($album_photos_right):?>
                    <?php foreach ($album_photos_right as $k => $v):?>
                    <li class="list" data-id="<?php echo $v['id']?>" data-is_purchased="<?php echo $v['is_purchased']; ?>">
                        <img src="<?php echo get_img_url($v['sy_img'])?>" alt="<?php echo $v['id']?>" data-is_purchased="<?php echo $v['is_purchased']; ?>" />
                        <?php if($v['is_purchased']):?>
                            <p class="statu" data-original_img="<?php echo get_img_url($v['img'])?>">已购买</p>
                        <?php else:?>
                            
                            <i class="active"></i>
                            <p class="preview">预览</p>
                        <?php endif?>
                        
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
               
                </div>
            </ul>
        </div>
        <div class="bottom-cont">
        <input type="hidden" id="dinner_id" name="dinner_id" value="<?php echo $album['dinner_id'];?>">
            <a href= "#">
                <div class="car"><p id="car">0</p></div>
            </a>
            <p class="text">剩余免费张数<span id='available_quota' data-available_quota="<?php echo $available_quota;?>"><?php echo $available_quota;?></span></p>
            <a href="javascript:;" class="but">立即结算</a>
            <p class="price"><span>￥</span><span id='pay_price'>0.00</span></p>
        </div>
        
         <div class="popup-see">
            <!--<a href="javascript:;" class="chose">选购（0）</a>-->
            <a href="javascript:;"  id='choser'>选购(0)</a>
            <a href="javascript:;" id="alread_purchased" style="text-indent: 1.5rem;background-image: url(); display:none">已购买</a>
        </div>

        <!-- 优惠信息弹窗 -->
        <div class="page-bg"></div>
        <div class="rule-popup ">
            <p class="title">更多优惠信息</p>
            <div class="close"></div>
            <div class="cont">
                <p class="text">1.钻石小鸟会员凭卡消费可累计积分，100元置换1分，积分累计无上限；消费完成后即自动激活成为可用积分；积分的数值精确到个位（小数点后全部舍弃，不进行四舍五入）例如购买商品实际支付总价为999元，积分累计9分；</p>
                <p class="text">2.推荐好友成功消费一次，可获相当于好友消费积分0.5倍的推荐积分；</p>
                <p class="text">3.登陆小鸟官网，参与小鸟积分活动，可获得活动积分（详情规则可参考活动细则）；</p>
                <p class="text">4.完善用户资料，所有选项均填写保存成功后可获得10分；</p>
                <p class="text">5.用户在钻石小鸟体验中心完成交易日起一个月内或货品签收日起后的一个月内成功提交评论可获得2分； </p>
                <p class="text">6.凡在钻石小鸟官网注册成功的用户均可获得5分。</p>
                <p class="text">7. 您登录后，在“我的鸟巢”-“我的积分”中</p>
            </div>
        </div>
        <div class="morealbum-popup">
            <p class="head">婚礼相册</p>
            <div class="close"></div>
            <ul class="user-list2 switch_album">
                <?php foreach ($switch_album as $k => $v) :?>
                    <li data-id="<?php echo $v['id']; ?>" style="width: 6.7rem;" >
                        <img class="height200" src="<?php echo get_img_url($v['cover_img'])?>">
                        <p class="title"><?php echo $v['name'];?></p>
                        <p class="num"><?php echo $v['num'];?></p>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
	var unitPrice = <?php echo C('order.product_type.image.unit_price');?>;                    //相册中照片单价
        seajs.use([
           '<?php echo css_js_url('album.js', 'wap')?>',
           'viewer'

        ], function(album){
          	album.load();
        	album.choosePhoto();
        	album.switch_album();
        	album.address();
        	album.preview();
        	//购买全册
        	album.pay_all_image();
        	album.choosePhotoOnPreview();

		})
    </script>

</body>
</html>
