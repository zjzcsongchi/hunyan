<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('wap-user.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>

</head>

<body class="grey">
    <div class="page-main padbot100">
        <div class="cover-img">
            <img src="<?php echo get_img_url($info['cover_img'])?>">
        </div>
        <div class="user-cont">
            <p class="max-title"><?php echo $info['title']?><span class="r" data="<?php if(isset($info['type_price'])){echo $info['type_price'][0]['version_price'];}else{echo $info['present_price'];}?>">￥<?php if(isset($info['type_price'])){echo $info['type_price'][0]['version_price'];}else{echo $info['present_price'];}?></span></p>
        </div>
        <div class="user-cont mar-top20">
            <ul class="frame-birfe">
                <?php if(isset($info['list'])):?>
                <?php foreach ($info['list'] as $k => $v):?>
                <li>
                    <p class="head"><?php echo $v['attribute']?>:</p>
                    <p><?php echo $v['value'];?></p>
                </li>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
        </div>
        <div class="user-cont mar-top20">
            <ul class="frame-birfe">
            <?php if(isset($info['type_price'])):?>
                <li>
                  <p class="head">规格：</p>
                  <div class="norms-cont">
                    
                    <?php foreach ($info['type_price'] as $key => $val):?>
                        <div class="list <?php if($key == 0){echo 'act';}?>" data-price="<?php echo $val['version_price']?>" data-id="<?php echo $val['id'];?>"><?php echo $val['version_name']?><i></i></div>
                    <?php endforeach;?>
                    
                  </div>
                </li>
                <?php endif;?>
                <li>
                    <p class="head">数量：</p>
                    <a id="less" href="javascript:;">-</a>
                    <input id="num" data="<?php echo $id;?>" type="text" value="1">
                    <a id="more" href="javascript:;">+</a>
                </li>
            </ul>
        </div>
        <?php if(!empty($info['following_effect'])): $info['following_effect'] = explode(';', $info['following_effect']);?>
            <div class="frame-detail">
                <p class="line"></p>
                <p class="title">跟拍效果</p>
                <?php foreach ($info['following_effect'] as $k => $v):?>
                <img style="width:100%; height:auto;" src="<?php echo get_img_url($v)?>">
                <?php endforeach;?>
            </div>
        <?php else:?>
            <div class="frame-detail">
                <p class="line"></p>
                <p class="title">详情描述</p>
                <?php echo $info['info']?>
            </div>
        <?php endif;?>
        <div class="bottom-cont">
            <div class="car"></div>
            <p class="text"><?php echo $info['title']?></p>
            <a href="javascript:;" type_id="<?php if(isset($info['type_price'][0]['id'])){echo $info['type_price'][0]['id'];}?>" class="but">立即下单</a>
            <p class="price">￥<?php if(isset($info['type_price'])){echo $info['type_price'][0]['version_price'];}else{echo $info['present_price'];}?></p>
        </div>

    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('album_detail.js', 'wap')?>'], function(p,k){
            p.load();
            k.num();
            k.submit();
            /*切换规格*/
            $('.list').click(function(){
    			$(this).addClass('act');
    			$('.r').attr('data', $(this).data('price'));
    			var price = $(this).data('price');
    			var num = $('#num').val();
    			var t = parseFloat(price)*parseFloat(num);
    			$('.r').html('￥'+price);
    			$('.price').html('￥'+t);
    			$(this).siblings().removeClass('act');
    			$('.but').attr('type_id', $(this).data('id'));
            })
        })
    </script>
</body>
</html>
