<?php
namespace app\api\controller;
use controller\BasicApi;
use service\PayRetService;
/**
*支付宝回调
*/ 
class Alipay  extends  BasicApi{
	 
	 public function notify()
    {
		PayRetService::success(1);
		 
	}

     
 
    
        
}
?>
