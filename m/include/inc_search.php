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
$keywords = isset( $_GET['keywords'] ) ? addslashes( $_GET['keywords'] ) : "";
$keywords = checkhtml( $keywords );
if ( preg_match( "/from|script|iframe|alert/i", $keywords ) )
{
				$keywords = "";
}
if ( $keywords != "" && strlen( $keywords ) < 2 )
{
				redirectmsg( "您输入的关键字太短了！关键字不能少于2个字节！", "index.php?mod=search" );
}
$timestamp = time( );
define( CURSCRIPT, "search" );
$perpage = $mobile_settings['mobiletopicperpage'] ? $mobile_settings['mobiletopicperpage'] : 10;
$page = isset( $_GET['page'] ) ? intval( $_GET['page'] ) : "";
$page = empty( $page ) ? 1 : $page;
$where = " WHERE a.info_level > 0 ";
$where .= $cityid ? " AND cityid = '".$cityid."'" : "";
$cat_children = $catid ? get_children( $catid ) : "";
$where .= $catid ? " AND ".$cat_children : "";
$where .= $keywords ? " AND (title LIKE '%".$keywords."%' OR content LIKE '%".$keywords."%') " : "";
$param = setparams( array( "mod", "keywords" ) );
$rows_num = $db->getOne( "SELECT COUNT(a.id) FROM `".$db_qq3479015851."information` AS a ".$where );
$totalpage = ceil( $rows_num / $perpage );
$num = intval( $page - 1 ) * $perpage;
$info_list = $db->getAll( "SELECT a.* FROM `".$db_qq3479015851."information` AS a ".$where." ORDER BY a.id DESC LIMIT ".$num.",".$perpage );
$pageview = pager( );
include( qq3479015851_tpl( "search" ) );
?>
