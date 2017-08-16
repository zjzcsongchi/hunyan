/**
 * 资讯页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	var public = require('public');
	var storage = require('storage');
	module.exports = {
		load:function(){
		    public.load();
		    $(function(){
	            $(".venue-list li:nth-child(5n)").css("margin-right", "0");
	            
	            $("#pay").click(function() {
	            	if(status == 1){
	            		$(".page-bg").addClass("act");
		                $(".popup-info").addClass("act");
		                $(".close").click(function() {
		                    $(".page-bg").removeClass("act");
		                    $(".popup-info").removeClass("act");
		                });
	            	}else if(status == 0){
	            		module.exports.show_weixin_box();
	            	}
	                
	            });
	            $("table .del").click(function() {
	                $(".page-bg").addClass("act");
	                $(".popup-del").addClass("act");
	                $(".close").click(function() {
	                    $(".page-bg").removeClass("act");
	                    $(".popup-del").removeClass("act");
	                });
	            });

	            
	            var cart = localStorage.getItem('drink');
	            var cartObject = storage.deserialize( cart );
	            var arr = cartObject.items;
	            $.post('/drink/car', {arr:arr}, function(data){
	            	if(data != "nodata"){
	            		$("table").append(data);
	            	}
	            	
	            })
	            module.exports.about();
	            
	        });
		},
		
		dump:function(){
			$("body").on("click", ".about_li",function(){
            	var id = $(this).attr("data-id");
            	if(id){
            		window.location.href="/drink/detail?id="+id;
            	}
            })
		},
		
		about:function(){
			$(".venue-list li:nth-child(5n)").css("margin-right", "0");
			var about_arr = new Array();
            var ShoppingCart = localStorage.getItem("drink");  
	        var productlist = storage.deserialize( ShoppingCart ).items;
	        for(var i=0;i<productlist.length;i++ ){
	        	about_arr.push(productlist[i].product_id);
	        }
	        $.post('/drink/about',{about_arr:about_arr}, function(data){
	        	if(data != "nodata"){
	        		$(".venue-list").append(data);
	        	}
	        })
		},
		//数量的加减
		add_reduce:function(){
			$("body").on('click', '.reduce', function(){
				var num = $(this).next("input").val();
				if(num == 1){
					return false;
				}else{
					$(this).next("input").attr('value',parseInt(num)-1);
					var present_price = $(this).parent("td").prev("td").find(".present_price").text();
					var money = (parseInt(num)-1)*present_price;
					
					$(this).parent("td").next("td").find(".money").text(money);
					$(this).parent("td").parent("tr").find(".product").attr('data-price', money);
				}
				module.exports.sum();
				
			});
			
			$("body").on('click', '.add', function(){
				var num = $(this).prev("input").val();
				if(num >= 1){
					$(this).prev("input").attr('value',parseInt(num)+1);
					var present_price = $(this).parent("td").prev("td").find(".present_price").text();
					var money = (parseInt(num)+1)*present_price;
					
					$(this).parent("td").next("td").find(".money").text(money);
					$(this).parent("td").parent("tr").find(".product").attr('data-price', money);
				}else{
					return false;
				}
				module.exports.sum();
			});
			
		},
		
		//选中所有
		checkall:function(){
			$("body").on("click",".all",function(){
				var is = $("input[name='all']").is(':checked');
				if(is){
					$("table").find(".product").prop('checked', true);
				}else{
					$("table").find(".product").prop('checked', false);
				}
				module.exports.sum();
			})
			
		},
		
		//选中一个
		checkone:function(){
			$("body").on("click", ".product", function(){
				var is = $("input[class='product']").is(':checked');
				if(is){
					var money = $(this).parent().parent("tr").find(".money").text();
					money = parseInt(money);
				}
				
				module.exports.sum();
			})
			
		},
		
		del:function(){
			$("body").on("click", ".del", function(){
				$(this).parent().parent("tr").remove();
				
				var id = $(this).parent().prev("input").attr("data-product-id");
				var special_id = $(this).parent().prev("input").attr("data-special-id");
				module.exports.delproduct(id,special_id);
				
				module.exports.sum();
			})
		},
		
		
		//localstorage删除该数据
		delproduct:function(id,special_id){  
	        var ShoppingCart = localStorage.getItem("drink");  
	        var productlist = storage.deserialize( ShoppingCart ).items;  
	        for(var i in productlist){  
	            if(productlist[i].product_id==id && productlist[i].special_id==special_id){  
	            	productlist.splice(i,1);
					localStorage.setItem( "drink", storage.serialize( {"items":productlist} ) );
	            }  
	        }  
	        
	        
	    }, 
		
		//计算总价格
		sum:function(){
			$(function(){ 
				var s = 0;
				var i = 0
				$("tbody").siblings().each(function(k, v){
					if($(v).find("input[class='product']").is(':checked')){
						s += parseFloat($(v).find("input[class='product']").attr("data-price"));
						i++;
					}
				}); 
				$("#price").text(s.toFixed(2));
				$(".product_num").text(i);
				
			});
			
		},
		
		
		submit:function(){
			$("#submit").click(function(){
				var name = $("input[name='name']").val();
				var tel = $("input[name='tel']").val();
				var address = $("input[name='address']").val();
				var sum_price = $("#price").text();
				var delivery_type = $('#delivery_type option:selected').val();
				if(!name){
					$(".message").text("请输入联系人姓名");
					module.exports.msg("请输入联系人姓名");
					return false;
				}
				if(!tel){
					$(".message").text("请输入联系电话");
					module.exports.msg("请输入联系电话");
					return false;
				}
				
				var delivery_type_val = $("#delivery_type").val();
				if(delivery_type_val == 0){
					if(!address){
						$(".message").text("请输入联系地址");
						module.exports.msg("请输入联系地址");
						return false;
					}
				}
				
				//获取选中商品
				var ShoppingCart = localStorage.getItem("drink");  
		        var productlist = storage.deserialize( ShoppingCart ).items;  
		        var arr = new Array();
		        $("tbody").siblings().each(function(k, v){
					if($(v).find("input[class='product']").is(':checked')){
						productlist[k].num = $(v).find(".add").prev("input").val();
						arr.push(productlist[k]);
					}
				});
				$.post("/drink/submit",{name:name,tel:tel,address:address,sum_price:sum_price,delivery_type:delivery_type,arr:arr},function(data){
					$(".page-bg").removeClass("act");
                    $(".popup-del").removeClass("act");
                    $(".popup-info").removeClass("act");
					if(data.status == 0){
						var order_id = data.data.order_id;
						if(order_id){
							//生成订单之后删除localstorage中该条数据
							var ShoppingCart = localStorage.getItem("drink");  
					        var productlist = storage.deserialize( ShoppingCart ).items; 
							$("tbody").siblings().each(function(k, v){
								if($(v).find("input[class='product']").is(':checked')){
									$(v).parent("tr").remove();
									module.exports.delproduct(productlist[k].product_id,productlist[k].special_id);
								}
								
							});
							window.location.href="/drink/pay?order_id="+order_id;
						}
						
					}
					else{
						if(data.data.code == -2){
							module.exports.show_weixin_box();
						}
						else{
							
							module.exports.msg(data.msg);
						}
					}
				})
			})
		},
		
		// 显示微信登录框
	    show_weixin_box:function(){
	        $.get('/passport/get_wechat_token', function(data){
	          var state = data.data;
	          $("#weixin_QR").attr("src","/passport/wechat_login_QR?state=" + state);
	          $('.popup-login').removeClass('act');
	          $('#weixin_box').addClass('act');
	          setInterval(function(){
	            is_wechat_login(state)
	          }, 2500);
	        })
	        
	        var is_wechat_login = function(state){
	          $.get('/passport/is_wechat_login', {state: state}, function(response){
	            if(response.status == 0){
	              window.location.href="/usercenter/user";
	            }
	          })
	        };
	        
	    },
		
	    
	    pay_status:function(){
			var intval;
			intval = setInterval(function(){
				$.post('/drink/status', {order_id:new_order_id}, function(data){
					if(data.status != 0){
						console.log(data.msg);
						return false;
					}
					if(data.data.status == 1){
						clearInterval(intval);
						$('#pay img').attr('src', staticUrl+'/www/images/pay_success.jpg');
						$('#pay .text').text('支付成功');
					}
				})
			}, 1000);
		},
	    
		post:function(){
			$("#delivery_type").change(function(){
				var val = $(this).val();
				if(val == 0){
					$("#address").show();
					$(this).next("P").find("span").text("30");
				}else if(val == 1){
					$("#address").hide();
					$(this).next("P").find("span").text("0");
				}
				$(".message").hide();
			});
		},
		
		//打开弹窗
		open:function(){
			$('.buy').click(function(){
				var num = $("#num").val();
				$("input[name='num']").val(num);
				$('#open').attr('class','popup-bespeak act');
				$('#bg').attr('class','page-bg act');
			})
			$('.close').click(function(){
				$('#open').attr('class','popup-bespeak');
				$('#bg').attr('class','page-bg');
			})
		},

		_addToCart: function(values) {
			  var cart = storage.getSessionStorage("drink");
			  if(!cart){
				  cart = drinkStorage;
				  var items = cart.items;
				  items.push( values );
				  storage.setSessionStorage( "drink", storage.serialize( {"items":items}) );
				  console.log(storage.getSessionStorage("drink"));
				  var length = 1;
			  }else{
				  var cartObject = storage.deserialize( cart );
				  var cartCopy = cartObject;
			  	  var items = cartCopy.items;
				  items.push( values );
				  storage.setSessionStorage( "drink", storage.serialize( {"items":items} ) );
				  console.log(storage.getSessionStorage("drink"));
				  var length = cartObject.items.length;
				  
			  }
			      $("#count").text(length);
			      
			},
		
		add_car:function(){
			$('.buy').click(function(){
				$(".car").next("div").addClass("act");
				var num = $("#num").val();
				var special_id = $(".norms-cont").find(".act").attr("data-id");
				if(!special_id){
					special_id = 0;
				}
				module.exports._addToCart({
					  product_id: id,
					  num: num,
					  special_id: special_id
					});
				
//				var act = info.push({'name':'zack','age':30,'gender':'male'});
//				alert(act);
//	    		drinkStorage = {
//	    		    'product_id': id,
//	    		    'num': 3,
//	    		};
//	    		storage.setSessionStorage('drink', drinkStorage);
//	    		alert(storage.getSessionStorage);
//				drinkStorage.push({'name':'zack','age':30,'gender':'male'});
			})
		},
		
	
		
		//预定
		buy:function(){
			$('#sure').click(function(){
				var id = $('#info_id').attr('data');
				var img = $('#info_id').attr('img');
				var title = $('#title').attr('data');
				var price = $('#price').attr('data');
				var special_id = $(".norms-cont").find(".act").attr("data-id");
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
				var num = $('input[name="num"]').val();
				if(num <= 0){
					module.exports.msg('数量必须大于等于1');
					return false;
				}
				var post_method = $('#post_method').val();
				if(post_method == ''){
					module.exports.msg('必须选择一种配送方式');
					return false;
				}
				var data = {'id':id,'title':title,'price':price,'count':num,'img':img,'user_name':user_name,'user_addr':user_addr,'user_mobile':user_mobile,'post_method':post_method,'special_id':special_id}
				$.post('/drink/order',data,function(data){
					if(data == 1){
						module.exports.msg('预定成功');
						$('#open').attr('class','popup-bespeak');
						$('#bg').attr('class','page-bg');
					}else{
						module.exports.msg(data);
					}
					
				})
			})
		},
		msg:function(msg){
			var d = dialog({
				title:"提示",
				content:msg,
				cancelValue:"确定",
				cancel:function(){},
			})
			d.width(320);
			d.showModal();
		},
		
		login_msg:function(msg){
			var d = dialog({
				title:"提示",
				content:msg,
				okValue: '确定',
	            ok: function () {
	            	$(".page-bg").addClass("act");
	            	$("#weixin_box").addClass("act");
					module.exports.show_weixin_box();
	            }
			})
			d.width(320);
			d.showModal();
		}
		
	}
})