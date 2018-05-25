<?php
namespace app\pay\service;
 use Think\Db;
  class Pay   {
	 public function pay($args){
		  $order=db("pay_order");
		 
		
		 //{"code":1,"data":{"PayID":"2","OrderID":"1526980477","OrderMoney":"10","goods_name":"demo","Merchant_url":"http%3A%2F%2Fwww.baidu.com","Return_url":"http%3A%2F%2Fwww.baidu.com","OrderDate":"20180522171437","sign":"70dbe7e85ffb3791cae800787f9c3a4c"},"msg":""} 
		 
		 if( $order->where('OrderID',$args['OrderID'])->select()==null){
			 
		$channelRet= Db::table('pay_channellink')
				->alias('a')
				->join('pay_merchannel b','a.merCId = b.id')
				->join('pay_channel c','a.cId = c.id')
				->where(array('b.id'=>$args['app_id']))
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
						'c.appId'=>'app_id',
						'c.url'=>'url',
						'c.param'=>'param',
						'c.notify_url'=>'notify_url'
				])
				->find(); 
					
			 if($channelRet==null){
				 
				  return array("msg"=>'通道未配置');
			 }
			 
			 if($channelRet['mKey']!=$args['key']){
				 return array("msg"=>'key不正确');
				 
			 }
			 
			$data['OrderID'] =$args['OrderID'];
			 $data['UserID']=$channelRet['mUId'];
			$data['OrderDate'] =$args['OrderDate'];
			$data['trademoney'] =$args['OrderMoney'];
			$data['OrderMoney'] =$args['OrderMoney'];
			$data['mermoney']=$args['OrderMoney']*(1-$channelRet["mRate"]);
			$data['channelmoney']=$args['OrderMoney']*$channelRet["channelRate"];
			$data['RateMoney']=$args['OrderMoney']*($channelRet["mRate"]-$channelRet["channelRate"]);
			$data['channelId']=$channelRet['cId'];
			$data['return_url'] =$args['return_url'];
			$data['notify_url'] =$args['notify_url'];
			$data['cTime'] =time();
			$data['mTime'] =time();
			$data['ProductName']=$args['ProductName']; 
			$data['bank']=$args['bank'];
			  			
			$ret=$order->insertGetId($data);  
			$data['id']=$ret;  
			
		    $class = new \ReflectionClass( $channelRet['api'] ); // 建立 Person这个类的反射类   
            $instance  = $class->newInstanceArgs(); 
		 
			return    $instance->pay($data,$channelRet);
			
			 
			 
		 }else{
			 return array("msg"=>'订单已存在');
		 }
		 
		 
		 
		 
		 
		// return $args;
	 }
	 
    
}
