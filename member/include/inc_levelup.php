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

$ac = (isset($ac) ? trim($ac) : 'step1');
require_once MEMBERDIR . '/include/common.func.php';

if (submit_check('levelup_submit')) {
	$forwardlevel = intval($_POST['forwardlevel']);

	if (empty($forwardlevel)) {
		write_msg('', '?m=levelup&error=14');
	}

	if ($forwardlevel == $levelid) {
		write_msg('', '?m=levelup&error=16');
	}

	$data = '';
	$data = read_static_cache('member_' . $levelid);
	$levelname = $data['levelname'];
	$forward = read_static_cache('member_' . $forwardlevel);

	if ($forward === false) {
		$forward = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'member_level` WHERE id = \'' . $forwardlevel . '\'');
	}

	$forwardlevelname = $forward['levelname'];

	if (empty($forwardlevelname)) {
		write_msg('', '?m=levelup&error=15');
	}

	$moneysettings = ($charset == 'utf-8' ? utf8_unserialize($forward['moneysettings']) : unserialize($forward['moneysettings']));
	$forwardlevelmoney = $moneysettings['money'];

	if ($ac == 'step2') {
		$location = location();
		include qq3479015851_tpl('levelup_2');
		exit();
	}
	else if ($ac == 'step3') {
		$leveluptime = mhtmlspecialchars($_POST['leveluptime']);
		$money_cost = $forwardlevelmoney[$leveluptime];
		$timearray = array('halfyear' => '183', 'year' => '365', 'month' => '30', 'forever' => '0');
		$levelup_time = ($timearray[$leveluptime] != 0 ? ($timearray[$leveluptime] * 3600 * 24) + $timestamp : 0);

		if ($money_own < $money_cost) {
			write_msg('', '?m=levelup&ac=step2&error=2');
		}

		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET levelid = \'' . $forwardlevel . '\',levelup_time = \'' . $levelup_time . '\',money_own = money_own - \'' . $money_cost . '\' ' . $where);
		$day = ($timearray[$leveluptime] == 0 ? '永久' : '<font color=blue>' . $timearray[$leveluptime] . '</font>天');
		write_money_use('升级会员级别为 <font color=red>' . $forwardlevelname . '</font>,期限为' . $day, '<font color=red>扣除金币 ' . $money_cost . ' </font>', $do_type);
		unset($day);
		write_msg('', '?m=levelup&success=8');
	}
}
else {
	$levelup_notice = $db->getOne('SELECT value FROM `' . $db_qq3479015851 . 'config` WHERE description = \'levelup_notice\'');
	$data = '';
	@include QQ3479015851_DATA . '/caches/member_' . $levelid . '.php';
	$levelname = ($data['levelname'] ? $data['levelname'] : $db->getOne('SELECT levelname FROM `' . $db_qq3479015851 . 'member_level` WHERE id = \'' . $levelid . '\''));
	unset($data);
	$memberlevel_array = get_memberlevel_array($levelid);
	$location = location();
	include qq3479015851_tpl('levelup');
}
function get_memberlevel_array($exceptid = '')
{
	global $db;
	global $db_qq3479015851;
	$query = $db->query('SELECT levelname,id FROM `' . $db_qq3479015851 . 'member_level` WHERE id > \'' . $exceptid . '\'');

	while ($row = $db->fetchRow($query)) {
		$res[$row['id']]['levelid'] = $row['id'];
		$res[$row['id']]['levelname'] = $row['levelname'];
		$res[$row['id']]['levelmoney'] = $row['levelmoney'];
	}

	if ($exceptid != '') {
		unset($res[$exceptid]);
	}

	return $res;
}

function GetUplevelTime($formname = 'upleveltime', $levelid = '')
{
	global $db;
	global $db_qq3479015851;
	global $charset;
	$timearray = array('halfyear' => '半年', 'forever' => '永久', 'month' => '一个月', 'year' => '一年');
	$data = '';
	@include QQ3479015851_DATA . '/caches/member_' . $levelid . '.php';

	if ($data == '') {
		$row = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'member_level` WHERE id = \'' . $levelid . '\'');
	}
	else {
		$row = $data;
	}

	unset($data);
	$moneysettings = ($charset == 'utf-8' ? utf8_unserialize($row['moneysettings']) : unserialize($row['moneysettings']));
	$newtimearray = array();

	foreach ($moneysettings['ifopen'] as $key => $val ) {
		$newtimearray[$key] = $timearray[$key];
	}

	unset($timearray);
	$upleveltime_form = '<select name=\'' . $formname . '\' id=\'' . $formname . '\'>';

	foreach ($newtimearray as $k => $v ) {
		$upleveltime_form .= '<option value=\'' . $k . '\'>' . $v . '</option>' . "\r\n";
	}

	$upleveltime_form .= '</select>' . "\r\n";
	return $upleveltime_form;
}


?>
