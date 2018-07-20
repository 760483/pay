<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"C:\wamp64\www\pay/app/admin\view\notify.index.html";i:1531474536;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1531474545;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
<div class="nowrap pull-right" style="margin-top:10px">
    <button data-modal='<?php echo url("$classuri/add"); ?>' data-title="添加通知" class='layui-btn layui-btn-small'>
        <i class='fa fa-plus'></i> 添加通知
    </button>
    <button data-update data-field='delete' data-action='<?php echo url("$classuri/del"); ?>' class='layui-btn layui-btn-small layui-btn-danger'>
        <i class='fa fa-remove'></i> 删除通知
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
        

<!-- 表单搜索 开始 -->
<form class="layui-form layui-form-pane form-search" action="__SELF__" onsubmit="return false" method="get">
 

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">通知</label>
        <div class="layui-input-inline">
            <input name="City" value="<?php echo (\think\Request::instance()->get('City') ?: ''); ?>" placeholder="请输入通知" class="layui-input">
        </div>
    </div> 
   

    <div class="layui-form-item layui-inline">
        <button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button>
    </div>
</form>
<!-- 表单搜索 结束 -->

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
              
                <th class='text-left nowrap'>用户ID</th>
				 
                <th class='text-left nowrap'>title</th>
               
                <th class='text-left nowrap'>内容</th>
                 <th class='text-left nowrap'>创建时间</th>
				  <th class='text-left nowrap'>上次发送时间</th>
				 <th class='text-left nowrap'>发送人</th>
				 <th class='text-left nowrap'>类型</th>
                <th class='text-left nowrap'>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $key=>$vo): ?>
            <tr>
                <td class='list-table-check-td'>
                    <input class="list-check-box" value='<?php echo $vo['id']; ?>' type='checkbox'/>
                </td>
                <td class='text-left nowrap'>
                     <?php echo $vo['userID']; ?>
                </td>
              
            
             
                <td class='text-left nowrap'>
                     <?php echo $vo['title']; ?>
                </td> 
				 <td class='text-left nowrap'>
                     <?php echo $vo['content']; ?>
                </td> 
				 <td class='text-left nowrap'>
                     <?php echo format_time($vo['cTime']); ?>
                </td> 
				 <td class='text-left nowrap'>
                     <?php echo format_time($vo['mTime']); ?>
                </td> 
				 <td class='text-left nowrap'>
                     <?php echo $vo['toUser']; ?>
                </td> 
				 <td class='text-left nowrap'>
                     <?php echo $vo['type']; ?>
                </td> 
                <td class='text-left nowrap'>
                    <?php if(auth("$classuri/edit")): ?>
                    <span class="text-explode">|</span>
                    <a data-modal='<?php echo url("$classuri/edit"); ?>?id=<?php echo $vo['id']; ?>' href="javascript:void(0)">编辑</a>
                    <?php endif; if(auth("$classuri/sendMail")): ?>
                    <span class="text-explode">|</span>
                    <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/sendMail"); ?>'
                       href="javascript:void(0)">发送</a>
                    <?php endif; if(auth("$classuri/sendNotify")): ?>
                    <span class="text-explode">|</span>
                    <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/sendNotify"); ?>'
                       href="javascript:void(0)">发送通知</a>
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
    <script>
        window.laydate.render({range: true, elem: '#range-date', format: 'yyyy/MM/dd'});
    </script>
</form>

    </div>
    
</div>