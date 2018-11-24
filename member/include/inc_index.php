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

$levelname = $db->getOne('SELECT levelname FROM `' . $db_qq3479015851 . 'member_level` WHERE id = \'' . $levelid . '\'');
$info_total = $db->getOne('SELECT COUNT(id) FROM `' . $db_qq3479015851 . 'information` ' . $where);

if ($if_corp == 1) {
	$document_total = $db->getOne('SELECT COUNT(*) FROM `' . $db_qq3479015851 . 'member_docu` ' . $where);
	$album_total = $db->getOne('SELECT COUNT(*) FROM `' . $db_qq3479015851 . 'member_album` ' . $where);
	$comment_total = $db->getOne('SELECT COUNT(*) FROM `' . $db_qq3479015851 . 'member_comment` ' . $where);

	if (ifplugin('group')) {
		$group_total = $db->getOne('SELECT COUNT(*) FROM `' . $db_qq3479015851 . 'group` ' . $where);
		$group_signin_total = $db->getOne('SELECT COUNT(*) FROM `' . $db_qq3479015851 . 'group_signin` AS a LEFT JOIN `' . $db_qq3479015851 . 'group` AS b ON a.groupid = b.groupid  WHERE b.userid = \'' . $s_uid . '\'');
	}

	if (ifplugin('goods')) {
		$goods_total = $db->getOne('SELECT COUNT(*) FROM `' . $db_qq3479015851 . 'goods` ' . $where);
		$goods_order_total = $db->getOne('SELECT COUNT(*) FROM `' . $db_qq3479015851 . 'goods_order` AS a LEFT JOIN `' . $db_qq3479015851 . 'goods` AS b ON a.goodsid = b.goodsid  WHERE b.userid = \'' . $s_uid . '\'');
	}

	ifplugin('coupon') && ($coupon_total = $db->getOne('SELECT COUNT(*) FROM `' . $db_qq3479015851 . 'coupon` ' . $where));
}

$location = location();
$spacestore = ($row['if_corp'] == 1 ? Rewrite('store', array('uid' => $uid)) : Rewrite('space', array('user' => $s_uid)));
$qdtime = GetTime($row['qdtime'], 'ymd');
$nowtime = GetTime($timestamp, 'ymd');
$score_change = get_credit_score();
$score_changer = intval($score_change['score']['rank']['login']);
include qq3479015851_tpl('index');
unset($data);
unset($levelname);
unset($document_total);
unset($album_total);
unset($comment_total);
unset($coupon_total);
unset($group_total);
unset($group_singin_total);
unset($creditrank);
unset($credit_score);
unset($spacestore);

?>
