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
function ToPayMoney($money, $orderid, $uid, $userid, $SystemGlobalcfm_paytype)
{
	global $db;
	global $db_qq3479015851;
	global $SystemGlobalcfm_global;
	global $timestamp;
	$orderid = var_action($orderid);

	if ($money) {
		if ($SystemGlobalcfm_global['cfg_coin_fee']) {
			$money = $money * $SystemGlobalcfm_global['cfg_coin_fee'];
		}

		$payip = GetIP();
		$db->query('INSERT INTO ' . $db_qq3479015851 . 'payrecord(id,uid,userid,orderid,money,posttime,paybz,type,payip) values(\'\',\'' . $uid . '\',\'' . $userid . '\',\'' . $orderid . '\',\'' . $money . '\',\'' . $timestamp . '\',\'等待支付\',\'' . $SystemGlobalcfm_paytype . '\',\'' . $payip . '\');');
	}
}

function UpdatePayRecord($orderid, $paybz, $upmoney = 1)
{
	global $db;
	global $db_qq3479015851;
	global $SystemGlobalcfm_global;
	global $timestamp;
	$orderid = var_action($orderid);
	$r = $db->getRow('SELECT money,userid,ifadd FROM `' . $db_qq3479015851 . 'payrecord` WHERE orderid = \'' . $orderid . '\'');
	$money = $r['money'];
	$userid = $r['userid'];
	$ifadd = $r['ifadd'];
	if ($money && $userid && ($ifadd != 1) && ($upmoney == 1)) {
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET money_own = money_own + ' . $money . ' WHERE userid = \'' . $userid . '\'');
	}

	$db->query('UPDATE `' . $db_qq3479015851 . 'payrecord` SET paybz = \'' . $paybz . '\',ifadd = 1 WHERE orderid = \'' . $orderid . '\';');
}

function PayApiPayMoney($money, $paybz, $orderid, $uid, $userid, $SystemGlobalcfm_paytype)
{
	global $db;
	global $db_qq3479015851;
	global $SystemGlobalcfm_global;
	global $timestamp;
	$orderid = var_action($orderid);
	$num = $db->getOne('SELECT count(id) FROM ' . $db_qq3479015851 . 'payrecord WHERE orderid = \'' . $orderid . '\'');

	if (0 < $num) {
		write_msg('您已充值过 ' . $money . ' 请不要重复刷新', $SystemGlobalcfm_global[SiteUrl] . '/member/index.php?m=pay&ac=record');
	}
	else if ($money) {
		if ($SystemGlobalcfm_global['cfg_coin_fee']) {
			$money = $money * $SystemGlobalcfm_global['cfg_coin_fee'];
		}

		$sql = $db->query('UPDATE `' . $db_qq3479015851 . 'member` SET money_own = money_own + ' . $money . ' WHERE userid = \'' . $userid . '\'');
		$payip = GetIP();
		$db->query('INSERT INTO ' . $db_qq3479015851 . 'payrecord(id,uid,userid,orderid,money,ifadd,posttime,paybz,type,payip) values(\'\',\'' . $uid . '\',\'' . $userid . '\',\'' . $orderid . '\',\'' . $money . '\',1,\'' . $timestamp . '\',\'' . $paybz . '\',\'' . $SystemGlobalcfm_paytype . '\',\'' . $payip . '\');');
		write_msg('您已成功充值 ' . $money . ' 个金币', $SystemGlobalcfm_global[SiteUrl] . '/member/index.php?m=pay&ac=record');
	}
	else {
		write_msg('充值失败，请联系网站管理员以获得帮助。', $SystemGlobalcfm_global[SiteUrl] . '/member/index.php?m=pay&ac=record');
	}
}

function var_action($val)
{
	if ($val != addslashes($val)) {
		exit();
	}

	$val = str_replace(' ', '', $val);
	$val = str_replace('%20', '', $val);
	$val = str_replace('%27', '', $val);
	$val = str_replace('*', '', $val);
	$val = str_replace('\'', '', $val);
	$val = str_replace('"', '', $val);
	$val = str_replace('/', '', $val);
	$val = str_replace(';', '', $val);
	$val = RepPostStr($val);
	$val = addslashes($val);
	return $val;
}

function RepPostStr($val)
{
	$val = htmlspecialchars($val, ENT_QUOTES);
	return $val;
}


?>
