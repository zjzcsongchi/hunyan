/**
 * PC端大屏祝福滚动
 * 
 */
define(function(require, exports, module){
	require('fall_jquery');
	require('cake_up');
	module.exports = {
		load:function(){
			$(function(){
				 var _box =$('#box');
		        /* 滚动效果js*/
				    $(".list1 li:nth-child(2n)").css("margin-right", "0");
				    /*右下角冒花效果*/
				    $(".line").slideUp();

		        var _box = $('#box dl');
		        var _interval = 1000; //默认刷新间隔时间4秒
		        var update_comment = function(){
		        	var last_id = $('#last_id').val();
		        	var flower_last_id = $('#flower_last_id').val();
		        	var cake_last_id = $('#cake_last_id').val();
		          $.ajax({
		            type: 'POST',
		            url: '/bless/update_cake_comment',
		            data: {
		              'dinner_id': dinner_id,
		              'last_id': $('#last_id').val(),
		              'flower_last_id' : flower_last_id,
		              'cake_last_id' : cake_last_id
		            },
		            dataType: 'json',
		            beforeSend: function() {
		              
		            },
		            success: function(response) {
		              if(response.status == 0){
		                last_id = response.data.last_id;
		                var dd = "";
		                var list = response.data.comment;
		                if(list){
		                  $.each(list, function(k, v){
		                    dd += "<dd style='height:0px;'>";
		                    dd +=   "<img src='" + v['head_img'] + "'>";
		                    dd +=   "<div class='cont'>";
		                    dd +=      "<p class='name'>" + v['name'];
		                    dd +=        "<span class='r'>"+ v['time'] +"</span>";
		                    dd +=      "</p>";
		                    dd +=      "<p class='text'>"+ v['content'] +"</p>";
		                    dd +=   "</div>";
		                    dd += "</dd>";
		                  });
		                  
		                  var _box =$('#box');
		                  $(dd).prependTo('#box dl');
		                  var _first=$('#box dl dd:first');
		                  _first.animate({height: '+115px'}, "slow");
		                  var _last=$('#box dl dd:last');
		                  if($('#box dl dd').length > 4){
		                    _last.remove();
		                  }
		                }
		                
		                //共收到的祝福
		                response.data.count && $('#count').text(response.data.count);
		  	            //共收到的点赞
		                $('#zan_count').text(response.data.bless_info.zan_count);
		  	            //共收到的鲜花
		  	            $('#flower_count_true').text(response.data.bless_info.flower_count);
		  	            //更新最新评论的id
		  	            response.data.last_id && $('#last_id').val(response.data.last_id);
		  	            //更新cake_id
		  	            
		  	            //更新蛋糕数量
		  	            var length = response.data.cake_count.length;
		  	            for(var k=0; k<length; k++){
		  	            	if(response.data.cake_count[k]){
		  	            		$("#admin_"+response.data.cake_count[k].admin_id).children("p").text(response.data.cake_count[k].all_num);
		  	            	}
	  	            	
		  	            }
		  	            
		                //更新蛋糕榜
		                if(response.data.cake_rank){
		                	$('#cake_rank').empty();
		                	var cake_rank = '';
		                	$.each(response.data.cake_rank, function(k, v){
		                		if(k>4){
		                			cake_rank += '<li id="admin_'+v.id+'" style="display:none">';
		                		}else{
		                			cake_rank += '<li id="admin_'+v.id+'">';
		                		}
		                		
		                		if(k == 0){
		                			cake_rank += '<i class="first"></i>';
		                		}else if(k == 1){
		                			cake_rank += '<i class="second"></i>';
		                		}else if(k == 2){
		                			cake_rank += '<i class="third"></i>';
		                		}
		                		else{
		                			cake_rank += '<i class="text"></i>';
		                		}
		                		cake_rank += '<img src="'+v.head_img+'" >';
		                		cake_rank += '<span>'+v.fullname+'</span>';
		                		cake_rank += '<p>'+v.all_num+'</p>';
		                		cake_rank += '</li>';
		                	})
		                	
		                	$('#cake_rank').html(cake_rank);
		                }
		                

		                //送花效果
	                      if(response.data.flower){
	                        var flower = response.data.flower;
	                        var a = {name:flower.name, head_img:flower.head_img};
	                        var b = flower.num;
	                        $('#flower_last_id').val(flower.last_id);
	                        createSnow(a, b);
	                        $('#tip_last').remove();
	                        var tip_html = '<li id="tip_last"><i></i>'+flower.name+'送出了'+flower.num+'束鲜花</li>';
	                        $(tip_html).appendTo('#tip_info')
	                      }
		                
		              }
		            },
		            complete: function() { //生成分页条
		              
		            },
		            error: function() {
		              console.log("数据加载失败");
		            }
		          });
		        };
		        setInterval(update_comment, _interval);
		        
		        
		        
		        var cake_interval = 9000;
		        var update_cake = function(){

		        	var last_id = $('#last_id').val();
		        	var flower_last_id = $('#flower_last_id').val();
		        	var cake_last_id = $('#cake_last_id').val();
		          $.ajax({
		            type: 'POST',
		            url: '/bless/update_cake_comment',
		            data: {
		              'dinner_id': dinner_id,
		              'last_id': $('#last_id').val(),
		              'flower_last_id' : flower_last_id,
		              'cake_last_id' : cake_last_id
		            },
		            dataType: 'json',
		            beforeSend: function() {
		              
		            },
		            success: function(response) {
		              if(response.status == 0){
		                last_id = response.data.last_id;
		                var dd = "";
		  	            //更新cake_id
		  	            if(!response.data.cake){
		  	            	$('.get-cake').remove();
		  	            }
		  	            
		  	            if(response.data.cake){
		  	            	response.data.cake.last_id && $('#cake_last_id').val(response.data.cake.last_id);
		  	            }
		  	            
		  	            //更新蛋糕数量
		  	            var length = response.data.cake_count.length;
		  	            for(var k=0; k<length; k++){
		  	            	if(response.data.cake_count[k]){
		  	            		$("#admin_"+response.data.cake_count[k].admin_id).children("p").text(response.data.cake_count[k].all_num);
		  	            	}
	  	            	
		  	            }
		  	            
		  	            //蛋糕div生成
		  	            if(response.data.cake){
		  	            	if(response.data.cake.num>0){
		  	            		var width_per = parseFloat($(".main").css("width"));
		  	            		var all_width = parseFloat($(window).width());
		  	            		var off_width = parseFloat((all_width-width_per)/2);
		  	            		var min = 800, max = $(window).height()-200, left_min = parseFloat(parseFloat(off_width)+100), left_max = parseFloat(parseFloat(all_width-off_width)-100);
		  	            		html = '';
		  	            		var admin_name = response.data.cake.admin_name;
		  	            		var name = response.data.cake.name;
		  	            		var head_img = response.data.cake.head_img;
		  	            		var admin_head_img = response.data.cake.admin_head_img;
		  	            		for(j = 0; j<response.data.cake.num; j++){
		  	            			var left = (Math.random() * (left_max - left_min) + left_min);
		  	            			html += '<div class="get-cake" style="left:'+left+'px"><i></i><img src="'+head_img+'" class="img1"><p><span class="t1">'+name+'</span><span class="t-color">赠送</span><span class="t1">'+admin_name+'</span></p><img src="'+admin_head_img+'" class="img2"></div>';
		  	            		}
		  	            		var len = $(window).height()-200;
			  	  	            $(".cake").html(html);
			  	  	            for(i = 0;i<j;i++){
			  	  	            	
			  	  	            	var padding_left = (Math.random() * (left_max - left_min) + left_min);
			  	  	            	var ani = anime({
			  	  		                targets: document.querySelectorAll('.get-cake')[i],
			  	  		                translateY: [
			  	  		                    0,
			  	  		                    -(Math.random() * (max - min) + min)
			  	  		                ],
			  	  		                translateX:Math.random()*100+'px',
			  	  		                loop: false,
			  	  		                easing: 'easeOutElastic',
			  	  		                duration: 30000,
			  	  		                complete:function(){
			  	  		                	if($('.get-cake')[i]){
			  	  		                		$('.get-cake')[i].remove();
			  	  		                	}
			  	  		                	
			  	  		                }
			  	  		            });
			  	  	            }
		  	            	}
		  	            }
		                
		              }
		            },
		            complete: function() { //生成分页条
		              
		            },
		            error: function() {
		              console.log("数据加载失败");
		            }
		          });
		        
		        };
		        
		        setInterval(update_cake, cake_interval);
		        
		      });
			
			
			
		}
		//轮播效果
	}
})