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
define('QQ3479015851', true);
define('IN_ADMIN', true);
define('CURSCRIPT', 'notify');
require_once dirname(__FILE__) . '/../../../include/global.php';
require_once QQ3479015851_DATA . '/config.php';
require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_INC . '/db.class.php';
include QQ3479015851_INC . '/pay.fun.php';
$payr = $db->getRow('SELECT * FROM ' . $db_qq3479015851 . 'payapi WHERE paytype=\'wxpay\'');
$payr['paykey'] = trim($payr['paykey']);
require_once 'function.php';
$data = file_get_contents('php://input');
$xml_parser = xml_parser_create();

if (!(xml_parse($xml_parser, $data, true))) {
	exit();
}

xml_parser_free($xml_parser);
$xml = simplexml_load_string($data);
$param = array();

foreach ($xml as $key => $val ) {
	if ($key != 'sign') {
		$param[$key] = $val;
	}
}

ksort($param);
$strArr = array();

foreach ($param as $key => $val ) {
	array_push($strArr, $key . '=' . $val);
}

$string = implode('&', $strArr);
$sign = $string . '&key=' . $payr['paykey'];
$sign = strtoupper(md5($sign));

if ($sign == $xml->sign) {
	$out_trade_no = $xml->out_trade_no;
	$transaction_id = $xml->transaction_id;
	$total_fee = intval($xml->total_fee) / 100;
	$paybz = '支付成功';
	$paybz = ($charset == 'gbk' ? iconv('utf-8', 'gbk', $paybz) : $paybz);
	UpdatePayRecord($out_trade_no, $paybz);
	WechatReturnSuccess();
}

?>
