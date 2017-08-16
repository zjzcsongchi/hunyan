<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/customer/index">客户列表</a></li>
    <li class="active"><a href="#">添加客户</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
<form class="form-horizontal" method="post" id="form">
    <fieldset>
        <legend><h1>修改订单</h1></legend>
            <div class="form-group">
                <label class="col-sm-2 control-label">联系人*</label>
                <div class="col-sm-4">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="text" class="form-control" name="name" value="<?php echo $info['name']?>" valType="required" msg="联系人不能为空" placeholder="请输入联系人姓名">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">联系人手机号*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="mobile_phone" value="<?php echo $info['mobile_phone']?>" valType="MOBILE" msg="手机号格式不正确" placeholder="请输入联系人手机号">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">送货方式*</label>
                <div class="col-sm-4">
                    <select class="form-control" name="delivery_type" id="delivery_type">
                        <?php foreach (C('order.delivery_type') as $k => $v):?>
                        <option value="<?php echo $v['id']?>" <?php if($order['delivery_type'] == $v['id']):?>selected<?php endif;?> ><?php echo $v['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            
            
            <div class="form-group delivery_type">
            <?php if($order['delivery_type'] == 0):?>
            <label class="col-sm-2 control-label">地址*</label>
            <div class="col-sm-4"><input type="text" class="form-control" value="<?php echo $info['address']?>" valtype="required" msg="地址不能为空" name="address" style="height:34px" placeholder="请填写地址">
            </div>
            <?php endif;?>
            </div>
            <div class="form-group" style="display:none">
                <div class="col-sm-6 text-center">
                    <input type="submit" id="submit" value="保  存" class="btn btn-danger">
                </div>
            </div>
            </fieldset>
    
        <table class="table table-bordered" style="display:none">
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
				<td><?php echo $v['product_name']?><input name="product_id[]" value="<?php echo $v['product_id']?>" type="hidden"></td>
				<td><?php echo isset($special_name[$v['special_id']]) && $special_name[$v['special_id']]?$special_name[$v['special_id']]:''?>
				<input name="special_id[]" value="<?php echo $v['special_id']?>" type="hidden"></td>
				<td><?php echo $v['price']?><input name="unit_price[]" value="<?php echo $v['price']?>" type="hidden"></td>
				<td><?php echo $v['count']?><input name="num[]" value="<?php echo $v['count']?>" type="hidden"></td><td><span class="per_sum">
				<?php echo $v['price']*$v['count']?></span>
				<input name="price[]" value="<?php echo $v['price']*$v['count']?>" type="hidden"></td>
				<td><a id_class="del" class="btn btn-danger remove">移除</a></td></tr>
				
				<?php endforeach;?>
				<?php endif;?>
            </tbody>
            <tr>
                <td colspan='7'></td>
            </tr>
            <tr>
                <td></td>
                <td>合计：<span id="total"><?php echo isset($info['total_price'])?$info['total_price']:0 ?></span></td>
                <td>运费:<span id="express">
                <?php if($order['delivery_type'] == 0):?>
                30
                <?php else:?>
                0
                 <?php endif;?>
                </span>
                <td>需要支付:<span id="need"></span></td>
                <input name="total" value="" type="hidden"/>
                </td>
                
            </tr>
        </table> 
        
        <div class="col-sm-12 text-center">
            <a id="save_2" class="btn btn-danger" >保存</a>
        </div>
        
        <br>
        <br>
    </form>
     
</div>
<?php $this->load->view('common/footer')?>
<script type="text/javascript">
var delivery = "<?php echo $order['delivery_type']?>";
var address = "<?php echo $info['address']?>";
var order_id ="<?php echo $id?>";

seajs.use(['<?php echo css_js_url('online.js', 'admin')?>','jqvalidate'], function(a){
	a.delivery_type();
	a.save();
	a.sum();
    a.add_goods();
    a.erji();
    a.autoadd();
    a.finsh();
    a.del();
    a.edit();
    a.datepick();
})
</script>
</body>
</html>