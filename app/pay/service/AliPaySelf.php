<?php

namespace app\pay\service;

use service\JpushServer;
use Think\Db;

class AliPaySelf
{
    public function pay($order, $channelRet)
    {

        $notify['title'] = 'test';
        $notify['linkId'] = $order['id'];

        $ret = JpushServer::send_msg($notify, $channelRet['param']);
        if ($ret['ret_code'] != 0) {
            $result['msg'] = '支付失败,请联系小饭碗';
            return $result;
        }

        $notify['cTime'] = time();
        $notify['mTime'] = time();


        Db::name('pay_notify')->insert($notify);


        $this->me_sleep();
        $newOrder = db('pay_order')->where(array('id' => $order['id']))->find();


        if (isset($newOrder['pay_url']) && !empty($newOrder['pay_url'])) {
            $result['url'] = $newOrder['pay_url'];
            return $result;
        } else {


            $this->me_sleep();
            $newOrder = db('pay_order')->where(array('id' => $order['id']))->find();
            if (isset($newOrder['pay_url']) && !empty($newOrder['pay_url'])) {
                $result['url'] = $newOrder['pay_url'];
                return $result;
            } else {

                $this->me_sleep();
                $newOrder = db('pay_order')->where(array('id' => $order['id']))->find();
                if (isset($newOrder['pay_url']) && !empty($newOrder['pay_url'])) {
                    $result['url'] = $newOrder['pay_url'];
                    return $result;
                } else {

                    $this->me_sleep();
                    $newOrder = db('pay_order')->where(array('id' => $order['id']))->find();
                    if (isset($newOrder['pay_url']) && !empty($newOrder['pay_url'])) {
                        $result['url'] = $newOrder['pay_url'];
                        return $result;
                    } else {
                        $result['msg'] = '未获取到支付信息';
                        return $result;


                    }
                }
            }

        }
    }


    public function me_sleep()
    {
        for ($i = 0; $i < 999999; $i++) {
             log10($i*time())*pow(time(),12);

        }


    }

}
