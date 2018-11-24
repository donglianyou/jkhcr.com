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
	exit('FORBIDDEN');
}

include SysGlbCfm_DATA . '/config.inc.php';

if (submit_check('avatar_submit')) {
	require_once SysGlbCfm_INC . '/upfile.fun.php';
	$name_file = 'qq3479015851_member_logo';

	if ($_FILES[$name_file]['name']) {
		check_upimage($name_file);
		$destination = '/face/' . date('Ym') . '/';
		$SystemGlobalcfm_image = start_upload($name_file, $destination, 0, $SystemGlobalcfm_qq3479015851['cfg_memberlogo_limit']['width'], $SystemGlobalcfm_qq3479015851['cfg_memberlogo_limit']['height']);
		@unlink(SysGlbCfm_ROOT . $face);
		@unlink(SysGlbCfm_ROOT . $normalface);
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET logo=\'' . $SystemGlobalcfm_image[0] . '\',prelogo=\'' . $SystemGlobalcfm_image[1] . '\' ' . $where);
		unset($SystemGlobalcfm_qq3479015851);
		unset($destination);
		unset($name_file);
		unset($SystemGlobalcfm_image);
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
