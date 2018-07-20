<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"C:\wamp64\www\pay/app/demo\view\pay.first.html";i:1531812178;s:51:"C:\wamp64\www\pay\app\extra\view\admin.content.html";i:1531474545;}*/ ?>
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
         

<div>
	<p>开始准备,向平台申请appid和appkey 由管理人员发放appid和appkey及demo <small>demo提供php文件 restful api模式 </small>
        上传支付域名,可二级域名支付 需上传主域名
        
    支持支付宝微信转账

    源码购买 免费搭建php环境和安卓配置 ,提供一个月技术支持
</p>




</div>
 

 

    </div>
    
</div>