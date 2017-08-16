<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href=/attribute><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <!-- search -->
    <form class="form-inline" method="get">
        <div class="form-group">
            <label class="control-label">订单号：</label>
            <input type="text" name="order_num" class="form-control" placeholder="请输入订单号" value="<?php if(isset($order_num)):?><?php echo $order_num?><?php endif;?>">
        </div>
        <div class="form-group">
            <label class="control-label">用户姓名：</label>
            <input type="text" name="order_man" class="form-control" placeholder="请输入用户姓名" value="<?php if(isset($order_man)){echo $order_man;}?>">
        </div>
        <div class="form-group">
            <label class="control-label">手机号：</label>
            <input type="text" name="man_phone" class="form-control" placeholder="请输入手机号" value="<?php if(isset($man_phone)){echo $man_phone;}?>">
        </div>
        
        <div class="form-group">
            <label>删除状态：</label>
            <select name="is_del" class="form-control">
                <option value="0" <?php if(isset($is_del) && $is_del == 0):?>selected<?php endif;?>>未删除</option>
                <option value="1" <?php if(isset($is_del) && $is_del == 1):?>selected<?php endif;?>>已删除</option>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">搜索</button>
    </form>
    <hr>
    <!-- search -->
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
            		<th>ID</th>
            		<th>订单单号</th>
            		<th>联系人</th>
            		<th>联系电话</th>
            		<th>地点</th>
            		<th>支付金额</th>
            		<th>支付状态</th>
            		<th>状态</th>
            		<th>操作</th>
	           </tr>
            </thead>
            <tbody>
            <?php if(isset($list)):?>
	        <?php foreach ($list as $k=>$v):?>
            <tr <?php if($k%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['order_id']?></td>
                <td><?php echo $addr[$v['id']]['name']?></td>
                <td><?php echo $addr[$v['id']]['mobile_phone'];?></td>
                <td><?php echo $addr[$v['id']]['address'];?></td>
                <td><?php echo $v['need_pay'];?></td>
                <td><?php echo $pay_status[$v['status']];?>
                <?php if($v['status'] == C('order.pay_status.success.id')):?>
                <img  style="width:2rem;margin-left:5px" src="<?php echo $domain['static']['url']?>/admin/images/pay_success.png">
                <?php endif;?>
                </td>
                <td id="status">
    		        <?php if($v['delivery_status'] == 1):?>
    		                              已配送
    		            <?php else:?>
    		                              待配送
    		        <?php endif;?>
                </td>
                <td>
                <a class="btn btn-primary btn-xs" href="/online/edit?id=<?php echo $v['id']?>">编辑</a>
                <a class="btn btn-primary btn-xs look" href="/online/detail/<?php echo $v['id']?>" >查看</a>
                <a class="btn btn-primary btn-xs del_online"  data-id="/online/del?id=<?php echo $v['id']?>"  ><?php if($v['is_del'] == 1){echo '恢复';}else{echo '删除';}?></a> 
                </td>
            </tr> 
          <?php endforeach;?>
	      <?php endif;?>  
            </tbody>
        </table>
    </div>
    
    <!-- page -->
    <div class="row">
        <nav style="float: right">
            <ul class="pagination">
                <li class="disabled"><a>共<?php echo isset($count) && $count ?$count:'0'?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
 <?php $this->load->view('common/footer')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('adddrinkorder.js', 'admin')?>'], function(a){
            a.del_online();
        })
    </script>
</body>
</html>
