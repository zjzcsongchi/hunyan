/**
 * 手机端 相册页面js
 * @author louhang@gz-zc.cn
 */
define(function(require, exports, module){
  
  var wx = require('jweixin');
  var my_dialog = require('my_dialog');

  module.exports = {
      
    load:function(){

      wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: wxConfig.appId, // 必填，公众号的唯一标识
        timestamp: wxConfig.timestamp, // 必填，生成签名的时间戳
        nonceStr: wxConfig.nonceStr,   // 必填，生成签名的随机串
        signature: wxConfig.signature,// 必填，签名，见附录1
        jsApiList: ['uploadImage', 'chooseImage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
      });
      
      $('#uploadbtn').on('click', function(){
        _this = $(this);
        var count = 1;
        wx.chooseImage({
          count: count, // 若未通过data-count指定上传图片张数，默认单张上传
          sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
          sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
          success: function (res) {
            var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
            _this.children('img').attr('src', localIds[0]);
           
            if (localIds[0]) {
              wx.uploadImage({
                localId: localIds[0], // 需要上传的图片的本地ID，由chooseImage接口获得
                isShowProgressTips: 1, // 默认为1，显示进度提示
                success: function (res) {
                  var serverId = res.serverId; // 返回图片的服务器端ID
                  $.ajax({
                    type:'get',
                    url:'/h5album/downloadImgFromWx?serverId=' + serverId,
                    dataType:'json',
                    success:function(res){
                      if (res.status == 0) {
                        _this.children('input').val(res.data.url);
                      } else {
                        my_dialog.alert(res.msg);
                      }
                    }
                  });
                }
              });
            }
          }
        });
      });
    },

  }
})
