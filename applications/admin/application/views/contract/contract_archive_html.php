<div class="forminfo small-size">
<label>支付方式：</label>
<select class="form-control" id="method_payment">
<?php foreach ($pay_type as $k => $v): ?>
<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
<?php endforeach; ?>
</select>
<br/>
<label>尾款金额：</label>
<input type="text" class="form-control" id="final_payment" value="" />
<br/>
<label>优惠：</label>
<input type="text" class="form-control" id="coupon_num" value="" />
<br/>
<label>备注：</label><br>
<textarea id="remark" class="form-control"></textarea>
<br/>
<label>可用代金券：</label>
<?php if ($lists): ?>
<?php foreach ($lists as $k => $v): ?>
<br/>
<input type="checkbox" name="coupons" value="<?php echo $v['id']; ?>" /><?php echo $v['number'] . '：' . $v['money']; ?>
<?php endforeach;?>
<?php else: ?>
无
<?php endif; ?>
</div>