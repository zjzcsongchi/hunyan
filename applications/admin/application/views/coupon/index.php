<?php $this->load->view('common/header');?>
    
     <style media=print type="text/css"> .noprint{display : none } </style>
    
    <div class="place noprint">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common">首页</a></li>
            <li><a href="/coupon">优惠卷列表</a></li>
        </ul>
    </div>
    
    
    <div class="rightinfo">
        <div class="tools noprint">
            <ul class="toolbar">
            <li style="display:none" onclick="javascript:window.location.href='/coupon/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
            <li style="display:none"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t03.png" /></span>删除</li>
            </ul>
        </div>
    
        <div class="tools noprint">
        <form method="get">
            <ul class="placeul">
                <li>  
                    客户姓名：<input type="text" class="dfinput" name="name" value="<?php echo isset($name) && $name? $name :''; ?>" style="width: 220px" placeholder="请输入新郎/新娘/客户姓名">
                    <input type="text" style="display:none" class="dfinput" name="tel" value="<?php echo isset($tel) && $tel ?$tel:'' ; ?>" style="width: 220px" placeholder="请输入新郎/新娘/客户电话">
                    是否使用：
                    <select class="dfinput selects" name="status" style="width: 120px">
                        <option value="" <?php if(isset($status) && $status == -1 ||!isset($status)):?>selected<?php endif;?>>全部</option>
                        <option value="0" <?php if(isset($status) && $status == 0):?>selected<?php endif;?>>未使用</option>
                        <option value="1" <?php if(isset($status) && $status == 1):?>selected<?php endif;?>>已使用</option>
                    </select>
                    
                    添加日期    <input type="text" name="create_time" class="dfinput Wdate" style="height: 34px;width: 220px" placeholder="请选择添加日期" value="<?php if(isset($create_time)){echo $create_time;}?>">
                    核销日期    <input type="text" name="end_time" class="dfinput Wdate" style="height: 34px;width: 220px" placeholder="请选择核销日期" value="<?php if(isset($end_time)){echo $end_time;}?>">
                    <input type="submit" value="搜 索" class="btn">
                    <button id="print_me" class="btn btn-primary" type="button" onclick='javascript:window.print();'>打印</button>
                </li>
            </ul>
        </form>
    </div>
        <!--startprint-->
        <table class="tablelist">
            <thead>
            <tr>
        		<th>优惠卷ID</th>
        		<th>优惠卷类型</th>
        		<th>主角</th>
        		<th>主角电话</th>
        		<th>编号</th>
        		<th>优惠价格</th>
        		<?php if (isset($end_time) && $end_time || isset($status) && $status == 1):?>
        		<th>核销时间</th>
        		<?php else:?>
        		<th>添加时间</th>
        		<?php endif;?>
        		<th>添加人</th>
        		<th>使用状态</th>
        		<th class="noprint">操作</th>
	        </tr>
            </thead>
            <tbody>
            <?php if($list):?>
	        <?php foreach ($list as $k=>$v):?>
            <tr <?php if($k%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $v['id']?></td>
                <td><?php echo $coupon_type[$v['coupon_type']]?></td>
                <td><?php echo isset($roles[$v['dinner_id']]['roles_main']) ? $roles[$v['dinner_id']]['roles_main'] : ''?></td>
                <td><?php echo isset($roles[$v['dinner_id']]['roles_main_mobile']) ? $roles[$v['dinner_id']]['roles_main_mobile'] : ''?></td>
                <td><?php echo $v['number']?></td>
                <td><?php echo $v['money']?></td>
                <?php if (isset($end_time) && $end_time || isset($status) && $status == 1):?>
        		<td><?php echo $v['end_time']?></td>
        		<?php else:?>
        		<td><?php echo $v['create_time']?></td>
                <?php endif;?>
                <td><?php echo isset($admin[$v['create_admin']]) && $admin[$v['create_admin']] ?$admin[$v['create_admin']] :'';?></td>
                
                 <td>
                <?php 
                if($v['status'] == 0){
                    echo '未使用';
                }else{
                    echo '已使用';
                }
                ?></td>
                <td class="noprint">
                    <a style="display:none" href="/coupon/edit?id=<?php echo $v['id']?>" class="tablelink">修改</a> 
                    <a  href="javascript:;" url="/coupon/del/<?php echo $v['id']?>" class="delete">删除</a>
                    <a style="display:none" href="/coupon/send?id=<?php echo $v['id']?>" class="tablelink">发放</a>
                </td>
            </tr> 
          <?php endforeach;?>
	      <?php endif;?>  
            
            </tbody>
        </table>
        <!--endprint-->
        
        <div class="pagin noprint">
            <div class="message">共<i class="blue"><?php echo $count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
            <ul class="paginList">
                <?php echo isset($pagestr)? $pagestr:'';?>
            </ul>
        </div>
        </div>
        <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/footer')?>
    <script type="text/javascript">
		seajs.use(['<?php echo css_js_url('coupon.js', 'admin')?>', 'wdate'], function(a){
  			a.changestatus();
  			a.delete();
 			 $(function(){
 		          $(".Wdate").focus(function(){
 		              WdatePicker({dateFmt:'yyyy-MM-dd'})
 		          });
 		      });
		})
	</script>
</body>
</html>
