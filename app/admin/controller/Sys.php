<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace app\admin\controller;

use controller\BasicAdmin;
use service\DataService;
use think\Db;
use Think\Model;

/**
 * 系统控制器
 * Class Goods
 * @package app\admin\controller
 */
class Sys extends BasicAdmin
{

    /**
     * 指定当前数据表
     * @var string
     */
    public $table = 'ShopSku';

    /**
     *  当前所有表
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '系统用户管理';
        $get = $this->request->get();
 
 
        $db =Db::query("select table_name ,version ,table_rows,table_type from information_schema.tables where table_schema='".config('database')['database']."'");
		 $this->assign('list',  $db);
        return $this->fetch( );
    }

    /**
     * 授权管理
     * @return array|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function auth()
    {
        return $this->_form($this->table, 'auth');
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
     * 表单数据默认处理
     * @param $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function _form_filter(&$data)
    {
        if ($this->request->isPost()) {
			$tableName=input('table_name');
			$type=(input('type/a'));
			$data=(input('data/a'));
			$key=(input('key/a'));
			$comment=(input('comment/a'));
			
			$ret=(updateTable($tableName,$data,$type,$key,$comment));
         
          $this->success('修改表成功！');
        } else {
			 
			
           $db =Db::query("select * from information_schema.COLUMNS where  table_name='".$this->request->get('table_name')."'   and table_schema='".config('database')['database']."'");
		
		 // var_dump($db);
            $this->assign('list',  $db);
        }
    }

    /**
     * 删除用户
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
          delTable(input('id'));
        
            $this->success("删除成功！", '');
        
       
    }

     

}
