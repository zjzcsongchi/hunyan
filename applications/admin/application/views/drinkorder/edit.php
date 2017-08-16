<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/orders/index"><?php echo $title[0]?></a>
    <li><a href="#"><?php echo $title[1]?></a></li>
</ol>

<div class="container-fluid">
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
    <form  id="form" method="post">
        <table class="table table-bordered">
            <tr>
                <th>商品id</th>
                <th>类别</th>
                <th>商品名称</th>
                <th>规格</th>
                <th>价格</th>
                <th>数量</th>
                <th>小计</th>
                <th>操作</th>
            </tr>
            <tr id="first">
                <td></td>
                <td>
                    <select id="class_id" class="form-control">
                        <option value="">选择商品类型</option>
                        <?php foreach ($drink_class as $k => $v):?>
                        <option value="<?php echo $k?>"><?php echo $v?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td>
                   <select id="goods" data="" class="form-control">
                        <option value="">选择商品</option>
                    </select>
                </td>
                <td>
                   <select id="special" class="form-control" name="special_id">
                        <option value="">选择规格</option>
                    </select>
                </td>
                <td><input type="text" id="unit_price" name="unit_price" class="form-control" readonly></td>
                <td>
                    <input type="text" id='num' name="num" value="1" class="form-control">
                </td>
                <td><input type="text" id="price" name="price" class="form-control" readonly></td>
                <td><a id="add_goods" class="btn btn-danger">添加商品</a> <a id="open_close" class="btn btn-danger" data ='0'>展开订单基本信息</a></td>
            </tr>
            <tbody id ="tbody">
            
                <?php if(isset($list)):?>
                <?php foreach ($list as $k => $v) :?>
				
				<tr class="t_1">
				<td><?php echo $v['id']?></td>
				<td><?php echo $drink_class[$v['class_id']]?><input name="class_id[]" value="<?php echo $v['class_id']?>" type="hidden"></td>
				<td><?php echo $v['foods_name']?><input name="product_id[]" value="<?php echo $v['foods_id']?>" type="hidden"></td>
				<td><?php echo isset($special_name[$v['special_id']]) && $special_name[$v['special_id']]?$special_name[$v['special_id']]:''?>
				<input name="special_id[]" value="0" type="hidden"></td>
				<td><?php echo $v['unit_price']?><input name="unit_price[]" value="<?php echo $v['unit_price']?>" type="hidden"></td>
				<td><?php echo $v['num']?><input name="num[]" value="<?php echo $v['num']?>" type="hidden"></td><td><span class="per_sum">
				<?php echo $v['unit_price']*$v['num']?></span>
				<input name="price[]" value="<?php echo $v['unit_price']*$v['num']?>" type="hidden"></td>
				<td><a id_class="del" class="btn btn-danger remove">移除</a></td></tr>
				
				
				
				
				<?php endforeach;?>
				<?php endif;?>
            </tbody>
            <tr>
                <td colspan='7'></td>
            </tr>
            <tr>
                <td></td>
                <td>合计：<span id="total"><?php echo $info['total_price']?></span></td>
                <td>
                                            订金:
                    <input type="text" id="bargain_money" value='<?php echo $info['bargain_money']?>' name="bargain_money" class="form-control" placeholder="优惠" style="width:80%;margin-left:36px;margin-top:-24px;"/>
                    </td>
                <td>
                                            优惠:
                    <input type="text" id="free" value='<?php echo $info['free_price']?>' name="free" class="form-control" placeholder="优惠" style="width:80%;margin-left:36px;margin-top:-24px;"/>
                </td>
                
                
                <td>需要支付:<span id="need"></span>
                <input name="need_pay" value="" type="hidden"/>
                </td>
                
               
                <td colspan="2">
                    <div class="form-group">
                                                 备注
                        <div style="margin-left:36px;margin-top:-24px;">
                            <textarea rows="2" name="remark" class="form-control"><?php echo $info['order_info']?></textarea>
                        </div>
                    </div>
                </td>
            </tr>
        </table> 
        <div class="form-group" style="display:none">
            <div class="col-sm-7 text-center">
                <a id="save_3" class="btn btn-danger" >全部保存</a>
            </div>
        </div> 
        
        <div class="col-sm-12 text-center">
            <a id="save_2" class="btn btn-danger" >保存</a>
        </div>
        
        <br>
        <br>
    </form>
</div>


<?php $this->load->view('common/footer')?>
<script>
var order_id = "<?php echo $info['id']?>";

seajs.use(['<?php echo css_js_url('adddrinkorder.js', 'admin')?>','jqvalidate'], function(a){
	a.save();
	a.sum();
    a.add_goods();
    a.erji();
    a.autoadd();
    a.finsh();
    a.need();
    a.del();
    a.edit();
    a.edit_order();
    a.datepick();
    a.open_close();
})
</script>
</body>
</html>
