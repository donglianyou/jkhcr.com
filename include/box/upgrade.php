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
!(defined('SysGlbCfm')) && exit('FORBIDDEN');

if (empty($id)) {
	exit('<center style=\'margin:20px; text-align:left; line-height:23px; color:#585858; font-size:12px\'>无效的分类信息主题！</center>');
}

require_once SysGlbCfm_DATA . '/config.db.php';
require_once SysGlbCfm_INC . '/db.class.php';
require_once SysGlbCfm_DATA . '/info.level.inc.php';
require_once SysGlbCfm_INC . '/member.class.php';
$log = $member_log->chk_in();

if ($ac == 'actionupgrade') {
	define('MEMBERDIR', SysGlbCfm_ROOT . '/member');
	$where = ' WHERE userid = \'' . $s_uid . '\'';
	$id = intval($_POST['id']);
	$catid = intval($_POST['catid']);
	$upgrade_time = intval($_POST['upgrade_time']);
	$upgrade_type = trim($_POST['upgrade_type']);
	$iftop = intval($_POST['iftop']);
	$iflisttop = intval($_POST['iflisttop']);
	$ifindextop = intval($_POST['ifindextop']);
	$money_own = $db->getOne('SELECT money_own FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $s_uid . '\'');
	include SysGlbCfm_ROOT . '/member/include/inc_info.php';
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
			include SysGlbCfm_ROOT . '/template/box/' . $part . '.html';
		}
		else {
			if (($row['ismember'] == 1) && $log && ($s_uid != $row['userid'])) {
				echo '<center style=\'margin:25px; text-align:left; line-height:28px; color:#585858; font-size:14px;font-family:microsoft yahei;\'>置顶失败，该信息主题不是您发布的！</center>';
			}
			else {
				if (($row['ismember'] == 1) && !($log)) {
					@include SysGlbCfm_DATA . '/caches/authcodesettings.php';
					$authcodesettings = $data;
					$data = NULL;
					$catid = $row['catid'];
					include SysGlbCfm_ROOT . '/template/box/login.html';
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
