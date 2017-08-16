<?php $this->load->view('common/header');?>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common">首页</a></li>
            <li><a href="/bless">祝福语管理</a></li>
        </ul>
    </div>
    
    <div class="rightinfo">
        <div class="tools">
            <!--  
            <ul class="toolbar">
                <li onclick="javascript:window.location.href='/milanstaff/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
            </ul>
            -->
        </div>
    
        <div class="tools">
            <form method="get">
                <ul class="placeul">
                    <li>  
                        <label>职员类型：</label>
                        <select class="dfinput selects" name="group_id" style="width:240px">
                            <option value>请选择职员类型</option>
                            <?php foreach($milan_staff_type as $k => $v):?>
                                <option value="<?php echo $v['id']; ?>"<?php if($group_id == $v['id']):?>selected="selected"<?php endif;?>>
                                    <?php echo $v['name']?>
                                </option>
                            <?php endforeach;?>
                        </select>
                                                            姓名：<input name="fullname" type="text" value="<?php echo isset($fullname) ? $fullname : '';?>" class="dfinput" style="height:32px;width:184px" />
                        <input type="submit" value="搜 索" class="btn">
                    </li>
                </ul>
            </form>
        </div>

        <table class="tablelist">
            <thead>
            <tr>
            		<th>编号ID</th>
            		<th>职员类型</th>
            		<th>职员姓名</th>
            		<th>职员电话</th>
            		<th>删除状态</th>
            		<th>操作</th>
	          </tr>
            </thead>
            <tbody>
            <?php if(isset($lists)):?>
        	   <?php foreach ($lists as $k=>$v):?>
                    <tr <?php echo $k%2 != 0 ? 'class="odd"' : ''?>>
                        
                        <td><?php echo $v['id']?></td>
                        
                        <td><?php echo $v['group']?></td>
                      
                    		<td><?php echo $v['fullname']?></td>
                    		
                    		<td><?php echo $v['tel']?></td>

                        <td>
                            <?php if($v['is_del'] == 1):?>
                                <span>未删除</span>
                	          <?php else:?>
                	              <span style="color:red">已删除</span>
                	         <?php endif;?>
                        </td>
                        
                        <td>
                        <!-- 
                            <a href="/milanstaff/edit/<?php echo $v['id']?>" class="tablelink">修改</a>
                            <a url="/milanstaff/del/<?php echo $v['id']?>" class="tablelink delete"><?php if($v['is_del']!=1):?>恢复<?php else:?> 删除<?php endif;?></a>
                         -->
                            <a href="/milanstaff/schedule/<?php echo $v['id']?>" class="tablelink">查看档期</a>
                        </td>
                    </tr> 
              <?php endforeach;?>
        	<?php endif;?>  
            
            </tbody>
        </table>
        
        <div class="pagin">
            <div class="message">共<i class="blue"><?php echo $data_count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
            <ul class="paginList">
                <?php echo isset($pagestr) ? $pagestr : '';?>
            </ul>
        </div>
    </div>
    <?php $this->load->view('common/footer') ?>
    <script>
		seajs.use([ '<?php echo css_js_url('theme.js', 'admin')?>'], function(a){
    		a.delete();
    	})
	</script>
</body>
</html>
