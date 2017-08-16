<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('pc-public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('pc-user.css', 'www')?>">
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
                <p class="max-title borno">立即结算
                    <a href="javascript:window.history.go(-1)">
                        <i class="arow"></i>
                    </a>
                </p>
                <div class="album-order">
                    <?php if(isset($detail)):?>
                    <?php foreach ($detail as $k=>$v):?>
                    <div class="frame-info">
                        <?php if(isset($special_img[$v['special_id']]) && $special_img[$v['special_id']]):?>
                        <img src="<?php echo get_img_url($special_img[$v['special_id']])?>">
                        <?php else:?>
                        <img src="<?php echo get_img_url($produdts_img[$v['product_id']])?>">
                        <?php endif;?>
                        <p class="text"><span><?php echo $produdts_name[$v['product_id']]?></span>
                            <?php if(isset($special_lists[$v['special_id']]) && $special_lists[$v['special_id']]):?>
                            <br>规格：<?php echo $special_lists[$v['special_id']]?>
                            <?php endif;?>
                        <br>数量：<?php echo $v['count']?>
                        
                        <?php if(isset($attr[$v['product_id']]) && $attr[$v['product_id']]):?>
                        <?php foreach ($attr[$v['product_id']] as $key=>$val):?>
                        <br><?php echo $key?>：<?php echo $val?>
                        <?php endforeach;?>
                        <?php endif;?>
                        </p>
                        <p class="price">￥<?php echo $v['price']?></p>
                    </div>
                    
                    <ul class="album-info">
                        <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                            <li >
                                <p class="head"></p>
                                <p></p>
                            </li>
                        <?php endif?>
                    </ul>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <ul class="album-info">
                        <li>
                            <p class="head">联系人：</p>
                            <p><?php echo isset( $addr['name']) ?  $addr['name'] : '未填写'?></p>
                        </li>
                        <li>
                            <p class="head">联系电话：</p>
                             <p><?php echo isset($addr['mobile_phone']) ? $addr['mobile_phone']: '未填写'?></p>
                        </li>
                        <li>
                            <p class="head">送货方式：</p>
                            
                             <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                                <p><?php echo C('order.delivery_type.express.name')?></p>
                                <p class="head">邮费：</p>
                                <p><span>￥<?php echo C('order.delivery_type.express.price') ?></span></p>
                            <?php else:?>
                                <p><?php echo C('order.delivery_type.ziti.name')?></p>
                            <?php endif?>
                            
                        </li>
                        <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                            <li>
                                <p class="head">收货地址：</p>
                                <p><?php echo isset($addr['address']) ? $addr['address'] : '未填写'?></p>
                            </li>
                        <?php endif?>
                    </ul>
                </div>
                <div class="album-order">
                    <div class="price">优惠：￥<?php echo $favorable?></div>
                    <?php if($order['status'] == C('order.pay_status.success.id') ):?>
                        <a href="javascript:;" class="but-buy unable">已支付</a>
                    <?php else:?>   
                        <a href="javascript:;" class="but-buy checkout">立即付款</a>
                        <input type="hidden" name='order_id' id='order_id' value="<?php echo $order['id']?>" />
                    <?php endif?>
                    
                    <p class="count">￥<?php echo $need_pay?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-bg"></div>
    <div class="see-bigimg">
        <div class="close"></div>
        <div class="img"><img id="bigimg" src=""></div>
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([
           '<?php echo css_js_url('order.js', 'www')?>'
        ], function(order){
          order.load();
          $(".close").click(function() {
              $(".page-bg").removeClass("act");
              $(".see-bigimg").removeClass("act");
          });
          $('.see').click(function(){
              var imgurl = $(this).data('img');
              $('#bigimg').attr('src', imgurl);
        	  $(".page-bg").addClass("act");
	          $(".see-bigimg").addClass("act");
		        //获得本次图片的宽和高
	            $('#bigimg').on('load', function(){
	            	var height = $(this).height();
		            var width = $(this).width();
		            $(".see-bigimg img").css("margin-top",'-'+parseInt(height)/2+'px');
		            $(".see-bigimg img").css("margin-left",'-'+parseInt(width)/2+'px');
	            })
          })
		})
    </script>

</body>
</html>
