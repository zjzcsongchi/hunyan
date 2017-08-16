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
    <link rel="stylesheet" href="<?php echo css_js_url('m-media.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('dropload.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('swiper.min.css', 'wap')?>">
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="mainfix">
        <?php if(in_array($class_id, array(C('news.milan.children.very_marry.id'), C('news.milan.children.front_info.id'), C('news.milan.children.marry_method.id')))){
            $flag = 1;
        }else{
            $flag = 0;
        }
            
        ?>
        
        <?php 
            if($img_url || $video){
                $video_tag = 1;
            }else{
                $video_tag = 0;
            }
        ?>
        
        <?php if($img_url || $video):?>
        <div class="wap-banner" <?php if($flag == 1):?> style="margin-top:1.8rem" <?php endif;?>>
            <div class="swiper-wrapper">
                <?php if($video):?>
                <?php foreach ($video['video'] as $k=>$v):?>     
                <div class="swiper-slide">
                    <video webkit-playsinline controls playsinline src="<?php echo get_vedio_url($v['video'])?>" id="media" style="position: absolute; width: 100%; height:100%; left: 50%;margin-left: -50%;top:0;z-index: 2; object-fit:cover;" poster="<?php echo get_img_url($v['img_url'])?>"></video>
                </div>
                <?php endforeach;?>
                <?php endif;?>
                
                <?php if($img_url):?>
                  <?php foreach ($img_url['img_url'] as $key=>$val):?>
                    <div class="swiper-slide"><img src="<?php echo get_img_url($val)?>" alt=""></div>
                  <?php endforeach;?>
                <?php endif;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        
        <?php endif;?>
            <ul class="media-list" >
               <?php foreach ($list as $k=>$v):?>
               <a href="/news/detail?id=<?php echo $v['id']?>">
                <li>
                    <?php if(isset($v['video_url']) && $v['video_url']):?>
                    <i class="act"></i>
                    <?php endif;?>
                    <img src="<?php echo get_img_url($v['cover_img'])?>">
                    <div class="cont">
                        <p class="title"><?php echo $v['title']?></p>
                        <p class="text"><?php echo $v['summary']?></p>
                        <div class="con">
                            <p class="l"><?php echo $v['agency']?></p>
                            <p class="r icon1"><?php echo $v['read']?></p>
                            <p class="r icon2"><?php echo $v['zan_number']?></p>
                        </div>
                    </div>
                </li>
                </a>
              <?php endforeach;?>  
            </ul>
            <input type="hidden" name="page" value="2"/>
            <input type="hidden" name="class_id" value="<?php echo $class_id?>"/>
            <div class="dropload-down">
                <div class="dropload-noData">↑上拉加载更多</div>
            </div>
           <?php $this->load->view('common/new_footer')?>
        </div>   
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
     <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('new_new.js', 'wap')?>','<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('iscroll.min.js', 'wap')?>'], function(a,p){
			a.load();
			p.load();
			a.load_more();
        })
    </script>
</body>
</html>
