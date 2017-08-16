<?php $this->load->view('common/header');?>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common">首页</a></li>
            <li><a href="/coupon/type">类型列表</a></li>
        </ul>
    </div>
    
    
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
            <li onclick="javascript:window.location.href='/coupon/type_add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
            <li style="display:none"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t03.png" /></span>删除</li>
            </ul>
        </div>
    
        <table class="tablelist">
            <thead>
            <tr>
        		<th>ID</th>
        		<th>名称</th>
        		<th>状态</th>
        		<th>操作</th>
	        </tr>
            </thead>
            <tbody>
            <?php if($list):?>
	        <?php foreach ($list as $k=>$v):?>
            <tr <?php if($k%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['name']?></td>
                <td>
                <?php 
                if($v['is_del']){
                    echo '已删除';
                }else{
                    echo '正常';
                }
                ?></td>
                <td><a href="/coupon/type_edit?id=<?php echo $v['id']?>" class="tablelink">修改</a> 
                <a id="<?php echo $v['id']?>" name="typechange" href="javascript:;" data="<?php if($v['is_del'] == 1){echo 0;}else{echo 1;}?>" class="tablelink"><?php if($v['is_del'] == 0):?>删除<?php else:?>恢复<?php endif;?></a></td>
            </tr> 
          <?php endforeach;?>
	      <?php endif;?>  
            
            </tbody>
        </table>
        
        <div class="pagin">
            <div class="message">共<i class="blue"><?php echo $count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
            <ul class="paginList">
                <?php echo $pagestr;?>
            </ul>
        </div>
        </div>
        <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/footer')?>
    <script type="text/javascript">
		seajs.use(['<?php echo css_js_url('coupon.js', 'admin')?>'], function(a){
  			a.typechange();
		})
	</script>
</body>
</html>
