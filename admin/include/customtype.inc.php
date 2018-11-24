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
$customtypearr = array();
$customtypearr['info'] = '分类信息';

if (ifplugin('news')) {
	$customtypearr['news'] = '网站新闻';
}

if ($SystemGlobalcfm_global['cfg_if_corp'] == 1) {
	$customtypearr['store'] = '商家店铺';
}

if (ifplugin('goods')) {
	$customtypearr['goods'] = '商品';
}

?>
