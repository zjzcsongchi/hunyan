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
    <link href="<?php echo css_js_url('m-wap-drink.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-my_dialog.css', 'wap');?>" type="text/css" rel="stylesheet" />
    
    
    <link href="<?php echo css_js_url('swiper.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-malls.css', 'wap');?>" type="text/css" rel="stylesheet" />

    <?php $this->load->view('common/tongji')?>
</head>
<body class="grey">
    <div class="mainfix">
        <!-- Swiper -->
        <div class="wap-banner">
            <div class="swiper-wrapper">
                <?php foreach ($manual as $k=>$v):?>
                    <div class="swiper-slide"><img src="<?php echo get_img_url($v['img_url'])?>" alt="<?php echo $v['title']?>"></div>
                <?php endforeach;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>

        <div class="malls-main">
            <ul class="left-nav">
                <?php foreach ($class_list as $k=>$v):?>
                    <li>
                        <a href="/drink/index/<?php echo $k?>" class="<?php echo ($k == $class_id)?'act':'';?>">
                            <?php echo $v?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
            <ul class="malls-list">
                <?php if(isset($lists)):?>
                <?php foreach ($lists as $k => $v):?>
                <li>
                    <a href="/drink/detail?id=<?php echo $v['id'];?>">
                    <div class="img-cont"><img src="<?php echo get_img_url($v['cover_img'])?>"></div>
                    
                    <div class="cont">
                        <p class="title"><?php echo $v['title']?></p>
                        <div class="price">￥<span class="goods_price_<?php echo $v['id'];?>"><?php if(isset($v['size_list'][0])){echo $v['size_list'][0]['version_price'];}else{echo $v['present_price'];}?></span>/瓶<p><i></i>批发价</p></div>
                    </div>
                    
                    <div class="cont borbot">
                        <?php if(isset($v['flag'])):?>
                        <?php foreach ($v['flag'] as $key => $val):?>
                            <p class="icon"><?php echo $val;?></p>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                    
                    <?php if(isset($v['size_list'])):?>
                    <ul class="detail-list">
                      <li style="margin-top: 0;">
                        <label>选择</label>
                        <div class="list">
                          <?php foreach ($v['size_list'] as $key => $val):?>
                          <p class="special <?php if($key == 0){echo 'act';}?>" data-price="<?php echo $val['version_price']?>" data-name="<?php echo $val['version_name']?>" data-pid="<?php echo $v['id'];?>" data-id="<?php echo $val['id'];?>"><i></i><?php echo $val['version_name']?></p>
                          <?php endforeach;?>
                        </div>
                      </li>
                    </ul>
                    <?php endif;?>
                    
                    
                    <div class="cont">
                        <p class="text num">数量</p>
                        <a href="javascript:;" type="reduce" data-id="<?php echo $v['id'];?>" class="but">-</a>
                        <input class="nums" id="num_<?php echo $v['id']?>" type="text" value="1">
                        <a href="javascript:;" type="add" data-id="<?php echo $v['id'];?>" class="but">+</a>
                        <a type="add_to_cars" href="javascript:;" data-id="<?php echo $v['id'];?>" data-size='<?php if(isset($v['attr'])){echo json_encode($v['attr']);}else{echo '[]';}?>' data-info='<?php echo json_encode($v);?>' class="buy">加入购物车</a>
                    </div>

                </li>
                <?php endforeach;?>
                <?php endif;?>
               
            </ul>
        </div>

        
        <a id="end" href="/drink/cars" class="page-car"><p id="cars_num"></p></a>

        <!-- 底部 -->
        <?php $this->load->view('common/new_footer')?>
    </div>  
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([
           '<?php echo css_js_url('jsyd.js', 'wap')?>',
           '<?php echo css_js_url('m-public.js', 'wap')?>',
           '<?php echo css_js_url('AnimationFrame.js', 'wap')?>',
           '<?php echo css_js_url('swiper.min.js', 'wap')?>'
	    ], function(a,b){
           var swiper = new Swiper('.wap-banner', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                autoplay:2500
            });
          
            b.load();
            a.start();
            a.jump();
            a.size();
            a.index_add_cars();
            a.index_add_reduce();
            a.buy_index();
            $(".media-chose").click(function() {
                $(this).toggleClass("act");
            });
            if($(".media-chose").find(".active")){
            	$(".media-chose").find(".active").siblings().css("height","auto");
            	$(".media-chose").prepend($(".media-chose").find(".active"));
            }

            $(function(){
              $('.malls-list .buy').on('click', addProduct);
              function addProduct(event) {
                  var offset = $('#end').offset(), flyer = $('<img class="u-flyer" src="<?php echo $domain['static']['url']?>/wap/images/drink-icon4.png">' );
      
                  flyer.fly({
      
                      start: {
      
                          left: event.pageX,
      
                          top: event.pageY-$(window).scrollTop()-15
      
                      },
      
                      end: {
      
                          left: offset.left+25,
      
                          top: $(window).height()-100,
      
                          width: 16,
      
                          height: 16
      
                      }
      
                  });
              }
            });

            
        })
    </script>
</body>
</html>
