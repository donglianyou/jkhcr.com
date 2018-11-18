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
define('IN_SMT',true);
define('CURSCRIPT','changecity');
define('QQ3479015851', true);

require_once dirname(__FILE__).'/include/global.php';
require_once QQ3479015851_DATA.'/config.php';
require_once QQ3479015851_DATA.'/config.db.php';
require_once QQ3479015851_INC.'/db.class.php';
ifsiteopen();

if($cityname){
	$cityname = strip_tags(trim($cityname));
	if($city = $db -> getRow("SELECT domain,directory FROM `{$db_qq3479015851}city` WHERE cityname = '$cityname'")){
		write_msg('',$city['domain'] ? $city['domain'] : $qq3479015851_global['SiteUrl'].'/'.$qq3479015851_global['cfg_citiesdir'].'/'.$city['directory']);
	} else {
		write_msg('目前尚未开通该分站，请选择其它分站浏览');
	}
	exit;
}

$cache = get_cache_config();
require_once QQ3479015851_INC.'/cachepages.class.php';
$cachepages = new cachepages($cache['changecity']['time'],'changecity');
$cachetime = $cache['changecity']['time'];
$cachepages->cacheCheck();
unset($cache);

if(in_array($qq3479015851_global['cfg_redirectpage'],array('home','nchome'))) {
	$fromcity = array('domain'=>$qq3479015851_global['SiteUrl'],'cityname'=>'总');
}else{
	$ip = GetIP();
	$fromcity = get_ip2city($ip);
}

globalassign();
include qq3479015851_tpl(CURSCRIPT);

$cachetime && $cachepages->caching();
?>