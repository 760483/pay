<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:47:"C:\wamp64\www\pay/app/admin\view\auth.form.html";i:1526461055;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">

    <div class="layui-form-item">
        <label class="layui-form-label">权限名称</label>
        <div class="layui-input-block">
            <input type="text" name="title" value='<?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:""); ?>' required="required" title="请输入权限名称" placeholder="请输入权限名称" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">权限描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入权限描述" required="required" title="请输入权限描述" class="layui-textarea" name="desc"><?php echo (isset($vo['desc']) && ($vo['desc'] !== '')?$vo['desc']:""); ?></textarea>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="layui-form-item text-center">
        <?php if(isset($vo['id'])): ?><input type='hidden' value='<?php echo $vo['id']; ?>' name='id'/><?php endif; ?>
        <button class="layui-btn" type='submit'><i class="fa fa-floppy-o"></i> 保存数据</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消编辑吗？" data-close><i class="fa fa-close"></i> 取消编辑</button>
    </div>

</form>
