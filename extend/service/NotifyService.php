<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace service;

use think\Request;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
use Hashids\Hashids;
use service\HttpService;
use think\Db;
/**
 * 通知
 * Class ToolsService
 * @package service
 */
class NotifyService
{

    /**
     * 通知
     */
    public static function notify($id)
    {
       $order=Db::name('PayOrder')->where(array('id'=>$id,'status'=>1))->find();  

		$data=array(
			'status'=>$order['status'],
			'orderMoney'=>$order['orderMoney']
		);
		$ret=HttpService::post($order['notifyUrl'],$data);
		
    }
}
