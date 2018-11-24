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

function GetUrlToDomain( $domain )
{
				$re_domain = "";
				$domain_postfix_cn_array = array( "com", "net", "org", "gov", "edu", "com.cn", "cn" );
				$array_domain = explode( ".", $domain );
				$array_num = count( $array_domain ) - 1;
				if ( $array_domain[$array_num] == "cn" )
				{
								if ( in_array( $array_domain[$array_num - 1], $domain_postfix_cn_array ) )
								{
												$re_domain = $array_domain[$array_num - 2].".".$array_domain[$array_num - 1].".".$array_domain[$array_num];
												return $re_domain;
								}
								$re_domain = $array_domain[$array_num - 1].".".$array_domain[$array_num];
								return $re_domain;
				}
				$re_domain = $array_domain[$array_num - 1].".".$array_domain[$array_num];
				return $re_domain;
}

function myget( $var_name )
{
				if ( isset( $_SERVER[$var_name] ) )
				{
								return $_SERVER[$var_name];
				}
				if ( isset( $_ENV[$var_name] ) )
				{
								return $_ENV[$var_name];
				}
				if ( getenv( $var_name ) )
				{
								return getenv( $var_name );
				}
				if ( function_exists( "apache_getenv" ) && apache_getenv( $var_name, TRUE ) )
				{
								return apache_getenv( $var_name, TRUE );
				}
				return "";
}

function getRd( $domain )
{
				$suffix = array( "ren", "wang", "ae", "af", "ag", "ai", "al", "am", "an", "ao", "aq", "ar", "as", "at", "au", "aw", "az", "ba", "bb", "bd", "be", "bf", "bg", "bh", "bi", "bj", "bm", "bn", "bo", "br", "bs", "bt", "bv", "bw", "by", "bz", "ca", "cc", "cf", "cg", "ch", "ci", "ck", "cl", "cm", "cn", "co", "cq", "cr", "cu", "cv", "cx", "cy", "cz", "de", "dj", "dk", "dm", "do", "dz", "ec", "ee", "eg", "eh", "es", "et", "ev", "fi", "fj", "fk", "fm", "fo", "fr", "ga", "gb", "gd", "ge", "gf", "gg", "gh", "gi", "gl", "gm", "gn", "gp", "gr", "gt", "gu", "gw", "gy", "hk", "hm", "hn", "hr", "ht", "hu", "id", "ie", "il", "in", "io", "iq", "ir", "is", "it", "jm", "jo", "jp", "ke", "kg", "kh", "ki", "km", "kn", "kp", "kr", "kw", "ky", "kz", "la", "lb", "lc", "li", "lk", "lr", "ls", "lt", "lu", "lv", "ly", "ma", "mc", "md", "mg", "mh", "ml", "mm", "mn", "mo", "mp", "mq", "mr", "ms", "mt", "mv", "mw", "mx", "my", "mz", "na", "nc", "ne", "nf", "ng", "ni", "nl", "no", "np", "nr", "nt", "nu", "nz", "om", "qa", "pa", "pe", "pf", "pg", "ph", "pk", "pl", "pm", "pn", "pr", "pt", "pw", "py", "re", "ro", "ru", "rw", "sa", "sb", "sc", "sd", "se", "sg", "sh", "si", "sj", "sk", "sl", "sm", "sn", "so", "sr", "st", "su", "sy", "sz", "tc", "td", "tf", "tg", "th", "tj", "tk", "tm", "tn", "to", "tp", "tr", "tt", "tv", "tw", "tz", "ua", "ug", "uk", "us", "uy", "va", "vc", "ve", "vg", "vn", "vu", "wf", "ws", "ye", "yu", "za", "zm", "zr", "zw", "com", "edu", "gov", "int", "mil", "net", "org" );
				$domainArr = explode( ".", $domain );
				$l = count( $domainArr );
				$key = 0;
				$i = 0;
				for ( ;	$i < $l;	++$i	)
				{
								if ( !in_array( $domainArr[$i], $suffix ) )
								{
												continue;
								}
								$key = $i;
								break;
				}
				$inSuffixs = "";
				$i = $key;
				for ( ;	$i < $l;	++$i	)
				{
								$inSuffixs .= ".".$domainArr[$i];
				}
				return $domainArr[$key - 1].$inSuffixs;
}

function errormsg( $error_msg )
{
				global $charset;
				global $SystemGlobalcfm_global;
				global $cityid;
				redirectmsg( $error_msg, "javascript:history.back();" );
}

function redirectmsg( $redirectmsg, $url )
{
				global $charset;
				global $SystemGlobalcfm_global;
				global $cityid;
				$url = $url ? $url : "javascript:history.back();";
				include( qq3479015851_tpl( "notice_redirect" ) );
				exit( );
}

function setparams( $param )
{
				foreach ( $param as $k => $v )
				{
								global $$v;
								$params .= $$v ? urlencode( $v )."=".$$v."&" : "";
				}
				return $params;
}

function pager( )
{
				global $page;
				global $totalpage;
				global $rows_num;
				global $param;
				if ( $totalpage == 1 && $page == 1 )
				{
								$nav = $rows_num."条记录";
								return $nav;
				}
				if ( $page - 1 < 1 )
				{
								$nav .= "<a href=\"javascript:void();\" class=\"pageprev pagedisable\">上一页</a>";
								$nav .= "<a class=\"pageno pagecur\">".$page."</a>";
								$nav .= ( ( "<a href=\"?".$param."page=".( $page + 1 ) )."\" class=\"pageno\">".( $page + 1 ) )."</a>";
								if ( $page + 1 < $totalpage )
								{
												$nav .= ( ( "<a href=\"?".$param."page=".( $page + 2 ) )."\" class=\"pageno\">".( $page + 2 ) )."</a>";
								}
				}
				else
				{
								$nav .= "<a href=\"?".$param."page=".( $page - 1 < 1 ? 1 : $page - 1 )."\" class=\"pageprev\">上一页</a>";
								if ( $totalpage == 3 && $page == 3 )
								{
												$nav .= ( ( "<a href=\"?".$param."page=".( $page - 2 ) )."\" class=\"pageno\">".( $page - 2 ) )."</a>";
								}
								$nav .= ( "<a href=\"?".$param."page=".( $page - 1 ) )."\" class=\"pageno\">".( $page - 1 < 1 ? 1 : $page - 1 )."</a>";
								$nav .= "<a class=\"pageno pagecur\">".$page."</a>";
								if ( $page < $totalpage )
								{
												$nav .= ( ( "<a href=\"?".$param."page=".( $page + 1 ) )."\" class=\"pageno\">".( $page + 1 ) )."</a>";
								}
				}
				if ( $page < $totalpage )
				{
								$nav .= ( "<a href=\"?".$param."page=".( $page + 1 ) )."\" class=\"pagenext\">下一页</a>";
								return $nav;
				}
				$nav .= "<a href=\"javascript:void();\" class=\"pagenext pagedisable\">下一页</a>";
				return $nav;
}

function get_mobile_nav( $typeid = 1 )
{
				static $res = NULL;
				$data = read_static_cache( "mobile_nav" );
				if ( $data === FALSE )
				{
								$query = $GLOBALS['db']->query( "SELECT * FROM `".$GLOBALS['db_qq3479015851']."mobile_nav` WHERE isview = 2 ORDER BY displayorder ASC" );
								while ( $row = $GLOBALS['db']->fetchRow( $query ) )
								{
												$res[$row['typeid']][$row['id']]['title'] = $row['title'];
												$res[$row['typeid']][$row['id']]['url'] = $row['url'];
												$res[$row['typeid']][$row['id']]['color'] = $row['color'];
												$res[$row['typeid']][$row['id']]['flag'] = $row['flag'];
												$res[$row['typeid']][$row['id']]['ico'] = $row['ico'];
												$res[$row['typeid']][$row['id']]['target'] = in_array( $row['target'], array( "_selef", "_blank" ) ) ? $row['target'] : "_self";
								}
								write_static_cache( "mobile_nav", $res );
				}
				else
				{
								$res = $data;
				}
				return $res[$typeid];
}

function get_mobile_gg( $typeid = 1 )
{
				static $res = NULL;
				$data = read_static_cache( "mobile_gg" );
				if ( $data === FALSE )
				{
								$query = $GLOBALS['db']->query( "SELECT * FROM `".$GLOBALS['db_qq3479015851']."mobile_gg` ORDER BY displayorder ASC" );
								while ( $row = $GLOBALS['db']->fetchRow( $query ) )
								{
												$res[$row['typeid']][$row['id']]['words'] = $row['words'];
												$res[$row['typeid']][$row['id']]['url'] = $row['url'];
												$res[$row['typeid']][$row['id']]['image'] = $row['image'];
								}
								write_static_cache( "mobile_gg", $res );
				}
				else
				{
								$res = $data;
				}
				return $res[$typeid];
}

define( "WAP", TRUE );
define( "CURSCRIPT", "wap" );
define( "SysGlbCfm", TRUE );
define( "IN_SMT", TRUE );
require_once( dirname( __FILE__ )."/../include/global.php" );
require_once( SysGlbCfm_DATA."/config.php" );
require_once( SysGlbCfm_DATA."/config.db.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
$mobile_settings = get_mobile_settings( );
if ( $mobile_settings['allowmobile'] != 1 )
{
				errormsg( "本站手机版暂停访问！" );
}
if ( pcclient( ) )
{
				write_msg( "", $SystemGlobalcfm_global['SiteUrl'] );
}
$lat = isset( $lat ) ? ( double )$lat : "";
$lng = isset( $lng ) ? ( double )$lng : "";
if ( $lat && $lng )
{
				$cityid = get_latlng2cityid( $lat, $lng );
}
$cityid = isset( $cityid ) ? intval( $cityid ) : mgetcookie( "cityid" );
if ( !in_array( $mod, array( "category", "index", "items", "information", "login", "register", "post", "search", "member", "history", "news", "goods", "corp", "store", "changecity" ) ) )
{
				$mod = "index";
}
if ( $cityid )
{
				if ( !( $city = $db->getRow( "SELECT * FROM `".$db_qq3479015851."city` WHERE cityid = '".$cityid."'" ) ) )
				{
								redirectmsg( "当前分站不存在，请前往选择您的分站！", "index.php?mod=changecity" );
				}
				msetcookie( "cityid", $cityid );
}
$s_uid = $iflogin = NULL;
include( SysGlbCfm_INC."/member.class.php" );
$returnurl = urlencode( geturl( ) );
if ( $member_log->chk_in( ) )
{
				$iflogin = 1;
}
else
{
				$iflogin = 0;
}
if ( !$id && !in_array( $mod, array( "information", "news", "goods" ) ) )
{
				$city = get_city_caches( $cityid );
				$city_limit = empty( $city['cityid'] ) ? "" : " AND cityid = '".$city['cityid']."'";
				$city_limit_a = empty( $city['cityid'] ) ? "" : " AND a.cityid = '".$city['cityid']."'";
}
include( SysGlbCfm_ROOT."/m/include/inc_".$mod.".php" );
if ( is_object( $db ) )
{
				$db->Close( );
}
$parent_cats = $loginfo = $newinfo = $mod = $ac = $SystemGlobalcfm_global = $catid = $areaid = $db = $db_qq3479015851 = $mobile_settings = $member_log = NULL;
?>
