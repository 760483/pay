<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"C:\wamp64\www\pay/app/admin\view\channel.form.html";i:1531455600;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">

    <div class="layui-form-item">
        <label class="layui-form-label">通道名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" value='<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:""); ?>' required="required" title="请通道名称" placeholder="请通道名称" class="layui-input">
        </div>
    </div>

	
	<div class="layui-form-item">
        <label class="layui-form-label">上级</label>
        <div class="layui-input-block">
            <input type="text" name="parentId" value='<?php echo (isset($vo['parentId']) && ($vo['parentId'] !== '')?$vo['parentId']:""); ?>' required="required" title="上级" placeholder="请上级名称" class="layui-input">
        </div>
    </div>
	<div class="layui-form-item">
        <label class="layui-form-label">参数</label>
        <div class="layui-input-block">
        <textarea placeholder="请输入参数" required="required" title="请输入参数" class="layui-textarea" name="param"><?php echo (isset($vo['param']) && ($vo['param'] !== '')?$vo['param']:""); ?></textarea>

        </div>
    </div>
	<div class="layui-form-item">
        <label class="layui-form-label">appId</label>
        <div class="layui-input-block">
            <input type="text" name="appId" value='<?php echo (isset($vo['appId']) && ($vo['appId'] !== '')?$vo['appId']:""); ?>' required="required" title="appId" placeholder="请输入appId" class="layui-input">
        </div>
    </div>
	<div class="layui-form-item">
        <label class="layui-form-label">key</label>
        <div class="layui-input-block">
            <input type="text" name="key" value='<?php echo (isset($vo['key']) && ($vo['key'] !== '')?$vo['key']:""); ?>' required="required" title="key" placeholder="请输入key" class="layui-input">
        </div>
    </div>
	
	<div class="layui-form-item">
        <label class="layui-form-label">url</label>
        <div class="layui-input-block">
            <input type="text" name="url" value='<?php echo (isset($vo['url']) && ($vo['url'] !== '')?$vo['url']:""); ?>' required="required" title="url" placeholder="请输入url" class="layui-input">
        </div>
    </div>
 <div class="layui-form-item">
        <label class="layui-form-label">api</label>
        <div class="layui-input-block">
            <input type="text" name="api" value='<?php echo (isset($vo['api']) && ($vo['api'] !== '')?$vo['api']:""); ?>' required="required" title="api" placeholder="api" class="layui-input">
        </div>
    </div>
	 <div class="layui-form-item">
        <label class="layui-form-label">channelRate</label>
        <div class="layui-input-block">
            <input type="text" name="channelRate" value='<?php echo (isset($vo['channelRate']) && ($vo['channelRate'] !== '')?$vo['channelRate']:""); ?>' required="required" title="channelRate" placeholder="channelRate" class="layui-input">
        </div>
    </div>
	<div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
		 <select name="status" class="input-sm form-control">
                <option value="">- 请选择 -</option>
                <option  <?php if((isset($vo['status'])&&$vo['status']==1)): ?>selected<?php endif; ?> value="1">- 启用 -</option>
			    <option  <?php if((isset($vo['status'])&&$vo['status']==0)): ?>selected<?php endif; ?> value="0">- 禁用 -</option>
				 
            </select>
             
        </div>
    </div>
	
	
	<div class="layui-form-item">
        <label class="layui-form-label">通知</label>
        <div class="layui-input-block"> 
		
            <input type="text" name="notify_url" value='<?php echo (isset($vo['notify_url']) && ($vo['notify_url'] !== '')?$vo['notify_url']:""); ?>' required="required" title="notify_url" placeholder="notify_url" class="layui-input">
        </div>
    </div>
	
		<div class="layui-form-item">
        <label class="layui-form-label">显示地址</label>
        <div class="layui-input-block">
            <input type="text" name="return_url" value='<?php echo (isset($vo['return_url']) && ($vo['return_url'] !== '')?$vo['return_url']:""); ?>' required="required" title="return_url" placeholder="return_url" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"> 描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入 描述" required="required" title="请输入 描述" class="layui-textarea" name="descript"><?php echo (isset($vo['descript']) && ($vo['descript'] !== '')?$vo['descript']:""); ?></textarea>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="layui-form-item text-center">
        <?php if(isset($vo['id'])): ?><input type='hidden' value='<?php echo $vo['id']; ?>' name='id'/><?php endif; ?>
        <button class="layui-btn" type='submit'><i class="fa fa-floppy-o"></i> 保存数据</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消编辑吗？" data-close><i class="fa fa-close"></i> 取消编辑</button>
    </div>
 <script>window.form.render();</script>
</form>
