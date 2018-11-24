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
require_once SysGlbCfm_DATA . '/config.db.php';
require_once SysGlbCfm_INC . '/db.class.php';
$row = $db->getRow('SELECT userpwd,if_corp,id FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $userid . '\'');
$password = $row['userpwd'];
$uid = $row['id'];
$if_corp = $row['if_corp'];
include SysGlbCfm_ROOT . '/template/box/member.html';

?>
