<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"C:\wamp64\www\pay/app/wiki\view\login.index.html";i:1526461055;s:46:"C:\wamp64\www\pay\app\extra\view\api.main.html";i:1526461055;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title><?php echo sysconf('site_name'); ?> - <?php echo $title; ?></title>
    <script>window.ROOT_URL = '__PUBLIC__';</script>
    <link rel="shortcut icon" href="<?php echo sysconf('browser_icon'); ?>"/>
    <link rel="stylesheet" href="__PUBLIC__/static/plugs/semantic/semantic.min.css?ver=<?php echo date('ymd'); ?>">
    
<style type="text/css">
    body {
        background-color: #DADADA;
    }
    .grid {
        height: 100%;
    }
    .image {
        margin-top: -100px;
    }
    .column {
        max-width: 450px;
    }
</style>

</head>

<body>
<br/>

<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
            <div class="content">
                欢迎使用<?php echo sysconf('site_name'); ?>在线文档 <?php echo sysconf('app_version'); ?>
            </div>
        </h2>
        <form class="ui large form" onsubmit="return false;" method="post">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="text" name="key" placeholder="请输入您的文档访问密钥">
                    </div>
                </div>
                <div class="ui fluid large teal submit button">访 问</div>
            </div>
            <div class="ui error message"></div>
        </form>
        <div class="ui message">
            如果您还没有文档访问密钥，请联系API管理员获取！
        </div>
    </div>
</div>


<script type="text/javascript" src="__PUBLIC__/static/plugs/jquery/jquery-3.2.1.min.js?ver=<?php echo date('ymd'); ?>"></script>
<script type="text/javascript" src="__PUBLIC__/static/plugs/layui/layui.all.js?ver=<?php echo date('ymd'); ?>"></script>
<script type="text/javascript" src="__PUBLIC__/static/plugs/semantic/components/form.min.js?ver=<?php echo date('ymd'); ?>"></script>
<script type="text/javascript" src="__PUBLIC__/static/plugs/semantic/components/transition.min.js?ver=<?php echo date('ymd'); ?>"></script>
<script type="text/javascript" src="__PUBLIC__/static/api/js/login.js?ver=<?php echo date('ymd'); ?>"></script>

</body>

</html>