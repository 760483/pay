<?php
namespace app\notify\controller;
use controller\BasicApi;
use service\PayRetService;
/**
*支付宝回调
*/ 
class Index  extends  BasicApi{
	 
	 public function notify()
    {
		 $param=json_decode(base64_decode(urldecode( $this->request->post('param'))),true); 
		 $sign=input('sign');
		 $order=db('pay_order')->where(array('id'=>$param['mark']))->find();
		 if($order==null){
			 return;
		 }
		 
		 if($param['money']!=$order['tradeMoney'])
		 {
			 return;
		 }
		 
		 $order['status']=1;
		 $order['mTime']=time();
		 
		 db('pay_order')->where(array('id'=>$order['id']))->update($order);
		 //mark money billNo type  
		 PayRetService::success($order['id']);
		 return 'ok';
	}
	  //表单提交支付
     
 
    
        
}
?>
