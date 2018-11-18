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

$do_act = (isset($_REQUEST['do_act']) ? trim($_REQUEST['do_act']) : '');

if (submit_check('comment_submit')) {
	switch ($do_act) {
	case 'reply':
		empty($id) && write_msg('', '?m=comment&type=corp&error=1&id=' . $id);
		$reply = (isset($_POST['reply']) ? textarea_post_change($_POST['reply']) : '');
		$db->query('UPDATE `' . $db_qq3479015851 . 'member_comment` SET reply = \'' . $reply . '\',retime = \'' . $timestamp . '\' ' . $where . ' AND id = \'' . $id . '\'');
		write_msg('', '?m=comment&type=corp&success=8&c=' . $c . '&id=' . $id);
		break;

	default:
		empty($selectedids) && write_msg('', '?m=comment&type=corp&error=1&page=' . $page . '&t=' . $t . '&c=' . $c);
		$db->query('DELETE FROM `' . $db_qq3479015851 . 'member_comment` ' . $where . ' AND id ' . create_in($selectedids));
		write_msg('', '?m=comment&type=corp&success=3&page=' . $page . '&t=' . $t . '&c=' . $c);
		break;
	}
}
else if (empty($id)) {
	$t = (isset($_GET['t']) ? trim($_GET['t']) : '');
	$c = (isset($_GET['c']) ? trim($_GET['c']) : '');
	!in_array($c, array('good', 'middle', 'bad', 'all')) && ($c = 'all');
	!in_array($t, array('lastweek', 'lastmonth', 'last3month', 'all')) && ($t = 'all');
	$lastweek = $timestamp - (86400 * 7);
	$lastmonth = $timestamp - (86400 * 30);
	$last3month = $timestamp - (86400 * 90);

	if ($t == 'lastweek') {
		$where .= ' AND pubtime >= \'' . $lastweek . '\'';
	}
	else if ($t == 'lastmonth') {
		$where .= ' AND pubtime >= \'' . $lastmonth . '\'';
	}
	else if ($t == 'last3month') {
		$where .= ' AND pubtime >= \'' . $last3month . '\'';
	}

	unset($lastweek);
	unset($lastmonth);
	unset($last3month);

	if ($c == 'good') {
		$where .= ' AND enjoy IN(\'2\',\'3\')';
	}
	else if ($c == 'middle') {
		$where .= ' AND enjoy = \'1\'';
	}
	else if ($c == 'bad') {
		$where .= ' AND enjoy = \'0\'';
	}

	$rows_num = qq3479015851_count('member_comment', $where);
	$param = setParam(array('m', 't', 'c', 'type'));
	$comment = page1('SELECT * FROM `' . $db_qq3479015851 . 'member_comment` ' . $where . ' ORDER BY id DESC');
	$count = get_comment_count();
	$location = location('corp');
	include qq3479015851_tpl('comment');
}
else {
	$comment = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'member_comment` ' . $where . ' AND id = \'' . $id . '\'');

	if (!$comment['id']) {
		write_msg('操作失败！该评论并不存在！');
	}

	$c = ($comment['enjoy'] == 1 ? 'middle' : ($comment['enjoy'] == 0 ? 'bad' : 'good'));
	$location = location('corp');
	include qq3479015851_tpl('comment_reply');
}
function get_comment_count()
{
	global $s_uid;
	global $db;
	global $db_qq3479015851;
	global $timestamp;
	static $count = array();
	$where = 'WHERE userid = \'' . $s_uid . '\'';
	$lastweek = ' AND pubtime >= \'' . $timestamp . ' - 86400*7\'';
	$lastmonth = ' AND pubtime >= \'' . $timestamp . ' - 86400*30\'';
	$last3month = ' AND pubtime >= \'' . $timestamp . ' - 86400*90\'';
	$wms = '';
	$good = ' AND enjoy IN(\'2\',\'3\')';
	$middle = ' AND enjoy = \'1\'';
	$bad = ' AND enjoy = \'0\'';
	$gmb = '';
	$sql = 'SELECT COUNT(id) FROM `' . $db_qq3479015851 . 'member_comment` ' . $where;

	foreach (array('good', 'bad', 'middle') as $k => $v ) {
		foreach (array('lastweek', 'last3month', 'lastmonth', 'wms') as $key => $val ) {
			$count[$v][$val] = $db->getOne($sql . $$v . $$val);
		}
	}

	unset($lastweek);
	unset($lastmonth);
	unset($last3month);
	return $count;
}


?>
