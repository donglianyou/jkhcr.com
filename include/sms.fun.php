<?php
/*
 * ============================================================================
 * 版权所有 114mps研发团队，保留所有权利。
 * 网站地址: http://my.roebx.com；
 * 博客教程：http://blog.csdn.net/qq_35921430；
 * ----------------------------------------------------------------------------
 * 这是一个自由软件！您可以对程序代码进行修改和使用。
 * ============================================================================
 * 程序交流QQ：3479015851
 * QQ群 ：625621054  [入群提供技术支持]
`*/
function send_regsms($sms_user, $sms_pwd, $phonenum, $sms_regtpl = '')
{
	global $db;
	global $db_qq3479015851;
	global $qq3479015851_global;
	global $timestamp;
	if (!($phonenum) || !(is_mobile($phonenum))) {
		return false;
		exit();
	}

	$code = rand(100000, 999999);
	$time = $timestamp + 600;
	$cishu = mgetcookie('sendcishu');
	$cishu = ($cishu ? $cishu : 0);
	if ((mgetcookie('sendedsms') == 1) || (100 < $cishu)) {
		return false;
	}
	else {
		$cishu = $cishu + 1;
		session_start();
		$_SESSION['smscode'] = array('phonenum' => $phonenum, 'code' => $code, 'time' => $time);
		msend_regsms($sms_user, $sms_pwd, $phonenum, $code, $sms_regtpl);
		msetcookie('sendedsms', 1, 115);
		msetcookie('sendcishu', $cishu, 24 * 3600);
		return true;
	}
}

function send_pwdsms($sms_user, $sms_pwd, $phonenum, $sms_pwdtpl = '')
{
	global $db;
	global $db_qq3479015851;
	global $qq3479015851_global;
	global $timestamp;
	if (!($phonenum) || !(is_mobile($phonenum))) {
		return false;
	}

	$code = rand(100000, 999999);
	$time = $timestamp + 600;
	$cishu = mgetcookie('sendcishu');
	$cishu = ($cishu ? $cishu : 0);
	if ((mgetcookie('sendedsms') == 1) || (100 < $cishu)) {
		return false;
	}
	else {
		$cishu = $cishu + 1;
		session_start();
		$_SESSION['smscode'] = array('phonenum' => $phonenum, 'code' => $code, 'time' => $time);
		msend_pwdsms($sms_user, $sms_pwd, $phonenum, $code, $sms_pwdtpl);
		msetcookie('sendedsms', 1, 115);
		msetcookie('sendcishu', $cishu, 24 * 3600);
		return true;
	}
}

function write_sms_sendrecord($mobile, $sms_content, $status, $sms_service)
{
	global $timestamp;
	global $db;
	global $db_qq3479015851;
	$db->query('INSERT INTO `' . $db_qq3479015851 . 'sms_sendlist` (mobile,sms_content,status,sendtime,sms_service)VALUES(\'' . $mobile . '\',\'' . $sms_content . '\',\'' . $status . '\',\'' . $timestamp . '\',\'' . $sms_service . '\')');
}

function get_sms_config()
{
	global $db;
	global $db_qq3479015851;
	static $res;

	if ($res === NULL) {
		$data = read_static_cache('sms_config');

		if ($data == false) {
			$re = $db->query('SELECT * FROM `' . $db_qq3479015851 . 'config` WHERE type=\'sms\'');

			while ($row = $db->fetchRow($re)) {
				$res[$row['description']] = $row['value'];
			}

			write_static_cache('sms_config', $res);
		}
		else {
			$res = $data;
		}
	}

	return $res;
}


?>
