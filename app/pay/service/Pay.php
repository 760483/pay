<?php
namespace app\pay\service;
 use Think\Db;
 use app\util\ApiLog;
  class Pay   {
	 public function pay($args){
		  $order=db("pay_order"); 
		
		
		 //{"code":1,"data":{"PayID":"2","OrderID":"1526980477","OrderMoney":"10","goods_name":"demo","Merchant_url":"http%3A%2F%2Fwww.baidu.com","Return_url":"http%3A%2F%2Fwww.baidu.com","OrderDate":"20180522171437","sign":"70dbe7e85ffb3791cae800787f9c3a4c"},"msg":""} 
		 
		 if( $order->where('OrderID',$args['orderId'])->select()==null){
			 
		$channelRet= Db::table('pay_channellink')
				->alias('a')
				->join('pay_merchannel b','a.merCId = b.id')
				->join('pay_channel c','a.cId = c.id')
				->where(array('b.id'=>$args['appId']))
				->field(['b.id'=>'mId',
						'b.name'=>'mName',
						'b.parentId'=>'mParentId',
						'b.uId'=>'mUId',
						'b.url'=>'mUrl',
						'b.descript'=>'mDescript',
						'b.create_time'=>'mCreateTime',
						'b.update_time'=>'mUpdateTime',
						'b.key'=>'mKey',
						'b.rate'=>'mRate',
						'b.status'=>'mStatus',
						'c.name'=>'cName',
						'c.channelRate'=>'channelRate',
						'c.api'=>'api',						 
						'a.cId'=>'cId',
						'c.appId'=>'appId',
						'c.url'=>'url',
						'c.param'=>'param',
						'c.notify_url'=>'cNotifyUrl',
						'c.status'=>'channelStatus'
				])
				->find(); 
					
			 if($channelRet==null){
				 
				  return array("msg"=>'通道未配置');
			 }
			 
			 if($channelRet['channelStatus']!=1){
				 
				 return array("msg"=>'通道被禁用');
			 }
			
			 $sign=$args['sign'];
			 unset($args['sign']);
			$preArr = array_merge($args, ['key' => $channelRet['mKey']]);  
			 ksort($preArr); 
			$preArr= http_build_query($preArr);
		 
			 
			 
			 if(md5(urldecode($preArr))!= $sign){
				 return array("msg"=>'签名不正确'); 
			 } 
			 
			 
			$data['orderId'] =$args['orderId'];
			$data['uId']=$channelRet['mUId'];
			$data['orderDate'] =$args['orderDate'];
			$data['tradeMoney'] =$args['orderMoney'];
			$data['orderMoney'] =$args['orderMoney'];
			$data['merMoney']=$args['orderMoney']*(1-$channelRet["mRate"]);
			$data['channelMoney']=$args['orderMoney']*$channelRet["channelRate"];
			$data['rateMoney']=$args['orderMoney']*($channelRet["mRate"]-$channelRet["channelRate"]);
			$data['channelId']=$channelRet['cId'];
			$data['returnUrl'] =$args['returnUrl'];
			$data['notifyUrl'] =$args['notifyUrl'];
			$data['merChannel']=$channelRet['mId'];
			$data['cTime'] =time();
			$data['mTime'] =time();
			$data['productName']=$args['productName']; 
			$data['bank']=$args['bank'];
			$data['skuId']=isset($args['skuId'])?$args['skuId']:0;
			if(isset($args['skuId'])&&$args['skuId']>0)
			{
				$data['orderType']=sysconf('type');
			}else{
				$data['orderType']=0;
			}
			  			
			$ret=$order->insertGetId($data);  
			$data['id']=$ret;  
			
		    $class = new \ReflectionClass( $channelRet['api'] ); // 建立 Person这个类的反射类   
            $instance  = $class->newInstanceArgs(); 
		 
			return   $instance->pay($data,$channelRet);
			
			 
			 
		 }else{
			 return array("msg"=>'订单已存在');
		 }
		 
		 
		 
		 
		 
		// return $args;
	 }
	 
    
}
