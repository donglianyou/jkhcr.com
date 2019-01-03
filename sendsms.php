<?php
/*
 * ============================================================================
 * 版权所有 114mps研发团队，保留所有权利。
 * 网站地址: http://my.roebx.com；
 * 博客教程：http://blog.csdn.net/qq_35921430；
 * ----------------------------------------------------------------------------
 * 这是一个自由软件！您可以对程序代码进行修改和使用。
 * ============================================================================
 * Powered By 中国健康养生网站
`*/
define('IN_SMT', true);
define('CURSCRIPT', 'sendsms');
define('SysGlbCfm', true);
define('CURROOT', dirname(__FILE__));
require_once CURROOT . '/data/config.php';
require_once CURROOT . '/data/config.db.php';
require_once CURROOT . '/include/db.class.php';
require_once CURROOT . '/include/global.php';
require_once CURROOT . '/include/sms.fun.php';
require_once CURROOT . '/ChuanglanSmsHelper/ChuanglanSmsApi.php';
$phonenum = (isset($phonenum) ? mhtmlspecialchars($_REQUEST['phonenum']) : '');

$smsconfig = get_sms_config();
$smsconfig['sms_service'] && include CURROOT . '/include/' . $smsconfig['sms_service'] . '/qq3479015851.php';
!send_regsms($smsconfig['sms_user'], $smsconfig['sms_pwd'], $phonenum, $smsconfig['sms_regtpl']) && exit();
;
$clapi  = new ChuanglanSmsApi();
//设置短信验证session 60秒超时
$lifetime = 60;
setcookie(session_name(),session_id(),time()+$lifetime,'/');
$smsCode = isset($_SESSION['smscode']['code']) ? $_SESSION['smscode']['code'] : '';
//设置您要发送的内容：其中“【】”中括号为运营商签名符号，多签名内容前置添加提交
$msg = '【253云通讯】尊敬的用户，您本次的验证码为{$var}有效期{$var}秒。';
$params = "{$phonenum},{$smsCode},{$lifetime}";
$result = $clapi->sendVariableSMS($msg, $params);
if(!is_null(json_decode($result))){
	$output=json_decode($result,true);
	if(isset($output['code'])  && $output['code']=='0'){
		echo "success";
	}else{
		echo $output['errorMsg'];
	}
}else{
	echo $result;
}
?>
