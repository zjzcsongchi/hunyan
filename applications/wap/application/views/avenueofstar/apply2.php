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
                            <form class="form-horizontal m-t" id="applyForm2" novalidate="novalidate" >
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    成长经历（情感故事）（成长中最感动、最难忘的人和事）
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="growth_exprience" name="growth_exprience"   rows=6 class="form-control"  placeholder="成长经历（情感故事）（成长中最感动、最难忘的人和事）"><?php echo isset($xg_otherinfo['growth_exprience']) ? $xg_otherinfo['growth_exprience'] : ''; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    接触音乐的时间、地点、心里感受以及对音乐的认知(包括对音乐的感情、态度、情怀、以及抱有的梦想）
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="music_feel" name="music_feel" rows=6 class="form-control" placeholder="接触音乐的时间、地点、心里感受以及对音乐的认知(包括对音乐的感情、态度、情怀、以及抱有的梦想） "><?php echo isset($xg_otherinfo['music_feel']) ? $xg_otherinfo['music_feel'] : ''; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    自我介绍（兴趣、爱  好、特长等）
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="myself_intro" name="myself_intro"  rows=6 class="form-control" placeholder=" 自我介绍（兴趣、爱  好、特长等） "><?php echo isset($xg_otherinfo['myself_intro']) ? $xg_otherinfo['myself_intro'] : ''; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    选手对参加节目胜出与淘汰的看法、心态
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="race_attitude" name="race_attitude" rows=6 class="form-control" placeholder=" 选手对参加节目胜出与淘汰的看法、心态"><?php echo isset($xg_otherinfo['race_attitude']) ? $xg_otherinfo['race_attitude'] : ''; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    曾参加活动或获奖情况（如没有添无）
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="history_activity" name="history_activity" rows=6 class="form-control" placeholder="曾参加活动或获奖情况（如没有添无） "><?php echo isset($xg_otherinfo['history_activity']) ? $xg_otherinfo['history_activity'] : ''; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="ibox-title">
                                    <h5>选手各方面能力自我简述（每栏一句话）</h5>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">形象自我描述：</label>
                                    <div class="col-sm-8">
                                        <input id="my_image_desc" name="my_image_desc" value="<?php echo isset($xg_otherinfo['my_image_desc']) ? $xg_otherinfo['my_image_desc'] : ''; ?>" class="form-control" type="text" placeholder="形象自我描述">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">感情表达及控制能力：</label>
                                    <div class="col-sm-8">
                                        <input id="my_feeling_express" name="my_feeling_express" value="<?php echo isset($xg_otherinfo['my_feeling_express']) ? $xg_otherinfo['my_feeling_express'] : ''; ?>" class="form-control" type="text" placeholder="感情表达及控制能力">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">语言表诉能力：</label>
                                    <div class="col-sm-8">
                                        <input id="my_language_desc" name="my_language_desc"  value="<?php echo isset($xg_otherinfo['my_language_desc']) ? $xg_otherinfo['my_language_desc'] : ''; ?>" class="form-control" type="text" placeholder="语言表诉能力">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">才艺模仿能力：</label>
                                    <div class="col-sm-8">
                                        <input id="my_talent_desc" name="my_talent_desc" value="<?php echo isset($xg_otherinfo['my_talent_desc']) ? $xg_otherinfo['my_talent_desc'] : ''; ?>" class="form-control" type="text" placeholder="才艺模仿能力">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">游戏互动能力：</label>
                                    <div class="col-sm-8">
                                        <input id="my_game_desc" name="my_game_desc" value="<?php echo isset($xg_otherinfo['my_game_desc']) ? $xg_otherinfo['my_game_desc'] : ''; ?>" class="form-control" type="text" placeholder="游戏互动能力">
                                    </div>
                                </div>
                                
                                <div class="ibox-title"></div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    选手所处地域文化特色、民俗民风名人名事、民族特色、地方特产、著名景点、家乡方言、地方文艺剧种、地方传统文化
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="born_place_desc" name="born_place_desc" rows=6 class="form-control" placeholder="选手所处地域文化特色、民俗民风名人名事、民族特色、地方特产、著名景点、家乡方言、地方文艺剧种、地方传统文化"><?php echo isset($xg_otherinfo['born_place_desc']) ? $xg_otherinfo['born_place_desc'] : ''; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    选手的职业技能和职业理想
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="skill_desc" name="skill_desc"  rows=6 class="form-control" placeholder="选手的职业技能和职业理想" ><?php echo isset($xg_otherinfo['skill_desc']) ? $xg_otherinfo['skill_desc'] : ''; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    参加节目最想见的人是谁
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="want_see_people" name="want_see_people" value="<?php echo isset($xg_otherinfo['want_see_people']) ? $xg_otherinfo['want_see_people'] : ''; ?>" class="form-control" type="text" placeholder="参加节目最想见的人是谁">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    选手最喜欢的音乐作品、电影、电视剧最关心的社会热点和网络流行话题（正面、积极）
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="like_works" name="like_works" rows=6 class="form-control" placeholder="选手最喜欢的音乐作品、电影、电视剧最关心的社会热点和网络流行话题（正面、积极）"><?php echo isset($xg_otherinfo['like_works']) ? $xg_otherinfo['like_works'] : ''; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                                                                                    选手熟悉的生活小窍门（各种各样）
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="history_activity" name="history_activity" rows=6 class="form-control" placeholder="选手熟悉的生活小窍门（各种各样）"><?php echo isset($xg_otherinfo['history_activity']) ? $xg_otherinfo['history_activity'] : ''; ?></textarea>
                                    </div>
                                </div>
                                
                                
                                
                                

                                 
                                 <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-3">
                                        <button class="btn btn-primary" style="width: 100%;"  type="submit">完成</button>
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
    	var object = [
		      {"obj": "#uploader_profile", "btn": "#btn_profile"},
        ];
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
          apply.apply2();

        })
    </script>

    
    

</body>
</html>