/**
 * 祝福页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	require('media_swiper');
	module.exports = {
		load:function(){
			var swiper = new Swiper('.swiper-container1', {
	            pagination: false,
	            paginationClickable: true,
	            nextButton: '.swiper-button-next1',
	            prevButton: '.swiper-button-prev1',
	            spaceBetween: 30,
	            effect: 'fade',
	            autoplay:6000,
	        });

	            var swiper = new Swiper('.swiper-container2', {
	            pagination: false,
	            paginationClickable: true,
	            nextButton: '.swiper-button-next2',
	            prevButton: '.swiper-button-prev2',
	            spaceBetween: 30,
	            effect: 'fade',
	            autoplay:6000
	        });
	            
            $(".nav li").find("a").click(function(){
            	$(this).css('color', '#ffb700');
            	$(this).parent().siblings("li").children("a").css('color', '#272727');
            })
		},
		
		change_bainian:function(){
			$("#bainian li").click(function(){
				var class_id = $(this).attr("data-id");
				
				$.post("/news/home", {class_id:class_id}, function(data){
					if(data !="nodata"){
						$(".bainian_list").html(data);
					}else{
						$(".bainian_list").html("");
					}
					module.exports.load();
				})
			})
		},
		change_milan:function(){
			$("#milan li").click(function(){
				var class_id = $(this).attr("data-id");
				
				$.post("/news/milan", {class_id:class_id}, function(data){
					if(data !="nodata"){
						$(".milan_list").html(data);
					}else{
						$(".milan_list").html("");
					}
					module.exports.load();
				})
			})
		}
		
	
	}
	
})