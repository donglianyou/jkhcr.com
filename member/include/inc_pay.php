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

$ac = (in_array($ac, array('pay', 'record', 'use')) ? trim($ac) : 'pay');
$qq3479015851_global['cfg_coin_fee'] = ($qq3479015851_global['cfg_coin_fee'] ? $qq3479015851_global['cfg_coin_fee'] : 1);
require_once QQ3479015851_DATA . '/moneytype.inc.php';

if (submit_check('pay_submit')) {
	$money = (isset($_POST['money']) ? intval($_POST['money']) : '');
	if (($ac == 'record') && empty($recordids)) {
		write_msg('', '?m=pay&ac=record&error=1&page=' . $page);
	}

	if (($ac == 'use') && empty($useids)) {
		write_msg('', '?m=pay&ac=use&error=1&page=' . $page);
	}

	if (is_array($recordids)) {
		$db->query('DELETE FROM `' . $db_qq3479015851 . 'payrecord` ' . $where . ' AND id ' . create_in($recordids));
		write_msg('', '?m=pay&ac=record&success=10');
	}

	if (is_array($useids)) {
		$db->query('DELETE FROM `' . $db_qq3479015851 . 'member_record_use` ' . $where . ' AND id ' . create_in($useids));
		write_msg('', '?m=pay&ac=use&success=11');
	}

	if (!empty($money) && ($ac == 'pay')) {
		$money = (double) $money;
		$money = ceil($money / $qq3479015851_global['cfg_coin_fee']);

		if ($money <= 0) {
			write_msg('', '?m=pay&error=17');
		}

		$payid = (int) $_POST['payid'];

		if (!$payid) {
			write_msg('', '?m=pay&error=18');
		}

		
		if($payid == 5)
		{
			write_msg('','../include/payment/wxpay/native_dynamic_qrcode.php?wxtotal_fee='.$money);
			die();
		}
		
		
		$payr = $db->getRow('SELECT * FROM ' . $db_qq3479015851 . 'payapi WHERE payid=\'' . $payid . '\' AND isclose=0');

		if (!$payr['payid']) {
			write_msg('', '?m=pay&error=18');
		}

		$ddno = $timestamp;
		$pay_type = 'PayToMoney';
		$productname = '金币充值';
		include QQ3479015851_INC . '/pay.fun.php';
		msetcookie('pay_type', $pay_type, 0);
		$PayReturnUrlQz = $qq3479015851_global['SiteUrl'];

		if ($charset == 'utf-8') {
			@header('Content-Type: text/html; charset=utf-8');
		}

		include QQ3479015851_INC . '/payment/' . $payr['paytype'] . '/to_pay.php';
	}
}
else {
	$begindate = (isset($_GET['begindate']) ? $_GET['begindate'] : '');
	$enddate = (isset($_GET['enddate']) ? $_GET['enddate'] : '');
	$begindate2 = (isset($_GET['begindate']) ? strtotime($_GET['begindate']) : '');
	$enddate2 = (isset($_GET['enddate']) ? strtotime($_GET['enddate']) : '');

	if ($ac == 'record') {
		$where .= (!empty($begindate2) ? ' AND posttime >= \'' . $begindate2 . '\'' : '');
		$where .= (!empty($enddate2) ? ' AND posttime <= \'' . $enddate2 . '\'' : '');
		$rows_num = qq3479015851_count('payrecord', $where);
		$param = setParam(array('m', 'ac', 'begindate', 'enddate'));
		$record = page1('SELECT * FROM `' . $db_qq3479015851 . 'payrecord` ' . $where . ' ORDER BY posttime DESC');
	}
	else if ($ac == 'use') {
		$where .= (!empty($begindate2) ? ' AND pubtime >= \'' . $begindate2 . '\'' : '');
		$where .= (!empty($enddate2) ? ' AND pubtime <= \'' . $enddate2 . '\'' : '');
		$rows_num = qq3479015851_count('member_record_use', $where);
		$param = setParam(array('m', 'ac', 'begindate', 'enddate'));
		$record = page1('SELECT * FROM `' . $db_qq3479015851 . 'member_record_use` ' . $where . ' ORDER BY pubtime DESC');
	}
	else if ($ac == 'pay') {
		$opened_pay_api = get_opened_payapi();
	}

	$location = location();
	include qq3479015851_tpl('pay_' . $ac);
	unset($record);
	unset($rows_num);
	unset($param);
	unset($begindate);
	unset($enddate);
	unset($opened_pay_api);
}
function get_opened_payapi()
{
	global $db;
	global $db_qq3479015851;
	$paysql = $db->query('select payid,paytype,payname FROM  `' . $db_qq3479015851 . 'payapi` WHERE isclose=0 order by payid DESC');
	$pays = array();

	while ($payr = $db->fetchRow($paysql)) {
		$pays[$payr['payid']]['payid'] = $payr['payid'];
		$pays[$payr['payid']]['paytype'] = $payr['paytype'];
		$pays[$payr['payid']]['payname'] = $payr['payname'];
	}

	unset($pays[4]);
	//unset($pays[5]);
	unset($payr);
	unset($paysql);
	return $pays;
}


?>
