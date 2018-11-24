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

require_once MEMBERDIR . '/include/common.func.php';
!in_array($ac, array('outbox', 'inbox', 'sendnew', 'view')) && ($ac = 'inbox');
$touser = (isset($_REQUEST['touser']) ? mhtmlspecialchars($_REQUEST['touser']) : '');

if (submit_check('pm_submit')) {
	$title = (isset($_POST['title']) ? mhtmlspecialchars($_POST['title']) : '');
	$content = (isset($_POST['content']) ? mhtmlspecialchars($_POST['content']) : '');

	if (is_array($deleteids)) {
		$where = ($ac == 'inbox' ? 'touser = \'' . $s_uid . '\'' : 'fromuser = \'' . $s_uid . '\'');
		$db->query('DELETE FROM `' . $db_qq3479015851 . 'member_pm` WHERE ' . $where . ' AND id ' . create_in($deleteids));
		write_msg('', '?m=pm&success=8&ac=' . $ac . '&page=' . $page);
	}
	else {
		if (empty($touser)) {
			write_msg('', '?m=pm&error=1&ac=' . $ac . ($id != '' ? '&id=' . $id : ''));
		}

		if (empty($title) && empty($content)) {
			write_msg('', '?m=pm&error=10&ac=' . $ac);
		}

		$content = textarea_post_change($content);
		$result = sendpm($s_uid, $touser, $title, $content);
		$url = ($result['succ'] == 'yes' ? '?m=pm&success=7&ac=' . $ac : '?m=pm&error=9&ac=' . $ac);
		$url .= '&id=' . $id;
		write_msg('', $url);
	}
}
else {
	$id = (isset($_GET['id']) ? intval($_GET['id']) : '');

	if (!empty($id)) {
		$db->query('UPDATE `' . $db_qq3479015851 . 'member_pm` SET `if_read` = \'1\' WHERE id = \'' . $id . '\'');
		$pm = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'member_pm` WHERE id = \'' . $id . '\'');

		if ($pm['id'] == '') {
			write_msg('', '?m=pm&error=12&ac=' . $ac . '&page=' . $page);
		}
	}
	else {
		if (empty($id) && in_array($ac, array('inbox', 'outbox'))) {
			$where = ($ac == 'inbox' ? ' WHERE touser = \'' . $s_uid . '\'' : ' WHERE fromuser = \'' . $s_uid . '\'');
			$sql = 'SELECT * FROM `' . $db_qq3479015851 . 'member_pm` ' . $where . ' ORDER BY pubtime DESC';
			$rows_num = qq3479015851_count('member_pm', $where);
			$param = setParam(array('m', 'ac'));
			$pm = page1($sql);
		}
	}

	$location = location();
	include qq3479015851_tpl('pm_' . ($id != '' ? 'view' : $ac));
}

?>
