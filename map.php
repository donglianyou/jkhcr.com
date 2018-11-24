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
error_reporting(E_ALL^E_NOTICE);
__FILE__ == '' && die('Fatal error code: 0');
@header("Content-Type: text/html; charset=utf-8");

@set_magic_quotes_runtime(0);

if (defined('DEBUG_MODE') == false) define('DEBUG_MODE', 0);

if(PHP_VERSION < '4.1.0') {
	$_GET =	&$HTTP_GET_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	unset($HTTP_GET_VARS,$HTTP_SERVER_VARS);
}

if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])) {
	exit('Request tainting attempted.');
}

if(function_exists('date_default_timezone_set')) date_default_timezone_set('Hongkong');

define('CURSCRIPT', 'map');
define('SysGlbCfm',true);
define('CURRENTDIR',dirname(__FILE__));

require_once CURRENTDIR.'/data/config.php';
require_once CURRENTDIR.'/include/common.fun.php';

$p = mhtmlspecialchars($_GET['p']);
if(isset($p) && preg_match("/^[a-z0-9\-\.]+[,][a-z0-9\-\.]+$/", $p)) {
    list($p1, $p2) = explode(',', $p);
}

$areacode = isset($_GET['areacode']) ? intval($_GET['areacode']) : '';

$action = isset($_GET['action']) ? trim(mhtmlspecialchars($_GET['action'])) : '';
if(!in_array($action,array('show','markpoint'))) $action = 'show';

$cityname = isset($_GET['cityname']) ? trim(mhtmlspecialchars($_GET['cityname'])) : 'beijing';
$documentdomain = isset($_GET['documentdomain']) ? trim(mhtmlspecialchars($_GET['documentdomain'])) : 0;
$title = isset($_GET['title']) ? checkhtml($_GET['title']) : '您标注的位置';
$level = is_numeric($_GET['level']) ? intval($_GET['level']) : (is_numeric($SystemGlobalcfm_global['mapview_level']) ? $SystemGlobalcfm_global['mapview_level'] : 10);
$width = isset($_GET['width']) ? intval($_GET['width']) : 500;
$height = isset($_GET['height']) ? intval($_GET['height']) : 500;
$markpoint = isset($_GET['markpoint']) ? intval($_GET['markpoint']) : 0;

if((!$p1 || !$p2) && !empty($SystemGlobalcfm_global['cfg_mappoint'])) {
	$key = 1;
	list($p1,$p2) = explode(',',$SystemGlobalcfm_global['cfg_mappoint']);
}

$mapflag = $SystemGlobalcfm_global['mapflag'] ? $SystemGlobalcfm_global['mapflag'] : 'baidu';
$version = 1.1;
include CURRENTDIR.'/template/box/map.html';
$SystemGlobalcfm_global = $mapflag = $width = $height = $title = $level = $action = $p1 = $areacode = $p2 = NULL;
?>