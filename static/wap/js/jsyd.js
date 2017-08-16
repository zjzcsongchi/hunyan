/** 
 * 我的资料修改js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	require('wdate');
	var my_dialog =require('my_dialog');
	module.exports = {
			
			start:function(){
				var cars = JSON.parse(window.localStorage.getItem('wap_goods_cars') || '{"item":[]}');
				var num  = cars.item.length;
				$('#cars_num').text(num);
			},
			
			jump:function(){
				$('.drink_class').on('click', function(){
					window.open('/drink/index/'+$(this).data('id'),'_self');
				})
			},
			
			//数量的加减
			add_reduce:function(){
				$("#reduce").click(function(){
					var num = $('#num').val();
					if(num == 1){
						return false;
					}else{
						$('#num').attr('value',parseInt(num)-1);
					}
				});
				
				$("#add").click(function(){
					var num = $('#num').val();
					if(num >= 1){
						$('#num').attr('value',parseInt(num)+1);
					}else{
						return false;
					}
				});
				
			},
			index_add_reduce:function(){
				$('[type="reduce"]').click(function(){
					var id = $(this).data('id');
					var num = $('#num_'+id).val();
					if(num == 1){
						return false;
					}else{
						$('#num_'+id).attr('value',parseInt(num)-1);
					}
				});
				
				$('[type="add"]').click(function(){
					var id = $(this).data('id');
					var num = $('#num_'+id).val();
					if(num >= 1){
						$('#num_'+id).attr('value',parseInt(num)+1);
					}else{
						return false;
					}
				});
				
			},
			//打开弹窗
			open:function(){
				$('p.but').on('click',function(event){
					event.preventDefault();
					var id = $(this).attr('data');
					$('#open_title').html($('p#title_'+id).attr('data'));
					$('#open_title').attr('data',id);
					$('#open').addClass('act');
					$('#bg').addClass('act');
				})
				$('.close').click(function(){
					$('#open').removeClass('act');
					$('#bg').removeClass('act');
				})
				
				$(".get_price").click(function(){
					var real_price = $(this).attr("data-price");
					$("#real_price").val(real_price);
					
				})
			},
			
			//详情页的预定
			detail:function(){
				$('#detail').on('click', function(){
					$('#open').addClass('act');
					$('#bg').addClass('act');
					var id = $(this).attr('data');
					$('p#open_title').html($('p#title_'+id).attr('data'));
					$('p#open_title').attr('data',$('p#title_'+id).attr('infoid'));
				})
			},

			
			//预定
			buy_index:function(){
				$('#add').on('click' ,function(event){
					var price = $('#real_price').val();
					var ids = $('#open_title').attr('data');
					var user_name = $('#user_name').val();
					if(user_name == ''){
						module.exports.msg('收货人不能为空');
						return false;
					}
					var user_mobile = $('#user_mobile').val();
					if(user_mobile == ''){
						module.exports.msg('请填写联系电话');
						return false;
					}
					var user_addr = $('#user_addr').val();
					if(user_addr == ''){
						module.exports.msg('收货地址不能为空');
						return false;
					}
					var num = $('#num').val();
					if(num <= 0){
						module.exports.msg('数量必须大于等于1');
						return false;
					}
					var post_method = $('#post_method').val();
					if(post_method == ''){
						module.exports.msg('必须选择一种配送方式');
						return false;
					}
					
					var special_id = $(".detail-list").find(".act").attr("data-id");
					
					var data = {'id':ids,'num':num,'user_name':user_name,'user_addr':user_addr,'user_mobile':user_mobile,'post_method':post_method,'price':price,'special_id':special_id}
					$.post('/drink/order',data,function(data){
						if(data == 1){
							module.exports.msg('预定成功');
							$('#open').removeClass('act');
							$('#bg').removeClass('act');
						}else{
							module.exports.msg(data);
						}
						
					})
					
				})
			},
			
			//预定
			buy:function(){
				$('#add').on('click' ,function(event){
					var ids = $('#open_title').attr('data');
					var user_name = $('#user_name').val();
					if(user_name == ''){
						module.exports.msg('收货人不能为空');
						return false;
					}
					var user_mobile = $('#user_mobile').val();
					if(user_mobile == ''){
						module.exports.msg('请填写联系电话');
						return false;
					}
					var user_addr = $('#user_addr').val();
					if(user_addr == ''){
						module.exports.msg('收货地址不能为空');
						return false;
					}
					var num = $('#num').val();
					if(num <= 0){
						module.exports.msg('数量必须大于等于1');
						return false;
					}
					var post_method = $('#post_method').val();
					if(post_method == ''){
						module.exports.msg('必须选择一种配送方式');
						return false;
					}
					var price = $('#real_price').text();
					var special_id = $(".detail-list").find(".act").attr("data-id");
					
					var data = {'id':ids,'num':num,'user_name':user_name,'user_addr':user_addr,'user_mobile':user_mobile,'post_method':post_method,'price':price,'special_id':special_id}
					$.post('/drink/order',data,function(data){
						if(data == 1){
							module.exports.msg('预定成功');
							$('#open').removeClass('act');
							$('#bg').removeClass('act');
						}else{
							module.exports.msg(data);
						}
						
					})
					
				})
			},
			
			size:function(){
				$(".special").click(function(event){
					event.preventDefault();
					$(this).addClass('act');
					$(this).siblings().removeClass('act');
					//替换价格
					var id = $(this).data('pid');
					$('.goods_price_'+id).text($(this).data('price'));
				})
			},
			
			special:function(){
				$(".special").click(function(){
					$("#real_price").text($(this).attr("data-price"));
				})
			},
			
			//数量的加减
			add_reduce:function(){
				$("#reduce_num").click(function(){
					var num = $('#real_num').val();
					if(num == 1){
						return false;
					}else{
						$('#real_num').attr('value',parseInt(num)-1);
						$('#num').attr('value',parseInt(num)-1);
					}
				});
				
				$("#add_num").click(function(){
					var num = $('#real_num').val();
					if(num >= 1){
						$('#real_num').attr('value',parseInt(num)+1);
						$('#num').attr('value',parseInt(num)+1);
					}else{
						return false;
					}
				});
				
			},
			//添加到购物车
			add_cars:function(){
				$('#add_to_cars').on('click', function(){
					var data = {
						goods_id : $(this).data('id'),
						goods_info : $(this).data('info'),
						size_info : $(this).data('size'),
						num : $('#real_num').val(),
						size_id : $('.special.act').data('id'),
						size_price : $('.special.act').data('price'),
						size_name : $('.special.act').data('name'),
					}
					//如果购物车为空，直接保存到localstore
					var cars = JSON.parse(window.localStorage.getItem('wap_goods_cars') || '{"item":[]}');
					if(cars.item.length == 0){
						cars.item.push(data);
						window.localStorage.setItem('wap_goods_cars',JSON.stringify(cars));
						my_dialog.alert('添加成功！');
						//购物车数量加1
						var num = parseInt($('#cars_num').text())+1;
						$('#cars_num').text(num);
					}else{
						//判断是否已经存在 have：是否存在的标志 
						var have = 0;
						$.each(cars.item, function(i,v){
							if(v.goods_id == data.goods_id ){
								if(!data.size_id){
									have = 1;//已经存在
									my_dialog.alert('已经存在，请不要重复添加！');
									return false;
								}else if(v.size_id == data.size_id){
									have = 1;//已经存在
									my_dialog.alert('已经存在，请不要重复添加！');
									return false;
								}
							}
						});
						if(have == 0){
							cars.item.push(data);
							window.localStorage.setItem('wap_goods_cars',JSON.stringify(cars));
							my_dialog.alert('添加成功！');
							//购物车数量加1
							var num = parseInt($('#cars_num').text())+1;
							$('#cars_num').text(num);
						}
					}
				})
			},
			
			//首页添加到购物车
			index_add_cars:function(){
				$('[type="add_to_cars"]').on('click', function(){
					var data = {
						goods_id : $(this).data('id'),
						goods_info : $(this).data('info'),
						size_info : $(this).data('size'),
						num : $(this).parent().parent().find('.nums').val(),
						size_id : $(this).parent().parent().find('.special.act').data('id'),
						size_price : $(this).parent().parent().find('.special.act').data('price'),
						size_name : $(this).parent().parent().find('.special.act').data('name'),
					}
					//如果购物车为空，直接保存到localstore
					var cars = JSON.parse(window.localStorage.getItem('wap_goods_cars') || '{"item":[]}');
					if(cars.item.length == 0){
						cars.item.push(data);
						window.localStorage.setItem('wap_goods_cars',JSON.stringify(cars));
						//my_dialog.alert('添加成功！');
						//购物车数量加1
						var num = parseInt($('#cars_num').text())+1;
						$('#cars_num').text(num);
					}else{
						//判断是否已经存在 have：是否存在的标志 
						var have = 0;
						$.each(cars.item, function(i,v){
							if(v.goods_id == data.goods_id ){
								if(!data.size_id){
									have = 1;//已经存在

									this.num = parseInt(this.num) + parseInt(data.num);
									return false;
								}else if(v.size_id == data.size_id){
									have = 1;//已经存在
									
									this.num = parseInt(this.num) + parseInt(data.num);
									return false;
								}
							}
						});
						if(have == 0){
							cars.item.push(data);
							window.localStorage.setItem('wap_goods_cars',JSON.stringify(cars));
							//my_dialog.alert('添加成功！');
							//购物车数量加1
							var num = parseInt($('#cars_num').text())+1;
							$('#cars_num').text(num);
						} else if (have == 1) {
						  window.localStorage.setItem('wap_goods_cars',JSON.stringify(cars));
						}
					}
				})
			},
			
			msg:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					cancelValue:"确定",
					cancel:function(){},
				})
				d.width(150);
				d.showModal();
			}
	}
});