<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-<?php echo $title?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('new_index.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('new_public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('detail.css', 'www')?>">
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body>
    <!-- 头部 -->
     <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">
    <!-- 弹窗 -->
        <div id="bg" class="page-bg"></div>
        <div id="open" class="popup-bespeak" style="display:none">
    		<a class="close"></a>
    		<p class="head"><?php echo $info['title']?></p>
    		<ul>
    			<li><input type="text" placeholder="姓名" class="name" id="user_name" name="user_name" value="<?php if(isset($user_info)){echo $user_info['realname'];}?>"></li>
    			<li><input type="text" placeholder="电话" class="phone" id="user_mobile" name="user_mobile" value="<?php if(isset($user_info)){echo $user_info['mobile_phone'];}?>"></li>
    			<li><input type="text" placeholder="数量" name="num" ></li>
    			<li><select name="venue" id="post_method">
    			        <option  value="">--请选择配送方式--</option>
    					<?php foreach (C('post_method') as $k => $v) :?>
    					<option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
    					<?php endforeach;?>
    			</select></li>
    			<li><input type="text" placeholder="地址" class="address"
    				name="address" id="user_addr" style="width: 570px"></li>
    		</ul>
    		<p class="message">欢迎预约</p>
    		<a href="javascript:;" id="sure" class="submit">立即预约</a>
    	</div>
    
        <div class="banner-cont">
        <?php if(isset($video) && $video['video']):?>
            <video src="<?php echo get_vedio_url($video['video'])?>" controls="controls" loop="loop" style=" position: absolute; width: 100%;" autoplay="autoplay" poster="<?php echo $domain['static']['url']?>/www/images/banner.jpg"></video>
            <?php else:?>
            <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/banner.jpg" >
        <?php endif;?> 
            <div class="banner-con">
                <div class="baner-cont">
                    <div class="ewm">
                        <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/ewm.jpg" >
                        <p>扫一扫关注百年婚宴</p>
                    </div>
                    <div class="banner-title"></div>
                </div>
                <div class="search">
                    <input type="text" placeholder="&#x767E;&#x5E74;&#x5E78;&#x798F;&#x5385;">
                    <a href="javascript:;">搜索</a>
                </div>
            </div>
            <div class="count-cont">
                <div class="cont">
                    <div class="count"><span><?php echo $guest_num;?></span>位<br>已接待宾客</div>
                    <em></em>
                    <div class="count"><span><?php echo $wedding_num;?></span>场<br>已策划婚礼</div>
                    <em></em>
                    <div class="count"><span><?php echo $bless_num?></span>份<br>已收到祝福</div>
                    <em></em>
                    <div class="count"><span><?php echo $flower_num?></span>朵<br>已收到鲜花</div>
                </div>                
            </div>
        </div>
        
        <div class="right-menu">
            <a href="javascript:;" class="user"></a>
            <div class="car" id="end"><span id="car_detail">购物车</span><p id="count">0</p></div>
            <div class="cont">
                <div class="close"></div>
                <p class="head">成功加入购物车！</p>
                <p class="text">您可以去<a href="/drink/car" target="_blank" >购物车结算</a></p>
            </div>
        </div>
        
        <div class="index-main">
            <div class="page-main">
                <p class="head"><?php echo $drink_class[$info['class_id']]?></p>
                <div class="drink-detail" id="info_id" data="<?php echo $info['id']?>" img="<?php echo $info['cover_img']?>" class="right-cont">
                    <div id="tFocus" class="tFocus">
                        <div class="prev" id="prev"></div>
                        <div class="next" id="next"></div>
                        <ul id="tFocus-pic" class="tFocus-pic">
                        <?php if(isset($info['images']) && $info['images']):?>
                        <?php foreach ($info['images'] as $k=>$v):?>
                            <li><img src="<?php echo get_img_url($v)?>"></li>
                        <?php endforeach;?>
                        <?php endif;?>
                        </ul>
                        <div id="tFocusBtn" class="tFocusBtn">
                            <a href="javascript:void(0);" id="tFocus-leftbtn"></a>
                            <div id="tFocus-btn" class="tFocus-btn">
                                <ul>
                                 <?php if(isset($info['images']) && $info['images']):?>
                                    <?php foreach ($info['images'] as $k=>$v):?>
                                        <li><img src="<?php echo get_img_url($v)?>"></li>
                                    <?php endforeach;?>
                                 <?php endif;?>
                                </ul>
                            </div>
                            <a href="javascript:void(0);" id="tFocus-rightbtn"></a>
                        </div>
                    </div>
                    <div class="right-cont">
                        <p class="title" id="title" data="<?php echo $info['title']?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $info['title']?></p>
                        <div class="price-cont">
                            <span>价格</span><span class="text-red">￥</span><span class="price" id="price" data="<?php echo $info['present_price']?>"><?php echo $info['present_price']?></span>
                            <p class="icon"><i></i>批发价</p>
                            <?php if($info['flag']):?>
                            <?php foreach ($info['flag'] as $k=>$v):?>
                            <b><?php echo $v?></b>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        <ul class="info-list">
                            <li><span class="text1">名称</span><?php echo $info['title']?></li>
                            <li><span>生产厂家</span><?php echo $info['firm']?></li>
                            
                            <?php foreach ($new_lists as $k=>$v):?>
                            <li><span><?php echo $k?></span><?php echo $v?></li>
                            <?php endforeach;?>
                            
                        </ul>
                        <div class="num">【生产许可证编号】<span><?php echo isset($info['allow_num']) && $info['allow_num'] ? $info['allow_num']:''?></span></div>
                        <div class="cont">
                            <span>数量</span>
                            <a href="javascript:;" class="sum" id="reduce">-</a>
                            <input type="text" value="1" id="num">
                            <a href="javascript:;" class="sum but" id="add">+</a>
                            <?php if($info['is_promotion']):?>
                            <b class="icon1">折</b>
                            <b>惠</b>
                            <?php endif;?>
                        </div>
                        <?php if(isset($special_lists) && $special_lists):?>
                        <div class="cont">
                            <span>规格</span>
                            <div class="norms-cont">
                            <?php foreach ($special_lists as $k=>$v):?>
                            <div id="<?php echo $k?>" class="list <?php if($k == 0):?>act<?php endif;?> " data-price="<?php echo $v['version_price']?>" data-id="<?php echo $v['id']?>"><?php echo $v['version_name']?><i></i></div>
                            <?php endforeach;?>
							</div>
                        </div>
                        <?php endif;?>
                        <div class="cont">
                            <a href="javascript:;" class="destine buy">加入购物车</a>
                            <p class="pay-way">支付方式</p>
                        </div>
                        <p class="tip-text">
                            <span>温馨提示：</span>
                            <span>支持7天无理由退货 </span>
                            <span>正品保证</span>
                        </p>
                    </div>
                </div>
                
                <?php if($info['class_id'] == C('products.drinks_class.cigarette.id')):?>
                <p class="head">推荐香烟</p>
                <?php else:?>
                <p class="head">推荐酒水</p>
                <?php endif;?>
                
                <?php if(isset($class)):?>
                <ul class="venue-list">
                <?php foreach ($class as $k =>$v):?>
                    <li data_id="<?php echo $v['id']?>">
                        <?php if($v['is_promotion']):?>
                            <em>促<br>销</em>
                        <?php endif;?>
                        <img src="<?php echo get_img_url($v['cover_img']);?>">
                        <p class="title"><?php echo $v['title']?></p>
                        <p class="icon">
                        <?php if(isset($class[$k]['flag'])):?>
                        <?php foreach ($class[$k]['flag'] as $key=>$val):?>
                        <span><?php echo $val?></span>
                        <?php endforeach;?>
                        <?php endif;?>
                        </p>
                        <div class="price">¥<span><?php echo $v['present_price']?></span>/<?php echo $v['unit']?><p>批发价<i></i></p></div>
                    </li>
                <?php endforeach;?>    
                </ul>
                <?php endif;?>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script>
    var id = "<?php echo $info['id']?>";
    </script>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('drink_detail.js', 'www')?>','<?php echo css_js_url('pic-tab.js', 'www')?>', '<?php echo css_js_url('jquery.lazyimg.js', 'www')?>'], function(a){
			a.load();
			a.add_reduce();
			a.add_car('<?php echo get_img_url($info['images'][0])?>');
			a.buy();
			a.car_detail();
			$("img").lazyimg({threshold:300});//阀值，距可视区域300px 时再进行图片加载
        })
    </script>
    
</body>
</html>
