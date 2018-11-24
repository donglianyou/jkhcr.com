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
if (!defined('SysGlbCfm')) {
	exit('Forbidden');
}

$userid = mhtmlspecialchars($userid);
$userpwd = trim($userpwd);
$loginip = GetIP();
$logintime = ($timestamp ? $timestamp : time());
$memory = (isset($memory) ? trim($memory) : '');
$url = ($url ? urldecode($url) : '');
if (($authcodesettings['login'] == 1) && !$randcode = qq3479015851_chk_randcode($checkcode)) {
	write_msg('验证码输入错误，请返回重新输入');
}

(($userid == '') || ($userpwd == '')) && write_msg('用户帐号或密码不能为空');
$user_id = $db->getOne('SELECT userid FROM `' . $db_qq3479015851 . 'member` WHERE userid=\'' . $userid . '\' OR mobile=\'' . $userid . '\' OR email=\'' . $userid . '\'');
$row = $db->getRow('SELECT userid,status FROM `' . $db_qq3479015851 . 'member` WHERE userid=\'' . $user_id . '\' AND userpwd=\'' . md5($userpwd) . '\'');
$s_uid = $row['userid'];
$row['status'] = (in_array(PASSPORT_TYPE, array('ucenter', 'phpwind')) ? 1 : $row['status']);
$user_id = $s_uid;

if (PASSPORT_TYPE == 'phpwind') {
	require SysGlbCfm_ROOT . '/pw_client/uc_client.php';
	$user_login = uc_user_login($userid, md5($userpwd), 0);

	if ($user_login['status'] == '-2') {
		write_msg('您输入的登录密码错误!');
	}
	else if ($user_login['status'] == '-1') {
		write_msg('您输入的登录帐号不存在!');
	}
	else {
		if (($user_login['status'] == '1') && !$i = $db->getOne('SELECT COUNT(id) FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $userid . '\'')) {
			member_reg($userid, md5($userpwd), $userid . '@163.com');
		}
	}
}
else if (PASSPORT_TYPE == 'ucenter') {
	require SysGlbCfm_ROOT . '/uc_client/client.php';
	list($uid, $username, $password, $email) = uc_user_login($userid, $userpwd);

	if (0 < $uid) {
		if (!$db->getOne('SELECT count(*) FROM ' . $db_qq3479015851 . 'member WHERE userid=\'' . $userid . '\'')) {
			member_reg($userid, md5($userpwd), $email, '', '', '', '', 1);
		}
		else {
			$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET userpwd = \'' . md5($userpwd) . '\' WHERE userid = \'' . $userid . '\'');
		}

		$s_uid = $userid;
	}
	else {
		if ($uid == -1) {
			write_msg('用户不存在,或者被删除');
		}
		else if ($uid == -2) {
			write_msg('密码输入错误');
		}
		else {
			write_msg('未定义操作');
		}

		exit();
	}
}

if ($s_uid) {
	if (empty($row['status'])) {
		write_msg('您的账号 [<b>' . $s_uid . '</b>] 目前处于<font color=red>待审状态</font>！<br>请进入邮箱查收验证邮件或等待客服人员开通账号！');
	}
	else {
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET logintime=\'' . $timestamp . '\',loginip=\'' . $loginip . '\'  WHERE userid = \'' . $userid . '\' ');
		$member_log->in($s_uid, md5($userpwd), $memory, 'noredirect');
	}

	if ((PASSPORT_TYPE == 'phpwind') && $user_login['synlogin']) {
		echo $user_login['synlogin'];
	}
	else if (PASSPORT_TYPE == 'ucenter') {
		echo uc_user_synlogin($uid);
	}

	echo qq3479015851_goto($url ? $url : $SystemGlobalcfm_global['SiteUrl'] . '/member/index.php');
}
else {
	write_msg('登录失败，您输入了错误的账号或密码！');
}

?>
