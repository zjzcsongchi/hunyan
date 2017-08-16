<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('new_m_wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body class="grey">
    <div class="page-main padbot100">
        <div class="frame-info">
            <div class="img-cont"><img src="<?php echo get_img_url($msg['cover_img'])?>"></div>
            <div class="brife">
                <p class="title"><?php echo $msg['title']?></p>
                <?php if(isset($info_list)):?>
                <p class="text">
                <?php if(isset($info_list[0]['attribute'])){echo $info_list[0]['attribute'];}?>
                                        ：<?php if(isset($info_list[0]['value'])){echo $info_list[0]['value'];}?></p>
                <?php endif;?>
                <p class="price">￥<?php if(isset($type)){echo $type['version_price'];}else{echo $msg['present_price'];}?></p>
            </div>
        </div>
        <div class="album-cont">
            <p class="max-title">选择入册相片<label><input id="all" type="checkbox"><span>全选</span></label></p>
            <ul class="user-list1 album-list frame">
                <div class="wall-column">
                <?php if(isset($img_list_left)):?>
                <?php foreach ($img_list_left as $k => $v):?>
                    <div class="list">
                        <img data-id="<?php echo $v['id'];?>" src="<?php if(isset($v['thumb'])){echo get_img_url($v['thumb']);}?>">
                        <i class="active"></i>
                        <a href="javascript:;" data-fullimg="<?php echo get_img_url($v['img']);?>" data-img_id="<?php echo $v['id'];?>" class="see">查看</a>
                    </div>
                <?php endforeach;?>
                <?php endif;?>
                </div>
                <div class="wall-column">
                <?php if(isset($img_list_right)):?>
                <?php foreach ($img_list_right as $k => $v):?>
                    <div class="list">
                        <img data-id="<?php echo $v['id'];?>" src="<?php if(isset($v['thumb'])){echo get_img_url($v['thumb']);}?>">
                        <i class="active"></i>
                        <a href="javascript:;" data-fullimg="<?php echo get_img_url($v['img']);?>" data-img_id="<?php echo $v['id'];?>" class="see">查看</a>
                    </div>
                <?php endforeach;?>
                <?php endif;?>
                </div>
            </ul>
        </div>
         
        
        <div class="bottom-cont">
            <div class="car"><p><?php echo $num?></p></div>
            <p class="text"><?php echo $msg['title']?></p>
            <a href="javascript:;" status="0" class="but">立即结算</a>
            <p id="price" class="price" data="<?php echo $price;?>">￥<?php echo $price+C('order.delivery_type.express.price');?></p>
        </div>
        <div class="popup-bottom">
            <div class="close"></div>
            <div class="user-cont">
                <input type="hidden" id="type_id" value="<?php if(isset($type)){echo $type['id'];}?>">
                <input type="hidden" id="product_id" value="<?php echo $product_id;?>">
                <input type="hidden" id="num" value="<?php echo $num;?>">
                <input type="hidden" name="cover_img" id="cover_img" />
                <p class="max-title">填写收货信息</p>                      
                <ul class="album-info">
                    <li>
                        <p class="head">联系人：</p>
                        <input type="text" id="name" value="<?php if(isset($addr['name'])){echo $addr['name'];}?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x771F;&#x5B9E;&#x59D3;&#x540D;">
                    </li>
                    <li>
                        <p class="head">联系电话：</p>
                        <input type="tel" id="mobile_phone"  value="<?php if(isset($addr['mobile_phone'])){echo $addr['mobile_phone'];}?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x8054;&#x7CFB;&#x7535;&#x8BDD;">
                    </li>
                    <li>
                        <p class="head">送货方式：</p>
                        <select name="delivery_type" data="<?php echo C('order.delivery_type.express.price')?>">
                        <?php foreach (C('order.delivery_type') as $k => $v):?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                        <?php endforeach;?>
                        </select>
                    </li>
                    <li class="post_method"  data="<?php echo C('order.delivery_type.express.price')?>">
                    <p class="head">邮费：</p>
                    <p><span>￥<?php echo C('order.delivery_type.express.price')?></span></p>
                    </li>
                    <li id="addr">
                        <p class="head">收货地址：</p>
                        <textarea id="address" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x6536;&#x8D27;&#x5730;&#x5740;"><?php if(isset($addr['address'])){echo $addr['address'];}?></textarea>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="see-bigimg">
            <div id="close" class="close"></div>
            <img src="">
            <a id="set_cover_img" data="">设置为相册封面</a>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('album_detail.js', 'wap')?>' ], function(p,k){
            p.load();
            k.add();
            k.select();
            k.select_all();
            k.see(event);
            k.set_cover_img();
            $(".frame-order li").click(function() {
                $(this).toggleClass("act");
            });
            $(".close").click(function() {
                $(".popup-bottom").removeClass("act");
                $(".bottom-cont .but").attr('status', 0);
                $(".bottom-cont .but").html("立即结算");
                $('#set_cover_img').show();              
            });
            $(".album-list .list").click(function() {
                $(this).toggleClass("act");
            });

            $('#close').click(function(){
				$('.see-bigimg').removeClass('act');
            })
        })
    </script>
</body>
</html>
