<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="/page/add/<?php echo $template_id?>">添加页面</a>
    <a class="btn btn-primary" href="/page/index/<?php echo $template_id?>">刷新</a>
    <hr>
    <!-- search -->
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>模板名称</th>
                    <th>排序</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $name['name']?></td>
                    <td><?php echo $v['sort']?></td>
                    <td><?php echo $v['remark']?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/page/modify/<?php echo $v['id']?>">修改</a>
                        <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>">删除</a>
                        <a class="btn btn-primary btn-xs add express_btn" data-id="<?php echo $v['id']?>">添加元素</a>
                        <a class="btn btn-primary btn-xs" href="/page/element/<?php echo $v['id']?>">元素列表</a>
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
                <li class="disabled"><a>共<?php echo $count?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
<?php $this->load->view('common/footer')?>

<script>
	var template_id = "<?php echo $template_id?>";
	seajs.use(['<?php echo css_js_url('template.js', 'admin')?>', 'admin_uploader','jqvalidate','jqueryswf','swfupload'], function(a, swfupload){
		a.del_page();
		a.input_express();
		a.change();
	})
</script>
</body>
</html>
