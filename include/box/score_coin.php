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
require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_INC . '/db.class.php';
require_once QQ3479015851_INC . '/member.class.php';

if (!($member_log->chk_in())) {
	write_msg('对不起,您还没有登录！');
}

$row = $db->getRow('SELECT score FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $s_uid . '\'');

if ($action == 'post') {
	$score = (isset($_POST['score']) ? intval($_POST['score']) : '');

	if (!($score)) {
		write_msg('请输入您要兑换的积分数额。');
	}

	if ($row['score'] < $score) {
		write_msg('您输入的积分数额已经超过您的用户积分');
	}

	$coin = floor($score / $qq3479015851_global['cfg_score_fee']);

	if (empty($coin)) {
		write_msg('兑换失败，请重新设置有效的兑换积分');
	}

	$truescore = $coin * $qq3479015851_global['cfg_score_fee'];
	$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET score = score - ' . $truescore . ',money_own=money_own + ' . $coin . ' WHERE userid = \'' . $s_uid . '\'');
	write_msg('兑换成功! 您的帐户已成功增加<font color=red>' . $coin . '</font>金币<br /><br /><input value="关闭窗口" type="button" onclick=\'parent.window.location.reload();parent.closeopendiv();\' style="margin-left:auto;margin-right:auto;" class="blue">', 'olmsg');
}
else {
	include QQ3479015851_ROOT . '/template/box/score_coin.html';
}

$row = $coin = $score = NULL;

?>
