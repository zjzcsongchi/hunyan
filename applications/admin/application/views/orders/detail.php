<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/orders/index"><?php echo $title[0]?></a>
    <li><a href="#"><?php echo $title[1]?></a></li>
</ol>

<div class="container-fluid">
    <form id="base" data="" class="form-horizontal col-sm-10">

        <table class="table table-bordered">
            <tr>
                <td class="active"><b>订单号:</b></td>
                <td><?php echo $info['order_num']?></td>
                <td class="active"><b>客户姓名:</b></td>
                <td><?php echo $info['order_man']?></td>
            </tr>
            <tr>
                <td class="active"><b>订单状态:</b></td>
                <td>
                    <?php foreach (C('orders_status') as $k => $v):?>
                    <?php if($info['status'] == $v['id']){echo $v['name'];}?>
                    <?php endforeach;?>
                </td>
                <td class="active"><b>客户电话:</b></td>
                <td><?php echo $info['man_phone']?></td>
            </tr>
            <tr>
                <td class="active"><b>公历时间:</b></td>
                <td>
                    <?php echo date("Y-m-d", strtotime($info['g_time']));?> <?php echo $info['start_time']?>
                </td>
                <td class="active"><b>经办人:</b></td>
                <td><?php echo $admin_name?></td>
            </tr>
            <tr>
                <td class="active"><b>农历时间:</b></td>
                <td>
                    <?php echo $info['n_time']?> <?php echo $info['week']?>
                </td>
                <td class="active"><b>接待人:</b></td>
                <td><?php echo $info['receptionist']?></td>
            </tr>
            <tr>
                <td class="active"><b>宴会类型:</b></td>
                <td>
                    <?php foreach ($party as $k => $v):?>
                    <?php if($info['order_type'] == $v['id']){echo $v['name'];}?>
                    <?php endforeach;?>
                </td>
                <td class="active"><b>宴会场馆:</b></td>
                <td>
                    <?php foreach($venue_list as $k => $v):?>
                       <?php if(in_array($v['id'], explode(',', $info['place_id']))){echo $v['name'];}?>
                    <?php endforeach;?>
                </td>
            </tr>
            <tr>
                <td class="active"><b>备注:</b></td>
                <td colspan="3">
                    <?php echo $info['order_info']?>
                </td>
            </tr>
                      
        </table>
        <table class="table table-bordered table-hover">
            <tr>
                <th>商品id</th>
                <th>商品名称</th>
                <th>封面图</th>
                <th>价格</th>
                <th>数量</th>
                <th>小计</th>
            </tr>
            <tbody id ="tbody">
            <?php if(isset($list)):?>
                <?php foreach ($list as $k => $v) :?>
                <tr id="t_<?php echo $v['id']?>">
				    <td><?php echo $v['id']?></td>
				    <td><?php echo $v['foods_name']?></td>
				    <td><img width="150" height="150" style="overflow: hidden;" src="<?php echo get_img_url($v['cover_img'])?>"/></td>
				    <td><?php echo $v['unit_price']?></td>
				    <td><?php echo $v['num']?></td>
				    <td><?php echo $v['total_price']?></td>
				<tr>
				<?php endforeach;?>
				<?php endif;?>
            </tbody>
            <tr>
                <td colspan='7'></td>
            </tr>
            <tr>
                <td>合计：</td>
                <td>总金额：<?php echo $info['total_price'];?>元</td>
                <td>押金：<?php echo $info['bargain_money']?>元</td>
                <td>优惠：<?php echo $info['free_price'];?>元</td>
                <td>需要支付:<?php echo $info['need_pay']?>元</td>
                <td></td>
            </tr>
        </table> 
        
    </form>
</div>


<?php $this->load->view('common/footer')?>
<script>
seajs.use(['<?php echo css_js_url('adddrinkorder.js', 'admin')?>','jqvalidate'], function(a){
})
</script>
</body>
</html>
