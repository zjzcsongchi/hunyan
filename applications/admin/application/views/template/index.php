<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="/template/add">添加模板</a>
    <a class="btn btn-primary" href="/template">刷新</a>
    <hr>
    <!-- search -->
    <div class="row">
        <form class="form-inline" method="post">
            <div class="form-group">
                <label>模板名称：</label>
                <input type="text" name="name" class="form-control" placeholder="请输入模板名称" value="<?php if(isset($name)):?><?php echo $name?><?php endif;?>">
            </div>
            <div class="form-group">
                <label>类型：</label>
                <select class="form-control" name="type_id">
                     <option value="-1">请选择类型</option>
                     <option value="0" <?php if(isset($type_id) && $type_id == 0):?>selected="selected" <?php endif;?>>电子相册</option>
                     <option value="1" <?php if(isset($type_id) && $type_id == 1):?>selected="selected" <?php endif;?>>微请帖</option>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">搜索</button>
        </form>
    </div>
    <hr>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>名称</th>
                    <th>音乐名称</th>
                    <th>音乐</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo $music_name[$v['music_id']]?></td>
                    <td style="width:100px">
                    <?php if(isset($music[$v['music_id']]) && $music[$v['music_id']]):?>
                        <audio src="<?php echo get_img_url($music[$v['music_id']]);?>"  controls="controls"/>
                            <input type="hidden" name="music" value="<?php echo $info['music'];?>"/>
                        </audio>
                        <?php endif;?>
                    </td>
                    <td><?php echo $v['remark']?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/template/modify/<?php echo $v['id']?>">修改</a>
                        <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>">删除</a>
                        <a class="btn btn-primary btn-xs" href="/page/index/<?php echo $v['id']?>">页面</a>
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
	seajs.use(['<?php echo css_js_url('template.js', 'admin')?>'], function(a){
		a.del();
	})
</script>
</body>
</html>
