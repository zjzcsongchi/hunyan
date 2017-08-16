<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li><a href="/customer/index"><?php echo $title[1]?></a></li>
    <li class="active"><a href="#"><?php echo $title[2]?></a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>修改客户信息</h1></legend>
        <form class="form-horizontal">
            <input type="hidden" name="id" value="<?php echo $info['id']?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">客户姓名*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" valType="required" msg="客户姓名不能为空" value="<?php echo $info['name']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">客户手机号*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="mobile_phone" valType="MOBILE" msg="手机号格式不正确" placeholder="请输入客户手机号" value="<?php echo $info['mobile_phone']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">客户住址</label>
                <div class="col-sm-4">
                    <textarea rows="3" name="address" class="form-control" placeholder="请输入客户住址"><?php echo $info['address']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">宴会类型*</label>
                <div class="col-sm-4">
                    <select class="form-control" name="dinner_type" >
                        <?php foreach ($dinner_type as $k => $v):?>
                        <option value="<?php echo $v['id']?>" <?php echo $v['id'] == $info['dinner_type'] ? 'selected' : ''?>><?php echo $v['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">宴会场馆</label>
                <div class="col-sm-4">
                    <ul class="list-inline">
                    <?php foreach($venue_list as $k => $v):?>
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" 
                                <?php if(isset($info['venue_id']) && is_array($info['venue_id'])):?>
                                <?php
                                    foreach ($info['venue_id'] as $key => $value){
                                        if($value == $v['id']){
                                            echo 'checked';
                                        }
                                    }
                                ?> 
                                <?php endif;?>
                                name="venue_id[]" value="<?php echo $v['id']?>" name="venue_id[]"/>
                                <?php echo $v['name']?>
                            </label>
                        </div>
                    </li>
                    <?php endforeach;?>
                    
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                <?php
                                    if(!is_array($info['venue_id']) && $info['venue_id'] == 0){
                                        echo 'checked';
                                    }else{
                                        foreach ($info['venue_id'] as $kk => $vv){
                                            if($vv == 0){
                                                echo 'checked';
                                            }
                                        }
                                    }
                                ?>
                                
                                  value="0" name="venue_id[]"/>
                                                                                    其他
                            </label>
                        </div>
                    </li>
                </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">预留时间*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control tdate" name="order_time" placeholder="请选择预留时间" value="<?php echo $info['order_time']?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">宴会时间*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control tdate" name="dinner_time" placeholder="请选择宴会时间" value="<?php echo $info['dinner_time']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">桌数</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="menus_count" value="<?php echo $info['menus_count']?>" placeholder="请输入宴会桌数">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">接单员</label>
                <div class="col-sm-4">
                     <input type="text" class="form-control" name="receive_admin" value="<?php echo $info['receive_admin']?>" placeholder="请输填写接单员">    
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">备注</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="remark" rows="4" placeholder="备注信息"><?php echo $info['remark']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <input type="submit" id="submit" value="保  存" class="btn btn-danger">
                </div>
            </div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script type="text/javascript">
seajs.use(['<?php echo css_js_url('customer.js', 'admin')?>', 'jqvalidate'], function(a){
	a.datepicker();
	a.modify();
})
</script>
</body>
</html>