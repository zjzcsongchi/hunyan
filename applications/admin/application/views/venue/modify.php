<?php $this->load->view('common/header2') ?>
<ol class="breadcrumb">
	<li><a href="/common">首页</a></li>
	<li class="active"><a href="#">添加场馆</a></li>
</ol>
<div class="container-fluid">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#base" data-toggle="tab">基本信息</a></li>
		<li><a href="#video" data-toggle="tab">场馆视频</a></li>
		<li><a href="#customer_case" data-toggle="tab">客户案例</a></li>
	</ul>
	<br>
	<form class="form-horizontal tab-content">
	       <input type="hidden" name="id" value="<?php echo $info['id']?>"/>
	    <!-- 基本信息 -->
        <div class="tab-pane active" id="base">
        
            <div class="form-group">
            <label class="col-sm-2 control-label">场馆类型 *</label>
            <div class="col-sm-4">
                <select class="form-control input-lg" valType="required" msg="请选择场馆类型" name="venue_class_id">
                <?php foreach ($venue_type as $k=>$v):?>
                <option value="<?php echo $k?>" <?php if($k == $info['venue_class_id']):?>selected<?php endif;?>><?php echo $v?></option>
                <?php endforeach;?>
                </select>
            </div>
            </div>
        
    		<div class="form-group">
    			<label class="col-sm-2 control-label">场馆名称 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="name" class=" form-control" value="<?php echo $info['name']?>" valType="required" msg="请输入场馆名称" placeholder="请输入场馆名称">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">封面图</label>
    			<div class="col-sm-10">
    				<ul id="uploader_cover_img">
    				    <?php if($info['cover_img']):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo $info['cover_img_url'];?>" target="_blank"><img src="<?php echo $info['cover_img_url'];?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="cover_img" value="<?php echo $info['cover_img'];?>"/>
                        </li>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="file_cover_img"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">场馆介绍 *</label>
    			<div class="col-sm-5">
    				<textarea rows="3" name="introduce" class=" form-control" valType="required" msg="请输入场馆介绍" placeholder="请输入场馆介绍"><?php echo $info['introduce']?></textarea>
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">楼层 *</label>
    			<div class="col-sm-4">
    				<input type="text" value="<?php echo $info['floor']?>" name="floor" class=" form-control" valType="required" msg="请输入楼层" placeholder="请输入楼层">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">楼层高 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="height" value="<?php echo $info['height']?>" class=" form-control" valType="required" msg="请输入楼层高" placeholder="请输入楼层高">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">适合宴会类型 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="fit_type" value="<?php echo $info['fit_type']?>" class="form-control" valType="required" msg="请输入适合宴会类型" placeholder="请输入适合宴会类型">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">最低消费 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="min_consume" value="<?php echo $info['min_consume']?>" class="form-control" valType="required" msg="请输入最低消费" placeholder="请输入最低消费">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">最高消费 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="max_consume" value="<?php echo $info['max_consume']?>" class="form-control" valType="required" msg="请输入最高消费" placeholder="请输入最高消费">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">占地面积 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="area_size" value="<?php echo $info['area_size']?>" class="form-control" valType="required" msg="请输入占地面积" placeholder="请输入占地面积">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">容纳人数 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="container" value="<?php echo $info['container']?>" class="form-control" valType="required" msg="请输入容纳人数" placeholder="请输入容纳人数">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">最大桌数 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="max_table" value="<?php echo $info['max_table']?>" class="form-control" valType="required" msg="请输入最大桌数" placeholder="请输入最大桌数">
    			</div>
    		</div>
    		<div class="form-group">
    		  <label class="col-sm-2 control-label">场馆设备</label>
    		  <div class="col-sm-4">
    		      <textarea rows="3" class="form-control" name="device" placeholder="请输入场馆设备"><?php echo $info['device']?></textarea>
    		  </div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">是否推荐到首页:</label>
    			<div class="col-sm-1 radio">
    				<label><input type="radio" value="1" <?php echo $info['is_recommend'] == 1 ? 'checked' : ''?> name="is_recommend" >是</label>
    			</div>
    			<div class="col-sm-1 radio">
    				<label><input type="radio" value="0" <?php echo $info['is_recommend'] == 0 ? 'checked' : ''?> name="is_recommend" >否</label>
    			</div>
    		</div>
        </div>
        <!-- 相册 -->
        <div class="tab-pane" id="images">
            <div class="form-group">
    			<label class="col-sm-2 control-label">场馆相册:</label>
    			<div class="col-sm-10">
    				<ul id="uploader_venue_img">
    				    <?php if($info['images_url']):?>
    				    <?php foreach ($info['images_url'] as $v):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo $v['img_url'];?>" target="_blank"><img src="<?php echo $v['img_url'];?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="images[]" value="<?php echo $v['img'];?>"/>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="file_venue_img"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
    		
        </div>
        <!-- 视频 -->
        <div class="tab-pane" id="video">
            <div class="form-group">
                <label class="col-sm-2 control-label">场馆封面:</label>
                <div class="col-sm-10">
                    <ul id="uploader_video_cover_img">
                	    <?php if($info['video_cover_img']):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo get_img_url($info['video_cover_img']);?>" target="_blank"><img src="<?php echo get_img_url($info['video_cover_img']);?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="video_cover_img" value="<?php echo $info['video_cover_img'];?>"/>
                        </li>
                        <?php endif;?>
                        <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                            <a href="javascript:;" class="up-img"  id="btn_video_cover_img"><span>+</span><br>添加照片</a>
                        </li>
                    </ul>
                </div>
            
            
            
    			<label class="col-sm-2 control-label">场馆视频:</label>
    			<div class="col-sm-10">
    				<ul id="uploader_venue_video" data-type="video">
    				 <?php if($info['venue_video']):?>
    				    <li id="SWFUpload_0_0" class="pic" style="margin-right: 20px; clear: none">
    				    <a class="close del-pic" href="javascript:;" style="z-index:1;"></a>
    				    <video src="<?php echo get_vedio_url($info['venue_video'])?>" controls style="width:100%; height:100%;">首页背景视频</video>
    				    <input type="hidden" name="venue_video" value="<?php echo $info['venue_video'];?>"></li>
    	                <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_venue_video"><span>+</span><br>添加照片</a>
    	                </li>
    				
    	            </ul>
    			</div>
    		</div>
        </div>
        <!-- 客户案例 -->
        <div class="tab-pane" id="customer_case">
            <div class="form-group">
                <label class="col-sm-2 control-label">案例封面:</label>
                <div class="col-sm-10">
                    <ul id="uploaders_case_cover_img">
                	    <?php if($info['customer_case']):?>
                	    <?php foreach ($info['customer_case'] as $v):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo get_img_url($v['case_cover_img']);?>" target="_blank"><img src="<?php echo get_img_url($v['case_cover_img']);?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="case_cover_img[]" value="<?php echo $v['case_cover_img'];?>"/>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                        <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                            <a href="javascript:;" class="up-img"  id="btn_case_cover_img"><span>+</span><br>添加照片</a>
                        </li>
                    </ul>
                </div>
                
                 <label class="col-sm-2 control-label">案例视频:</label>
                <div class="col-sm-10">
                    <ul id="uploaders_case_video" data-type="video">
                	    <?php if($info['customer_case']):?>
                	    <?php foreach ($info['customer_case'] as $v):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class="close del-pic" href="javascript:;" style="z-index:1;"></a>
                            <video src="<?php echo get_vedio_url($v['case_video'])?>" controls style="width:100%; height:100%;">案例视频</video>
                            <input type="hidden" name="case_video[]" value="<?php echo $v['case_video'];?>"/>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                        <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;" >
                            <a href="javascript:;" class="up-img"  id="btn_case_video"><span>+</span><br>添加视频</a>
                        </li>
                    </ul>
                </div>
        		</div>
        </div>

        <!-- save -->
        <div class="form-group">
            <div class="col-sm-6 text-center">
                <input type="submit" value="保 存" class="btn btn-danger">
            </div>
        </div>
        <br>
        <br>
        <br>
	</form>
</div>
<?php $this->load->view('common/footer') ?>
<script>
    var object =[
		{"obj": "#uploader_video_cover_img", "btn": "#btn_video_cover_img"},
        {"obj": "#uploader_venue_video", "btn": "#btn_venue_video", "type":'video'},
        {"obj": "#uploader_venue_img", "btn": "#file_venue_img"},
        {"obj": "#uploader_cover_img", "btn": "#file_cover_img"},
        {"obj": "#uploaders_case_cover_img", "btn": "#btn_case_cover_img"},
        {"obj": "#uploaders_case_video", "btn": "#btn_case_video", "type":'video'}
    ];
    
    seajs.use(['<?php echo css_js_url('venue.js', 'admin')?>','admin_uploader','bootstrap','jqvalidate','jqueryswf','swfupload'], function(a,swfUploader){
        a.edit();
        swfUploader.swfupload(object);
    })
</script>
</body>
</html>