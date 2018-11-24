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
$value = (isset($_GET['value']) ? strip_tags(trim($_GET['value'])) : '');
require_once SysGlbCfm_DATA . '/config.db.php';
@header('Content-type: text/html; charset=' . $charset);
require_once SysGlbCfm_INC . '/db.class.php';

if (empty($value)) {
	echo '请输入验证码';
}
else {
	echo 'success';
}

?>
