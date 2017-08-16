<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/">酒水管理</a></li>
        <li><a href="/drink/add">添加</a></li>
    </ul>
</div>  

<div class="formbody">
    <div class="formtitle"><span>添加</span></div>
    <form action="" method="post">
        <ul class="forminfo">
             <li>
                <label>分类</label>
                <select class="dfinput selects" name="class_id" valType="required" msg="分类不能为空">
                    <option value="">---请选择酒水分类---</option>
                    <?php foreach ($type as $k => $v): ?>
                    <option value="<?php echo $k;?>"><?php echo $v?></option>
                    <?php endforeach;?>
                </select>
                <b>*</b>
            </li>
            <li>
                <label>酒水香型</label>
                <select class="dfinput selects" name="scent_id" valType="required" msg="香型不能为空">
                    <option value="">---请选择酒水香型---</option>
                    <?php foreach (C('scent') as $k => $v): ?>
                    <option value="<?php echo $v['id'];?>"><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
                <b>*</b>
            </li>
            <li><label>中文标题</label><input type="text" name="cn_name" class="dfinput" valType="required" msg="标题不能为空"  /><b>*</b></li>
            <li><label>子标题</label><input type="text" name="sub_cn_name" class="dfinput"  /></li>
            <li><label>英文标题</label><input type="text" name="en_name" class="dfinput"  /></li>
            <li><label>所属公司厂商</label><input type="text" name="firm" class="dfinput"/></li>
            <li><label>品牌<b></b></label><input type="text" name="band" class="dfinput" /></li>
            <li><label>原价<b></b></label><input type="text" name="original_price" class="dfinput"/></li>
            <li><label>现价<b></b></label><input type="text" name="price" class="dfinput" valType="required" msg="价格不能为空"/><b>*</b></li>
            <li><label>毫升<b></b></label><input type="text" name="ml" class="dfinput" /></li>
            <li><label>单位<b></b></label><input type="text" name="unit" class="dfinput" /></li>
            <li><label>酒精度<b></b></label><input type="text" name="alcohol" class="dfinput" /></li>
            <li><label>原料<b></b></label><input type="text" name="material" class="dfinput" /></li>
            <li><label>产地<b></b></label><input type="text" name="make_place" class="dfinput" /></li>
            <li><label>保质期（月）<b></b></label><input type="text" name="life_time" class="dfinput" /></li>
            <li><label>储藏方式<b></b></label><input type="text" name="save_method" class="dfinput" /></li>
            <li><label>生产许可证<b></b></label><input type="text" name="allow_num" class="dfinput" /></li>
            <li>
                <label>封面图</label>
                <ul id="uploader_cover_img">
                    <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                        <a href="javascript:;" class="up-img"  id="file_cover_img"><span>+</span><br>添加照片</a>
                    </li>
                </ul>
                
            </li>
            
            <li>
                <label>相册</label>
                <ul id="uploader_venue_img">
                    <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                        <a href="javascript:;" class="up-img"  id="file_venue_img"><span>+</span><br>添加照片</a>
                    </li>
                </ul>
                
            </li>
            
            <li>
                <label>简介</label>
                <script id="editor" type="text/plain" style="float:left;width: 620px;" name="summary"></script>
                <div class="edit-img">
                    <ul id="uploader_rich_text_img" >
                    </ul>
                    <div class="pic pic-add add-pic" >
                        <a href="javascript:;" class="up-img"  id="file_rich_text_img" style="background: #238ccd;border: solid 1px #238ccd;width:225px;height:40px;border-radius:5px;">添加照片</a>
                    </div>
                </div>
            </li>
            
            
            <li><label>排序</label><input type="text" name="sort" class="dfinput" required  value="0"/><b>*</b></li>
            <li>
                <label>显示</label>
                <input type="radio" name="is_show" checked value="1">上架
                <input type="radio" name="is_show" value="0">下架
            </li>
            <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="保 存"/></li>
        </ul>
    </form>
</div>

<script type="text/javascript" src="<?php echo css_js_url('jquery.min.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('datepicker/WdatePicker.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('jquery.swfupload.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('swfupload.js', 'admin')?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('admin_upload.js', 'admin');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('common.js', 'admin');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('jq.validate.js', 'admin');?>"></script>

<script type="text/javascript" charset="utf-8" src="<?php echo $domain['admin']['url'];?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $domain['admin']['url'];?>/ueditor/ueditor.all.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $domain['admin']['url'];?>/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
	var ue = UE.getEditor('editor');
	$(function(){
        $(".Wdate").focus(function(){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})
        });
    });
	 selectbox('.selects');
</script>
 
</body>
</html>