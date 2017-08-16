<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li class="active">跟拍客户管理</li>
</ol>

<div class="container-fluid" style="margin:10px">
    
    
    <fieldset>
        <legend>跟拍客户列表</legend>
        <!-- search -->
        <div class="row">
            <form class="form-inline">
                <div class="form-group">
                    <label>宴会日期：</label>
                    <input type="text" name="solar_time" class="form-control Wdate" style="height: 34px;" placeholder="请选择日期" value="<?php if(isset($solar_time)){echo $solar_time;}?>">
                </div>
                
                <div class="form-group">
                    <label>姓名：</label>
                    <input type="text" name="fullname" class="form-control" placeholder="请输入新郎 / 新娘 姓名" value="<?php if(isset($fullname)){echo $fullname;}?>">
                </div>
                
                <button class="btn btn-primary" type="submit">搜索</button>
                <a href="/followcustomer" class="btn btn-primary" >重置</a>

            </form>
        </div>
        <hr>
        <!-- list -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>宴会日期</th>
                    <th>农历</th>
                    <th>宴会厅</th>
                    <th>新郎</th>
                    <th>新郎电话</th>
                    <th>新娘</th>
                    <th>新娘电话</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo ($page-1)*$pagesize+$k+1?></td>
                    <td><?php echo $v['solar_time']?></td>
                    <td><?php echo $v['lunar_time']?></td>
                    <td><?php echo isset($v['venue_name']) ? $v['venue_name'] : ''?></td>
                    <td><?php echo $v['roles_main']?></td>
                    <td><?php echo $v['roles_main_mobile']?></td>
                    <td><?php echo $v['roles_wife']?></td>
                    <td><?php echo $v['roles_wife_mobile']?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/dinner/show_detail/<?php echo $v['id']?>">查看详情</a>
                        <a class="btn btn-primary btn-xs" href="/dinner/album?dinner_id=<?php echo $v['id']?>">相册</a>
                        <?php if(!empty($v['following_effect'])):?>
                        <a class="btn btn-primary btn-xs" href="/dinner/following_effect/<?php echo $v['id']?>">跟拍效果</a>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
        <!-- page -->
        <div class="row">
            <nav style="float: right">
                <ul class="pagination">
                    <li class="disabled"><a>共<?php echo $count?>条</a></li>
                    <?php echo isset($pagestr) ? $pagestr : ''?>
                </ul>
            </nav>
        </div>
    </fieldset>
</div>

<?php $this->load->view('common/footer')?>
<script>
    seajs.use(['wdate'], function(){
      $(function(){
          $(".Wdate").focus(function(){
              WdatePicker({dateFmt:'yyyy-MM-dd'})
          });
      });
    })

</script>

</body>
</html>