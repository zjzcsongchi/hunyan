<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/template/index">模板列表</a></li>
    <li class="active"><a href="#">添加模板</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>添加模板</h1></legend>
        <form class="form-horizontal">
        <div class="form-group">
        <label class="control-label col-sm-2" >类型:</label>
            <div class=" col-sm-2">
                <select name="type_id" class="form-control delivery_type" valType="required" msg="类型不能为空">
                <option value="0" selected="selected">电子相册</option>
                <option value="1">微请帖</option>
                </select>
            </div>
        </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">模板名称*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" valType="required" msg="模板名称不能为空" placeholder="请输入模板名称">
                </div>
            </div>

            <div class="form-group">
    			<label class="col-sm-2 control-label">音乐:</label>
    			<div class="col-sm-4">
    			<input value="选择音乐" class="btn btn-danger select_music">
    			</div>
    		</div>
    		<div id="hiden_music_id">
    		
    		</div>
    		<div class="form-group">
                <label class="col-sm-2 control-label">音乐名称</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="music_name" readonly>
                </div>
            </div>
    		
            
            <div class="form-group">
    			<label class="col-sm-2 control-label">logo图片</label>
    			<div class="col-sm-4">
    				<ul id="uploader_logo">
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
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加图片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">备注</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="remark" rows="4" placeholder="备注信息"></textarea>
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
    	a.save();
    	a.select_music();
    	a.selectmusic();
    })
</script>
</body>
</html>