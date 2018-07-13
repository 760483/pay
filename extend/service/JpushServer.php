<?php
/**
 * 激光推送服务
 */

namespace service;


class JpushServer
{
    /**
     * @param $content 推送的内容。
     * @param $receiver 接受者信息
     * @param string $m_type 推送附加字段的类型(可不填) http,tips,chat....
     * @param string $m_txt 推送附加字段的类型对应的内容(可不填) 可能是url,可能是一段文字。
     * @return bool|mixed|string
     */
    public static function send_msg($notify, $type)
    {
        vendor('BaiduPush.sdk');//引入极光推送扩展 这里的jpush.jpush是你的vendor下极光推送的安装目录。

        //配置你的相关配置包括key secret 离线时间 发送环境等；注意是个数组。 


        $order = db('pay_order')->where(array('id' => $notify['linkId']))->find();

        $content = array('mark' => $notify['linkId'], 'money' => $order['tradeMoney'], 'type' => $type);


        $device = db('sys_device')->order('mTime  asc ')->find();

        if ($device == null) {
            return false;
        }

        $accessId = "2100299511";
        $secretKey = "bf9b3b7a7761a31c1c1476363cbbc34b";

        $token = $device['channelId'];


        $push = new XingeApp($accessId, $secretKey);
        $mess = new Message();
        $mess->setTitle('title');
        $mess->setType(2);
        $mess->setCustom(array('param'=>$content));
        $mess->setContent(json_encode($content));
        $mess->setType(Message::TYPE_MESSAGE);

        $ret = $push->PushSingleDevice($token , $mess);

        return $ret;
    }


    public static function send_msg1($notify = '', $type)
    {
        vendor('jpush.jpush.autoload');//引入极光推送扩展 这里的jpush.jpush是你的vendor下极光推送的安装目录。

        //配置你的相关配置包括key secret 离线时间 发送环境等；注意是个数组。
        $app_key = "4c841b541c82354aac9828fb";
        $master_secret = "1100d3eae6e9d0ad89c3006d";


        $order = db('pay_order')->where(array('id' => $notify['linkId']))->find();

        $content = array('mark' => $notify['linkId'], 'money' => $order['tradeMoney'], 'type' => $type);


        $device = db('sys_device')->order('mTime desc')->find();

        if ($device == null) {
            return false;
        }


        $client = new \JPush\Client($app_key, $master_secret);
        $result = $client->push()
            ->setPlatform(array('android'))
            ->addRegistrationId($device['channelId'])
            ->setNotificationAlert(json_encode($content))
            ->send();
        return $result['body'];
    }
}