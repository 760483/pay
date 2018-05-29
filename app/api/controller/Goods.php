<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace app\api\controller;

use controller\BasicApi;
use think\Db;

/**
 * API index类
 * Class Index
 * @package app\api\controller
 */
class Goods extends BasicApi
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
	
	 public function lists()
    {
		$goods=Db::name('ShopGoods')->select();
		return $this->buildSuccess($goods);
		
	}
	
	
	 public function banner()
    {
		$goods=Db::name('ShopGoods')->select();
		return $this->buildSuccess($goods); 
	}
	
	 public function classlist()
    {
		$classes=Db::name('ShopClasses')->where(['parentId'=>input('pId'),'status'=>0,'type'=>input('type')])->select();
		return $this->buildSuccess($classes);
		
	}
}
