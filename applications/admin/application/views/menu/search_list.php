<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>新郎</th>
                    <th>新郎电话</th>
                    <th>新娘</th>
                    <th>新娘电话</th>
                    <th>预约时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($list) && $list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['roles_main']?></td>
                    <td><?php echo $v['roles_main_mobile']?></td>
                    <td><?php echo $v['roles_wife']?></td>
                    <td><?php echo $v['roles_wife_mobile']?></td>
                    <td><?php echo $v['solar_time']?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/menu/dinner_detail/<?php echo $v['id']?>">详情</a>
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
                <li class="disabled"><a>共<?php echo $data_count?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('customer.js', 'admin')?>'], function(a){
	a.del();
		})
</script>
</body>
</html>
