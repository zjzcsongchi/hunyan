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
	    <!-- 基本信息 -->
        <div class="tab-pane active" id="base">
            <div class="form-group">
            <label class="col-sm-2 control-label">场馆类型 *</label>
            <div class="col-sm-4">
                <select class="form-control input-lg" valType="required" msg="请选择场馆类型" name="venue_class_id">
                <?php foreach ($venue_type as $k=>$v):?>
                <option value="<?php echo $k?>"><?php echo $v?></option>
                <?php endforeach;?>
                </select>
            </div>
            </div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">场馆名称 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="name" class=" form-control" valType="required" msg="请输入场馆名称" placeholder="请输入场馆名称">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">封面图</label>
    			<div class="col-sm-10">
    				<ul id="uploader_cover_img">
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">场馆介绍 *</label>
    			<div class="col-sm-5">
    				<textarea rows="3" name="introduce" class=" form-control" valType="required" msg="请输入场馆介绍" placeholder="请输入场馆介绍"></textarea>
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">楼层 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="floor" class=" form-control" valType="required" msg="请输入楼层" placeholder="请输入楼层">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">楼层高 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="height" class=" form-control" valType="required" msg="请输入楼层高" placeholder="请输入楼层高">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">适合宴会类型 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="fit_type" class="form-control" valType="required" msg="请输入适合宴会类型" placeholder="请输入适合宴会类型">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">最低消费 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="min_consume" class="form-control" valType="required" msg="请输入最低消费" placeholder="请输入最低消费">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">最高消费 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="max_consume" class="form-control" valType="required" msg="请输入最高消费" placeholder="请输入最高消费">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">占地面积 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="area_size" class="form-control" valType="required" msg="请输入占地面积" placeholder="请输入占地面积">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">容纳人数 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="container" class="form-control" valType="required" msg="请输入容纳人数" placeholder="请输入容纳人数">
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">最大桌数 *</label>
    			<div class="col-sm-4">
    				<input type="text" name="max_table" class="form-control" valType="required" msg="请输入最大桌数" placeholder="请输入最大桌数">
    			</div>
    		</div>
    		<div class="form-group">
    		  <label class="col-sm-2 control-label">场馆设备</label>
    		  <div class="col-sm-4">
    		      <textarea rows="3" class="form-control" name="device" placeholder="请输入场馆设备"></textarea>
    		  </div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-2 control-label">是否推荐到首页</label>
    			<div class="col-sm-1 radio">
    				<label><input type="radio" value="1" name="is_recommend" >是</label>
    			</div>
    			<div class="col-sm-1 radio">
    				<label><input type="radio" value="0" name="is_recommend" checked>否</label>
    			</div>
    		</div>
        </div>
        <!-- 相册 -->
        <div class="tab-pane" id="images">
            <div class="form-group">
                <label class="col-sm-2 control-label">场馆相册</label>
                <div class="col-sm-10">
                    <ul id="uploaders_venue_img">
                        <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                            <a href="javascript:;" class="up-img"  id="btn_venue_img"><span>+</span><br>添加照片</a>
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
                        <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                            <a href="javascript:;" class="up-img"  id="btn_video_cover_img"><span>+</span><br>添加照片</a>
                        </li>
                    </ul>
                </div>
            
    			<label class="col-sm-2 control-label">场馆视频:</label>
    			<div class="col-sm-10">
    				<ul id="uploader_venue_video">
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
                        <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                            <a href="javascript:;" class="up-img"  id="btn_case_cover_img"><span>+</span><br>添加照片</a>
                        </li>
                    </ul>
                </div>
                
                 <label class="col-sm-2 control-label">案例视频:</label>
                <div class="col-sm-10">
                    <ul id="uploaders_case_video" data-type="video">
                        <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
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
//绑定图片上传器
var object =[
  {"obj": "#uploader_video_cover_img", "btn": "#btn_video_cover_img"},
  {"obj": "#uploader_venue_video", "btn": "#btn_venue_video", "type":'video'},
  {"obj": "#uploader_cover_img", "btn": "#btn_cover_img"},
  {"obj": "#uploaders_venue_img", "btn": "#btn_venue_img"},
  {"obj": "#uploaders_case_cover_img", "btn": "#btn_case_cover_img"},
  {"obj": "#uploaders_case_video", "btn": "#btn_case_video", "type":'video'}
  
];

seajs.use(['<?php echo css_js_url('venue.js', 'admin')?>','admin_uploader','bootstrap','jqvalidate','jqueryswf','swfupload'], function(a, swfUploader){
    a.save();
    swfUploader.swfupload(object);
})
</script>
</body>
</html>