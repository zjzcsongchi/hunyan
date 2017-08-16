<?php $this->load->view('common/header2')?>
<style>
<!--
.fixed {
	width: 450px;
}
-->
</style>

<ol class="breadcrumb">
    <li><a href="/home"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">

    <!-- search -->
    <div class="row">
        <form class="form-inline">
            <div class="form-group">
                <label>场馆：</label>
                <select class="form-control" name="venue_id" >
                     <option value="">请选择场馆</option>
                     <?php foreach ($venue as $k => $v):?>
                     <option value="<?php echo $k?>"   <?php echo $k==$venue_id?'selected':''  ?> ><?php echo $v?></option>
                     <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label>是否已打印：</label>
                <select class="form-control" name="is_print" >
                    <option value="2">请选择</option>
                    <option value="0" <?php if (isset($_GET['is_print']) &&  $_GET['is_print']  == 0){echo "selected";} ?>>未打印</option>
                    <option value="1" <?php if (isset($_GET['is_print']) &&  $_GET['is_print']  == 1){echo "selected";} ?>>已打印</option>
                </select>
            </div>

            <div class="form-group">
                <label>宴会日期：</label>
                <input type="text" name="create_time" class="form-control Wdate" style="height: 34px;" placeholder="请选择日期" value="<?php if(isset($create_time)){echo $create_time;}?>">
            </div>
            
            <button class="btn btn-primary" type="submit">搜索</button>
            <a href="/kitchen/today" class="btn btn-primary" >重置</a>
            
        </form>
    </div>
    <hr>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>

                    <th>宴会日期</th>
                    
                    <th>星期</th>
                    <th>宴会场馆</th>
                    <th>餐标</th>
                    <th>预定桌数</th>
                    <th>保证桌数</th>
                    <th>宴席类型</th>
                    <th>宴席主角</th>
                    <th>新娘</th>
                    <th>
                        是否打印
                    </th>
                    <th class="fixed">备注</th>
                    
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($list)):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['solar_time']?></td>
                    
                    <td><?php echo $v['week']?></td>
                    <td><?php echo $v['venue_name']?></td>
                    <td><?php echo $v['menus_name']?></td>
                    <td><?php echo $v['menus_count']?></td>
                    <td><?php echo $v['promise_count']?></td>
                    <td><?php echo $party_type[$v['venue_type']]?></td>
                    <td><?php echo $v['roles_main']?></td>
                    <td><?php echo $v['roles_wife']?></td>
                    <td>
                    <?php if($v['is_print']):?>
                       <span style="color: green">已打印</span>
                        <?php else:?>
                        <span style="color: red;"> 未打印</span>
                        <?php endif;?>
                    </td>
                    <td class="fixed"><?php echo $v['remark']?></td>


                    <td>
                    
                        <a class="btn btn-primary btn-xs del"  href="/kitchen/detail/<?php echo $v['id']?>?order_type=<?php echo $order_type ?>" >查看详情</a>

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
                <li class="disabled"><a>共<?php if(isset($count)){echo $count;}else{echo 0;}?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
<?php $this->load->view('common/footer')?>
<script>
    seajs.use(['wdate'], function(){

      $(function(){
          $(".Wdate").focus(function(){
              WdatePicker({dateFmt:'yyyy-MM'})
          });
      });
    })

</script>
</body>
</html>
