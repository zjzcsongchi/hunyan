<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/">首页</a></li>
        <li><a href="/coupon">优惠卷列表</a></li>
        <li><a href="#">优惠券发放</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>优惠券发放</span></div>
    <ul class="forminfo">
        <li><input type="hidden" name='coupon_id' value="<?php echo $info['id'];?>" /></li>
        <li>
            <label>类型</label>
            <input type="text"  name='coupon_name' class="dfinput" value="<?php echo $type['name'];?>" readonly/>
        
        </li>
        <li>
            <label>优惠价格</label>
            <input type="text" name='coupon_money' value="<?php echo $info['favorable']?>" class="dfinput" readonly/>
        </li>
        <li>
            <label>发放手机号</label>
            <input name="phone" type="text"  class="dfinput" />
        </li>
        
        <!--li>
            <label>过期时间</label>
            <input name="end_time" type="text" value="<?php echo  date('Y-m-d H:i:s', time() + 3600*24*30);?>" class="dfinput Wdate" style="height:32px;width:184px" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"/>
        </li-->
        <li>
            <label>有效期</label>
            <select class="dfinput selects" name="end_time">
                <option>---请选择优惠卷有效期---</option>
                <option value="7">七天</option>
                <option value="15">十五天</option>
                <option value="30" selected>一个月</option>
                <option value="90">三个月</option>
            </select>
        </li>
        
        <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认发放"/></li>
    </ul>
    </form>
</div>

</body>
</html>