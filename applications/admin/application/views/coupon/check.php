<?php $this->load->view('common/header');?>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common">首页</a></li>
            <li><a href="/coupon">优惠卷核销</a></li>
        </ul>
    </div>
    
    
    <div class="rightinfo">

        <div class="tools">
            <form method="get">
                <ul class="placeul">
                    <li>  
                        优惠码：<input type="text" class="dfinput" name="number" value="<?php if(isset($number)):?><?php echo $number?> <?php endif;?>" style="width: 220px">
                        <input type="submit" value="搜 索" class="btn">
                    </li>
                </ul>
            </form>
        </div>
    
        <table class="tablelist">
            <thead>
            <tr>
        		<th>优惠卷ID</th>
        		<th>优惠卷名称</th>
        		<th>优惠价格</th>
        		<th>优惠码</th>
        		<th>手机号</th>
        		<th>发放时间</th>
        		<th>失效时间</th>
        		<th>状态</th>
        		<th>操作</th>
	        </tr>
            </thead>
            <tbody>
            <?php if($list):?>
	        <?php $now_time = time();foreach ($list as $k=>$v):?>
            <tr <?php if($k%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['coupon_name']?></td>
                <td><?php echo $v['favorable']?></td>
                <td><?php echo $v['number'];?></td>
                <td><?php echo $v['mobile_phone'];?></td>
                <td><?php echo $v['create_time']?></td>
                <td><?php echo $v['end_time']?></td>
                <td>
                    <?php
                        if($v['status'] == C("coupon.status.timeout.id") || strtotime($v['end_time']) < $now_time){
                            echo '已过期';
                        }else if($v['status'] == C("coupon.status.no_use.id")){
                            echo '未使用';
                        }else if($v['status'] == C("coupon.status.use.id")){
                            echo '已使用';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if($v['status'] == C("coupon.status.no_use.id") && strtotime($v['end_time']) > $now_time){
                            echo '<a href="/coupon/verification?id='. $v['id'] .'" class="tablelink">核销</a>';
                        }
                    ?>
                </td>
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
  			a.changestatus();
		})
	</script>
</body>
</html>
