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

if ($if_corp != 1) {
	write_msg('您不是商家会员，无此操作权限！');
}

$ac = (in_array($ac, array('list', 'detail', 'signin')) ? $ac : 'list');
$id = (isset($id) ? intval($id) : '');

if (submit_check('group_submit')) {
	if (is_array($selectedids)) {
		$create_in = create_in($selectedids);
		$query = $db->query('SELECT * FROM `' . $db_qq3479015851 . 'group` ' . $where . ' AND groupid ' . $create_in);

		while ($row = $db->fetchRow($query)) {
			$delete[$row['id']]['picture'] = $row['picture'];
			$delete[$row['id']]['pre_picture'] = $row['pre_picture'];
		}

		foreach ($delete as $k => $v ) {
			@unlink(QQ3479015851_ROOT . $v['picture']);
			@unlink(QQ3479015851_ROOT . $v['pre_picture']);
		}

		$db->query('DELETE FROM `' . $db_qq3479015851 . 'group` ' . $where . ' AND groupid ' . $create_in);
		unset($delete);
		unset($row);
		unset($query);
		unset($create_in);
		write_msg('', '?m=group&success=3&status=' . $status . '&page=' . $page);
	}

	include QQ3479015851_DATA . '/config.inc.php';
	$name_file = 'group_image';
	$gname = trim(mhtmlspecialchars($_POST['gname']));
	$content = trim($_POST['content']);
	$des = textarea_post_change(trim($_POST['des']));
	$cate_id = intval($_POST['cate_id']);
	$cityid = ($cityid ? $cityid : intval($_POST['cityid']));
	$areaid = intval($_POST['areaid']);
	$streetid = intval($_POST['streetid']);
	$meetdate = intval(strtotime($_POST['meetdate']));
	$enddate = intval(strtotime($_POST['enddate']));
	$picture = (isset($_POST['picture_old']) ? mhtmlspecialchars($_POST['picture_old']) : '');
	$pre_picture = (isset($_POST['pre_picture_old']) ? mhtmlspecialchars($_POST['pre_picture_old']) : '');
	$gaddress = (isset($_POST['gaddress']) ? trim(mhtmlspecialchars($_POST['gaddress'])) : '');

	if (empty($gname)) {
		write_msg('', '?m=group&ac=detail&error=37&id=' . $id);
	}

	if (empty($content)) {
		write_msg('', '?m=group&ac=detail&error=35&id=' . $id);
	}

	if ($_FILES[$name_file]['name']) {
		require_once QQ3479015851_INC . '/upfile.fun.php';
		$destination = '/group/' . date('Ym') . '/';
		check_upimage($name_file);
		$qq3479015851_image = (empty($id) ? start_upload($name_file, $destination, 0, $qq3479015851_qq3479015851['cfg_group_limit']['width'], $qq3479015851_qq3479015851['cfg_group_limit']['height']) : start_upload($name_file, $destination, 0, $qq3479015851_qq3479015851['cfg_group_limit']['width'], $qq3479015851_qq3479015851['cfg_group_limit']['height'], $picture, $pre_picture));
		$picture = $qq3479015851_image[0];
		$pre_picture = $qq3479015851_image[1];
		unset($qq3479015851_image);
		unset($_FILES);
	}

	if (empty($id)) {
		$db->query('INSERT INTO `' . $db_qq3479015851 . 'group` (gname,des,content,pre_picture,picture,cate_id,cityid,areaid,gaddress,meetdate,enddate,userid,dateline,glevel) VALUES (\'' . $gname . '\',\'' . $des . '\',\'' . $content . '\',\'' . $pre_picture . '\',\'' . $picture . '\',\'' . $cate_id . '\',\'' . $cityid . '\',\'' . $areaid . '\',\'' . $gaddress . '\',\'' . $meetdate . '\',\'' . $enddate . '\',\'' . $s_uid . '\',\'' . $timestamp . '\',\'' . $glevel . '\')');
		$score_change = get_credit_score();
		$score_changer = $score_change['score']['rank']['group'];
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET score = score' . $score_changer . ' WHERE userid = \'' . $s_uid . '\'');
		$score_change = $score_changer = NULL;
		$url = '?m=group&success=8&ac=detail&id=' . $id . '&alert=3';
	}
	else {
		$db->query('UPDATE `' . $db_qq3479015851 . 'group` SET gname = \'' . $gname . '\',des = \'' . $des . '\',content = \'' . $content . '\',cate_id = \'' . $cate_id . '\',cityid=\'' . $cityid . '\',areaid = \'' . $areaid . '\',gaddress=\'' . $gaddress . '\',picture=\'' . $picture . '\',pre_picture=\'' . $pre_picture . '\',meetdate = \'' . $meetdate . '\',dateline = \'' . $timestamp . '\' ' . $where . ' AND groupid = \'' . $id . '\'');
	}

	write_msg('', $url ? $url : '?m=group&success=8&ac=detail&id=' . $id);
}
else if (submit_check('group_signin_submit')) {
	empty($selectids) && write_msg('', '?m=group&ac=signin&error=1&page=' . $page);
	$db->query('DELETE FROM `' . $db_qq3479015851 . 'group_signin` ' . $where . ' AND signid ' . create_in($selectedids));
	unset($selectedids);
	write_msg('', '?m=group&success=3&ac=signin&page=' . $page);
}
else {
	if ($ac == 'list') {
		require_once QQ3479015851_DATA . '/grouplevel.inc.php';
		$rows_num = qq3479015851_count('group', $where);
		$param = setParam(array('m', 'ac'));
		$group = page1('SELECT a.*,b.cate_name FROM `' . $db_qq3479015851 . 'group` AS a LEFT JOIN `' . $db_qq3479015851 . 'group_category` AS b ON a.cate_id = b.cate_id WHERE a.userid = \'' . $s_uid . '\' ORDER BY a.dateline DESC');
	}
	else if ($ac == 'detail') {
		require_once QQ3479015851_DATA . '/grouplevel.inc.php';
		require_once QQ3479015851_ROOT . '/plugin/group/include/functions.php';
		require_once QQ3479015851_INC . '/class.fun.php';

		if ($id) {
			$edit = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'group` WHERE groupid = \'' . $id . '\'');
			$edit['meetdate'] = date('Y-m-d', $edit['meetdate']);
			$edit['enddate'] = date('Y-m-d', $edit['enddate']);
			$des = de_textarea_post_change($edit['des']);
		}

		$acontent = get_editor('content', 'Member', $edit['content'], '90%', '250px');
	}
	else if ($ac == 'signin') {
		require_once QQ3479015851_DATA . '/group_signin_status.inc.php';

		if (empty($id)) {
			$param = setParam('m', 'ac', 'id');
			$rows_num = $db->getOne('SELECT COUNT(a.signid) FROM `' . $db_qq3479015851 . 'group_signin` AS a LEFT JOIN `' . $db_qq3479015851 . 'group` AS b ON a.groupid = b.groupid WHERE b.userid = \'' . $s_uid . '\'');
			$signin = page1('SELECT a.*,b.gname FROM `' . $db_qq3479015851 . 'group_signin` AS a LEFT JOIN `' . $db_qq3479015851 . 'group` AS b ON a.groupid = b.groupid  WHERE b.userid = \'' . $s_uid . '\' ORDER BY dateline DESC');
		}
		else {
			$signin = $db->getRow('SELECT a.*,b.gname FROM `' . $db_qq3479015851 . 'group_signin` AS a LEFT JOIN `' . $db_qq3479015851 . 'group` AS b ON a.groupid = b.groupid WHERE b.userid = \'' . $s_uid . '\' AND a.signid = \'' . $id . '\'');
			$ac = $ac . '_view';
		}
	}

	$location = location('corp');
	include qq3479015851_tpl('group_' . $ac);
	unset($glevel);
}

?>
