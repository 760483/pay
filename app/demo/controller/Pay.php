<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

namespace app\demo\controller;


use service\HttpService;
use service\JpushServer;
use think\Controller;
use think\Db;
use think\Exception;
use think\Request;
use think\Url;


/**
 * 系统权限管理控制器
 * Class Pay
 * @package app\demo\controller
 * @author Anyon <zoujingli@qq.com>
 * @date 2017/07/10 18:13
 */
class Pay extends Controller
{


    /**
     * 文件上传
     * @return \think\response\View
     * @throws \Exception
     */
    public function index()
    {
        if (!$this->request->isPost()) {
            return view('', ['title' => 'demo', 'time' => time()]);
        } else {

            $data = input();
            $preArr = array_merge($data, ['key' => input()['key']]);
            ksort($preArr);
            $preArr = http_build_query($preArr);
            $data['sign'] = md5(urldecode($preArr));
            $ret = HttpService::send_post(Url::build('/api/5a570d64428ca', '', '', Request::instance()->domain()), $data, 60, array('version' => 'v4.0'));

            $retUrl = Url::build('/pay/pay/qrPay', '', '', Request::instance()->domain());
            $data = json_decode(html_entity_decode($ret), true)['data'];
            if ($ret != null && isset($data['url'])) {
                $url = $data['url'];
                $this->success('请求成功!', $retUrl . '?url=' . urlencode($url));
            } else {
                $this->error(json_decode(html_entity_decode($ret), true)['data']['msg']);
            }


        }
    }


}
