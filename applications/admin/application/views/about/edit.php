<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common/index">首页</a></li>
        <li><a href="#">系统管理</a></li>
        <li><a href="/about">关于我们</a></li>
        <li><a href="#">修改</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>编辑</span></div>
    <ul class="forminfo">
        <li>
            <label>视频标题</label>
            <input name="vedio_title" type="text" class="dfinput" value="<?php echo $info['vedio_title']?>" valType="required" msg="不能为空"/><i></i>
        </li>
        <li>
			<label class="col-sm-2 control-label">首页背景视频</label>
			<div class="col-sm-10">
				<ul id="uploader_index_vedio_url" data-type="video">
				    <?php if($info['index_vedio_url']):?>
				    <li id="SWFUpload_0_0" class="pic" style="margin-right: 20px; clear: none">
				    <a class="close del-pic" href="javascript:;" style="z-index:1;"></a>
				    <video src="<?php echo get_vedio_url($info['index_vedio_url'])?>" controls style="width:100%; height:100%;">首页背景视频</video>
				    <input type="hidden" name="index_vedio_url" value="<?php echo $info['index_vedio_url'];?>"></li>
	                <?php endif;?>
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_index_vedio_url"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
		</li>
        <li>
            <label class="col-sm-2 control-label">关于我们视频</label>
			<div class="col-sm-10">
				<ul id="uploader_vedio_url" data-type="video">
				    <?php if($info['vedio_url']):?>
				    <li id="SWFUpload_0_0" class="pic" style="margin-right: 20px; clear: none">
				    <a class="close del-pic" href="javascript:;" style="z-index:1;"></a>
				    <video src="<?php echo get_vedio_url($info['vedio_url'])?>" controls style="width:100%; height:100%;">首页背景视频</video>
				    <input type="hidden" name="vedio_url" value="<?php echo $info['vedio_url'];?>"></li>
	                <?php endif;?>
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_vedio_url"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
        </li>
        <li>
            <label>视频预览图<b>*</b></label>
            <ul id="uploader_vedio_img">
                <?php if($info['vedio_img']):?>
                <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                    <a class='close del-pic' href='javascript:;'></a>
                    <a href="<?php echo get_img_url($info['vedio_img']);?>" target="_blank"><img src="<?php echo get_img_url($info['vedio_img']);?>" style='width:100%;height:100%'/></a>
                    <input type="hidden" name="vedio_img" value="<?php echo $info['vedio_img'];?>"/>
                </li>
                <?php endif;?>
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="btn_vedio_img"><span>+</span><br>添加照片</a>
                </li>
            </ul>
        </li>
        
        <li>
            <label>宾客数量</label>
            <input name="guest_num" type="text" class="dfinput" value="<?php echo $info['guest_num']?>" required /><i></i>
        </li>
        <li>
            <label>婚礼数量</label>
            <input name="wedding_num" type="text" class="dfinput" value="<?php echo $info['wedding_num']?>" required /><i></i>
        </li>
        <li>
            <label>视频数量</label>
            <input name="vedio_num" type="text" class="dfinput" value="<?php echo $info['vedio_num']?>" required /><i></i>
        </li>
        
        <li>
            <label>客服电话</label>
            <input name="customer_service_tel" type="text" class="dfinput" value="<?php echo $info['customer_service_tel']?>" valType="required" msg="不能为空"/><i></i>
        </li>
        <li>
            <label>客服邮箱</label>
            <input name="customer_service_email" type="text" class="dfinput" value="<?php echo $info['customer_service_email']?>" valType="required" msg="不能为空"/><i></i>
        </li>
        <li>
            <label>微信公众号</label>
            <input name="wechat_public_number" type="text" class="dfinput" value="<?php echo $info['wechat_public_number']?>" valType="required" msg="不能为空"/><i></i>
        </li>
        <li>
            <label>工作时间</label>
            <input name="working_hours" type="text" class="dfinput" value="<?php echo $info['working_hours']?>" valType="required" msg="不能为空"/><i></i>
        </li>
        <li>
            <label>公司地址</label>
            <input id="address" name="address" type="text" class="dfinput" value="<?php echo $info['address']?>" valType="required" msg="不能为空"/><i></i>
        </li>
        <li>
            <label>公司地理坐标</label>
            <input id="coordinate" name="coordinate" type="text" class="dfinput" value="<?php echo $info['coordinate']?>" valType="required" msg="不能为空"/><i></i>
            <i>填写公司地址即可自动获取坐标，如果获取不到，请点击<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank"style="color:blue;">这里</a>手动拾取坐标</i>
        </li>
        <li>
            <label>简介</label>
            <textarea name="desc" class="textinput" maxlength="114"><?php if(isset($info['desc'])) echo $info['desc']?></textarea>
        </li>
        <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
</div>
<?php $this->load->view('common/footer') ?>
<script>
//绑定图片上传器
var object =[
    {"obj": "#uploader_index_vedio_url", "btn": "#btn_index_vedio_url", "type":'video'},
    {"obj": "#uploader_vedio_url", "btn": "#btn_vedio_url", "type":'video'},
    {"obj": "#uploader_vedio_img", "btn": "#btn_vedio_img"}
];

seajs.use(['admin_uploader','bootstrap','jqvalidate','jqueryswf','swfupload'], function(swfUploader){
    swfUploader.swfupload(object);
})
</script>
<script src="<?php echo css_js_url('jquery.min.js','common');?>"></script>
<script src="<?php echo css_js_url('common.js','admin');?>"></script>
<script type="text/javascript">
    $(function(){
        $("#address").blur(function(){
            var address = $("input[name='address']").val();
            if(address){
                $.post("/about/get_Map",{map:address}, function(data) {
                    if(data){
                       $("#coordinate").val(data.lng+','+data.lat);
                    }
                });
           }

        });
    });
    
    
</script>
</body>
</html>