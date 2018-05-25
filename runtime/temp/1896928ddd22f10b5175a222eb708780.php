<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"C:\wamp64\www\pay/app/port\view\row.index.html";i:1526461055;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1526461055;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
<div class="nowrap pull-right" style="margin-top:10px">
    <?php if(auth("$classuri/add")): ?>
    <button data-modal="<?php echo url('add'); ?>" data-title="添加API接口" class='layui-btn layui-btn-small'><i
            class='fa fa-plus'></i> 添加接口
    </button>
    <?php endif; if(auth("$classuri/forbid")): ?>
    <button data-update data-field='status' data-value='0' data-action='<?php echo url("$classuri/forbid"); ?>'
            class='layui-btn layui-btn-small layui-btn-danger'><i
            class='fa fa-ban'></i> 禁用接口
    </button>
    <?php endif; if(auth("$classuri/resume")): ?>
    <button data-update data-field='status' data-value='1' data-action='<?php echo url("$classuri/resume"); ?>'
            class='layui-btn layui-btn-small'><i
            class='fa fa-check-circle-o'></i> 启用接口
    </button>
    <?php endif; if(auth("$classuri/forbid")): ?>
    <button data-update data-field='isTest' data-value='0' data-action='<?php echo url("$classuri/forbid"); ?>'
            class='layui-btn layui-btn-small layui-btn-danger'><i
            class='fa fa-ban'></i> 禁用接口测试
    </button>
    <?php endif; if(auth("$classuri/resume")): ?>
    <button data-update data-field='isTest' data-value='1' data-action='<?php echo url("$classuri/resume"); ?>'
            class='layui-btn layui-btn-small'><i
            class='fa fa-check-circle-o'></i> 启用接口测试
    </button>
    <?php endif; if(auth("$classuri/del")): ?>
    <button data-update data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'
            class='layui-btn layui-btn-small layui-btn-danger'><i class='fa fa-close'></i> 删除接口
    </button>
    <?php endif; if(auth("$classuri/refresh")): ?>
    <button data-load="<?php echo url('refresh'); ?>" class='layui-btn layui-btn-small'><i class="fa fa-refresh"></i> 刷新接口路由
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
        

<!-- 表单搜索 开始 -->
<form class="animated form-search" action="__SELF__" onsubmit="return false" method="get">

    <div class="row">
        <div class="col-xs-2">
            <div class="form-group">
                <input type="text" name="apiName" value="<?php echo (\think\Request::instance()->get('apiName') ?: ''); ?>" placeholder="接口名称"
                       class="input-sm form-control">
            </div>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <input type="text" name="hash" value="<?php echo (\think\Request::instance()->get('hash') ?: ''); ?>" placeholder="接口HASH"
                       class="input-sm form-control">
            </div>
        </div>

        <div class="col-xs-2">
            <div class="form-group">
                <input type="text" name="info" value="<?php echo (\think\Request::instance()->get('info') ?: ''); ?>" placeholder="接口简介"
                       class="input-sm form-control">
            </div>
        </div>

        <div class="col-xs-1">
            <div class="form-group">
                <select name="handler" class="input-sm form-control">
                    <option value="">- 操作者 -</option>
                    <!--<?php foreach($handlers as $key=>$handler): ?>-->
                    <!--<?php if(\think\Request::instance()->get('handler') == $key): ?>-->
                    <option selected value="<?php echo $key; ?>"><?php echo $handler; ?></option>
                    <!--<?php else: ?>-->
                    <option value="<?php echo $key; ?>"><?php echo $handler; ?></option>
                    <!--<?php endif; ?>-->
                    <!--<?php endforeach; ?>-->
                </select>
            </div>
        </div>

        <div class="col-xs-1">
            <div class="form-group">
                <select name="status" class="input-sm form-control">
                    <option value="">- 状态 -</option>
                    <option <?php if(\think\Request::instance()->get('status')=='1'): ?>selected<?php endif; ?> value="1">使用中</option>
                    <option <?php if(\think\Request::instance()->get('status')=='0'): ?>selected<?php endif; ?> value="0">已禁用</option>
                </select>
            </div>
        </div>

        <div class="col-xs-1">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-white"><i class="fa fa-search"></i> 搜索</button>
            </div>
        </div>
    </div>

</form>
<!-- 表单搜索 结束 -->

<form onsubmit="return false;" data-auto="" method="POST">
    <input type="hidden" value="resort" name="action"/>
    <table class="table table-hover">
        <thead>
        <tr>
            <th class='list-table-check-td'>
                <input data-none-auto="" data-check-target='.list-check-box' type='checkbox'/>
            </th>
            <th class='list-table-sort-td'>
                <button type="submit" class="layui-btn layui-btn-normal layui-btn-mini">排 序</button>
            </th>
            <th class='text-left'>接口名称</th>
            <th class='text-center'>接口映射</th>
            <th class='text-left'>接口简介</th>
            <th class='text-center'>请求方式</th>
            <th class='text-center'>请求Header要求</th>
            <th class='text-center'>接口分组</th>
            <th class='text-center'>接口状态</th>
            <th class='text-center'>接口参数设置</th>
            <th class='text-center'>创建时间</th>
            <th class='text-center'>修改时间</th>
            <th class='text-center'>操作者</th>
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
                <input name="_<?php echo $vo['id']; ?>" value="<?php echo $vo['sort']; ?>" class="list-sort-input"/>
            </td>
            <td class='text-left'><?php echo (isset($vo['apiName']) && ($vo['apiName'] !== '')?$vo['apiName']:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-center'><a href="<?php echo url('@'); ?>api/<?php echo $vo['hash']; ?>" target="_blank"><?php echo (isset($vo['hash']) && ($vo['hash'] !== '')?$vo['hash']:"<span style='color:#ccc'>暂无</span>"); ?></a></td>
            <td class='text-left'><?php echo (cut_str($vo['info']) ?: "<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-center'><?php echo $vo['method']==1?'<span style="color:#c00">post</span>':($vo['method']==2?'<span style="color:#090">get</span>':'不限'); ?></td>
            <td class='text-center'>
                <span style="color:#090"><?php echo sysconf('app_version'); ?></span>
                <?php if($vo['accessToken'] == 1): ?>
                <span class="text-explode">|</span>
                <span style="color:#090">Token</span>
                <?php endif; if($vo['needLogin'] == 1): ?>
                <span class="text-explode">|</span>
                <span style="color:#090">Login</span>
                <?php endif; ?>
            </td>
            <td>
                <span>
                    <a data-add-tag='<?php echo $vo['id']; ?>' data-used-id='<?php echo join(",",array_keys($vo['tags_list'])); ?>'
                       id="tag-api-<?php echo $vo['id']; ?>" href='javascript:void(0)'
                       style='font-size:12px;font-weight:400;border-radius:50%;background:#9f9f9f'
                       class='label label-default'>+</a>
                </span>
                <?php if(empty($vo['tags_list'])): ?>
                <span style='color:#999'>尚未设置分组</span>
                <?php else: foreach($vo['tags_list'] as $k=>$tag): ?>
                <span>
                    <a href='javascript:void(0)' style='font-size:12px;font-weight:400;background:#9f9f9f'
                       class='label label-default'><?php echo $tag; ?></a>
                </span>
                <?php endforeach; endif; ?>
            </td>
            <td class='text-center'>
                <?php if($vo['status'] == 0): if(auth("$classuri/resume")): ?>
                    <a data-update="<?php echo $vo['id']; ?>" data-field='status' data-value='1' data-action='<?php echo url("$classuri/resume"); ?>'
                       href="javascript:void(0)" style="color:#c00">已禁用</a>
                    <?php else: ?>
                    <span style="color:#c00">已禁用</span>
                    <?php endif; else: if(auth("$classuri/forbid")): ?>
                    <a data-update="<?php echo $vo['id']; ?>" data-field='status' data-value='0' data-action='<?php echo url("$classuri/forbid"); ?>'
                       href="javascript:void(0)" style="color:#090">使用中</a>
                    <?php else: ?>
                    <span style="color:#090">使用中</span>
                    <?php endif; if($vo['isTest'] == 1): if(auth("$classuri/resume")): ?>
                        <span class="text-explode">|</span>
                        <a data-update="<?php echo $vo['id']; ?>" data-field='isTest' data-value='0' data-action='<?php echo url("$classuri/resume"); ?>'
                           href="javascript:void(0)" style="color:#c00">测试</a>
                        <?php else: ?>
                        <span style="color:#c00">测试</span>
                        <?php endif; else: if(auth("$classuri/forbid")): ?>
                        <span class="text-explode">|</span>
                        <a data-update="<?php echo $vo['id']; ?>" data-field='isTest' data-value='1' data-action='<?php echo url("$classuri/forbid"); ?>'
                           href="javascript:void(0)" style="color:#090">启用</a>
                        <?php else: ?>
                        <span style="color:#090">启用</span>
                        <?php endif; endif; endif; ?>
            </td>
            <td class='text-center nowrap'>
                <a data-open='<?php echo url("$classuri/ask"); ?>?hash=<?php echo $vo['hash']; ?>' data-title="请求字段列表" href="javascript:void(0)" style="color:#090">请求</a>
                <!--<a data-modal='<?php echo url("$classuri/ask"); ?>?hash=<?php echo $vo['hash']; ?>' data-title="请求字段列表" data-width="80%" href="javascript:void(0)" style="color:#090">请求</a>-->
                <span class="text-explode">|</span>
                <a data-open='<?php echo url("$classuri/res"); ?>?hash=<?php echo $vo['hash']; ?>' data-title="响应字段列表" href="javascript:void(0)" style="color:#999">响应</a>
                <!--<a data-modal='<?php echo url("$classuri/res"); ?>?hash=<?php echo $vo['hash']; ?>' data-title="响应字段列表" data-width="80%" href="javascript:void(0)" style="color:#999">响应</a>-->
            </td>
            <td class='text-center'><?php echo (isset($vo['create_at']) && ($vo['create_at'] !== '')?$vo['create_at']:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-center'><?php echo (isset($vo['update_at']) && ($vo['update_at'] !== '')?$vo['update_at']:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-center'><?php echo (isset($vo['handler_name']) && ($vo['handler_name'] !== '')?$vo['handler_name']:"<span style='color:#ccc'>暂无</span>"); ?></td>
            <td class='text-center nowrap'>
                <?php if(auth("$classuri/edit")): ?>
                <a data-modal='<?php echo url("$classuri/edit"); ?>?id=<?php echo $vo['id']; ?>' data-title="编辑接口" href="javascript:void(0)">编辑</a>
                <?php endif; if(auth("$classuri/del")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'
                   href="javascript:void(0)" style="color:#c00">删除</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; if(empty($list)): ?>
        <tr>
            <td colspan="14" style="text-align:center">没 有 记 录 了 哦 !</td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php if(isset($page)): ?><p><?php echo $page; ?></p><?php endif; ?>
</form>

<div id="tags-box" class="hide">
    <form>
        <div class="row" style='max-height:230px;overflow:auto;margin-right:0'>
            <?php foreach($tags as $key=>$tag): ?>
            <div class="col-xs-4">
                <label style="overflow:hidden;text-overflow:ellipsis;display:block;white-space:nowrap">
                    <input value="<?php echo $key; ?>" type="checkbox"/> <?php echo $tag; ?>
                </label>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center" style="margin-top:10px">
            <div class="hr-line-dashed" style="margin-top:0"></div>
            <button type="button" data-event="confirm" class="layui-btn layui-btn-small"><i class="fa fa-floppy-o"></i>
                保存设置
            </button>
            <button type="button" data-event="cancel" class="layui-btn layui-btn-danger layui-btn-small" type='button'>
                <i class="fa fa-close"></i>
                取消设置
            </button>
        </div>
    </form>
</div>

    </div>
    
<?php if(auth("$classuri/api_tagset")): ?>
<script>
    // 添加标签
    $('body').find('[data-add-tag]').map(function () {
        var self = this;
        var api_id = this.getAttribute('data-add-tag');
        var used_ids = (this.getAttribute('data-used-id') || '').split(',');
        var $content = $(document.getElementById('tags-box').innerHTML);
        for (var i in used_ids) {
            $content.find('[value="' + used_ids[i] + '"]').attr('checked', 'checked');
        }
        $content.attr('api_id', api_id);
        // 标签面板关闭
        $content.on('click', '[data-event="cancel"]', function () {
            $(self).popover('hide');
        });
        // 标签面板确定
        $content.on('click', '[data-event="confirm"]', function () {
            var tags = [];
            $content.find('input:checked').map(function () {
                tags.push(this.value);
            });
            $.form.load('<?php echo url("api_tagset"); ?>', {
                api_id: $content.attr('api_id'),
                'tags': tags.join(',')
            }, 'post');
        });
        // 限制每个表单最多只能选择八个
        $content.on('click', 'input', function () {
            ($content.find('input:checked').size() > 8) && (this.checked = false);
        });
        // 标签选择面板
        $(this).data('content', $content).on('shown.bs.popover', function () {
            $('[data-add-tag]').not(this).popover('hide');
        }).popover({
            html: true,
            trigger: 'click',
            content: $content,
            title: '设置分组（最多设置八个分组）',
            template: '<div class="popover" style="max-width:500px" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content" style="width:500px"></div></div>'
        });
    });
</script>
<?php endif; ?>

</div>