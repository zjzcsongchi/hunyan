/**
 * 祝福页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	require('swiper');
	module.exports = {
		load:function(){
			$(".suspend-but").click(function() {
                $(".page-bg").addClass("act");
                $(".popup-destine").addClass("act");
            });
            $(".popup-destine .close").click(function() {
                $(".page-bg").removeClass("act");
                $(".popup-destine").removeClass("act");
            });

            var myVideo=document.getElementById("media");
            $(".venue-detail .video-cont").click(function() {
               $(".venue-detail .video-cont i").removeClass("act");
               $(".venue-detail .video-cont img").removeClass("act");
               myVideo.play();
            });

            $(".chose-list li").click(function(){
                $(".chose-list li.act").removeClass("act");
                $(this).addClass("act");
                $(".img-list.act").removeClass("act");
                $(".img-list").eq($(this).index()).addClass("act");
            });

            var swiper = new Swiper('.wap-banner1', {
                pagination: '.swiper-pagination1',
                paginationClickable: true,
                autoplay:5000
            });
            var swiper = new Swiper('.wap-banner2', {
                pagination: '.swiper-pagination2',
                paginationClickable: true,
                autoplay:5000
            });
		},
		load_more:function(){
			$('.more').click(function(){
				$(".more").text("没有更多了");
				var page = $(".more").attr('next_page');
				var venue_id = $("input[name='id']").val(); 
				$.ajax({
					type:'get',
					url:'/venue/load_more?next_page='+page+'&venue_id='+venue_id,
					dataType:'html',
					success:function(data){
						if(data == 'nodata'){
							$('.dropload-down').html('<div class="dropload-noData">暂无更多数据</div>');
							dl.lock('down');
							dl.noData(true);
						}else{
							$('.media-list').append(data);
							dl.resetload();
						}
					},
					error:function(){
						dl.resetload();
					}
				})
			})
		}
		
	}
	
})