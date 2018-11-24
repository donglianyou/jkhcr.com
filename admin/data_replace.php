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
define( "CURSCRIPT", "data_replace" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "SysGlbCfm" ) )
{
				exit( "Access Denied" );
}
$part = isset( $part ) ? $part : "default";
if ( $part == "default" )
{
				$here = "数据库内容替换";
				chk_admin_purview( "purview_数据库维护" );
				include( qq3479015851_tpl( "data_replace" ) );
}
else if ( $part == "do_action" )
{
				if ( $exptable == "" || $rpfield == "" )
				{
								write_msg( "请指定数据表和字段！", "olmsg" );
								exit( );
				}
				if ( $rpstring == "" )
				{
								write_msg( "请指定被替换内容！", "olmsg" );
								exit( );
				}
				$rs = $db->query( "UPDATE ".$exptable." SET ".$rpfield."=REPLACE(".$rpfield.",'".$rpstring."','".$tostring."')" );
				$db->query( "OPTIMIZE TABLE `".$exptable."`" );
				if ( $rs )
				{
								write_msg( "成功完成数据替换！", "olmsg", "write_qq3479015851_record" );
								exit( );
				}
				write_msg( "数据替换失败！", "olmsg", "write_qq3479015851_record" );
				exit( );
}
?>
