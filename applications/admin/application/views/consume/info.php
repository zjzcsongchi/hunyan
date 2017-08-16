<?php $this->load->view('common/header2') ?>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<ol class="breadcrumb">
    <li><a href="/common" >首页</a>
    <li><a onclick="window.history.go(-1);">合同列表</a></li>
    <li class="active">消费清单</li>
</ol>
<div class="container-fluid" style="margin:10px;">
    <fieldset>
        <legend><button class="btn btn-primary" onclick="window.history.go(-1);">返 回</button> 百年婚宴消费清单 </legend>
        <table class="table table-bordered">
            <tr>
                <th class="active">场 馆:</th>
                <td><?php foreach($info['venue_ids'] as $v) echo $venue[$v].'；'; ?></td>
                <th class="active">婚宴类型:</th>
                <td><?php echo $dinner_type[$info['venue_type']] ?></td>
                <th class="active">客 户:</th>
                <td><?php echo $info['user']['name'] ?> <?php echo $info['user']['mobile_phone'] ?></td>
            </tr>
            <tr>
                <th class="active">订 金:</th>
                <td><?php echo $info['deposit'] ?></td>
                <th class="active">标准（单位：桌）:</th>
                <td><?php echo $combo[$info['detail']['menus_id']] ?></td>
                <th class="active" style="border:1px solid #ddd">保证桌数:</th>
                <td style="border:1px solid #ddd"><?php echo $info['promise_count'] ?></td>
            </tr>
            <tr>
                <th class="active">预定桌数:</th>
                <td><?php echo $info['menus_count']; ?></td>
                <th class="active">消费日期:</th>
                <td style="border:1px solid #ddd"><?php echo $info['solar_time'] ?></td>
            </tr>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="7" class="text-center">清单列表</th>
            </tr>
            <tr class="active">
                <th>名称</th>
                <th>单位</th>
                <th>数量</th>
                <th>单价</th>
                <th>金额</th>
                <th>收费情况</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="row_content">
            <?php if(empty($consume)): ?>
                <tr>
                    <td>
                        <input type="text" name="name" class="form-control" value="宴席">
                    </td>
                    <td>
                        <input type="text" name="unit" class="form-control" value="桌">
                    </td>
                    <td>
                        <input type="text" name="count" class="form-control" value="<?php echo $info['menus_count'] ?>">
                    </td>
                    <td>
                        <input type="text" name="price" class="form-control" value="<?php echo $combo[$info['detail']['menus_id']] ?>">
                    </td>
                    <td>
                        <input type="text" name="money" readonly class="form-control" value="<?php echo $info['menus_count']*$combo[$info['detail']['menus_id']]?>">
                    </td>
                    <td>
                        <input type="text" name="remark" class="form-control" >
                    </td>
                    <td>
                        <button class="btn btn-primary add_row"><span class="glyphicon glyphicon-plus"></span></button>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach($consume_list as $k => $v): ?>
                    <tr>
                        <td>
                            <input type="text" name="name" class="form-control" value="<?php echo $v['name'] ?>">
                        </td>
                        <td>
                            <input type="text" name="unit" class="form-control" value="<?php echo $v['unit'] ?>">
                        </td>
                        <td>
                            <input type="text" name="count" class="form-control" value="<?php echo $v['count'] ?>">
                        </td>
                        <td>
                            <input type="text" name="price" class="form-control" value="<?php echo $v['price'] ?>">
                        </td>
                        <td>
                            <input type="text" name="money" readonly class="form-control" value="<?php echo $v['money'] ?>">
                        </td>
                        <td>
                            <input type="text" name="remark" class="form-control" value="<?php echo $v['remark'] ?>">
                        </td>
                        <td>
                            <?php if($k == 0) :?>
                                <button class="btn btn-primary add_row "><span class="glyphicon glyphicon-plus"></span></button>
                            <?php else: ?>
                                <button class="btn btn-primary del_row "><span class="glyphicon glyphicon-remove"></span></button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            </tbody>
        </table>
        <form class="form-horizontal">
            <input type="hidden" name="dinner_id" value="<?php echo $info['id']?>" >
            <div class="form-group">
                <label class="col-sm-3 control-label">是否付款：</label>
                <div class="col-sm-6">
                    <?php foreach($consume_is_pay as $k => $v): ?>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="is_pay" <?php if(!empty($consume) && intval($consume['is_pay']) == $k) echo 'checked'; ?> value="<?php echo $k ?>" ><?php echo $v ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">结账时间：</label>
                <div class="col-sm-6">
                    <input type="date" name="checkout_time" value="<?php if(!empty($consume['checkout_time'])) echo $consume['checkout_time']; ?>" class="form-control">

                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">是否补吃：</label>
                <div class="col-sm-6">
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="is_addeat" value="0" <?php if(empty($consume) || $consume['is_addeat'] == 0) echo 'checked';  ?> >否
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="is_addeat" <?php if(!empty($consume) && $consume['is_addeat'] == 1) echo 'checked';  ?> value="1" >是
                        </label>
                    </div>
                </div>
            </div>
            <?php
                $style = isset($consume['is_addeat']) && $consume['is_addeat'] == 1 ? "style='display:block'": "style='display:none'";
            ?>
            <div class="form-group"  id="addeat_date" <?php echo $style;?>>
                <label class="col-sm-3 control-label" >补吃日期：</label>
                <div class="col-sm-6">
                    <input type="date" name="addeat_date" value="<?php echo !empty($consume) ? $consume['addeat_date'] : ''; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group" <?php echo $style;?> id="addeat_table_num">
                <label class="col-sm-3 control-label">补吃桌数：</label>
                <div class="col-sm-6">
                    <input type="text" name="addeat_table_num" value="<?php echo isset($consume['addeat_table_num']) ? $consume['addeat_table_num'] : 0; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group"  id="addeat_table_num">
                <label class="col-sm-3 control-label">预留桌数：</label>
                <div class="col-sm-6">
                    <input type="text" name="reserve_table_num" value="<?php echo !empty($consume) ? $consume['reserve_table_num'] : ''; ?>" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">按50%结算桌数：</label>
                <div class="col-sm-6">
                    <input type="text" name="is_half" value="<?php echo !empty($consume) ? $consume['is_half'] : ''; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">备注：</label>
                <div class="col-sm-6">
                    <textarea name="remark" rows="3" class="form-control"><?php echo !empty($consume) ? $consume['remark'] : ''; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">应收：</label>
                <div class="col-sm-6">
                    <input type="text" name="all_fee" value="<?php echo !empty($consume) ? $consume['all_fee'] : ''; ?>"  class="form-control" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">优惠：</label>
                <div class="col-sm-6">
                    <input type="text" name="preferentail_fee" value="<?php echo !empty($consume) ? $consume['preferentail_fee'] : ''; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">实收：</label>
                <div class="col-sm-6">
                    <input type="text" name="actual_fee" value="<?php echo !empty($consume) ? $consume['actual_fee'] : ''; ?>" class="form-control" >
                </div>
            </div>

            <div class="form-group text-center">
                <button class="btn btn-primary" id="save"><span class="glyphicon glyphicon-floppy-save"></span> 保 存</button>
            </div>
        </form>
    </fieldset>
</div>

<?php $this->load->view('common/footer') ?>
<script>
    $("[name=is_addeat][value=1]").on('click', function () {
        $("#addeat_date").css("display", "block");
        $("#addeat_table_num").css("display", "block");
        $(this).attr('checked','checked');
        $("[name=is_addeat][value=0]").removeAttr("checked");
    });
    $("[name=is_addeat][value=0]").on('click', function () {
        $("#addeat_date").css("display", "none");
        $("#addeat_table_num").css("display", "none");
        $(this).attr('checked','checked');
        $("[name=is_addeat][value=1]").removeAttr("checked");
    });
    seajs.use(['<?php echo css_js_url('consume.js', 'admin') ?>','<?php echo css_js_url('signature_pad.js', 'admin');?>'], function(consume){
        consume.add_row();
        consume.del_row();
        consume.save();
        // 原all_few 函数
        $(document).on("keyup change", "input[name!=all_fee]", function(){
            //计算单行价格
            var unit_count = $(this).parent().parent().find('input[name=count]').val();
            var unit_price = $(this).parent().parent().find('input[name=price]').val();
            $(this).parent().parent().find("[name=money]").val(unit_count*unit_price);

            var  price="<?php echo $combo[$info['detail']['menus_id']];?>";
            var is_addeat = $('input:checked[name=is_addeat]').val();
            var is_half= $('input[name=is_half]').val();
            var addeat_table_num  = $('input[name=addeat_table_num]').val();
            console.log("是否补吃："+is_addeat);
            console.log("补吃的桌数："+addeat_table_num);
            console.log("一半支付数量："+parseFloat(is_half));
            console.log(price+"元/桌");
            var all_fee = 0;
            $("#row_content tr").each(function(k,v){
                var val = $(v).find('input[name=money]').val();
                if (val) {
                    all_fee += parseFloat($(v).find('input[name=money]').val())
                }
            });
            if(is_half){
                all_fee += parseFloat(is_half)*price*0.5;
            }
            if (is_addeat == 1) {
                all_fee += parseFloat(addeat_table_num)*price;
            }
            // $("input[name=all_fee]").val(all_fee);
        });
    })
</script>
</body>
</html>