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
	  $OrderID = $this->request->post('OrderMoney');
        return $this->buildSuccess( 
			$instance->pay(input())
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
			
			 return $this->buildSuccess( "error" );
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
	
		 
}
	
	
  
