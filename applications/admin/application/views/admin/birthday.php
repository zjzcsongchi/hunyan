<?php $this->load->view('common/header2');?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li class="active">管理员列表</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend>本月寿星</legend>
        <table class="table table-bordered">
            <thead>
            <tr class="info">
                <th>编号</th>
                <th>姓名</th>
                <th>微信头像</th>
                <th>微信昵称</th>
                <th>手机号</th>
                <th>生日</th>
             </thead>
            <tbody>
            <?php if($list):?>
            <?php foreach ($list as $k => $v):?>
            <tr >
    
                <td><?php echo $k+1;?></td>
                <td><?php echo $v['fullname'];?></td>
                <td><img style="max-height:50px" src="<?php echo isset($v['head_img']) && !empty($v['head_img']) ? get_img_url($v['head_img']) : C('domain.static.url').'/wap/images/touxiang.png';?>"></td>
                <td><?php echo isset($v['nickname']) ? $v['nickname'] : '';?></td>
                <td><?php echo $v['tel']?></td>
                <th><?php echo $v['birthday']?></th>
                
            </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </fieldset>

</div>
</body>
</html>