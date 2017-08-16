<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/orders/index"><?php echo $title[0]?></a>
    <li><a href="#"><?php echo $title[1]?></a></li>
</ol>

<div class="container-fluid">
    <form id="base" data="" class="form-horizontal col-sm-10">
        <div id="one">
        <div class="form-group">
            <label class="col-sm-3 control-label">姓名 *</label>
            <div class="col-sm-5">
                <input type="hidden" id='order_id' name="id" value="<?php echo $info['id']?>">
                <input type="text" id="order_man" value="<?php echo $info['order_man']?>" name="order_man" class="form-control" valType="required" msg="请输入姓名" placeholder="请输入客户姓名">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">手机号 *</label>
            <div class="col-sm-5">
                <input type="text" id="man_phone" value="<?php echo $info['man_phone']?>" name="man_phone" class="form-control" valType="MOBILE" msg="手机号输入不合法" placeholder="请输入客户手机号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">备注</label>
            <div class="col-sm-5">
                <textarea rows="3" id="order_info" name="order_info" class="form-control" ><?php if(isset($info['order_info'])){echo $info['order_info'];}?></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">接待人</label>
            <div class="col-sm-5">
                <input type="text" id="receptionist" name="receptionist" value="<?php echo $info['receptionist']?>" class="form-control" placeholder="请输入接单人"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">用餐场馆 *</label>
            <div class="col-sm-5">
                <ul class="list-inline">
                    <?php foreach($venue_list as $k => $v):?>
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="<?php echo $v['id']?>" <?php if(in_array($v['id'], explode(',', $info['place_id']))){echo 'checked';}?> name="place_id[]"/>
                                <?php echo $v['name']?>
                            </label>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">婚宴类型 *</label>
            <div class="col-sm-5">
                <select id="order_type" class="form-control" name="order_type">
                    <option value="">选择婚宴类型</option>
                    <?php foreach ($party as $k => $v):?>
                    <option <?php if($info['order_type'] == $v['id']){echo 'selected';}?> value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">预约公历时间 *</label>
            <div class="col-sm-5">
                <input type="text" class="form-control Wdate" style="height:34px" id="g_time" name="g_time" value="<?php echo date("Y-m-d",strtotime($info['g_time']));?>" placeholder="请输入预约公历时间">
            </div>
        </div>  
        <div class="form-group">
            <label class="col-sm-3 control-label">预约农历时间</label>
            <div class="col-sm-5">
                <input id="n_time" type="text" value="<?php echo $info['n_time']?>" class="form-control lunardate" style="height:34px" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">星期</label>
            <div class="col-sm-5">
                <input id="week" type="text" value="<?php echo $info['week']?>" class="form-control week" readonly/>
            </div>
        </div>    
        <div class="form-group">
            <label class="col-sm-3 control-label">宴会用餐时间</label>
            <div class="col-sm-5">
                <input type="text" class="form-control tdate" style="height:34px" id="start_time" value="<?php echo $info['start_time']?>"  name="start_time" placeholder="请选择开席时间">
            </div>
        </div>
       
        <div class="form-group">
            <label class="col-sm-3 control-label">已交订金</label>
            <div class="col-sm-5">
                <input type="text" id="bargain_money" value="<?php if(isset($info['bargain_money'])){echo $info['bargain_money'];}else{echo '0.00';}?>" name="bargain_money" class="form-control" placeholder="请输入已交订金"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-7 text-center">
                <a id="edit_order" class="btn btn-danger" >保存订单信息</a>
            </div>
        </div>


        <input id="order_num" type="hidden" value="<?php echo $info['order_num']?>" name="order_num" class="form-control" readonly />
        </div>
        <br>
        <br>
        <div id="two" style="display: none;">
        
        <br>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>商品id</th>
                <th>类别</th>
                <th>商品名称</th>
                <th>价格</th>
                <th>数量</th>
                <th>小计</th>
                <th>操作</th>
            </tr>
            <tr>
                <td></td>
                <td>
                    <select id="class_id" class="form-control">
                        <option value="">选择商品类型</option>
                        <?php foreach ($class as $k => $v):?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['cn_name']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td>
                   <select id="goods" data="" class="form-control" name="foods_id">
                        <option value="">选择商品</option>
                    </select>
                </td>
                <td><input type="text" id="unit_price" name="unit_price" class="form-control" readonly></td>
                <td>
                    <input type="text" id='num' name="num" value="0" class="form-control">
                    <input type="hidden" id='cn_name' name="cn_name"  class="form-control">
                </td>
                <td><input type="text" id="price" name="price" class="form-control" readonly></td>
                <td><a id="add_goods" class="btn btn-danger">添加商品</a><a id="open_close" class="btn btn-danger" data ='0'>展开订单基本信息</a></td>
            </tr>
            <tbody id ="tbody">
                <?php if(isset($list)):?>
                <?php foreach ($list as $k => $v) :?>
                <tr id="t_<?php echo $v['id']?>">
				    <td><?php echo $v['id']?></td>
				    <td>
				    <?php if($class):?>
				    <?php foreach ($class as $kk => $vv):?>
				    <?php if($vv['id'] == $v['class_id']):?>
				    <?php echo $vv['cn_name']?>
				    <?php endif;?>
				    <?php endforeach;?>
				    <?php endif;?>
				    </td>
				    <td><?php echo $v['foods_name']?></td>
				    <td><input type="text" id="unit_price_<?php echo $v['id']?>" name="unit_price" value="<?php echo $v['unit_price']?>" class="form-control" readonly></td>
				    <td><input idds type="text" id="num_<?php echo $v['id']?>" name="num" value="<?php echo $v['num']?>" data="<?php echo $v['id']?>" class="form-control"></td>
				    <td class="price_" data="<?php echo $v['total_price']?>"><input type="text" data="<?php echo $v['id']?>" id="price_<?php echo $v['id']?>" name="price" value="<?php echo $v['total_price']?>" class="form-control" readonly/></td>
				    <td>
				        <a id_class="del" data="<?php echo $v['id']?>" class="btn btn-danger">移除</a>
				        <a id_class="edit" data="<?php echo $v['id']?>" class="btn btn-danger">修改</a>
				    </td>
				<tr>
				<?php endforeach;?>
				<?php endif;?>
            </tbody>
            <tr>
                <td colspan='7'></td>
            </tr>
            <tr>
                <td></td>
                <td>合计：</td>
                <td id="total"><?php echo $info['total_price'];?></td>
                <td>优惠：</td>
                <td><input type="text" id="free" value="<?php echo $info['free_price'];?>"  class="form-control" placeholder="优惠"/></td>
                <td>需要支付:</td>
                <td id='need'><?php echo $info['need_pay']?></td>
            </tr>
        </table> 
        <div class="form-group">
            <label class="col-sm-3 control-label">订单状态 *</label>
            <div class="col-sm-5">
                <select id="status" class="form-control" >
                    <option value="">选择状态</option>
                    <?php foreach (C('orders_status') as $k => $v):?>
                    <option <?php if($info['status'] == $v['id']){echo 'selected';}?> value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-7 text-center">
                <a id="save_3" class="btn btn-danger" >全部保存</a>
            </div>
        </div> 
        </div> 
        <br>
        <br>
    </form>
</div>


<?php $this->load->view('common/footer')?>
<script>
seajs.use(['<?php echo css_js_url('adddrinkorder.js', 'admin')?>','jqvalidate'], function(a){
    a.save_order();
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
    //每次进入编辑页，都要检测价格信息，避免数据出错
    var total_price = 0;
	$('.price_').each(function(k,v){
		total_price+=parseFloat($(v).attr('data'));
	})
	$('#total').html(total_price);
	$('#need').html( parseFloat($('#total').html()) - parseFloat($('#free').val()) - parseFloat($('#bargain_money').val()) );
})
</script>
</body>
</html>
