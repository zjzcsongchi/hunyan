<?php $this->load->view('common/header2');?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/dinner/album?dinner_id=<?php if(isset($dinner_id)){echo $dinner_id;}else{echo $info['id'];}?>">宴会相册</a></li>
    <li class="active" >修改相册信息</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><button class="btn btn-primary" onclick="window.history.go(-1)"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返回</button> 修改相册信息</legend>
        <form class="form-horizontal" method="post">
            <input name="id" type="hidden" class="dfinput" value="<?php echo $info['id'];?>"/>
            <input name="dinner_id" type="hidden" class="dfinput" value="<?php echo $info['dinner_id'];?>"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">相册名称：</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php echo $info['name']?>" placeholder="请输入相册名称" valType="required" name="name" msg="名称不能为空">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">价格：</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php echo $info['price']?>" placeholder="请输入价格" valType="required" name="price" msg="名称不能为空">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">描述：</label>
                <div class="col-sm-4">
                    <textarea class="form-control" placeholder="请输入描述信息" name="desc" rows="3"><?php echo $info['desc']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">封面图：</label>
                <div class="col-sm-6">
                    <ul id="uploader_cover_img">
                        <?php if(isset($info['cover_img']) && !empty($info['cover_img'])):?>
                        <li id="SWFUpload_0_0" class="pic pro_gre" style="margin-right: 20px; clear: none">
                            <a class="close del-pic" href="javascript:;"></a>
                            <img src="<?php echo get_img_url($info['cover_img'])?>" style="width: 100%; height: 100%">
                            <input type="hidden" name="cover_img" value="<?php echo $info['cover_img']?>">
                        </li>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">关联资讯文章：</label>
                <div class="col-sm-4">
                    <input type="hidden" name="article_id" id="article_id" value="<?php echo $info['article_id']?>">
                    <input type="text" class="form-control" value="<?php echo $info['article_name']?>" id="search_name" placeholder="输入文章名称查找">
                    <div id="search_result" style="max-height:300px;overflow-y: scroll;overflow-x: hidden;border:1px solid #ccc; box-shadow: inset 0 1px 1px rgba(0,0,0,.075);">
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> 保 存</button>
                </div>
            </div>
        </form>
    </fieldset>
</div>

<?php $this->load->view('common/footer')?>
<script>
var object = [{"obj": "#uploader_cover_img", "btn": "#btn_cover_img"}];
seajs.use(['<?php echo css_js_url('dinner_album.js', 'admin')?>', 'admin_uploader','jqvalidate','jqueryswf','<?php echo css_js_url('jquery.swfupload.js', 'common');?>','swfupload'], function(a, swfupload){
	a.search_news();
	a.sure_select();
    swfupload.swfupload(object);
})
</script>
</body>
</html>