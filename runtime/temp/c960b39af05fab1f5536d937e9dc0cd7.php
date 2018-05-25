<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"C:\wamp64\www\pay/app/port\view\row.paramform.html";i:1526461055;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label label-required">字段名称</label>
        <div class="col-xs-3">
            <input type="text" name="showName" value='<?php echo (isset($vo['showName']) && ($vo['showName'] !== '')?$vo['showName']:""); ?>'
                   title="请输入字段名称" placeholder="参数字段名称" class="layui-input">
        </div>

        <label class="layui-form-label label-required">数据类型</label>
        <div class="col-xs-3">
            <select name="dataType" class="input-sm form-control">
                <option value="">- 选择类型 -</option>
                <!--<?php foreach($dataType as $key=>$types): ?>-->
                <!--<?php if(isset($vo['dataType'])&&$vo['dataType'] == $key): ?>-->
                <option selected value="<?php echo $key; ?>"><?php echo $types; ?></option>
                <!--<?php else: ?>-->
                <option value="<?php echo $key; ?>"><?php echo $types; ?></option>
                <!--<?php endif; ?>-->
                <!--<?php endforeach; ?>-->
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">默认值</label>
        <div class="col-xs-3">
            <input type="text" name="default" value='<?php echo (isset($vo['default']) && ($vo['default'] !== '')?$vo['default']:""); ?>'
                   title="请输入默认值" placeholder="参数默认值" class="layui-input">
        </div>

        <label class="layui-form-label label-required">是否必填</label>
        <div class="col-xs-3">
            <select name="isMust" class="input-sm form-control">
                <option <?php if(empty($vo['isMust'])||$vo['isMust']=='1'): ?>selected<?php endif; ?> value="1">必填</option>
                <option <?php if(isset($vo['isMust'])&&$vo['isMust']=='0'): ?>selected<?php endif; ?> value="0">不必填</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">规则细节</label>
        <div class="col-xs-8">
            <textarea name="range" class="layui-input" placeholder="请输入符合要求的JSON字符串" style="height:60px;resize:none;line-height:20px"><?php echo (isset($vo['range']) && ($vo['range'] !== '')?$vo['range']:""); ?></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">字段说明</label>
        <div class="col-xs-8">
            <textarea name="info" class="layui-input" placeholder="请输入字段说明" style="height:60px;resize:none;line-height:20px"><?php echo (isset($vo['info']) && ($vo['info'] !== '')?$vo['info']:""); ?></textarea>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="layui-form-item text-center">
        <?php if(isset($vo['id'])): ?><input type='hidden' value='<?php echo $vo['id']; ?>' name='id'/><?php endif; ?>
        <input type="hidden" name="hash" value="<?php echo !empty($vo['hash'])?$vo['hash']:\think\Request::instance()->get('hash'); ?>">
        <input type="hidden" name="type" value="<?php echo !empty($vo['type'])?$vo['type']:\think\Request::instance()->get('type'); ?>">
        <button class="layui-btn" type="submit"><i class="fa fa-floppy-o"></i> 保存数据</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消编辑吗？" data-close><i class="fa fa-close"></i> 取消编辑</button>
    </div>
    <script>window.form.render();</script>
</form>
