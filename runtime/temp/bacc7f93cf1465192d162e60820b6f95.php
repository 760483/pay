<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"C:\wamp64\www\pay/app/admin\view\index.main.html";i:1531455599;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1531455603;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
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
        
<div class="row">
    <div class="col-lg-6">
        <table class="layui-box layui-table" lay-even lay-skin="line">
            <colgroup>
                <col width="30%">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th class="text-left" colspan="2">系统信息</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo sysconf('app_name'); ?> 版本</td>
                <td><?php echo sysconf('app_version'); ?></td>
            </tr>
            <tr>
                <td>ThinkPHP 版本</td>
                <td><?php echo THINK_VERSION; ?></td>
            </tr>
            <tr>
                <td>服务器操作系统</td>
                <td><?php echo php_uname('s'); ?></td>
            </tr>
            <tr>
                <td>WEB运行环境</td>
                <td><?php echo php_sapi_name(); ?></td>
            </tr>
            <tr>
                <td>MySQL数据库版本</td>
                <td><?php echo $mysql_ver; ?></td>
            </tr>
            <tr>
                <td>运行PHP版本</td>
                <td><?php echo phpversion(); ?></td>
            </tr>
            <tr>
                <td>上传大小限制</td>
                <td><?php echo ini_get('upload_max_filesize'); ?></td>
            </tr>
            <tr>
                <td>POST大小限制</td>
                <td><?php echo ini_get('post_max_size'); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

    </div>
    
</div>