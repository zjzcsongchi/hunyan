<?php $this->load->view("common/header");?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#"><?php echo $title[0];?></a></li>
        <li><a href="#"><?php echo $title[1];?></a></li>
    </ul>
</div>

<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
            <li onclick="javascript:window.location.href='/admingroup/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
        </ul>
    </div>
    <table class="tablelist">
        <thead>
        <tr>
            <th>编号</th>
            <th>角色名</th>
            <th>描述</th>
            <th>管理员数量</th>
            <th>操作</th>
           
          </thead>
        <tbody>
        <?php
            if($list){
                foreach($list as $key=>$val){
        ?>
        <tr <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>

            <td><?php echo $val['id'];?></td>
            <td><?php echo $val['name'];?></td>
            <td><?php echo $val['describe'];?></td>
            <td>
                <a href="/admins?group_id=<?php echo $val['id'];?>"><?php echo $val['admin_count'];?></a>
            </td>

            <td>
                <a href="/admingroup/edit/<?php echo $val['id'];?>">修改</a>
                <a href="/admingroup/del/<?php echo $val['id'];?>" title="删除">删除</a>
                <a href="/admingroup/purview/<?php echo $val['id'];?>">权限分配</a>
                <a href="/admingroup/read/<?php echo $val['id'];?>">查看</a>
            </td>

        </tr>
        <?php } } ?>
        </tbody>
    </table>

</div>
<?php $this->load->view("common/footer");?>
	</body>
</html>