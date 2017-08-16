/**
 * 首页js
 * @author chaokai@gz-zc.cn
 */
define(function(require, exports, module){
  
  var public = require('public');
  require('swiper');
  module.exports = {
      load:function(){
        public.load();
        
        $(function(){
            $(".venue-list li:nth-child(5n)").css("margin-right", "0");
            $(".media-list li:nth-child(2n)").css("float", "right");
            $(window).scroll(function(){
                if($(window).scrollTop() > 677){
                     $(".header").addClass("show");
                }else{
                    $(".header.show").removeClass("show"); 
                }
            });

            $(".venue-cont .venue-chose li").click(function(){
                $(".venue-cont .venue-chose li.act").removeClass("act");
                $(this).addClass("act");
                $(".venue-cont .venue-detail.act").removeClass("act");
                $(".venue-cont .venue-detail").eq($(this).index()).addClass("act");
            });

            //新闻资讯切换
            $(".chose-list .recommend").on('click', function(){
              $(".chose-list .recommend").addClass("act");
              $(".chose-list .recent").removeClass("act");
              $(".recommend-news").show();
              $(".recent-news").hide();
            });
            
            $(".chose-list .recent").on('click', function(){
              $(".chose-list .recent").addClass("act");
              $(".chose-list .recommend").removeClass("act");
              $(".recent-news").show();
              $(".recommend-news").hide();
            });
            
            //新闻详情跳转
            $(".media-list li").on('click', function(){
              window.location.href="/news/detail/" + $(this).attr('news_id');
            });
            
            //酒水跳转
            $(".drink li").on('click', function(){
              window.location.href="/drink/detail?id=" + $(this).attr('drink_id');
            });
            
        });
        
      },
      
      switch_day: function(){
        $(".index-nav a").on('click', function(){
          $(".index-nav a").each(function(){
            $(this).removeClass('act');
          })
          $(this).addClass("act");
          
          var date = $(this).data("date");
          $.get("/home/switch_day",{date: date}, function(res){
            if(res == 'nodata'){
              $(".banquet-list").empty();
            }else{
              $(".banquet-list").empty();
              $(".banquet-list").append(res);
            }
          });
        })
      }
  }
})