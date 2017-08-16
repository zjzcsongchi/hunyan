/**
 * 客户管理js
 */
define(function(require, exports, module){
	require('wdate');
	require('dialog');
	var swfUploader = require('admin_uploader');
	module.exports={
			init:function(){
				var object2 = [];
				for(var i=0;i<5;i++){
					object2[i] = {"obj": "#uploader_version_image_"+i, "btn": "#btn_version_image_"+i}
				}
				
				var products_id = $("#products_id").attr("data-id");
				$.post('/attribute/modify_special', {products_id:products_id}, function(data){
					$('body').on('click','.special_del',function(){
						$(this).parent().parent().remove();
					})
					$('body').on('click','#load_special',function(){
						var size = $("#customer_case .dinner_marry").size();
						var object1 = [];
						object1 = [{"obj": "#uploader_version_image_"+size, "btn": "#btn_version_image_"+size}];
						html = '<div class="form-group dinner_marry" sort="'+size+'"><label class="col-sm-2 control-label"></label>';
						html += '<div class="col-sm-2"><input type="text" valType="required" msg="名称不能为空" name="version_name[]" class="form-control" placeholder="型号"></div>';
						html += '<div class="col-sm-1"><input type="text"  valType="required" msg="名称不能为空" class="form-control" name="version_price[]" placeholder="价格"></div>';
						
						//图片
						html += '<div class="col-sm-4"><ul id="uploader_version_image_'+size+'"><li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">'
	            		html += '<a href="javascript:;" class="up-img"  id="btn_version_image_'+size+'"><span>+</span><br>添加照片</a></li></ul></div>';
	    	               
						html += '<div class="col-sm-1 text-center"><input  value="删除" class="btn btn-danger special_del" style="width:80px"></div></div>';
						$(this).parent().parent().parent().append(html);
						swfUploader.swfupload(object1);
					})
					
					$("#customer_case").html(data);
//					if(data != 'nodata'){
//						$("#special_attr").html(data);
//					}else{
//						$("#special_attr").html('');
//					}
				})
				swfUploader.swfupload(object2);
			},
			
			tab:function(){
					$('.nav-tabs li:eq('+tab+') a').tab('show');
			},
			//保存
			save:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					
					var data = $('form').serialize();
					
					$.post('/attribute/add', data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/attribute/index";
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
			
			save_special:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					
					var data = $('form').serialize();
					var products_id = $("#products_id").attr("data-id");
					$.post('/attribute/set_special/'+products_id, data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/attribute/index";
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
			
			
			save_attr:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					
					var data = $('form').serialize();
					var products_id = $("#products_id").attr("data-id");
					$.post('/attribute/set_attr/'+products_id, data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/attribute/index";
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
			load_special:function(){
				$("#load_special").click(function(){
					var size = $("#customer_case .dinner_marry").size();
					var object1 = [];
					object1 = [{"obj": "#uploader_version_image_"+size, "btn": "#btn_version_image_"+size}];
					html = '<div class="form-group dinner_marry" sort="'+size+'"><label class="col-sm-2 control-label"></label>';
					html += '<div class="col-sm-2"><input type="text" valType="required" msg="名称不能为空" name="version_name[]" class="form-control" placeholder="型号"></div>';
					html += '<div class="col-sm-1"><input type="text"  valType="required" msg="名称不能为空" class="form-control" name="version_price[]" placeholder="价格"></div>';
					
					//图片
					html += '<div class="col-sm-4"><ul id="uploader_version_image_'+size+'"><li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">'
            		html += '<a href="javascript:;" class="up-img"  id="btn_version_image_'+size+'"><span>+</span><br>添加照片</a></li></ul></div>';
    	               
					html += '<div class="col-sm-1 text-center"><input  value="删除" class="btn btn-danger special_del" style="width:80px"></div></div>';
					$(this).parent().parent().parent().append(html);
					swfUploader.swfupload(object1);
					
				})
			},
			load_attr:function(){
				$("#load_attr").click(function(){
					html = '<div class="form-group dinner_marry"><label class="col-sm-2 control-label"></label>';
					html += '<div class="col-sm-2"><input type="text" valType="required" msg="名称不能为空" name="attr_name[]" class="form-control" placeholder="属性名称"></div>';
					html += '<div class="col-sm-1"><input type="text"  valType="required" msg="名称不能为空" class="form-control" name="attr_value[]" placeholder="属性值"></div>';
					html += '<div class="col-sm-1 text-center"><input  value="删除" class="btn btn-danger version_del" style="width:80px"></div></div>';
					$(this).parent().parent().after(html);
					
				})
			},
			version_del:function(){
				$('body').on('click','.version_del',function(){
					$(this).parent().parent().remove();
				})
			},
			
			special_del:function(){
				$('body').on('click','.special_del',function(){
					var sort = $(this).parent().parent().attr("sort");
					html = '<div"><input type="text" id="version_name[]" name="version_name[]" class="form-control" placeholder="型号" >';
					html += '<input type="text" id="version_price[]" name="version_price[]" class="form-control" placeholder="价格" >';
					html += '<input type="text" name="version_image_'+sort+'" class="form-control"></div>';

					$(this).parent().parent().hide();
					$(this).parent().parent().html(html);
				})
			},
			//属性添加
			add_attr:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					
					var data = $('form').serialize();
					
					$.post('/attributeclass/add', data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/attributeclass/lists";
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
			
			//属性修改
			edit_attr:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					
					var data = $('form').serialize();
					$.post('/attributeclass/list_edit', data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/attributeclass/lists";
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
			
			//属性删除
			del_attr:function(){
				$(".del").click(function(){
					var id = $(this).attr('data-id');
					var content = "确定删除吗";
					var d = dialog({
						title:"提示",
						content:content,
						ok:function(){
							window.location.href="/attributeclass/del/"+id;
							return false;
						},
						okValue:"确定"
					});
					d.width(320);
					d.showModal();
				})
			},
			
			select_class_id:function(){
				$("#class_id").change(function(){
					var class_id = $(this).val();
					$.post('/attribute/add_attr', {class_id:class_id}, function(data){
						if(data != 'nodata'){
							$("#special_attr").html(data);
						}else{
							$("#special_attr").html('');
						}
					})
				});
			},
			
			
			//修改
			modify:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					var data = $('form').serialize();
					var id = $("input[name='id']").val();
					$.post('/attribute/modify/'+id, data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/attribute/index";
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
					var is_del = $(this).attr('data-status');
					var text = $(this).text();
					var d = dialog({
						title:'提示',
						content:"确定要"+text+"吗？",
						cancelValue:'取消',
						cancel:true,
						okValue:'确定',
						ok:function(){
							var obj = this;
							$.post('/attribute/del', {id:id,is_del:is_del}, function(data){
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
			
			//保存
			save_products_class:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					var data = $('form').serialize();
					$.post('/attribute/add_attributeclass', data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/attribute/attributeclass";
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
			
			del_products_class:function(){
				$(".del").click(function(){
					var id = $(this).attr('data-id');
					$.post('/attribute/del_products_class', {id:id}, function(data){
					var content = "确定删除吗";
					var d = dialog({
						title:"提示",
						content:content,
						ok:function(){
							if(data.status == 0){
								window.location.href="/attribute/attributeclass";
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
			add_attributeclass:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					var data = $('form').serialize();
					$.post('/attribute/add_attributeclass', data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/attribute/attributeclass";
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
			edit_attributeclass:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					var id= $("input[name='id']").val();
					var data = $('form').serialize();
					$.post('/attribute/edit_attributeclass/'+id, data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/attribute/attributeclass";
									return false;
								}
							},
							okValue:"确定"
						});
						d.width(320);
						d.showModal();
					})
				})
			}
			
	}
})