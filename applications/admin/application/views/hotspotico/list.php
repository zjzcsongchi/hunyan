<?php $this->load->view('common/header2'); ?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]; ?></a></li>
    <li><?php echo $title[1]; ?></li>
</ol>

<div class="container-fluid">
    <fieldset>
        <a class="btn btn-primary" href="/hotspotico/add">添加</a>
        <hr/>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>图标地址</th>
                    <th>是否动态图标</th>
                    <th>是否默认图标</th>
                    <th>创建人</th>
                    <th>创建时间</th>
                    <th>更新人</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><img src="<?php echo get_img_url($v['url'])?>" style='width:100px;height:80px'/></td>
                    <td><?php if ($v['is_dynamic'] == 1): ?>是<?php else: ?>否<?php endif;?></td>
                    <td><?php if ($v['is_default'] == 1): ?>是<?php else: ?>否<?php endif;?></td>
                    <td><?php echo $v['create_admin']?></td>
                    <td><?php echo $v['create_time']?></td>
                    <td><?php echo $v['update_admin']?></td>
                    <td><?php echo $v['update_time']?></td>
                    <td>
                        <!--<a href="/vtourscene/scan/<?php echo $v['id']?>" target="_blank"  class="btn btn-primary btn-xs">查看</a>-->
                        <a href="/hotspotico/edit?id=<?php echo $v['id']?>" class="btn btn-primary btn-xs">修改</a>
                        <a data-id="<?php echo $v['id']?>" class="del btn btn-primary btn-xs">删除</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <!-- page -->
        <div class="row">
            <nav style="float: right">
                <ul class="pagination">
                    <li class="disabled"><a>共<?php echo $data_count?>条</a></li>
                    <?php echo !empty($pagestr) ? $pagestr : ''?>
                </ul>
            </nav>
        </div>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('hotspot.js', 'admin')?>'], function(hotspot){
		hotspot.del();
	})
</script>
</body>
</html>
