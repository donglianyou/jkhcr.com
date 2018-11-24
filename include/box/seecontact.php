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
require_once SysGlbCfm_DATA . '/config.db.php';
require_once SysGlbCfm_INC . '/db.class.php';
require_once SysGlbCfm_INC . '/member.class.php';
$infoid = ($_REQUEST['infoid'] ? intval($_REQUEST['infoid']) : '');
$if_view = ($_REQUEST['if_view'] ? intval($_REQUEST['if_view']) : '');
!($infoid) && write_msg('您提交的参数不正确!', 'olmsg');

if (!($member_log->chk_in())) {
	@include SysGlbCfm_DATA . '/caches/authcodesettings.php';
	$authcodesettings = $data;
	$data = NULL;
	$gourl = 'seecontact';
	include SysGlbCfm_ROOT . '/template/box/login.html';
}
else {
	if (!($row = $db->getRow('SELECT a.*,b.usecoin FROM `' . $db_qq3479015851 . 'information` AS a LEFT JOIN `' . $db_qq3479015851 . 'category` AS b ON a.catid = b.catid WHERE a.id = \'' . $infoid . '\' AND a.info_level > 0'))) {
		write_msg('该信息不存在或者未经过审核！');
	}

	if ((mgetcookie('viewid') == $infoid) || ($row['userid'] == $s_uid)) {
		$view = 'yes';
	}
	else {
		$money_own = $db->getOne('SELECT money_own FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $s_uid . '\'');

		if ($action == 'delmoney') {
			include SysGlbCfm_ROOT . '/member/include/common.func.php';

			if ($row['usecoin'] <= $money_own) {
				$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET money_own = money_own - \'' . $row['usecoin'] . '\' WHERE userid = \'' . $s_uid . '\'');
				write_money_use('查看编号为' . $row[id] . '的信息联系方式', '<font color=red>扣除金币 ' . $row[usecoin] . ' </font>');
			}
			else {
				write_msg('您当前拥有的金币不足，请先充值！', $SystemGlobalcfm_global['SiteUrl'] . '/member/index.php?m=pay&box=1');
			}

			$view = 'yes';
			$row['ip'] = ($row['ip'] != '' ? part_ip($row['ip']) : '');
			msetcookie('viewid', $infoid, 3600 * 24);
		}
		else {
			$view = 'no';
		}
	}

	include SysGlbCfm_ROOT . '/template/box/seecontact.html';
}

$row = $infoid = $db = $SystemGlobalcfm_global = $if_view = NULL;

?>
