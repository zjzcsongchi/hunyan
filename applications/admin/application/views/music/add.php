<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/music/index">音乐列表</a></li>
    <li class="active"><a href="#">添加音乐</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>添加音乐</h1></legend>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">音乐名称*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" valType="required" msg="音乐名称不能为空" placeholder="请输入音乐名称">
                </div>
            </div>

            <div class="form-group">
    			<label class="col-sm-2 control-label">音乐</label>
    			<div class="col-sm-4">
    				<ul id="uploader_music" data-type="music">
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_music"><span>+</span><br>添加音乐</a>
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
                  {"obj": "#uploader_cover_img", "btn": "#btn_cover_img"}
                  ];
    seajs.use(['admin_uploader','jqvalidate','jqueryswf','swfupload'], function(swfupload){
        swfupload.swfupload(object);
    })
</script>
    
<script type="text/javascript">
    seajs.use(['<?php echo css_js_url('music.js', 'admin')?>', 'jqvalidate'], function(a){
    	a.save();
    })
</script>
</body>
</html>