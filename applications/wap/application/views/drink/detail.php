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
    <link href="<?php echo css_js_url('swiper.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-venue.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('wap-users.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                    <div id="bg" class="page-bg"></div>
                    <div id="open" class="popup-destine">
                        <p class="close"></p>
                        <p id="open_title"data="" class="title">酒水预定</p>
                        <input type="text" id="user_name" name="name" value="<?php if(isset($user_info['realname']) && !empty($user_info['realname'])){echo $user_info['realname'];}elseif(isset($user_info['nickname']) && !empty($user_info['nickname'])){echo $user_info['nickname'];}?>" placeholder="&#x59D3;&#x540D;">
                        <input type="tel" id="user_mobile" name="phone" value="<?php if(isset($user_info['mobile_phone'])){echo $user_info['mobile_phone'];}?>" placeholder="&#x7535;&#x8BDD;">
                        <input type="text" name="num" id="num"  placeholder="数量">
                        
                       <select id="post_method" name="post_method" >
                       <option  value="">--请选择配送方式--</option>
                       <?php foreach (C('post_method') as $k => $v) :?>
								<option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
								<?php endforeach;?>
                       </select>
                        
                        <textarea id="user_addr" name="address" placeholder="&#x5730;&#x5740;"></textarea>
                        <p class="message"></p>
                        <a id="add" href="javascript:;" class="but">立即预约</a>
                    </div>
                
                    <!-- Swiper -->
                    <div class="wap-banner">
                        <div class="swiper-wrapper">
                            <?php if(is_array($info['images'])):?>
                                <?php foreach($info['images'] as $k =>$v):?>
                                <div class="swiper-slide"><img src="<?php echo get_img_url($v);?>" alt=""></div>
                                <?php endforeach;?>
                                <?php endif;?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                    <div id="info_id_<?php echo $info['id']?>" img="<?php echo $info['cover_img']?>" class="drink-detail">
                        <p id="title_<?php echo $info['id']?>"  data="<?php echo $info['title']?>" infoid="<?php echo $info['id']?>" class="title"><?php echo $info['title']?></p>
                        <div id="price_<?php echo $info['id']?>" class="price" data="<?php echo $info['present_price']?>" >￥<span id="real_price"><?php echo $info['present_price']?></span>/<?php echo $info['unit']?><p><i></i>批发价</p></div>
                        <ul class="drink-info">
                            <li><span>【名称】：<?php echo $info['title']?></li>
                            <li><span>【生产厂商】：</span><?php echo $info['firm']?></li>
                            <?php foreach ($new_lists as $k=>$v):?>
                            <li><span>【<?php echo $k?>】：</span><?php echo $v?></li>
                            <?php endforeach;?>
                            <li><span>【生产许可证编号】：</span><?php echo $info['allow_num']?></li>
                        </ul>
                        
                        <ul class="detail-list">
                        <?php if(isset($special_lists) && $special_lists):?>
                            <li>
                                <label>选择</label>
                                <div class="list">
                                <?php foreach ($special_lists as $k=>$v):?>
                                    <p class="special <?php if($k == 0):?>act<?php endif;?>" data-price="<?php echo $v['version_price']?>" data-name="<?php echo $v['version_name']?>" data-id="<?php echo $v['id']?>"><i></i><?php echo $v['version_name']?></p>
                                <?php endforeach;?>
                                </div>
                            </li>
                            
                            <?php endif;?>
                            <li>
                                <label>数量</label>
                                <a href="javascript:;" class="but" id="reduce_num">-</a>
                                <input type="text" value="1" id="real_num">
                                <a href="javascript:;" class="but" id="add_num">+</a> 
                            </li>
                        </ul>
                    </div>
                    <div class="bottom-cont">
                      <div class="car" id="end"></div>
                      <p class="text">购物车商品<span id="cars_num">0</span>件</p>
                      <a href="javascript:;" onclick="window.open('/drink/cars', '_self')" class="but">立即结算</a>
                      <p id="add_to_cars" class="enter" data-size='<?php if(isset($new_lists)){echo json_encode($new_lists);}?>' data-id="<?php echo $info['id']?>" data-info='<?php echo json_encode($info);?>'>加入购物车</p>
                    </div>
                </div>   
            </div>
        </div> 
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('jsyd.js', 'wap')?>','<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('swiper.min.js', 'wap')?>'], function(a, p){
            p.load();
            a.start();
        	a.open();
            a.buy();
            a.detail();
            a.special();
            a.add_reduce();
            a.add_cars();
            var swiper = new Swiper('.wap-banner', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                autoplay:2500
            });
            $(".detail-list .list p").click(function() {
                $(".detail-list .list p.act").removeClass("act");
                $(this).addClass("act");
            });
        })
    </script>
</body>
</html>
    
