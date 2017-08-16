<?php $this->load->view("common/header");?>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="/common/index">首页</a></li>
		<li><a href="/adminspurview"><?php echo $title[0];?></a></li>
		<li><a href=""><?php echo $title[1];?></a></li>
	</ul>
	<span style="float: right; margin-top: 10px;"> <a href="/adminpurview"
		class="add-btn">列表</a>
	</span>
</div>

<div class="formbody">
	<div class="formtitle">
		<span><?php echo $title[1];?></span>
	</div>
	<ul class="forminfo">
		<li><label>上级分类<b>*</b></label> 
            <select id='parent_id' class="dfinput selects" name="parent_id">
            	<option value="0">顶级权限</option>
                {if $parent_purviews}
                <?php if($parent_purviews){?>
                    <?php foreach($parent_purviews as $id=>$v){?>
                        <option value="<?php echo $v['id']?>"
            		<?php if($v['id'] == $parent_id){?> selected="true" <?php }?>>
                                   <?php echo  str_repeat("——",$v['level']).$v['name'];?>
                        </option>
                            <?php } ?>
                <?php }?>
            </select>
        </li>
		<li><label>权限代码</label><input type="text" id="url" name="url" class="dfinput" /><i><b>*</b></i></li>
		<li><label>权限名称</label><input type="text" id="name" name="name" class="dfinput" /><i><b>*</b></i></li>
		<li><label>排序</label><input type="text" id="sort" name="sort" value="0" class="dfinput" /><i><b>*</b></i></li>
		<li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确定" /></li>
	</ul>
</div>
<script src="<?php echo css_js_url('jquery.min.js','common');?>"></script>
<script src="<?php echo css_js_url('dialog.js','common');?>"></script>
<script type="text/javascript">
    $(function(){
    	$('.btn').click(function(){
			var parent_id = $('#parent_id').val();
			var url = $('#url').val();
			var name = $('#name').val();
			var sort = $('#sort').val();		
    		if(url==''){
        		error('权限代码不能为空！');
        	}else if(name == ''){
        		error('权限名称不能为空！');
            }else if(sort == ''){
            	error('排序不能为空！');
            }else{
				//检测通过
				$.post('/adminspurview/add', {'parent_id':parent_id, 'url':url, 'name':name, 'sort':sort}, function(data){
					if(data.code==1){
						dialog({
							id: 'GSDF',
							title: '系统提示信息',
							width:300,
							height:80,
							content: data.msg,
						    okValue: '关闭',
						    ok: function () {
						    	window.location.href='/adminspurview';
						    }
						}).show();
					}else{
						show(data.msg);
					}
			    });
            }
        });
    });
    
    function show(msg){
    	var d = dialog({
    		id: 'EF893L',
    		width:300,
    		height: 80,
		    title: '系统提示信息',
		    content: msg,
		    cancel: false,
		    ok: function () {}
		});
		d.show();
    }
    function error(msg){
    	var d = dialog({
    		id: 'EF893L',
    		width:300,
    		height: 80,
		    title: '请填写完整信息',
		    content: msg,
		    cancel: false,
		    ok: function () {}
		});
		d.show();
    }
</script>
<?php $this->load->view("common/footer");?>
<script>
    seajs.use("<?php echo css_js_url('selectbox.js', 'admin');?>", function (select) {
    	selectbox('.selects');
    });
</script>
</body>
</html>