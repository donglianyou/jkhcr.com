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
define('CURSCRIPT', 'qrcode');
define('SysGlbCfm', true);
require_once dirname(__FILE__) . '/include/global.php';
require_once SysGlbCfm_INC . '/qrcode/phpqrcode.php';
$value = (isset($value) ? $value : '');
$url = (isset($url) ? base64_decode($url) : '');
$size = (isset($size) ? $size : '5');
$errorCorrectionLevel = 'L';
ob_clean();
QRcode::png($url ? $url : $value, false, $errorCorrectionLevel, $size);
exit();
echo ' ';

?>
