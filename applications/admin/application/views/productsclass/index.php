<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/productsclass"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="/attribute/add_attributeclass">添加</a>
    <hr>
    <!-- search -->
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>名称</th>
                    <th>上级分类</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                <?php foreach ($lists as $k => $v):?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo $class_name[$v['parent_id']]?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/attribute/edit_attributeclass/<?php echo $v['id']?>">修改</a>
                        <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>">删除</a>
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
                <li class="disabled"><a>共<?php echo isset($count) && $count ?$count:0;?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('album.js', 'admin')?>'], function(a){
		a.del_products_class();
	})
</script>
</body>
</html>
