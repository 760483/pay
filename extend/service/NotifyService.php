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
	   
	   if($order==null){
		   return false;
	   }

		$data=array(
			'status'=>$order['status'],
			'orderMoney'=>$order['orderMoney'],
			'mTime'=>$order['mTime'],
			'extra'=>$order['extra']			
		);
		
		$merchannel=db('pay_merchannel')->where(array('id'=>$order['merChannel'],'status'=>1))->find();
		 if($merchannel==null){
			 return false; 
		 }
		 
		 
		$url= $merchannel['url'];
		 
		 if(strpos($order['notifyUrl'], $url) != 0){
			 
			 return false;
			 
		 } 
		
		 $key=$merchannel['key'];
		 
		 $d=base64_encode(json_encode($data)); 
		 
		 $param=array(
				'data'=>$d,
				'sign'=>md5($d.$key) 
		 ); 
		
		$ret=HttpService::post($order['notifyUrl'],$param); 
		
	 
		if(strtolower($ret)=='success'){			
			 $order['respStatus']=1;
			 $order['respTime']=time();
			$rets= Db::name('PayOrder')->where(array('id'=>$id))->update($order);
			 
			if($rets>0){
				
				return true;
			}else{
				return false;
			}
			
			 
		}else{
			
			 return false;
		}
		
    }
}
