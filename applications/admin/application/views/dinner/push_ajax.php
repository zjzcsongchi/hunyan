<form class="form-horizontal" id="push_form">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<div class="form-group">
		<label class="col-sm-3 control-label">选择推送类型</label>
		<div class="col-sm-5">
			<?php foreach($return_arr as $k => $v): ?>
			<div class="checkbox-inline check_show" data-remark="<?php echo $v['out_str'] ?>">
    		<label><input type="checkbox" name="<?php echo $v['key_name'] ?>" value="1" <?php echo $v['is_send'] == 1 ? 'checked disabled is_check="1"' : '' ?> ><?php echo $v['key_text'] ?></label>
    		</div>
			<?php endforeach; ?>
			<span class="help-block">已选中选项表示已推送</span>
		</div>
	</div>
</form>
