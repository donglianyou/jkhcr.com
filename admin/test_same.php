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
function DelInfo( $id = "" )
{
				global $db;
				global $db_qq3479015851;
				if ( !$id )
				{
								exit( );
				}
				$get_row = $db->getRow( "SELECT a.*,b.modid FROM `".$db_qq3479015851."information` AS a LEFT JOIN `".$db_qq3479015851."category` AS b ON a.catid = b.catid  WHERE a.id = '".$id."'" );
				@unlink( SysGlbCfm_ROOT.$get_row['html_path'] );
				if ( !empty( $get_row['img_path'] ) )
				{
								$del = $db->getAll( "SELECT path,prepath FROM `".$db_qq3479015851."info_img` WHERE infoid='".$id."'" );
								foreach ( $del as $k => $v )
								{
												@unlink( SysGlbCfm_ROOT.$v[path] );
												@unlink( SysGlbCfm_ROOT.$v[prepath] );
								}
								qq3479015851_delete( "info_img", "WHERE infoid = '".$id."'" );
				}
				qq3479015851_delete( "comment", "WHERE type = 'information' AND typeid = '".$id."'" );
				if ( 1 < $get_row[modid] )
				{
								qq3479015851_delete( "information_".$get_row[modid], "WHERE id = '".$id."'" );
				}
				qq3479015851_delete( "information", "WHERE id = '".$id."'" );
}

define( "CURSCRIPT", "test_same" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "SysGlbCfm" ) )
{
				exit( "Access Denied" );
}
$part = isset( $part ) ? $part : "default";
if ( $admin_cityid )
{
				write_msg( "您没有权限访问该页！" );
}
if ( $part == "default" )
{
				$here = "重复分类信息主题检测";
				chk_admin_purview( "purview_删除重复" );
				include( qq3479015851_tpl( "test_same" ) );
}
else if ( $part == "do_list" )
{
				$query = $db->query( "SELECT COUNT(title) AS dd,title FROM `".$db_qq3479015851."information` GROUP BY title ORDER BY dd DESC LIMIT 0,".$pagesize );
				$allarc = 0;
				include( qq3479015851_tpl( "test_same_list" ) );
				exit( );
}
else if ( $part == "do_action" )
{
				if ( empty( $infoTitles ) )
				{
								header( "Content-Type: text/html; charset=".$charset."" );
								echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8".$charset."\">\r\n";
								write_msg( "没有指定删除的文档！" );
								exit( );
				}
				$totalarc = 0;
				$orderby = $deltype == "delnew" ? " ORDER BY id DESC " : " ORDER BY id ASC ";
				foreach ( $infoTitles as $titles => $title )
				{
								$title = trim( $title );
								$title = addslashes( $title == "" ? "" : urldecode( $title ) );
								$sql = "SELECT id,title FROM `".$db_qq3479015851."information` WHERE title='".$title."' ".$orderby;
								$query = $db->query( $sql );
								$rownum = $db->num_rows( $query );
								if ( $rownum < 2 )
								{
												continue;
								}
								$i = 1;
								while ( $row = $db->fetchRow( $query ) )
								{
												++$i;
												$nid = $row['id'];
												$ntitle = $row['title'];
												if ( !( $rownum < $i ) )
												{
																++$totalarc;
																delinfo( $nid );
												}
								}
				}
				$db->query( " OPTIMIZE TABLE `".$db_qq3479015851."information`; " );
				write_msg( "一共删除了 [<font color=red>".$totalarc."</font>] 篇重复的信息主题！", "olmsg" );
				exit( );
}
?>
