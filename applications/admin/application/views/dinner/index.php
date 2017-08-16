<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <a class="btn btn-primary" href="/dinner/add">添加订单客户</a>
    <hr>
    <!-- search -->
    <form class="form-inline" method="get" action="/dinner/lists">
        <div class="form-group">
            <label class="control-label">姓名：</label>
            <input type="text" name="name" class="form-control" placeholder="请输入客户姓名">
        </div>
        <div class="form-group">
            <label class="control-label">手机号：</label>
            <input type="text" name="mobile_phone" class="form-control" placeholder="请输入客户手机号">
        </div>
        <button class="btn btn-primary" type="submit">搜索</button>
    </form>
    <hr>
    
    <?php foreach ($year as $v):?>
    <fieldset>
        <legend><?php echo $v?>年</legend>
        <div class="row">
            <div class="btn-group btn-group-justified">
              <?php for($i = 1; $i <= 12; $i++):?>
              <div class="btn-group">
                <?php $month = $i<10 ? '0'.$i : $i;?>
                <?php if(isset($orders[$v.$month])):?>
                <button type="button" class="btn btn-primary" style="height: 100px" onclick="window.location.href='/dinner/lists?year=<?php echo $v?>&month=<?php echo $i?>'">
                <?php echo $i?>月<br>
                <?php  echo '本月共'.$orders[$v.$month].'单'?>
                </button>
                <?php else:?>
                <button type="button" class="btn btn-default" disabled style="height: 100px" onclick="window.location.href='/dinner/lists?year=<?php echo $v?>&month=<?php echo $i?>'">
                <?php echo $i?>月<br>暂无订单
                </button>
                <?php endif;?>
              </div>
              <?php endfor;?>
            </div>
        </div>
    </fieldset>
    <br>
    <?php endforeach;?>
</div>


</body>
</html>