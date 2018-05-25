<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"C:\wamp64\www\pay/app/admin\view\order.index.html";i:1527215837;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1526461055;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
<div class="nowrap pull-right" style="margin-top:10px">
    <button data-modal='<?php echo url("$classuri/add"); ?>' data-title="添加权限" class='layui-btn layui-btn-small'>
        <i class='fa fa-plus'></i> 添加订单
    </button>
    <button data-update data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'
            class='layui-btn layui-btn-small layui-btn-danger'>
        <i class='fa fa-remove'></i> 删除订单
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
                <button type="submit" class="layui-btn layui-btn-normal layui-btn-mini">id</button>
            </th>
            <th class='text-center'>用户ID</th>
			<th class='text-center'>产品</th>
			<th class='text-center'>notify_url</th>
			<th class='text-center'>return_url</th>
            <th class='text-center'>日期</th>
            <th class='text-center'>状态</th>
			<th class='text-center'>商户channel</th>
			<th class='text-center'>channel</th>
			<th class='text-center'>银行信息</th>
			<th class='text-center'>利润</th>			
            <th class='text-center'>添加时间</th>
			<th class='text-center'>extra</th>
            <th class='text-center'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $key=>$vo): ?>
        <tr>
            <td class='list-table-check-td'>
                <input class="list-check-box" value='<?php echo $vo['id']; ?>' type='checkbox'/>
            </td>
            <td class='list-table-sort-td'>
			<?php echo $vo['id']; ?>
    
            </td>
            <td class='text-center'><?php echo $vo['UserID']; ?></td>
			<td class='text-center'><?php echo $vo['ProductName']; ?></td>
			<td class='text-center'><?php echo $vo['notify_url']; ?></td>
			<td class='text-center'><?php echo $vo['return_url']; ?></td>
			  
            <td class='text-center'><?php echo format_datetime($vo['OrderDate']); ?></td>
            <td class='text-center'>
                <?php if($vo['status'] == 0): ?>
                <span>未支付</span>
                <?php elseif($vo['status'] == 1): ?>
                <span style="color:#090">使用中</span>
                <?php endif; ?>
            </td>
			 <td class="text-center nowrap"><?php echo $vo['mer_channel']; ?></td>
			 <td class="text-center nowrap"><?php echo $vo['channelId']; ?></td>
			  <td class="text-center nowrap"><?php echo $vo['bank']; ?></td>
			   <td class="text-center nowrap"><?php echo $vo['RateMoney']; ?></td>
            <td class="text-center nowrap"><?php echo format_datetime($vo['cTime']); ?></td>
			<td class="text-center nowrap"><?php echo $vo['extra']; ?></td>
            <td class='text-center nowrap'>  
                <?php if(auth("$classuri/del")): ?>
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