<?php
namespace app\pay\controller;
use app\common\controller\Common;  
use think\Db;
class Index  extends  Common{
	 
	 public function index()
    {
		
		return $this->fetch();
	}
	 
	 /**
	  //其他业务参数根据在线开发文档，添加参数.
            //文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.2Z6TSk&treeId=60&articleId=103693&docType=1
            //如"参数名"    => "参数值"   注：上一个参数末尾需要“,”逗号。
	 **/
    
   public function alipay_wap_do($orderId)
    {
        
		$order=Db::name('PayOrder')->where(array('id'=>$orderId))->find();
		$channel=Db::name('PayChannel')->where(array('id'=>$order['channelId']))->find(); 
        $alipay_config = json_decode(html_entity_decode($channel['param']),true);
	 
		 
          
    }
	
	
	 public function alipay_wap_notify()
    { 
    }
 
    public function alipay_wap_return()
    {
        
	}
}
?>
