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
 * QQ群 ：625621054  [入群提供技术支持,升级新功能]
`*/
function get_navtype_options( $typeid = "" )
{
	global $nav_type;
	foreach ( $nav_type as $key => $value )
	{
		$SystemGlobalcfm .= "<option value=".$key."";
		$SystemGlobalcfm .= $typeid == $key ? " selected>" : ">";
		$SystemGlobalcfm .= $value."</option>";
	}
	return $SystemGlobalcfm;
}

function get_target_options( $ttarget = "" )
{
	global $target;
	foreach ( $target as $key => $value )
	{
		$SystemGlobalcfm .= "<option value=".$key;
		$SystemGlobalcfm .= $ttarget == $key ? " selected>" : ">";
		$SystemGlobalcfm .= $value."</option>";
	}
	return $SystemGlobalcfm;
}

function restore_footerurl( )
{
	global $db;
	global $db_qq3479015851;
	global $seo;
	global $timestamp;
	if ( !$seo )
	{
		$seo = get_seoset( );
	}
	$db->query( "DELETE FROM `".$db_qq3479015851."navurl` WHERE typeid = '2'" );
	$query = $db->query( "SELECT * FROM `".$db_qq3479015851."about` ORDER BY displayorder ASC" );
	while ( $row = $db->fetchrow( $query ) )
	{
		$about[$row['id']]['id'] = $row['id'];
		$about[$row['id']]['name'] = $row['typename'];
		$about[$row['id']]['uri'] = rewrite( "about", array( "part" => "aboutus", "id" => $row['id'] ) );
	}
	$url = array( );
	$url['faq']['name'] = "网站帮助";
	$url['faq']['uri'] = rewrite( "about", array( "part" => "faq" ) );
	$url['friendlink']['name'] = "友情链接";
	$url['friendlink']['uri'] = rewrite( "about", array( "part" => "friendlink" ) );
	$url['annnounce']['name'] = "网站公告";
	$url['annnounce']['uri'] = rewrite( "about", array( "part" => "announce" ) );
	$url['sitemap']['name'] = "网站地图";
	$url['sitemap']['uri'] = rewrite( "about", array( "part" => "sitemap" ) );
	$url = is_array( $about ) ? array_merge( $about, $url ) : $url;
	$i = 0;
	foreach ( $url as $k => $v )
	{
		$i += 1;
		$db->query( "INSERT INTO `".$db_qq3479015851."navurl` (url,target,title,flag,typeid,isview,displayorder,createtime)VALUES('{$v['uri']}','_blank','{$v['name']}','{$k}','2','2','{$i}','{$timestamp}')" );
	}
	clear_cache_files( "navurl_foot" );
}

function restore_headerurl( )
{
	global $db;
	global $db_qq3479015851;
	global $SystemGlobalcfm_global;
	global $seo;
	if ( !$seo )
	{
		$seo = get_seoset( );
	}
	$rewrite = $seo['seo_force_category'];
	$db->query( "DELETE FROM `".$db_qq3479015851."navurl` WHERE typeid = '3'" );
	$query = $db->query( "SELECT * FROM `".$db_qq3479015851."category` WHERE parentid = '0'" );
	while ( $row = $db->fetchrow( $query ) )
	{
		$category[$row['catid']]['catid'] = $row['catid'];
		$category[$row['catid']]['name'] = $row['catname'];
		$category[$row['catid']]['uri'] = rewrite( "category", array( "catid" => $row['catid'], "dir_typename" => $row['dir_typename'] ) );
		$category[$row['catid']]['flag'] = $row['catid'];
	}
	$category = $category ? $category : array( );
	$plugin = array( );
	@include( SysGlbCfm_DATA."/caches/pluginmenu_member.php" );
	if ( is_array( $data ) )
	{
		foreach ( $data as $k => $v )
		{
			if ( $k != "news" )
			{
				$plugin[$k]['catid'] = $k;
				$plugin[$k]['flag'] = $k;
				$plugin[$k]['uri'] = plugin_url( $k, array( "cate_id" => 0, "id" => 0 ) );
				$plugin[$k]['name'] = $v;
			}
			else
			{
				$plugin[$k]['catid'] = $k;
				$plugin[$k]['flag'] = $k;
				$plugin[$k]['uri'] = rewrite( "news", array( "part" => "index" ) );
				$plugin[$k]['name'] = $v;
			}
		}
	}
	$plugin['corp']['catid'] = "corp";
	$plugin['corp']['flag'] = "corp";
	$plugin['corp']['uri'] = rewrite( "corp", array( "part" => "index" ) );
	$plugin['corp']['name'] = "商家店铺";
	unset( $data );
	$url = is_array( $plugin ) && is_array( $category ) ? array_merge( $category, $plugin ) : $category;
	$i = 0;
	if ( is_array( $url ) )
	{
		foreach ( $url as $k => $v )
		{
			$i += 1;
			$db->query( "INSERT INTO `".$db_qq3479015851."navurl` (url,target,title,flag,typeid,isview,displayorder,createtime)VALUES('{$v['uri']}','_self','{$v['name']}','{$v['catid']}','3','2','{$i}','{$timestamp}')" );
		}
	}
	clear_cache_files( "navurl_header" );
}

define( "CURSCRIPT", "navurl" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
require_once( dirname( __FILE__ )."/include/color.inc.php" );
require_once( dirname( __FILE__ )."/include/ifview.inc.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "SysGlbCfm" ) )
{
	exit( "Access Denied" );
}
$typeid = $typeid ? intval( $typeid ) : 3;
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_链接导航" );
	$nav_type = array( );
	$nav_type[3] = "主导航";
	$nav_type[1] = "副导航";
	$nav_type[2] = "尾部导航";
	$target = array( "_blank" => "新窗口", "_self" => "当前窗口" );
	if ( $part == "restore" )
	{
		restore_headerurl( );
		write_msg( "成功恢复默认文字链接主导航!", "?typeid=3" );
	}
	else if ( $part == "restorefooter" )
	{
		restore_footerurl( );
		write_msg( "成功恢复默认尾部导航", "?typeid=2" );
	}
	else
	{
		$here = "链接导航设置";
		$where = " WHERE typeid = '".$typeid."'";
		$rows_num = qq3479015851_count( CURSCRIPT, $where );
		$param = setparam( array( "part", "typeid" ) );
		$url = array( );
		$url = page1( "SELECT * FROM ".$db_qq3479015851.CURSCRIPT.( " ".$where." ORDER BY displayorder ASC" ) );
		include( qq3479015851_tpl( CURSCRIPT ) );
	}
}
else
{
	if ( is_array( $navtitle ) )
	{
		foreach ( $navtitle as $key => $v )
		{
			$db->query( "UPDATE `".$db_qq3479015851."navurl` SET title = '{$v}',displayorder = '{$displayorder[$key]}',url='{$navurl[$key]}',isview='{$isviewids[$key]}',ico='{$icoids[$key]}',target='{$target[$key]}',color='{$showcolor[$key]}',flag='{$flag[$key]}' WHERE id = ".$key );
		}
	}
	if ( is_array( $newtitle ) && is_array( $newurl ) )
	{
		foreach ( $newtitle as $key => $q )
		{
			$title = trim( $q );
			$url = mhtmlspecialchars( trim( $newurl[$key] ) );
			$typeid = mhtmlspecialchars( trim( $newtypeid[$key] ) );
			$displayorder = mhtmlspecialchars( trim( $newdisplayorder[$key] ) );
			$isview = mhtmlspecialchars( trim( $newisview[$key] ) );
			$ico = mhtmlspecialchars( trim( $newico[$key] ) );
			$target = $newtarget[$key] ? mhtmlspecialchars( trim( $newtarget[$key] ) ) : "_blank";
			$showcolor = mhtmlspecialchars( trim( $newshowcolor[$key] ) );
			$flag = mhtmlspecialchars( trim( $newflag[$key] ) );
			$flag = $typeid == 3 ? "outlink" : "";
			if ( $title || $url )
			{
				$db->query( "INSERT INTO `".$db_qq3479015851."navurl` (url,title,ico,typeid,isview,target,flag,displayorder,createtime) VALUES ('{$url}','{$title}','{$ico}','{$typeid}','{$isview}','{$target}','{$flag}','{$displayorder}','{$timestamp}')" );
			}
			if ( $typeid == 1 )
			{
				clear_cache_files( "city_".$cityid );
			}
		}
	}
	if ( is_array( $delids ) )
	{
		foreach ( $delids as $kids => $vids )
		{
			qq3479015851_delete( CURSCRIPT, "WHERE id = ".$vids );
		}
		$allcities = get_allcities( );
		if ( is_array( $allcities ) )
		{
			foreach ( $allcities as $key => $val )
			{
				clear_cache_files( "city_".$key );
			}
		}
		$allcities = NULL;
	}
	clear_cache_files( "navurl_foot" );
	clear_cache_files( "navurl_header" );
	clear_cache_files( "navurl_head" );
	write_msg( "导航链接设置更新成功！", $forward_url, "SysGlbCfmRecord" );
}
if ( is_object( $db ) )
{
	$db->close( );
}
$SystemGlobalcfm_global = $db = $db_qq3479015851 = $part = NULL;
?>
