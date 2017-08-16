<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/admin/index">管理员列表</a></li>
    <li  class="active">添加管理员</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h2>添加管理员</h2></legend>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">管理员类型：</label>
                <div class="col-sm-4">
                    <select class="form-control" name="type" id="type">
                        <?php foreach ($type as $k => $v):?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">角色：</label>
                <div class="col-sm-4 ">
                    <select class="form-control" name="group_id">
                        <?php foreach($admin_group as $key=>$val){ ?>
                        <option data-role_type='<?php echo $val['role_type'];?>' value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group" id="venue" style="display:none">
                <label class="col-sm-2 control-label">所属场馆：</label>
                <div class="col-sm-4">
                    <select class="form-control" name="venue_id">
                        <option value="">请选择场馆</option>
                        <?php foreach ($venue as $k => $v):?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                        <?php endforeach;?>
                    </select>
                    <i>场馆管理员才选择场馆</i>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">登录名：</label>
                <div class="col-sm-4 has-feedback" title="必填项">
                    <input name="name" type="text" class="form-control" id="name" valType="required" msg="登录名不能为空"/>
                    <span class="form-control-feedback glyphicon glyphicon-info-sign"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">密码：</label>
                <div class="col-sm-4 has-feedback" title="必填项">
                    <input name="password" type="password" class="form-control" id="password" valType="required" msg="密码不能为空"/>
                    <span class="form-control-feedback glyphicon glyphicon-info-sign"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">重复密码：</label>
                <div class="col-sm-4 has-feedback" title="必填项">
                    <input name="confirpassword" type="password" class="form-control" id="confirpassword"  valType="required" msg="重复密码不能为空"/>
                    <span class="form-control-feedback glyphicon glyphicon-info-sign"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">姓名：</label>
                <div class="col-sm-4 has-feedback" title="必填项">
                    <input name="fullname" type="text" class="form-control" id="fullname"  valType="required" msg="姓名不能为空"/>
                    <span class="form-control-feedback glyphicon glyphicon-info-sign"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">手机：</label>
                <div class="col-sm-4 has-feedback" title="必填项">
                    <input name="tel" type="text" class="form-control" id="tel"  valType="required" msg="手机号不能为空"/>
                    <span class="form-control-feedback glyphicon glyphicon-info-sign"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">生日：</label>
                <div class="col-sm-4 has-feedback" title="必填项">
                    <input name="birthday" type="text" class="form-control date" id="birthday" />
                    <span class="form-control-feedback glyphicon glyphicon-info-sign"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email：</label>
                <div class="col-sm-4 " >
                    <input name="email" type="text" class="form-control" id="email" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">描述：</label>
                <div class="col-sm-4" >
                    <input name="describe" type="text" class="form-control" id="describe" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">状态：</label>
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input type="radio" value="1" name="disabled" checked>正常 &nbsp;&nbsp;
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="2" name="disabled">禁用
                    </label>
                </div>
            </div>
            <div class="col-sm-6 text-center">
                <input name="" type="submit" class="btn btn-primary" value="添  加"/>
            </div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('admin_new.js', 'admin')?>', 'jqvalidate'], function(a){
		a.load();
		a.datepicker();
	})
</script>
</body>
</html>