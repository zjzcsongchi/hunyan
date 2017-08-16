<?php $this->load->view('common/header2')?>
<ol class="breadcrumb hidden-print">
    <li><a href="/common">首页</a></li>
    <li><a href="/orderimage">相册订单管理</a></li>
    <li class="active">订单详情</li>
</ol>

<div class="container-fluid">
<input type="hidden" id="order_id" value="<?php echo $info['id']?>">
    <fieldset>
        <legend>
            <button class="btn btn-primary hidden-print" onclick="window.history.go(-1);"><span class="glyphicon glyphicon-chevron-left"></span> 返 回</button>订单详情
        </legend>
    </fieldset>
    <p class="text-center hidden-print">
        <button class="btn btn-primary" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> 打印</button>
        <button class="btn btn-primary" id="express_btn"><span class="glyphicon glyphicon-edit"></span> 填写运单信息</button>
    </p>
    <table class="table table-bordered">
        <tr>
            <th colspan="6" class="text-center h2">订单信息</th>
        </tr>
        <tr>
            <th>订单号</th>
            <td><?php echo $info['order_id']?></td>
            <th>订单状态</th>
            <td><?php echo $info['status_text']?>；<?php echo $info['delivery_status_text']?></td>
            <th>支付方式</th>
            <td><?php echo $info['pay_type_text']?></td>
        </tr>
        <tr>
            <th>下单人</th>
            <td><?php echo $info['realname']?></td>
            <th>下单人电话</th>
            <td><?php echo $info['mobile_phone']?></td>
            <th>送货方式</th>
            <td><?php echo $info['delivery_type_text']?></td>
        </tr>
        <tr>
            <th>下单时间</th>
            <td><?php echo $info['create_time']?></td>
            <th>支付时间</th>
            <td><?php echo $info['pay_time']?></td>
            <th>发货时间</th>
            <td><?php echo $info['delivery_time']?></td>
        </tr>
        <tr>
            <th>订单金额</th>
            <td><?php echo $info['need_pay']+$info['favorable']?></td>
            <th>支付金额</th>
            <td><?php echo $info['need_pay']?></td>
            <th>优惠金额</th>
            <td><?php echo $info['favorable']?></td>
        </tr>
        <tr>
            <th>积分抵扣</th>
            <td><?php echo $info['score_favorable']?></td>
            <th></th>
            <td></td>
            <th></th>
            <td></td>
        </tr>
        <!-- 收货地址 -->
        <tr>
            <th colspan="6" class="text-center">收货信息 </th>
        </tr>
        <?php if($info['address']):?>
        <tr>
            <th>收货人</th>
            <td><?php echo $info['address']['name']?></td>
            <th>收货人电话</th>
            <td><?php echo $info['address']['mobile_phone']?></td>
            <th>收货地址</th>
            <td><?php echo $info['address']['address']?></td>
        </tr>
        <?php endif;?>
        <tr>
            <th>快递公司</th>
            <td><?php echo $info['express_company']?></td>
            <th>快递单号</th>
            <td><?php echo $info['express_number']?></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table class="table table-bordered hidden-print">
        <?php if(isset($special)):?>
        <tr>
            <th colspan="6" class="text-center">规格</th>
        </tr>
        <tr>
            <td colspan="6" class="text-center"><img style="max-width:200px" src="<?php echo get_img_url($special['version_image']);?>" /><br/><?php echo $special['version_name']?></td>
        </tr>
        <?php endif;?>
        <tr>
            <th colspan="6" class="text-center">商品详情</th>
        </tr>
        <?php if($info['detail']):?>
        <?php for ($i = 0; $i < (ceil(count($info['detail'])/6)); $i++):?>
        <tr>
            <?php for ($j = $i*6; $j < ($i+1)*6 && $j < count($info['detail']); $j++):?>
            <td >
            <p class="text-center">
            <?php if($info['detail'][$j]['product_type'] == C('order.product_type.image.id') || $info['detail'][$j]['product_type'] == C('order.product_type.all_image.id')):?>
            <a href="<?php echo get_img_url($info['detail'][$j]['img'])?>" target="_blank">
            <img  title="点击查看大图" style="max-width:200px;" src="<?php echo get_img_url($info['detail'][$j]['sy_img'])?>">
            </a>
            <?php elseif($info['detail'][$j]['product_type'] == C('order.product_type.album.id')):?>
            <img style="max-width:200px" src="<?php echo get_img_url($info['detail'][$j]['cover_img'])?>">
            <br>相簿：
            <?php echo $info['detail'][$j]['title']?> <?php echo $info['detail'][$j]['count']?>本
            
            <?php endif;?>
            </p>
            </td>
            <?php endfor;?>
        </tr>
        <?php endfor;?>
        <?php endif;?>
        <?php if(isset($info['album_cover'])):?>
        <tr>
            <th colspan="6" class="text-center">相册封皮</th>
        </tr>
        <tr>
            <td colspan="6" class="text-center">
                <a href="<?php echo get_img_url($info['album_cover']['img'])?>" target="_blank">
                <img  title="点击查看大图" style="max-width:200px;" src="<?php echo get_img_url($info['album_cover']['thumb'])?>">
                </a>
            </td>
        </tr>
        <?php endif;?>
    </table>
    <?php if(isset($img_lists)):?>
    <table class="table table-bordered hidden-print">
        <tr>
            <th colspan="6" class="text-center">入册相片</th>
        </tr>
    </table>
    <?php foreach($img_lists as $k => $v):?>
        <?php if($k%6 == 0):?>
        <div class="row hidden-print">
          <?php $i = $k; for ($i;$i<$k+6; $i++):?>
          <div class="col-sm-2">
          <?php if(isset($img_lists[$i])):?>
             <img title="点击查看原图" data="<?php if(!empty($img_lists[$i]['img'])){echo get_img_url($img_lists[$i]['img']);}?>" style="width: 100%;" src="<?php if(!empty($img_lists[$i]['thumb'])): echo get_img_url($img_lists[$i]['thumb']); endif; ?>" class="img-responsive"/>
            <?php endif;?>
          </div>
          <?php endfor;?>
        </div>
        <br/>
        <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('order_image.js', 'admin')?>'], function(image){
	image.input_express();
    	$('.col-sm-2 img').on('click', function(){
        	if($(this).attr('data') != ''){
        		window.open($(this).attr('data'));
            }
    	})
	})
</script>
</body>
</html>