<?php $this->load->view('common/header');?>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="JavaScript:;">手机端菜单列表</a></li>
    </ul>
</div>    

<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
        <li onclick="javascript:window.location.href='/wapmenus/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加菜单</li>
        </ul>
    </div>

    <table class="tablelist">
        <thead>
            <tr>
                <th>编号id</th>
                <th>菜单名称</th>
                <th>链接</th>
                <th>排序</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($list)):?>
            <?php foreach($list as $key => $val):?>
            <tr <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $val['id']?></td>
                <td><?php echo $val['title']?></td>
                <td><?php echo $val['url']?></td>
                <td><?php echo $val['sort']?></td>
                <td <?php if($val['is_show'] == 0){echo 'style="color:red;"';}else{echo 'style="color:green;"';}?> ><?php if($val['is_show'] == 1){echo '显示';}else{echo '屏蔽';} ?></td>
                <td>
                    <a href="/wapmenus/edit?id=<?php echo $val['id'];?>" class="tablelink">编辑</a> 
                    <a href="/wapmenus/change?id=<?php echo $val['id'];?>&status=<?php if($val['is_show'] == 1){echo 0;}else{echo 1;}?>" class="tablelink"><?php if($val['is_show'] == 0){echo '显示';}else{echo '屏蔽';} ?></a> 
                    <a href="/wapmenus/del?id=<?php echo $val['id']?>" class="tablelink" onClick="if(confirm('你确定删除?'))return true;return false;">删除</a>
                </td>
            </tr> 
            <?php if(isset($val['child'])):?>
            <?php foreach($val['child'] as $k => $v):?>
            <tr <?php if($k%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $v['id']?></td>
                <td><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;└──';?><?php echo $v['title']?></td>
                <td><?php echo $v['url']?></td>
                <td><?php echo $v['sort']?></td>
                <td <?php if($v['is_show'] == 0){echo 'style="color:red;"';}else{echo 'style="color:green;"';}?> ><?php if($v['is_show'] == 1){echo '显示';}else{echo '屏蔽';} ?></td>
                <td>
                    <a href="/wapmenus/edit?id=<?php echo $v['id'];?>" class="tablelink">编辑</a>   
                    <a href="/wapmenus/change?id=<?php echo $v['id'];?>&status=<?php if($v['is_show'] == 1){echo 0;}else{echo 1;}?>" class="tablelink"><?php if($v['is_show'] == 0){echo '显示';}else{echo '屏蔽';} ?></a> 
                    <a href="/wapmenus/del?id=<?php echo $v['id']?>" class="tablelink" onClick="if(confirm('你确定删除?'))return true;return false;">删除</a>
                </td>
            </tr> 
            <?php endforeach;?>
            <?php endif;?>
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>

    
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
    function del(id, state) {
        window.location.href = '/news/del/'+id+'/'+state;
    }
</script>
	</body>
</html>