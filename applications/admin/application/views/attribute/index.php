<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href=/attribute><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="/attribute/add">添加</a>
    <hr>
    <!-- search -->
    <form class="form-inline" method="get" action="/attribute">
        <div class="form-group">
            <label>商品类型：</label>
            <select name="class_id" class="form-control">
                <option value="">请选择商品类型</option>
                <?php foreach ($attribute_type as $k=>$v):?>
                <option value="<?php echo $v['id']?>" <?php if(isset($class_id) && $class_id == $v['id']):?>selected<?php endif;?>><?php echo $v['name']?></option>
                <?php endforeach;?>
            </select>
        </div>
        
        <div class="form-group">
            <label>商品名称：</label>
            <input type="text" name="search_title" class="form-control" placeholder="请输入商品名称" value="<?php if(isset($search_title)):?><?php echo $search_title?> <?php endif;?>">
        </div>
            
        <div class="form-group">
            <label>上架：</label>
            <select name="is_show" class="form-control">
                <option value="2">请选择状态</option>
                <option value="0" <?php if(isset($is_show) && $is_show == 0):?>selected<?php endif;?>>上架</option>
                <option value="1" <?php if(isset($is_show) && $is_show == 1):?>selected<?php endif;?>>下架</option>
            </select>
        </div>
        <div class="form-group">
            <label>状态：</label>
            <select name="is_del" class="form-control">
                <option value="0" <?php if(isset($is_del) && $is_del == 0):?>selected<?php endif;?>>未删除</option>
                <option value="1" <?php if(isset($is_del) && $is_del == 1):?>selected<?php endif;?>>已删除</option>
            </select>
        </div>
        
        <button class="btn btn-primary" type="submit">搜索</button>
    </form>
    <hr>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>商品名称</th>
                    <th>原价</th>
                    <th>现价</th>
                    <th>单位</th>
                    <th>状态</th>
                    <th>封面图</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['title']?></td>
                    <td><?php echo $v['original_price']?></td>
                    <td><?php echo $v['present_price']?></td>
                    <td><?php echo $v['unit']?></td>
                    <td><?php if($v['is_show'] == 1):?>下架<?php else:?>上架<?php endif;?></td>
                    <td><img src="<?php echo get_img_url($v['cover_img'])?>" style="width200px;height:100px"></td>
                    <td style="width:20%">
                        <a class="btn btn-primary btn-xs" href="/attribute/info/<?php echo $v['id']?>">详情</a>
                        <a class="btn btn-primary btn-xs" href="/attribute/modify/<?php echo $v['id']?>/1">属性</a>
                        <a class="btn btn-primary btn-xs" href="/attribute/modify/<?php echo $v['id']?>/2">规格</a>
                        <a class="btn btn-primary btn-xs" href="/attribute/modify/<?php echo $v['id']?>/3">相册</a>
                        <a class="btn btn-primary btn-xs" href="/attribute/modify/<?php echo $v['id']?>">修改</a>
                        <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>" data-status="<?php if($v['is_del'] == 1){echo 0;}else{echo 1;}?>"><?php if($v['is_del'] == 1){echo '恢复';}else{echo '删除';}?></a>
                        <a class="btn btn-primary btn-xs" href="/attribute/show/<?php echo $v['id']?>"> <?php if($v['is_show'] == 0):?>下架<?php else:?>上架<?php endif;?></a>
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
	seajs.use(['<?php echo css_js_url('album.js', 'admin')?>'], function(a){
		a.del();
	})
</script>
</body>
</html>
