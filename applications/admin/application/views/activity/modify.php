<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/music/index">音乐列表</a></li>
    <li class="active"><a href="#">修改音乐</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>修改音乐</h1></legend>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">活动名称*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" value="<?php echo $info['name']?>" valType="required" msg="活动名称不能为空" placeholder="请输入活动名称">
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
                <label class="col-sm-2 control-label">活动描述</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="desc" rows="4" placeholder="描述信息"><?php echo $info['desc']?></textarea>
                </div>
            </div>
    		
    		 <div class="form-group">
                <label class="col-sm-2 control-label">备注</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="remark" rows="4" placeholder="备注信息"><?php echo $info['remark']?></textarea>
                </div>
            </div>
            
             <div class="form-group">
                <label class="col-sm-2 control-label">是否当期</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label><input type="radio" name="is_current" value="0" <?php if($info['is_current'] == 0):?> checked <?php endif;?>>否</label>
                        <label><input type="radio" name="is_current" value="1" <?php if($info['is_current'] == 1):?> checked <?php endif;?>>是</label>
                    </div>
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
                  {"obj": "#uploader_cover_img", "btn": "#btn_cover_img"}
                  ];
    seajs.use(['admin_uploader','jqvalidate','jqueryswf','swfupload'], function(swfupload){
        swfupload.swfupload(object);
    })
</script>
    
<script type="text/javascript">
    seajs.use(['<?php echo css_js_url('activity.js', 'admin')?>', 'jqvalidate'], function(a){
    	a.modify();
    })
</script>
</body>
</html>