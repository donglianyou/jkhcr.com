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
	exit('FORBIDDEN');
}

include QQ3479015851_DATA . '/config.inc.php';

if (submit_check('avatar_submit')) {
	require_once QQ3479015851_INC . '/upfile.fun.php';
	$name_file = 'qq3479015851_member_logo';

	if ($_FILES[$name_file]['name']) {
		check_upimage($name_file);
		$destination = '/face/' . date('Ym') . '/';
		$qq3479015851_image = start_upload($name_file, $destination, 0, $qq3479015851_qq3479015851['cfg_memberlogo_limit']['width'], $qq3479015851_qq3479015851['cfg_memberlogo_limit']['height']);
		@unlink(QQ3479015851_ROOT . $face);
		@unlink(QQ3479015851_ROOT . $normalface);
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET logo=\'' . $qq3479015851_image[0] . '\',prelogo=\'' . $qq3479015851_image[1] . '\' ' . $where);
		unset($qq3479015851_qq3479015851);
		unset($destination);
		unset($name_file);
		unset($qq3479015851_image);
		write_msg('', '?m=avatar&success=8');
	}
	else {
		write_msg('', '?m=avatar&error=13');
	}
}
else {
	$location = location();
	include qq3479015851_tpl('avatar');
}

?>
