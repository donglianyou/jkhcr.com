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
if (!defined('SysGlbCfm')) {
	exit('Access Denied');
}

$db->query('UPDATE `' . $db_qq3479015851 . 'advertisement` SET available = \'0\' WHERE endtime < \'' . $timestamp . '\' AND endtime <> \'0\'');

foreach (array('index', 'category', 'info', 'other') as $ranges ) {
	clear_cache_files('adv_' . $ranges);
}

updateadvertisement();

?>
