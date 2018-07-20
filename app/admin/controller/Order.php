<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace app\admin\controller;

use controller\BasicAdmin;
use service\DataService;
use service\NodeService;
use service\ToolsService;
use think\Db;
use service\NotifyService;

/**
 * 订单管理控制器
 * Class Auth
 * @package app\admin\controller
 */
class Order extends BasicAdmin
{

    /**
     * 默认数据模型
     * @var string
     */
    public $table = 'PayOrder';

    /**
     * 权限列表
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '订单管理'; 
        return parent::_list(orderDb() ,true);
    }

    
    

    /**
     * 订单删除
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $id = $this->request->post('id');
            Db::name('PayOrder')->where(['id' => $id])->delete();
            $this->success("订单删除成功！", '');
        }
        $this->error("订单删除失败，请稍候再试！");
    }
	
	/**补单
	*/
	public function send(){
		 $id = $this->request->post('id');
		  $id = $this->request->post('id');
		$order=db('pay_order')->where(array('id'=>$id))->find(); 
		
		 if($order==null){
			 
			 $this->error("订单不存在！");
		 }
		 
		  if($order['status']<=0){
			 
			 $this->error("订单未支付！请强制补单");
		 }
		 
		 $notify=NotifyService::notify( $id);
		 
		 if($notify){
			  $this->success("补单成功",'');
			 
		 }else{
			 
			  $this->error("补单失败".$notify);
		 }
		 
		 
		
	}
	/**强制补单
	*/
	public function modify(){
		 $id = $this->request->post('id');
		$order=db('pay_order')->where(array('id'=>$id))->find(); 
		
		 if($order==null){
			 
			 $this->error("订单不存在！");
		 }
		 
		  if($order['status']>0){
			 
			 $this->error("订单已经支付！");
		 }
		 
		 $order['status']=1;
		 
		$ret=db('pay_order')->update($order);
		
		if($ret>0){
			$notify=NotifyService::notify( $id);
			
		if($notify){
			 $this->success("补单成功",'');
			 
		 }else{
			 
			  $this->error("补单失败");
		 }
		 
			
		}else{
			 $this->error("补单失败！");
			
		}
		 
		 
		 
		 
		 
		 
		
	}
	
	
	
	
	

}
