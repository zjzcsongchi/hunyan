<?php $this->load->view('common/header');?>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common">首页</a></li>
            <li><a href="/ManualClass">酒水列表</a></li>
        </ul>
    </div>
    
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
            <li onclick="javascript:window.location.href='/drink/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
            <li style="display:none"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t03.png" /></span>删除</li>
            </ul>
        </div>
    
        <div class="tools">
            <form method="get">
                <ul class="placeul">
                    <li>  
                        商品中文名称：<input type="text" class="dfinput" name="cn_name" value="<?php if(isset($cn_name)):?><?php echo $cn_name?> <?php endif;?>" style="width: 220px">
                        <select name="class_name" class="dfinput selects">
                            <option value="">--选择分类--</option>
                            <?php foreach($type as $k => $v):?>
                            <option <?php if(isset($class_name) && $class_name == $v){ echo 'selected';}?> value="<?php echo $v?>">--<?php echo $v?>--</option>
                            <?php endforeach;?>
                        </select>
                        <select name="is_show" class="dfinput selects">
                            <option value="">--请选择状态--</option>
                            <option <?php if(isset($is_show) && $is_show == 1){echo 'selected';}?> value="1">--上架--</option>
                            <option <?php if(isset($is_show) && $is_show == 0){echo 'selected';}?> value="0">--下架--</option>
                        </select>
                        <input type="submit" value="搜 索" class="btn">
                    </li>
                </ul>
            </form>
        </div>

        <table class="tablelist">
            <thead>
            <tr>
        		<th>ID</th>
        		<th>分类</th>
        		<th>中文名称</th>
        		<th>原价</th>
        		<th>现价</th>
        		<th>封面图</th>
        		<th>公司</th>
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
                <td><?php echo $type[$v['class_id']]?></td>
                <td><?php echo $v['cn_name']?></td>
                <td><?php echo $v['original_price']?></td>
                <td><?php echo $v['price']?></td>
                <td><img width="150" height="150" style="overflow: hidden;" src="<?php echo get_img_url($v['cover_img'])?>"/></td>
                <td><?php echo $v['firm']?></td>
                <td><?php if ($v['is_show']==1):?>上架
        		<?php else:?>下架
        		<?php endif;?>
        		</td>
                <td><?php echo $v['create_time']?></td>
                <td><a href="/drink/edit/<?php echo $v['id']?>" class="tablelink">修改</a> 
                 <a href="/drink/del/<?php echo $v['id']?>" class="tablelink">删除</a> 
                 
                 <a href="/drink/show/<?php echo $v['id']?>" class="tablelink"><?php if($v['is_show'] == 0):?>上架 <?php else:?> 下架<?php endif;?></a>
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
