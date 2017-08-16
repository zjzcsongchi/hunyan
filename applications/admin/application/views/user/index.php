<?php $this->load->view('common/header');?>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common">首页</a></li>
            <li><a href="/ManualClass">客户列表</a></li>
        </ul>
    </div>
    
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
            <li onclick="javascript:window.location.href='/user/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
            <li style="display:none"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t03.png" /></span>删除</li>
            </ul>
        </div>
    
        <div class="tools">
            <form method="get">
                <ul class="placeul">
                    <li>  
                        姓名：<input type="text" class="dfinput" name="name" value="<?php echo @$name;?>" style="width: 220px">
                        电话：<input type="text" class="dfinput" name="phone" value="<?php echo @$phone;?>" style="width: 220px">
                       会员类型：<select class="dfinput selects" name="user_type" style="width:240px">
                          <option value="0">--请选择会员类型--</option>
                          <option <?php if(isset($user_type) && $user_type ==1){ echo 'selected';}?> value="1">会员</option>
                          <option <?php if(isset($user_type) && $user_type ==2){ echo 'selected';}?>  value="2">客户</option>
                          <option <?php if(isset($user_type) && $user_type ==3){ echo 'selected';}?> value="3">散客</option>
                        </select> 
                        会员状态：<select class="dfinput selects" name="is_del" style="width:240px">
                          <option value="0">--未删除--</option>
                          <option <?php if(isset($is_del) && $user_type ==1){ echo 'selected';}?> value="1">--已删除--</option>
                        </select> 
                        <input type="submit" value="搜 索" class="btn">
                    </li>
                </ul>
            </form>
        </div>

        <table class="tablelist">
            <thead>
            <tr>
        		<th>客户ID</th>
        		<th>头像</th>
        		<th>客户昵称</th>
        		<th>真实姓名</th>
        		<th>性别</th>
        		<th>电话</th>
        		<th>地址</th>
        		<th>登录状态</th>
        		<th>删除状态</th>
        		<th>操作</th>
	        </tr>
            </thead>
            <tbody>
            <?php if($user):?>
        	   <?php foreach ($user as $k=>$v):?>
                    <tr <?php if($k%2 !=0 ){ echo 'class="odd"';}?>>
                        <td><?php echo $v['id']?></td>
                        <td><?php if(isset($v['head_img'])):?><img src="<?php echo get_img_url($v['head_img'])?>" style="width:60px; height:60px;padding-top:10px;"><?php endif;?></td>
                        <td><?php echo $v['nickname']?></td>
                        <td>
                	       <?php echo $v['realname']?>
                		</td>
                		<td>
                	       <?php if($v['sex'] == 2):?>女
                	                 <?php elseif($v['sex'] == 1):?>男
                	                  <?php else:?>未知
                	       <?php endif;?>
                		</td>
                		<td>
                	       <?php echo $v['mobile_phone']?>
                		</td>
                		<td>
                	       <?php echo $v['address']?>
                		</td>
                        <td>
                            <?php if($v['is_limit']):?><span style="color:red">限制登录</span>
                	                 <?php else:?><span>正常</span>
                	        <?php endif;?>
                        </td>
                        <td>
                            <?php if($v['is_del'] == 0):?><span>未删除</span>
                	                 <?php else:?><span style="color:red">已删除</span>
                	        <?php endif;?>
                        </td>
                        <td>
                            <a href="/user/limit/<?php echo $v['id']?>" class="tablelink"><?php if($v['is_limit']):?>取消限制<?php else:?> 限制登录<?php endif;?></a>
                            <a href="/user/del/<?php echo $v['id']?>" class="tablelink"><?php if($v['is_del']):?>恢复<?php else:?> 删除<?php endif;?></a>
                            <a href="/user/edit/<?php echo $v['id']?>" class="tablelink">修改</a> 
                            <a href="/user/view/<?php echo $v['id']?>" class="tablelink">详情</a>
                        </td>
                    </tr> 
              <?php endforeach;?>
        	<?php endif;?>  
            
            </tbody>
        </table>
        
        <div class="pagin">
            <div class="message">共<i class="blue"><?php echo $data_count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
            <ul class="paginList">
                <?php if(isset($pagestr)){echo $pagestr;}?>
            </ul>
        </div>
    </div>
</body>
</html>
