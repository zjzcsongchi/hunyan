<?php $this->load->view('common/header');?>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="JavaScript:;">静态资源列表</a></li>
    </ul>
</div>    

<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
        <li onclick="javascript:window.location.href='/version/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加模块</li>
        </ul>
    </div>

    <table class="tablelist">
        <thead>
            <tr>
                <th>编号</th>
                <th>所属网站类型</th>
                <th>css版本号</th>
                <th>js版本号</th>
                <th>创建时间</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $key => $val):?>
            <tr <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $val['id']?></td>
                <td><?php echo $val['web_type']?></td>
                <td><?php echo $val['css_version_id']?></td>
                <td><?php echo $val['js_version_id']?></td>
                <td><?php echo $val['create_time']?></td>
                <td><?php echo $val['update_time']?></td>
                <td>
                    <a href="/version/refresh/<?php echo $val['id'];?>" class="tablelink">刷新</a>   
                    <a href="/version/del/<?php echo $val['id']?>" class="tablelink" onClick="if(confirm('你确定删除?'))return true;return false;">删除</a>
                </td>
            </tr> 
            <?php endforeach;?>
        </tbody>
    </table>

    
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
    function del(id, state) {
        window.location.href = '/news/del/'+id+'/'+state;
    }
</script>
	</body>
</html>