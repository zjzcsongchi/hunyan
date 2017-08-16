<?php $this->load->view('avenueofstar/common/header');?>
    <div class="wrapper wrapper-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="padding-right: 4px;padding-left: 4px;">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>CCTV《星光大道》选手信息表</h5>
                            <div class="ibox-tools">
                                <a href="javascript:window.history.go(-1)">
                                    <i class="fa fa-mail-reply"></i> 返回
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal m-t" id="applyForm1" novalidate="novalidate" >
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">姓名：</label>
                                    <div class="col-sm-8">
                                        <input id="realname" name="realname" value="<?php echo isset($xg_userinfo['realname']) ? $xg_userinfo['realname'] : ''; ?>" class="form-control" type="text" aria-required="true" aria-invalid="true">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">性别：</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline" for="sex0">
                                        <input type="radio" checked="" value="0" id="sex0" name="sex">女</label>
                                        
                                        <label class="radio-inline" for="sex1">
                                        <input type="radio" <?php echo isset($xg_userinfo['sex']) && $xg_userinfo['sex'] == 1 ? 'checked=""' : ''; ?> value="1" id="sex1" name="sex">男</label>
          
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">照片:</label>
                                    <div class="col-sm-9" id="uploadbtn">
                                        <img class="message-avatar" style="    height: 12rem;width: 9rem;" src="<?php echo isset($xg_userinfo['profile']) ? get_img_url($xg_userinfo['profile']) : $domain['static']['url'].'/wap/images/m-user.png'; ?>" />
                                        <input type="hidden" name="profile" value="<?php echo isset($xg_userinfo['profile']) ? $xg_userinfo['profile'] : ''; ?>" />
                                    </div>
                                    <input type="file" id="uploadImg" style="display:none" name="Filedata"/>
                                </div> 

                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">民族：</label>
                                    <div class="col-sm-8">
                                        <input id="nation" name="nation" value="<?php echo isset($xg_userinfo['nation']) ? $xg_userinfo['nation'] : ''; ?>" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">生日：</label>
                                    <div class="col-sm-8">
                                        <input id="birthday" name="birthday" readonly placeholder="点击选择生日" value="<?php echo isset($xg_userinfo['birthday']) ? $xg_userinfo['birthday'] : ''; ?>" class="laydate-icon form-control layer-date" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">身高：</label>
                                    <div class="col-sm-8">
                                        <input id="height" name="height" value="<?php echo isset($xg_userinfo['height']) ? $xg_userinfo['height'] : ''; ?>" class="form-control" type="text" placeholder="请输入身高（单位：厘米）">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">体重：</label>
                                    <div class="col-sm-8">
                                        <input id="weight" name="weight" value="<?php echo isset($xg_userinfo['weight']) ? $xg_userinfo['weight'] : ''; ?>" class="form-control" type="text" placeholder="请输入体重（单位：千克）">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">政治面貌：</label>
                                    <div class="col-sm-8">
                                        <?php if($political_status):?>
                                        <?php foreach ($political_status as $k => $v):?>
                                            <label class="radio-inline" for="political_status<?php echo $k;?>">
                                            <input type="radio" <?php echo $k ==0 || (isset($xg_userinfo['political_status']) && $xg_userinfo['political_status'] == $v['id']) ? 'checked=""' : '';?> value="<?php echo $v['id'];?>" id="political_status<?php echo $k;?>" name="political_status"><?php echo $v['name'];?></label>
                                        <?php endforeach;?>
                                        <?php endif;?>

                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">婚姻状况：</label>
                                    <div class="col-sm-8">
                                        <?php if($marry_status):?>
                                        <?php foreach ($marry_status as $k => $v):?>
                                            <label class="radio-inline" for="marry_status<?php echo $k;?>">
                                            <input type="radio" <?php echo $k ==0 || (isset($xg_userinfo['marry_status']) && $xg_userinfo['marry_status'] == $v['id']) ? 'checked=""' : '';?> value="<?php echo $v['id'];?>" id="marry_status<?php echo $k;?>" name="marry_status"><?php echo $v['name'];?></label>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">籍贯：</label>
                                    <div class="col-sm-8">
                                        <input id="native_place" name="native_place" value="<?php echo isset($xg_userinfo['native_place']) ? $xg_userinfo['native_place'] : ''; ?>" class="form-control" type="text" placeholder="请输入籍贯（如：贵州省贵阳市）">
                                    </div>
                                </div>
                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">身份证号：</label>
                                    <div class="col-sm-8">
                                        <input id="id_number" name="id_number" value="<?php echo isset($xg_userinfo['id_number']) ? $xg_userinfo['id_number'] : ''; ?>" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">健康状况：</label>
                                    <div class="col-sm-8">
                                     
                                        <label class="radio-inline" for="health0">
                                        <input type="radio" checked="" value="健康" id="health0" name="health">健康</label>
                                        
                                        <label class="radio-inline" for="health1">
                                        <input type="radio" <?php echo isset($xg_userinfo['health']) && $xg_userinfo['health'] == '亚健康' ? 'checked=""' : ''; ?> value="亚健康" id="health1" name="health">亚健康</label>
                                        
                                        <label class="radio-inline" for="health2">
                                        <input type="radio" <?php echo isset($xg_userinfo['health']) && $xg_userinfo['health'] == '疾病' ? 'checked=""' : ''; ?> value="疾病" id="health2" name="health">疾病</label>
     
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">专业：</label>
                                    <div class="col-sm-8">
                                        <input id="profession" name="profession" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">学历：</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline" for="education0">
                                        <input type="radio" checked="" value="小学及以下" id="education0" name="education">小学及以下</label>
                                        
                                        <label class="radio-inline" for="education1">
                                        <input type="radio" value="初中" <?php echo isset($xg_userinfo['education']) && $xg_userinfo['education'] == '初中' ? 'checked=""' : ''; ?> id="education1" name="education">初中</label>
                                        
                                        <label class="radio-inline" for="education2">
                                        <input type="radio" value="高中" <?php echo isset($xg_userinfo['education']) && $xg_userinfo['education'] == '高中' ? 'checked=""' : ''; ?> id="education2" name="education">高中</label>
                                        
                                        <label class="radio-inline" for="education3">
                                        <input type="radio" value="本科" <?php echo isset($xg_userinfo['education']) && $xg_userinfo['education'] == '本科' ? 'checked=""' : ''; ?> id="education3" name="education">本科</label>
                                        
                                        <label class="radio-inline" for="education4">
                                        <input type="radio" value="硕士" <?php echo isset($xg_userinfo['education']) && $xg_userinfo['education'] == '硕士' ? 'checked=""' : ''; ?> id="education4" name="education">硕士</label>
                                        
                                        <label class="radio-inline" for="education5">
                                        <input type="radio" value="博士及以上" <?php echo isset($xg_userinfo['education']) && $xg_userinfo['education'] == '博士及以上' ? 'checked=""' : ''; ?> id="education5" name="education">博士及以上</label>
          
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">毕业院校：</label>
                                    <div class="col-sm-8">
                                        <input id="university" name="university" value="<?php echo isset($xg_userinfo['university']) ? $xg_userinfo['university'] : ''; ?>" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">唱法：</label>
                                    <div class="col-sm-8">
                                        <input id="sing_method" name="sing_method" value="<?php echo isset($xg_userinfo['sing_method']) ? $xg_userinfo['sing_method'] : ''; ?>" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">工作单位：</label>
                                    <div class="col-sm-8">
                                        <input id="work_unit" name="work_unit" value="<?php echo isset($xg_userinfo['work_unit']) ? $xg_userinfo['work_unit'] : ''; ?>" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">职业：</label>
                                    <div class="col-sm-8">
                                        <input id="job" name="job" value="<?php echo isset($xg_userinfo['job']) ? $xg_userinfo['job'] : ''; ?>" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">家庭住址：</label>
                                    <div class="col-sm-8">
                                        <input id="home_address" name="home_address" value="<?php echo isset($xg_userinfo['home_address']) ? $xg_userinfo['home_address'] : ''; ?>" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">邮   编：</label>
                                    <div class="col-sm-8">
                                        <input id="zipcode" name="zipcode" value="<?php echo isset($xg_userinfo['zipcode']) ? $xg_userinfo['zipcode'] : ''; ?>" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">通讯地址：</label>
                                    <div class="col-sm-8">
                                        <input id="postal_address" name="postal_address" value="<?php echo isset($xg_userinfo['postal_address']) ? $xg_userinfo['postal_address'] : ''; ?>" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">联系电话：</label>
                                    <div class="col-sm-8">
                                        <input id="mobile_phone" name="mobile_phone" value="<?php echo isset($xg_userinfo['mobile_phone']) ? $xg_userinfo['mobile_phone'] : ''; ?>" class="form-control" type="text" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="ibox-title">
                                    <h5>参选节目名称</h5>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $program_name['program_1']['name'] ?>：</label>
                                    <div class="col-sm-8">
                                        <input id="program_1" name="program[0]" value="<?php echo isset($program[0]) ? $program[0] : ''; ?>" class="form-control" type="text" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $program_name['program_2']['name']?>：</label>
                                    <div class="col-sm-8">
                                        <input id="program_2" name="program[1]" value="<?php echo isset($program[1]) ? $program[1] : ''; ?>" class="form-control" type="text" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $program_name['program_3']['name']?>：</label>
                                    <div class="col-sm-8">
                                        <input id="program_3" name="program[2]" value="<?php echo isset($program[2]) ? $program[2] : ''; ?>" class="form-control" type="text" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $program_name['program_4']['name']?>：</label>
                                    <div class="col-sm-8">
                                        <input id="program_4" name="program[3]" value="<?php echo isset($program[3]) ? $program[3] : ''; ?>" class="form-control" type="text" placeholder="" required>
                                    </div>
                                </div>
                                
                                <div class="ibox-title">
                                    <div class="col-sm-10">
                                        <h5>家庭成员</h5>
                                    </div> 
                                    <div class="col-sm-2" style="float: right;">
                                        <a href="javascript:" class="add_family_member">
                                            <i class="fa fa-plus"></i> 添加成员
                                        </a>
                                    </div>   
                                </div>
                                <div class="form-group">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>姓名</th>
                                                <th>关系</th>
                                                <th>联系电话</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody class="family_members">
                                            <?php if(isset($family) && !empty($family) ):?>
                                            <?php foreach ($family as $k=>$v):?>
                                                <tr>
                                                    <td>
                                                        <input id="program_4" name="family[<?php echo $k;?>][0]" value="<?php echo $v['name']; ?>" class="form-control" type="text" placeholder="" required>
                                                    </td>
                                                    <td>
                                                        <input id="program_4" name="family[<?php echo $k;?>][1]" value="<?php echo $v['relation']; ?>" class="form-control" type="text" placeholder="" required>
                                                    </td>
                                                    <td>
                                                        <input id="program_4" name="family[<?php echo $k;?>][2]" value="<?php echo $v['mobile_phone']; ?>" class="form-control" type="text" placeholder="" required>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:" class="remove_family_member">
                                                            <i class="fa fa-times"></i> 删除
                                                        </a>
                                                    </td>
                                                </tr> 
              
                                            <?php endforeach;?>
                                                
                                            <?php else:?>  
                                                <tr>
                                                    <td>
                                                        <input id="program_4" name="family[0][0]" class="form-control" type="text" placeholder="" required>
                                                    </td>
                                                    <td>
                                                        <input id="program_4" name="family[0][1]" class="form-control" type="text" placeholder="" required>
                                                    </td>
                                                    <td>
                                                        <input id="program_4" name="family[0][2]" class="form-control" type="text" placeholder="" required>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:" class="remove_family_member">
                                                            <i class="fa fa-times"></i> 删除
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endif?> 
                                        </tbody>
                                    </table>
                                </div>

                                 <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-3">
                                        <button class="btn btn-primary col-sm-8 " style="width: 100%;" type="submit"> 下一步 </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php $this->load->view('avenueofstar/common/footer');?>
            <!-- footer -->
            
        </div>
    </div>
    <?php $this->load->view('avenueofstar/common/jsfooter');?>
    <script type="text/javascript">
    	var loadingImg = "<?php echo $domain['static']['url'].'/wap/images/loading.png'?>";
        seajs.use([
           '<?php echo css_js_url('avenueofstar/apply.js', 'milan_mobile');?>', 
           
           'bootstrap', 
           'metisMenu', 
           'slimscroll', 
           'leftMenu', 
           'pace', 
           'validate', 
           '<?php echo css_js_url('plugins/validate/messages_zh.min.js', 'milan_mobile');?>', 
        ], function(apply){
          apply.apply1();
          apply.add_family_member();
          apply.remove_family_member();
          apply.upload_img();
         
        })
    </script>
    <!-- layerDate plugin javascript -->
    <script src="<?php echo css_js_url('plugins/layer/laydate/laydate.js', 'milan_mobile');?>"></script>
    <script>
        //外部js调用
        laydate({
            elem: '#birthday', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
            event: 'focus' //响应事件。如果没有传入event，则按照默认的click
        });
      
    </script>
    
    

</body>
</html>