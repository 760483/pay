<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"C:\wamp64\www\pay/app/admin\view\order.index.html";i:1532055913;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1531474545;}*/ ?>
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
			<th class='text-center'>商户订单</th>
			<th class='text-center'>通道订单</th>
			
            <th class='text-center'>用户</th>
			<th class='text-center'>产品</th>
			
			<th class='text-center'>通知地址</th>
			<th class='text-center'>订单金额</th>
			<th class='text-center'>通道金额</th>
            <th class='text-center'>日期</th>
            <th class='text-center'>支付状态</th>
			<th class='text-center'>同步状态</th>
			<th class='text-center'>商户channel</th>
			<th class='text-center'>channel</th>
			<th class='text-center'>银行信息</th>
			<th class='text-center'>利润</th>			         
			<th class='text-center'>支付url</th>
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
			<td class='text-center'><?php echo $vo['orderId']; ?></td>
			<td class='text-center'><?php echo $vo['channelOrderId']; ?></td>
            <td class='text-center'><?php echo $vo['username']; ?></td>
			<td class='text-center'><?php echo $vo['productName']; ?></td>
			<td class='text-center'><a href='<?php echo $vo['notifyUrl']; ?>'>通知<a></td>
			<td class='text-center'><?php echo $vo['tradeMoney']; ?></td>
			<td class='text-center'><?php echo $vo['channelMoney']; ?></td>			  
            <td class='text-center'><?php echo format_time($vo['orderDate']); ?></td>
            <td class='text-center'>
                <?php if($vo['status'] == 0): ?>
                <span>未支付</span>
                <?php elseif($vo['status'] == 1): ?>
                <span style="color:#090">已支付</span>
                <?php endif; ?>
            </td>
			
			<td class='text-center'>
                <?php if($vo['respStatus'] == 0): ?>
                <span>未同步</span>
                <?php elseif($vo['respStatus'] == 1): ?>
                <span style="color:#090">已同步</span>
                <?php endif; ?>
            </td>
			
			<td class="text-center nowrap"><?php echo $vo['merChannelName']; ?></td>
			<td class="text-center nowrap"><?php echo $vo['channelName']; ?></td>
			<td class="text-center nowrap"><?php echo $vo['bank']; ?></td>
			<td class="text-center nowrap"><?php echo $vo['rateMoney']; ?></td>
      
			<td class="text-center nowrap"><a href='<?php echo $vo['pay_url']; ?>'>支付链接<a></td>
			<td class="text-center nowrap"><?php echo $vo['extra']; ?></td>
			
			
            <td class='text-center nowrap'>  
                <?php if(auth("$classuri/del")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'
                   href="javascript:void(0)">删除</a>
                <?php endif; if(auth("$classuri/modify")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/modify"); ?>'
                   href="javascript:void(0)">强行补单</a>
                <?php endif; if(auth("$classuri/send")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/send"); ?>'
                   href="javascript:void(0)">补单</a>
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