<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace service;

use Endroid\QrCode\QrCode;
use Wechat\WechatPay;
use think\Log;
use think\Db;
use service\NotifyService;
use service\ToolsService;

/**
 * 微信支付数据服务
 * Class PayService
 * @package service
 */
class PayRetService
{

    /**
     * 查询订单是否已经支付
     * @param string $order_no
     * @return bool
     */
    public static function isPay($id)
    {
        $map = ['id' => $id, 'status' => '1'];
        return Db::name('PayOrder')->where($map)->count() > 0;
    }
	/**
	*成功支付
	*分润
	并回调给下游	
	**/
	public static function success($id)
    {
		
		$order=Db::name('PayOrder')->where(array('id'=>$id))->find();
        $order['status']=1;
		$order['mTime']=time();
		Db::name('PayOrder')->where(array('id'=>$id))->update($order);
		
		$merchannel=Db::name('PayMerchannel')->where(array('id'=> $order['merChannel']))->find();
		if($order['type']==0){//通道 用户层级无穷
 	
			PayRetService::channelShare($order['merChannel'],$order['tradeMoney'],$order['channelId']);
			NotifyService::notify($id);
		} else{ 
		//1商品 用户层级无穷
		//2商品 用户层级有穷
		//3商品 用户等级级无穷 
			
			PayRetService::userShare($order['orderMoney']*sysconf('adminRate')-$order['point']/sysconf('pointRate'),$order['userId'],$order['type'],0,$order['orderMoney']*sysconf('adminRate')-$order['point']/sysconf('pointRate'));
		} 
         
    }
	
	/***通道
	递归分润
	**/
	public static function channelShare($id,$momey,$channelId)
    {
		$merchannel=Db::name('PayMerchannel')->where(array('id'=> $id))->find();
		$parentChannel=Db::name('PayMerchannel')->where(array('id'=> $merchannel['parentId']))->find(); 
		
		if($merchannel['parentId']==0||$parentChannel==null){
			$channel=Db::name('PayChannel')->where(array('id'=> $channelId))->find();
			$moneyRate=$momey*($merchannel['rate']-$channel['channelRate']);
			 var_dump($channel['channelRate']);
			 var_dump($merchannel['rate']);
			 var_dump($momey);
			 PayRetService::record($merchannel['uId'], $moneyRate);		
		}else{
			$moneyRate=$momey*($merchannel['rate']-$parentChannel['rate']);
			 PayRetService::record($merchannel['uId'], $moneyRate);		
			 var_dump($moneyRate);
			PayRetService::channelShare($merchannel['parentId'],$momey,$channelId);
		}
		
	}
	/***用户
	递归分润
	limitRate
	
	//1商品 用户层级无穷
		//2商品 用户层级有穷
		//3商品 用户等级级有穷
	 
	**/
	public static function userShare($money,$id,$type=1,$limit=1,$surplus=0)
    {
		$limit=$limit+1; 
		$systemUser=Db::name('SystemUser')->where(array('id'=> $id))->find();
		 
		
		if($type==1){
			
			if($systemUser['parentId']==0){	
				var_dump($systemUser['parentId']);			
				if($money>0)			
				PayRetService::record($id, $money);				 			
			}else{ 
		
				PayRetService::record($id, $money*(1-$systemUser['rate']));
				PayRetService::userShare($money*($systemUser['rate']),$systemUser['parentId'],$type,$limit,$surplus);
			}
		}
		
		else if($type==2){
			$m=$money*(limitRate()[$limit-1]);
			if($systemUser['parentId']==0||count(limitRate())==$limit){			 
				PayRetService::record($id, $m);	
				 
				 if($surplus>0){
					 PayRetService::record(10000, $surplus-$m);	
				 }
									
			}else{ 			
				PayRetService::record($id, $m);					 
				PayRetService::userShare($money,$systemUser['parentId'],$type,$limit,$surplus-$m);
			}
		}
		else if($type==3){
			$userRank=userRank($systemUser['rank']);
			$m=$money*(limitRate()[$userRank-1]);  
			
			if($systemUser['parentId']==0||(count(limitRate())==$limit)){			 
				PayRetService::record($id, $m);	
				 if($surplus>$m){
					 PayRetService::record(10000, $surplus);	
				 } 			
			}else{ 			
				
				PayRetService::record($id, $m);
				
				PayRetService::userShare($money,$systemUser['parentId'],$type,$limit,$surplus-$m);
			}
		}  
				 
		
	}
	
	
	
	static function record($id,$money){
		
			Db::name('SystemUser')->where(array('id'=> $id))->setInc( 'amount', $money );
			Db::name('SystemUser')->where(array('id'=> $id))->setInc(  'point',$money*100  );
			Db::name('SystemUser')->where(array('id'=> $id))->setInc(  'rank',$money*100);
				Db::name('SystemRecord')->insert(array(
			 'userId'=>$id,
			 'amount'=>$money,
			 'info'=>'分润',
			 'create_time'=>time(),
			  'update_time'=>time()
			 
			 
			 ));
	}
	
	

    /**
     * 创建微信二维码支付(扫码支付模式二)
     * @param WechatPay $pay 支付SDK
     * @param string $order_no 系统订单号
     * @param int $fee 支付金额
     * @param string $title 订单标题
     * @param string $from 订单来源
     * @return bool|string
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionFailedException
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionUnknownException
     * @throws \OSS\Core\OssException
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public static function createWechatPayQrc(WechatPay $pay, $order_no, $fee, $title, $from = 'wechat')
    {
        $prepayid = self::createWechatPrepayid($pay, null, $order_no, $fee, $title, 'NATIVE', $from);
        if ($prepayid === false) {
            return false;
        }
        $filename = FileService::getFileName($prepayid, 'png', 'qrc/');
        if (!FileService::hasFile($filename)) {
            $qrCode = new QrCode($prepayid);
            if (null === FileService::save($filename, $qrCode->get())) {
                return false;
            }
        }
        return FileService::getFileUrl($filename);
    }

    /**
     * 创建微信JSAPI支付签名包
     * @param WechatPay $pay 支付SDK
     * @param string $openid 微信用户openid
     * @param string $order_no 系统订单号
     * @param int $fee 支付金额
     * @param string $title 订单标题
     * @return array|bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function createWechatPayJsPicker(WechatPay $pay, $openid, $order_no, $fee, $title)
    {
        if (($prepayid = self::createWechatPrepayid($pay, $openid, $order_no, $fee, $title, 'JSAPI')) === false) {
            return false;
        }
        return $pay->createMchPay($prepayid);
    }

    /**
     * 微信退款操作
     * @param WechatPay $pay 支付SDK
     * @param string $order_no 系统订单号
     * @param int $fee 退款金额
     * @param string|null $refund_no 退款订单号
     * @param string $refund_account
     * @return bool
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public static function putWechatRefund(WechatPay $pay, $order_no, $fee = 0, $refund_no = null, $refund_account = '')
    {
        $map = ['order_no' => $order_no, 'is_pay' => '1', 'appid' => $pay->appid];
        $notify = Db::name('WechatPayPrepayid')->where($map)->find();
        if (empty($notify)) {
            Log::error("内部订单号{$order_no}验证退款失败");
            return false;
        }
        if (false !== $pay->refund($notify['out_trade_no'], $notify['transaction_id'], is_null($refund_no) ? "T{$order_no}" : $refund_no, $notify['fee'], empty($fee) ? $notify['fee'] : $fee, '', $refund_account)) {
            $data = ['out_trade_no' => $notify['out_trade_no'], 'is_refund' => "1", 'refund_at' => date('Y-m-d H:i:s'), 'expires_in' => time() + 7000];
            if (DataService::save('wechat_pay_prepayid', $data, 'out_trade_no')) {
                return true;
            }
            Log::error("内部订单号{$order_no}退款成功，系统更新异常");
            return false;
        }
        Log::error("内部订单号{$order_no}退款失败，{$pay->errMsg}");
        return false;
    }

    /**
     * 创建微信预支付码
     * @param WechatPay $pay 支付SDK
     * @param string $openid 支付者Openid
     * @param string $order_no 实际订单号
     * @param int $fee 实际订单支付费用
     * @param string $title 订单标题
     * @param string $trade_type 付款方式
     * @param string $from 订单来源
     * @return bool|mixed|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function createWechatPrepayid(WechatPay $pay, $openid, $order_no, $fee, $title, $trade_type = 'JSAPI', $from = 'wechat')
    {
        $map = ['order_no' => $order_no, 'is_pay' => '1', 'expires_in' => time(), 'appid' => $pay->appid, 'trade_type' => $trade_type];
        $where = 'appid=:appid and order_no=:order_no and (is_pay=:is_pay or expires_in>:expires_in) and trade_type=:trade_type';
        $prepayinfo = Db::name('WechatPayPrepayid')->where($where, $map)->find();
        if (empty($prepayinfo) || empty($prepayinfo['prepayid'])) {
            $out_trade_no = DataService::createSequence(18, 'WXPAY-OUTER-NO');
            if (!($prepayid = $pay->getPrepayId($openid, $title, $out_trade_no, $fee, url("@wechat/notify", '', true, true), $trade_type))) {
                Log::error("内部订单号{$order_no}生成预支付失败，{$pay->errMsg}");
                return false;
            }
            $data = ['prepayid' => $prepayid, 'order_no' => $order_no, 'out_trade_no' => $out_trade_no, 'fee' => $fee, 'trade_type' => $trade_type];
            list($data['from'], $data['appid'], $data['expires_in']) = [$from, $pay->getAppid(), time() + 5400];
            if (Db::name('WechatPayPrepayid')->insert($data) > 0) {
                Log::notice("内部订单号{$order_no}生成预支付成功,{$prepayid}");
                return $prepayid;
            }
        }
        return $prepayinfo['prepayid'];
    }

}
