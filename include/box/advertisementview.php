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
define('SysGlbCfm', true);
require_once SysGlbCfm_DATA . '/config.db.php';
require_once SysGlbCfm_INC . '/db.class.php';
$row = $db->getRow('SELECT code FROM `' . $db_qq3479015851 . 'advertisement` WHERE advid = \'' . $id . '\'');
echo '<style>body{font-size:12px;line-height:24px; padding:5px 0;}</style>' . $row[code] . '</font>';

?>
