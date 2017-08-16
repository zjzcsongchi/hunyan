/**
 * 祝福页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	require('dialog');
	require('dropload');
	require('swiper');
	module.exports = {
		load:function(){
			var swiper = new Swiper('.wap-banner', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                autoplay:2500
            });

            var myVideo=document.getElementById("media");
            $(".video-cont i").click(function() {
                $(this).removeClass("act");
                $(".video-cont img").removeClass("act");
                myVideo.play();
            });
		},
		
		load_more:function(){
			$('.bless_lists').dropload({
				scrollArea : window,
				threshold:50,
				loadDownFn:function(dl){
					var page = $.trim($('input[name=page]').val());
					var class_id = $.trim($('input[name=class_id]').val());
					if(class_id){
						var url = '/news/load_more?page='+page+'&class_id='+class_id;
					}else{
						var url = '/news/load_more?page='+page;
					}
					$('input[name=page]').val(parseInt(page)+1);
					$.ajax({
						type:'get',
						url:url,
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
				}
			})
		}
	
	}
	
})