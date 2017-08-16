<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-<?php echo $title?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('m-wap.css', 'wap');?>">
    <link href="<?php echo css_js_url('swiper.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo css_js_url('m-venue.css', 'wap');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap')?>">
    <style type="text/css">
    .weui-picker__item{padding:0;line-height:34px;}
    .weui-dialog__btn{ line-height: 48px;font-size: 18px;}
    </style>
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                <?php if(!empty($ad)): ?>
                <!-- Swiper -->
                <div class="wap-banner wap-banner1" style="margin-bottom:5px;">
                    <div class="swiper-wrapper">
                        <?php foreach ($ad as $k=>$v):?>
                        <div class="swiper-slide">
                        <a href="<?php echo $v['url'] ?>">
                            <img src="<?php echo get_img_url($v['img_url'])?>" style="width:100%;position:relative;">
                        </a>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                <?php endif; ?>
                <ul class="venue-chose" style="position:relative">
                    <?php foreach ($venue_class as $k=>$v):?>
                    <li class="select <?php if($venue_class_id == $k):?>act<?php endif;?>" data-id="<?php echo $k?>"><?php echo $v?> </li>
                    <?php endforeach;?>
                </ul>
                    <ul class="venue-list">
                    <?php if(isset($list)):?>
                    <?php foreach ($list as $k=>$v):?>
                        <li>
                            <a href="<?php echo $v['detail_link']?>">
                                <i class="click-but" style="top:0.5rem"></i>
                                <img src="<?php echo get_img_url($v['cover_img'])?>">
                            </a>
                            <p class="name"><?php echo $v['name']?></p>
                            <p class="text">最大桌数：<span><?php echo $v['max_table']?></span>桌&nbsp;&nbsp;楼层/层高：<?php echo $v['floor']?>/<?php echo $v['height']?></p>
                            <p class="text">场地面积：<span><?php echo floor($v['area_size'])?></span>平&nbsp;&nbsp;低消：<span><?php echo floor($v['min_consume'])?></span>/桌</p>
                            <p class="text">适合类型：<?php echo $v['fit_type']?>&nbsp;&nbsp;容纳人数：<span><?php echo $v['container']?></span>人</p>
                            <p class="text">设备支持：<?php echo $v['device']?></p>
                            <p class="but bespeak" data-id="<?php echo $v['id']?>">立即预定</p>
                            <p class="list-bg"></p>
                        </li>
                    <?php endforeach;?>
                    <?php endif;?>
                    </ul>
                    <div><p id="default_id" style="display:none"></p></div>
                    <div class="page-bg"></div>
                    <div class="popup-destine">
                        <p class="close"></p>
                        <p class="title">场馆预约</p>
                        <input type="text" name="name" placeholder="&#x59D3;&#x540D;">
                        <input type="tel" name="phone" placeholder="&#x7535;&#x8BDD;">
                        <input type="text" name="time" class="time date" readonly id="datePicker" placeholder="&#x9884;&#x7EA6;&#x65F6;&#x95F4;">
                        
                        <select name="venue" id="venue">
                        <?php if(isset($venue)):?>
                        <?php foreach ($venue as $k=>$v):?>
                           <option <?php if($k == $wedding):?>selected<?php endif;?> value="<?php echo $k?>"><?php echo $v?></option>
                        <?php endforeach;?>
                        <?php endif;?>
                        </select>
                        <input type="tel" name="menus_count" placeholder="预约桌数">
                        <textarea name="address" placeholder="备注"></textarea>
                        <p class="message"></p>
                        <a href="javascript:;" class="but submit">立即预约</a>
                    </div>

                   <?php $this->load->view('common/new_footer')?>
                </div>   
            </div>
        </div> 
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('venue.js', 'wap')?>', '<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('swiper.min.js', 'wap')?>'], function(a, p){
            p.load();
            a.load();
            a.show();
            a.submit();
            a.datepick();
            a.select();
            var swiper = new Swiper('.wap-banner1', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                autoplay:2500
            });
        })
    </script>

</body>
</html>
