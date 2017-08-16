/**
 * 祝福页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	require('dialog');
	require('dropload');
	require('swiper');
	require('weui');
	module.exports = {
		load:function(){
			$(function(){
				$(".wall-list").find(".dropload-down").remove();
				
	        	$("#datePicker").click(function(){
	        		weui.datePicker({
	            	    start: 2016,
	            	    end: 2020,
	            	    defaultValue: [2016, 1, 1],
	            	    onChange: function(result){
	            	        console.log(result);
	            	    },
	            	    onConfirm: function(result){
	            	    	var reg = new RegExp(",","g");//g,表示全部替换。
	            	    	var str = result.toString().replace(reg,"-");
	            	        $("#datePicker").attr("data-id", str);
	            	        $("#datePicker").text(str);
	            	        refresh();
	            	    },
	            	    id: 'datePicker'
	            	});
	        	})
	        	
	        	
	        	$("#singleLinePicker").click(function(){
					var obj = [];
					for(var i=0;i<count;i++){
						obj[i] = {label: venue_name[i]['name'], value: venue_name[i]['id']};
					}
	            	
	        		// 单列picker
	        		weui.picker(
	        				obj, 
	        		{
	        		   className: 'custom-classname',
	        		   defaultValue: [3],
	        		   onChange: function (result) {
	        		       console.log(result)
	        		   },
	        		   onConfirm: function (result) {
	            		   $("#singleLinePicker").next().next("input").val(result);
	            		   $("#singleLinePicker").attr("data-id", result);
	            		   $("#singleLinePicker").text(venue_name[result-1]['name']);
	            		   refresh();
	        		       console.log(result)
	        		   },
	        		   id: 'singleLinePicker'
	        		});
	        	})
	        	
	        	$("#search").blur(function(){
					var keys = $(this).val();
					refresh();
	        	})
	        	
	        	function refresh(){
					var name = $("#search").val();
					var time= $("#datePicker").attr("data-id");
					var venue_name = $("input[name='venue']").val();
					$('input[name=page]').val("2");
					var page= 1;
					$.post("/wall/search",{name:name,time:time,venue:venue_name,page:page}, function(data){
						if(data != 'nodata'){
							$('.wall-list').html(data);
							$(".dropload-down").remove();
							module.exports.load_more();
						}else{
							$('.wall-list').html('');
						}
					})
	        	}
	        	
	        	
	            $(".banner input").focusin(function() {
	                $(this).parent().children(".icon").addClass("hiden");
	            });
	            $(".banner input").focusout(function() {
	                $(this).parent().children(".icon").removeClass("hiden");
	            });

	        });

		},
		
		load_more:function(){
			$('.mainfix').dropload({
				scrollArea : window,
//				autoLoad:false,
				threshold:50,
				loadDownFn:function(dl){
					var page = $.trim($('input[name=page]').val());
					var name = $("#search").val();
					var time= $("#datePicker").attr("data-id");
					var venue_name = $("input[name='venue']").val();
					var url = '/wall/search?page='+page+'&name='+name+'&time='+time+'&venue='+venue_name;
					$('input[name=page]').val(parseInt(page)+1);
					$.ajax({
						type:'get',
						url:url,
						dataType:'html',
						success:function(data){
							if(data == 'nodata'){
								$('.dropload-down').html('<div class="dropload-noData">暂无更多数据</div>');
								dl.lock();
								dl.noData(true);
							}else{
								$('.wall-list').append(data);
							}
							dl.resetload();
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