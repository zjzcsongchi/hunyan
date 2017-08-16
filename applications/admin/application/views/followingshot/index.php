<?php $this->load->view('common/header');?>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="JavaScript:;">最美跟拍相册列表</a></li>
    </ul>
</div>    

<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
        <li onclick="javascript:window.location.href='/followingshot/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加相册</li>
        </ul>
    </div>

    <table class="tablelist">
        <thead>
            <tr>
                <th>编号</th>
                <th>标题</th>
                <th>创建时间</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lists as $key => $val):?>
            <tr <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $val['id']?></td>
                <td><?php echo $val['title']?></td>
                <td><?php echo $val['create_time']?></td>
                <td><?php echo $val['update_time']?></td>
                <td>
                    <a href="/followingshot/edit/<?php echo $val['id'];?>" class="tablelink">修改</a>   
                    <a url="/followingshot/del/<?php echo $val['id']?>" class="tablelink delete" >删除</a>
                </td>
            </tr> 
            <?php endforeach;?>
        </tbody>
    </table>
    
    <div class="pagin">
        <div class="message">共<i class="blue"><?php echo $data_count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
        <ul class="paginList">
            <?php echo isset($pagestr) ? $pagestr : '';?>
        </ul>
    </div>

</div>
<?php $this->load->view('common/footer');?>
<script>
	seajs.use([ '<?php echo css_js_url('theme.js', 'admin')?>'], function(a){
	a.delete();
	})
</script>

	</body>
</html>