<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/xingguang">报名列表</a></li>
    <li class="active">修改报名信息</li>
</ol>

<div class="container-fluid" style="margin:10px; margin-bottom:140px;">
    <button class="btn btn-primary" onclick="window.history.go(-1)"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返 回</button>
    <hr>
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label">姓名：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="realname" value="<?php echo $info['realname']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">头像：</label>
            <div class="col-sm-8">
                <ul id="uploader_profile">
                    <?php if($info['profile']):?>
                    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                        <a class='close del-pic' href='javascript:;'></a>
                        <a href="<?php echo $info['profile_url'];?>" target="_blank"><img src="<?php echo $info['profile_url'];?>" style='width:100%;height:100%'/></a>
                        <input type="hidden" name="profile" value="<?php echo $info['profile'];?>"/>
                    </li>
                    <?php endif;?>
                    <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_profile"><span>+</span><br>添加照片</a>
	                </li>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">手机号：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="mobile_phone" value="<?php echo $info['mobile_phone']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">性别：</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" name="sex" value="0" <?php if($info['sex'] == 0) echo 'checked'?>>女
                </label>
                <label class="radio-inline">
                    <input type="radio" name="sex" value="1" <?php if($info['sex'] == 1) echo 'checked'?>>男
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">民族：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nation" value="<?php echo $info['nation']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">出生日期：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control date" name="birthday" value="<?php echo $info['birthday']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">身高：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="height" value="<?php echo $info['height']?>" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">体重：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="weight" value="<?php echo $info['weight']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">政治面貌：</label>
            <div class="col-sm-4">
                <select class="form-control" name="political_status" >
                    <?php foreach ($political_status as $k => $v):?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $info['political_status']) echo 'selected';?> ><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">婚姻状况：</label>
            <div class="col-sm-4">
                <select class="form-control" name="marry_status">
                    <?php foreach ($marry_status as $k => $v):?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $info['marry_status']) echo 'selected';?>><?php echo $v['name']?></option> 
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">籍贯：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="native_place" value="<?php echo $info['native_place']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">身份证号：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="id_number" value="<?php echo $info['id_number']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">健康状况：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="health" value="<?php echo $info['health']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">专业：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="profession" value="<?php echo $info['profession']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">学历：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="education" value="<?php echo $info['education']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">毕业院校：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="university" value="<?php echo $info['university']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">唱法：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="sing_method" value="<?php echo $info['sing_method']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">工作单位：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="work_unit" value="<?php echo $info['work_unit']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">职业：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="job" value="<?php echo $info['job']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">家庭住址：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="home_address" value="<?php echo $info['home_address']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">通讯地址：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="postal_address" value="<?php echo $info['postal_address']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">邮编：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="zipcode" value="<?php echo $info['zipcode']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">家庭成员信息：</label>
            <div class="col-sm-10">
                <?php if($info['family']):?>
                <?php foreach ($info['family'] as $k => $v):?>
                <div class="row">
                    <label class="col-sm-1 control-label">关系：</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="family_relation[]" value="<?php echo $v['relation']?>">
                    </div>
                    <label class="col-sm-1 control-label">姓名：</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="family_name[]" value="<?php echo $v['name']?>">
                    </div>
                    <label class="col-sm-1 control-label">电话：</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="family_mobile_phone[]" value="<?php echo $info['mobile_phone']?>">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-warnning del_family" type="button">删除</button>
                    </div>
                </div>
                <br>
                <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">报名节目信息：</label>
            <div class="col-sm-8">
                <?php if($info['program']):?>
                <?php $program = array_column($info['program'], 'name', 'program_type')?>
                <?php foreach ($program_name as $k => $v):?>
                <div class="row">
                    <label class="col-sm-2 control-label"><?php echo $v['name']?></label>
                    <input type="hidden" name="program_type[]" value="<?php echo $v['id']?>">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="program_name[]" value="<?php echo isset($program[$v['id']]) ? $program[$v['id']] : ''?>">
                    </div>
                </div>
                <br>
                <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">成长经历</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="growth_exprience"><?php echo $info['otherinfo']['growth_exprience']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">接触音乐的时间、地点、心里感受以及对音乐的认知</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="music_feel"><?php echo $info['otherinfo']['music_feel']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">自我介绍</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="myself_intro"><?php echo $info['otherinfo']['myself_intro']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">选手对参加节目胜出与淘汰的看法、心态</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="race_attitude"><?php echo $info['otherinfo']['race_attitude']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">曾参加活动或获奖情况</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="history_activity"><?php echo $info['otherinfo']['history_activity']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">形象自我描述</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="my_image_desc"><?php echo $info['otherinfo']['my_image_desc']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">感情表达及控制能力</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="my_feeling_express"><?php echo $info['otherinfo']['my_feeling_express']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">语言表诉能力</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="my_language_desc"><?php echo $info['otherinfo']['my_language_desc']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">才艺模仿能力</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="my_talent_desc"><?php echo $info['otherinfo']['my_talent_desc']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">游戏互动能力</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="my_game_desc"><?php echo $info['otherinfo']['my_game_desc']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">选手所处地域文化特色、民俗民风名人名事、民族特色、地方特产、著名景点、家乡方言、地方文艺剧种、地方传统文化</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="born_place_desc"><?php echo $info['otherinfo']['born_place_desc']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">选手的职业技能和职业理想</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="skill_desc"><?php echo $info['otherinfo']['skill_desc']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">参加节目最想见的人是谁</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="want_see_people"><?php echo $info['otherinfo']['want_see_people']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">选手最喜欢的音乐作品、电影、电视剧最关心的社会热点和网络流行话题</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="like_works"><?php echo $info['otherinfo']['like_works']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">选手熟悉的生活小窍门</label>
            <div class="col-sm-4">
                <textarea rows="4" class="form-control" name="know_life_tips"><?php echo $info['otherinfo']['know_life_tips']?></textarea>
            </div>
        </div>
        <div class="form-group">
        <div class="col-sm-6 text-center">
            <button class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> 保 存</button>
        </div>
        </div>
    </form>
</div>
<?php $this->load->view('common/footer')?>
<script>
	var object = [{"obj":'#uploader_profile', 'btn':'#btn_profile'}];
	seajs.use(['<?php echo css_js_url('xingguang.js', 'admin')?>', 'admin_uploader','jqvalidate','jqueryswf','swfupload'], function(a, upload){
		a.del_family();
		a.datepicker();
		upload.swfupload(object);
	})
</script>
</body>
</html>

