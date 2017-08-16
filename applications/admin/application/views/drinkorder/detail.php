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
        
        <table class="table table-bordered table-hover">
        <tr>
            <th colspan="4" class="text-center active">
                                百年订单
            </th>
        </tr>
        <tr>
            <th class="active">客户姓名</th>
            <td><?php echo $dinner['user']['name']?></td>
            <th class="active">合同编号</th>
            <td><?php echo $dinner['contract_num']?></td>
        </tr>
        <tr>
            <th class="active">客户电话</th>
            <td><?php echo $dinner['user']['mobile_phone']?></td>
            <th class="active">宴会类型</th>
            <td><?php echo $dinner['venue_type_name']?></td>
        </tr>
        <tr>
            <th class="active">接单人</th>
            <td><?php echo $dinner['receiver']?>
            <th class="active">宴会日期</th>
            <td><?php echo $dinner['solar_time']?></td>
        </tr>
        
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎姓名</th>
            <td><?php echo $dinner['roles_main']?></td>
            <?php else:?>
            <th class="active">宴会主角</th>
            <td><?php echo $dinner['roles_main']?></td>
            <?php endif;?>
            <th class="active">农历</th>
            <td><?php echo $dinner['lunar_time']?></td>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎电话</th>
            <td><?php echo $dinner['roles_wife_mobile']?></td>
            <?php else:?>
            <th class="active">宴会电话</th>
            <td><?php echo $dinner['roles_main_mobile']?></td>
            <?php endif;?>
            <th class="active">宴会场馆</th>
            <td><?php echo $dinner['venue_name']?></td>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新娘姓名</th>
            <td><?php echo $dinner['roles_wife']?></td>
            <?php else:?>
            <th class="active">缺省值</th>
            <td></td>
            <?php endif;?>
            <th class="active">订餐信息</th>
            <td><?php echo $dinner['detail']['name']?></td>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新娘电话</th>
            <td><?php echo $dinner['roles_wife_mobile']?></td>
            <?php else:?>
            <th class="active">缺省值</th>
            <td></td>
            <?php endif;?>
            <th class="active">订餐桌数</th>
            <td><?php echo $dinner['menus_count']?></td>
        </tr>
        <tr>
            <th class="active">签订合同人</th>
            <td><?php echo $dinner['sign_contract']?></td>
            <th class="active">已交订金</th>
            <td><?php echo $dinner['deposit']?></td>
        </tr>
        <tr>
            <th class="active">签订合同人电话</th>
            <td><?php echo $dinner['sign_contract_mobile']?></td>
            <th class="active">婚庆公司</th>
            <td><?php echo $dinner['company']?></td>
        </tr>
        <tr>
            <th class="active">经办人</th>
            <td><?php echo $dinner['create_admin']?></td>
            <th class="active">代金券信息</th>
            <td><?php echo $dinner['coupon_info']?></td>
        </tr>
        <tr>
            <th class="active">微请帖信息</th>
            <td><?php echo $dinner['card_info']?></td>
            <th class="active">棋牌室信息</th>
            <td><?php echo $dinner['chess_card']?></td>
        </tr>
        <tr>
            <th class="active">米粉</th>
            <td><?php echo $dinner['rice_flour']?></td>
            <th class="active">签订合同日期</th>
            <td><?php echo $dinner['contract_date']?></td>
        </tr>
        <tr>
            <th class="active">备注</th>
            <td><?php echo $dinner['remark']?></td>
        </tr>
        
    </table>
        
        
        <table class="table table-bordered">
            <tr>
                <th colspan="4" class="text-center active">
                                    酒水订单
                </th>
            </tr>
            
            <tr>
                <th class="active">订单号</th>
                <td><?php echo $info['order_num']?></td>
                <th class="active">客户姓名</th>
                <td><?php echo $info['order_man']?></td>
            </tr>
            <tr>
                <th class="active">订单状态</th>
                <td>
                    <?php foreach (C('order.delivery_status') as $k => $v):?>
                    <?php if($info['status'] == $v['id']){echo $v['name'];}?>
                    <?php endforeach;?>
                </td>
                <th class="active">客户电话</th>
                <td><?php echo $info['man_phone']?></td>
            </tr>
            <tr>
                <th class="active">公历时间</th>
                <td>
                    <?php echo date("Y-m-d", strtotime($info['g_time']));?> <?php echo $info['start_time']?>
                </td>
                <th class="active">经办人</th>
                <td><?php echo $admin_name?></td>
            </tr>
            <tr>
                <th class="active">农历时间</th>
                <td>
                    <?php echo $info['n_time']?> <?php echo $info['week']?>
                </td>
                <th class="active">接待人</th>
                <td><?php echo $info['receptionist']?></td>
            </tr>
            <tr>
                <th class="active">宴会类型</th>
                <td>
                    <?php foreach ($party as $k => $v):?>
                    <?php if($info['order_type'] == $v['id']){echo $v['name'];}?>
                    <?php endforeach;?>
                </td>
                <th class="active">宴会场馆</th>
                <td>
                    <?php foreach($venue_list as $k => $v):?>
                       <?php if(in_array($v['id'], explode(',', $info['place_id']))){echo $v['name'];}?>
                    <?php endforeach;?>
                </td>
            </tr>
            <tr>
                <th class="active">备注</th>
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
                <?php if($info['delivery_type'] == 0):?>
                <td>运费：30元</td>
                <?php else:?>
                <td>运费：0元</td>
                <?php endif;?>
                <td>需要支付:<?php echo $info['need_pay']?>元</td>
                <td></td>
            </tr>
        </table> 
        
    </form>
</div>


<?php $this->load->view('common/footer')?>
<script>
seajs.use(['<?php echo css_js_url('adddrinkorder.js', 'admin')?>','jqvalidate'], function(a){
	a.input_express();
	a.select();
})
</script>
</body>
</html>
