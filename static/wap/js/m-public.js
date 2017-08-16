//public
define(function(require, exports, module){
	
	require('fastclick');
	var attachFastClick  = Origami.fastclick;
	module.exports = {
			load:function(){
				attachFastClick (document.body);
				
				$(".footer .first-list").on('click', function() {
					$(this).children(".second-list").toggleClass("act");
					$(this).siblings("div").children(".second-list").removeClass("act");
				});
				$(".footer .first-list").hover(function() {
					return true;
				}, function() {
					$(".footer .first-list .second-list").removeClass("act");
				});
				$(".coment-list .but").on('click', function() {
					$(this).parent().next(".coment-cont").toggleClass("act");
				});
				$(".bainian").click(function(){
					window.location.href="/news/index";
				})
				
			}
	}
})
