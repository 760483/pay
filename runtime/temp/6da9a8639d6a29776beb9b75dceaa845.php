<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"C:\wamp64\www\pay/app/demo\view\plugs.region.html";i:1531474543;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1531474545;}*/ ?>
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
        

<div class="code">
    <blockquote class="site-text layui-elem-quote">
        PCAS 单文件JS省市区插件（也适用于Wap端）
    </blockquote>
    <div id="demo" class="citys">
        <div class="layui-input-inline">
            <select class="layui-select" name="province"></select>
        </div>
        <div class="layui-input-inline">
            <select class="layui-select" name="city"></select>
        </div>
        <div class="layui-input-inline">
            <select class="layui-select" name="area"></select>
        </div>
    </div>
    <pre class="layui-code" lay-title="HTML代码">

<div class="citys">
    <div class="layui-input-inline">
        <select class="layui-select" name="province"></select>
    </div>
    <div class="layui-input-inline">
        <select class="layui-select" name="city"></select>
    </div>
    <div class="layui-input-inline">
        <select class="layui-select" name="area"></select>
    </div>
</div>
    </pre>
    <pre class="layui-code" lay-title="javascript代码">

require(['pcasunzips'], function () {
    /**   // 省市联动
    *   new PCAS("Province","City")
    *   new PCAS("Province","City","吉林省")
    *   new PCAS("Province","City","吉林省","吉林市")
    *   // 省市地区联动
    *   new PCAS("Province","City","Area")
    *   new PCAS("Province","City","Area","吉林省")
    *   new PCAS("Province","City","Area","吉林省","松原市")
    *   new PCAS("Province","City","Area","吉林省","松原市","宁江区")
    *   // 省、市、地区对象取得的值均为实际值。
    *   // 注：省、市、地区提示信息选项的值为""(空字符串)
    */
    // 实例化PCAS插件
    new PCAS('province', 'city', 'area', '广东省', '广州市', '海珠区');
});
    </pre>
    <script>
        require(['pcasunzips'], function () {
            new PCAS('province', 'city', 'area', '广东省', '广州市', '海珠区');
        });
    </script>
</div>

<script>
    layui.use('code', function () {
        layui.code({encode: true});
    });
</script>

    </div>
    
</div>