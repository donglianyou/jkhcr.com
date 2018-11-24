<?php
define('SysGlbCfm', true);
require_once dirname(__FILE__).'/../../../include/global.php';
require_once qq3479015851_DATA.'/config.php';
require_once qq3479015851_DATA.'/config.db.php';
require_once qq3479015851_INC.'/db.class.php';

$out_trade_no = isset($_REQUEST['out_trade_no']) ? trim($_REQUEST['out_trade_no']) : '';

$chk_id = $db -> getRow("SELECT id FROM `{$db_qq3479015851}payrecord` where paybz='充值成功' and orderid='$out_trade_no' order by id desc limit 1 ");

if(empty($chk_id))
{
	echo 'false';
}
else
{
	echo 'true';
}
?>
