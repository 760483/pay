<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:44:"C:\wamp64\www\pay/app/port\view\row.ask.html";i:1526461055;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1526461055;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
<div class="nowrap pull-right" style="margin-top:10px">
    <?php if(auth("$classuri/add_param")): ?>
    <button data-modal="<?php echo url('add_param'); ?>?hash=<?php echo \think\Request::instance()->get('hash'); ?>&type=<?php echo $type; ?>" data-title="添加请求参数" class='layui-btn layui-btn-small'><i
            class='fa fa-plus'></i> 添加请求参数
    </button>
    <?php endif; if(auth("$classuri/del_param")): ?>
    <button data-update data-field='delete' data-action='<?php echo url("$classuri/del_param"); ?>'
            class='layui-btn layui-btn-small layui-btn-danger'><i class='fa fa-close'></i> 删除请求参数
    </button>
    <?php endif; ?>
</div>

    </div>
    <?php endif; ?>
    <div class="ibox-content">
        <?php if(isset($alert)): ?>
        <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissible" role="alert" style="border-radius:0">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php if(isset($alert['title'])): ?><p style="font-size:18px;padding-bottom:10px"><?php echo $alert['title']; ?></p><?php endif; if(isset($alert['content'])): ?><p style="font-size:14px"><?php echo $alert['content']; ?></p><?php endif; ?>
        </div>
        <?php endif; ?>
        

<div class="nowrap pull-left" style="margin-bottom:10px;">
    <button onclick="history.go(-1);" class='layui-btn layui-btn-small'><i
            class='fa fa-mail-reply'></i> 返回</button>
</div>

<form onsubmit="return false;" data-auto="" method="POST">
    <input type="hidden" value="resort" name="action"/>
    <table class="table table-hover">
        <thead>
        <tr>
            <th class='list-table-check-td'>
                <input data-none-auto="" data-check-target='.list-check-box' type='checkbox'/>
            </th>
            <th class='text-center'>#</th>
            <th class='text-center'>对应映射</th>
            <th class='text-left'>字段名称</th>
            <th class='text-left'>数据类型</th>
            <th class='text-center'>是否必须</th>
            <th class='text-left'>默认值</th>
            <th class='text-left'>字段说明</th>
            <th class='text-center'>操作者</th>
            <th class='text-center'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td class='list-table-check-td'>
                <input class="list-check-box" value='<?php echo $vo['id']; ?>' type='checkbox'/>
            </td>
            <td class='text-center'><?php echo $i; ?></td>
            <td class='text-center'><?php echo (isset($vo['hash']) && ($vo['hash'] !== '')?$vo['hash']:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-left'><?php echo (isset($vo['fieldName']) && ($vo['fieldName'] !== '')?$vo['fieldName']:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-left'><?php echo (isset($dataType[$vo['dataType']]) && ($dataType[$vo['dataType']] !== '')?$dataType[$vo['dataType']]:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-center'><?php echo !empty($vo['isMust'])?"<span style='color:#090'>是</span>":"<span style='color:#999'>否</span>"; ?></td>
            <td class='text-left'><?php echo (isset($vo['default']) && ($vo['default'] !== '')?$vo['default']:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-left'><?php echo (isset($vo['info']) && ($vo['info'] !== '')?$vo['info']:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-center'><?php echo (isset($vo['handler_name']) && ($vo['handler_name'] !== '')?$vo['handler_name']:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-center nowrap'>
                <?php if(auth("$classuri/edit_param")): ?>
                <a data-modal='<?php echo url("$classuri/edit_param"); ?>?id=<?php echo $vo['id']; ?>' data-title="编辑接口参数" href="javascript:void(0)">编辑</a>
                <?php endif; if(auth("$classuri/del_param")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/del_param"); ?>'
                   href="javascript:void(0)" style="color:#c00">删除</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; if(empty($list)): ?>
        <tr><td colspan="12" style="text-align:center">没 有 记 录 了 哦 !</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php if(isset($page)): ?><p><?php echo $page; ?></p><?php endif; ?>
</form>

    </div>
    
</div>