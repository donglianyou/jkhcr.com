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

if ($if_corp != 1) {
	write_msg('您不是商家会员，无此操作权限！');
}

$ac = (in_array($ac, array('list', 'detail')) ? $ac : 'list');

if (submit_check('coupon_submit')) {
	if (is_array($selectedids)) {
		$create_in = create_in($selectedids);
		$query = $db->query('SELECT * FROM `' . $db_qq3479015851 . 'coupon` ' . $where . ' AND id ' . $create_in);

		while ($row = $db->fetchRow($query)) {
			$delete[$row['id']]['picture'] = $row['picture'];
			$delete[$row['id']]['pre_picture'] = $row['pre_picture'];
		}

		foreach ($delete as $k => $v ) {
			@unlink(SysGlbCfm_ROOT . $v['picture']);
			@unlink(SysGlbCfm_ROOT . $v['pre_picture']);
		}

		$db->query('DELETE FROM `' . $db_qq3479015851 . 'coupon` ' . $where . ' AND id ' . $create_in);
		unset($delete);
		unset($row);
		unset($query);
		unset($create_in);
		write_msg('', '?m=coupon&success=3&status=' . $status . '&page=' . $page);
	}

	include SysGlbCfm_DATA . '/config.inc.php';
	$name_file = 'coupon_image';
	$title = trim(mhtmlspecialchars($_POST['title']));
	$content = trim($_POST['content']);
	$des = textarea_post_change(mhtmlspecialchars($_POST['des']));
	$cate_id = intval($_POST['cate_id']);
	$cityid = ($cityid ? $cityid : intval($_POST['cityid']));
	$areaid = intval($_POST['areaid']);
	$streetid = intval($_POST['streetid']);
	$begindate = intval(strtotime($_POST['begindate']));
	$enddate = intval(strtotime($_POST['enddate']));
	$picture = (isset($_POST['picture_old']) ? mhtmlspecialchars($_POST['picture_old']) : '');
	$pre_picture = (isset($_POST['pre_picture_old']) ? mhtmlspecialchars($_POST['pre_picture_old']) : '');
	$ctype = (isset($_POST['ctype']) ? mhtmlspecialchars($_POST['ctype']) : '');
	$sup = (isset($_POST['sup']) ? mhtmlspecialchars($_POST['sup']) : '');
	$status = (isset($_POST['status']) ? intval($_POST['status']) : '');

	if (empty($title)) {
		write_msg('', '?m=coupon&type=corp&ac=detail&error=37&id=' . $id);
	}

	if (empty($content)) {
		write_msg('', '?m=coupon&type=corp&ac=detail&error=35&id=' . $id);
	}

	if (empty($id) && !$_FILES[$name_file]) {
		write_msg('', '?m=coupon&type=corp&ac=detail&error=36&id=' . $id);
	}

	if ($_FILES[$name_file]['name']) {
		require_once SysGlbCfm_INC . '/upfile.fun.php';
		check_upimage($name_file);
		$destination = '/coupon/' . date('Ym') . '/';
		$SystemGlobalcfm_image = (empty($id) ? start_upload($name_file, $destination, 0, $SystemGlobalcfm_qq3479015851['cfg_coupon_limit']['width'], $SystemGlobalcfm_qq3479015851['cfg_coupon_limit']['height']) : start_upload($name_file, $destination, 0, $SystemGlobalcfm_qq3479015851['cfg_coupon_limit']['width'], $SystemGlobalcfm_qq3479015851['cfg_coupon_limit']['height'], $picture, $pre_picture));
		$picture = $SystemGlobalcfm_image[0];
		$pre_picture = $SystemGlobalcfm_image[1];
		unset($SystemGlobalcfm_image);
	}

	if (empty($id)) {
		$db->query('INSERT INTO `' . $db_qq3479015851 . 'coupon` (title,des,content,pre_picture,picture,cate_id,cityid,areaid,begindate,enddate,userid,dateline,ctype,sup,status) VALUES (\'' . $title . '\',\'' . $des . '\',\'' . $content . '\',\'' . $pre_picture . '\',\'' . $picture . '\',\'' . $cate_id . '\',\'' . $cityid . '\',\'' . $areaid . '\',\'' . $begindate . '\',\'' . $enddate . '\',\'' . $s_uid . '\',\'' . $timestamp . '\',\'' . $ctype . '\',\'' . $sup . '\',\'' . $status . '\')');
		$score_change = get_credit_score();
		$score_changer = $score_change['score']['rank']['coupon'];
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET score = score' . $score_changer . ' WHERE userid = \'' . $s_uid . '\'');
		$score_change = $score_changer = NULL;
		$url = '?m=coupon&success=8&ac=detail&id=' . $id . '&alert=2';
	}
	else {
		$db->query('UPDATE `' . $db_qq3479015851 . 'coupon` SET title = \'' . $title . '\',des = \'' . $des . '\',content = \'' . $content . '\',cate_id = \'' . $cate_id . '\',cityid=\'' . $cityid . '\',areaid = \'' . $areaid . '\',picture=\'' . $picture . '\',pre_picture=\'' . $pre_picture . '\',begindate = \'' . $begindate . '\',enddate=\'' . $enddate . '\', dateline = \'' . $timestamp . '\' , ctype = \'' . $ctype . '\' , sup = \'' . $sup . '\' , status = \'' . $status . '\' ' . $where . ' AND id = \'' . $id . '\'');
	}

	write_msg('', $url ? $url : '?m=coupon&type=corp&success=8&ac=detail&id=' . $id);
}
else {
	if ($ac == 'list') {
		$status = (isset($_GET['status']) ? trim($_GET['status']) : '');
		if (!in_array($status, array('yes', 'no')) || empty($status)) {
			$status = 'yes';
		}

		$where .= ($status == 'yes' ? ' AND status = \'1\'' : ' AND status = \'0\'');
		$rows_num = qq3479015851_count('coupon', $where);
		$param = setParam(array('m', 'type', 'ac', 'status'));
		$coupon = page1('SELECT * FROM `' . $db_qq3479015851 . 'coupon` ' . $where . ' ORDER BY dateline DESC');
	}
	else if ($ac == 'detail') {
		require_once SysGlbCfm_ROOT . '/plugin/coupon/include/functions.php';
		require_once SysGlbCfm_INC . '/class.fun.php';

		if ($id) {
			$edit = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'coupon` WHERE id = \'' . $id . '\'');
			$begindate = date('Y-m-d', $edit['begindate']);
			$enddate = date('Y-m-d', $edit['enddate']);
			$edit['des'] = de_textarea_post_change($edit['des']);
		}

		$acontent = get_editor('content', 'Member', $edit['content'], '90%', '250px');
	}

	$location = location('corp');
	include qq3479015851_tpl('coupon_' . $ac);
}

?>
