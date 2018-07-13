<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace app\admin\controller;

use controller\BasicAdmin;
use service\DataService;
use think\Db;

/**
 * 系统用户管理控制器
 * Class User
 * @package app\admin\controller
 */
class Area extends BasicAdmin
{

    /**
     * 指定当前数据表
     * @var string
     */
    public $table = 'area';

    /**
     * 用户列表
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '手机管理';
       $db = Db::name($this->table) ;
	   
	  
	   
	   
	    $get = $this->request->get();
		 
	    if (isset($get['City']) && $get['City'] !== '') {
          
            $db->where (['City'=>  $get['City'] ]);
        } 
        return parent::_list( $db);
    }

    

    /**
     * 用户添加
     * @return array|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function add()
    {
        return $this->_form($this->table, 'form');
    }

    /**
     * 用户编辑
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
     * 删除用户
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
       
        if (DataService::update($this->table)) {
            $this->success(" 删除成功！", '');
        }
        $this->error(" 删除失败，请稍候再试！");
    } 

}
