$(function(){
	$(".footer .first-list").on('click', function() {
		$(this).children(".second-list").toggleClass("act");
		$(this).siblings("div").children(".second-list").removeClass("act");
	});
	$(".footer .first-list").hover(function() {
		return true;
	}, function() {
		$(".footer .first-list .second-list").removeClass("act");
	});
});