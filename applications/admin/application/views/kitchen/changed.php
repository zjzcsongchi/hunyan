<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/home"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>
<style>
.table td.vetically {vertical-align: middle;text-align: center;}
</style>
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
                    <th>宴会主角</th>
                    <th>宴会场馆</th>
                    <th>宴会日期</th>
                    <th>变更情况</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($list) && !empty($list)) {
                    foreach($list as $k => $v) {
                        foreach ($v as $k1 => $v1) { # 每一个订单的信息
                            if (!empty($change_record_list[$v1['id']])) {
                                echo "<tr>";
                                echo "<td>{$v1['roles_main']}</td>";
                                echo "<td>{$v1['venue_name']}</td>";
                                echo "<td>{$v1['solar_time']}</td>";
                                echo "<td width='50%'>";
                                $a_dinner_change_count = 0;
                                foreach ($change_record_list[$v1['id']] as $k2 => $v2) { # 每一个订单的变更信息
                                    if (!empty($v2)) {
                                        echo "【" . $key_to_text[$k2] . "】";
                                        if (empty($v2[0]['old_value'])) {
                                            $v2[0]['old_value'] = "无";
                                        }
                                        $nbsp_len = (mb_strlen($key_to_text[$k2])+2)*3;
                                        $span_style = "style='color:red;font-weight:bold;";
                                        echo  "<br/><span>".str_repeat("&nbsp;", $nbsp_len) . "<span {$span_style}'>---></span>" . $v2[0]['old_value'] . "</span>";
                                        $change_count = count($v2);
                                        $a_dinner_change_count += $change_count;
                                        foreach ($v2 as $k3 => $v3) {
                                            if (empty($v3['new_value'])) {
                                                $v3['new_value'] = "无";
                                            }
                                            echo    "<br/><span {$span_style}'>".str_repeat("&nbsp;", $nbsp_len) ."---></span>";
                                            if ($change_count-1 == $k3) {
                                                echo "<span style='color:blue;'>" . $v3['new_value'] . "(" . $v3['create_user'] . ")<br/><br/></span>";
                                            } else {
                                                echo $v3['new_value'] . "(" . $v3['create_user'] . ")";
                                            }
                                        }
                                    }
                                }
                                if ($v1['confirm_change'] != 1) {
                                    $confirm_change = "<span class='btn btn-primary btn-xs del confirm_change'  data-id='{$v1['id']}' data-all_change_count='{$a_dinner_change_count}'>确认变更</span>";
                                }
                                echo "<td><a class='btn btn-primary btn-xs del'  href='/kitchen/detail/{$v1['id']}' >查看详情</a> {$confirm_change}</td>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                }
            ?>
            </tbody>
        </table>
    </div>

    <!-- page -->
    <div class="row">
        <nav style="float: right">
            <ul class="pagination">
                <li class="disabled" data-total="<?php if(isset($count)){echo $count;}else{echo 0;}?>"><a>共<?php if(isset($count)){echo $count;}else{echo 0;}?>条</a></li>
            </ul>
        </nav>
    </div>
</div>
<?php $this->load->view('common/footer')?>
<script src='<?php echo css_js_url("jquery.min.js", "admin");?>'></script>
<script>
    leftWindow = $(window.parent.document)[0].all[7];
    //console.log($($($($(leftWindow)[0].contentDocument).find("dl").children()[6])).find("i"));
    $('.confirm_change').on("click",function (){
       var dinner_id = $(this).attr("data-id");
       var that = this;
        $.post("/kitchen/confirm_change",{dinner_id:dinner_id},function (data) {
            data =$.parseJSON(data);
            if (data.code == 1) {
                $(that).parent().parent().fadeOut('200');
                var total = $('nav li').attr('data-total');
                var a_dinner_change_count = $(that).attr('data-all_change_count');
                //total = total - a_dinner_change_count;
                total--;
                $('nav li').attr('data-total', total);
                $($($($($(leftWindow)[0].contentDocument).find("dl").children()[6])).find("i")[2]).html(total);
                $($($($($(leftWindow)[0].contentDocument).find("dl").children()[6])).find("i")[0]).html(total);
                $('nav li a').text("共" + total + "条")
            }else {
                alert(data.msg);
            }
        });
    });
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
