<?php $this->load->view('common/header2');?>
<link href="<?php echo css_js_url('style.css', 'admin');?>" type="text/css" rel="stylesheet" />
<link href="<?php echo css_js_url('admin.css', 'admin');?>" type="text/css" rel="stylesheet" />
<ol class="breadcrumb">
  <li><a href="/common">首页</a></li>
  <li><a href="#">菜品管理</a></li>
</ol>
<style>
.row .col-sm-2 img{border-radius:3px;box-shadow:1px 1px 2px 3px #ccc;}
.list-inline{margin:10px 0;}
</style>

<div class="rightinfo">
    <div class="container-fluid">
    <div class="row">
        <form class="form-inline">
            <div class="form-group">
              <a class="btn btn-primary" href="/dish/add" style="margin-left: 10px">添加 </span></a>
              <label>菜名：</label>
              <input type="text" class="form-control" name="name" <?php if(isset($name)):?>value="<?php echo $name?>"<?php endif;?> />
              <button class="btn btn-primary" type="submit">搜索</button>
            </div>
            <div class="form-group" style="display:none">
              <a class="btn btn-primary" href="/foods/index">显示所有</a>
            </div>
        </form>
    </div>
    <hr/>
        <?php foreach($lists as $k => $v):?>
        <?php if($k%5 == 0):?>
        <div class="row">
          <?php $i = $k; for ($i;$i<$k+5; $i++):?>
          <div class="col-sm-2">
          <?php if(isset($lists[$i])):?>
             <img style="width: 100%;" src="<?php if(!empty($lists[$i]['cover_img'])): echo get_img_url($lists[$i]['cover_img']); else: echo $domain['static']['url'].'/admin/images/no_image.gif'; endif; ?>" class="img-responsive"/>
            <ul class="list-inline">
              <li> <?php echo $lists[$i]['name']?>(id-<?php echo $lists[$i]['id']?>)</li>
              <li><?php echo $lists[$i]['price']?>元</li>
            </ul>
            <ul class="list-inline">
              <li>  <a href="/dish/edit/<?php echo $lists[$i]['id']?>">修改</a></li>
              <li>  <a class="del" href="/dish/del/<?php echo $lists[$i]['id']?>">删除</a></li>
              <li>  <a href="/dish/detail/<?php echo $lists[$i]['id']?>" class="detail">详情</a>
            </ul>
            <?php endif;?>
          </div>
          <?php endfor;?>
        </div>
        <hr/>
        <?php endif;?>
        <?php endforeach;?>
        <!-- 分页 -->
        <div class="row">
          <div class="pagin">
              <div class="message">共<i class="blue"><?php echo $data_count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
              <ul class="paginList">
                  <?php echo $pagestr;?>
              </ul>
          </div>
        </div>
    </div>
</div>

<?php $this->load->view('common/footer')?>
<script>
seajs.use(['<?php echo css_js_url('foods.js', 'admin')?>'], function(a){
    a.detail();
    a.del();
})
</script>