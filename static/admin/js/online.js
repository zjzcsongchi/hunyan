/**
 * 订单管理js
 */
define(function(require, exports, module){
	
	require('dialog');
	require('wdate');
	require('datatables');
	module.exports={
			
			//公共提示框
			msg:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					ok:function(){},
					okValue:"确定"
				})
				d.width(320);
				d.showModal();
			},
		
			
			
			delivery_type:function(){
				$("body").on('change','#delivery_type', function(){
					var val = $(this).val();
					if(val == 0){
						html = '<label class="col-sm-2 control-label">地址*</label>';
						html += '<div class="col-sm-4">';
						html += '<input type="text" class="form-control" valtype="required"  msg="地址不能为空" name="address" style="height:34px" placeholder="请填写地址"></div>';
						$(".delivery_type").html(html);
					}else{
						html ='';
						$(".delivery_type").html(html);
					}
					
				})
			},
			
			//添加订单客户信息
			add_goods:function(){
				$('#add_goods').click(function(){
					if($('#order_num').val() == ''){
						module.exports.msg('请先提交订单信息');
						return false;
					}
					var id = $('#order_id').val();
					//商品类型
					var class_id = $("#class_id").val();
					class_name = '';
					if(class_id){
						class_name = $("#class_id").find("option:selected").text();
					}
					
					
					//商品
					var product_id = $('#goods').attr('data'); 
					var product_name= '';
					if(product_id){
						var product_name = $('#goods').find("option:selected").text();
					}
					
					//规格
					var special_id = $('#special').val();
					var special_name = '';
					if(special_id){
						var special_name = $('#special').find("option:selected").text();
					}else{
						special_id = 0;
					}
					
					
					var unit_price = $('#unit_price').val();
					if(unit_price == ''){
						module.exports.msg('请选择商品');
						return false;
					}
					
					var num = $('#num').val();
					if(num <=0){
						module.exports.msg('请填写数量或数量必须大于0');
						return false;
					}
					
					var price = parseFloat(unit_price)*parseFloat(num);
					price = parseFloat(price).toFixed(2);
					
					
					html ="";
					html += '<tr class="t_'+1+'" class="add_data">';
					html += '<td>'+1+'</td>';
					html += '<td>'+class_name+'<input name="class_id[]" value="'+class_id+'" type="hidden"/>'+'</td>';
					html += '<td>'+product_name+'<input name="product_id[]" value="'+product_id+'" type="hidden"/>'+'</td>';
					html += '<td>'+special_name+'<input name="special_id[]" value="'+special_id+'" type="hidden"/>'+'</td>';
					html += '<td>'+unit_price+'<input name="unit_price[]" value="'+unit_price+'" type="hidden"/>'+'</td>';
					html += '<td>'+num+'<input name="num[]" value="'+num+'" type="hidden"/>'+'</td>';
					html += '<td><span class="per_sum">'+price+'</span><input name="price[]" value="'+price+'" type="hidden"/>'+'</td>';
					html += '<td><a id_class="del" class="btn btn-danger remove">移除</a></td>';
					html += '<tr>';
					
					
					$('#first').after(html);
					module.exports.sum();
//					return false;
					
//					var ser_data = $('#form').serialize(); 
//					$.post('/drinkorder/add_goods',ser_data,function(data){
//						if(m.code == 1){
//							html ="";
//							html += '<tr id="t_'+m.id+'">';
//							html += '<td>'+m.id+'</td>';
//							html += '<td>'+m.name+'</td>';
//							html += '<td>'+foods_name+'</td>';
//							html += '<td>'+m.special_name+'</td>';
//							html += '<td>'+unit_price+'</td>';
//							html += '<td>'+num+'</td>';
//							html += '<td class="price_" data="'+price+'">'+price+'</td>';
//							html += '<td><a id_class="del" data="'+m.id+'" class="btn btn-danger">移除</a></td>';
//							html += '<tr>';
//							$('#tbody').append(html);
//							
//							var total_price = 0;
//							$('.price_').each(function(k,v){
//								total_price+=parseFloat($(v).attr('data'));
//							})
//							var s = parseFloat(total_price);
//							var f = parseFloat($('#free').val());
//							var f = f ? f:0;
//							var b = parseFloat($('#bargain_money').val())
//							var b = b ? b:0;
//							$('#total').html(total_price);
//							$('#need').html(s - f - b);
//						}else{
//							module.exports.msg(m);
//						}
//					});
					
				})
			},
			
			//计算总价格
			sum:function(){
				var total_price = 0;
				$(".t_1").each(function(k, v){
					var tmp_price = $(v).find(".per_sum").text();
					total_price += parseFloat(tmp_price);
				}); 
				total_price = parseFloat(total_price).toFixed(2);
				if(total_price<0){
					total_price=0;
				}
				$("#total").text(total_price);
				
				var express = $("#express").text();
				need_price = parseFloat(express)+parseFloat(total_price);
				$("#need").text(need_price);
				$("input[name='total']").val(total_price);
				
			},
			
			
			finsh:function(){
				$(document).on('click','#save_3', function(){
					
					var ser_data = $('#form').serialize(); 
					$.post('/drinkorder/add_goods',ser_data, function(data){
						module.exports.msg(data.data);
					})
					

				})
			},
			
			save:function(){
				$(document).on('click','#save_2', function(){
					var ser_data = $('#form').serialize(); 
					$.post('/online/edit_goods/'+order_id,ser_data, function(data){
						if(data.status == -1){
							module.exports.msg(data.msg);
						}else{
							module.exports.msg(data.data);
						}
					})
					

				})
			},
			
			
			
			//填写运单号
			input_express:function(){
				$('#express_btn').click(function(){
					var id = $('#order_id').val();
					var content = '<form class="form-horizontal">'
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">取货方式:</label>'
						+ '<div class=" col-sm-5">'
						+ '<select name="delivery_type" class="form-control delivery_type">'
						+ '<option value="0">快递</option>'
						+ '<option value="1">百年婚宴自取</option>'
						+ '</select>'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">快递公司:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" name="express_company" placeholder="请输入快递公司">'
						+ '</div>'
						+ '</div>'
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">运单号:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" name="express_number" placeholder="请输入快递单号">'
						+ '</div>'
						+ '</div>'
						
						 
						
						+ '</form>';
					
					var d = dialog({
							title:'填写快递信息',
							content:content,
							okValue:'确定',
							cancelValue:'取消',
							ok:function(){
								var express_company = $('input[name=express_company]').val();
								var express_number = $('input[name=express_number]').val();
								var express_remark = $('textarea[name="express_remark"]').val();
								var delivery_type = $(".delivery_type").val();
								var dialog_param = {
										title:'提示',
										okValue:'确定',
										cancelValue:'取消',
										ok:function(){},
										cancel:'',
										width:320
								};
								var d1 = dialog(dialog_param);
								if(express_company == '' || express_number == ''){
									d1.content('请填写所有字段');
									d1.showModal();
									return false;
								}
								var post_data = {id:id,express_company:express_company,express_number:express_number,express_remark:express_remark,delivery_type:delivery_type};
								$.post('/drinkorder/input_express', post_data, function(data){
									if(data.status != 0){
										d1.content(data.msg);
									}else{
										var d = dialog({
											title:"",
											content:'添加成功',
											ok:function(){
												window.location.href="/drinkorder";
												
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
					d.width(400)
					d.showModal()
				})
			},
			
			
			//线上订单填写运单号
			express:function(){
				$('#express_btn').click(function(){
					var id = $('#order_id').val();
					var content = '<form class="form-horizontal">'
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">取货方式:</label>'
						+ '<div class=" col-sm-5">'
						+ '<select name="delivery_type" class="form-control delivery_type">'
						+ '<option value="0">快递</option>'
						+ '<option value="1">百年婚宴自取</option>'
						+ '</select>'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">快递公司:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" name="express_company" placeholder="请输入快递公司">'
						+ '</div>'
						+ '</div>'
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">运单号:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" name="express_number" placeholder="请输入快递单号">'
						+ '</div>'
						+ '</div>'
						
						 
						
						+ '</form>';
					
					var d = dialog({
							title:'填写快递信息',
							content:content,
							okValue:'确定',
							cancelValue:'取消',
							ok:function(){
								var express_company = $('input[name=express_company]').val();
								var express_number = $('input[name=express_number]').val();
								var express_remark = $('textarea[name="express_remark"]').val();
								var delivery_type = $(".delivery_type").val();
								var dialog_param = {
										title:'提示',
										okValue:'确定',
										cancelValue:'取消',
										ok:function(){},
										cancel:'',
										width:320
								};
								var d1 = dialog(dialog_param);
								if(express_company == '' || express_number == ''){
									d1.content('请填写所有字段');
									d1.showModal();
									return false;
								}
								var post_data = {id:id,express_company:express_company,express_number:express_number,express_remark:express_remark,delivery_type:delivery_type};
								$.post('/online/input_express', post_data, function(data){
									if(data.status != 0){
										d1.content(data.msg);
									}else{
										var d = dialog({
											title:"",
											content:'添加成功',
											ok:function(){
												window.location.href="/online";
												
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
					d.width(400)
					d.showModal()
				})
			},
			
			select:function(){
				
				$("body").on('change','.delivery_type', function(){
					var value = $(".delivery_type").val();
					if(value == 0){
						var content = '<div class="form-group">'
							
							+ '<label class="control-label col-sm-4" style="margin-left:-20px">取货方式:</label>'
							+ '<div class=" col-sm-5">'
							+ '<select name="delivery_type" class="form-control delivery_type">'
							+ '<option value="0" selected>快递</option>'
							+ '<option value="1">百年婚宴自取</option>'
							+ '</select>'
							+ '</div>'
							+ '</div>'
							
							+ '<div class="form-group">'
							+ '<label class="control-label col-sm-4" style="margin-left:-20px">快递公司:</label>'
							+ '<div class=" col-sm-8">'
							+ '<input type="text" class="form-control" name="express_company" placeholder="请输入快递公司">'
							+ '</div>'
							+ '</div>'
							+ '<div class="form-group">'
							+ '<label class="control-label col-sm-4" style="margin-left:-20px">运单号:</label>'
							+ '<div class=" col-sm-8">'
							+ '<input type="text" class="form-control" name="express_number" placeholder="请输入快递单号">'
							+ '</div>'
							+ '</div>'
					}else{
						var content = '<div class="form-group">'
							+ '<label class="control-label col-sm-4" style="margin-left:-20px">取货方式:</label>'
							+ '<div class=" col-sm-5">'
							+ '<select name="delivery_type" class="form-control delivery_type">'
							+ '<option value="0">快递</option>'
							+ '<option value="1" selected>百年婚宴自取</option>'
							+ '</select>'
							+ '</div>'
							+ '</div>'
							
							+ '<div class="form-group">'
							+'<label class="control-label col-sm-4" style="margin-left:-20px">备注:</label>'
							+'<div class=" col-sm-8">'
							+'<textarea rows="3" name="express_remark" class="form-control"></textarea>'
							+ '</div>'
							+ '</div>'
					}
//					alert(content);
//					return false;
//					alert($("body").find(".form-horizontal").text());
					$(".form-horizontal").html(content);
				})
				
			},
			
			//移除已经添加的商品
			del:function(){
				$(document).on('click', "a[id_class='del']", function(){
					$(this).parent().parent("tr").remove();
					module.exports.sum();
				})
			},
			
			//修改商品数量
			edit:function(){
				$("input[name='num']").blur(function(){
					var id = $(this).attr('data');
				    //获得单价，数量
				    var unit_price = $('#unit_price_'+id).val();
				    var num = parseInt($('#num_'+id).val());
				    if(num <= 0){
				    	module.exports.msg('数量必须大于等于1');
				    	return false;
				    }
				    $('#price_'+id).val(parseFloat(unit_price)*parseFloat(num));
				});
				//点击修改
				$(document).on('click', "a[id_class='edit']", function(){
					var id = $(this).attr('data');
					var unit_price = $('#unit_price_'+id).val();
				    var num = $('#num_'+id).val();
				    var price = $(this).attr('data');
				    var s_price = parseFloat(unit_price)*parseFloat(num);
				    
				    $.post('/drinkorder/edit_goods',{'id':id,'num':num,'unit_price':unit_price,'price':s_price},function(data){
				    	if(data == 1){
				    		var total_price = 0;
							$('td.price_ input[name="price"]').each(function(k,v){
								total_price+=parseFloat($(v).val());
							})
							var s = parseFloat(total_price);
							var f = parseFloat($('#free').val());
							var f = f ? f:0;
							var b = parseFloat($('#bargain_money').val())
							var b = b ? b:0;
							$('#total').html(total_price);
							$('td#need').html(s - f - b);
				    	}else{
				    		module.exports.msg(data);
				    	}
				    })
				})
			},
			
			erji:function(){
				$('#class_id').change(function(){
					var class_id = $(this).val();
					$.get('/drinkappoint/erji',{'class_id':class_id},function(data){
						if(data.code == 1){
							$('#goods').html='';
							var html = '<option value="">请选择商品</option>';
							$.each(data.arr,function(k,v){
								html += '<option value="'+v.id+'">'+v.title+'</option>';
							});
							$("#goods").html(html);
						}else{
							$("#goods").html('<option value="">请选择商品</option>');
						}
					})
				});
				
					$('#goods').change(function(){
						var products_id = $(this).val();
						$("#goods").attr("data", products_id);
						$.get('/drinkorder/special',{products_id:products_id},function(data){
							if(data.code == 1){
								$('#special').html='';
								var html = '<option value="">---请选择规格---</option>';
								$.each(data.arr,function(k,v){
									html += '<option value="'+v.id+'">'+v.version_name+'</option>';
								});
								$("#special").html(html);
								$("#unit_price").val(data.present_price);
							}else{
								$("#special").html('<option value="">---请选择规格---</option>');
								$("#unit_price").val(data.arr);
							}
						})
					});
				
				//选中商品后查询价格
				$('#special').change(function(){
					var id = $('#special').val();
					var products_id = $("#goods").val();
					$(this).attr('data',id);
					$.get('/drinkorder/get_price_by_id',{'id':id,'products_id':products_id},function(data){
						if(data){
							$('#unit_price').val(data.present_price);
							$('#cn_name').val(data.title);
						}
					})
				})
			},
			
			
			autoadd:function(){
				$("#num").blur(function(){
					var money = parseFloat($('#unit_price').val()) * parseFloat($('#num').val());
					money = parseFloat(money).toFixed(2);
				    $('#price').attr('value', money);
				});
			},
			
			//时间选择器
			datepick:function(){
				$(".Wdate").focus(function(){
					if(arguments[0] && arguments[1]){
						WdatePicker({dateFmt:'yyyy-MM-dd', minDate:arguments[0], maxDate:arguments[1]})
					}else{
						WdatePicker({dateFmt:'yyyy-MM-dd'});
					}
					var date = $(this).val().split("-");
		            //计算农历
					if(date.length > 1){
						var link = 'year='+date[0]+'&month='+date[1]+'&day='+date[2];
						$.get('/publicservice/solartolunar?'+link, function(data){
							$('.lunardate').val(data.lunar_time.lunar_time)
							$('.week').val(data.lunar_time.week);
						})
						
					}
		            
		        });
				$("#start_time").focus(function(){
					//var date = new Date();
					//$(this).val(date.getFullYear()+'-'+date.getMonth()+'-'+date.getDate());
		            WdatePicker({dateFmt:'HH:mm'})
		        });
			},
			
			open_close:function(){
				$('#open_close').on('click', function(){
					if($(this).attr('data') == 1){
						$('#one').attr('style','display:none');
						$(this).html('展开订单基本信息');
						$(this).attr('data',0);
						return false;
					}
					$(this).attr('data',1);
					$(this).html('收起订单基本信息');
					$('#one').attr('style','display:block');
					$('#two').attr('style','display:block');
					$('#save_2').attr('style','display:none');
				})
			},
			
			del_info:function(){
				$('.del_info').on('click', function(){
					var url = $(this).attr("data-id");
					var d = dialog({
						title:"提示",
						content:'确定删除?',
						ok:function(){
							window.location.href=url;
							
						},
						okValue:"确定"
					})
					d.width(320);
					d.showModal();
				})
			},
			
			del_online:function(){
				$('.del_online').on('click', function(){
					var url = $(this).attr("data-id");
					var d = dialog({
						title:"提示",
						content:'确定删除?',
						ok:function(){
							window.location.href=url;
							
						},
						okValue:"确定"
					})
					d.width(320);
					d.showModal();
				})
			}
			
			
	}
})
