<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#">资讯管理</a></li>
        <li><a href="#">资讯类别列表</a></li>
    </ul>
</div>

<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
            <li onclick="javascript:window.location.href='/news/add_class';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
        </ul>
    </div>

    <div class="tools">
        <form method="get">
            <ul class="placeul">
                <li>  
                    分类名称：<input type="text" class="dfinput" name="name" value="<?php echo $name; ?>" style="width: 220px">
                    父级分类：
                    <select class="dfinput selects" name="parent_id" style="width: 220px">
                        <option value="">---请选择父级分类---</option>
                        <?php foreach ($parent_lists as $key => $val): ?>
                        <option value="<?php echo $val['id'];?>" <?php if($val['id'] == $parent_id){ echo "selected"; }?>><?php echo $val['name'];?></option>
                        <?php endforeach;?>
                    </select>
                    是否删除：
                    <select class="dfinput selects" name="is_del" style="width: 120px">
                        <option value="0" <?php if($is_del == 0){ echo "selected"; }?>>未删除</option>
                        <option value="1" <?php if($is_del == 1){ echo "selected"; }?>>已删除</option>
                    </select>
                    <input type="submit" value="搜 索" class="btn">
                </li>
            </ul>
        </form>
    </div>

    <table class="tablelist">
        <thead>
        <tr>
            <th>编号</th>
            <th>分类名称</th>
            <th>父级分类</th>
            <th>添加时间</th>
            <th>是否删除</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($lists as $key => $val): ?>
            <tr <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $val['id'];?></td>
                <td><?php echo $val['name'];?></td>
                <td><?php if($val['parent_id'] == 0) { echo "一级分类"; } else { echo $parent_class[$val['parent_id']]; }?></td>
                <td><?php echo $val['create_time'];?></td>
                <td><?php if($val['is_del'] == 0) { echo "未删除"; } else { echo "<span style='color:red'>已删除</span>"; } ?></td>
                <td>
                    <a href="/news/edit_class/<?php echo $val['id'];?>" class="tablelink">修改</a> 
                    <?php if($val['is_del'] == 1){ ?>    
                    <a href="javascript:;" class="tablelink" onclick="javascript:del('<?php echo $val["id"]?>','0')"> 取消删除</a>
                    <?php }else { ?>
                    <a href="javascript:;" class="tablelink" onclick="javascript:del('<?php echo $val["id"]?>','1')"> 删除</a>
                    <?php } ?>
                </td>
            </tr> 
            <?php endforeach;?>
        </tbody>
    </table>
    
    <div class="pagin">
        <div class="message">共<i class="blue"><?php echo $data_count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
        <ul class="paginList">
            <?php echo $pagestr;?>
        </ul>
    </div>
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
    function del(id, state) {
        window.location.href = '/news/del_class/'+id+'/'+state;
    }
</script>
<script>
    seajs.use("<?php echo css_js_url('selectbox.js', 'admin');?>", function (select) {
    	selectbox('.selects');
    });
</script>
	</body>
</html>