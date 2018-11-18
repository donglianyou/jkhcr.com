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
define( "CURSCRIPT", "file_manage" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_DATA."/config.inc.php" );
require_once( QQ3479015851_INC."/db.class.php" );
if ( $admin_cityid )
{
				write_msg( "您没有权限访问该页！" );
}
$part = $part ? $part : "template";
if ( $downfile )
{
				if ( !is_file( $downfile ) )
				{
								write_msg( "您要下载的文件不存在！" );
				}
				if ( fileext( $downfile ) == "php" )
				{
								write_msg( "该文件不允许下载!" );
				}
				$filename = basename( $downfile );
				$filename_info = explode( ".", $filename );
				$fileext = $filename_info[count( $filename_info ) - 1];
				header( "Content-type: application/x-".$fileext );
				header( "Content-Disposition: attachment; filename=".$filename );
				header( "Content-Description: PHP3 Generated Data" );
				readfile( $downfile );
				exit( );
}
if ( $delfile != "" )
{
				if ( $part == "template" )
				{
								write_msg( "模板文件不能删除，请手动在FTP目录中将其删除！" );
				}
				if ( fileext( $delfile ) == "html" )
				{
								write_msg( "该文件不允许删除，请在FTP目录中手动删除！" );
				}
				if ( file_exists( $delfile ) )
				{
								@unlink( $delfile );
								$msgs[] = "成功删除文件<br /><br />".$delfile;
								$msgs[] = "<a href=\"".$url."\">点此返回 &raquo;</a>";
								show_msg( $msgs );
								exit( );
				}
				write_msg( "文件已不存在！" );
				exit( );
}
$cfg_if_tpledit = $qq3479015851_qq3479015851['cfg_if_tpledit'] == 0 ? "<font color=green>已关闭</font>" : "<font color=red>已开启</font>";
switch ( $part )
{
case "template" :
				chk_admin_purview( "purview_模板管理" );
				$here = "模板在线管理";
				$mulu = "QQ3479015851模板目录";
				$showdir = QQ3479015851_TPL."/default";
				if ( !$editfile )
				{
								break;
				}
				if ( $do == "update" )
				{
								if ( $qq3479015851_qq3479015851['cfg_if_tpledit'] == "0" )
								{
												write_msg( "操作失败！系统管理员关闭了在线编辑风格的功能!<br /><br />您可以修改/dat/config.inc.php来开启它" );
								}
								$content = str_replace( "&amp;", "&", trim( $content ) );
								$content = str_replace( "&quot;", "\"", trim( $content ) );
								$nowfile = trim( $editfile );
								if ( !is_file( $nowfile ) )
								{
												write_msg( "对不起，该文件不存在！" );
								}
								$norootfile = str_replace( QQ3479015851_ROOT."/template", "", $nowfile );
								if ( $db->getOne( "SELECT content FROM `".$db_qq3479015851."template` WHERE filepath LIKE '".$norootfile."'" ) )
								{
												$update_sql = $db->query( "UPDATE `".$db_qq3479015851."template` SET content = '".$content."' WHERE filepath = '".$norootfile."'" );
								}
								else
								{
												$db->query( "INSERT INTO `".$db_qq3479015851."template` (filepath,content) VALUES ('".$norootfile."','".$content."')" );
								}
								$row = $db->getRow( "SELECT filepath,content FROM `".$db_qq3479015851."template` WHERE filepath = '".$norootfile."'" );
								if ( !$row )
								{
												write_msg( "操作失败！" );
												exit( );
								}
								$create_c = createfile( $nowfile, $row[content] );
								if ( $create_c )
								{
												write_msg( "模板文件".$nowfile."<br /><br />修改成功", $url, "QQ3479015851" );
								}
								else
								{
												write_msg( "模板文件".$nowfile."无法修改<br /><br />请检查template目录的操作权限!" );
								}
				}
				else
				{
								if ( !$editfile && !empty( $do ) )
								{
												break;
								}
								$ext = fileext( $editfile );
								if ( $ext != "html" && $ext != "css" && $ext != "htm" && $ext != "js" )
								{
												write_msg( "该文件不能在线编辑!" );
								}
								if ( !( $edit = file_get_contents( $editfile ) ) )
								{
												write_msg( "该文件不可读，请检查该文件的操作权限" );
								}
								$path = str_replace( "/".end( explode( "/", $editfile ) ), "", $editfile );
								$edit = htmlspecialchars( $edit );
								$acontent = "<textarea name=\"content\" cols=\"110\" rows=\"25\">".$edit."</textarea>";
								include( qq3479015851_tpl( "template_edit" ) );
				}
				exit( );
case "upload" :
				chk_admin_purview( "purview_附件管理" );
				$here = "系统上传附件管理";
				$mulu = "系统附件目录";
				$showdir = QQ3479015851_UPLOAD;
}
$path = trim( $path ) ? trim( $path ) : $showdir;
$LastPath = str_replace( "/".end( explode( "/", $path ) ), "", $path );
$con = explode( $showdir, $CurrentPath );
include( qq3479015851_tpl( CURSCRIPT ) );
if ( is_object( $db ) )
{
				$db->Close( );
}
$db = $qq3479015851_global = $part = $action = $here = NULL;
?>
