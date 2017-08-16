<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/album/index">列表</a></li>
    <li class="active"><a href="#">修改</a></li>
</ol>

<div class="container-fluid" style="margin:10px">

    <ul class="nav nav-tabs">
		<li class="active"><a href="#base" data-toggle="tab">商品基本信息</a></li>
		<li><a href="#video" data-toggle="tab">商品属性</a></li>
		<li><a href="#customer_case" data-toggle="tab">商品规格</a></li>
		<li><a href="#image" data-toggle="tab">相册</a></li>
	</ul>
	<br>   
        <form class="form-horizontal tab-content">  
        <input type="hidden" id="products_id" data-id="<?php echo $info['id']?>">
        <div class="tab-pane active" id="base">
            <div class="form-group">
                <label class="col-sm-2 control-label">商品分类*</label>
                <div class="col-sm-4">
                    <select class="form-control" name="class_id" >
                        <?php foreach ($attribute_type as $k => $v):?>
                        <option value="<?php echo $v['id']?>" <?php if($info['class_id'] == $v['id']):?>selected<?php endif;?>><?php echo $v['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
        
            <div class="form-group">
                <label class="col-sm-2 control-label">商品名称(主标题)*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="title" valType="required" msg="名称不能为空" placeholder="请输入名称" value="<?php echo isset($info['title']) && $info['title'] ?$info['title']:''?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">子标题</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="sub_title" valType="required" msg="名称不能为空" placeholder="请输入名称" value="<?php echo isset($info['sub_title']) && $info['sub_title']?$info['sub_title']:'' ?>">
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label">原价</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="original_price" value="<?php echo isset($info['original_price']) && $info['original_price'] ?$info['original_price'] :''?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">现价</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="present_price" value="<?php echo isset($info['present_price']) && $info['present_price'] ?$info['present_price']:''?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">单位</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="unit" value="<?php echo isset($info['unit']) && $info['unit']?$info['unit']:''?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">标签</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="flag" value="<?php echo isset($info['flag']) && $info['flag'] ?$info['flag']:''?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">生产许可证编号</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="allow_num" placeholder="请输入生产许可证编号" value="<?php echo isset($info['allow_num']) && $info['allow_num'] ?$info['allow_num']:''?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">生产厂商</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="firm" value="<?php echo isset($info['firm']) && $info['firm']?$info['firm']:''?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="sort"  value="<?php echo isset($info['sort']) && $info['sort']?$info['sort']:'0'?>">
                </div>
            </div>
            
            
            <div class="form-group">
    			<label class="col-sm-2 control-label">封面图</label>
    			<div class="col-sm-10">
    				<ul id="uploader_cover_img">
        				<?php if($info['cover_img']):?>
                            <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                                <a class='close del-pic' href='javascript:;'></a>
                                <a href="<?php echo get_img_url($info['cover_img'])?>" target="_blank"><img src="<?php echo get_img_url($info['cover_img'])?>" style='width:100%;height:100%'/></a>
                            </li>
                        <?php endif;?>
                        <input type="hidden" value="<?php echo $info['cover_img']?>" name="cover_img">
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
    			</div>
	        </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">详情内容</label>
                <div  class="col-sm-5">
                    <textarea id="wang_editor" style="height: 400px;" name="info"><?php echo isset($info['info']) && $info['info'] ?$info['info'] :''?></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">简介</label>
                <div class="col-sm-4">
                    <textarea rows="5" name="summary" class="form-control" placeholder="请输入简介"><?php echo isset($info['summary']) && $info['summary']?$info['summary']:''?></textarea>
                </div>
            </div>
            
           <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label><input type="radio" name="is_del" value="0" <?php if($info['is_del'] == 0):?>checked<?php endif;?>>正常</label>
                        <label><input type="radio" name="is_del" value="1" <?php if($info['is_del'] == 1):?>checked<?php endif;?>>删除</label>
                    </div>
                </div>
            </div>
        
            <div class="form-group">
                <label class="col-sm-2 control-label">上架状态</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label><input type="radio" name="is_show" value="0" <?php if($info['is_show'] == 0):?>checked<?php endif;?>>上架</label>
                        <label><input type="radio" name="is_show" value="1" <?php if($info['is_show'] == 1):?>checked<?php endif;?>>下架</label>
                    </div>
                </div>
            </div>
            
             <div class="form-group">
                <label class="col-sm-2 control-label">是否推荐</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label><input type="radio" name="is_recommend" value="0" <?php if($info['is_recommend'] == 0):?>checked<?php endif;?>>推荐</label>
                        <label><input type="radio" name="is_recommend" value="1" <?php if($info['is_recommend'] == 1):?>checked<?php endif;?>>不推荐</label>
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
            <?php if(isset($attr_lists) && $attr_lists):?>
            <?php foreach ($attr_lists as $k=>$v):?>
                <div class="form-group dinner_marry">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-2">
                        <input type="text"  name="attr_name[]" class="form-control" placeholder="型号"  valType="required" msg="名称不能为空" value="<?php echo $v['attribute']?>">
                    </div>
                    <div class="col-sm-1">
                        <input type="text"  name="attr_value[]" class="form-control" placeholder="价格"  valType="required" msg="名称不能为空" value="<?php echo $v['value']?>">
                    </div>
                    <div class="col-sm-1 text-center">
                    <input  value="删 除" class="btn btn-danger version_del" style="width:80px" >
                    </div>
                </div>
            <?php endforeach;?>
            <?php endif;?>
            </div>
            <!--  规格   -->
            <div class="tab-pane" id="customer_case">
            
                <?php if(isset($specifications_lists) && $specifications_lists):?>
                <?php foreach ($specifications_lists as $k=>$v):?>
                <div class="form-group dinner_marry" sort="<?php echo $k?>">
                        <label class="col-sm-2 control-label"><?php if($k == 0):?>规格型号<?php endif;?></label>
                        <div class="col-sm-2">
                            <input type="text" id="version_name[]" name="version_name[]" class="form-control" placeholder="型号"  valType="required" msg="名称不能为空" value="<?php echo $v['version_name']?>">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" id="version_price[]" name="version_price[]" class="form-control" placeholder="价格"  valType="required" msg="名称不能为空" value="<?php echo $v['version_price']?>">
                        </div>
                        
                        <div class="col-sm-4">
                			<ul id="uploader_version_image_<?php echo $k?>">
                				<?php if($v['version_image']):?>
                                    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                                        <a class='close del-pic' href='javascript:;'></a>
                                        <a href="<?php echo get_img_url($v['version_image'])?>" target="_blank"><img src="<?php echo get_img_url($v['version_image'])?>" style='width:100%;height:100%'/></a>
                                    </li>
                                <?php endif;?>
                                <input type="hidden" value="<?php echo $v['version_image']?>" name="version_image_<?php echo $k?>">
                                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                                    <a href="javascript:;" class="up-img"  id="btn_version_image_<?php echo $k?>"><span>+</span><br>添加照片</a>
                                </li>
                            </ul>
                		</div>
                        
                        <div class="col-sm-1 text-center">
                        <?php if($k == 0):?>
                        <input  value="添 加" class="btn btn-danger" style="width:80px" id="load_special">
                        <?php else:?>
                        <input  value="删 除" class="btn btn-danger special_del" style="width:80px">
                        <?php endif;?>
                        </div>
                    </div>
                <?php endforeach;?>
                <?php else:?>
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
                <?php endif;?>
            </div>
            
            <div class="tab-pane" id="image">
                  <div class="form-group">
    			<label class="col-sm-2 control-label">相册</label>
    			<div class="col-sm-10">
    				<ul id="uploaders_images">
        				<?php if(isset($info['images_list']) && $info['images_list']):?>
        				<?php foreach ($info['images_list'] as $k=>$v):?>
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
            </div>
            
            <input type="hidden" name="id" value="<?php echo $info['id']?>">
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <input type="submit" id="submit" value="保  存" class="btn btn-danger">
                </div>
            </div>
        </form>
</div>
<?php $this->load->view('common/footer')?>
<script type="text/javascript">

var object =[
             {"obj": "#uploader_cover_img", "btn": "#btn_cover_img"},
             {"obj": "#uploaders_images", "btn": "#btn_images"}
           ];
var object2 = [];
for(var i=0;i<100;i++){
	object2[i] = {"obj": "#uploader_version_image_"+i, "btn": "#btn_version_image_"+i}
}

var tab = "<?php echo $tab?>";
seajs.use(['<?php echo css_js_url('album.js', 'admin')?>','admin_uploader','wangeditor_api','bootstrap','jqvalidate','jqueryswf','swfupload'], function(a,swfUploader,editor){
	a.tab();
	a.special_del();
	a.version_del();
	a.load_attr();
	a.load_special();
	a.modify();
	swfUploader.swfupload(object);
	swfUploader.swfupload(object2);
	editor.load();
})


</script>
</body>
</html>