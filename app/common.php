<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------


use service\DataService;
use service\FileService;
use service\NodeService;
use service\SoapService;
use think\Db;
use Wechat\Loader;
use app\util\ApiLog;

/**
 * 打印输出数据到文件
 * @param mixed $data
 * @param bool $replace
 * @param string|null $pathname
 */
function p($data, $replace = false, $pathname = null)
{
    is_null($pathname) && $pathname = RUNTIME_PATH . date('Ymd') . '.txt';
    $str = (is_string($data) ? $data : (is_array($data) || is_object($data)) ? print_r($data, true) : var_export($data, true)) . "\n";
    $replace ? file_put_contents($pathname, $str) : file_put_contents($pathname, $str, FILE_APPEND);
}

/**
 * 获取mongoDB连接
 * @param string $col 数据库集合
 * @param bool $force 是否强制连接
 * @return \think\db\Query
 * @throws \think\Exception
 */
function mongo($col, $force = false)
{
    return Db::connect(config('mongo'), $force)->name($col);
}

/**
 * 获取微信操作对象
 * @param string $type
 * @return \Wechat\WechatMedia|\Wechat\WechatMenu|\Wechat\WechatOauth|\Wechat\WechatPay|\Wechat\WechatReceive|\Wechat\WechatScript|\Wechat\WechatUser|\Wechat\WechatExtends|\Wechat\WechatMessage
 * @throws Exception
 * @return mixed
 */
function & load_wechat($type = '')
{
    static $wechat = [];
    $index = md5(strtolower($type));
    if (!isset($wechat[$index])) {
        $config = [
            'token' => sysconf('wechat_token'),
            'appid' => sysconf('wechat_appid'),
            'appsecret' => sysconf('wechat_appsecret'),
            'encodingaeskey' => sysconf('wechat_encodingaeskey'),
            'mch_id' => sysconf('wechat_mch_id'),
            'partnerkey' => sysconf('wechat_partnerkey'),
            'ssl_cer' => sysconf('wechat_cert_cert'),
            'ssl_key' => sysconf('wechat_cert_key'),
            'cachepath' => CACHE_PATH . 'wxpay' . DS,
        ];
        $wechat[$index] = Loader::get($type, $config);
    }
    return $wechat[$index];
}

/**
 * UTF8字符串加密
 * @param string $string
 * @return string
 */
function encode($string)
{
    list($chars, $length) = ['', strlen($string = iconv('utf-8', 'gbk', $string))];
    for ($i = 0; $i < $length; $i++) {
        $chars .= str_pad(base_convert(ord($string[$i]), 10, 36), 2, 0, 0);
    }
    return $chars;
}

/**
 * UTF8字符串解密
 * @param string $string
 * @return string
 */
function decode($string)
{
    $chars = '';
    foreach (str_split($string, 2) as $char) {
        $chars .= chr(intval(base_convert($char, 36, 10)));
    }
    return iconv('gbk', 'utf-8', $chars);
}

/**
 * 网络图片本地化
 * @param string $url
 * @return string
 */
function local_image($url)
{
    if (is_array(($result = FileService::download($url)))) {
        return $result['url'];
    }
    return $url;
}

/**
 * 日期格式化
 * @param string $date 标准日期格式
 * @param string $format 输出格式化date
 * @return false|string
 */
function format_datetime($date, $format = 'Y年m月d日 H:i:s')
{
    return empty($date) ? '' : date($format, strtotime($date));
}
function format_time($date, $format = 'm月d日 H:i:s')
{
    return empty($date) ? '' : date($format, $date);
}
/**
 * 设备或配置系统参数
 * @param string $name 参数名称
 * @param bool $value 默认是null为获取值，否则为更新
 * @return bool|mixed|string
 * @throws \think\Exception
 * @throws \think\exception\PDOException
 */
function sysconf($name, $value = null)
{
    static $config = [];
    if ($value !== null) {
        list($config, $data) = [[], ['name' => $name, 'value' => $value]];
        return DataService::save('SystemConfig', $data, 'name');
    }
    if (empty($config)) {
        $config = Db::name('SystemConfig')->column('name,value');
    }
    return isset($config[$name]) ? $config[$name] : '';
}

function admin(){ 
	$ret=sysconf('admin'); 
	return json_decode(htmlspecialchars_decode($ret));
}


function isAdmin($db,$f=''){ 
	if(empty($f)){
		$f='a.uId';
	}
	 $ret=sysconf('admin'); 
	$r=json_decode(htmlspecialchars_decode($ret));
	 
	 if(in_array('uId',$db->getTableFields())&&(!in_array(session('user')['id'],$r))){
		 return array($f=>session('user')['id']);
	 }else{
		 return array();
	 } 
	  
	 
}

function limitRate(){
	$ret=sysconf('limitRate');
	
	return json_decode(htmlspecialchars_decode($ret));
}
function userRank($rank=0){	
	$ret=json_decode(htmlspecialchars_decode(sysconf('userRank')));
	 
	if($rank<=0){
		 return 1;
	}
	if($rank>=$ret[count($ret)-1]){
		return count($ret);
	}
	 
	for ($x=0; $x<count($ret); $x++) {
	 if($rank>=$ret[$x]&&$rank<$ret[$x+1])
	 {
		 
		  return $x+1;
	 }
	} 
	 
	 
}

/**
 * RBAC节点权限验证
 * @param string $node
 * @return bool
 */
function auth($node)
{
    return NodeService::checkAuthNode($node);
}

/**
 * array_column 函数兼容
 */
if (!function_exists("array_column")) {
    function array_column(array &$rows, $column_key, $index_key = null)
    {
        $data = [];
        foreach ($rows as $row) {
            if (empty($index_key)) {
                $data[] = $row[$column_key];
            } else {
                $data[$row[$index_key]] = $row[$column_key];
            }
        }
        return $data;
    }
}

/**
 * 手机号中间4位用****替换
 * @param string $mobile 原手机号
 * @return string
 */
function mobileTotel($mobile)
{
    $new_tel = preg_replace('/(\d{3})\d{4}(\d{4})/', '$1****$2', $mobile);
    return isset($new_tel) ? $new_tel : '';
}

/**
 * 大于1000转k,大于10000转w
 * @param $num
 * @return string
 */
function num2String($num)
{
    if ($num < 1000) {
        return $num;
    } else if ($num >= 1000 && $num < 10000) {
        return round($num / 1000, 1) . 'k';
    } else if ($num >= 10000) {
        return round($num / 10000, 2) . 'w';
    }
}

/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @param  string $auth_key 要加密的字符串
 * @return string
 */
function user_md5($str, $auth_key = '')
{
    if (!$auth_key) {
        $auth_key = config('api.AUTH_KEY');
    }
    return '' === $str ? '' : md5(sha1($str) . $auth_key);
}

/**
 * 判断当前是否https
 * @return bool
 */
function is_https()
{
    if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return true;
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
        return true;
    } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return true;
    }
    return false;
}

/**
 * 文字超出长度部分转...
 * @param $str
 * @param $len
 * @param string $suffix
 * @return string
 */
function cut_str($str, $len = 8, $suffix = "...")
{
    if (function_exists('mb_substr')) {
        if (strlen($str) > $len) {
            $str = mb_substr($str, 0, $len) . $suffix;
        }
    } else {
        if (strlen($str) > $len) {
            $str = substr($str, 0, $len) . $suffix;
        }
    }
    return $str;
}

function randCode($length = 5, $type = 0) {
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    if ($type == 0) {
        array_pop($arr);
        $string = implode("", $arr);
    } elseif ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }
    $count = strlen($string) - 1;
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $string[rand(0, $count)];
    }
    return $code;
}


function a2s($data){
	$postStr = '';
            foreach($data as $k => $v){
                $postStr .= $k."=".$v."&";
            }
            $postStr=substr($postStr,0,-1);
			return $postStr;
}


/**
         * post提交
         * @param $url
         * @param $data  array
         * return mixed
         */
 function postRequest($url,$data){
	$postStr = '';
	foreach($data as $k => $v){
		$postStr .= $k."=".$v."&";
	}
	$postStr=substr($postStr,0,-1);
	return postUrl($url,$postStr);
}
/**
 * post提交
 * @param $url
 * @param $data Str
 * return mixed
 */
 function postUrl($url,$data){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_URL,$url);
	//为了支持cookie
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	//返回结果
	//拒绝验证ca证书
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	curl_close ($ch);
	 ApiLog::setUserInfo($result);
	return $result;
}
		
/**
	order
*/	
function orderDb(){
	$db = Db::name('PayOrder')
		->alias('a')
		->join('pay_merchannel b','a.merChannel = b.id','left')
		->join('pay_channel c','a.channelId = c.id','left')
		->join('system_user d','a.uId = d.id','left') 
		->where(isAdmin(Db::name('PayOrder' )))
		 ->field([ 
		 'a.orderId',
		 'a.channelOrderId',
		 'a.id',
		 'a.uId'=>'uId',
		 'a.pay_url'=>'pay_url',
		 'a.orderDate',
		 'a.channelMoney',
		 'a.merMoney',
		 'a.orderMoney',
		 'a.tradeMoney',
		 'a.productName',
		 'a.notifyUrl',
		 'a.returnUrl',
		 'a.cTime',
		 'a.mTime',
		 'a.status',
		 'a.respStatus',
		 'a.rateMoney',
		 'a.bank',
		 'a.extra',
		 'b.name'=>'merChannelName',
		 'c.name'=>'channelName', 
		 'd.username'=>'username'
		]); 
	
	return $db;
	
}

/**
	商户
*/	
function merchannelDb(){
	  $db = Db::name('PayMerchannel')
				->alias('b')
				->join('pay_channellink a','a.merCId = b.id','left')
				->join('pay_channel c','a.cId = c.id','left')
				->join('system_user d','b.uId = d.id','left')
				->join('pay_merchannel e','b.parentId=e.id','left')
				->where(isAdmin(Db::name('PayMerchannel','b.uId')))
				->field(['b.id'=>'mId',
						'b.name'=>'mName',
						'b.domain'=>'domain',
						'b.parentId'=>'mParentId',
						'b.uId'=>'uId',
						'b.url'=>'mUrl',
						'b.descript'=>'mDescript',
						'b.create_time'=>'mCreateTime',
						'b.update_time'=>'mUpdateTime',
						'b.key'=>'mKey',
						'b.rate'=>'mRate',
						'b.status'=>'mStatus',
						'c.name'=>'cName',
						'd.username'=>'username',
						'e.name'=>'parentName'
						
				]);
				
				 
	return $db;
}
function channelDb(){
	  $db = Db::name('PayChannel')
				->alias('a')
				->join('pay_channel b','a.parentId = b.id','left') 
				->join('system_user d','a.uId = d.id','left')
			 ->where(isAdmin(Db::name('PayChannel' )))
				->field([ 
				'a.id',
				'a.uId'=>'uId',
				'a.name',
				'a.parentId',
				'a.param',
				'a.key',
				'a.url',
				'a.descript',
				'a.create_time',
				'a.update_time',
				'a.api',
				'a.channelRate',
				'a.status',
				'a.appId',
				'a.return_url',
				'a.notify_url', 				
				'b.name'=>'parentName',
				'd.username'=>'createName'
						
				]) ;
	return $db;
}



function send_email($to, $subject, $content)
{
    vendor('swiftmailer.swift_required');

    $transport = Swift_SmtpTransport::newInstance(config('SWIFT_HOST'), 25)
                    ->setUsername(config('SWIFT_USERNAME'))
                    ->setPassword(config('SWIFT_PASSWORD'));

    $mailer  = Swift_Mailer::newInstance($transport);
    $message = Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom(array(config('SWIFT_USERNAME') => 'safari_shi'))
                    ->setTo($to)
                    ->setBody($content, 'text/html', 'utf-8');

    return $mailer->send($message);
}

//删除表
function delTable($tableName){
	
	$d="DROP TABLE IF EXISTS `".$tableName."`";
	return  Db::execute($d);
}

//创建表
function createTable($tableName,$data,$type,$key,$comment){ 
	$s='CREATE TABLE `'.$tableName.'`( ';
	for($i=0;$i<sizeof($data);$i++){
		$s.="`".$data[$i]."`".' '.$type[$i].' '.$key[$i].' COMMENT '."'".$comment[$i]."'".',';		
	}
	
	$s=rtrim($s,',');
	$s=$s.')';
	delTable($delTable);
	return Db::execute($s); 
	
}

 
function updateTable($tableName,$data,$type,$key,$comment){ 

$c =Db::query("select COLUMN_NAME from information_schema.COLUMNS where  table_name='".$tableName."'   and table_schema='".config('database')['database']."'");
	$db = array_reduce($c, function ($db, $value) {
    return array_merge($db, array_values($value));
}, array());
	
	 

	$s='ALTER TABLE `'.$tableName.'` ';
	
	for($i=0;$i<sizeof($data);$i++){
		if(in_array($data[$i] ,$db)){ 
			$s.="modify   `".$data[$i]."`".' '.$type[$i].' '.' COMMENT '."'".$comment[$i]."'".',';	 
		}else{
			$s.="ADD COLUMN `".$data[$i]."`".' '.$type[$i].' '.' COMMENT '."'".$comment[$i]."'".','; 
		} 
	} 
	for($i=0;$i<sizeof($db);$i++){
		if(!in_array($db[$i] ,$data)){
			$s.="DROP COLUMN `".$data[$i]."`".',';	 
		}
		
	} 
	
	$s=rtrim($s,',');
	
	
	return  Db::execute($s); 
	
}














