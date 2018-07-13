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
use service\JpushServer;

/**
 * 订单管理控制器
 * Class Auth
 * @package app\admin\controller
 */
class Notify extends BasicAdmin
{

    /**
     * 默认数据模型
     * @var string
     */
    public $table = 'PayNotify';

    /**
     * 权限列表
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '通知管理'; 
        return parent::_list(Db::name($this->table) ,true);
    }
	
	
	/**
     * 添加
     * @return array|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function add()
    {
		return JpushServer::send_msg(11);//记得传参数
         return $this->_form($this->table, 'form');
    }

    /**
     * 编辑
     * @return array|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function edit()
    {
        return $this->_form($this->table, 'form');
    }
	/**
	发送邮件
	*/
    public function sendMail()
    {
        $this->title = '发送邮件'; 
		$notify=Db::name($this->table)->where(array('id'=>input('id')))->find();
		
		$ret=send_email($notify['toUser'],$notify['title'],$notify['content']);//$to, $subject, $content
        if($ret){
			$notify['mTime']=time();
			Db::name($this->table)->update($notify);
		 $this->success("发送成功！", '');
		}else{
			$this->error("发送失败，请稍候再试！");
		}
    }
     public function sendNotify()
    {
		$notify=Db::name($this->table)->where(array('id'=>input('id')))->find(); 
		
	    $ret=JpushServer::sendMsgBaidu($notify  );
		
		 $notify['msg_id']=$ret['msg_id'];
		 $notify['sendno']=$ret['send_time'];
		 Db::name($this->table)->update($notify);
		 
		  $this->success("发送成功！消息id:", '');
		 
         
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

}
