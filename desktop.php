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
define('CURSCRIPT','desktop');
define('SysGlbCfm', true);
require_once dirname(__FILE__).'/include/global.php';
require_once dirname(__FILE__).'/data/config.php';

$Shortcut = "[InternetShortcut]
URL=$SystemGlobalcfm_global[SiteUrl]/
IDList= 
[{000214A0-0000-0000-C000-000000000046}] 
Prop3=19,2 
"; 
header("Content-type: application/octet-stream"); 
header("Content-Disposition: attachment; filename=$SystemGlobalcfm_global[SiteName].url;"); 
echo $Shortcut;
?>