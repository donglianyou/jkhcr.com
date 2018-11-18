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
!(defined('QQ3479015851')) && exit('FORBIDDEN');

if (empty($id)) {
	exit('<center style=\'margin:20px; text-align:left; line-height:23px; color:#585858; font-size:12px\'>无效的分类信息主题！</center>');
}

require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_INC . '/db.class.php';
require_once QQ3479015851_DATA . '/info.level.inc.php';
require_once QQ3479015851_INC . '/member.class.php';
$log = $member_log->chk_in();

if ($ac == 'actionupgrade') {
	define('MEMBERDIR', QQ3479015851_ROOT . '/member');
	$where = ' WHERE userid = \'' . $s_uid . '\'';
	$id = intval($_POST['id']);
	$catid = intval($_POST['catid']);
	$upgrade_time = intval($_POST['upgrade_time']);
	$upgrade_type = trim($_POST['upgrade_type']);
	$iftop = intval($_POST['iftop']);
	$iflisttop = intval($_POST['iflisttop']);
	$ifindextop = intval($_POST['ifindextop']);
	$money_own = $db->getOne('SELECT money_own FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $s_uid . '\'');
	include QQ3479015851_ROOT . '/member/include/inc_info.php';
}
else {
	$row = $db->getRow('SELECT title,ismember,userid,catid,upgrade_type,upgrade_type_index,upgrade_type_list FROM `' . $db_qq3479015851 . 'information` WHERE id = \'' . $id . '\' AND info_level != 0');

	if (!($row)) {
		echo '<center style=\'margin:25px; text-align:left; line-height:28px; color:#585858; font-size:14px;font-family:microsoft yahei;\'>置顶失败，该信息不存在或者未通过审核！</center>';
	}
	else {
		if (($row['ismember'] == 1) && $log && ($s_uid == $row['userid'])) {
			$money = $member_log->get_info();
			$money = $money['money_own'];
			$catid = $row['catid'];
			include QQ3479015851_ROOT . '/template/box/' . $part . '.html';
		}
		else {
			if (($row['ismember'] == 1) && $log && ($s_uid != $row['userid'])) {
				echo '<center style=\'margin:25px; text-align:left; line-height:28px; color:#585858; font-size:14px;font-family:microsoft yahei;\'>置顶失败，该信息主题不是您发布的！</center>';
			}
			else {
				if (($row['ismember'] == 1) && !($log)) {
					@include QQ3479015851_DATA . '/caches/authcodesettings.php';
					$authcodesettings = $data;
					$data = NULL;
					$catid = $row['catid'];
					include QQ3479015851_ROOT . '/template/box/login.html';
					$authcodesettings = NULL;
				}
				else if ($row['ismember'] != 1) {
					echo '<center style=\'margin:25px; text-align:left; line-height:28px; color:#585858; font-size:14px;font-family:microsoft yahei;\'>置顶失败，游客发布的信息不能进行置顶操作！</center>';
				}
			}
		}
	}
}

$row = $log = $action = NULL;

?>
