<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/coupon">优惠卷列表</a></li>
        <li><a href="#">添加</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>套餐内容</span></div>
    <ul class="forminfo">
        <li><input type="hidden" name='id' value="<?php echo $info['id'];?>" /></li>
        <li><label>优惠价格</label><input name="name" type="text" value="<?php echo $info['name']?>" class="dfinput" /><i></i></li>
        <li>
            <label>是否删除&nbsp;&nbsp;
            <input name="is_del" <?php if($info['is_del'] == 1) echo 'checked';?> type="radio"  value="1"/>是
            </label>
            <label>
            <input name="is_del" <?php if($info['is_del'] == 0) echo 'checked';?> type="radio"  value="0"/>否
            </label>
        </li>
        <li><label>&nbsp;</label><input name="" type="submit" class="btn btn-primary" value="确认保存"/></li>
    </ul>
    </form>
</div>
</body>
</html>