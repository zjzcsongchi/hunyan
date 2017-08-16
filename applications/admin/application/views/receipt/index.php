<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/milan"><?php echo $title[0]?></a></li>
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
                <label>职员类型：</label>
                <select class="form-control" name="group_id" >
                     <option value="">请选择职员类型</option>
                     <?php foreach (C('milan_staff_type') as $k => $v):?>
                     <option value="<?php echo $v['id']?>"   <?php echo $v['id']==$group_id?'selected':''  ?> ><?php echo $v['name']?></option>
                     <?php endforeach;?>
                </select>
            </div>
            
            <div class="form-group">
                <label>姓名：</label>
                <input type="text" name="fullname" class="form-control" placeholder="请输入职员姓名" value="<?php if(isset($fullname)){echo $fullname;}?>">
            </div>
            
            <div class="form-group">
                <label>宴会日期：</label>
                <input type="text" name="create_time" class="form-control Wdate" style="height: 34px;" placeholder="请选择日期" value="<?php if(isset($create_time)){echo $create_time;}?>">
            </div>
            
            <button class="btn btn-primary" type="submit">搜索</button>
            <a href="/receipt" class="btn btn-primary" >重置</a>
            <a href="/receipt/out_excel?<?php echo $query_data?>" class="btn btn-primary" >导出Excel</a>
        </form>
    </div>
    <hr>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>职员类型</th>
                    <th>姓名</th>
                    <th>手机号</th>
                    <th>新郎</th>
                    <th>新娘</th>
                    <th>场馆</th>
                    <th>宴会日期</th>
                    <th>开单日期</th>
                    <th>金额</th>
                    <th>确认状态</th>
                    <th>审核状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($list)):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['staff_type']?></td>
                    <td><?php echo $v['fullname']?></td>
                    <td><?php echo $v['tel']?></td>
                    <td><?php echo $menu_name[$v['menu_id']]['roles_main']?></td>
                    <td><?php echo $menu_name[$v['menu_id']]['roles_wife']?></td>
                    <td><?php echo $v['venue']?></td>
                    <td><?php echo $menu_name[$v['menu_id']]['solar_time']?></td>
                    <td><?php echo $v['create_time']?></td>
                    <td><?php echo $v['money']?></td>
                    <td><?php echo $v['status']?></td>
                    <td><?php echo $v['examination_status']?></td>

                    <td>
                    
                        <a class="btn btn-primary btn-xs btn-receipt"  data-staff="<?php echo $v['staff_type_id']?>" data-menu_id="<?php echo $v['menu_id']?>" data-is_onlyread="1">查看</a>
                        
                        <a class="btn btn-primary btn-xs btn-receipt"  data-staff="<?php echo $v['staff_type_id']?>" data-menu_id="<?php echo $v['menu_id']?>">修改</a>
                        <a class="btn btn-primary btn-xs del"  data-id="<?php echo $v['id']?>" >删除</a>

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
    seajs.use(['<?php echo css_js_url('milan_receipt.js', 'admin')?>','wdate'], function(milan_receipt){
      milan_receipt.load();
      milan_receipt.del();
      $(function(){
          $(".Wdate").focus(function(){
              WdatePicker({dateFmt:'yyyy-MM-dd'})
          });
      });
    })

</script>
</body>
</html>
