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
define('IN_SMT', true);
define('SysGlbCfm', true);
define('CURSCRIPT','delinfo');
require_once dirname(__FILE__)."/include/global.php";
require_once dirname(__FILE__)."/data/config.php";
require_once SysGlbCfm_DATA."/config.db.php";
require_once SysGlbCfm_INC."/db.class.php";
$loc 		= get_location('delinfo','','修改/删除信息');
$page_title = $loc['page_title'];
globalassign();
$city=get_city_caches($cityid);
include qq3479015851_tpl('delinfo');
is_object($db) && $db->Close();
?>