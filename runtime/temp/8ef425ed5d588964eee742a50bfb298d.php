<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"C:\wamp64\www\pay/app/admin\view\merchannel.form.html";i:1532050198;}*/ ?>
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
        <label class="layui-form-label label-required">用户</label>
        <div class="col-xs-3">
            <select name="uId" class="input-sm form-control">
                <option value="">- 请选择 -</option>
                <?php if(is_array($vo['user']) || $vo['user'] instanceof \think\Collection || $vo['user'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['user'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				  <option   <?php if(isset($vo['uId'])&&$vo['uId']==$v['id']): ?>selected<?php endif; ?> value="<?php echo $v['id']; ?>">-  <?php echo $v['username']; ?> -</option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>

       
    </div>
	
	<div class="layui-form-item">
        <label class="layui-form-label">url</label>
        <div class="layui-input-block">
            <input type="text" name="url" value='<?php echo (isset($vo['url']) && ($vo['url'] !== '')?$vo['url']:""); ?>' required="required" title="url" placeholder="请输入url" class="layui-input">
        </div>
    </div>
	
	 
	<div class="layui-form-item">
        <label class="layui-form-label">key</label>
        <div class="layui-input-block">
            <input type="text" name="" readonly value='<?php echo (isset($vo['key']) && ($vo['key'] !== '')?$vo['key']:""); ?>' required="required" title="key" placeholder="请输入key" class="layui-input">
       <p class="help-block">系统自动生成，不允许修改</p>
	   </div>
    </div>
 
  
	 <div class="layui-form-item">
        <label class="layui-form-label">rate</label>
        <div class="layui-input-block">
            <input type="text" name="rate" value='<?php echo (isset($vo['rate']) && ($vo['rate'] !== '')?$vo['rate']:""); ?>' required="required" title="rate" placeholder="rate" class="layui-input">
        </div>
    </div>
	
	
	
	 <div class="layui-form-item">
        <label class="layui-form-label">域名或IP</label>
        <div class="layui-input-block">
            <input type="text" name="domain" value='<?php echo (isset($vo['domain']) && ($vo['domain'] !== '')?$vo['domain']:""); ?>' required="required" title="domain" placeholder="域名或IP" class="layui-input">
        </div>
    </div>
	
	<div class="layui-form-item">
        <label class="layui-form-label">status</label>
        <div class="layui-input-block">
            	 <select name="status" class="input-sm form-control">
                <option value="">- 请选择 -</option>
                <option  <?php if((isset($vo['status'])&&$vo['status']==1)): ?>selected<?php endif; ?> value="1">- 启用 -</option>
			    <option  <?php if((isset($vo['status'])&&$vo['status']==0)): ?>selected<?php endif; ?> value="0">- 禁用 -</option>
				 
            </select>
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
