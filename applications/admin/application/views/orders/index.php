<?php $this->load->view('common/header');?>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common">首页</a></li>
            <li><a href="/orders">酒水列表</a></li>
        </ul>
    </div>
    
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
            <li onclick="javascript:window.location.href='/orders/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
            <li style="display:none"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t03.png" /></span>删除</li>
            </ul>
        </div>
    
        <div class="tools">
            <form method="get">
                <ul class="placeul">
                    <li>  
                        订单单号：<input type="text" class="dfinput" name="order_num" value="<?php if(isset($order_num)):?><?php echo $order_num?><?php endif;?>" style="width: 220px">
                        用户姓名： <input type="text" class="dfinput" name="order_man" value="<?php if(isset($order_man)){echo $order_man;}?>" />
                        手机号： <input type="text" class="dfinput" name="man_phone" value="<?php if(isset($man_phone)){echo $man_phone;}?>" />
                        <input type="submit" value="搜 索" class="btn">
                    </li>
                </ul>
            </form>
        </div>
        <table class="tablelist">
            <thead>
            <tr>
        		<th>ID</th>
        		<th>订单单号</th>
        		<th>客户姓名</th>
        		<th>联系电话</th>
        		<th>宴会日期</th>
        		<th>宴会类型</th>
        		<th>定金</th>
        		<th>地点</th>
        		<th>接待员</th>
        		<th>经办人</th>
        		<th>状态</th>
        		<th>是否删除</th>
        		<th>操作</th>
	        </tr>
            </thead>
            <tbody>
            <?php if(isset($list)):?>
	        <?php foreach ($list as $k=>$v):?>
            <tr <?php if($k%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['order_num']?></td>
                <td><?php echo $v['order_man']?></td>
                <td><?php echo $v['man_phone'];?></td>
                <td><?php echo date('Y-m-d', strtotime($v['g_time']))?></td>
                <td>
                    <?php foreach (C('party') as $kk => $vv):?>
        		        <?php if($v['order_type'] == $vv['id']):?>
        		            <?php echo $vv['name']?>
        		        <?php endif;?>
        		    <?php endforeach;?>
                </td>
                <td><?php echo $v['bargain_money']?></td>
                <td><?php echo implode('、', $v['place_name']);?></td>
                <td><?php echo $v['receptionist']?></td>
                <td><?php echo $v['create_admin']?></td>
                <td id="status">
        		    <?php foreach (C('orders_status') as $kk => $vv):?>
        		        <?php if($v['status'] == $vv['id']):?>
        		            <?php echo $vv['name']?>
        		        <?php endif;?>
        		    <?php endforeach;?>
                </td>
                <td id="is_del"><?php if ($v['is_del']==1):?>已删除
        		<?php else:?>未删除
        		<?php endif;?>
        		</td>
                <td>
                <a href="/orders/edit?id=<?php echo $v['id']?>">编辑</a>
                <a href="/orders/detail?id=<?php echo $v['id']?>" class="look" >查看</a>
                 <a href="/orders/del?id=<?php echo $v['id']?>&is_del=<?php if($v['is_del'] == 1){echo 0;}else{echo 1;}?>"  ><?php if($v['is_del'] == 1){echo '恢复';}else{echo '删除';}?></a> 
                </td>
            </tr> 
          <?php endforeach;?>
	      <?php endif;?>  
            
            </tbody>
        </table>
        
        <div class="pagin">
            <div class="message">共<i class="blue"><?php if(isset($count)){echo $count;}?></i>条记录，当前显示第&nbsp;<i class="blue"><?php if(isset($page)){echo $page;}?>&nbsp;</i>页</div>
            <ul class="paginList">
                <?php if(isset($pagestr)){echo $pagestr;}?>
            </ul>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/footer')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('jsdd.js', 'admin')?>'], function(a){
        	a.change();
        	a.look();
        })
    </script>
</body>
</html>
