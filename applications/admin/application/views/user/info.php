<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/houseorder">客户管理</a></li>
        <li><a href="#">详情</a></li>
    </ul>
</div>
<div class="formbody">
    <table class="detail-info">
        <tr>
            <td colspan="4" class="info-title">个人信息</td>
        </tr>
        
        <tr>
            <td class="info-item" width="200">姓名</td>
            <td style="width:300px;"><?php echo $user['realname']?></td>
            <td class="info-item" width="200">昵称</td>
            <td><?php echo $user['nickname'];?></td>
        </tr>
        
        <tr>
            <td class="info-item" width="200">电话</td>
            <td><?php echo $user['mobile_phone'];?></td>
            <td class="info-item" width="200">性别</td>
            <td style="width:300px;"><?php if($user['sex'] == 0):?>男<?php else:?> 女<?php endif;?></td>
        </tr>
        
        <tr>
            <td class="info-item">身份证号码</td>
            <td><?php echo $user['id_number']?></td>
            <td class="info-item">地址</td>
            <td><?php echo $user['address']?></td>
        </tr>
        
        <tr>
            <td class="info-item">添加人</td>
            <td><?php echo $create_user?></td>
            <td class="info-item">添加时间</td>
            <td><?php echo $user['create_time']?></td>
        </tr>
        
        <tr>
            <td class="info-item">登录状态</td>
            <td><?php if($user['is_limit'] == 1):?>限制登录<?php else:?>正常登录<?php endif;?></td>
            <td class="info-item">删除状态</td>
            <td><?php if($user['is_del'] == 1): ?>已删除<?php else:?>未删除<?php endif;?></td>
        </tr>
        
        
        <tr>
            <td class="info-item" colspan="2">头像</td>
        </tr>
        <tr>
            <td colspan="2" style="padding-left:0; text-align: center;"><a class="info-item-img" href="<?php echo get_img_url($user['head_img']);?>" target="_blank"><img alt="头像" src="<?php echo get_img_url($user['head_img']);?>"></a></td>
            <td colspan="2" style="padding-left:0; text-align: center;"><a class="info-item-img" href="" target="_blank"><img src=""></a></td>
        </tr>
    </table>
</div>
</body>
</html>