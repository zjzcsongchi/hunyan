<?php $this->load->view('common/header2');?>
<link href="<?php echo css_js_url('style.css', 'admin');?>" type="text/css" rel="stylesheet" />
<link href="<?php echo css_js_url('admin.css', 'admin');?>" type="text/css" rel="stylesheet" />
<ol class="breadcrumb">
  <li><a href="/common">首页</a></li>
  <li><a href="/milancombo/index">婚礼套餐</a></li>
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
              <a class="btn btn-primary" href="/milancombo/add" style="margin-left: 10px">添加 </span></a>
              <label>套餐名称：</label>
              <input type="text" class="form-control" name="name" <?php if(isset($name)):?>value="<?php echo $name?>"<?php endif;?> />
              <button class="btn btn-primary" type="submit">搜索</button>
            </div>
            <div class="form-group" style="display:none">
              <a class="btn btn-primary" href="/foods/index">显示所有</a>
            </div>
        </form>
    </div>
    <hr/>
        <?php if(isset($lists)):?>
        <?php foreach($lists as $k => $v):?>
        <?php if($k%5 == 0):?>
        <div class="row">
          <?php $i = $k; for ($i;$i<$k+5; $i++):?>
          <div class="col-sm-2">
          <?php if(isset($lists[$i])):?>
             <img width=200 height=200 src="<?php if(!empty($lists[$i]['cover_img'])): echo get_img_url($lists[$i]['cover_img']); else: echo $domain['static']['url'].'/admin/images/no_img.png'; endif; ?>" class="img-responsive"/>
            <ul class="list-inline">
              <li> <?php echo $lists[$i]['name']?></li>
              <li><?php echo $lists[$i]['price']?>元</li>
            </ul>
            <ul class="list-inline">
              <li>  <a href="/milancombo/edit?id=<?php echo $lists[$i]['id']?>">修改</a></li>
              <li>  <a class="del" href="/milancombo/del?id=<?php echo $lists[$i]['id']?>">删除</a></li>
              <li>  <a href="/milancombo/detail?id=<?php echo $lists[$i]['id']?>" class="detail">详情</a>
               <li>  <a href="/milancombo/service?id=<?php echo $lists[$i]['id']?>" class="detail">婚礼服务</a>
            </ul>
            <?php endif;?>
          </div>
          <?php endfor;?>
        </div>
        <hr/>
        <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
        <!-- 分页 -->
        <div class="row">
          <div class="pagin">
              <div class="message">共<i class="blue"><?php if(isset($count)){echo $count;}?></i>条记录，当前显示第&nbsp;<i class="blue"><?php if(isset($page)){echo $page;}?>&nbsp;</i>页</div>
              <ul class="paginList">
                  <?php if(isset($pagestr)){echo $pagestr;}?>
              </ul>
          </div>
        </div>
    </div>
</div>

<?php $this->load->view('common/footer')?>