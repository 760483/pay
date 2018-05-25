<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:45:"C:\wamp64\www\pay/app/port\view\row.form.html";i:1526461055;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label label-required">接口名称</label>
        <div class="col-xs-3">
            <input type="text" name="apiName" value='<?php echo (isset($vo['apiName']) && ($vo['apiName'] !== '')?$vo['apiName']:""); ?>'
                   title="请输入接口名称" placeholder="类名/方法名" class="layui-input">
            <p class="help-block">注意区分大小写</p>
        </div>

        <label class="layui-form-label label-required">接口映射</label>
        <div class="col-xs-3">
            <input type="text" name="hash" value='<?php echo (isset($vo['hash']) && ($vo['hash'] !== '')?$vo['hash']:uniqid()); ?>' readonly class="layui-input">
            <p class="help-block">系统自动生成，不允许修改</p>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label label-required">请求方式</label>
        <div class="col-xs-3">
            <select name="method" class="input-sm form-control">
                <option value="">- 请选择 -</option>
                <option <?php if(isset($vo['method'])&&$vo['method']=='0'): ?>selected<?php endif; ?> value="0">不限</option>
                <option <?php if(isset($vo['method'])&&$vo['method']=='1'): ?>selected<?php endif; ?> value="1">post</option>
                <option <?php if(isset($vo['method'])&&$vo['method']=='2'): ?>selected<?php endif; ?> value="2">get</option>
            </select>
        </div>

        <label class="layui-form-label label-required">测试模式</label>
        <div class="col-xs-3">
            <select name="isTest" class="input-sm form-control">
                <option value="">- 请选择 -</option>
                <option <?php if(isset($vo['isTest'])&&$vo['isTest']=='1'): ?>selected<?php endif; ?> value="1">开启测试</option>
                <option <?php if(isset($vo['isTest'])&&$vo['isTest']=='0'): ?>selected<?php endif; ?> value="0">关闭测试</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label label-required">AccessToken</label>
        <div class="col-xs-3">
            <select name="accessToken" class="input-sm form-control">
                <option value="">- 请选择 -</option>
                <option <?php if(isset($vo['accessToken'])&&$vo['accessToken']=='0'): ?>selected<?php endif; ?> value="0">忽略Token</option>
                <option <?php if(isset($vo['accessToken'])&&$vo['accessToken']=='1'): ?>selected<?php endif; ?> value="1">验证Token</option>
            </select>
        </div>

        <label class="layui-form-label label-required">用户登录</label>
        <div class="col-xs-3">
            <select name="needLogin" class="input-sm form-control">
                <option value="">- 请选择 -</option>
                <option <?php if(isset($vo['needLogin'])&&$vo['needLogin']=='0'): ?>selected<?php endif; ?> value="0">忽略登录</option>
                <option <?php if(isset($vo['needLogin'])&&$vo['needLogin']=='1'): ?>selected<?php endif; ?> value="1">验证登录</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label label-required">接口描述</label>
        <div class="col-xs-8">
            <textarea name="info" class="layui-input" placeholder="请输入接口描述" style="height:60px;resize:none;line-height:20px"><?php echo (isset($vo['info']) && ($vo['info'] !== '')?$vo['info']:""); ?></textarea>
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
