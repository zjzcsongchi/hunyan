<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/album/index">客户列表</a></li>
    <li class="active"><a href="#">添加客户</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    
    <ul class="nav nav-tabs">
		<li class="active"><a href="#base" data-toggle="tab">商品基本信息</a></li>
		<li><a href="#video" data-toggle="tab">商品属性</a></li>
		<li><a href="#customer_case" data-toggle="tab">商品规格</a></li>
		<li><a href="#image" data-toggle="tab">相册</a></li>
	</ul>
	<br>   

        <form class="form-horizontal tab-content" >
        <input type="hidden" id="attr_class_id" data-id="<?php echo isset($data['attribute_type'][0]['id']) ? $data['attribute_type'][0]['id']:0?>">
        <div class="tab-pane active" id="base">
            <div class="form-group">
                <label class="col-sm-2 control-label">商品分类*</label>
                <div class="col-sm-4">
                    <select class="form-control" name="class_id" >
                        <?php foreach ($attribute_type as $k => $v):?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">商品名称(主标题)*</label>
                <div class="col-sm-4">
                    <input type="text" id="title" name="title" class="form-control"  valType="required" msg="名称不能为空" placeholder="请输入名称">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">子标题</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="sub_title" valType="required" msg="名称不能为空" placeholder="请输入名称">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">原价</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="original_price">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">现价</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="present_price">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">单位</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="unit">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">标签</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="flag" placeholder="请输入标签,多个标签用英文逗号隔开">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">生产许可证编号</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="allow_num" placeholder="请输入生产许可证编号">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">生产厂商</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="firm">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="sort" value="0">
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
                <label class="col-sm-2 control-label">详情内容</label>
                <div  class="col-sm-5">
                    <textarea id="wang_editor" style="height: 400px;" name="info"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">简介</label>
                <div class="col-sm-4">
                    <textarea rows="5" name="summary" class="form-control" placeholder="请输入简介"></textarea>
                </div>
            </div>
            
           <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label><input type="radio" name="is_del" value="0" checked>正常</label>
                        <label><input type="radio" name="is_del" value="1">删除</label>
                    </div>
                </div>
            </div>
            
             <div class="form-group">
                <label class="col-sm-2 control-label">上架状态</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label><input type="radio" name="is_show" value="0" checked>上架</label>
                        <label><input type="radio" name="is_show" value="1">下架</label>
                    </div>
                </div>
            </div>
            
             <div class="form-group">
                <label class="col-sm-2 control-label">是否推荐</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label><input type="radio" name="is_recommend" value="0">推荐</label>
                        <label><input type="radio" name="is_recommend" value="1" checked>不推荐</label>
                    </div>
                </div>
            </div>
            </div>
            
            
            <!--  特殊属性-->
            <div class="tab-pane" id="video">
            
            <div class="form-group dinner_marry">
                <label class="col-sm-2 control-label">属性名称</label>
                <div class="col-sm-2">
                    <input type="text"  name="attr_name[]" class="form-control" placeholder="属性名称"  valType="required" msg="名称不能为空">
                </div>
                
                <div class="col-sm-1">
                    <input type="text"  name="attr_value[]" class="form-control" placeholder="属性值"  valType="required" msg="值不能为空">
                </div>
                <div class="col-sm-1 text-center">
                <input  value="添 加" class="btn btn-danger" style="width:80px" id="load_attr">
                </div>
            </div>
            <div id="special_attr">
            
            </div>
            
            </div>
            
            <div class="tab-pane" id="customer_case">
                <div class="form-group dinner_marry" sort="0">
                    <label class="col-sm-2 control-label">规格型号</label>
                    <div class="col-sm-2">
                        <input type="text" id="version_name[]" name="version_name[]" class="form-control" placeholder="型号"  valType="required" msg="名称不能为空">
                    </div>
                    <div class="col-sm-1">
                        <input type="text" id="version_price[]" name="version_price[]" class="form-control" placeholder="价格"  valType="required" msg="名称不能为空">
                    </div>
                    
        			<div class="col-sm-4">
        				<ul id="uploader_version_image_0">
        	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
        	                    <a href="javascript:;" class="up-img"  id="btn_version_image_0"><span>+</span><br>添加照片</a>
        	                </li>
        	            </ul>
        			</div>
                    <div class="col-sm-1 text-center">
                        <input  value="添 加" class="btn btn-danger" style="width:80px" id="load_special">
                    </div>
                </div>
            </div>
            
            <div class="tab-pane" id="image">
                <div class="form-group">
    			<label class="col-sm-2 control-label">相册</label>
    			<div class="col-sm-10">
    				<ul id="uploaders_images">
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_images"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
    			</div>
		      </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <input type="submit" id="submit" value="保  存" class="btn btn-danger">
                </div>
            </div>
        </form>
</div>
<?php $this->load->view('common/footer')?>
<script type="text/javascript">

var object = [
             {"obj": "#uploader_cover_img", "btn": "#btn_cover_img"},
             {"obj": "#uploader_version_image_0", "btn": "#btn_version_image_0"},
             {"obj": "#uploaders_images", "btn": "#btn_images"}
           ];

seajs.use(['<?php echo css_js_url('album.js', 'admin')?>','admin_uploader','wangeditor_api','jqvalidate','bootstrap','jqueryswf','swfupload'], function(a,swfUploader,editor){
	a.version_del();
	a.special_del();
	a.select_class_id();
	a.load_attr();
	a.load_special();
	a.save();
	swfUploader.swfupload(object);
	editor.load();
})


</script>
</body>
</html>