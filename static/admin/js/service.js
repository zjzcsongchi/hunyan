/** 
 * 婚礼服务js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	module.exports = {
			alert:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					cancelValue:"确定",
					cancel:function(){},
				})
				d.width(320);
				d.showModal();
			},
			
			//添加分类
			add_pid:function(){
				$(document).on('click', '#addpid', function(){
					var title = $('#name').val();
					var id = $('#id').val();
					if(!title || title == ''){
						module.exports.alert('请添加婚礼服务类型名称');
						return false;
					}
					$.post('/milancombo/add_pid', {'combo_id':id, 'name':title}, function(data){
						if(data){
							if(data.code == 1){
								var html = '<option value="'+data.id+'">'+title+'</option>';
								$('#pid').append(html);
								var name = $('#name').val('');
								var str = '';
								str += '<tr class="pid" id="p_'+data.id+'" style="border-bottom: 1px solid #c7c7c7;border-top:1px solid #c7c7c7">';
								str += '<th id="txt_pid_'+data.id+'" colspan="2" style="text-align: center">'+title+'</th>';
								str += '<th><a type="edit_pid" data="'+data.id+'" status="0" class="tablelink">编辑</a>&nbsp;&nbsp;';
								str += '<a type="del_pid" data="'+data.id+'" class="tablelink">删除</a>';
								str += '</th>';
								str += '</tr>';
								$('#service').append(str);
							}else{
								module.exports.alert(data.msg);
								return false;
							}
						}else{
							module.exports.alert('网络异常');
							return false;
						}
					})
				})
			},
			/**
			 * 删除婚礼的服务
			 */
			del:function(){
				$(document).on('click', '[type="del"]', function(){
					var _obj = $(this);
					var id = _obj.attr('data');
					$.post('/milancombo/del_service', {'id':id}, function(data){
						if(data){
							if(data.code == 1){
								$('.'+_obj.attr('pid')+'[data="'+_obj.attr('kid')+'"]').remove();
							}else{
								module.exports.alert(data.msg);
								return false;
							}
						}else{
							module.exports.alert('网络异常');
							return false;
						}
					})
					
				})
			},
			
			/**
			 * 删除婚礼类别
			 */
			del_pid:function(){
				$(document).on('click', '[type="del_pid"]', function(){
					var _obj = $(this);
					var id = _obj.attr('data');//要删除的id
					$.post('/milancombo/del_service_pid', {'id':id}, function(data){
						if(data){
							if(data.code == 1){
								$('#p_'+id).remove();
							}else{
								module.exports.alert(data.msg);
								return false;
							}
						}else{
							module.exports.alert('网络异常');
							return false;
						}
					})
					
				})
			},
			
			edit_pid:function(){
				$(document).on('click', '[type="edit_pid"]', function(){
					var _ojb = $(this);
					var id = _ojb.attr('data');
					var status = _ojb.attr('status');
					if(status == 0){
						var string = $('#txt_pid_'+id).text();
						var html = '<input type="text" id="pid_name_'+id+'" class="dfinput" value="'+string+'" />';
						$('#txt_pid_'+id).html(html);
						//将编辑更改为保存
						_ojb.text('保存');
						_ojb.attr('status', 1);
					}else{
						//进入待保存状态
						var title = $("#pid_name_"+id).val();
						if(title !== ''){
							$.post('/milancombo/update_pid_service', {'id':id, 'name':title}, function(data){
								if(data){
									if(data.code == 1){
										//恢复表格状态
										_ojb.attr('status', 0);
										_ojb.text('编辑');
										$('#txt_pid_'+id).html();
										$('#txt_pid_'+id).text(title);
									}else{
										module.exports.alert(data.msg);
										return false;
									}
								}else{
									module.exports.alert('网络异常');
									return false;
								}
							})
						}
					}
				})
			},
			
			edit:function(){
				$(document).on('click', '[type="edit"]', function(){
					var _ojb = $(this);
					var id = _ojb.attr('data');
					var status = _ojb.attr('status');
					if(status == 0){
						//如果是编辑状态
						var string = $('#txt_'+id).text();
						var html = '<input type="text" id="name_'+id+'" class="dfinput" value="'+string+'" />';
						$('#txt_'+id).html(html);
						//将编辑更改为保存
						_ojb.text('保存');
						_ojb.attr('status', 1);
					}else{
						//待保存状态，可以保存
						var title = $("#name_"+id).val();
						if(title !== ''){
							$.post('/milancombo/update_service', {'id':id, 'name':title}, function(data){
								if(data){
									if(data.code == 1){
										//恢复表格状态
										_ojb.attr('status', 0);
										_ojb.text('编辑');
										$('#txt_'+id).html();
										$('#txt_'+id).text(title);
									}else{
										module.exports.alert(data.msg);
										return false;
									}
								}else{
									module.exports.alert('网络异常');
									return false;
								}
							})
						}
					}
					
				})
			},
			
			//添加内容
			add:function(){
				$(document).on('click', '#add', function(){
					var combo_id = $('#id').val();
					var pid = $('#pid').val();
					if(pid == 0){
						module.exports.alert('请添加婚礼服务类型');
						return false;
					}
					var names = $('#desc').val();
					if(!names || names == ''){
						module.exports.alert('请添加婚礼服务内容');
						return false;
					}
					$.post('/milancombo/add_service', {'combo_id':combo_id, 'pid':pid, 'name':names}, function(data){
						if(data){
							if(data.code == 1){
								//获得改类别的最后一个记录的排序值
								if($('.p_'+pid).last().length !=0){
									var last_id = $('.p_'+pid).last().attr('data');
									var insert_id = parseInt(last_id)+1; //插入的序号id
								}else{
									var insert_id = 1;
								}
								var html = '';
								html += '<tr class="p_'+pid+'" data="'+insert_id+'" style="border-top:1px solid #c7c7c7">';
								html += '<td style="border-right:1px solid #c7c7c7;">'+insert_id+'</td>';
								html += '<td id="txt_'+data.id+'">'+names+'</td>';
								html += '<td><a type="edit" data="'+data.id+'" status="0" class="tablelink">编辑</a>&nbsp;&nbsp;<a type="del" pid="p_'+pid+'" kid="'+insert_id+'" data="'+data.id+'" class="tablelink">删除</a></td>';
								html += '</tr>';
								if($('.p_'+pid).last().length !=0){
									$('.p_'+pid).last().after(html);
								}else{
									$('#p_'+pid).after(html);
								}
								$('#desc').val('');
							}else{
								module.exports.alert(data.msg);
								return false;
							}
						}else{
							module.exports.alert('网络异常');
							return false;
						}
					})
				})
			}
	}
})
















