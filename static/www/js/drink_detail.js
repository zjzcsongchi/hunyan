/**
 * 资讯页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	var public = require('public');
	var storage = require('storage');
//	var drinkStorage = storage.getSessionStorage('drink') || {"items":[]};
	var drinkStorage = localStorage.getItem('drink') || {"items":[]};
	require('animationfly');
//	localStorage.clear();
//	console.log(drinkStorage);
	module.exports = {
		load:function(){
		    public.load();
		    addLoadEvent(Focus());
            $(".venue-list li:nth-child(5n)").css("margin-right", "0");
            $(window).scroll(function(){
                if($(window).scrollTop() > 677){
                     $(".header").addClass("show");
                }else{
                    $(".header.show").removeClass("show"); 
                }
            });
       
            
            //酒水跳转
            $(".venue-list li").on('click', function(){
              window.location.href="/drink/detail?id=" + $(this).attr('data_id');
            });
            $(".norms-cont .list").click(function() {
                $(".norms-cont .list.act").removeClass("act");
                $(this).toggleClass("act");
                var price = $(".norms-cont").find(".act").attr("data-price");
                $("#price").text(price);
                $('#price').attr('data',price);
            });
            
        	var price = $(".norms-cont").find(".act").attr("data-price");
        	$("#price").text(price);
        	$('#price').attr('data',price);
        	
        	$(".close").click(function(event){
        	  event.stopPropagation();
        		$(this).parent("div").removeClass("act");
        	})
        	
        	  var cart = localStorage.getItem('drink');
			  if(!cart){
				  var length = 0;
			  }else{
				  var cartObject = storage.deserialize( cart );
				  var length = cartObject.items.length;
				  
			  }
			      $("#count").text(length);
        	
		},
		
		car_detail:function(){
			$(".right-menu").click(function(){
				window.location.href="/drink/car";
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

		//判断购物车中是否有该商品
		existproduct:function(id, special_id){  
	        var ShoppingCart = localStorage.getItem("drink");  
	        var productlist = storage.deserialize( ShoppingCart ).items;  
	        var result=false;  
	        for(var i in productlist){  
	            if(productlist[i].product_id==id && productlist[i].special_id==special_id){  
	                result = true;  
	            }  
	        }  
	        
	        
	        return result;  
	    },  
		
		_addToCart: function(values, img_url) {
			  var cart = localStorage.getItem("drink");
			  if(!cart){
				  cart = drinkStorage;
				  var items = cart.items;
				  items.push( values );
				  localStorage.setItem( "drink", storage.serialize( {"items":items}) );
				  var length = 1;
			  }else{
				  var exist = module.exports.existproduct(values.product_id, values.special_id);
				  
				  if(exist){
			        	module.exports.msg("该商品已经在购物车了");
			        	return false;
				  }
				  
				  var cartObject = storage.deserialize( cart );
				  var cartCopy = cartObject;
			  	  var items = cartCopy.items;
				  items.push( values );
				  localStorage.setItem( "drink", storage.serialize( {"items":items} ) );
				  var length = cartObject.items.length;
				  
			  }
			//加入购物车效果
        var offset = $('#end').offset(), flyer = $('<img class="u-flyer" src="'+img_url+'"/>');
        flyer.fly({
            start: {
                left: event.pageX,
                top: event.pageY-$(window).scrollTop()-15
            },
            end: {
                left: offset.left+12,
                top: ($(window).height()-200)/2+64,
                width: 20,
                height: 20
            }
        });
        $(".car").next("div").addClass("act");
			      $("#count").text(length);
			      
			},
		
		add_car:function(img_url){
			$('.buy').click(function(){
				
				var num = $("#num").val();
				var special_id = $(".norms-cont").find(".act").attr("data-id");
				if(!special_id){
					special_id = 0;
				}
				
				module.exports._addToCart({
					  product_id: id,
					  num: num,
					  special_id: special_id
					}, img_url);
				
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
				var data = {'id':id,'title':title,'price':price,'num':num,'img':img,'user_name':user_name,'user_addr':user_addr,'user_mobile':user_mobile,'post_method':post_method,'special_id':special_id}
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
		}
	}
})