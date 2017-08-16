<?php $this->load->view('common/header');?>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common">首页</a></li>
            <li><a href="/drinkclass">酒水分类</a></li>
        </ul>
    </div>
    
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
            <li onclick="javascript:window.location.href='/drinkclass/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
            <li style="display:none"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t03.png" /></span>删除</li>
            </ul>
        </div>
    
        <div class="tools">
            <form method="get">
                <ul class="placeul">
                    <li>  
                        分类名称：<input type="text" class="dfinput" name="cn_name" value="<?php if(isset($cn_name)):?><?php echo $cn_name?> <?php endif;?>" style="width: 220px">
                        <input type="submit" value="搜 索" class="btn">
                    </li>
                </ul>
            </form>
        </div>

        <table class="tablelist">
            <thead>
            <tr>
        		<th>分类ID</th>
        		<th>中文名称</th>
        		<th>英文名称</th>
        		<th>简介</th>
        		<th>状态</th>
        		<th>添加时间</th>
        		<th>操作</th>
	        </tr>
            </thead>
            <tbody>
            <?php if($list):?>
	<?php foreach ($list as $k=>$v):?>
            <tr <?php if($k%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['cn_name']?></td>
                <td><?php echo $v['en_name']?></td>
                <td><?php echo $v['summary']?></td>
                <td><?php if ($v['is_del']==0):?>正常
        		<?php else:?>删除
        		<?php endif;?>
        		</td>
                <td><?php echo $v['create_time']?></td>
                <td><a href="/drinkclass/edit/<?php echo $v['id']?>" class="tablelink">修改</a> 
                <a href="/drinkclass/del/<?php echo $v['id']?>" class="tablelink">删除</a>
                </td>
            </tr> 
          <?php endforeach;?>
	<?php endif;?>  
            
            </tbody>
        </table>
        
        <div class="pagin">
            <div class="message">共<i class="blue"><?php echo $data_count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
            <ul class="paginList">
                <?php echo $pagestr;?>
            </ul>
        </div>
    </div>
</body>
</html>
