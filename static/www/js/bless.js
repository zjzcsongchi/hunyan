/**
 * PC端大屏祝福滚动
 * 
 */
define(function(require, exports, module){
	require('fall_jquery');
	module.exports = {
		load:function(){
			
		  (function($){
          $.fn.extend({
              "slideUp":function(value){
                  
                  var docthis = this;
                  //默认参数
                  value=$.extend({
                       "li_h":"64",
                       "time":3500,
                       "movetime":1000
                  },value)
                  
                  //向上滑动动画
                  function autoani(){
                      $("li:first",docthis).animate({"margin-top":-value.li_h},value.movetime,function(){
                          $(this).css("margin-top",0).appendTo(".line");
                      })
                  }
                  
                  //自动间隔时间向上滑动
                  var anifun = setInterval(autoani,value.time);
                  
                  //悬停时停止滑动，离开时继续执行
                  $(docthis).children("li").hover(function(){
                      clearInterval(anifun);          //清除自动滑动动画
                  },function(){
                      anifun = setInterval(autoani,value.time);   //继续执行动画
                  })
              }   
          })
      })(jQuery)
		  
		  $(function(){
        /* 滚动效果js*/
		    $(".list1 li:nth-child(2n)").css("margin-right", "0");
		    /*右下角冒花效果*/
		    $(".line").slideUp();

        var _box = $('#box dl');
        var _interval = 2000; //默认刷新间隔时间3秒
        var update_comment = function(){
        	var last_id = $('#last_id').val();
        	var flower_last_id = $('#flower_last_id').val();
          $.ajax({
            type: 'POST',
            url: '/bless/update_comment',
            data: {
              'dinner_id': dinner_id,
              'last_id': $('#last_id').val(),
              'flower_last_id' : flower_last_id
            },
            dataType: 'json',
            beforeSend: function() {
              
            },
            success: function(response) {
              if(response.status == 0){
                last_id = response.data.id;
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
  	            $('#flower_count').text(response.data.bless_info.zan_count);
  	            //共收到的鲜花
  	            $('#flower_count_true').text(response.data.bless_info.flower_count);
  	            //更新最新评论的id
  	            response.data.last_id && $('#last_id').val(response.data.last_id);
  	            
  	            //更新祝福排行榜
  	            $('#bless_rank').empty();
  	            list = response.data.thumbup;
  	            var li = '';
                $.each(list, function(k, v){
                  li += "<li>";
                  li +=   "<i class='"+ (k == 0 ? 'first' : 'second') +"'></i>";
                  li +=   "<img src='"+ v.head_img +"'>";
                  li +=   "<span>"+ v.name +"</span>";
                  li +=   "<p>收到"+ v.zan_count +"个赞</p>";
                  li += "</li>";
                });
                $('#bless_rank').append(li);
                
                //更新鲜花榜
                if(response.data.flower_up){
                	$('#flower_rank').empty();
                	var flower_rank = '';
                	$.each(response.data.flower_up, function(k, v){
                		flower_rank += '<li>';
                		if(k == 0){
                			flower_rank += '<i class="first"></i>';
                		}else if(k == 1){
                			flower_rank += '<i class="second"></i>';
                		}else{
                			flower_rank += '<i class="third"></i>';
                		}
                		flower_rank += '<img src="'+v.head_img+'" >';
                		flower_rank += '<span>'+v.name+'</span>';
                		flower_rank += '<p>'+v.flower_num+'</p>';
                		flower_rank += '</li>';
                	})
                	
                	$('#flower_rank').html(flower_rank);
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
        
      });
		  
		}
		//轮播效果
	}
})