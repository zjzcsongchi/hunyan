//消费清单js
define(function(require, exports, module){

	require('dialog')
	module.exports = {
		add_row:function(){
			$('.add_row').on('click', function(){
				var table_row = '<tr>'+
	'<td>'+
		'<input type="text" name="name" class="form-control" >'+
	'</td>'+
	'<td>'+
		'<input type="text" name="unit" class="form-control" >'+
	'</td>'+
	'<td>'+
		'<input type="text" name="count" class="form-control" >'+
	'</td>'+
	'<td>'+
		'<input type="text" name="price" class="form-control" >'+
	'</td>'+
	'<td>'+
		'<input type="text" readonly name="money" class="form-control" >'+
	'</td>'+
	'<td>'+
		'<input type="text" name="remark" class="form-control" >'+
	'</td>'+
	'<td>'+
		'<button class="btn btn-primary del_row"><span class="glyphicon glyphicon-remove"></span></button>'+
	'</td>'+
'</tr>';
				$("#row_content").append(table_row)
			})
		},
		//删除一行
		del_row:function(){
			$(document).on('click', '.del_row', function(){
				var node = $(this)
				var d = dialog({
					title:'提示',
					cancelValue:'取消',
					cancel:function(){},
					okValue:'确认',
					content:'确认删除？',
					ok:function(){
					node.parent().parent().remove();

					}
				})
				d.width(320)
				d.showModal();
			})
		},
		//保存
		save:function(){
			$("#save").click(function(e){
			var list = [];
				e.preventDefault();
				$("#row_content tr").each(function(k,v){
					v=$(v)
					var value = {
						name:v.find('input[name=name]').val(),
						unit:v.find('input[name=unit]').val(),
						count:v.find("input[name=count]").val(),
						price:v.find("input[name=price]").val(),
						money:v.find("input[name=money]").val(),
						remark:v.find("input[name=remark]").val()
					};
					list.push(value);
				})
				var form_list = $("form").serializeArray();
				var post_data = {};
				form_list.forEach(function(v,k){
					post_data[v.name] = v.value;
				})
				post_data.list = list;

				$.post('/consume/consume_add', post_data, function(data){
					var d_param = {
						title:'提示',
						okValue:'确认',
						ok:function(){
							window.location.reload();
						}
					};
					if(data.status == 0){
						d_param.content = '保存成功';
					}else{
						d_param.content = data.msg;
					}
					var d = dialog(d_param);
					d.width(320)
					d.showModal();
				})

			})
		},
		//计算总价
		all_fee:function(){
			$('input[name=all_fee]').focus(function(){
				var all_fee = 0;
				$("#row_content tr").each(function(k,v){
                    var val = $(v).find('input[name=money]').val();
                    if (val) {
					    all_fee += parseFloat($(v).find('input[name=money]').val())
                    }
				})
				$(this).val(all_fee)
			})
		},
		//单价计算总价
		single_to_all:function(){
			$("input").on('change',  function(){
				var count = $(this).parent().parent().find('input[name=count]').val();
				var price = $(this).parent().parent().find('input[name=price]').val();
				$(this).parent().parent().find("[name=money]").val(count*price);
			});
		},
		//删除
		//删除预约
		del:function(){
			$(document).on('click', '.del', function(){
				var id = $(this).attr('data-id');
				var d = dialog({
					fixed:true,
					title:'提示',
					content:'确认删除？',
					cancel:function(){},
					cancelValue:'取消',
					ok:function(){
						$.get('/consume/del/'+id, function(data){
							d.content(data.msg);
							if(data.status == 0){
								window.location.reload();
							}
						})
						return false;
					},
					okValue:'确定'
				})
				d.width(320);
				d.showModal()
			})
		},
		//保存签名
		save_sign:function(){
			$("#save").click(function(e){
			var list = [];
				e.preventDefault();
				var form_list = $("form").serializeArray();
				var post_data = {};
				form_list.forEach(function(v,k){
					post_data[v.name] = v.value;
				})

				$.post('/consume/sign_save', post_data, function(data){
					var d_param = {
						title:'提示',
						okValue:'确认',
						ok:function(){
							window.location.reload();
						}
					};
					if(data.status == 0){
						d_param.content = '保存成功';
					}else{
						d_param.content = data.msg;
					}
					var d = dialog(d_param);
					d.width(320)
					d.showModal();
				})

			})
		}
	}
})
