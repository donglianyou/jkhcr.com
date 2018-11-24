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

$ac = (!in_array($ac, array('person', 'com')) ? 'person' : trim($ac));

if (submit_check('certify_submit')) {
	require_once SysGlbCfm_INC . '/upfile.fun.php';
	$name_file = 'certify_image';
	$typeid = ($ac == 'person' ? 2 : 1);

	if ($_FILES[$name_file]['name']) {
		check_upimage($name_file);
		$destination = '/certification/' . date('Ym') . '/';
		$SystemGlobalcfm_image = start_upload($name_file, $destination, 0);
		$db->query('INSERT INTO `' . $db_qq3479015851 . 'certification` SET typeid=\'' . $typeid . '\',userid=\'' . $s_uid . '\',img_path=\'' . $SystemGlobalcfm_image . '\',pubtime = \'' . $timestamp . '\'');
	}
	else {
		write_msg('', '?m=certify&error=13');
	}

	write_msg('', '?m=certify&success=9');
}
else {
	if ($pubtime = $db->getOne('SELECT pubtime FROM `' . $db_qq3479015851 . 'certification` ' . $where . ' ORDER BY pubtime DESC')) {
		$certifylang = '您已经于' . GetTime($pubtime) . '提交过认证图片，确认要重新提交吗?';
	}

	$location = location();
	include qq3479015851_tpl('certify');
}

?>
