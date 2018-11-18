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
error_reporting(E_ALL^E_NOTICE);
@set_magic_quotes_runtime(0);
@header("Content-Type: text/html; charset=utf-8");

__FILE__ == '' && die('Fatal error code: 0');

define("QQ3479015851",true);
define('MAGIC_QUOTES_GPC', @get_magic_quotes_gpc());
define("QQ3479015851_ROOT",dirname(__FILE__));
define('QQ3479015851_DATA',QQ3479015851_ROOT.'/data');
define('QQ3479015851_INC',QQ3479015851_ROOT.'/include');
define('QQ3479015851_TPL',QQ3479015851_ROOT.'/template');
define('QQ3479015851_ASS',QQ3479015851_ROOT.'/include/assign');

if(function_exists('date_default_timezone_set')) date_default_timezone_set('Hongkong');
$timestamp = time();

if (!MAGIC_QUOTES_GPC && $_FILES) $_FILES = addslashes($_FILES);

if(PHP_VERSION < '4.1.0') {
	$_GET		=	&$HTTP_GET_VARS;
	$_SERVER	=	&$HTTP_SERVER_VARS;
	unset($HTTP_GET_VARS,$HTTP_SERVER_VARS);
}

require_once QQ3479015851_DATA."/config.php";
require_once QQ3479015851_ROOT."/version.php";
require_once QQ3479015851_ROOT."/include/common.fun.php";

$_GET = mhtmlspecialchars($_GET);
$part = isset($_REQUEST['part']) ? trim(mhtmlspecialchars($_REQUEST['part'])) : '';
$action = isset($_REQUEST['action']) ? trim(mhtmlspecialchars($_REQUEST['action'])) : '';
$ac  = isset($_REQUEST['ac']) ? trim(mhtmlspecialchars($_REQUEST['ac'])) : '';
$url = isset($_REQUEST['url']) ? trim(mhtmlspecialchars($_REQUEST['url'])) : '';
$userid = isset($_REQUEST['userid']) ? trim(mhtmlspecialchars($_REQUEST['userid'])) : '';
if(preg_match("/from|script/i",$userid)) $userid = '';
$password = isset($_GET['password']) ? trim($_GET['password']) : '';
$admindir = isset($_GET['admindir']) ? trim($_GET['admindir']) : '/admin';
$report_type = isset($_POST['report_type']) ? trim(mhtmlspecialchars($_POST['report_type'])) : '';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : '';
$infoid = isset($_REQUEST['infoid']) ? intval($_REQUEST['infoid']) : '';
$uid = isset($_GET['uid']) ? intval($_GET['uid']) : '';

!in_array($part,array('upgrade','shoucang','wap_shoucang','report','do_report','information','checkmemberinfo','sp_testdirs','adminmenu','member','memberinfopost','advertisement','advertisementview','jswizard','custom','iptoarea','goodsorder','score_coin','credits_up','howtogetscore','seecontact','seecontact_tel','delinfo','qiandao')) && exit('FORBIDDEN');

include QQ3479015851_INC.'/box/'.$part.'.php';

is_object($db) && $db->Close();
?>