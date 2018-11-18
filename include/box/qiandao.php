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
require_once QQ3479015851_INC . '/cache.fun.php';
require_once QQ3479015851_INC . '/member.class.php';

if (!($member_log->chk_in())) {
	write_msg('对不起,您还没有登录！');
}

$row = $db->getRow('SELECT id,score,qdtime FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $s_uid . '\'');
$score_change = get_credit_score();
$score_changer = $score_change['score']['rank']['login'];

if (!(empty($score_changer))) {
	$qdtime = GetTime($row['qdtime'], 'ymd');
	$nowtime = GetTime($timestamp, 'ymd');

	if ($qdtime != $nowtime) {
		if (!(empty($score_changer))) {
			$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET score = score' . $score_changer . ',qdtime=\'' . $timestamp . '\' WHERE userid = \'' . $s_uid . '\'');
		}

		$score = $db->getOne('SELECT score FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $s_uid . '\'');
		include QQ3479015851_ROOT . '/template/box/qiandao.html';
	}
	else {
		echo '<p style="font-size:12px;margin:30px 10px;">今天您已经签到过了，明天再来吧！</p>';
	}
}

$row = $score = NULL;

?>
