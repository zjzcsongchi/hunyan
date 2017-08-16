<?php $this->load->view('common/header2')?>

<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/hotspotico/scene_change">热点图标管理</a></li>
    <li>编辑</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <form class="form-horizontal">
        <div class="form-group">
			<label class="col-sm-3 control-label">图标地址</label>
			<div class="col-sm-9">
				<ul id="uploader_img">
				    <?php if(!empty($info['url'])):?>
    				    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo get_img_url($info['url'])?>" target="_blank"><img src="<?php echo get_img_url($info['url'])?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="img" value="<?php echo $info['url'];?>"/>
                        </li>
                    <?php endif;?>
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_img"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
        </div>
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
			<label class="col-sm-3 control-label">动态图标地址</label>
			<div class="col-sm-9">
				<ul id="uploader_dynamic_img">
				    <?php if(!empty($info['dynamic_url'])):?>
    				    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo get_img_url($info['dynamic_url'])?>" target="_blank"><img src="<?php echo get_img_url($info['dynamic_url'])?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="dynamic_img" value="<?php echo $info['dynamic_url'];?>"/>
                        </li>
                    <?php endif;?>
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_dynamic_img"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
        </div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">是否动态图标</label>
		  <div class="col-sm-6">
		      <input type="radio"  value='1' name="is_dynamic" <?php if ($info['is_dynamic'] == 1 ): ?>checked="checked"<?php endif;?> />是
		      <input type="radio"  value='0' name="is_dynamic" <?php if ($info['is_dynamic'] == 0 ): ?>checked="checked"<?php endif;?>/>否
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">是否默认图标</label>
		  <div class="col-sm-6">
		      <input type="radio"  value='1' name="is_default" <?php if ($info['is_default'] == 1 ): ?>checked="checked"<?php endif;?> />是
		      <input type="radio"  value='0' name="is_default" <?php if ($info['is_default'] == 0 ): ?>checked="checked"<?php endif;?> />否
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">动态图标参数</label>
		  <div class="col-sm-6">
		      <input name="dynamic_param" type="text" value="<?php echo $info['dynamic_param'] ?>" class="form-control">
		      <span class="help-block">格式为：“100,100,60”，三个参数以英文逗号分隔，第一个为动画每一帧图片宽，第二个为每一帧图片高，第三个为每一帧图片切换频率。</span>
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-sm-6 text-center">
		      <a class="btn btn-primary" id="make_vtour">保存</a>
		  </div>
		</div>
    </form>
</div>
<?php $this->load->view('common/footer')?>
<script>
var object = [
      {"obj": "#uploader_img", "btn": "#btn_img"},
      {"obj":　"#uploader_dynamic_img", "btn": "#btn_dynamic_img"},
     ];

var upload_domain = '<?php echo $domain['upload']['url']?>';
/*
seajs.use(['<?php echo css_js_url('vr_upload.js', 'admin')?>','<?php echo css_js_url('vtour.js', 'admin')?>','admin_uploader', 'jqueryswf','swfupload'], function(swfupload, vtour, admin_uploader){
  swfupload.swfupload(object);
  vtour.make();
});
*/
seajs.use(['<?php echo css_js_url('hotspot.js', 'admin')?>', 'admin_uploader', 'jqueryswf', 'swfupload'], function (hotspot,admin_uploader) {
	admin_uploader.swfupload(object);
    hotspot.edit_scene();
});
</script>
</body>
</html>
