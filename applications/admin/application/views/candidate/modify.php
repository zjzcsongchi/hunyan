<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/candidate/index">候选人列表</a></li>
    <li class="active"><a href="#">候选人审核</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>审核</h1></legend>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">活动名称</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php echo $activity['name']?>"  readonly>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">用户</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php echo $user['mobile_phone']?>"  readonly>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">标题</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="title" value="<?php echo $info['title']?>" >
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">描述</label>
                <div class="col-sm-4">
                    <textarea class="form-control" rows="4" placeholder="描述信息" name="desc"><?php echo $info['desc']?></textarea>
                </div>
            </div>
            
             <div class="form-group">
                <label class="col-sm-2 control-label">备注</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="remark" rows="4" placeholder="备注信息" ><?php echo $info['remark']?></textarea>
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
    			<label class="col-sm-2 control-label">相册</label>
    			<div class="col-sm-10">
    				<ul id="uploaders_images">
        				<?php if(isset($info['images']) && $info['images']):?>
        				<?php foreach ($info['images'] as $k=>$v):?>
                            <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                                <a class='close del-pic' href='javascript:;'></a>
                                <a href="<?php echo get_img_url($v)?>" target="_blank"><img src="<?php echo get_img_url($v)?>" style='width:100%;height:100%'/></a>
                                <input type="hidden" value="<?php echo $v?>" name="images[]">
                            </li>
                            <?php endforeach;?>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_images"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
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
                  {"obj": "#uploader_cover_img", "btn": "#btn_cover_img"},
                  {"obj": "#uploaders_images", "btn": "#btn_images"}
                  ];
    seajs.use(['admin_uploader','jqvalidate','jqueryswf','swfupload'], function(swfupload){
        swfupload.swfupload(object);
    })
</script>
    
<script type="text/javascript">
    seajs.use(['<?php echo css_js_url('candidate.js', 'admin')?>', 'jqvalidate'], function(a){
    	a.modify();
    })
</script>
</body>
</html>