<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/">酒水管理</a></li>
        <li><a href="/drink/edit">修改</a></li>
    </ul>
</div>  

<div class="formbody">
    <div class="formtitle"><span>添加</span></div>
    <form action="" method="post">
        <ul class="forminfo">
             <li>
                <label>分类</label>
                <select class="dfinput selects" name="class_id" required>
                    <option value="">---请选择酒水分类---</option>
                    <?php foreach ($type as $k => $v): ?>
                    <option value="<?php echo $k;?>" <?php if($k == $info['class_id']):?>selected<?php endif;?>><?php echo $v?></option>
                    <?php endforeach;?>
                </select>
                <b>*</b>
            </li>
            <li>
                <label>酒水香型</label>
                <select class="dfinput selects" name="scent_id" required>
                    <option value="">---请选择酒水香型---</option>
                    <?php foreach (C('scent') as $k => $v): ?>
                    <option value="<?php echo $v['id'];?>"<?php if($info['scent_id'] == $v['id']){echo 'selected';}?>><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
                <b>*</b>
            </li>
            <li><label>中文标题</label><input type="text" name="cn_name" class="dfinput" required value="<?php echo $info['cn_name']?>"/><b>*</b></li>
            <li><label>子标题</label><input type="text" name="sub_cn_name" class="dfinput" value="<?php echo $info['sub_cn_name']?>"/></li>
            <li><label>英文标题</label><input type="text" name="en_name" class="dfinput"  value="<?php echo $info['en_name']?>"/></li>
            <li><label>所属公司厂商<b></b></label><input type="text" name="firm" class="dfinput" value="<?php echo $info['firm']?>"/></li>
            <li><label>品牌<b></b></label><input type="text" name="band" class="dfinput" value="<?php echo $info['band']?>" /></li>
            <li><label>原价</label><input type="text" name="original_price" class="dfinput" value="<?php echo $info['original_price']?>"/></li>
            <li><label>现价</label><input type="text" name="price" class="dfinput" required value="<?php echo $info['price']?>"/><b>*</b></li>
            <li><label>毫升<b></b></label><input type="text" name="ml" class="dfinput" value="<?php echo $info['ml']?>" /></li>
            <li><label>单位</label><input type="text" name="unit" class="dfinput" value="<?php echo $info['unit']?>"/></li>
            <li><label>酒精度<b></b></label><input type="text" name="alcohol" value="<?php echo $info['alcohol']?>" class="dfinput" /></li>
            <li><label>原料<b></b></label><input type="text" name="material" value="<?php echo $info['material']?>" class="dfinput" /></li>
            <li><label>产地<b></b></label><input type="text" name="make_place" value="<?php echo $info['make_place']?>"  class="dfinput" /></li>
            <li><label>保质期（月）<b></b></label><input type="text" name="life_time" value="<?php echo $info['life_time']?>" class="dfinput" /></li>
            <li><label>储藏方式<b></b></label><input type="text" name="save_method" value="<?php echo $info['save_method']?>" class="dfinput" /></li>
            <li><label>生产许可证<b></b></label><input type="text" name="allow_num" value="<?php echo $info['allow_num']?>" class="dfinput" /></li>
            <li>
                <label>封面图</label>
                <ul id="uploader_cover_img">
                    <?php if($info['cover_img']):?>
                    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                        <a class='close del-pic' href='javascript:;'></a>
                        <a href="<?php echo get_img_url($info['cover_img']);?>" target="_blank"><img src="<?php echo get_img_url($info['cover_img']);?>" style='width:100%;height:100%'/></a>
                        <input type="hidden" name="cover_img" value="<?php echo $info['cover_img'];?>"/>
                    </li>
                    <?php endif;?>
                    <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                        <a href="javascript:;" class="up-img"  id="file_cover_img"><span>+</span><br>添加照片</a>
                    </li>
                </ul>
            </li>
            <li>
                <label>相册</label>
                <ul id="uploader_venue_img">
                    <?php if(isset($info['images'])):?>
                    <?php foreach($info['images'] as $k => $v):?>
                    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                        <a class='close del-pic' href='javascript:;'></a>
                        <a href="<?php echo get_img_url($v);?>" target="_blank"><img src="<?php echo get_img_url($v);?>" style='width:100%;height:100%'/></a>
                        <input type="hidden" name="images[]" value="<?php echo $v;?>"/>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                    <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                        <a href="javascript:;" class="up-img"  id="file_venue_img"><span>+</span><br>添加照片</a>
                    </li>
                </ul>
            </li>
            <li>
                <label>简介</label>
                <script id="editor" type="text/plain" style="float:left;width: 620px;" name="summary"><?php echo $info['summary'];?></script>
                <div class="edit-img">
                    <ul id="uploader_rich_text_img" >
                    </ul>
                    <div class="pic pic-add add-pic" >
                        <a href="javascript:;" class="up-img"  id="file_rich_text_img" style="background: #238ccd;border: solid 1px #238ccd;width:225px;height:40px;border-radius:5px;">添加照片</a>
                    </div>
                </div>
            </li>
            <li><label>排序</label><input type="text" name="sort" class="dfinput" value="<?php echo $info['sort']?>" msg="不能为空"/></li>
            <li>
                <label>状态</label>
                <input type="radio" name="is_show" <?php if($info['is_show'] == 1):?> checked <?php endif;?> value="1">上架
                <input type="radio" name="is_show" <?php if($info['is_show'] == 0):?> checked <?php endif;?> value="0">下架
            </li>
            <input type="hidden" name="id" value="<?php echo $info['id']?>">
            <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="保 存"/></li>
        </ul>
    </form>
</div>

<script type="text/javascript" src="<?php echo css_js_url('jquery.min.js', 'common');?>"></script>
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
</script>
 
</body>
</html>