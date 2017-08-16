<?php $this->load->view('common/header');?>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common/index">首页</a></li>
        <li><a href="/coupon">优惠卷列表</a></li>
        <li><a href="#">添加</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>添加优惠券</span></div>
    <ul class="forminfo">
        <li><label>合同编号</label><input type="text" name="contract_num" class="dfinput" /></li>
        <li><label>优惠券编号</label><input type="text" name="number" class="dfinput" /></li>
        <li><label>有效期</label><input type="text" name="end_time" class="form-control Wdate" style="height: 34px;" placeholder="请选择日期"/> </li>
        <li><label>优惠价格</label><input name="money" type="text" class="dfinput" /><i></i></li>
        <li><label>&nbsp;</label><input type="submit" class="btn btn-primary" value="确认保存"/></li>
    </ul>
    </form>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('coupon.js', 'admin')?>'], function(a){
		//a.del();
		//a.show_tables();
		//a.up_show();
        //a.examination();
        a.wdate();
        a.save();
	})
</script>
</body>
</html>