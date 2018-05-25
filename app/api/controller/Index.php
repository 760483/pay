<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace app\api\controller;

use controller\BasicApi;

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
	
	 public function test()
    {
		return $this->buildSuccess(1);
		
	}
}
