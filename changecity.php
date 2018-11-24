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
define('IN_SMT',true);
define('CURSCRIPT','changecity');
define('SysGlbCfm', true);

require_once dirname(__FILE__).'/include/global.php';
require_once SysGlbCfm_DATA.'/config.php';
require_once SysGlbCfm_DATA.'/config.db.php';
require_once SysGlbCfm_INC.'/db.class.php';
ifsiteopen();

if($cityname){
	$cityname = strip_tags(trim($cityname));
	if($city = $db -> getRow("SELECT domain,directory FROM `{$db_qq3479015851}city` WHERE cityname = '$cityname'")){
		write_msg('',$city['domain'] ? $city['domain'] : $SystemGlobalcfm_global['SiteUrl'].'/'.$SystemGlobalcfm_global['cfg_citiesdir'].'/'.$city['directory']);
	} else {
		write_msg('目前尚未开通该分站，请选择其它分站浏览');
	}
	exit;
}

$cache = get_cache_config();
require_once SysGlbCfm_INC.'/cachepages.class.php';
$cachepages = new cachepages($cache['changecity']['time'],'changecity');
$cachetime = $cache['changecity']['time'];
$cachepages->cacheCheck();
unset($cache);

if(in_array($SystemGlobalcfm_global['cfg_redirectpage'],array('home','nchome'))) {
	$fromcity = array('domain'=>$SystemGlobalcfm_global['SiteUrl'],'cityname'=>'总');
}else{
	$ip = GetIP();
	$fromcity = get_ip2city($ip);
}

globalassign();
include qq3479015851_tpl(CURSCRIPT);

$cachetime && $cachepages->caching();
?>