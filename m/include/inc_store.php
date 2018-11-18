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
if ( CURSCRIPT != "wap" )
{
				exit( "FORBIDDEN" );
}
$action = isset( $action ) ? trim( $action ) : "";
$id = isset( $id ) ? intval( $id ) : "";
$navi = array( "index" => "首页", "aboutus" => "简介", "info" => "信息", "album" => "相册", "docu" => "动态", "goods" => "商品", "contact" => "位置" );
if ( !in_array( $action, array_keys( $navi ) ) )
{
				$action = "index";
}
$store = $db->getRow( "SELECT * FROM `".$db_qq3479015851."member` WHERE if_corp = 1 AND status = 1 AND id = '".$id."'" );
$store[tel] = $store[tel] ? $store[tel] : $store[mobile];
if ( !$store )
{
				errormsg( "该机构不存在或者未通过审核！" );
}
if ( $action == "index" )
{
				$info_list = qq3479015851_get_infos( "5", "", "", $store['userid'] );
				$docu_list = get_member_docu( "5", $store['userid'] );
				$album = $db->getAll( "SELECT a.* FROM `".$db_qq3479015851."member_album` AS a  WHERE a.userid='".$store['userid']."' ORDER BY a.id DESC LIMIT 0,2" );
				include( qq3479015851_tpl( "store" ) );
				exit( );
}
if ( $action == "info" )
{
				$where = " WHERE userid = '".$store['userid']."' AND (info_level = 1 OR info_level = 2)";
				$perpage = $mobile_settings['mobiletopicperpage'] ? $mobile_settings['mobiletopicperpage'] : 10;
				$param = setparams( array( "mod", "action", "id" ) );
				$rows_num = $db->getOne( "SELECT COUNT(id) FROM `".$db_qq3479015851."information` ".$where );
				$totalpage = ceil( $rows_num / $perpage );
				$num = intval( $page - 1 ) * $perpage;
				$info_list = page1( "SELECT * FROM `".$db_qq3479015851."information` ".$where." ORDER BY id DESC", $perpage );
				$pageview = pager( );
}
else if ( $action == "docu" )
{
				if ( $docuid )
				{
								if ( !( $docu = $db->getRow( "SELECT * FROM `".$db_qq3479015851."member_docu` WHERE id = '".$docuid."' AND userid = '".$store['userid']."'" ) ) )
								{
												redirectmsg( "该机构动态不存在！", "javascript:history.back();" );
								}
								$db->query( "UPDATE `".$db_qq3479015851."member_docu` SET hit = hit + 1 WHERE id = '".$docuid."' AND userid = '".$store['userid']."'" );
				}
				else
				{
								$where = " WHERE userid = '".$store['userid']."'";
								$perpage = $mobile_settings['mobiletopicperpage'] ? $mobile_settings['mobiletopicperpage'] : 10;
								$param = setparams( array( "mod", "action", "id" ) );
								$rows_num = $db->getOne( "SELECT COUNT(id) FROM `".$db_qq3479015851."member_docu` ".$where );
								$totalpage = ceil( $rows_num / $perpage );
								$num = intval( $page - 1 ) * $perpage;
								$list = page1( "SELECT * FROM `".$db_qq3479015851."member_docu` ".$where." ORDER BY id DESC", $perpage );
								$pageview = pager( );
				}
}
else if ( $action == "goods" )
{
				$where = " WHERE userid = '".$store['userid']."'";
				$perpage = $mobile_settings['mobiletopicperpage'] ? $mobile_settings['mobiletopicperpage'] : 10;
				$param = setparams( array( "mod", "id", "action", "goodsid" ) );
				$rows_num = $db->getOne( "SELECT COUNT(goodsid) FROM `".$db_qq3479015851."goods` ".$where );
				$totalpage = ceil( $rows_num / $perpage );
				$num = intval( $page - 1 ) * $perpage;
				$list = page1( "SELECT * FROM `".$db_qq3479015851."goods` ".$where." ORDER BY goodsid DESC", $perpage );
				$pageview = pager( );
}
else if ( $action == "album" )
{
				$where = " WHERE userid = '".$store['userid']."'";
				$perpage = $mobile_settings['mobiletopicperpage'] ? $mobile_settings['mobiletopicperpage'] : 10;
				$param = setparams( array( "mod", "action", "id" ) );
				$rows_num = $db->getOne( "SELECT COUNT(id) FROM `".$db_qq3479015851."member_album` ".$where );
				$totalpage = ceil( $rows_num / $perpage );
				$num = intval( $page - 1 ) * $perpage;
				$album = page1( "SELECT * FROM `".$db_qq3479015851."member_album` ".$where." ORDER BY id DESC", $perpage );
				$pageview = pager( );
}
include( qq3479015851_tpl( "store_".$action ) );
?>
