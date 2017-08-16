<?php $this->load->view('common/header2')?>

<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/dinner">订单列表</a>
    <li class="active">关联文章管理</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><button class="btn btn-primary" onclick="window.history.go(-1);">返回</button>宴会关联文章管理</legend>
        <form class="form-horizontal" method="post">
            <input type="hidden" value="<?php echo $dinner_id;?>" name="dinner_id">
            <div class="form-group">
                <label class="col-sm-2">关联文章：</label>
                <div class="col-sm-4">
                    <input type="hidden" name="article_id" id="article_id" value="<?php echo isset($article_id) ? $article_id : 0?>">
                    <input type="text" class="form-control" id="search_name" placeholder="输入文章名称查找" value="<?php echo isset($article_name) ? $article_name : ''?>">
                    <div id="search_result" style="max-height:300px;overflow-y: scroll;overflow-x: hidden;border:1px solid #ccc; box-shadow: inset 0 1px 1px rgba(0,0,0,.075);">
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <button class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
seajs.use(['<?php echo css_js_url('dinner_album.js', 'admin')?>'], function(a, swfupload){
	a.search_news();
	a.sure_select();
})
</script>
</body>
</html>