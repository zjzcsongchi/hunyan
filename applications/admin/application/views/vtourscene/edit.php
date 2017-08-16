<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/vtourscene">场景列表</a></li>
    <li class="active">修改场景</li>
</ol>

<div class="container-fluid" style="margin:10px;">
    <fieldset>
        <legend>修改场景</legend>
        <form class="form-horizontal">
            <input type="hidden" name="id" value="<?php echo $info['id']?>"/>
            <div class="form-group">
    			<label class="col-sm-3 control-label">上传全景图</label>
    			<div class="col-sm-9">
    				<ul id="uploader_img">
    			        <?php if(!empty($info['source_img'])):?>
    				    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo get_img_url($info['source_img'])?>" target="_blank"><img src="<?php echo get_img_url($info['source_img'])?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="img" value="<?php echo $info['source_img'];?>"/>
                        </li>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_img"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
    		<div class="form-group">
    		  <label class="col-sm-3 control-label">名称</label>
    		  <div class="col-sm-6">
    		      <input type="text" class="form-control" name="name" value="<?php echo $info['name']?>"/>
    		  </div>
    		</div>
    		<div class="form-group">
    		  <label class="col-sm-3 control-label">类型</label>
    		  <div class="col-sm-6">
    		      <select name="type" class="form-control">
    		          <?php foreach ($type as $k => $v):?>
    		          <option value="<?php echo $k?>" <?php if($k == $info['type']) echo 'selected';?>><?php echo $v?></option>
    		          <?php endforeach;?>
    		      </select>
    		  </div>
    		</div>
    		<div class="form-group">
    		  <div class="col-sm-6 text-center">
    		      <a class="btn btn-primary" id="make_vtour">制 作</a>
    		  </div>
    		</div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
var object = [
              {"obj": "#uploader_img", "btn": "#btn_img"}
              ];
var upload_domain = '<?php echo $domain['upload']['url']?>';
seajs.use(['<?php echo css_js_url('vr_upload.js', 'admin')?>','<?php echo css_js_url('vtour.js', 'admin')?>','admin_uploader', 'jqueryswf','swfupload'], function(swfupload, vtour, admin_uploader){
  swfupload.swfupload(object);
  vtour.edit_scene();
});
</script>
</body>
</html>