<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/vtour">VR场景列表</a></li>
    <li>修改场景信息</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend>修改场景信息</legend>
        <form class="form-horizontal" method="post">
            <div class="form-group">
    			<label class="col-sm-3 control-label">选择场景类型</label>
    			<div class="col-sm-6">
    				<select class="form-control" id="scene_type">
    				<option value >请选择场景类型</option>
    				<?php foreach ($type as $k => $v):?>
    				<option value="<?php echo $k?>"><?php echo $v?></option>
    				<?php endforeach;?>
    				</select>
    			</div>
    		</div>
    		<div class="form-group">
    		    <label class="col-sm-3 control-label">选择场景</label>
    		    <div class="col-sm-9">
    		        <ul class="list-inline" id="scene_list">
    		          <?php foreach ($scene as $v):?>
                        <li>
                          <div class="checkbox">
                              <label>
                                  <input type="checkbox" checked value="<?php echo $v['id']?>" name="scene[]" />
                                  <img title="<?php echo $v['name']?>" style="max-width:100px;max-height:100px;" src="<?php echo get_img_url($v['thumb_img'])?>" class="img-thumbnail"/>
                                  <p class="text-center"><?php echo $v['name']?></p>
                              </label>
                          </div>
                        </li>
                        <?php endforeach;?>
    		        </ul>
    		    </div>
    		</div>
            <div class="form-group">
    			<label class="col-sm-3 control-label">选择场馆</label>
    			<div class="col-sm-6">
    				<select class="form-control" name="venue_id">
    				<option value >请选择场馆</option>
    				<?php foreach ($venue_list as $k => $v):?>
    				<option value="<?php echo $v['id']?>" <?php if($v['id'] == $info['venue_id']) echo 'selected';?>><?php echo $v['name']?></option>
    				<?php endforeach;?>
    				</select>
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-3 control-label">上传封面图</label>
    			<div class="col-sm-9">
    				<ul id="uploader_cover_img">
    				    <?php if(!empty($info['cover_img'])):?>
    				    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo get_img_url($info['cover_img'])?>" target="_blank"><img src="<?php echo get_img_url($info['cover_img'])?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="cover_img" value="<?php echo $info['cover_img'];?>"/>
                        </li>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
            <div class="form-group">
    			<label class="col-sm-3 control-label">上传logo</label>
    			<div class="col-sm-9">
    				<ul id="uploader_logo">
    				    <?php if(!empty($info['logo'])):?>
    				    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo get_img_url($info['logo'])?>" target="_blank"><img src="<?php echo get_img_url($info['logo'])?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="logo" value="<?php echo $info['logo'];?>"/>
                        </li>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_logo"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-3 control-label">上传背景音乐</label>
    			<div class="col-sm-9">
    				<ul id="uploader_bgmusic" data-type="music">
    				    <?php if(!empty($info['bgmusic'])):?>
    				    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <audio src="<?php echo get_img_url($info['bgmusic']);?>" style='width:100%;margin-top:128px;' controls="controls"/>
                            <input type="hidden" name="bgmusic" value="<?php echo $info['bgmusic'];?>"/>
                        </li>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_bgmusic"><span>+</span><br>添加照片</a>
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
                <label class="col-sm-3 control-label">场景地点</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="place" value="<?php echo $info['place']?>"/>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">位置坐标</label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" name="location" value="<?php echo $info['location'] ?>"/>
                  <p class="help-block">填写位置坐标，点击<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank">这里</a>手动拾取坐标</p>
              </div>
            </div>
    		<div class="form-group">
    		  <label class="col-sm-3 control-label">简介</label>
    		  <div class="col-sm-6">
    		      <textarea rows="3" class="form-control" name="introduce"><?php echo $info['introduce']?></textarea>
    		  </div>
    		</div>
    		<div class="form-group">
    		  <div class="col-sm-6 text-center">
    		      <button class="btn btn-primary" type="submit">保存</button>
    		  </div>
    		</div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
var id=<?php echo $info['id']?>;
var object = [
              {"obj":"#uploader_logo", "btn": "#btn_logo"},
              {"obj":"#uploader_cover_img", "btn": "#btn_cover_img"},
              {"obj":"#uploader_bgmusic", "btn": "#btn_bgmusic"}
              ];
var upload_domain = '<?php echo $domain['upload']['url']?>';
seajs.use(['<?php echo css_js_url('vtour.js', 'admin')?>', 'admin_uploader','jqueryswf','swfupload'], function(vtour, swfupload){
  swfupload.swfupload(object);
  vtour.ajax_scene(id);
  vtour.dragula();
});
</script>
</body>
</html>