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
$ip = (isset($_GET['ip']) ? trim($_GET['ip']) : '');

if ($ip == 'wap') {
	$area = '手机端';
}
else {
	$area = $address = $ipdata = '';
	require_once SysGlbCfm_INC . '/ip.class.php';
	$ipdata = new ip();
	$address = $ipdata->getaddress($ip);
	$area = $address['area1'] . $address['area2'];
	$area = iconv('GB2312', 'UTF-8', $area);
}

include SysGlbCfm_ROOT . '/template/box/iptoarea.html';
unset($ipdata);
unset($address);

?>
