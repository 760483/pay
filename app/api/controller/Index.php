<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace app\api\controller;

use controller\BasicApi;
use Think\Db;

/**
 * API index类
 * Class Index
 * @package app\api\controller
 */
class Index extends BasicApi
{
    /**
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function index()
    {
		 
      $class = new \ReflectionClass('app\pay\service\Pay' ); // 建立  反射类   
      $instance  = $class->newInstanceArgs();  
	 // $OrderID = $this->request->post('OrderMoney');
	  
	  $param=input('param');
	  $param=urldecode($param);
	  $param=base64_decode($param);
	  $param=json_decode($param,true); 
	  
	  if($param==null){		  
		  return  $this->buildFailed( 0,"参数不能为空" );  
		  
	  }
	  
	  
	  
	  
	   if(!isset($param['appId'])||$param['appId']<=0){		
			return  $this->buildFailed( 0,"appId不能为空" );  	 
		  
	  }
	  
	   if(!isset($param['orderMoney'])||$param['orderMoney']<=0){	
		return  $this->buildFailed( 0,"金额错误" );  	 	   
		 
	  }
	  
	  
	   if(!isset($param['orderDate'])||$param['orderDate']<=0){		  
		return  $this->buildFailed( 0,"订单时间" ); 
		 
		  
	  }
	   if(!isset($param['orderId'])||$param['orderId']<=0){		  
		 
		return  $this->buildFailed( 0,"订单号不能为空" ); 		
		  
	  }
	   if(!isset($param['returnUrl'])){		  
		 
		  return  $this->buildFailed( 0,"同步回调错误" ); 
	  }
	   if(!isset($param['notifyUrl'])){		  
	 
		return  $this->buildFailed( 0,"通知地址错误" ); 
	  }
	  
	  
	     if(!isset($param['productName'])){		  
		 
		  return  $this->buildFailed( 0,"产品名称不能空" ); 
	  }
	  
	  if(!isset($param['sign'])){		  
		    
		  return  $this->buildFailed( 0,"签名不能为空" ); 
	  }
	  
	  
	  
	  
	  $ip=request()->ip();
	 
	  
	$mer=  db('pay_merchannel')->where(array('id'=>$param['appId']))->find();
	  
	  
	  if($mer==null){ 
	    return  $this->buildFailed( 0,"商户通道不存在" ); 
		  
		  
	  }
	  if($mer['status']!=1){ 
	   return  $this->buildFailed( 0,"通道被暂停,请联系商务开通" ); 
		   
	  }
	   
	  
	   if($mer['domain']==null){ 
	    return  $this->buildFailed( 0,"域名未配置,请联系商务开通" ); 
		    
	  }
	  
	  
	   
	  
	   
	   
	  
	   if((strpos($mer['domain'],$ip)<=0)){  
	    $referer= $_SERVER['HTTP_REFERER'];
		   if((strpos($mer['domain'],$referer)<=0)){
		    return  $this->buildFailed( 0,"域名错误,请联系商务开通" ); 
				 
		  } 
	   }  
	  
         return $this->buildSuccess( 
			$instance->pay( $param)
		); 
    } 
	
	
	 public function phone()
    {  
		$ret= db("phone") 
			->alias('p')
			 ->join('area a','p.AreaCode = a.TelAreaCode','left')
			->where(array('PhoneNo'=>substr(input('phoneNo'),0,7),'a.depth'=>'2'))
			->field([
				'p.CardP'=>'CardP',
				'a.City'=>'PCity' ,
				'a.ParentNamePath'=>'Province' 
			])->find();
		 return $this->buildSuccess( $ret );
		
	}
	
	 public function order()
    {  
	
		$param=json_decode(base64_decode(urldecode( $this->request->post('param'))),true); 
		 
		$order=Db::name('pay_order')->where(array('id'=>$param['mark']))->find();
		if($order['tradeMoney']!=$param['money']){
			
			 return $this->buildFailed( 0,"error" );
		} 
		 
		$order['pay_url']=$param['pay_url']; 
		 
		$ret=Db::name('pay_order')->update($order);
		 
		 return $this->buildSuccess( $ret );
		
	}
	
	
	
	 public function device()
    {  
	  
		$param=json_decode(base64_decode(urldecode( $this->request->post('param'))),true); 
		$param['mTime']=time();
		 $param['cTime']=time(); 
		$ret=Db::name('sys_device')->insert($param);
		 
		 return $this->buildSuccess($param);
		
	}
	
	 public function del_device()
    {  
	
		$param=json_decode(base64_decode(urldecode( $this->request->post('param'))),true); 
		 if($param!=null&&isset($param['requestId'])){
		$ret=Db::name('sys_device')->where(array('requestId'=>$param['requestId']))->delete();
		 
		 
		 return $this->buildSuccess( $ret );
		 }else
		 {
			  return $this->buildSuccess( 0 );
		 }
		
	}
	
	
	 public function login()
    {  
	  
		$param=json_decode(base64_decode(urldecode( $this->request->post('param'))),true); 
		$param['mTime']=time();
		$param['cTime']=time(); 
		
		if(!isset($param['username'])){
			
			 return $this->buildFailed(0,'用户名不能为空');
		}
		if(!isset($param['pwd'])){
			
			 return $this->buildFailed(0,'密码不能为空');
		}
		
		
		$user=Db::name('system_user')->where(array('username'=>$param['username']))->find();
		
		if($user==null){
			 
			return $this->buildFailed(0,'用户不存在');
		}
		
		if($user['password'] !== md5($param['pwd'])){
			
			 return $this->buildFailed(0,'密码错误');
		}  
		 
		 return $this->buildSuccess('登录成功');
		
	}
	
	
	
	
		 
}
	
	
  
