<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><a href="/venue/index/<?php echo $venue_id;?>"><?php echo $title[1]?></a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- search -->
    <div class="row">
        <span type="submit"><a class="btn btn-primary" href="/venue/add_venue_album?venue_id=<?php echo $venue_id;?>">添加相册</a></span>
    </div>
    <hr>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>相册id</th>
                    <th>名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($list)):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['title']?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/venue/album_detail?id=<?php echo $v['id']?>&venue_id=<?php echo $v['venue_id']?>">管理</a>
                        <a class="btn btn-primary btn-xs del" href="/venue/del_album?id=<?php echo $v['id']?>">删除</a>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
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
