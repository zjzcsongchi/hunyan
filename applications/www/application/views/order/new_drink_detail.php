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
    <?php $this->load->view('common/user_banner')?>
        <div class="page-main">
            <?php $this->load->view('common/user_leftmenu')?>
            <div class="user-right">
                <p class="max-title">订单详情
                <a href="javascript:window.history.go(-1)">
                <i class="arow"></i>
                </a></p>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="head" colspan="2">商品</td>
                        <td class="head" width="210">规格</td>
                        <td class="head" width="240">数量</td>
                        <td class="head" width="140">价格</td>
                    </tr>
                    
                    <?php if(isset($detail)):?>
                    <?php foreach ($detail as $k=>$v):?>
                    <tr>
                        <td>
                        <?php if(isset($special_img[$v['special_id']]) && $special_img[$v['special_id']]):?>
                        <img src="<?php echo get_img_url($special_img[$v['special_id']])?>">
                        <?php else:?>
                        <img src="<?php echo get_img_url($produdts_img[$v['product_id']])?>">
                        <?php endif;?>
                        </td>
                        <td><?php echo $produdts_name[$v['product_id']]?></td>
                        
                        <td>
                        <?php if(isset($special_lists[$v['special_id']]) && $special_lists[$v['special_id']]):?>
                        
                            <?php echo $special_lists[$v['special_id']]?>
                        
                        <?php endif;?>
                        </td>
                        
                        <td><?php echo $v['count']?></td>
                        <td><span>￥<?php echo $v['price']?></span></td>
                    </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                </table>
                <ul class="album-info order">
                    <li>
                        <p class="head">收货人：</p>
                        <p><?php echo isset( $addr['name']) ?  $addr['name'] : '未填写'?></p>
                    </li>
                    <li>
                        <p class="head">电话：</p>
                        <p><?php echo isset($addr['mobile_phone']) ? $addr['mobile_phone']: '未填写'?></p>
                    </li>
                    <li>
                        <p class="head">送货方式：</p>
                         <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                                <p><?php echo C('order.delivery_type.express.name')?></p>
                            <?php else:?>
                                <p><?php echo C('order.delivery_type.ziti.name')?></p>
                            <?php endif?>                        
                    </li>
                    <li>
                       <p class="head">邮费：</p>
                       
                        <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                            <p><span>￥<?php echo C('order.delivery_type.express.price') ?></span></p>
                        <?php else:?>
                            <p><span>￥0.00</span></p> 
                        <?php endif?>
                        
                    </li>
                    <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                        <li>
                            <p class="head">收货地址：</p>
                            <p><?php echo isset($addr['address']) ? $addr['address'] : '未填写'?></p>
                        </li>
                    <?php endif?>
                    
                </ul>
                <div class="album-order">
                    <div class="price">
                        总价：￥<?php echo $need_pay?><span>邮费：￥
                        <?php if($order['delivery_type'] == C('order.delivery_type.express.id') ):?>
                            <?php echo C('order.delivery_type.express.price') ?>
                        <?php else:?>
                            0.00
                        <?php endif?>
                        </span>
                    </div>
                    
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
    <div class="order-popup to-cancel">
        <p class="title1">确定要取消当前订单吗？</p>
        <a href="javascript:;" class="no">否</a>
        <a href="javascript:;" class="yes">是</a>
    </div>
    <div class="order-popup">
        <p class="title2">订单已取消</p>
        <a href="javascript:;" class="succes">完成</a>
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
