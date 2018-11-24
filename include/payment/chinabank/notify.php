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
define('SysGlbCfm', true);
define('IN_ADMIN', true);
define('CURSCRIPT', 'payend');
require_once dirname(__FILE__) . '/../../../include/global.php';
require_once SysGlbCfm_DATA . '/config.php';
require_once SysGlbCfm_DATA . '/config.db.php';
require_once SysGlbCfm_INC . '/db.class.php';
$paytype = 'chinabank';
$payr = $db->getRow('SELECT * FROM ' . $db_qq3479015851 . 'payapi WHERE paytype=\'' . $paytype . '\'');
$v_mid = $payr['payuser'];
$key = $payr['paykey'];
$v_oid = trim($_POST['v_oid']);
$v_pmode = trim($_POST['v_pmode']);
$v_pstatus = trim($_POST['v_pstatus']);
$v_pstring = trim($_POST['v_pstring']);
$v_amount = trim($_POST['v_amount']);
$v_moneytype = trim($_POST['v_moneytype']);
$remark1 = trim($_POST['remark1']);
$remark2 = trim($_POST['remark2']);
$v_md5str = trim($_POST['v_md5str']);
$md5string = strtoupper(md5($v_oid . $v_pstatus . $v_amount . $v_moneytype . $key));

if ($v_md5str == $md5string) {
	include SysGlbCfm_INC . '/pay.fun.php';

	if ($v_pstatus == '20') {
		$paybz = '支付成功';
	}
	else if ($v_pstatus == '30') {
		$paybz = '支付失败';
	}
	else {
		$paybz = '支付完成';
	}

	UpdatePayRecord($remark1, $paybz);
	echo 'ok';
}
else {
	echo 'error';
}

?>
