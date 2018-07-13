<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"C:\wamp64\www\pay/app/admin\view\channel.index.html";i:1531455600;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1531455603;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
<div class="nowrap pull-right" style="margin-top:10px">
    <button data-modal='<?php echo url("$classuri/add"); ?>' data-title="添加通道" class='layui-btn layui-btn-small'>
        <i class='fa fa-plus'></i> 添加通道
    </button>
    <button data-update data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'
            class='layui-btn layui-btn-small layui-btn-danger'>
        <i class='fa fa-remove'></i> 删除通道
    </button>
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
        
<form onsubmit="return false;" data-auto="true" method="post">
    <?php if(empty($list)): ?>
    <p class="help-block text-center well">没 有 记 录 哦！</p>
    <?php else: ?>
    <input type="hidden" value="resort" name="action"/>
    <table class="layui-table" lay-skin="line" lay-size="sm">
        <thead>
        <tr>
            <th class='list-table-check-td'>
                <input data-none-auto="" data-check-target='.list-check-box' type='checkbox'/>
            </th>
            <th class='list-table-sort-td'>
                <button type="submit" class="layui-btn layui-btn-normal layui-btn-mini">ID</button>
            </th>
            <th class='text-center'>名称</th>
            <th class='text-center'>上级</th>
            <th class='text-center'>用户ID</th>
            <th class='text-center'>url</th>
            <th class='text-center'>描述</th>
			<th class='text-center'>创建时间</th>
			<th class='text-center'>上次更改</th>
			<th class='text-center'>key</th>
			<th class='text-center'>channelRate</th>	
			<th class='text-center'>param</th>			
			<th class='text-center'>api</th>		
			<th class='text-center'>通知地址</th>
			<th class='text-center'>返回地址</th>
			<th class='text-center'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $key=>$vo): ?>
		
        <tr>
		
		  <th class='list-table-check-td'>
                <input data-none-auto="" data-check-target='.list-check-box' type='checkbox'/>
            </th>
            <td class='list-table-check-td'>
			<?php echo $vo['id']; ?>
                
            </td>
            <td class='list-table-sort-td'>
                <?php echo $vo['name']; ?>
            </td>
            <td class='text-center'><?php echo $vo['parentId']; ?> </td>
            <td class='text-center'><?php echo $vo['createName']; ?></td>
			<td class='text-center'><?php echo $vo['url']; ?></td>
			<td class='text-center'><?php echo $vo['descript']; ?></td>        
            <td class="text-center nowrap"><?php echo format_time($vo['create_time']); ?></td>
			<td class="text-center nowrap"><?php echo format_time($vo['update_time']); ?></td>
			<td class="text-center nowrap"><?php echo $vo['key']; ?></td>
			 <td class="text-center nowrap"><?php echo $vo['channelRate']; ?></td>
			  <td class="text-center nowrap"><?php echo cut_str($vo['param']); ?></td>
			 <td class="text-center nowrap"><?php echo $vo['api']; ?></td>
			   <td class="text-center nowrap"><?php echo $vo['notify_url']; ?></td>
			 <td class="text-center nowrap"><?php echo $vo['return_url']; ?></td>
            <td class='text-center nowrap'>

                <?php if(auth("$classuri/edit")): ?>
                <span class="text-explode">|</span>
                <a data-modal='<?php echo url("$classuri/edit"); ?>?id=<?php echo $vo['id']; ?>' href="javascript:void(0)">编辑</a>
                <?php endif; if($vo['status'] == 1 and auth("$classuri/forbid")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='status' data-value='0' data-action='<?php echo url("$classuri/forbid"); ?>'
                   href="javascript:void(0)">禁用</a>
                <?php elseif(auth("$classuri/resume")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='status' data-value='1' data-action='<?php echo url("$classuri/resume"); ?>'
                   href="javascript:void(0)">启用</a>
                <?php endif; if(auth("$classuri/del")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'
                   href="javascript:void(0)">删除</a>
                <?php endif; ?>

            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php if(isset($page)): ?><p><?php echo $page; ?></p><?php endif; endif; ?>
</form>

    </div>
    
</div>