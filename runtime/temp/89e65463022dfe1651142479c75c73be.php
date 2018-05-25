<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"C:\wamp64\www\pay/app/demo\view\plugs.editor.html";i:1526461055;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1526461055;}*/ ?>
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
        

<!--<div class="code">-->
    <!--<blockquote class="site-text layui-elem-quote">-->
        <!--富文本编辑器-->
    <!--</blockquote>-->
    <div style="position:relative">
        <textarea name="content">这里可以放默认值</textarea>
        <script>
            require(['ckeditor'], function () {
                var editor = window.createEditor('[name="content"]');
                // 设置内容
                editor.setData('修改内容');
                // 获取内容
                var content = editor.getData();
                console.log(content);
            });
        </script>
    </div>

    <pre class="layui-code" lay-title="HTML代码">

<textarea name="content">这里可以放默认值</textarea>
    </pre>

    <pre class="layui-code" lay-title="javascript代码">

require(['ckeditor'], function () {
    var editor = window.createEditor('[name="content"]');
    // 设置内容
    editor.setData('修改内容');
    // 获取内容
    var content = editor.getData();
    console.log(content);
});

    </pre>
</div>

<script>
    layui.use('code', function () {
        layui.code({encode: true});
    });
</script>

    </div>
    
</div>