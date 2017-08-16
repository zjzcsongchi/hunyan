/**
 * 手机端 相册页面js
 * @author louhang@gz-zc.cn
 */
define(function(require, exports, module){
  var my_dialog = require('my_dialog');
  var wx = require('jweixin');
  var public = require('public');
  require('weui');
	module.exports = {
	    
	  //微信接口配置初始化
	  wxInitialize: function() {
	    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: wxConfig.appId, // 必填，公众号的唯一标识
        timestamp: wxConfig.timestamp, // 必填，生成签名的时间戳
        nonceStr: wxConfig.nonceStr,   // 必填，生成签名的随机串
        signature: wxConfig.signature,// 必填，签名，见附录1
        jsApiList: ['uploadImage', 'chooseImage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
      });
	  },
	  
	  //微信上BGM自动播放
    autoPlayMusic: function() {
      document.addEventListener("WeixinJSBridgeReady", function () {
          document.getElementById('media').play();
        }, false);
//        document.addEventListener('touchstart', function(){ 
//          document.getElementById('media').play();
//      }, false);
      
      var myVideo=document.getElementById("media");
      $(".audio_btn").click(function() {
          $(this).toggleClass("rotate");
          if($(".audio_btn").hasClass("rotate")){
              myVideo.play();
          }
          else{
             myVideo.pause(); 
          }
      });
    },
	    
		load:function(){
		  module.exports.wxInitialize();

		  $('.wxuploader').on('click', function(){
		    _this = $(this);
		    var count = 0;
		    var groupLists = [];
		    if(groupName = _this.data('group')){
		      _this.parentsUntil('.page').find('.wxuploader').each(function(){
		        if ($(this).data('group') == groupName) {
		          groupLists.push(this);
	            count ++ ;
		        }
		      })
		    } else {
		      count = 1;
		    }
		    
		    wx.chooseImage({
	        count: count, // 若未通过data-count指定上传图片张数，默认单张上传
	        sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
	        sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
	        success: function (res) {
            var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
            if (localIds.length && localIds.length === 1) {
              _this.attr('src', localIds[0]);
            } else if(localIds.length && localIds.length > 1) {
              $(groupLists).each(function(i){
                $(this).attr('src', localIds[i]);
              })
            }
           
            if (localIds.length === 1) {
              groupLists.push(_this);
            }
            
            var i = 0, length = groupLists.length;
            function upload() {
              _this = $(groupLists[i]);
              i++;
              if (_this.attr('src').toLowerCase().indexOf('wxlocalresource') == -1) {
                if (i < length) {
                  upload();
                }
                return true; 
              }
              wx.uploadImage({
                localId: _this.attr('src'),
                success: function (res) {
                  $.ajax({
                    type:'get',
                    url:'/h5album/downloadImgFromWx?serverId=' + res.serverId,
                    dataType:'json',
                    success:function(res){
                      if (res.status == 0) {
                        _this.siblings('input').val(res.data.url);
                      } else {
                        alert(res.msg);
                      }
                      
                      if (i < length) {
                        upload();
                      }
                    }
                  });
                  
                }
              });
            }
            upload();

	        }
	      });
		  });

    },

    	submit:function(){
    		$(".fl").click(function(){
    			var name = $("#name").val();
  			    var whos = $("#whos").val();
	  			var content = $("#content").val();
	  			var wall_num = $("#wall_num").val();
	  			if(!name){
	  				$("#name").focus();
	  				showDialog("请填写姓名","提示");
	  				return false;
	  			}
	  			$.post("/h5album/save_bless/"+host_id+"/"+template_id, {name:name, whos:whos,content:content, wall_num:wall_num}, function(data){
	  				if(data.status == 0){
	  					showDialog("操作成功!","提示");
	  					$(".weui-dialog__btn_primary").click(function(){
 							window.location.reload(); 
 						})
	  				}
	  			})
    		})
    	},
    
		saveAlbum:function(){
			$('.album-save').on('click', function(){
			  my_dialog.dialog('确定保存当前相册？', function(){
          $.ajax({
            type:'post',
            url:'/h5album/save_album',
            data: $("form").serialize(),
            dataType:'json',
            success:function(res){
              if (res.status == 0) {
                my_dialog.alert('保存成功，即将跳转到您的电子相册页面', function(){
                  window.location.href = '/h5album/display?id=' + res.data.id; 
                });
              } else {
                my_dialog.alert(res.msg);
              }
            }
          });
        })

      });
    },

    load2:function(postData){
      module.exports.wxInitialize();
      
      $('.wxuploader').on('click', function(){
        _this = $(this);
        var count = 0;
        var groupLists = [];
        if(groupName = _this.data('group')){
          _this.parentsUntil('.swiper-slide').find('.wxuploader').each(function(){
            if ($(this).data('group') == groupName) {
              groupLists.push(this);
              count ++ ;
            }
          })
        } else {
          count = 1;
        }
        
        wx.chooseImage({
          count: count, // 若未通过data-count指定上传图片张数，默认单张上传
          sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
          sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
          success: function (res) {
            var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
            if (localIds.length && localIds.length === 1) {
              _this.attr('src', localIds[0]);
            } else if(localIds.length && localIds.length > 1) {
              $(groupLists).each(function(i){
                $(this).attr('src', localIds[i]);
              })
            }
           
            if (localIds.length === 1) {
              groupLists.push(_this);
            }
            
            var i = 0, length = groupLists.length;
            function upload() {
              _this = $(groupLists[i]);
              i++;
              if (_this.attr('src').toLowerCase().indexOf('wxlocalresource') == -1) {
                if (i < length) {
                  upload();
                }
                return true; 
              }
              wx.uploadImage({
                localId: _this.attr('src'),
                success: function (res) {
                  $.ajax({
                    type:'get',
                    url:'/h5album/downloadImgFromWx?serverId=' + res.serverId,
                    dataType:'json',
                    success:function(res){
                      if (res.status == 0) {
                        _this.data('oss_url', res.data.url);
                      } else {
                        my_dialog.alert(res.msg);
                      }
                      
                      if (i < length) {
                        upload();
                      }
                    }
                  });
                  
                }
              });
            }
            upload();
          }
        });
      });

    },
    
    //第三个模板，微信图片上传
    template3: function() {
      module.exports.load2();
      $('.album-save').on('click', function(){
        postData = {
            'template_id': $("#template_id").val(),
            'p1e1': $("#p1e1").data('oss_url') || $("#p1e1").attr('src'),
            'p1e2': $("#p1e2").data('oss_url') || $("#p1e2").attr('src'),
            'p2e1': $("#p2e1").data('oss_url') || $("#p2e1").attr('src'),
            'p3e1': $("#p3e1").data('oss_url') || $("#p3e1").attr('src'),
            'p3e2': $("#p3e2").data('oss_url') || $("#p3e2").attr('src'),
            'p4e1': $("#p4e1").data('oss_url') || $("#p4e1").attr('src'),
            'p5e1': $("#p5e1").data('oss_url') || $("#p5e1").attr('src'),
            'p6e1': $("#p6e1").data('oss_url') || $("#p6e1").attr('src'),
            'p6e2': $("#p6e2").data('oss_url') || $("#p6e2").attr('src'),
            'p7e1': $("#p7e1").data('oss_url') || $("#p7e1").attr('src'),
            'p8e1': $("#p8e1").data('oss_url') || $("#p8e1").attr('src'),
            'p9e1': $("#p9e1").data('oss_url') || $("#p9e1").attr('src'),
            'p10e1': $("#p10e1").data('oss_url') || $("#p10e1").attr('src'),
            'p10e2': $("#p10e2").data('oss_url') || $("#p10e2").attr('src'),
            'p11e1': $("#p11e1").data('oss_url') || $("#p11e1").attr('src'),
            
        };
        my_dialog.dialog('确定保存当前相册？', function(){
          $.ajax({
            type:'post',
            url:'/h5album/save_album',
            data: postData,
            dataType:'json',
            success:function(res){
              if (res.status == 0) {
                my_dialog.alert('保存成功，即将跳转到您的电子相册页面', function(){
                  window.location.href = '/h5album/display?id=' + res.data.id; 
                });
              } else {
                my_dialog.alert(res.msg);
              }
            }
          });
          
        })
      });
    },
    
    pup:function(){
		$("#bless").click(function(){
			if(!$(".bless").hasClass("act")){
				$(".bless").addClass("act");
			}
		})
		
		$("#message").click(function(){
			if(!$(".message").hasClass("act")){
				$(".message").addClass("act");
			}
		})
		
		$(".close_mask").click(function(){
			$(".popup").removeClass("act");
		})
	},

    //第四个模板（中国风），微信图片上传
    template4: function() {
      module.exports.load2();

      $('.album-save').on('click', function(){
        postData = {
            'template_id': $("#template_id").val(),
            'p1e1': $("#p1e1").data('oss_url') || $("#p1e1").attr('src'),
            
            'p2e1': $("#p2e1").data('oss_url') || $("#p2e1").attr('src'),
            'p2e2': $("#p2e2").data('oss_url') || $("#p2e2").attr('src'),
        
            'p3e1': $("#p3e1").data('oss_url') || $("#p3e1").attr('src'),
            'p3e2': $("#p3e2").data('oss_url') || $("#p3e2").attr('src'),
            'p3e3': $("#p3e3").data('oss_url') || $("#p3e3").attr('src'),
            
            'p4e1': $("#p4e1").data('oss_url') || $("#p4e1").attr('src'),
            'p4e2': $("#p4e2").data('oss_url') || $("#p4e2").attr('src'),
            
            'p5e1': $("#p5e1").data('oss_url') || $("#p5e1").attr('src'),
            'p5e2': $("#p5e2").data('oss_url') || $("#p5e2").attr('src'),
            
            'p6e1': $("#p6e1").data('oss_url') || $("#p6e1").attr('src'),
            'p6e2': $("#p6e2").data('oss_url') || $("#p6e2").attr('src'),
            'p6e3': $("#p6e3").data('oss_url') || $("#p6e3").attr('src'),
        };
        
        my_dialog.dialog('确定保存当前相册？', function(){
          $.ajax({
            type:'post',
            url:'/h5album/save_album',
            data: postData,
            dataType:'json',
            success:function(res){
              if (res.status == 0) {
                my_dialog.alert('保存成功，即将跳转到您的电子相册页面', function(){
                  window.location.href = '/h5album/display?id=' + res.data.id; 
                });
              } else {
                my_dialog.alert(res.msg);
              }
            }
          });
          
        })
      });
    }

  }
	function showDialog(msg, title, url){
     	var title = arguments[1] ? arguments[1] : '提示信息';
     	var url = arguments[2] ? arguments[2] : '';
     	var title = arguments[1] ? arguments[1] : '提示信息';
     	var url = arguments[2] ? arguments[2] : '';
     	weui.alert(msg, function(){
        if(url != ''){
          window.location.href=url;
        }
      });
     }
})
