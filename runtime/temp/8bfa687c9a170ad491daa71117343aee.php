<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"C:\wamp64\www\pay/app/wiki\view\index.detail.html";i:1526461055;s:46:"C:\wamp64\www\pay\app\extra\view\api.main.html";i:1526461055;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title><?php echo sysconf('site_name'); ?> - <?php echo $title; ?></title>
    <script>window.ROOT_URL = '__PUBLIC__';</script>
    <link rel="shortcut icon" href="<?php echo sysconf('browser_icon'); ?>"/>
    <link rel="stylesheet" href="__PUBLIC__/static/plugs/semantic/semantic.min.css?ver=<?php echo date('ymd'); ?>">
    
<link rel="stylesheet" href="__PUBLIC__/static/plugs/jsonFormater/jsonFormater.css?ver=<?php echo date('ymd'); ?>"/>

</head>

<body>
<br/>

<div class="ui container">
    <div class="ui floating message">
        <h1 class="ui header"><?php echo sysconf('site_name'); ?> - <?php echo $title; ?> <?php echo sysconf('app_version'); ?></h1>
        <a href="<?php echo url('/wiki'); ?>">
            <button class="ui green button" style="margin-top: 15px">返回文档首页</button>
        </a>
        <div class="ui segment">
            <div class="ui items">
                <div class="item">
                    <div class="image">
                        <img src="<?php echo (isset($group['img']) && ($group['img'] !== '')?$group['img']:'__PUBLIC__/static/api/img/api_default.jpg'); ?>">
                    </div>
                    <div class="content">
                        <span class="header"><?php echo $group['name']; ?></span>
                        <div class="description">
                            <p><?php echo (isset($group['description']) && ($group['description'] !== '')?$group['description']:"<span style='color:#ccc'>太懒了,没写...</span>"); ?></p>
                        </div>
                        <div class="extra">
                            <?php echo (isset($group['detail']) && ($group['detail'] !== '')?$group['detail']:"<span style='color:#ccc'>太懒了,没写...</span>"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui teal big message" id="msg">接口访问地址：<?php echo $http_type.$api_url.$hash; ?></div>
        <div class="ui grid">
            <div class="four wide column">
                <div class="ui vertical menu" style="width: 100%;overflow: auto;">
                    <?php if(is_array($apiList) || $apiList instanceof \think\Collection || $apiList instanceof \think\Paginator): $i = 0; $__LIST__ = $apiList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <a class="<?php if($hash == $vo['hash']): ?>active<?php endif; ?> teal item"
                            href="<?php echo url('/wiki/'.$gid.'/'.$vo["hash"]); ?>">
                        <?php echo mb_substr($vo['info'], 0, 11); ?>...
                        <div class="ui <?php if($hash== $vo['hash']): ?>teal<?php endif; ?> label"> &gt;</div>
                        </a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="twelve wide column">
            <div class="ui floating message" id="detail" style="overflow: auto;">
                <h2 class='ui header'>接口唯一标识：<a target="_blank" href="<?php echo $http_type.$api_url.$hash; ?>"><?php echo $hash; ?></a>（<?php echo $detail['apiName']; ?>）
                </h2><br/>
                <div class="ui raised segment">
                    <span class="ui red ribbon large label">接口说明</span>
                    <?php if($detail['status'] == 0): ?>
                        <span class='ui red label large'><i class="usb icon"></i>禁用</span>
                    <?php else: if($detail['isTest'] == 1): ?>
                            <span class='ui teal label large'><i class="usb icon"></i>测试</span>
                        <?php else: ?>
                            <span class='ui green label large'><i class="usb icon"></i>启用</span>
                        <?php endif; endif; ?>
                    <span class="ui teal label large"><i class="certificate icon"></i><?php echo sysconf('app_version'); ?></span>
                    <span class="ui blue large label"><i class="chrome icon"></i>
                    <?php switch($detail['method']): case "1": ?>POST<?php break; case "2": ?>GET<?php break; default: ?>不限
                    <?php endswitch; ?>
                    </span>
                    <div class="ui message">
                        <p><?php echo $detail['info']; ?></p>
                    </div>
                </div>
                <div class="ui pointing large blue four item menu">
                    <a class="item active" data-tab="first">请求参数</a>
                    <a class="item" data-tab="second">请求模拟</a>
                    <a class="item" data-tab="third">返回参数</a>
                    <a class="item" data-tab="fourth">返回示例</a>
                </div>
                <!-- 请求参数 -->
                <div class="ui tab segment active" data-tab="first">
                    <h3>公共请求参数【请在Header头里面传递】</h3>
                    <table class="ui orange celled striped table">
                        <thead>
                        <tr>
                            <th>参数名字</th>
                            <th>类型</th>
                            <th width="80">是否必须</th>
                            <th width="10%">默认值</th>
                            <th>说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>version</td>
                            <td>String</td>
                            <td><span class="ui green label">必填</span></td>
                            <td><?php echo sysconf('app_version'); ?></td>
                            <td>API版本号【请在Header头里面传递】</td>
                        </tr>
                        <tr>
                            <td>access-token</td>
                            <td>String</td>
                            <td><?php echo $detail['accessToken']==1?'<span class="ui green label">必填</span>':'<span
                                    class="ui red label">勿填</span>'; ?>
                            </td>
                            <td></td>
                            <td>APP认证秘钥【请在Header头里面传递】</td>
                        </tr>
                        <tr>
                            <td>user-token</td>
                            <td>String</td>
                            <td><?php echo $detail['needLogin']==1?'<span class="ui green label">必填</span>':'<span
                                    class="ui red label">勿填</span>'; ?>
                            </td>
                            <td></td>
                            <td>登录检测:用户userID【请在Header头里面传递】</td>
                        </tr>
                        </tbody>
                    </table>
                    <h3>请求参数</h3>
                    <table class="ui red celled striped table">
                        <thead>
                        <tr>
                            <th width="12%">参数名字</th>
                            <th>类型</th>
                            <th width="80">是否必须</th>
                            <th width="10%">默认值</th>
                            <th width="10%">其他</th>
                            <th>说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($request) || $request instanceof \think\Collection || $request instanceof \think\Paginator): $i = 0; $__LIST__ = $request;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $vo['fieldName']; ?></td>
                            <td><?php echo $dataType[$vo['dataType']]; ?></td>
                            <td><?php echo $vo['isMust']==1?'<span class="ui green label">必填</span>':'<span class="ui teal label">可选</span>'; ?>
                            </td>
                            <td><?php echo $vo['default']; ?></td>
                            <td><?php echo $vo['range']; ?></td>
                            <td><?php echo $vo['info']; ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- 请求模拟 -->
                <div class="ui tab segment" data-tab="second">
                    <h3>公共请求模拟参数【请在Header头里面传递】</h3>
                    <table class="ui orange celled striped table pub">
                        <thead>
                        <tr>
                            <th>参数名字</th>
                            <th>类型</th>
                            <th width="80">是否必须</th>
                            <th width="10%">默认值</th>
                            <th>请求值</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>version</td>
                            <td>String</td>
                            <td><span class="ui green label">必填</span></td>
                            <td><?php echo sysconf('app_version'); ?></td>
                            <td class="ui input focus" style="width:100%;">
                                <input name="version" value="<?php echo sysconf('app_version'); ?>" placeholder="API版本号"/>
                            </td>
                        </tr>
                        <tr>
                            <td>access-token</td>
                            <td>String</td>
                            <td><?php echo $detail['accessToken']==1?'<span class="ui green label">必填</span>':'<span
                                    class="ui red label">勿填</span>'; ?>
                            </td>
                            <td></td>
                            <td class="ui input <?php echo $detail['accessToken']==1?'focus':'error'; ?>" style="width:100%;">
                                <input name="access-token" value="" placeholder="APP认证秘钥" <?php echo $detail['accessToken']==1?$detail['accessToken']:'readonly'; ?> />
                            </td>
                        </tr>
                        <tr>
                            <td>user-token</td>
                            <td>String</td>
                            <td><?php echo $detail['needLogin']==1?'<span class="ui green label">必填</span>':'<span
                                    class="ui red label">勿填</span>'; ?>
                            </td>
                            <td></td>
                            <td class="ui input <?php echo $detail['needLogin']==1?'focus':'error'; ?>" style="width:100%;">
                                <input name="user-token" value="" placeholder="用户userID" <?php echo $detail['needLogin']==1?$detail['needLogin']:'readonly'; ?>/>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <h3>请求模拟参数</h3>
                    <form onsubmit="return false" method="<?php echo $detail['method']==1?'post':'get'; ?>" enctype="multipart/form-data" id="submit_data">
                        <table class="ui red celled striped table pri">
                            <thead>
                            <tr>
                                <th>参数名字</th>
                                <th>类型</th>
                                <th width="80">是否必须</th>
                                <th width="10%">默认值</th>
                                <th>请求值</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($request) || $request instanceof \think\Collection || $request instanceof \think\Paginator): $i = 0; $__LIST__ = $request;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <td><?php echo $vo['fieldName']; ?></td>
                                        <td><?php echo $dataType[$vo['dataType']]; ?></td>
                                        <td><?php echo $vo['isMust']==1?'<span class="ui green label">必填</span>':'<span class="ui teal label">可选</span>'; ?>
                                        </td>
                                        <td>
                                            <?php echo $vo['default']; if($dataType[$vo['dataType']] == 'File'): ?>
                                                <img src="__PUBLIC__/static/plugs/uploader/theme/image.png" id="img_show" style="width: 50px;height: 34px;">
                                            <?php endif; ?>
                                        </td>
                                        <td class="ui input focus" style="width:100%;">
                                            <?php if($dataType[$vo['dataType']] == 'File'): ?>
                                                <input type="file" name="file[]" id="file_upload" multiple="multiple">
                                                <input type="hidden" name="<?php echo $vo['fieldName']; ?>" id="file_url">
                                            <?php else: ?>
                                                <input type="text" name="<?php echo $vo['fieldName']; ?>" value="<?php echo $vo['default']; ?>" placeholder="<?php echo $vo['info']; ?>">
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </form>
                    <!-- http模拟 -->
                    <div class="ui labeled input" style="width: 80%;">
                        <div class="ui label"><?php echo $http_type; ?></div>
                        <input type="text" value="<?php echo $api_url.$hash; ?>" readonly>
                        <input type="hidden" value="<?php echo $url; ?>" id="api_url">
                        <select class="ui compact selection dropdown" name="request_type" style="padding-top: 8px;">
                            <option <?php echo $detail['method']==1?$detail['method']:'selected'; ?> value="GET">GET</option>
                            <option <?php echo $detail['method']==2?$detail['method']:'selected'; ?> value="POST">POST</option>
                        </select>
                        <div type="submit" id="submit" class="ui button">发送</div>
                    </div>
                    <!-- 模拟返回参数 -->
                    <div class="ui tab segment active">
                        <pre id="json_output" style='font-family: Arial;'></pre>
                    </div>
                </div>
                <!-- 返回参数 -->
                <div class="ui tab segment" data-tab="third">
                    <h3>公共返回参数</h3>
                    <table class="ui olive celled striped table">
                        <thead>
                        <tr>
                            <th>返回字段</th>
                            <th>类型</th>
                            <th>说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>code</td>
                            <td>Integer</td>
                            <td>返回码，详情请参阅<a href="<?php echo url('/wiki/errorcode'); ?>">错误码说明</a></td>
                        </tr>
                        <tr>
                            <td>msg</td>
                            <td>String</td>
                            <td>错误描述，当请求成功时可能为空</td>
                        </tr>
                        <tr>
                            <td>debug</td>
                            <td>String</td>
                            <td>调试字段，如果没有调试信息会没有此字段(生产环境下将关闭此字段)</td>
                        </tr>
                        </tbody>
                    </table>
                    <h3>返回参数</h3>
                    <table class="ui green celled striped table">
                        <thead>
                        <tr>
                            <th>返回字段</th>
                            <th>类型</th>
                            <th>说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($response) || $response instanceof \think\Collection || $response instanceof \think\Paginator): $i = 0; $__LIST__ = $response;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $vo['showName']; ?></td>
                            <td><?php echo $dataType[$vo['dataType']]; ?></td>
                            <td><?php echo $vo['info']; ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- 返回示例 -->
                <div class="ui tab segment" data-tab="fourth">
                    <pre id="json" style='font-family: Arial;'></pre>
                </div>
                <div class="ui blue message">
                    <strong>温馨提示：</strong> 此接口参数列表根据后台代码自动生成，如有疑问请咨询后端开发
                </div>
            </div>
        </div>
        <p>&copy; Powered By <a href="/" target="_blank"><?php echo sysconf('site_copy'); ?></a>
        <p>
    </div>
</div>


<script type="text/javascript" src="__PUBLIC__/static/plugs/jquery/jquery-3.2.1.min.js?ver=<?php echo date('ymd'); ?>"></script>
<script type="text/javascript" src="__PUBLIC__/static/plugs/jquery/jquery.form.js?ver=<?php echo date('ymd'); ?>"></script>
<script type="text/javascript" src="__PUBLIC__/static/plugs/jsonFormater/jsonFormater.js?ver=<?php echo date('ymd'); ?>"></script>
<script type="text/javascript" src="__PUBLIC__/static/plugs/semantic/components/tab.min.js?ver=<?php echo date('ymd'); ?>"></script>
<script>
    // tab标签切换
    $('.pointing.menu .item').tab();

    // 请求示例json显示
    $(document).ready(function () {
        var s = function () {
            var options = {
                dom: '#json',
                isCollapsible: true,
                quoteKeys: true,
                tabSize: 2,
                imgCollapsed: "__PUBLIC__/static/plugs/jsonFormater/Collapsed.gif",
                imgExpanded: "__PUBLIC__/static/plugs/jsonFormater/Expanded.gif"
            };
            window.jf = new JsonFormater(options);
            jf.doFormat('<?php echo $detail["returnStr"]; ?>');
        }();
    });
    $('.ui .vertical').css('max-height', $('#detail').outerHeight(true));

    // 请求模拟
    $(function(){
        //得到文件上传文件的真实缓存地址
        function getObjectURL(file) {
            var url = null;
            if (window.createObjectURL != undefined) { // basic
                url = window.createObjectURL(file)
            } else if (window.URL != undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file)
            } else if (window.webkitURL != undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file)
            }
            return url;
        }

        //修改file类型input提交表单的文件真实地址
        $("#file_upload").change(function () {
            var objUrl = getObjectURL(this.files[0]);
            var file = $("#file_upload").val();
            var filename = file.replace(/.*(\/|\\)/, "");
            var fileType = ['jpg', 'bmp', 'gif', 'png', 'jpeg'];
            var fileExt = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename.toLowerCase()) : '';
            if (objUrl) {
                if (($.inArray(fileExt[0], fileType)) !== -1) {
                    $("#img_show").attr("src", objUrl);
                } else {
                    $("#img_show").attr("src", '__PUBLIC__/static/plugs/uploader/theme/image.png');
                }
                $("#file_url").val(objUrl);
            }
        });

        //模拟发送测试 并显示返回json
        $("#submit").on("click",function(){
            // jquery.form代替ajax提交text+file类型
            var data = {
                url: $("#api_url").val(),
                type: $("select").val(),
                headers: $(".pub td input").serializeJson(),
                dataType: 'json',
                success: function (res) {
                    var options = {
                        dom: '#json_output',
                        isCollapsible: true,
                        quoteKeys: true,
                        tabSize: 2,
                        imgCollapsed: "__PUBLIC__/static/plugs/jsonFormater/Collapsed.gif",
                        imgExpanded: "__PUBLIC__/static/plugs/jsonFormater/Expanded.gif"
                    };
                    window.jf = new JsonFormater(options);
                    $("#json_output").html(jf.doFormat(res));
                },
                error: function (error) {
                    console.log(error)
                }
            };
            $("#submit_data").ajaxSubmit(data);
        });
    });

    //jquery 表单数据序列化转换为json对象
    (function ($) {
        $.fn.serializeJson = function () {
            var serializeObj = {};
            var array = this.serializeArray();
            var str = this.serialize();
            $(array).each(function () {
                if (serializeObj[this.name]) {
                    if ($.isArray(serializeObj[this.name])) {
                        serializeObj[this.name].push(this.value);
                    } else {
                        serializeObj[this.name] = [serializeObj[this.name], this.value];
                    }
                } else {
                    serializeObj[this.name] = this.value;
                }
            });
            return serializeObj;
        };
    })(jQuery);

</script>

</body>

</html>