<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common/index">首页</a></li>
        <li><a href="/coupon">优惠卷列表</a></li>
        <li><a href="#">发放</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>套餐内容</span></div>
    <ul class="forminfo">
        <li><label>类型</label>
        <select class="dfinput selects" name="type_id">
            <option>---请选择优惠卷类型---</option>
            <?php foreach ($type as $k => $v) :?>
                <option value="<?php echo $v['id']?>"><?php echo $v['name'] ?></option>
            <?php endforeach;?>
        </select>
        <i></i></li>
        <li><label>优惠价格</label><input name="favorable" type="text" class="dfinput" /><i></i></li>
        <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认保存"/></li>
    </ul>
    </form>
</div>
</body>
</html>