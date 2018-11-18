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
!defined('QQ3479015851') && exit('FORBIDDEN');
require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_INC . '/db.class.php';
require_once QQ3479015851_INC . '/cache.fun.php';
require_once QQ3479015851_INC . '/class.fun.php';
$filepath = (isset($_GET['filepath']) ? trim($_GET['filepath']) : '');
$level = (isset($_GET['level']) ? trim($_GET['level']) : '');
$ok['id'] = intval($_GET['id']);
$ok['filepath'] = trim($_GET['filepath']);
$ok['infotitle'] = trim($_GET['title']);
$ok['seotitle'] = '发布成功 - 发布分类信息';
$ok['level'] = $level;
$ok['content'] = ($level == 0 ? '' : $ok['info_uri'] = Rewrite('info', array('id' => $ok['id'], 'html_path' => $ok['filepath'])));
$nav_bar = '信息发布状态提示';
globalassign();
include qq3479015851_tpl('info_post_write_ok');

?>
