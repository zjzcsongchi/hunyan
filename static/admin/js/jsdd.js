/** 
 * 酒水商城订单修改js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	module.exports = {
			
			change:function(){
				$(".change").click(function(){
					var id = $(this).attr('data');
					var k = $(this).attr('status');
					module.exports.get(id,k,'status');
				}),
				$(".del").click(function(){
					var id = $(this).attr('data');
					var k = $(this).attr('status');
					module.exports.get(id,k,'is_del');
				})
			},
			get:function(id,k,field){
				$.post('/drinkappoint/change',{'id':id,'k':k,'field':field},function(data){
					if(data == 1){
						module.exports.msg('操作成功');
					}
				})
			},
			msg:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					cancelValue:"确定",
					cancel:function(){
						window.location.reload();
					},
				})
				d.width(320);
				d.showModal();
			},
			erji:function(){
				$('#class_id').change(function(){
					var class_id = $(this).val();
					$.get('/drinkappoint/erji',{'class_id':class_id},function(data){
						if(data.code == 1){
							$('#goods').html='';
							var html = '<option value="">---请选择酒水---</option>';
							$.each(data.arr,function(k,v){
								html += '<option value="'+v.id+'">'+v.title+'</option>';
							});
							$("#goods").html(html);
						}else{
							$("#goods").html('<option value="">---请选择酒水---</option>');
						}
					})
				})
			},
			
			special:function(){
				$('#goods').change(function(){
					var products_id = $(this).val();
					$.get('/drinkappoint/special',{products_id:products_id},function(data){
						if(data.code == 1){
							$('#special').html='';
							var html = '<option value="">---请选择规格---</option>';
							$.each(data.arr,function(k,v){
								html += '<option value="'+v.id+'">'+v.version_name+'</option>';
							});
							$("#special").html(html);
						}else{
							$("#special").html('<option value="">---请选择规格---</option>');
						}
					})
				})
			},
			//自动计算总价
			autoadd:function(){
				$("input[id='price']").focus(function(){
					  $('#price').attr('value', parseInt($('#unit_price').val()) * parseInt($('#num').val()));
				});
			},
			look:function(){
				$('.look').click(function(){
					var data = $.parseJSON($(this).attr('data'));
					var html = '<table style="width:400px" class="table table-bordered"><tbody>';
				    html += '<tr><td>预定单号：</td><td>'+data.order_num+'</td></tr>';
				    html += '<tr><td>商品名称：</td><td>'+data.drink_title+'</td></tr>';
				    html += '<tr><td>商品封面图：</td><td><img width="150" src="'+data.cover_img+'"/></td></tr>';
				    html += '<tr><td>单价：</td><td>'+data.unit_price+'元</td></tr>';
				    html += '<tr><td>数量：</td><td> X '+data.num+'</td></tr>';
				    html += '<tr><td>总价：</td><td>'+data.price+'元</td></tr>';
				    html += '<tr><td>收货人：</td><td>'+data.user_name+'</td></tr>';
				    html += '<tr><td>联系电话：</td><td>'+data.user_mobile+'</td></tr>';
				    html += '<tr><td>收货地址：</td><td>'+data.user_addr+'</td></tr>';
				    html += '</tbody></table>';
					var d = dialog({
                        title:'预定详情',
                        content:html,
                        okValue:'关闭',
                        ok:function(){}
                    })
                    d.width(400);
                    d.showModal();
				})
			}
	}
})