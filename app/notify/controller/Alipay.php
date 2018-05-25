<?php
namespace app\notify\controller;
use controller\BasicApi;
use service\PayRetService;
/**
*支付宝回调
*/ 
class Alipay  extends  BasicApi{
	 
	 public function notify()
    {
		PayRetService::success(130);
		 return 1;
	}
	  //表单提交支付
     
 
    
        
}
?>
