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
define( "CURSCRIPT", "focus" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
$part = $part ? $part : "list";
$cityid = intval( $cityid );
if ( !in_array( $typename, array( "网站首页", "新闻首页" ) ) || !$typename )
{
				$typename = "网站首页";
}
if ( !in_array( $part, array( "list", "add", "edit" ) ) )
{
				$part = "list";
}
$tpl_index = $db->getOne( "SELECT value FROM `".$db_qq3479015851."config` WHERE type='tpl' AND description = 'tpl_set'" );
$tpl_index = $tpl_index ? $charset == "utf-8" ? utf8_unserialize( $tpl_index ) : unserialize( $tpl_index ) : $defaultset['classic'];
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				if ( $part == "list" )
				{
								chk_admin_purview( "purview_幻灯片列表" );
								$citylimit = $admin_cityid ? "AND cityid = '".$admin_cityid."'" : $cityid ? "AND cityid = '".$cityid."'" : " AND cityid = '0'";
								$where = "WHERE typename = '".$typename."' ".$citylimit." ORDER BY focusorder ASC";
								$sql = "SELECT * FROM `".$db_qq3479015851."focus` ".$where;
								$rows_num = qq3479015851_count( "focus", $where );
								$param = setparam( array( "part", "typename", "cityid" ) );
								$row = page1( $sql );
								$here = $typename."幻灯片修改";
				}
				else if ( $part == "add" )
				{
								chk_admin_purview( "purview_上传幻灯片" );
								$here = "添加幻灯片";
								$maxorder = $db->getOne( "SELECT MAX(focusorder) FROM ".$db_qq3479015851."focus" );
								$maxorder += 1;
				}
				else if ( $part == "edit" )
				{
								if ( empty( $id ) )
								{
												write_msg( "您未指定ID" );
								}
								$row = $db->getRow( "SELECT * FROM ".$db_qq3479015851."focus WHERE id ='".$id."'" );
								$here = "修改".$row[typename]."幻灯片";
				}
				include( qq3479015851_tpl( CURSCRIPT."_".$part ) );
}
else
{
				require_once( QQ3479015851_INC."/upfile.fun.php" );
				$limit = $typename == "新闻首页" ? "news" : "index";
				if ( $part == "add" )
				{
								$name_file = "qq3479015851_focus";
								if ( $_FILES[$name_file]['name'] )
								{
												check_upimage( $name_file );
												$destination = "/focus/";
												$qq3479015851_image = start_upload( $name_file, $destination, 0, $qq3479015851_qq3479015851['cfg_focus_limit'][$tpl_index['banmian']]['index']['width'], $qq3479015851_qq3479015851['cfg_focus_limit'][$tpl_index['banmian']]['index']['height'] );
												unset( $limit );
												$db->query( "INSERT INTO `".$db_qq3479015851."focus` (id,image,pre_image,words,url,pubdate,focusorder,typename,cityid)\r\n\t\t\t\t\tVALUES('','".$qq3479015851_image[0]."','".$qq3479015851_image[1]."','".$words."','".$url."','".$timestamp."','".$focusorder."','".$typename."','".$cityid."')" );
												clear_cache_files( "city_".$cityid );
								}
				}
				else if ( $part == "edit" )
				{
								$name_file = "qq3479015851_focus";
								if ( $_FILES[$name_file]['name'] )
								{
												check_upimage( $name_file );
												$destination = "/focus/";
												$qq3479015851_image = start_upload( $name_file, $destination, 0, $qq3479015851_qq3479015851['cfg_focus_limit'][$tpl_index['banmian']]['index']['width'], $qq3479015851_qq3479015851['cfg_focus_limit'][$tpl_index['banmian']]['index']['height'], $image, $pre_image );
												unset( $limit );
												$image = $qq3479015851_image[0];
												$pre_image = $qq3479015851_image[1];
								}
								$res = $db->query( "UPDATE `".$db_qq3479015851."focus` SET image='".$image."',pre_image='".$pre_image."',words='".$words."',url='".$url."',focusorder='".$focusorder."',cityid='".$cityid."' WHERE id = '".$id."'" );
								clear_cache_files( "city_".$cityid );
				}
				else if ( $part == "list" )
				{
								if ( is_array( $delids ) )
								{
												foreach ( $delids as $kids => $vids )
												{
																$delrow = $db->getRow( "SELECT image,pre_image FROM `".$db_qq3479015851."focus` WHERE id = '".$vids."'" );
																@unlink( QQ3479015851_ROOT.$delrow['image'] );
																@unlink( QQ3479015851_ROOT.$delrow['pre_image'] );
																qq3479015851_delete( CURSCRIPT, "WHERE id = ".$vids );
												}
								}
								if ( is_array( $displayorder ) )
								{
												foreach ( $displayorder as $key => $val )
												{
																$db->query( "UPDATE `".$db_qq3479015851."focus` SET focusorder = '".$val."' WHERE id = ".$key );
												}
								}
								clear_cache_files( "city_".$cityid );
				}
				write_msg( "成功上传或更新 ".$typename." 幻灯片!", "?part=list&typename=".$typename, "qq3479015851" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$db = $qq3479015851_global = $part = $action = $here = NULL;
?>
