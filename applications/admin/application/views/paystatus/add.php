<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/customer/index">订单管理</a></li>
    <li class="active"><a href="#">添加支付订单</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>添加支付订单</h1></legend>
        
        <form class="form-horizontal" method="post" action="/paystatus/add" id="base">
        
             <div class="form-group">
                <label class="col-sm-2 control-label">支付款项*</label>
                <div class="col-sm-4">
                    <div class="radio">
                    <?php foreach ($payment as $k => $v):?>
                        <label <?php if($k != 2):?>style="display:none"<?php endif;?>><input type="radio" name="payment" value="<?php echo $k?>" <?php if($k == 2):?>checked<?php endif;?>><?php echo $v?></label>
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">支付方式*</label>
                <div class="col-sm-4">
                    <div class="radio">
                    <?php foreach ($pay_type as $k => $v):?>
                        <label ><input type="radio" name="pay_type" value="<?php echo $k?>" <?php if($k == 1):?>checked<?php endif;?>><?php echo $v?></label>
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
        
        
            <div class="form-group">
                <label class="col-sm-2 control-label">支付金额*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="money" valType="required" msg="金额不能为空" placeholder="请输入支付金额,单位：元">
                </div>
            </div>
            
            <div class="form-group" style="display:none">
                <label class="col-sm-2 control-label">折扣券金额</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="coupon" msg="金额不能为空" placeholder="请输入支付金额,单位：元">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">支付日期</label>
                <div class="col-sm-4">
                    <input type="text" name="pay_time" class="form-control Cdate" placeholder="请选择支付日期">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">备注</label>
                <div class="col-sm-4">
                    <textarea rows="4" name="remark" class="form-control" placeholder="请输入备注信息"></textarea>
                </div>
            </div>
            
            <!-- 相册 -->
            
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <input type="submit" id="submit" value="保  存" class="btn btn-danger">
                </div>
            </div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
var dinner_id = "<?php echo $dinner_id?>";
seajs.use(['<?php echo css_js_url('paystatus.js', 'admin')?>','jqvalidate','jqueryswf','swfupload'], function(a){
    a.save();
    <?php if(isset($min_date) && isset($max_date)):?>
    a.datepick(<?php echo $min_date?>, <?php echo $max_date?>);
    <?php else:?>
    a.datepick();
    <?php endif;?>
})
</script>
</body>
</html>