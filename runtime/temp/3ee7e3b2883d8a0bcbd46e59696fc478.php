<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:45:"C:\wamp64\www\pay/app/demo\view\pay.edit.html";i:1532053502;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">

    <div class="layui-form-item">
        <label class="layui-form-label">id</label>
        <div class="layui-input-block">
             
            <input readonly="readonly" disabled="disabled" name="id" value='1'
                   required="required" title="请输入手机名称" placeholder="请输入手机名称" class="layui-input">
             
            
        </div>
    </div>

    
 
<textarea name="info">这里可以放默认值</textarea>
    
	 

	 


    <div class="hr-line-dashed"></div>

    <div class="layui-form-item text-center">
        
        <button class="layui-btn" type='submit'><i class="fa fa-floppy-o"></i> 保存数据</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消编辑吗？" data-close><i class="fa fa-close"></i> 取消编辑</button>
    </div>
    <script>
	require(['ckeditor'], function () {
		var editor = window.createEditor('[name="info"]');
		// 设置内容
	// editor.setData('<?php echo (isset($vo['info']) && ($vo['info'] !== '')?$vo['info']:""); ?>');
		// 获取内容
		var content = editor.getData();
		console.log(content);
	});	
	</script>
</form>
