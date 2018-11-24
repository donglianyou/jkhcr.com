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

$id = (isset($_REQUEST['id']) ? intval($_REQUEST['id']) : '');
$action = (isset($_GET['action']) ? htmlspecialchars($_GET['action']) : '');
require_once MEMBERDIR . '/include/common.func.php';

if ($ac == 'del') {
	empty($selectedids) && write_msg('', '?m=shoucang&error=1&page=' . $page);
	$db->query('DELETE FROM `' . $db_qq3479015851 . 'shoucang` ' . $where . ' AND id ' . create_in($selectedids));
	write_msg('', '?m=shoucang&success=3&page=' . $page);
}
else if ($ac == 'delthis') {
	if (!$id) {
		write_msg('', '?m=shoucang&error=1&page=' . $page);
	}

	$db->query('DELETE FROM `' . $db_qq3479015851 . 'shoucang` WHERE id = \'' . $id . '\' AND userid = \'' . $s_uid . '\'');
	write_msg('', '?m=shoucang&success=3&page=' . $page);
}
else {
	$sql = 'SELECT * FROM ' . $db_qq3479015851 . 'shoucang ' . $where . ' ORDER BY id DESC';
	$rows_num = qq3479015851_count('shoucang', $where);
	$param = setParam(array('m'));
	$list = array();

	foreach (page1($sql) as $k => $row ) {
		$arr['id'] = $row['id'];
		$arr['title'] = SpHtml2Text($row['title']);
		$arr['intime'] = get_format_time($row['intime']);
		$arr['url'] = $row['url'];
		$list[] = $arr;
	}

	$location = location();
	include qq3479015851_tpl('shoucang');
}

?>
