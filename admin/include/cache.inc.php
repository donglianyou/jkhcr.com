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
$admin_cache_array = array('index' => '首页', 'info' => '分类信息', 'about' => '其它');
$admin_cache = array(
	'index' => array(
		'site' => array('name' => '网站首页')
		),
	'info'  => array(
		'list' => array('name' => '信息列表页'),
		'info' => array('name' => '信息内容页')
		),
	'about' => array(
		'aboutus'    => array('name' => '站务-关于我们'),
		'announce'   => array('name' => '站务-网站公告'),
		'faq'        => array('name' => '站务-网站帮助'),
		'friendlink' => array('name' => '站务-友情链接'),
		'sitemap'    => array('name' => '站务-网站地图'),
		'changecity' => array('name' => '站务-切换分站')
		)
	);
$time_cache = array(0 => '关闭', 3600 => '1小时', 10800 => '3小时', 43200 => '半天', 86400 => '一天', 604800 => '一周');

?>
