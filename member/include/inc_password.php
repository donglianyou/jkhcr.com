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
if (!defined('QQ3479015851')) {
	exit('Forbidden');
}

if (submit_check('password_submit')) {
	$curuserpwd = ($_POST['curuserpwd'] ? mhtmlspecialchars($_POST['curuserpwd']) : '');
	$userpwd = ($_POST['userpwd'] ? mhtmlspecialchars($_POST['userpwd']) : '');
	$reuserpwd = ($_POST['reuserpwd'] ? mhtmlspecialchars($_POST['reuserpwd']) : '');

	if (empty($curuserpwd)) {
		write_msg('', '?m=password&error=48');
	}

	if (md5($curuserpwd) != $row['userpwd']) {
		write_msg('', '?m=password&error=47');
	}

	if (!empty($userpwd) && ($userpwd != $reuserpwd)) {
		write_msg('', '?m=password&error=20');
	}

	if (PASSPORT_TYPE == 'phpwind') {
		require QQ3479015851_ROOT . '/pw_client/uc_client.php';
		$pw_user = uc_user_get($s_uid);
		$result = uc_user_edit($pw_user['uid'], $pw_user['username'], '', md5($userpwd), '');

		if ($result == 1) {
		}
		else if ($result == -3) {
			write_msg('', '?m=password&error=21');
		}
		else if ($result == -4) {
			write_msg('', '?m=password&error=23');
		}
		else if ($result == -2) {
			write_msg('', '?m=password&error=24');
		}
		else if ($result == -1) {
			write_msg('', '?m=password&error=24');
		}
		else {
			write_msg('', '?m=password&error=26');
		}
	}
	else if (PASSPORT_TYPE == 'ucenter') {
		require QQ3479015851_ROOT . '/uc_client/client.php';
		$result = uc_user_edit($s_uid, $userpwd, $userpwd, $email, 1);

		if ($result == 1) {
		}
		else if ($result == -4) {
			write_msg('', '?m=password&error=21');
		}
		else if ($result == -5) {
			write_msg('', '?m=password&error=22');
		}
		else if ($result == -6) {
			write_msg('', '?m=password&error=23');
		}
		else if ($result == -8) {
			write_msg('', '?m=password&error=24');
		}
		else if ($result == -1) {
			write_msg('', '?m=password&error=25');
		}
		else {
			write_msg('', '?m=password&error=26');
		}
	}

	if (!empty($userpwd)) {
		$sql = 'UPDATE `' . $db_qq3479015851 . 'member` SET userpwd=\'' . md5($userpwd) . '\' WHERE userid = \'' . $s_uid . '\'';
	}
	else {
		write_msg('', '?m=password&error=13');
	}

	$db->query($sql);
	write_msg('', '?m=password&success=8');
}
else {
	$location = location();
	include qq3479015851_tpl('password');
}

?>
