$(function() {
    $('#filePicker').uploadify({
        'swf'      : 'http://static-zc.dev.cndgx.com/common/uploadify.swf',
        'uploader' : 'http://zc.dev.cndgx.com/file/upload',
        'buttonImage':'http://static-zc.dev.cndgx.com/www/images/add_item_pic.png',
        'buttonClass' : 'add_picBtn',
        'fileTypeExts' : '*.gif; *.jpg; *.png',
        'height'   : 75,
        'width'	: 232
        
        // Put your options here
    });
});