<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="/music/add">添加音乐</a>
    <hr>
    <!-- search -->
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>名称</th>
                    <th>音乐</th>
                    <th style="display: none">封面图</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['name']?></td>
                    <td style="width:100px">
                        <audio src="<?php echo get_img_url($v['music']);?>"  controls="controls"/>
                            <input type="hidden" name="music" value="<?php echo $v['music'];?>"/>
                        </audio>
                    </td>
                    <td style="display: none"><img src="<?php echo get_img_url($v['cover_img'])?>" style="width:150px;"></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/music/modify/<?php echo $v['id']?>">修改</a>
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
                <li class="disabled"><a>共<?php echo $count?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('music.js', 'admin')?>'], function(a){
		a.del();
	})
</script>
</body>
</html>
