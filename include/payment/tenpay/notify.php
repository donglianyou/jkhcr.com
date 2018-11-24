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
$paytype = 'tenpay';
$payr = $db->getRow('SELECT * FROM ' . $db_qq3479015851 . 'payapi WHERE paytype=\'' . $paytype . '\'');
$bargainor_id = $payr['payuser'];
$key = $payr['paykey'];
import_request_variables('gpc', 'frm_');
$strCmdno = $frm_cmdno;
$strPayResult = $frm_pay_result;
$strPayInfo = $frm_pay_info;
$strBillDate = $frm_date;
$strBargainorId = $frm_bargainor_id;
$strTransactionId = $frm_transaction_id;
$strSpBillno = $frm_sp_billno;
$strTotalFee = $frm_total_fee;
$strFeeType = $frm_fee_type;
$strAttach = $frm_attach;
$strMd5Sign = $frm_sign;
$strCreateIp = $frm_spbill_create_ip;

if ($bargainor_id != $strBargainorId) {
	echo 'fail';
}
else if ($strPayResult == '0') {
	include SysGlbCfm_INC . '/pay.fun.php';
	$paybz = '支付成功';
	UpdatePayRecord($strAttach, $paybz);
	echo 'success';
}
else {
	echo 'fail';
}

?>
