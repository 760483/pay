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
        $this->title = '系统权限管理';
        return parent::_list($this->table);
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
