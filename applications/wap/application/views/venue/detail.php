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
    <link rel="stylesheet" href="<?php echo css_js_url('m-wap.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('m-venue.css', 'wap')?>">
    <link href="<?php echo css_js_url('ui-dialog.css', 'admin');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                <!-- home -->
                    <div class="venue-detail">
                        <div class="video-cont">                        
                            <video loop src="<?php echo get_vedio_url($venue_info['venue_video'])?>" id="media" style="position: absolute; width: 100%;left: 50%;margin-left: -50%;top:0;z-index: 2;"></video>
                            <img class="act" src="<?php echo get_img_url($venue_info['cover_img'])?>" >
                            <i class="act"></i>
                            <div class="baner-title"><img src="<?php echo $domain['static']['url']?>/wap/images/m-banertitle1.png" ></div>                        
                        </div>
                        <p class="name"><?php echo $venue_info['name']?></p>
                        <p class="text">最大桌数：<span> <?php echo $venue_info['max_table']?>  </span>桌&nbsp;&nbsp;楼层/层高：<?php echo $venue_info['floor'] == 1 ? '独栋' : $venue_info['floor'].'层'?>/ <?php echo $venue_info['height']?> 米</p>
                        <p class="text">场地面积：<span><?php echo floor($venue_info['area_size'])?></span>平&nbsp;&nbsp;低消：<span><?php echo floor($venue_info['min_consume'])?></span>/桌</p>
                        <p class="text">适合类型：<?php echo $venue_info['fit_type']?>&nbsp;&nbsp;容纳人数：<span><?php echo $venue_info['container']?></span>人</p>
                        <p class="text">设备支持：<?php echo $venue_info['device']?></p>
                        <p class="list-bg"></p>
                        <p class="title">客例鉴赏</p>
                    </div>
                    <ul class="case-list">
                        <?php if (isset($customer_case) && !empty($customer_case)):?>
                            <?php foreach ($customer_case as $k => $v):?>
                            <li class="video-cont">                        
                                <video loop src="<?php echo get_vedio_url($v['case_video']) ?>" style="position: absolute; width: 100%;left: 50%;margin-left: -50%;top:0;z-index: 2;"></video>
                                <img class="act" src="<?php echo get_img_url($v['case_cover_img']) ?>">
                                <i class="act"></i>                     
                            </li>
                            <?php endforeach;?>
                        <?php else:?>
                           <!-- 没数据时提示 -->
                        <?php endif;?>
                    </ul>

                    <div class="suspend-but"><a href="javascript:;">立即预定</a></div>                    

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
                    
                </div>   
            </div>
        </div>
        
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('venue.js', 'wap')?>', '<?php echo css_js_url('m-public.js', 'wap')?>'], function(a, p){
            p.load();
          a.load();
          a.show();
          a.submit();
          a.datepick();
          a.detail();

        })
    </script>

</body>
</html>
