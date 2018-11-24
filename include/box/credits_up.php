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
require_once SysGlbCfm_INC . '/cache.fun.php';
require_once SysGlbCfm_INC . '/member.class.php';

if (!($member_log->chk_in())) {
	write_msg('对不起,您还没有登录！');
}

$score_change = get_credit_score();
$coin_credit = $score_change['credit']['rank']['coin_credit'];
$row = $db->getRow('SELECT credit,credits,money_own FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $s_uid . '\'');

if ($action == 'post') {
	require_once SysGlbCfm_ROOT . '/member/include/common.func.php';
	$coin = (isset($_POST['coin']) ? floor(intval($_POST['coin'])) : '');
	if (!($coin) || ($coin < 0)) {
		write_msg('请输入您要使用的金币。');
	}

	if ($row['money_own'] < $coin) {
		write_msg('您的金币余额不足，请先充值。');
	}

	$credit = $coin * $coin_credit;
	$nowcredit = $row['credit'] + $credit;

	if ($score_change) {
		foreach ($score_change['credit_set']['rank'] as $level => $credi ) {
			if ($nowcredit <= $credi) {
				$credits = $level;
				break;
			}
			else {
				$credits = 16;
			}
		}

		$credits = $credits - 1;
	}

	$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET money_own = money_own - ' . $coin . ' , credit = credit + ' . $credit . ',credits = \'' . $credits . '\' WHERE userid = \'' . $s_uid . '\'');
	write_money_use('购买 ' . $credit . ' 信用值', '<font color=red>扣除金币 ' . $coin . ' </font>');
	write_msg('兑换成功! 您目前的信用值已变为<font color=red>' . $nowcredit . '</font>，帐户已成功扣除<font color=red>' . $coin . '</font>金币<br /><br /><input value="关闭窗口" type="button" onclick=\'parent.window.location.reload();parent.closeopendiv();\' style="margin-left:auto;margin-right:auto;" class="blue">', 'olmsg');
}
else {
	$defaultrank = array(1 => 10, 2 => 20, 3 => 40, 4 => 70, 5 => 120, 6 => 200, 7 => 400, 8 => 700, 9 => 1200, 10 => 1800, 11 => 2600, 12 => 4000, 13 => 10000, 14 => 30000, 15 => 60000);
	$credit_set = $db->getOne('SELECT value FROM `' . $db_qq3479015851 . 'config` WHERE type=\'credit_sco\' AND description = \'credit_set\'');
	$credit_set = ($credit_set ? ($charset == 'utf-8' ? utf8_unserialize($credit_set) : unserialize($credit_set)) : array('rank' => $defaultrank));
	include SysGlbCfm_ROOT . '/template/box/credits_up.html';
}

$row = $credit_set = $defaultrank = $nowcredit = $credit = $credits = $credit_set = NULL;

?>
