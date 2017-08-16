<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/orders/index"><?php echo $title[0]?></a>
    <li><a href="#"><?php echo $title[1]?></a></li>
</ol>

<div class="container-fluid">
    <form id="base" class="form-horizontal col-sm-10">
        <div id="one">
        <div class="form-group">
            <label class="col-sm-3 control-label">姓名 </label>
            <div class="col-sm-5">
                <input type="hidden" id='order_id' name="id" value="">
                <input type="text" id="order_man" name="order_man" class="form-control" valType="required" msg="请输入姓名" placeholder="请输入客户姓名">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">手机号 </label>
            <div class="col-sm-5">
                <input type="text" id="man_phone" name="man_phone" class="form-control" valType="MOBILE" msg="手机号输入不合法" placeholder="请输入客户手机号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">备注</label>
            <div class="col-sm-5">
                <textarea rows="3" id="order_info" name="order_info" class="form-control" ></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">接待人</label>
            <div class="col-sm-5">
                <input type="text" id="receptionist" name="receptionist" class="form-control" valType="required" msg="请添加接待人" placeholder="请输入接单人"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">用餐场馆 </label>
            <div class="col-sm-5">
                <ul class="list-inline">
                    <?php foreach($venue_list as $k => $v):?>
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="<?php echo $v['id']?>" name="place_id[]"/>
                                <?php echo $v['name']?>
                            </label>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">婚宴类型 </label>
            <div class="col-sm-5">
                <select id="order_type" class="form-control" name="order_type">
                    <option value="" valType="required" msg="类型必须选择">选择婚宴类型</option>
                    <?php foreach ($party as $k => $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">预约公历时间 </label>
            <div class="col-sm-5">
                <input type="text" class="form-control Wdate" style="height:34px" id="g_time" name="g_time"  value="" placeholder="请输入预约公历时间">
            </div>
        </div>    
        <div class="form-group">
            <label class="col-sm-3 control-label">预约农历时间</label>
            <div class="col-sm-5">
                <input id="n_time" type="text" class="form-control lunardate" valType="required" msg="请等待系统计算农历时间" style="height:34px" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">星期</label>
            <div class="col-sm-5">
                <input id="week" type="text" class="form-control week" readonly/>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-sm-3 control-label">宴会用餐时间</label>
            <div class="col-sm-5">
                <input type="text" class="form-control tdate" style="height:34px" id="start_time" name="start_time" placeholder="请选择开席时间">
            </div>
        </div>
       
        <div class="form-group">
            <label class="col-sm-3 control-label">已交订金</label>
            <div class="col-sm-5">
                <input type="text" id="bargain_money" name="bargain_money" value="0.00" class="form-control" placeholder="请输入已交订金"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-7 text-center">
                <a id="save_2" class="btn btn-danger" >添加订单信息</a>
            </div>
        </div>
        <input id="order_num" type="hidden"  name="order_num" class="form-control" readonly />
        </div>
        <div id="two" style="display:none;">
        <div class="form-group">
            <div class="col-sm-7 text-center">
        
        </div>
        </div>
        <br>
        <br>
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
            <tr>
                <td></td>
                <td>
                    <select id="class_id" class="form-control" name="class_id">
                        <option value="">选择商品类型</option>
                        <?php foreach ($drink_class as $k => $v):?>
                        <option value="<?php echo $k?>"><?php echo $v?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td>
                   <select id="goods" data="" class="form-control" name="foods_id">
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
                    <input type="hidden" id='cn_name' name="cn_name"  class="form-control">
                </td>
                <td><input type="text" id="price" name="price" class="form-control" readonly></td>
                <td><a id="add_goods" class="btn btn-danger">添加商品</a> <a id="open_close" class="btn btn-danger" data ='0'>展开订单基本信息</a></td>
            </tr>
            <tbody id ="tbody"></tbody>
            <tr>
                <td colspan='7'></td>
            </tr>
            <tr>
                <td></td>
                <td>合计：</td>
                <td id="total"></td>
                <td>优惠：</td>
                <td><input type="text" id="free" value='0.00'  class="form-control" placeholder="优惠"/></td>
                <td>需要支付:</td>
                <td id='need'></td>
            </tr>
        </table> 
        <div class="form-group">
            <label class="col-sm-3 control-label">订单状态 *</label>
            <div class="col-sm-5">
                <select id="status" class="form-control" >
                    <option value="" valType="required" msg="必须选择状态">选择状态</option>
                    <?php foreach (C('orders_status') as $k => $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-7 text-center">
                <a id="save_3" class="btn btn-danger" >保存全部</a>
            </div>
        </div>  
        <br>
        <br>
        </div>
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
    a.datepick();
    a.open_close();
})
</script>
</body>
</html>
