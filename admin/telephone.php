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
define( "CURSCRIPT", "telephone" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "QQ3479015851" ) )
{
				exit( "Access Denied" );
}
$part = isset( $part ) ? $part : "list";
$id = isset( $id ) ? intval( $id ) : 0;
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				chk_admin_purview( "purview_便民电话" );
				$here = "便民电话设置";
				require_once( dirname( __FILE__ )."/include/ifview.inc.php" );
				require_once( dirname( __FILE__ )."/include/color.inc.php" );
				if ( $part == "edit" && empty( $id ) )
				{
								write_msg( "您未指定要修改的ID编号！" );
				}
				$rows_num = qq3479015851_count( "telephone" );
				$param = setparam( array( "part" ) );
				$telephone = page1( "SELECT * FROM `".$db_qq3479015851."telephone` ORDER BY displayorder DESC" );
				include( qq3479015851_tpl( CURSCRIPT ) );
}
else
{
				if ( is_array( $add ) && $add['telname'] && $add['telnumber'] )
				{
								$db->query( "INSERT `".$db_qq3479015851."telephone` (telname,telnumber,color,if_bold,displayorder,if_view) VALUES ('".$add['telname']."','".$add['telnumber']."','".$add['color']."','".$add['if_bold']."','".$add['displayorder']."','".$add['if_view']."')" );
				}
				if ( is_array( $edit ) )
				{
								foreach ( $edit as $kedit => $vedit )
								{
												$db->query( "UPDATE `".$db_qq3479015851."telephone` SET telname='".$vedit['telname']."',telnumber='".$vedit['telnumber']."',color='".$vedit['color']."',if_bold='".$vedit['if_bold']."',displayorder='".$vedit['displayorder']."',if_view='".$vedit['if_view']."' WHERE id = '".$kedit."'" );
								}
				}
				if ( is_array( $delids ) )
				{
								$db->query( "DELETE FROM `".$db_qq3479015851."telephone` WHERE ".create_in( $delids, "id" ) );
				}
				clear_cache_files( "telephone" );
				write_msg( "便民电话设置更新成功！", $forward_url ? $forward_url : "telephone.php", "write_record" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$qq3479015851_global = $db = $db_qq3479015851 = $part = NULL;
?>
