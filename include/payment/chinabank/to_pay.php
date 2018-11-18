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
if (!(defined('QQ3479015851'))) {
	exit();
}

$v_mid = $payr['payuser'];
$key = $payr['paykey'];
$v_url = $PayReturnUrlQz . '/include/payment/chinabank/payend.php';
$remark2 = '[url:=' . $PayReturnUrlQz . '/include/payment/chinabank/notify.php]';
$v_moneytype = 'CNY';
$v_amount = $money;
$v_oid = date('Ymd') . '-' . $v_mid . '-' . date('His');
$ddno = ($ddno ? $ddno : $timestamp);
msetcookie('checkpaysession', $ddno, 0);
$text = $v_amount . $v_moneytype . $v_oid . $v_mid . $v_url . $key;
$v_md5info = strtoupper(md5($text));
$remark1 = $ddno;
ToPayMoney($v_amount, $ddno, $uid, $s_uid, 'chinabank');
echo '<html>' . "\r\n" . '<title>在线支付</title>' . "\r\n" . '<meta http-equiv="Cache-Control" content="no-cache"/>' . "\r\n" . '<body>' . "\r\n" . '<form method="post" name="dopaypost" id="dopaypost" action="https://pay3.chinabank.com.cn/PayGate">' . "\r\n\t" . '<input type="hidden" name="v_mid"    value="';
echo $v_mid;
echo '">' . "\r\n\t" . '<input type="hidden" name="v_oid"     value="';
echo $v_oid;
echo '">' . "\r\n\t" . '<input type="hidden" name="v_amount" value="';
echo $v_amount;
echo '">' . "\r\n\t" . '<input type="hidden" name="v_moneytype"  value="';
echo $v_moneytype;
echo '">' . "\r\n\t" . '<input type="hidden" name="v_url"  value="';
echo $v_url;
echo '">' . "\r\n\t" . '<input type="hidden" name="v_md5info"   value="';
echo $v_md5info;
echo '">' . "\r\n\t" . '<input type="hidden" name="remark1"   value="';
echo $remark1;
echo '">' . "\r\n\t" . '<input type="hidden" name="remark2"   value="';
echo $remark2;
echo '">' . "\r\n\t" . '<input type="submit" style="font-size: 9pt" value="在线支付" name="v_action">' . "\r\n" . '</form>' . "\r\n" . '<script>' . "\r\n" . 'document.getElementById(\'dopaypost\').submit();' . "\r\n" . '</script>' . "\r\n" . '</body>' . "\r\n" . '</html>';

?>
