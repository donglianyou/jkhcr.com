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
$phonenum = (isset($phonenum) ? mhtmlspecialchars($_REQUEST['phonenum']) : '');

if (!$phonenum) {
	exit();
}

$smsconfig = get_sms_config();
$smsconfig['sms_service'] && include CURROOT . '/include/' . $smsconfig['sms_service'] . '/qq3479015851.php';
!send_regsms($smsconfig['sms_user'], $smsconfig['sms_pwd'], $phonenum, $smsconfig['sms_regtpl']) && exit();

?>
