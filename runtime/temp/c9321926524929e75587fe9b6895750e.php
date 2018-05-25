<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:47:"C:\wamp64\www\pay/app/admin\view\user.form.html";i:1526461055;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">

    <div class="layui-form-item">
        <label class="layui-form-label">用户账号</label>
        <div class="layui-input-block">
            <?php if($vo and isset($vo['username'])): ?>
            <input readonly="readonly" disabled="disabled" name="username" value='<?php echo (isset($vo['username']) && ($vo['username'] !== '')?$vo['username']:""); ?>'
                   required="required" title="请输入用户名称" placeholder="请输入用户名称" class="layui-input layui-disabled">
            <?php else: ?>
            <input name="username" value='<?php echo (isset($vo['username']) && ($vo['username'] !== '')?$vo['username']:""); ?>' required="required" pattern="^.{4,}$"
                   title="请输入用户名称" placeholder="请输入4位及以上字符用户名称" class="layui-input">
            <?php endif; ?>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">联系手机</label>
        <div class="layui-input-block">
            <input type="tel" autofocus name="phone" value='<?php echo (isset($vo['phone']) && ($vo['phone'] !== '')?$vo['phone']:""); ?>' pattern="^1[3-9][0-9]{9}$"
                   title="请输入联系手机" placeholder="请输入联系手机" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">联系邮箱</label>
        <div class="layui-input-block">
            <input name="mail" pattern="^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$"
                   value='<?php echo (isset($vo['mail']) && ($vo['mail'] !== '')?$vo['mail']:""); ?>' title="请输入联系邮箱" placeholder="请输入联系邮箱" class="layui-input">
        </div>
    </div>

    <?php if(isset($authorizes)): ?>
    <div class="layui-form-item">
        <label class="layui-form-label">访问授权</label>
        <div class="layui-input-block">
            <?php foreach($authorizes as $authorize): if(in_array($authorize['id'],$vo['authorize'])): ?>
            <label class="think-checkbox">
                <input type="checkbox" checked name="authorize[]" value="<?php echo $authorize['id']; ?>" lay-ignore> <?php echo $authorize['title']; ?>
            </label>
            <?php else: ?>
            <label class="think-checkbox">
                <input type="checkbox" name="authorize[]" value="<?php echo $authorize['id']; ?>" lay-ignore> <?php echo $authorize['title']; ?>
            </label>
            <?php endif; endforeach; if(empty($authorizes)): ?>
            <span class="color-desc" style="line-height:36px">未配置权限</span>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="layui-form-item">
        <label class="layui-form-label">用户描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入用户描述" title="请输入用户描述" class="layui-textarea"
                      name="desc"><?php echo (isset($vo['desc']) && ($vo['desc'] !== '')?$vo['desc']:""); ?></textarea>
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
