<?php
/**
* 	配置账号信息
*/

define('SysGlbCfm', true);
require_once dirname(__FILE__).'/../../../global.php';
require_once SysGlbCfm_DATA.'/config.php';
require_once SysGlbCfm_DATA.'/config.db.php';
require_once SysGlbCfm_INC.'/db.class.php';
require_once SysGlbCfm_INC.'/member.class.php';

$payr = $db->getRow("SELECT * FROM `{$db_qq3479015851}payapi` WHERE paytype='wxpay' AND isclose=0");
$appid = $payr['appid'];
$appsecret = $payr['appkey'];
$mchid = $payr['payuser'];
$mchidkey = $payr['paykey'];
$weburl = $SystemGlobalcfm_global['SiteUrl'];

if(empty($appid) || empty($appsecret) || empty($mchid) || empty($mchidkey)){
	$db->query("update `{$db_qq3479015851}payapi` set isclose = 1 where paytype='wxpay' ");
	write_msg('微信支付资料不全,无法正常支付');
	die();
}

define('SysGlbCfm_APPID',$appid);
define('SysGlbCfm_MCHID',$mchid);
define('SysGlbCfm_KEY',$mchidkey);
define('SysGlbCfm_APPSECRET',$appsecret);
define('SysGlbCfm_CALL_URL',$weburl.'/include/payment/wxpay/js_api_call.php');
define('SysGlbCfm_NOTIFY_URL',$weburl.'/include/payment/wxpay/notify_url.php');






class WxPayConf_pub
{
	//=======【基本信息设置】=====================================
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = SysGlbCfm_APPID;
	//受理商ID，身份标识
	const MCHID = SysGlbCfm_MCHID;
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	const KEY = SysGlbCfm_KEY;
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = SysGlbCfm_APPSECRET;
						
	//=======【JSAPI路径设置】===================================
	//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	const JS_API_CALL_URL = SysGlbCfm_CALL_URL;
	
	//=======【证书路径设置】=====================================
	//证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = '/cacert/apiclient_cert.pem';
	const SSLKEY_PATH = '/cacert/apiclient_key.pem';
	
	//=======【异步通知url设置】===================================
	//异步通知url，商户根据实际开发过程设定
	const NOTIFY_URL = SysGlbCfm_NOTIFY_URL;

	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}
	
?>