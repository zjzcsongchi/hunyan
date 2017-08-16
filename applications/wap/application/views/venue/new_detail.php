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
     <link rel="stylesheet" href="<?php echo css_js_url('swiper.min.css', 'wap');?>">
     <link rel="stylesheet" href="<?php echo css_js_url('m-wap.css', 'wap');?>">
     <link rel="stylesheet" href="<?php echo css_js_url('m-venue.css', 'wap');?>">
     <link href="<?php echo css_js_url('ui-dialog.css', 'admin');?>" type="text/css" rel="stylesheet" />
     <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="mainfix">
            <div class="venue-detail">
                <div class="video-cont">                        
                    <video loop src="<?php echo get_vedio_url($venue_info['venue_video'])?>" id="media" style="position: absolute; width: 100%;left: 50%;margin-left: -50%;top:0;z-index: 2; object-fit:cover;" poster="<?php echo get_img_url(isset($venue_info['video_cover_img']) && $venue_info['video_cover_img']?$venue_info['video_cover_img']:$venue_info['cover_img'])?>"></video>
                    <div class="baner-title"><img src="<?php echo $domain['static']['url'].'/wap/images/m-banertitle1.png'?>"></div>                        
                </div>
                
                <p class="name"><?php echo $venue_info['name']?></p>
                <p class="text">最大桌数：<span><?php echo $venue_info['max_table']?></span>桌&nbsp;&nbsp;楼层/层高：<?php echo $venue_info['floor'] == 1 ? '独栋' : $venue_info['floor'].'层'?>/ <?php echo $venue_info['height']?> 米</p>
                <p class="text">场地面积：<span><?php echo floor($venue_info['area_size'])?></span>平&nbsp;&nbsp;低消：<span><?php echo floor($venue_info['min_consume'])?></span>/桌</p>
                <p class="text">适合类型：<?php echo $venue_info['fit_type']?>&nbsp;&nbsp;容纳人数：<span><?php echo $venue_info['container']?></span>人</p>
                <p class="text">设备支持：<?php echo $venue_info['device']?></p>
                <p class="list-bg"></p>
                <p class="title">场馆详情</p>
                <ul class="chose-list">
                    <?php foreach ($title as $k=>$v):?>
                    <li <?php if($k == 0):?>class="act" <?php endif;?> ><?php echo $v?></li>
                    <?php endforeach;?>
                    
                </ul>
                <?php foreach ($images as $k=>$v):?>
                <div class="img-list <?php if($k == 0):?> act <?php endif;?>">
                <?php if(isset($images[$k]) && $images[$k]):?>
                <?php foreach ($images[$k]['img'] as $key=>$val):?>
                    <?php if($images[$k]['img'][$key]):?>
                    <img src="<?php echo get_img_url($val);?>">
                    <?php endif;?>
                <?php endforeach;?>
                <?php endif;?>
                </div>
                <?php endforeach;?>
                
                <p class="list-bg"></p>
                <p class="title">礼物印记</p>                
                <!-- Swiper -->
               <?php if(isset($flower) && $flower):?>
               <div class="wap-banner1">
                    <div class="swiper-wrapper">
                       
                      <?php foreach ($flower as $k=>$v):?>
                        <div class="swiper-slide">
                            <ul class="rank-list">
                                <li>新郎：<?php echo $role_name[$k]['roles_main']?>&新娘：<?php echo $role_name[$k]['roles_wife']?></li>
                                <?php foreach ($v as $key=>$val):?>
                                <li>
                                    <p class="tip"></p>
                                    <img src="<?php if(isset($val['head_img']) && !empty($val['head_img'])):?><?php echo get_img_url($val['head_img'])?> <?php else:?><?php echo $domain['static']['url'].'/wap/images/touxiang.png'?> <?php endif;?>">
                                    <p class="list-name"><?php if($val['name']): ?><?php echo $val['name']?><?php else:?><?php echo '匿名'?> <?php endif;?></p>
                                    <p class="count"><?php echo $val['num']?></p>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                     <?php endforeach;?>   
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination1"></div>
                </div>
               <?php endif;?>
                <p class="list-bg"></p>
                <p class="title">祝福印记</p>
                <!-- Swiper -->
                <?php if(isset($comment) && $comment):?>
                <div class="wap-banner2">
                    <div class="swiper-wrapper">
                    <?php foreach ($flower as $k=>$v):?>
                    <?php if (isset($comment[$k]) && $comment[$k]):?>
                    <div class="swiper-slide">
                            <ul class="rank-list rank1">
                                <li>新郎：<?php echo $role_name[$k]['roles_main']?>&新娘：<?php echo $role_name[$k]['roles_wife']?></li>
                                <?php foreach ($comment[$k] as $key=>$val):?>
                                <li>
                                    <p class="tip"></p>
                                    <img src="<?php if(isset($val['head_img']) && !empty($val['head_img'])):?><?php echo get_img_url($val['head_img'])?> <?php else:?><?php echo $domain['static']['url'].'/wap/images/touxiang.png'?> <?php endif;?>">
                                    <div class="cont">
                                        <p class="list-title"><?php echo $val['name']?></p>
                                        <p class="list-text"><?php if(isset($val['content']) && $val['content']):?><?php  echo(mb_substr($val['content'], 0, 13)) ;?> <?php endif;?></p>
                                    </div>
                                    <p class="count"><?php if(isset($val['zan_count']) && $val['zan_count']):?><?php echo $val['zan_count']?><?php else:?><?php echo 0?> <?php endif;?></p>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    <?php endif;?>
                    <?php endforeach;?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination2"></div>
                </div>
                <?php endif;?>
                <p class="list-bg"></p>
                <?php if(isset($dinner_more_data) && $dinner_more_data):?>
                <p class="title">贵宾印记</p>
                <ul class="vip-list">
                <?php $i = 0;?>
                <?php foreach ($dinner_more_data as $k=>$v):?>
                <?php if($i < 12):?>
                <?php if(isset($v['m_cover_img']) && $v['m_cover_img']):?>
                    <li><a href="/today/detail?id=<?php echo $v['dinner_id']?>"><img src="<?php echo get_img_url($v['m_cover_img'])?>"></a><div class="img-bg"></div></li>
                    <?php $i++?>
                <?php endif;?>
                <?php endif;?>
                <?php endforeach;?>
                
                </ul>
                <?php endif;?>
            </div>                   
            <div class="suspend-but" style="bottom:2rem; display:none"><a href="javascript:;">立即预定</a></div> 
            <a href="javascript:;" class="more" next_page='2'>查看更多</a>
            <div class="page-bg"></div>
                <div class="popup-destine">
                    <p class="close"></p>
                    <p class="title">场馆预约</p>
                    <input type="text" name="name" placeholder="&#x59D3;&#x540D;">
                    <input type="tel" name="phone" placeholder="&#x7535;&#x8BDD;">
                    <input type="text" name="time" class="time Wdate date" placeholder="&#x9884;&#x7EA6;&#x65F6;&#x95F4;">
                    
                   <select name="venue" id="venue">
                   <?php if(isset($venue)):?>
                   <?php foreach ($venue as $k=>$v):?>
                       <option <?php if($k == $wedding):?>selected<?php endif;?> value="<?php echo $k?>"><?php echo $v?></option>
                   <?php endforeach;?>
                   <?php endif;?>
                   </select>
                    
                    <textarea name="address" placeholder="&#x5730;&#x5740;"></textarea>
                    <p class="message"></p>
                    <a href="javascript:;" class="but submit">立即预约</a>
                </div>
           <?php $this->load->view('common/new_footer')?>
        </div>   
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('venue_detail.js', 'wap')?>','<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('venue.js', 'wap')?>'], function(a,p,b){
			a.load();
			p.load();
			b.show();
            b.submit();
            b.datepick();
            a.load_more();
        })
    </script>
</body>
</html>
