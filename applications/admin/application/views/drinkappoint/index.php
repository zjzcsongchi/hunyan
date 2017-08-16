<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href=/attribute><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="/drinkappoint/add">添加</a>
    <hr>
    <!-- search -->
    <form class="form-inline" method="get">
        <div class="form-group">
            <label class="control-label">预定单号：</label>
            <input type="text" name="order_num" class="form-control" placeholder="请输入预定单号" value="<?php if(isset($order_num)):?><?php echo $order_num?><?php endif;?>">
        </div>
        <div class="form-group">
            <label class="control-label">用户姓名：</label>
            <input type="text" name="user_name" class="form-control" placeholder="请输入用户姓名" value="<?php if(isset($user_name)){echo $user_name;}?>">
        </div>
        <div class="form-group">
            <label class="control-label">手机号：</label>
            <input type="text" name="user_mobile" class="form-control" placeholder="请输入手机号" value="<?php if(isset($user_mobile)){echo $user_mobile;}?>">
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
        		<th>预定单编号</th>
        		<th>商品名称</th>
        		<th>封面图</th>
        		<th>收货人</th>
        		<th>联系电话</th>
        		<th>规格</th>
        		<th>单价</th>
        		<th>数量</th>
        		<th>总价</th>
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
                <td><?php echo $v['drink_title']?></td>
                <td><img style="width:100px;height:100px;" src="<?php echo get_img_url($v['cover_img']);?>" /></td>
                <td><?php echo $v['user_name']?></td>
                <td><?php echo $v['user_mobile']?></td>
                <td><?php echo isset($special_name[$v['special_id']]) && $special_name[$v['special_id']] ? $special_name[$v['special_id']]:''?></td>
                <td><?php echo $v['unit_price']?></td>
                <td>X<?php echo $v['num']?></td>
                <td><?php echo $v['price']?></td>
                <td id="status">
        		    <?php foreach (C('order_status') as $kk => $vv):?>
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
                <a class="btn btn-primary btn-xs"  href="/drinkappoint/edit?id=<?php echo $v['id']?>">编辑</a>
                <a class="btn btn-primary btn-xs look"  data='<?php echo json_encode($list[$k]);?>'>查看</a>
                <a class="btn btn-primary btn-xs del" data="<?php echo $v['id']?>" status="<?php if($v['is_del'] == 1){echo 0;}else{echo 1;}?>" ><?php if($v['is_del'] == 1){echo '恢复';}else{echo '删除';}?></a> 
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
                <li class="disabled"><a>共<?php echo isset($count) && $count?$count:'0' ?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
 <?php $this->load->view('common/footer')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('jsdd.js', 'admin')?>'], function(a){
        	a.change();
        	a.look();
        })
    </script>
</body>
</html>
