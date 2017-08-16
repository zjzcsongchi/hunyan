<?php $this->load->view('common/header2')?>
<ol class="breadcrumb no_print">
    <?php foreach ($title as $k => $v):?>
    <?php if($k+1 == count($title)):?>
    <li class="active"><?php echo $v['text']?></li>
    <?php else:?>
    <li><a href="<?php echo $v['url']?>"><?php echo $v['text']?></a></li>
    <?php endif;?>
    <?php endforeach;?>
</ol>
<div class="container-fluid" style="margin:10px;">

    <table class="table table-bordered table-hover">
        <tr>
            <th colspan="4" class="text-center active">
                                百年订单
            </th>
        </tr>
        <tr>
            <th class="active">客户姓名</th>
            <td><?php echo $dinner['user']['name']?></td>
            <th class="active">合同编号</th>
            <td><?php echo $dinner['contract_num']?></td>
        </tr>
        <tr>
            <th class="active">客户电话</th>
            <td><?php echo $dinner['user']['mobile_phone']?></td>
            <th class="active">宴会类型</th>
            <td><?php echo $dinner['venue_type_name']?></td>
        </tr>
        <tr>
            <th class="active">接单人</th>
            <td><?php echo $dinner['receiver']?>
            <th class="active">宴会日期</th>
            <td><?php echo $dinner['solar_time']?></td>
        </tr>
        
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎姓名</th>
            <td><?php echo $dinner['roles_main']?></td>
            <?php else:?>
            <th class="active">宴会主角</th>
            <td><?php echo $dinner['roles_main']?></td>
            <?php endif;?>
            <th class="active">农历</th>
            <td><?php echo $dinner['lunar_time']?></td>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎电话</th>
            <td><?php echo $dinner['roles_wife_mobile']?></td>
            <?php else:?>
            <th class="active">宴会电话</th>
            <td><?php echo $dinner['roles_main_mobile']?></td>
            <?php endif;?>
            <th class="active">宴会场馆</th>
            <td><?php echo $dinner['venue_name']?></td>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新娘姓名</th>
            <td><?php echo $dinner['roles_wife']?></td>
            <?php else:?>
            <th class="active">缺省值</th>
            <td></td>
            <?php endif;?>
            <th class="active">订餐信息</th>
            <td><?php echo $dinner['detail']['name']?></td>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新娘电话</th>
            <td><?php echo $dinner['roles_wife_mobile']?></td>
            <?php else:?>
            <th class="active">缺省值</th>
            <td></td>
            <?php endif;?>
            <th class="active">订餐桌数</th>
            <td><?php echo $dinner['menus_count']?></td>
        </tr>
        <tr>
            <th class="active">签订合同人</th>
            <td><?php echo $dinner['sign_contract']?></td>
            <th class="active">已交订金</th>
            <td><?php echo $dinner['deposit']?></td>
        </tr>
        <tr>
            <th class="active">签订合同人电话</th>
            <td><?php echo $dinner['sign_contract_mobile']?></td>
            <th class="active">婚庆公司</th>
            <td><?php echo $dinner['company']?></td>
        </tr>
        <tr>
            <th class="active">经办人</th>
            <td><?php echo $dinner['create_admin']?></td>
            <th class="active">代金券信息</th>
            <td><?php echo $dinner['coupon_info']?></td>
        </tr>
        <tr>
            <th class="active">微请帖信息</th>
            <td><?php echo $dinner['card_info']?></td>
            <th class="active">棋牌室信息</th>
            <td><?php echo $dinner['chess_card']?></td>
        </tr>
        <tr>
            <th class="active">米粉</th>
            <td><?php echo $dinner['rice_flour']?></td>
            <th class="active">签订合同日期</th>
            <td><?php echo $dinner['contract_date']?></td>
        </tr>
        <tr>
            <th class="active">备注</th>
            <td><?php echo $dinner['remark']?></td>
        </tr>
        
    </table>

    <form  id="form" method="post">
    <table class="table table-bordered">
            <tr>
                <th>商品id</th>
                <th>类别</th>
                <th>商品名称</th>
                <th>规格</th>
                <th>价格</th>
                <th>数量</th>
                <th>小计</th>
                <th>操作</th>
            </tr>
            <tr id="first">
                <td></td>
                <td>
                <input type="hidden" id='order_id' name="id" value="<?php echo $id?>">
                    <select id="class_id" class="form-control">
                        <option value="">选择商品类型</option>
                        <?php foreach ($drink_class as $k => $v):?>
                        <option value="<?php echo $k?>"><?php echo $v?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td>
                   <select id="goods" data="" class="form-control">
                        <option value="">选择商品</option>
                    </select>
                </td>
                <td>
                   <select id="special" class="form-control" name="special_id">
                        <option value="">选择规格</option>
                    </select>
                </td>
                <td><input type="text" id="unit_price" name="unit_price" class="form-control" readonly></td>
                <td>
                    <input type="text" id='num' name="num" value="1" class="form-control">
                </td>
                <td><input type="text" id="price" name="price" class="form-control" readonly></td>
                <td><a id="add_goods" class="btn btn-danger">添加商品</a> <a id="open_close" class="btn btn-danger" data ='0'>展开订单基本信息</a></td>
            </tr>
            <tbody id ="tbody"></tbody>
            <tr>
                <td colspan='7'></td>
            </tr>
            <tr>
                <td></td>
                <td>合计：<span id="total"></span></td>
                <td>
                                            订金:
                    <input type="text" id="bargain_money" value='0.00' name="bargain_money" class="form-control" placeholder="优惠" style="width:80%;margin-left:36px;margin-top:-24px;"/>
                    </td>
                <td>
                                            优惠:
                    <input type="text" id="free" value='0.00' name="free" class="form-control" placeholder="优惠" style="width:80%;margin-left:36px;margin-top:-24px;"/>
                </td>
                
                
                <td>需要支付:<span id="need"></span>
                <input name="need_pay" value="" type="hidden"/>
                </td>
                
               
                <td colspan="2">
                    <div class="form-group">
                                                 备注
                        <div style="margin-left:36px;margin-top:-24px;">
                            <textarea rows="2" name="remark" class="form-control"></textarea>
                        </div>
                    </div>
                </td>
            </tr>
        </table> 
    </form>
     
    <div class="col-sm-12 text-center" style="display: none">
        <a class="btn btn-primary no_print" onclick="window.print();" style="margin-bottom:5px">打印</a>
    </div>
    
    <div class="col-sm-12 text-center">
        <a id="save_3" class="btn btn-danger" >保存</a>
    </div>
        

</div>

<?php $this->load->view('common/footer')?>
<script>
    seajs.use(['<?php echo css_js_url('milan_receipt.js', 'admin')?>', '<?php echo css_js_url('adddrinkorder.js', 'admin')?>'], function(milan_receipt,a){
      milan_receipt.load();
      a.add_goods();
      a.erji();
      a.autoadd();
      a.finsh();
      a.need();
      a.del();
      a.datepick();
      a.open_close();
})
</script>
</body>
</html>
