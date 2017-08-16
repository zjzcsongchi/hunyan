/** 
 * 跟踪记录js文件
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
			add:function(){
				$(".container-fluid").on('click', "#add", function(){
					var customer_id = $('#customer_id').val();
					var content = $('#content').val();
					if(content == ''){
						module.exports.alert('回访内容不能为空');
						return false;
					}
					$.post('/milan/add_log', {'customer_id':customer_id, 'content':content}, function(data){
						if(data){
							if(data.code == 1){
								var k = $('#first').children('tr').last().data('id');
								if(!k || k == ''){
									k = 0;
								}
								k = parseInt(k)+1;
								var html ='';
									html +='<tr data-id="'+k+'">';
									html +=    '<td>'+k+'</td>';
									html +=    '<td>'+content+'</td>';
									html +=    '<td>'+data.time+'</td>';
									html += '</tr>';
							    $('#first').append(html);
							    $('#content').val('');
							}else{
								module.exports.alert(data.msg);
							}
						}else{
							module.exports.alert('网络异常');
						}
					})
				})
			}
	}
});












