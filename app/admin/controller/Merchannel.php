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

/**
 * MerChannel控制器
 * Class Auth
 * @package app\admin\controller
 */
class Merchannel extends BasicAdmin
{

    /**
     * 默认数据模型
     * @var string
     */
    public $table = 'PayMerchannel';

    /**
     * 权限列表
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '商户channel管理';
		
		 $this->title = '系统菜单管理';
        $db = Db::name('PayMerchannel')
				->alias('b')
				->join('pay_channellink a','a.merCId = b.id','left')
				->join('pay_channel c','a.cId = c.id','left')
				->join('system_user d','b.uId = d.id','left')
				->field(['b.id'=>'mId',
						'b.name'=>'mName',
						'b.parentId'=>'mParentId',
						'b.uId'=>'mUId',
						'b.url'=>'mUrl',
						'b.descript'=>'mDescript',
						'b.create_time'=>'mCreateTime',
						'b.update_time'=>'mUpdateTime',
						'b.key'=>'mKey',
						'b.rate'=>'mRate',
						'b.status'=>'mStatus',
						'c.name'=>'cName',
						'd.username'=>'username'
				]);
			 
        return parent::_list($db, true);
        
    }

    /**
     * 配置
     * @return array|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function config()
    {
		$channel=Db::name('PayChannel')->select();
         return $this->_form('PayChannellink', 'config','merCId',array('merCId'=>input('id')),array('channel'=>$channel,'merCId'=>input('id')));
    }

     
    /**
     * 商户通道添加
     * @return array|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function add()
    {
		
		$user=Db::name("SystemUser")->where(array('type'=>2))->select();
		
        return $this->_form($this->table, 'form','','',array('key'=>randCode(32),'user'=>$user));
    }

    /**
     * 权限编辑
     * @return array|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function edit()
    { 
		$user=Db::name("SystemUser")->where(array('type'=>2))->select();
        return $this->_form($this->table, 'form','','',array('user'=>$user));
    }

    /**
     * 权限禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbid()
    {
        if (DataService::update($this->table)) {
            $this->success("权限禁用成功！", '');
        }
        $this->error("权限禁用失败，请稍候再试！");
    }

    /**
     * 权限恢复
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume()
    {
        if (DataService::update($this->table)) {
            $this->success("权限启用成功！", '');
        }
        $this->error("权限启用失败，请稍候再试！");
    }

    /**
     * 权限删除
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $id = $this->request->post('id');
            Db::name('SystemAuthNode')->where(['auth' => $id])->delete();
            $this->success("权限删除成功！", '');
        }
        $this->error("权限删除失败，请稍候再试！");
    }

}
