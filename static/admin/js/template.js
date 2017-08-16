/**
 * 客户管理js
 */
define(function(require, exports, module){
	require('dialog');
	var swfUploader = require('admin_uploader');
	module.exports={
			//保存
			save:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					
					var data = $('form').serialize();
					
					$.post('/template/add', data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/template/index";
									return false;
								}
							},
							okValue:"确定"
						});
						d.width(320);
						d.showModal();
					})
				})
			},
			//修改
			modify:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					var data = $('form').serialize();
					
					$.post('/template/modify/'+id, data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/template/index";
								}
								return false;
							},
							okValue:"确定"
						});
						d.width(320);
						d.showModal();
					})
				})
			},
			//删除
			del:function(){
				$('.del').click(function(){
					var id = $(this).attr('data-id');
					var d = dialog({
						title:'提示',
						content:"确认删除？",
						cancelValue:'取消',
						cancel:true,
						okValue:'确定',
						ok:function(){
							var obj = this;
							$.post('/template/del', {id:id}, function(data){
								if(data.status != 0){
									obj.content = data.msg;
								}else{
									window.location.reload();
								}
							})
							return false;
						}
					})
					d.width(320);
					d.showModal();
				})
			},
			
			save_page:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					var data = $('form').serialize();
					$.post('/page/add/'+template_id, data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.reload();
									return false;
								}
							},
							okValue:"确定"
						});
						d.width(320);
						d.showModal();
					})
				})
			},
			
			//修改
			modify_page:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					var data = $('form').serialize();
					
					$.post('/page/modify/'+id, data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.reload();
								}
								return false;
							},
							okValue:"确定"
						});
						d.width(320);
						d.showModal();
					})
				})
			},
			
			//删除
			del_page:function(){
				$('.del').click(function(){
					var id = $(this).attr('data-id');
					var d = dialog({
						title:'提示',
						content:"确认删除？",
						cancelValue:'取消',
						cancel:true,
						okValue:'确定',
						ok:function(){
							var obj = this;
							$.post('/page/del', {id:id}, function(data){
								if(data.status != 0){
									obj.content = data.msg;
								}else{
									window.location.reload();
								}
							})
							return false;
						}
					})
					d.width(320);
					d.showModal();
				})
			},
			
			
			select_music:function(){
				$(".select_music").click(function(){
					$.post('/template/get_music',{}, function(data){
						if(data.list){
							html = '<div style="overflow-y:auto;overflow-x: hidden;height:300px;">';
							$.each(data.list,function(k,v){
								html += '<div class="form-group" style=" margin-bottom:60px;width:100%;height:auto;overflow: hidden;"><label class="col-sm-3 control-label">'+v.name+'</label>';
								html += '<div class="col-sm-8">';
								html += '<audio src="'+v.music+'"  controls="controls"/>';
								html += '<input type="hidden"  value="'+v.id+'"/>';
	                            html += '</audio>';
	                            html += '<a class="btn btn-primary btn-xs selectmusic"  style="float:right; margin-left:0px;" data-id="'+v.id+'" data-music-name="'+v.name+'">选择</a></div></div>';
							})
							html += '</div>'; 
							
						}else{
							html = '暂无列表';
						}
						var d = dialog({
				    	    title: '音乐列表',
				    	    width: 600,
				    	    content: html,
				    	    ok:true
				    	});
				        d.show();
					})
			    	
				})
			},
			
			selectmusic:function(){
				$("body").on('click','.selectmusic',function(){
					var music_name = $(this).attr("data-music-name");
					var music_id = $(this).attr("data-id");
					var html = '<input type="hidden" value="'+music_id+'" name="music_id">'
					$("#hiden_music_id").html(html);
					$("#music_name").val(music_name);
					$(".ui-dialog").parent("div").remove();
				})
			},
			
			
			//添加元素
			input_express:function(){
				$('.express_btn').click(function(){
					var page_id = $(this).attr("data-id");
					
					var object1 = [
						              {"obj": "#uploader_image", "btn": "#btn_image"}
						              ];
					
					var content = '<form class="form-horizontal">'
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">类型:</label>'
						+ '<div class=" col-sm-5">'
						+ '<select name="element_type" class="form-control delivery_type">'
						+ '<option value="0">图片</option>'
						+ '<option value="1">文字</option>'
						+ '</select>'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">排序:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" value="0" name="sort" placeholder="序号">'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group" id="word" style="display:none">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">内容:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" name="default" placeholder="请输入内容">'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group" id="flag" style="display:none;">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">标记:</label>'
						+ '<div class=" col-sm-5">'
						+ '<select name="flag" class="form-control ">'
						+ '<option value="0">常规元素</option>'
						+ '<option value="1">新郎</option>'
						+ '<option value="2">新娘</option>'
						+ '<option value="3">婚礼时间</option>'
						+ '</select>'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">备注:</label>'
						+ '<div class=" col-sm-8">'
						+ '<textarea rows="3" name="remark" class="form-control"></textarea>'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group" id="image">'
						+ '<label class="col-sm-4 control-label" style="margin-left:-20px">图片:</label>'
						+ '<div class="col-sm-8">'
						+ '<ul id="uploader_image">'
						+ '<li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">'
		    			+ '<a href="javascript:;" class="up-img"  id="btn_image"><span>+</span><br>添加图片</a>'
		    			+ '</li></ul></div></div>'
		    				
		    	                
						+ '<input type="hidden" name="page_id" value='+page_id+'>'
						
						+ '</form>';
					
					var d = dialog({
							title:'填写元素信息',
							content:content,
							okValue:'确定',
							cancelValue:'取消',
							ok:function(){
								var post_data = $('form').serialize();
								var dialog_param = {
										title:'提示',
										okValue:'确定',
										cancelValue:'取消',
										ok:function(){},
										cancel:'',
										width:320
								};
								var d1 = dialog(dialog_param);
								
								var sort = $("input[name='sort']").val();
								if(sort == ''){
									d1.content('排序不能为空');
									d1.showModal();
									return false;
								}
								$.post('/page/index/'+template_id, post_data, function(data){
									if(data.status != 0){
										d1.content(data.msg);
									}else{
										var d = dialog({
											title:'提示',
											content:'添加成功',
											ok:function(){
												
											},
											okValue:"确定"
										})
										d.width(320);
										d.showModal();
									}
								})
							},
							cancel:function(){}
					});
					d.width(600)
					d.height(600)
					d.showModal()
					
					swfUploader.swfupload(object1);
				})
			},
			
			
			//修改元素
			edit_element:function(){
				$('.element').click(function(){
					var element_id = $(this).attr("data-id");
					var flag = $(this).attr("data-flag");
					var element_type = $(this).parent().parent("tr").find(".element_type").attr("data-id");
					var sort = $(this).parent().parent("tr").find(".sort").attr("data-id");
					var content = $(this).parent().parent("tr").find(".default").attr("data-image");
					var full_img = $(this).parent().parent("tr").find(".default").attr("data-id");
					var remark = $(this).parent().parent("tr").find(".remark").attr("data-id");
					var object1 = [
						              {"obj": "#uploader_image", "btn": "#btn_image"}
						              ];
					
					if(element_type == 0){
						
						var select = '<option value="0" selected = "selected">图片</option><option value="1">文字</option>';
						
						var img =  '<div class="form-group" id="image">'
							+ '<label class="col-sm-4 control-label" style="margin-left:-20px">图片:</label>'
							+ '<div class="col-sm-8">'
							+ '<ul id="uploader_image">'
							
							
							+ '<li class="pic pro_gre" style="margin-right: 20px; clear:none;">'
                            + '<a class="close del-pic" href="javascript:;"></a>'
                            + '<img src="'+full_img+'" style="width:100%;height:100%"/>'
                            + '<input type="hidden" name="image" value="'+content+'"/></li>'
                            
                        
							
							+ '<li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">'
			    			+ '<a href="javascript:;" class="up-img"  id="btn_image"><span>+</span><br>添加图片</a>'
			    			+ '</li></ul></div></div>';
						
						var default_content=  '<div class="form-group" id="word" style="display:none">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">内容:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" value="'+content+'" name="default" id= "default" placeholder="请输入内容">'
						+ '</div>'
						+ '</div>'
					}
					if(element_type == 1){
						var img = '<div class="form-group" id="image" style="display:none">'
						+ '<label class="col-sm-4 control-label" style="margin-left:-20px">图片:</label>'
						+ '<div class="col-sm-8">'
						+ '<ul id="uploader_image">'
						+ '<li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">'
		    			+ '<a href="javascript:;" class="up-img"  id="btn_image"><span>+</span><br>添加图片</a>'
		    			+ '</li></ul></div></div>'
						var select = '<option value="0">图片</option><option value="1" selected = "selected">文字</option>';
						
						var default_content=  '<div class="form-group" id="word">'
							+ '<label class="control-label col-sm-4" style="margin-left:-20px">内容:</label>'
							+ '<div class=" col-sm-8">'
							+ '<input type="text" class="form-control" value="'+content+'" name="default" id= "default" placeholder="请输入内容">'
							+ '</div>'
							+ '</div>'
					}
					
					if(flag == 0){
						var default_flag = '<option value="0" selected="selected">常规元素</option>'
						+ '<option value="1">新郎</option>'
						+ '<option value="2">新娘</option>'
						+ '<option value="3">婚礼时间</option>';
					}
					if(flag == 1){
						var default_flag = '<option value="0" >常规元素</option>'
						+ '<option value="1" selected="selected">新郎</option>'
						+ '<option value="2">新娘</option>'
						+ '<option value="3">婚礼时间</option>';
					}
					if(flag == 2){
						var default_flag = '<option value="0" selected="selected">常规元素</option>'
						+ '<option value="1">新郎</option>'
						+ '<option value="2" selected="selected">新娘</option>'
						+ '<option value="3">婚礼时间</option>';
					}
					
					if(flag == 3){
						var default_flag = '<option value="0" selected="selected">常规元素</option>'
						+ '<option value="1">新郎</option>'
						+ '<option value="2">新娘</option>'
						+ '<option value="3"  selected="selected">婚礼时间</option>';
					}
						
					var content = '<form class="form-horizontal">'
						
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">类型:</label>'
						+ '<div class=" col-sm-5">'
						+ '<select name="element_type" class="form-control delivery_type">'
						+ select
						+ '</select>'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">排序:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" value="'+sort+'" name="sort" placeholder="序号">'
						+ '</div>'
						+ '</div>'
						
						+default_content
						
						+ '<div class="form-group" id="flag" >'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">标记:</label>'
						+ '<div class=" col-sm-5">'
						+ '<select name="flag" class="form-control">'
						+ default_flag
						
						+ '</select>'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group">'
						+'<label class="control-label col-sm-4" style="margin-left:-20px">备注:</label>'
						+'<div class=" col-sm-8">'
						+'<textarea rows="3" name="remark" class="form-control">'+remark+'</textarea>'
						+ '</div>'
						+ '</div>'
						
	    				+img
		    	                
						+ '<input type="hidden" name="element_id" value='+element_id+'>'
						
						+ '</form>';
					
					var d = dialog({
							title:'填写元素信息',
							content:content,
							okValue:'确定',
							cancelValue:'取消',
							ok:function(){
								var post_data = $('form').serialize();
								var dialog_param = {
										title:'提示',
										okValue:'确定',
										cancelValue:'取消',
										ok:function(){},
										cancel:'',
										width:320
								};
								var d1 = dialog(dialog_param);
								var sort = $("input[name='sort']").val();
								if(sort == ''){
									d1.content('排序不能为空');
									d1.showModal();
									return false;
								}
								$.post('/page/element/'+page_id, post_data, function(data){
									if(data.status != 0){
										d1.content(data.msg);
									}else{
										var d = dialog({
											title:"提示",
											content:'修改成功',
											ok:function(){
												window.location.reload();
											},
											okValue:"确定"
										})
										d.width(320);
										d.showModal();
									}
								})
							},
							cancel:function(){}
					});
					d.width(600)
					d.height(600)
					d.showModal()
					
					swfUploader.swfupload(object1);
				})
			},
			
			
			change:function(){
				$("body").on('change','.delivery_type',function(){
					var val = $(this).val();
					if(val == 0){
						$("#word").hide();
						$("#flag").hide();
						$("#image").show();
					}else{
						$("#default").val(" ");
						$("#word").show();
						$("#flag").show();
						$("#image").hide();
					}
				})
			},
			
			//删除
			del_element:function(){
				$('.del').click(function(){
					var id = $(this).attr('data-id');
					var d = dialog({
						title:'提示',
						content:"确认删除？",
						cancelValue:'取消',
						cancel:true,
						okValue:'确定',
						ok:function(){
							var obj = this;
							$.post('/page/element_del', {id:id}, function(data){
								if(data.status != 0){
									obj.content = data.msg;
								}else{
									window.location.reload();
								}
							})
							return false;
						}
					})
					d.width(320);
					d.showModal();
				})
			},
			
			
			
	}
})