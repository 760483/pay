<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"C:\wamp64\www\pay/app/admin\view\merchannel.config.html";i:1527141594;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">
   

    <div class="layui-form-item">
        <label class="layui-form-label label-required">上游</label>
        <div class="col-xs-3">
            <select name="cId" class="input-sm form-control">
                <option value="">- 请选择 -</option>
                <?php if(is_array($vo['channel']) || $vo['channel'] instanceof \think\Collection || $vo['channel'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['channel'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				  <option   <?php if(isset($vo['cId'])&&$vo['cId']==$v['id']): ?>selected<?php endif; ?> value="<?php echo $v['id']; ?>">-  <?php echo $v['name']; ?> -</option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div> 
    </div>
 

    <div class="layui-form-item">
        <label class="layui-form-label label-required">配置描述</label>
        <div class="col-xs-8">
            <textarea name="info" class="layui-input" placeholder="请输入接口描述" style="height:60px;resize:none;line-height:20px"><?php echo (isset($vo['info']) && ($vo['info'] !== '')?$vo['info']:""); ?></textarea>
        </div>
    </div>

    <div class="hr-line-dashed"></div>
 
    <div class="layui-form-item text-center">
        <?php if(isset($vo ['id'])): ?><input type='hidden' value='<?php echo $vo['id']; ?>' name='id'/><?php endif; if(isset($vo ['merCId'])): ?><input type='hidden' value="<?php echo $vo['merCId']; ?>" name='merCId'/><?php endif; ?>
        <button class="layui-btn" type='submit'><i class="fa fa-floppy-o"></i> 保存数据</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消编辑吗？" data-close><i class="fa fa-close"></i> 取消编辑</button>
    </div>
    <script>window.form.render();</script>
</form>
