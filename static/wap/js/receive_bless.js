/**
 * 场馆页js
 * @author louhang@gz-zc.cn
 */
define(function(require, exports, module){
	var page = 1;
	var public = require('public');
	require('dialog');
	module.exports = {
		  get_more_bless: function(){
		    $('.more').on('click', function(e){
          e.preventDefault()
          $.ajax({
            data:{page:page},
            type:'get',
            url:'/usercenter/get_more_bless',
            dataType:'json',
            success:function(response){
              if(response.status == 0){
                var li = "";
                
                $.each(response.data, function(index, data) {
                      li += "<li>";
                      li +=   "<img src='" + data['head_img'] +"'>";
                      li +=   "<p><span>" + data['nickname'] +"：</span>"+ data['content'] +"</p>"
                      li += "</li>";
                });
                $(".bless-lists").append(li);

              }else{
                 $('.more').html('暂无更多数据');
              }
              page ++;
            },
            error:function(){
              
            }
          })

        })
        
		    
		    
		  }

	}

})