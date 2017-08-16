<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/template/index">模板列表</a></li>
    <li class="active"><a href="#">修改模板</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>修改模板</h1></legend>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-2" >类型:</label>
                <div class=" col-sm-2">
                    <select name="type_id" class="form-control delivery_type" valType="required" msg="类型不能为空">
                    <option value="0" <?php if($info['type_id'] == 0):?>selected="selected"<?php endif;?>>电子相册</option>
                    <option value="1" <?php if($info['type_id'] == 1):?>selected="selected"<?php endif;?>>微请帖</option>
                    </select>
                </div>
            </div>
        
            <div class="form-group">
                <label class="col-sm-2 control-label">模板名称*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" value="<?php echo $info['name']?>" valType="required" msg="模板名称不能为空" placeholder="请输入模板名称">
                </div>
            </div>

            
            <div class="form-group">
    			<label class="col-sm-2 control-label">音乐:</label>
    			<div class="col-sm-4">
    			<input value="选择音乐" class="btn btn-danger select_music">
    			</div>
    		</div>
    		<div id="hiden_music_id">
    		  <input type="hidden" value="<?php echo $info['music_id']?>" name="music_id">
    		</div>
    		<div class="form-group">
                <label class="col-sm-2 control-label">音乐名称</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php echo $music[$info['music_id']]?>" id="music_name" readonly>
                </div>
            </div>
            
    		<div class="form-group">
    			<label class="col-sm-2 control-label">logo图片</label>
    			<div class="col-sm-4">
    				<ul id="uploader_logo">
    				<?php if($info['logo']):?>
    				
    				    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <img src="<?php echo get_img_url($info['logo']);?>" style='width:100%;height:100%' controls="controls"/>
                            <input type="hidden" name="logo" value="<?php echo $info['logo'];?>"/>
                        </li>
	                <?php endif;?>
    				
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_logo"><span>+</span><br>添加图片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
    		
    		<div class="form-group">
    			<label class="col-sm-2 control-label">封面图</label>
    			<div class="col-sm-4">
    				<ul id="uploader_cover_img">
    				<?php if($info['cover_img']):?>
    				
    				    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <img src="<?php echo get_img_url($info['cover_img']);?>" style='width:100%;height:100%' controls="controls"/>
                            <input type="hidden" name="cover_img" value="<?php echo $info['cover_img'];?>"/>
                        </li>
	                <?php endif;?>
	                
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加图片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">备注</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="remark" rows="4" placeholder="备注信息"><?php echo $info['remark']?></textarea>
                </div>
            </div>
            
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
	var id = "<?php echo $info['id']?>";
    var object = [
                  {"obj": "#uploader_music", "btn": "#btn_music"},
                  {"obj": "#uploader_logo", "btn": "#btn_logo"},
                  {"obj": "#uploader_cover_img", "btn": "#btn_cover_img"}
                  ];
    seajs.use(['admin_uploader','jqvalidate','jqueryswf','swfupload'], function(swfupload){
        swfupload.swfupload(object);
    })
</script>
    
<script type="text/javascript">
    seajs.use(['<?php echo css_js_url('template.js', 'admin')?>', 'jqvalidate'], function(a){
    	a.modify();
    	a.select_music();
    	a.selectmusic();
    })
</script>
</body>
</html>