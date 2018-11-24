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
define( "CURSCRIPT", "site_about" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
if ( $admin_cityid )
{
				write_msg( "您没有权限访问该页！" );
}
if ( !in_array( $part, array( "list", "edit" ) ) )
{
				$part = "list";
}
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				chk_admin_purview( "purview_栏目设置" );
				require_once( SysGlbCfm_DATA."/html_type.inc.php" );
				$about = $db->getRow( "SELECT * FROM ".$db_qq3479015851."about WHERE id = '".$id."'" );
				$acontent = $id ? get_editor( "content", "Default", $about['content'] ) : get_editor( "content", "Default", "" );
				$about[displayorder] = $id ? $about[displayorder] : $db->getOne( "SELECT max(displayorder) FROM `".$db_qq3479015851."about` " ) + 1;
				$about_type = $db->getAll( "SELECT * FROM ".$db_qq3479015851."about ORDER BY displayorder ASC" );
				$here = "关于我们设置";
				include( qq3479015851_tpl( "site_about" ) );
}
else
{
				if ( $part == "list" )
				{
								if ( is_array( $delids ) )
								{
												$delids = implode( ",", $delids );
												qq3479015851_delete( "about", "WHERE id IN(".$delids.")" );
								}
								if ( is_array( $displayorder ) )
								{
												foreach ( $displayorder as $key => $value )
												{
																$db->query( "UPDATE `".$db_qq3479015851."about` SET displayorder = '".$value."' WHERE id = ".$key );
												}
								}
				}
				else if ( $part == "edit" )
				{
								require_once( dirname( __FILE__ )."/include/pinyin.inc.php" );
								$pubdate = $time;
								$content = trim( $content );
								if ( !$id )
								{
												if ( empty( $typename ) )
												{
																write_msg( "栏目名称不能为空" );
												}
												if ( empty( $content ) )
												{
																write_msg( "栏目内容不能为空" );
												}
												$db->query( "INSERT INTO ".$db_qq3479015851."about (typename,dir_type,content,pubdate,displayorder) VALUES ('".$typename."','".$dir_type."','".$content."','".$pubdate."','".$displayorder."')" );
												$id = $db->insert_id( );
												$dir_typename = get_htmlpath_type( $dir_type, $typename, $id, $mydir );
												$db->query( "UPDATE `".$db_qq3479015851."about` SET dir_typename = '".$dir_typename."' WHERE id = '".$id."'" );
								}
								else
								{
												$dir_typename = get_htmlpath_type( $dir_type, $typename, $id, $mydir );
												$db->query( "UPDATE ".$db_qq3479015851."about SET typename = '".$typename."', content='".$content."',pubdate='".$pubdate."', dir_type = '".$dir_type."' , dir_typename = '".$dir_typename."',displayorder = '".$displayorder."' WHERE id = '".$id."'" );
												$forward_url = "?part=edit&id=".$id;
								}
				}
				write_msg( "关于我们栏目更新或删除成功", $forward_url ? $forward_url : "?part=list", "write_sys_record" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$SystemGlobalcfm_global = $db = $db_qq3479015851 = $part = NULL;
?>
