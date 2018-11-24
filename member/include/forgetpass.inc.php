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
require_once SysGlbCfm_ROOT . '/include/sms.fun.php';

if ($action == 'sendmail') {
	$email = (isset($email) ? mhtmlspecialchars($email) : '');
	if (($authcodesettings['forgetpass'] == 1) && !$randcode = qq3479015851_chk_randcode($checkcode)) {
		write_msg('验证码输入错误，请返回重新输入');
	}

	empty($email) && write_msg('请填写电子邮箱地址！');
	$user_info = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'member` WHERE email = \'' . $email . '\'');

	if ($user_info['userid']) {
		require SysGlbCfm_INC . '/email.fun.php';
		$code = base64_encode($user_info['id'] . '.' . md5($user_info['id'] . '+' . $user_info['userpwd']) . '.' . $timestamp);
		globalassign();

		if (send_pwd_email($user_info['id'], $user_info['userid'], $email, $code)) {
			include qq3479015851_tpl($mod . '_2');
		}
		else {
			$status = 'error2';
			$msg = '发送邮件失败，请联系客服：' . $SystemGlobalcfm_global['SiteTel'] . '重设密码！';
			include qq3479015851_tpl($mod . '_4');
		}
	}
	else {
		$status = 'error2';
		$msg = '该电子邮箱或用户名不存在！请联系客服：' . $SystemGlobalcfm_global['SiteTel'] . '！';
		globalassign();
		include qq3479015851_tpl($mod . '_4');
	}
}
else if ($action == 'sendsms') {
	$mobile = (isset($mobile) ? mhtmlspecialchars($mobile) : '');
	if (($authcodesettings['forgetpass'] == 1) && !$randcode = qq3479015851_chk_randcode($checkcode)) {
		write_msg('验证码输入错误，请返回重新输入');
	}

	empty($mobile) && write_msg('请填写您的手机号码！');
	$user_info = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'member` WHERE mobile = \'' . $mobile . '\'');

	if ($user_info['userid']) {
		$smsconfig = get_sms_config();
		$smsconfig['sms_service'] && include SysGlbCfm_ROOT . '/include/' . $smsconfig['sms_service'] . '/qq3479015851.php';

		if (!send_pwdsms($smsconfig['sms_user'], $smsconfig['sms_pwd'], $mobile, $smsconfig['sms_pwdtpl'])) {
			$status = 'error2';
			$msg = '验证码发送失败！请联系客服：' . $SystemGlobalcfm_global['SiteTel'] . '！';
			globalassign();
			include qq3479015851_tpl($mod . '_4');
		}
		else {
			$uid = $user_info['id'];
			$userid = $user_info['userid'];
			include qq3479015851_tpl($mod . '_2');
		}
	}
	else {
		$status = 'error2';
		$msg = '该手机号尚未注册用户！请联系客服：' . $SystemGlobalcfm_global['SiteTel'] . '！';
		globalassign();
		include qq3479015851_tpl($mod . '_4');
	}
}
else if ($action == 'resetpage') {
	globalassign();
	include qq3479015851_tpl($mod . '_3');
}
else if ($action == 'resetpwd') {
	$uid = ($uid ? intval($uid) : '');
	$userid = ($userid ? mhtmlspecialchars($userid) : '');
	$userpwd = ($userpwd ? mhtmlspecialchars($userpwd) : '');
	$email = ($email ? mhtmlspecialchars($email) : '');
	$mobile = ($mobile ? mhtmlspecialchars($mobile) : '');
	$smscheckcode = ($smscheckcode ? intval($smscheckcode) : '');

	if ($SystemGlobalcfm_global['cfg_member_verify'] == 4) {
		if (!qq3479015851_chk_smsrandcode($smscheckcode, $mobile)) {
			write_msg('密码修改失败，手机验证码输入不正确或与手机号不匹配！', '?mod=forgetpass');
		}
	}

	if (empty($userpwd)) {
		write_msg('请输入你的新密码！');
	}

	if (PASSPORT_TYPE == 'phpwind') {
		require SysGlbCfm_ROOT . '/pw_client/uc_client.php';
		$pw_user = uc_user_get($userid);
		$result = uc_user_edit($pw_user['uid'], $pw_user['username'], '', md5($userpwd), '');
	}
	else if (PASSPORT_TYPE == 'ucenter') {
		require SysGlbCfm_ROOT . '/uc_client/client.php';
		$result = uc_user_edit($userid, $userpwd, $userpwd, $email, 1);
	}

	if (!empty($userpwd)) {
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET userpwd=\'' . md5($userpwd) . '\' WHERE id = \'' . $uid . '\'');
		$status = 'success';
	}
	else {
		$status = 'error';
		$msg = '未定义错误，密码修改失败！';
	}

	globalassign();
	include qq3479015851_tpl($mod . '_4');
}

?>
