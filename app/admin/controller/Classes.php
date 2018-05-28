<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace app\admin\controller;

use controller\BasicAdmin;
use service\DataService;
use think\Db;
use service\ToolsService;
use service\NodeService;

/**
 * Shop控制器
 * Class Goods
 * @package app\admin\controller
 */
class Classes extends BasicAdmin
{

    /**
     * 指定当前数据表
     * @var string
     */
    public $table = 'ShopClasses';

    /**
     *  
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '分类管理';
        $db = Db::name($this->table)->order('sort asc,id asc');
        return parent::_list($db, false);
    }

	
	
	
	 /**
     * 列表数据处理
     * @param $data
     */
    protected function _index_data_filter(&$data)
    {
        foreach ($data as &$vo) {
            //($vo['url'] !== '#') && ($vo['url'] = url($vo['url']));
           // $vo['ids'] = join(',', ToolsService::getArrSubIds($data, $vo['id'],'id','parentId'));
        }
        $data = ToolsService::arr2table($data);
    }
	
	
	
	
	
	
	
 

    /**
     * 分类添加
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
     * 表单数据前缀方法
     * @param $vo
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function _form_filter(&$vo)
    {
        if ($this->request->isGet()) {
            // 上级菜单处理
            $_menus = Db::name($this->table)->where(['status' => '0'])->order('sort asc,id asc')->select();
			
            $_menus[] = ['name' => '顶级菜单', 'id' => '0', 'parentId' => '-1'];
			//$id = 'id', $pid = 'pid', $path = 'path', $ppath = ''
            $menus = ToolsService::arr2table($_menus,'id','parentId');
			
            foreach ($menus as $key => &$menu) {
                if (substr_count($menu['path'], '-') > 3) {
                    unset($menus[$key]);
                    continue;
                }
			//	var_dump(isset($vo['parentId']));
				 
                if (isset($vo['parentId'])) {
					
                    $current_path = "-{$vo['parentId']}-{$vo['parentId']}";
                    if ($vo['parentId'] !== '' && (stripos("{$menu['path']}-", "{$current_path}-") !== false || $menu['path'] === $current_path)) {
                        unset($menus[$key]);
                        continue;
                    }
                }
            } 
			//var_dump( ($menus));
            $this->assign('menus', $menus);
        }
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    /**
     * 用户密码修改
     * @return array|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function pass()
    {
        if ($this->request->isGet()) {
            $this->assign('verify', false);
            return $this->_form($this->table, 'pass');
        }
        $post = $this->request->post();
        if ($post['password'] !== $post['repassword']) {
            $this->error('两次输入的密码不一致！');
        }
        $data = ['id' => $post['id'], 'password' => md5($post['password'])];
        if (DataService::save($this->table, $data, 'id')) {
            $this->success('密码修改成功，下次请使用新密码登录！', '');
        }
        $this->error('密码修改失败，请稍候再试！');
    }

   

    /**
     * 删除用户
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (in_array('10000', explode(',', $this->request->post('id')))) {
            $this->error('系统超级账号禁止删除！');
        }
        if (DataService::update($this->table)) {
            $this->success("用户删除成功！", '');
        }
        $this->error("用户删除失败，请稍候再试！");
    }

    /**
     * 用户禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbid()
    {
        if (in_array('10000', explode(',', $this->request->post('id')))) {
            $this->error('系统超级账号禁止操作！');
        }
        if (DataService::update($this->table)) {
            $this->success("用户禁用成功！", '');
        }
        $this->error("用户禁用失败，请稍候再试！");
    }

    /**
     * 用户禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume()
    {
        if (DataService::update($this->table)) {
            $this->success("用户启用成功！", '');
        }
        $this->error("用户启用失败，请稍候再试！");
    }

}
