<?php $this->load->view('common/header2')?>
<ol class="breadcrumb hidden-print">
    <li><a href="/common">首页</a></li>
    <li><a href="/orders/index"><?php echo $title[0]?></a>
    <li><a href="#"><?php echo $title[1]?></a></li>
</ol>

<div class="container-fluid">
    <form id="base" data=""  col-sm-10">
        <input type="hidden" id="order_id" value="<?php echo $id?>">
        <fieldset>
        <legend>
            <button class="btn btn-primary hidden-print" onclick="window.history.go(-1);"><span class="glyphicon glyphicon-chevron-left"></span> 返 回</button>订单详情
        </legend>
         </fieldset>
         <p class="text-center hidden-print">
             <span class="btn btn-primary" id="express_btn">填写运单信息</span>
             <span class="btn btn-primary" onclick="window.print();">打印</span>
        </p>
        <table class="table table-bordered">
            <tr>
                <td class="active"><b>订单号:</b></td>
                <td><?php echo $order_info['order_id']?></td>
                <td class="active"><b>联系人姓名:</b></td>
                <td><?php echo $info['name']?></td>
            </tr>
            <tr>
                <td class="active"><b>订单状态:</b></td>
                <td>
                    <?php if($order_info['delivery_status'] == 0):?>
                    待配送
                    <?php else:?>
                    已配送
                    <?php endif;?>
                </td>
                <td class="active"><b>联系人电话:</b></td>
                <td><?php echo $info['mobile_phone']?></td>
            </tr>
            <tr>
                <td class="active"><b>备注:</b></td>
                <td colspan="1">
                    <?php echo $order_info['express_remark']?>
                </td>
                <td class="active"><b>地址:</b></td>
                <td colspan="1">
                    <?php echo $info['address']?>
                </td>
            </tr>
                      
        </table>
        <table class="table table-bordered table-hover">
            <tr>
                <th>商品</th>
                <th>商品名称</th>
                <th>封面图</th>
                <th>价格</th>
                <th>数量</th>
                <th>小计</th>
            </tr>
            <tbody id ="tbody">
            <?php if(isset($list)):?>
                <?php foreach ($list as $k => $v) :?>
                <tr>
				    <td><?php echo $k+1?></td>
				    <td><?php echo $v['product_name']?></td>
				    <td>
				    <?php if(isset($special_img[$v['special_id']]) && $special_img[$v['special_id']]):?>
				    <img width="150" height="150" style="overflow: hidden;" src="<?php echo get_img_url($special_img[$v['special_id']])?>"/>
				    <?php else:?>
				    <img width="150" height="150" style="overflow: hidden;" src="<?php echo get_img_url($product_img[$v['product_id']])?>"/>
				    <?php endif;?>
				    </td>
				    <td><?php echo $v['price']?></td>
				    <td><?php echo $v['count']?></td>
				    <td><?php echo $v['per_price']?></td>
				<tr>
				<?php endforeach;?>
				<?php endif;?>
            </tbody>
            <tr>
                <td colspan='7'></td>
            </tr>
            <tr>
                <td>合计：<?php echo $sum;?></td>
                <td>优惠：<?php echo $order_info['favorable'];?>元</td>
                <td>总金额：<?php echo $sum;?>元</td>
                <?php if($order_info['delivery_type'] == 0):?>
                <td>运费：30元</td>
                <?php endif;?>
                <td>需要支付:<?php echo $order_info['need_pay']?>元</td>
                <td style="border-right:1px solid #ddd">支付状态:<?php echo $pay_status[$order_info['status']]?>
                <?php if($order_info['status'] == C('order.pay_status.success.id')):?>
                <img  style="width:3rem;margin-left:5px" src="<?php echo $domain['static']['url']?>/admin/images/pay_success.png">
                <?php endif;?>
                </td>
            </tr>
        </table> 
        
    </form>
</div>


<?php $this->load->view('common/footer')?>
<script>
seajs.use(['<?php echo css_js_url('adddrinkorder.js', 'admin')?>','jqvalidate'], function(a){
	a.express();
	a.select();
})
</script>
</body>
</html>
