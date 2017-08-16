/** 
 * 购物车js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	var my_dialog =require('my_dialog');
	module.exports = {
			alert:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					cancelValue:"确定",
					cancel:function(){},
				})
				d.width(150);
				d.showModal();
			},
			clear:function(){
				$('.empty').on('click', function(){
					my_dialog.dialog('确定要清空购物车吗？', function(){
						$('.drink-lists').empty();
						$('#total_num').text(0);
						$('#num').text(0);
						$('.price').html('￥ 0.00');
						$('.price').attr('data', '0.00');
						window.localStorage.removeItem('wap_goods_cars');
					});
				})
			},
			start:function(){
				//获取所有的购物车数据
				var cars = JSON.parse(window.localStorage.getItem('wap_goods_cars') || '{"item":[]}');
				if(cars.item.length > 0){
					var html ='';
					$.each(cars.item, function(i,v){
						if(v.size_id){
							html +='<li class="cars" data-num="'+v.num+'" data-size_id ="'+v.size_id+'" data-goods_id="'+v.goods_id+'">';
						}else{
							html +='<li class="cars" data-num="'+v.num+'" data-size_id ="0" data-goods_id="'+v.goods_id+'">';
						}
						if(v.size_name){
							html +='<p class="number">'+v.goods_info.title+' / '+v.size_name+'</p>';
						}else{
							html +='<p class="number">'+v.goods_info.title+'</p>';
						}
						html +='<img src="'+v.goods_info.cover_img+'">';
						html +='<div class="cont">';
						html +='<p class="title">'+v.goods_info.title+'</p>';
						html +='<p class="text"><span>厂商：</span>'+v.goods_info.firm+'</p>';
						if(v.size_info){
							$.each(v.size_info, function(key,val){
								html +='<p class="text"><span>'+key+'：</span>'+val+'</p>';
							})
						}
						html +='<p class="text"><span>数量：</span>'+v.num+'</p>';
						html +='<p class="text"><span>生成许可证：</span>'+v.goods_info.allow_num+'</p>';
						html +='</div>';
						html +='<div class="bot">';
						if(v.size_price){
							var total = parseFloat(v.size_price)*parseInt(v.num);
						}else{
							var total = parseFloat(v.goods_info.present_price)*parseInt(v.num);
						}
						html +='<p class="total" data="'+total.toFixed(2)+'">￥'+total.toFixed(2)+'</p>';
						html +='<a href="javascript:;" data="'+i+'" class="del-but">删除</a>'
						html +='</div>';
						html +='</li>';
					})
					$('.drink-lists').append(html);
					$('#total_num').text(cars.item.length);
				}else{
					$('#total_num').text(0);
				}
			},
			chose:function(){
				$(".drink-order .chose").click(function() {
	                $(this).toggleClass("act");
	                if($(".drink-order .chose").hasClass("act")){
	                	$('#num').text($('#total_num').text());
	                    $(".drink-lists li .number").addClass("act");
	                    //统计所有价格加起来
	                    var total = 0;
	                    $('.total').each(function(i,v){
	                    	total += parseFloat($(v).attr('data'));
	                    })
	                    $('.price').html('￥'+total);
	                    $('.price').attr('data', total);
	                }else{
	                    $(".drink-lists li .number.act").removeClass("act");
	                    $('#num').text(0);
	                    $('.price').html('￥ 0.00');
	                    $('.price').attr('data', '0.00');
	                }                
	            });
	            $(".drink-lists li").click(function() {
	                if($(this).children('.number').hasClass("act")){
	                	$(this).children('.number').removeClass("act");
	                	$('#num').text(parseInt($('#num').text())-1);
	                	var unit = parseFloat($(this).find('.total').attr('data')); 
	                	var old = parseFloat($('.price').attr('data'))
	                	var t = old-unit;
	                	$('.price').attr('data', t);
	                	$('.price').html('￥ '+t);
	                }else{
	                	$('#num').text(parseInt($('#num').text())+1);
	                	$(this).children('.number').addClass("act");
	                	var unit = parseFloat($(this).find('.total').attr('data')); 
	                	var old = parseFloat($('.price').attr('data'))
	                	var t = old+unit;
	                	$('.price').attr('data', t);
	                	$('.price').html('￥ '+t);
	                }
	            });
			},
			select:function(){
		    	$('[name="delivery_type"]').change(function(){
		    		var delivery_type = $(this).val();
		    		if(delivery_type == 1){
		    			$('.post_method').hide();
		    			$('#addr').hide();
		    		}else{
		    			$('.post_method').show();
		    			$('#addr').show();
		    		}
		    	});

		    },
		    
		    del:function(){
		    	$('.del-but').on('click', function(e){
		    		 e.stopPropagation();
		    		 var _obj = $(this);
		    		 my_dialog.dialog('确定要删除吗？', function(){
		    			 var index = _obj.attr('data');
			    		 var cars = JSON.parse(window.localStorage.getItem('wap_goods_cars') || '{"item":[]}');
			    		 cars.item.splice(index,1);
			    		 window.localStorage.setItem('wap_goods_cars',JSON.stringify(cars));
			    		 window.location.reload();
		    		 }) 
		    	})
		    },
		    
		    pay:function(){
		    	$('.close').on('click', function(){
		    		$('.but').attr('status', 0);
	    			$('.popup-bottom').removeClass('act');
	    			$('.but').text('立即结算');
		    	});
		    	
		    	$('.but').on('click', function(){
		    		//判断是否已经选择商品
		    		var have = 0;
		    		$('.number').each(function(i,v){
		    			if($(v).hasClass('act')){
		    				have = 1;
		    			}
		    		})
		    		if(!have){
		    			my_dialog.alert('请至少选择一件商品!');
		    			return false;
		    		}else{
		    			if($(this).attr('status') == 0){
			    			$(this).attr('status', 1);
			    			$('.popup-bottom').addClass('act');
			    			$(this).text('立即支付');
			    		}else{
			    			var arr = [];
			    			$('.number.act').parent().each(function(i,v){
			    				var tem = {
			    						'product_id':$(v).data('goods_id'),
			    						'special_id':$(v).data('size_id'),
			    						'num':$(v).data('num')
			    				};
			    				arr.push(tem);
			    			})
			    			if(arr.length == 0){
			    				my_dialog.alert('请至少选择一件商品!');
				    			return false;
			    			}
			    			//获取收货信息
			    			var addr_name = $('#name').val();
			    			if(!addr_name || addr_name == ''){
			    				my_dialog.alert('收货人不能为空!');
				    			return false;
			    			}
			    			var addr_tel = $('#mobile_phone').val();
			    			if(!addr_tel || addr_tel == ''){
			    				my_dialog.alert('手机号不能为空!');
				    			return false;
			    			}
			    			//如果是快递配送，必须验证收货地址
			    			var delivery_type = $('[name="delivery_type"]').val();
				    		var address = $('#address').val();
				    		if(delivery_type == 0){
				    			if(address == ''){
				    			  my_dialog.alert('收货地址不能为空');
					    			return false;
				    			}
				    		}
				    		//验证完成
				    		var data = {
				    				arr:arr,
				    				name:addr_name,
				    				tel:addr_tel,
				    				delivery_type:delivery_type,
				    				address:address
				    		}
				    		$.post('/drink/add_order', data, function(data){
				    			if(data){
				    				if(data.status == 0){
				    					//添加订单成功,删除购物车数据，跳转到订单性情
				    					var index_list = []; //已经完成的购物车对应的索引
						    			$('.number.act').parent().each(function(i,v){
						    				index_list.push($(v).attr('data'));
						    			})
						    			//获取购物车数量
						    			var cars = JSON.parse(window.localStorage.getItem('wap_goods_cars') || '{"item":[]}');
						    			//如果购物车全部被下单了，则清空本地储
						    			window.localStorage.removeItem('wap_goods_cars');
				    					window.location.href="/order/payment?id="+data.data.order_id;
				    				}else{
				    					my_dialog.alert(data.msg);
				    				}
				    			}else{
				    				my_dialog.alert('网络异常');
				    			}
				    		})
			    		}
		    		}
		    	})
		    }
	}
})