<?php $this->load->view('common/header2');?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li class="active">管理员列表</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <a href="/admin/add" class="btn btn-primary">添 加 <span class="glyphicon glyphicon-plus"></span></a>
    <hr>
    <form class="form-inline">
        <div class="form-group">
            <label class="control-label">登录名：</label>
            <input type="text" class="form-control" name="name" value="<?php echo $name?>" >
        </div>
        <div class="form-group">
            <label class="control-label">姓名：</label>
            <input type="text" class="form-control" name="fullname" value="<?php echo $fullname?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">搜 索 <span class="glyphicon glyphicon-search"></span></button>
        </div>
        <div class="form-group">
            <a href="/admin/get_birthday_girl" class="btn btn-primary">本月寿星</a>
        </div>
    </form>
    <br>

    <table class="table table-bordered">
        <thead>
        <tr class="info">
            <th>编号</th>
            <th>登陆名</th>
            <th>姓名</th>
            <th>Email</th>
            <th>角色</th>
            <th>机构</th>
            <th>创建者</th>
            <th>创建时间</th>
            <th>操作</th>
         </thead>
        <tbody>
        <?php
            if($admin_list){
                foreach($admin_list as $key=>$val){
        ?>
        <tr <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>

            <td><?php echo $val['id'];?></td>
            <td><?php echo $val['name'];?></td>
            <td><?php echo $val['fullname'];?></td>
            <td><?php echo $val['email'];?></td>
            <td><?php echo @$groups[$val['group_id']];?></td>
               <td><?php echo $type[$val['type']];?></td>
            <td><?php echo @$admins[$val['create_admin']];?></td>
         
           <td><?php echo $val['create_time'];?></td>
            <td>
                <a href="/admin/edit/<?php echo $val['id'];?>">修改</a>
                <?php
                    if($val['id'] != 1){
                ?>
                <a href="/admin/del/<?php echo $val['id'];?>" title="删除">删除</a>
                <a href="/admin/purview/<?php echo $val['id'];?>">分配权限</a>
                <a href="/admin/read/<?php echo $val['id'];?>">查看</a>
                <a href="/admin/enable_disable?id=<?php echo $val['id'];if($val['disabled'] == 1){ echo "&disabled=2";}else{echo "&disabled=1";}?>">
                    <?php if($val['disabled'] == 1){ echo "禁用";}else{echo "启用";}?>
                </a>
                <?php }?>
            </td>

        </tr>
        <?php } } ?>
        </tbody>
    </table>

    <!-- page -->
    <div class="row">
        <nav style="float: right">
            <ul class="pagination">
                <li class="disabled"><a>共<?php echo $data_count?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
</body>
</html>
