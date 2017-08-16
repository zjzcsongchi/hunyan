<form class="form-horizontal">
	<input type="hidden" name="id">
	<div class="form-group">
		<label class="control-label col-sm-2">热点名称</label>
		<div class="col-sm-8">
			<input type="text" name="hotspot_name" class="form-control" >
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">提示文字</label>
		<div class="col-sm-8">
			<input type="text" name="hotspot_text" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">自定义图标</label>
		<div class="col-sm-8">
			<ul class="nav nav-tabs" role="tablist">
				<li class="active" id="system_nav" data-target="system">
					<a href="#system" data-toggle="tab">选择图标</a>
				</li>
				<li data-target="customize" id="customize_nav">
					<a href="#customize" data-toggle="tab">上传自定义图标</a>
				</li>
			</ul>
			<div class="tab-content" style="height:200px; overflow-y:scroll;">
				<div id="system" class="tab-pane active">
					<ul class="list-inline">
						<?php if($default_ico): ?>
						<?php foreach($default_ico as $v): ?>
						<li>
							<div class="radio">
								<label>
									<input type="radio" name="ico" value="<?php echo $v['url'] ?>" data-is_dynamic="<?php echo $v['is_dynamic'] ?>" data-dynamic_url="<?php echo $v['dynamic_url'] ?>" data-dynamic_param="<?php echo $v['dynamic_param'] ?>">
									<img src="<?php echo get_img_url($v['url']) ?>" style="max-width: 100px;max-height: 100px" class="img-thumbnail">
								</label>
							</div>
						</li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
				<div id="customize" class="tab-pane">
					<ul id="uploader_ico">
						<li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
							<a href="javascript:;" class="up-img"  id="btn_ico"><span>+</span><br>添加图标</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">图文内容</label>
		<div class="col-sm-8">
			<textarea id="wang_editor" style="height: 400px;" name="content"></textarea>
		</div>
	</div>
</form>
