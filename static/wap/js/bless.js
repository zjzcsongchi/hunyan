/**
 * 祝福页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	require('dialog');
	require('dropload');
	require('fastclick');
	var my_dialog = require('my_dialog');
	var attachFastClick  = Origami.fastclick;
	module.exports = {
	  custom_alert:function(msg){
	    $(".page-bg").addClass("act");
	    $(".custom .text").html(msg);
      $(".custom").addClass("act");
      return
	  },
	  
		load:function(){
			attachFastClick(document.body);
		  $(function(){
          $(".popup-message .close , .confirm").click(function() {
              $(".page-bg").removeClass("act");
              $(".popup-message").removeClass("act");
          });

          $(".now-name .to-edit,.edit-cont .but").click(function() {
              $(".now-name").toggleClass("act");
              $(".edit-cont").toggleClass("act");
              var realname = $('.edit-cont input').val();
              if(realname != ''){
                $('.now-name span').text(realname);
              }
          });

      });
  			
		},
		submit:function(){
        $(".submit").on('click', function(){
            var content = $.trim($('#textareaValidate').val());
            var dinner_id = $.trim($('input[name=dinner_id]').val());
            var realname = $.trim($('input[name=realname]').val());
            if(!content){
              $(".page-bg").addClass("act");
              $(".error").addClass("act");
            }
            else{
              $.ajax({
                type:'post',
                url:'/bless/submit',
                data: {
                  dinner_id: dinner_id,
                  content: content,
                  realname: realname
                },
                dataType:'html',
                success:function(res){
                  if(res.toString().indexOf('{"status":-1') !== -1){
                    module.exports.custom_alert(JSON.parse(res.toString()).msg);
                  }else{
                    $(".page-bg").addClass("act");
                    $(".succes").addClass("act");
                    $('.coment-list').prepend(res);
                    $('#textareaValidate').val('');
                  }

                },
                error:function(){

                }
              })
           }
        })
    },
		load_more:function(){
  			$('.more_bless').on('click', function(){
    			  var dinner_id = $.trim($('input[name=dinner_id]').val());
            var offset = $.trim($('input[name=offset]').val());
      		  $.ajax({
                type:'get',
                url:'/bless/load_more/'+dinner_id+'/'+offset,
                dataType:'html',
                success:function(data){
                  if(data == 'nodata'){
                    $('.more_bless').html('暂无更多数据');
                  }else{
                    $('input[name=offset]').val(parseInt(offset)+1);
                    $('.coment-list').append(data);
                  }
                },
                error:function(){

                }
            })
  			});
		},
		thumb_up:function(){
        $('.zan_count').on('click', function(){
            if($('.zan_count p').hasClass('act')){
              module.exports.custom_alert('请勿重复操作');
              return
            }
            $('.count p').addClass("act");

            var dinner_id = $.trim($('input[name=dinner_id]').val());
            var offset = $.trim($('input[name=offset]').val());
            $.ajax({
                type:'post',
                url:'/bless/thumb_up/'+dinner_id,
                dataType:'json',
                success:function(res){
                  if(res.status == 0){
                    $('.count o').html( parseInt($('.count o').html())+1 );
                  }else{
                    module.exports.custom_alert(res.msg);
                    return
                  }
                },
                error:function(){
                  
                }
            })
        });
    },
    send_flower: function(){
      _flower_count = $('#send_flower_count');
      $('.flower-cont .but1').on('click', function(){
        if(_flower_count.val()*1 === 1){
          module.exports.custom_alert('我就问你是不是想搞事情 :)');
          return
        }
        _flower_count.val( _flower_count.val()*1-1 );
      });
      
      $('.flower-cont .but2').on('click', function(){
        if(_flower_count.val()*1 > 29){
          module.exports.custom_alert('太多了~ 每次最多送花30束 :)');
          return
        }
        _flower_count.val( _flower_count.val()*1+1 );
      });
      
      $('#send_flower').on('click', function(){
        if(_flower_count.val()%1 !== 0 ){
          module.exports.custom_alert('我就问你是不是想搞事情 :)');
          return
        }
        _flower_count = $('#send_flower_count');
        var dinner_id = $.trim($('input[name=dinner_id]').val());
        var flower_count = parseInt(_flower_count.val());
        
        if(_flower_count.val()*1 < 1){
          module.exports.custom_alert('我就问你是不是想搞事情 :)');
          return
        }
        
        if(_flower_count.val()*1 > 29){
          module.exports.custom_alert('太多了~ 每次最多送花30束 :)');
          return
        }

        $.ajax({
            type:'post',
            url:'/bless/send_flower/'+dinner_id+'/'+flower_count,
            dataType:'json',
            success:function(data){
              if(data.status == 0){
                module.exports.custom_alert('发送成功 :)');
                $('#flower_count').html($('#flower_count').html()*1 + flower_count*1);
                $('#remain_available_flower').html($('#remain_available_flower').html()*1 - flower_count);
                
                _flower_count.val( 1 );
              }else{
                module.exports.custom_alert(data.msg);
              }
            },
            error:function(){
              
            }
        })
      });

    },
    //送蛋糕
    send_cake: function(){
      var admin_id = 0;
      $(".birthday-cont .but").click(function() {
        $(".page-bg").addClass("act");
        $(".popup-birthday").addClass("act");
        admin_id = $(this).data('id');
      });
      //数量减
      $('#but_reduce').click(function(){
        if(parseInt($('#cake_count').val()) > 1){
          $('#cake_count').val(parseInt($('#cake_count').val()) - 1);
        }else{
          return false;
        }
      })
      //数量加
      $('#but_plus').click(function(){
        if(parseInt($('#cake_count').val()) > 30){
          alert('蛋糕数不能超过30！');
        }else{
          $('#cake_count').val(parseInt($('#cake_count').val()) + 1);
        }
      })
      //关闭
      $('.popup-birthday .close').click(function(){
        $(".page-bg").removeClass("act");
        $(".popup-birthday").removeClass("act");
      })
        //送蛋糕
        $('#send_cake').on('click', function(){
          $.ajax({
            type:'get',
            url:'/bless/send_cake',
            data:{dinner_id:dinner_id,admin_id:admin_id,cake_count:parseInt($('#cake_count').val())},
            dataType:'json',
            success:function(data){
              if(data.status == 0){
                $('#warning').text('赠送成功');
                $(".page-bg").removeClass("act");
                $(".popup-birthday").removeClass("act");
                  window.location.reload();
              }else{
                $('#warning').text(data.msg);
              }
            },
            error:function(){
              
            }
          })
          
        })
      
    },
    
    //对祝福进行评论
    send_comment: function(){
      $(document).on('click', '.send_comment', function(){
        _this = $(this);
        var blessid = parseInt(_this.attr('blessid'));
        var content = _this.prev().val(); // .comment_content input框
        if(!content){
          module.exports.custom_alert('请输入评论后再发送 :)');
          return
        }
        
        $.ajax({
          type:'post',
          url:'/bless/send_comment',
          data: {
            bless_id: blessid,
            content: content
          },
          dataType:'json',
          success:function(res){
            if(res.status == 0){
              $(".page-bg").addClass("act");
              $(".succes").addClass("act");
              $(".popup-message .close, .popup-message .confirm").on('click', function(){
                window.location.reload();
              })

            }else{
               module.exports.custom_alert(res.msg);
            }
          },
          error:function(){
            
          }
        })
      });

    },
    //查看祝福的评论
    view_comment: function(){
      $(document).on('click', '.coment-list .coment', function(){
        _this = $(this);
        if(_this.attr('is_had_view') == 1){
          _this.parent().parent().children(".detail-cont").toggleClass("act");
          return
        }
        var blessid = parseInt(_this.parent().next().next().attr('blessid'));
        $.ajax({
          type:'get',
          url:'/bless/view_comment',
          data: {
            bless_id: blessid,
          },
          dataType:'html',
          success:function(res){
            _this.attr('is_had_view', 1); 
            if(res == 'nodata'){
              _this.parent().parent().children(".detail-cont").toggleClass("act");
            }else{
              _this.parent().next().next().append(res);
              _this.parent().parent().children(".detail-cont").toggleClass("act");
            }
          },
          error:function(){
            
          }
        })
      });
    },
    //查看更多对祝福的评论
    view_more_comment: function(){
      //$(this).toggleClass("act");
      $(document).on('click', '.coment-list .click-but', function(){
        _this = $(this);
        var blessid = _this.attr('blessid');
        
        $.ajax({
          type:'get',
          url:'/bless/view_more_comment',
          data: {
            bless_id: blessid,
          },
          dataType:'html',
          success:function(res){
            if(res == 'nodata'){
              
            }else{
              _this.before(res);
              _this.html('');
            }
          },
          error:function(){
          }
        })
      });
    },
    //给祝福点赞
    zan_bless: function(){
      $(document).on('click', '.cont >.con >.laud', function(){
        _this = $(this);
        if(_this.hasClass('act')){
          module.exports.custom_alert('请勿重复操作');
          return
        } 
        var blessid = parseInt(_this.parent().next().next().attr('blessid'));
        $.ajax({
          type:'post',
          url:'/bless/zan_bless',
          data: {
            bless_id: blessid,
          },
          dataType:'json',
          success:function(res){
            if(res.status == 0){
            	var num = _this.children('span').text();
            	var total = parseInt(num) +1;
              _this.html('<i>+1</i><span>'+ total +'</span>');
              _this.addClass("act");
              _this.addClass("active");
            }else{
              //_this.addClass("act");
              module.exports.custom_alert('您已经对此点过赞，请勿重复操作');
            }
          },
          error:function(){
          }
        })
      });
    },
    //给评论点赞
    zan_comment: function(){
      //$(this).toggleClass("act");
      $(document).on('click', '.second-list .laud', function(){
        _this = $(this);
        if(_this.hasClass('act')){
            module.exports.custom_alert('请勿重复操作');
            return false;
        }
        var bless_comment_id = _this.attr('bless_comment_id');
        $.ajax({
          type:'post',
          url:'/bless/zan_comment',
          data: {
            bless_comment_id: bless_comment_id,
          },
          dataType:'json',
          success:function(res){
            if(res.status == 0){
            	var num = _this.children('span').text();
            	var total = parseInt(num) +1;
              _this.html('<i>+1</i><span>'+ total +'</span>');
              _this.addClass("act");
              _this.addClass("active");
            }else{
              module.exports.custom_alert('您已经对此点过赞，请勿重复操作');
            }
          },
          error:function(){
          }
        })
      });
    },
    //评论字数限制
    comment_length_limit: function() {
      $('#textareaValidate').on('keyup', function(){

        if($(this).val().length>=27){
          $('#length_tip').show();
        }
        else{
          $('#length_tip').hide();
        }
      })
    }
	}
})