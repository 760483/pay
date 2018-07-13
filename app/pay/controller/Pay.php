<?php
namespace app\pay\controller;
use app\common\controller\Common;  
use Think\View;
class Pay  extends  Common{
	 
	 function qrPay(){
		$url=input('url'); 
		$url= urldecode($url);
		
		$view = new View();
		$view->url = $url; 
	return $view->fetch();
		 
		 
		 
	 }        
}
?>
