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

$ac = (in_array($ac, array('list', 'detail', 'order')) ? $ac : 'list');
$id = (isset($id) ? intval($id) : '');
$goodsid = ($_REQUEST['goodsid'] ? intval($_REQUEST['goodsid']) : '');

if (submit_check('goods_submit')) {
	$cityid = (isset($_REQUEST['cityid']) ? intval($_REQUEST['cityid']) : '');

	if (is_array($selectedids)) {
		$create_in = create_in($selectedids);
		$query = $db->query('SELECT * FROM `' . $db_qq3479015851 . 'goods` ' . $where . ' AND goodsid ' . $create_in);

		while ($row = $db->fetchRow($query)) {
			$delete[$row['id']]['picture'] = $row['picture'];
			$delete[$row['id']]['pre_picture'] = $row['pre_picture'];
		}

		foreach ($delete as $k => $v ) {
			@unlink(QQ3479015851_ROOT . $v['picture']);
			@unlink(QQ3479015851_ROOT . $v['pre_picture']);
		}

		$db->query('DELETE FROM `' . $db_qq3479015851 . 'goods` ' . $where . ' AND goodsid ' . $create_in);
		unset($delete);
		unset($row);
		unset($query);
		unset($create_in);
		write_msg('', '?m=goods&success=3&status=' . $status . '&page=' . $page);
	}

	include QQ3479015851_DATA . '/config.inc.php';
	$name_file = 'goods_image';
	$goodsname = trim(mhtmlspecialchars($_POST['goodsname']));
	$content = trim($_POST['content']);
	$catid = intval($_POST['catid']);
	$oicq = trim(mhtmlspecialchars($_POST['oicq']));
	$oldprice = trim(mhtmlspecialchars($_POST['oldprice']));
	$nowprice = trim(mhtmlspecialchars($_POST['nowprice']));
	$oicq = trim(mhtmlspecialchars($_POST['oicq']));
	$tuihuan = intval($_POST['tuihuan']);
	$baozhang = intval($_POST['baozhang']);
	$jiayi = intval($_POST['jiayi']);
	$weixiu = intval($_POST['weixiu']);
	$fahuo = intval($_POST['fahuo']);
	$cuxiao = intval($_POST['cuxiao']);
	$gift = mhtmlspecialchars($_POST['gift']);
	$goodsbh = date('Ymd') . random(3);
	$huoyuan = intval($_POST['huoyuan']);
	$picture = (isset($_POST['picture_old']) ? mhtmlspecialchars($_POST['picture_old']) : '');
	$pre_picture = (isset($_POST['pre_picture_old']) ? mhtmlspecialchars($_POST['pre_picture_old']) : '');

	if (empty($goodsname)) {
		write_msg('', '?m=goods&ac=detail&error=42&id=' . $id);
	}

	if (empty($content)) {
		write_msg('', '?m=goods&ac=detail&error=43&id=' . $id);
	}

	if (empty($catid)) {
		write_msg('', '?m=goods&ac=detail&error=44&id=' . $id);
	}

	if (empty($cityid)) {
		write_msg('', '?m=goods&ac=detail&error=40&id=' . $id);
	}

	if ($_FILES[$name_file]['name']) {
		require_once QQ3479015851_INC . '/upfile.fun.php';
		$destination = '/goods/' . date('Ym') . '/';
		check_upimage($name_file);
		$qq3479015851_image = (empty($id) ? start_upload($name_file, $destination, 0, $qq3479015851_qq3479015851['cfg_goods_limit']['width'], $qq3479015851_qq3479015851['cfg_goods_limit']['height']) : start_upload($name_file, $destination, 0, $qq3479015851_qq3479015851['cfg_goods_limit']['width'], $qq3479015851_qq3479015851['cfg_goods_limit']['height'], $picture, $pre_picture));
		$picture = $qq3479015851_image[0];
		$pre_picture = $qq3479015851_image[1];
		unset($qq3479015851_image);
		unset($_FILES);
	}

	if (empty($id)) {
		$db->query('INSERT INTO `' . $db_qq3479015851 . 'goods` (goodsname,goodsbh,cityid,catid,oicq,oldprice,nowprice,content,pre_picture,picture,userid,dateline,tuihuan,jiayi,weixiu,fahuo,cuxiao,baozhang,huoyuan,gift) VALUES (\'' . $goodsname . '\',\'' . $goodsbh . '\',\'' . $cityid . '\',\'' . $catid . '\',\'' . $oicq . '\',\'' . $oldprice . '\',\'' . $nowprice . '\',\'' . $content . '\',\'' . $pre_picture . '\',\'' . $picture . '\',\'' . $s_uid . '\',\'' . $timestamp . '\',\'' . $tuihuan . '\',\'' . $jiayi . '\',\'' . $weixiu . '\',\'' . $fahuo . '\',\'' . $cuxiao . '\',\'' . $baozhang . '\',\'' . $huoyuan . '\',\'' . $gift . '\')');
		$id = $db->insert_id();
		$score_change = get_credit_score();
		$score_changer = $score_change['score']['rank']['goods'];
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET score = score' . $score_changer . ' WHERE userid = \'' . $s_uid . '\'');
		$score_change = $score_changer = NULL;
		$url = '?m=goods&success=8&ac=detail&id=' . $id . '&alert=4';
	}
	else {
		$db->query('UPDATE `' . $db_qq3479015851 . 'goods` SET cityid=\'' . $cityid . '\',goodsname = \'' . $goodsname . '\',catid = \'' . $catid . '\',oicq=\'' . $oicq . '\',oldprice = \'' . $oldprice . '\',nowprice = \'' . $nowprice . '\',content = \'' . $content . '\',pre_picture=\'' . $pre_picture . '\',picture=\'' . $picture . '\',dateline=\'' . $timestamp . '\',tuihuan = \'' . $tuihuan . '\',jiayi = \'' . $jiayi . '\',weixiu=\'' . $weixiu . '\',fahuo=\'' . $fahuo . '\',cuxiao=\'' . $cuxiao . '\',baozhang=\'' . $baozhang . '\',huoyuan = \'' . $huoyuan . '\',gift=\'' . $gift . '\' ' . $where . ' AND goodsid = \'' . $id . '\'');
	}

	write_msg('', $url ? $url : '?m=goods&success=8&ac=detail&id=' . $id);
}
else if (submit_check('goods_order_submit')) {
	empty($selectids) && write_msg('', '?m=goods&ac=order&error=1&page=' . $page);
	$db->query('DELETE FROM `' . $db_qq3479015851 . 'goods_order` ' . $where . ' AND id ' . create_in($selectedids));
	unset($selectedids);
	write_msg('', '?m=goods&success=3&ac=order&page=' . $page);
}
else {
	@include_once QQ3479015851_DATA . '/moneytype.inc.php';

	if ($ac == 'list') {
		$rows_num = qq3479015851_count('goods', $where);
		$param = setParam(array('m', 'ac'));
		$goods = page1('SELECT * FROM `' . $db_qq3479015851 . 'goods` ' . $where . ' ORDER BY dateline DESC');
	}
	else if ($ac == 'detail') {
		@require_once QQ3479015851_ROOT . '/plugin/goods/include/functions.php';

		if ($id) {
			$edit = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'goods` WHERE goodsid = \'' . $id . '\'');
		}

		$acontent = get_editor('content', 'Member', $edit['content'], '90%', '400px');
	}
	else if ($ac == 'order') {
		if (empty($id)) {
			$param = setParam('m', 'ac', 'id');
			$rows_num = $db->getOne('SELECT COUNT(a.id) FROM `' . $db_qq3479015851 . 'goods_order` AS a LEFT JOIN `' . $db_qq3479015851 . 'goods` AS b ON a.goodsid = b.goodsid WHERE b.userid = \'' . $s_uid . '\'');
			$order = page1('SELECT a.*,b.goodsname FROM `' . $db_qq3479015851 . 'goods_order` AS a LEFT JOIN `' . $db_qq3479015851 . 'goods` AS b ON a.goodsid = b.goodsid  WHERE b.userid = \'' . $s_uid . '\' ORDER BY dateline DESC');
		}
		else {
			$order = $db->getRow('SELECT a.*,b.goodsname FROM `' . $db_qq3479015851 . 'goods_order` AS a LEFT JOIN `' . $db_qq3479015851 . 'goods` AS b ON a.goodsid = b.goodsid WHERE b.userid = \'' . $s_uid . '\' AND a.id = \'' . $id . '\'');
			$ac = $ac . '_view';
		}
	}

	$location = location('corp');
	include qq3479015851_tpl('goods_' . $ac);
	unset($glevel);
}

?>
