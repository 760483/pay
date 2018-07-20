<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:46:"C:\wamp64\www\pay/app/pay\view\pay\qr_pay.html";i:1531474550;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>basic example</title>
</head>
<body>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script   src="__PUBLIC__/static/pay/js/qrcode.js"></script>
<script   src="__PUBLIC__/static/pay/js/jquery.qrcode.js"></script>
 
 
 
<div id="qrcodeTable"></div>
 
 
<script>
	//jQuery('#qrcode').qrcode("this plugin is great");
	jQuery('#qrcodeTable').qrcode("<?php echo $url; ?>");	
	 
</script>

</body>
</html>
