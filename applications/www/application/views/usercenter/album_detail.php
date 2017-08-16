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

    <link href="<?php echo css_js_url('pc-public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('pc-user.css', 'www');?>" type="text/css" rel="stylesheet" />
    
    <?php $this->load->view('common/baidu_tongji')?>
    
</head>
<body class="grey">
     <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">
        <!-- 用户信息头部 -->
        <?php $this->load->view('common/user_banner')?>

        <div class="page-main padbot200">
            <!-- 用户中心 左侧菜单栏 -->
            <?php $this->load->view('common/user_leftmenu')?>
            <div class="user-right">
                <p class="max-title">婚礼纪实<span>- 相册材质</span><i class="arow"></i></p>
                <div id="tFocus" class="tFocus">
                    <div class="prev" id="prev"></div>
                    <div class="next" id="next"></div>
                    <ul id="tFocus-pic" class="tFocus-pic">
                        <li><img src="<?php echo get_img_url($info['cover_img'])?>"></li> 
                        <?php if(!empty($info['images']) && count($info['images'] > 0)):?>
                                <?php foreach ($info['images'] as $k => $v):?>
                                <li><img src="<?php echo get_img_url($v);?>"></li> 
                                <?php endforeach;?>
                        <?php endif;?>                           
                    </ul>
                    <div id="tFocusBtn" class="tFocusBtn">
                        <a href="javascript:void(0);" id="tFocus-leftbtn"></a>
                        <div id="tFocus-btn" class="tFocus-btn">
                            <ul>
                                <li class="active"><img src="<?php echo get_img_url($info['cover_img'])?>"></li> 
                                <?php if(!empty($info['images']) && count($info['images'] > 0)):?>
                                    <?php foreach ($info['images'] as $k => $v):?>
                                    <li><img src="<?php echo get_img_url($v);?>"></li> 
                                    <?php endforeach;?>
                                <?php endif;?>                                
                            </ul>
                        </div>
                        <a href="javascript:void(0);" id="tFocus-rightbtn"></a>
                    </div>
                </div>
                <div class="frame-brife">
                    <p class="title"><?php echo $info['title']?></p>
                    <p class="price">价格<span>￥<?php if(isset($info['type_price'])){echo $info['type_price'][0]['version_price'];}else{echo $info['present_price'];}?></span></p>
                    <ul>
                        <?php if(isset($info['list'])):?>
                            <?php foreach ($info['list'] as $k => $v):?>
                            <li><p class="head"><?php echo $v['attribute']?> : </p><p><?php echo $v['value']?></p></li>
                            <?php endforeach;?>
                        <?php endif;?>
                        <li>
                          <p class="head t">规格</p>
                          <div class="norms-cont">
                            <?php if(isset($info['type_price'])):?>
                            <?php foreach ($info['type_price'] as $key => $val):?>
                            <div class="list <?php if($key == 0){echo 'act';}?>" data-price="<?php echo $val['version_price']?>" data-id="<?php echo $val['id'];?>"><?php echo $val['version_name']?><i></i></div>
                            <?php endforeach;?>
                           <?php endif;?>
                          </div>
                        </li>
                        <li><p class="head t">数量</p><a id="less" href="javascript:;">-</a><input id="num" type="text" value="1"><a id="more" href="javascript:;">+</a></li>
                    </ul>
                    <a href="javascript:;" type="<?php if(isset($info['type_price'][0]['id'])){echo $info['type_price'][0]['id'];}?>" data="1" dataid="<?php echo $info['id']?>" class="buy-but">立即购买</a>
                </div>
                <?php if(isset($info['following_effect']) && !empty($info['following_effect'])): $info['following_effect'] = explode(';', $info['following_effect']);?>
                <div class="frame-detail">
                    <p class="title"><span>跟拍效果</span></p>
                    <?php foreach ($info['following_effect'] as $k => $v):?>
                    <img style="width:100%; height:auto;" src="<?php echo get_img_url($v)?>">
                    <?php endforeach;?>
                </div>
                <?php else :?>
                <div class="frame-detail">
                    <p class="title"><span>详情描述</span></p>
                    <?php echo $info['info']?>
                </div>
                <?php endif;?>
                
            </div>
        </div>
    </div>

    <div class="page-bg"></div>
    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    seajs.use(['public', '<?php echo css_js_url('user_pc.js', 'www')?>', '<?php echo css_js_url('pic-tab.js', 'www')?>'], function(a,b){
		a.load();
		b.hidden();
		b.num();
		b.jump();
		$(".user-banner .edit").click(function() {
            $(".page-bg").addClass("act");
            $(".popup-userinfo").addClass("act");
        });
        $(".popup-userinfo .close").click(function() {
            $(".page-bg").removeClass("act");
            $(".popup-userinfo").removeClass("act");
        });

        addLoadEvent(Focus());

        $('.list').click(function(){
			$(this).addClass('act');
			$('.buy-but').attr('type', $(this).data('id'));
			$('.price').html('价格<span>￥'+$(this).data('price')+'</span>');
			$(this).siblings().removeClass('act');
        })
    })
    </script>
</body>
</html>
