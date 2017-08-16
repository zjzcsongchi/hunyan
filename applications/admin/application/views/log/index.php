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
   <table class="tablelist">
        <thead>
        <tr>
            <th>编号</th>
            <th>登陆名</th>
            <th>登录时间</th>
            <th>登录IP</th>
            <th>登录状态</th>
         </thead>
        <tbody>
        <?php
            if($log_list){
                foreach($log_list as $key=>$val){
        ?>
        <tr <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>

            <td><?php echo $val['id'];?></td>
            <td><?php echo $val['login_name'];?></td>
            <td><?php echo $val['login_time'];?></td>
            <td><?php echo $val['login_ip'];?></td>
            <td><?php if($val['admin_id']){echo "成功";}else{echo "失败";}?></td>
        </tr>
        <?php } } ?>
        </tbody>
    </table>

    <div class="pagin">
        <div class="message">共<i class="blue"><?php echo $data_count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
        <ul class="paginList">

            <?php echo $pagestr;?>

        </ul>
    </div>
</div>
<?php $this->load->view("common/footer");?>
	</body>
</html>