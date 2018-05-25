<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"C:\wamp64\www\pay/app/wiki\view\index.index.html";i:1526461055;s:46:"C:\wamp64\www\pay\app\extra\view\api.main.html";i:1526461055;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title><?php echo sysconf('site_name'); ?> - <?php echo $title; ?></title>
    <script>window.ROOT_URL = '__PUBLIC__';</script>
    <link rel="shortcut icon" href="<?php echo sysconf('browser_icon'); ?>"/>
    <link rel="stylesheet" href="__PUBLIC__/static/plugs/semantic/semantic.min.css?ver=<?php echo date('ymd'); ?>">
    
</head>

<body>
<br/>

<div class="ui text container" style="max-width: none !important;">
    <div class="ui floating message">
        <h1 class="ui header"><?php echo sysconf('site_name'); ?> - <?php echo $title; ?> <?php echo sysconf('app_version'); ?></h1>
        <a href="<?php echo url('/wiki/errorcode'); ?>">
            <button class="ui red button" style="margin-top: 15px">错误码说明</button>
        </a>
        <a href="<?php echo url('/wiki/calculation'); ?>">
            <button class="ui orange button" style="margin-top: 15px">算法详解</button>
        </a>
        <div class="ui teal message">
            <strong>API统一访问地址：</strong> <?php echo $api_url; ?>接口唯一标识(hash)
        </div>
        <div class="ui floating message">
            <div class="content">
                <div class="header" style="margin-bottom: 15px">接口状态说明：</div>
                <p><span class='ui teal label'>测试</span> 系统将不过滤任何字段，也不进行AccessToken的认证，但在必要的情况下会进行UserToken认证！</p>
                <p><span class='ui blue label'>启用</span> 系统将严格过滤请求字段，并且进行全部必要认证！</p>
                <p><span class='ui red label'>禁用</span> 系统将拒绝所有请求，一般应用于危机处理！</p>
            </div>
            <br>
            <div class="content">
                <div class="header" style="margin-bottom: 15px">参数字段状态说明：</div>
                <p><span class="ui green label">必填</span> 系统将严格获取请求字段，必填字段,无值时请传默认值！</p>
                <p><span class="ui teal label">可选</span> 系统按需获取请求字段，可填字段,无值时自动采用接口事先设定默认值！</p>
            </div>
        </div>
        <!--测试-->
        <?php $vo['id'] = 1; ?>
        <div class="ui cards four column">
            <!--循环-->
            <?php if(is_array($apiGroup) || $apiGroup instanceof \think\Collection || $apiGroup instanceof \think\Paginator): $i = 0; $__LIST__ = $apiGroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="card column">
                <a class="image" href="<?php echo url('/wiki/'.$vo['id']); ?>">
                    <img src="<?php echo (isset($vo['img']) && ($vo['img'] !== '')?$vo['img']:'__PUBLIC__/static/api/img/api_default.jpg'); ?>" style="height: 177.72px;">
                </a>
                <div class="content">
                    <a class="header" href="<?php echo url('/wiki/'.$vo['id']); ?>">
                        <?php echo $vo['name']; ?>
                    </a>
                    <a class="meta" href="<?php echo url('/wiki/'.$vo['id']); ?>">
                        <span class="group" style="font-size: 0.8em;"><?php echo $vo['create_at']; ?></span>
                    </a>
                    <a class="description" style="display: block;font-size: 0.8em;" href="<?php echo url('/wiki/'.$vo['id']); ?>">
                        <?php 
                            $len = mb_strlen($vo['description'], 'utf8');
                            if($len > 31) {
                                echo mb_substr($vo['description'], 0, 31, 'utf8') . '...';
                            } else {
                                echo $vo['description'];
                            }
                         ?>
                    </a>
                </div>
                <div class="extra content" style="font-size: 0.9em">
                    <a class="right floated created" href="<?php echo url('/wiki/'.$vo['id']); ?>">
                        <i class="fire icon"></i>
                        热度<?php echo num2String($vo['hot_num']); ?>
                    </a>
                    <a class="friends" href="<?php echo url('/wiki/'.$vo['id']); ?>">
                        <i class="cubes icon"></i>
                        共<?php echo $vo['apiNum']; ?>个接口
                    </a>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <p>&copy; Powered By <a href="/" target="_blank"><?php echo sysconf('site_copy'); ?></a>
        <p>
    </div>
</div>


</body>

</html>