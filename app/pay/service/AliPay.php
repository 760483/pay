<?php
namespace app\pay\service;
 
  class AliPay   {
	 public function pay($order,$channelRet){  
		 
		 
		$config = json_decode(html_entity_decode($channelRet['param']),true);
		
		$biz_content=array(
			'out_trade_no'=>$order['id'],
			'total_amount'=>$order['trademoney'],
			'subject'=>$order['ProductName']
		);
		
	 $config['timestamp']=date( $config['timestamp'],time());
		
		$param=array_merge($config,array(
			'app_id'=>$channelRet['app_id'], 			 
			'notify_url'=>$channelRet['notify_url'],
			'biz_content'=>json_encode($biz_content,JSON_UNESCAPED_UNICODE) 
		)); 
	//	$ret= postRequest($channelRet['url'],$param);
		 return array('url'=>$channelRet['url'].'?'.a2s($param));
	 
	 }
	 
    
}
