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
            <form method="get">
                <ul class="placeul">
                    <li>  
                        <label>婚宴场馆：</label>
                        <select class="dfinput selects" name="venue_id" style="width:240px">
                            <?php foreach ($venus as $key=>$v){?>
                            <option value="<?php echo $v['id']; ?>"<?php if($venue_id == $v['id']):?>selected="selected"<?php endif;?>><?php echo $v['name']?></option>
                            <?php }?>
                        </select>
                                                            日期：<input name="time" type="text" value="<?php echo isset($time) ? $time : date('Y-m-d');?>" class="dfinput Wdate" style="height:32px;width:184px" required/>
                        <input type="submit" value="搜 索" class="btn">
                    </li>
                </ul>
            </form>
        </div>

        <table class="tablelist">
            <thead>
            <tr>
        		<th>发送者头像</th>
        		<th>发送者昵称</th>
        		<th>发送者电话</th>
        		<th>祝福语内容</th>
        		<th>点赞数</th>
        		<th>发送时间</th>
        		<th>删除状态</th>
        		<th>操作</th>
	        </tr>
            </thead>
            <tbody>
            <?php if(isset($bless)):?>
        	   <?php foreach ($bless as $k=>$v):?>
                    <tr <?php echo $k%2 != 0 ? 'class="odd"' : ''?>>
                        
                        <td><img src="<?php echo $v['head_img']?>" style="height:60px"></td>
                        
                        <td><?php echo $v['nickname']?></td>
                      
                    		<td><?php echo $v['mobile_phone']?></td>
                    		
                    		<td><?php echo $v['content']?></td>
                    		
                    		<td><?php echo $v['zan_count']?></td>
                        
                        <td><?php echo $v['create_time']?></td>
                        
                        <td>
                            <?php if($v['is_del'] == 0):?><span>未删除</span>
                	                 <?php else:?><span style="color:red">已删除</span>
                	        <?php endif;?>
                        </td>
                        
                        <td>
                            <a href="/bless/del/<?php echo $v['id']?>" class="tablelink"><?php if($v['is_del']):?>恢复<?php else:?> 删除<?php endif;?></a>
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
        seajs.use(['wdate'], function(){
            $(function(){
                $(".Wdate").focus(function(){
                    WdatePicker({dateFmt:'yyyy-MM-dd'})
                });
            });
        })
    </script>
</body>
</html>
