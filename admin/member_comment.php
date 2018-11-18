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
define( "CURSCRIPT", "member_comment" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
$where = $userid ? "WHERE userid = '".$userid."'" : "";
$where .= $commentlevell ? " AND commentlevel = '".$commentlevel."'" : "";
$mlevel = array( );
$mlevel[0] = "<font color=red>待审</font>";
$mlevel[1] = "<font color=#006acd>正常</font>";
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_模板点评" );
	$here = "网友点评";
	$rows_num = qq3479015851_count( "member_comment", $where );
	$param = setparam( array( "part" ) );
	$comment = page1( "SELECT * FROM `".$db_qq3479015851."member_comment` {$where} ORDER BY id DESC" );
	include( qq3479015851_tpl( CURSCRIPT ) );
}
else if ( is_array( $ids ) )
{
	if ( $part == "delall" )
	{
		foreach ( $ids as $kids => $vids )
		{
			qq3479015851_delete( "member_comment", "WHERE id = ".$vids );
		}
		write_msg( "成功删除指定点评信息！", $url, "writerecord" );
	}
	else
	{
		if ( strstr( $part, "level" ) )
		{
			$part = fileext( $part );
			foreach ( $ids as $kids => $vids )
			{
				$db->query( "UPDATE `".$db_qq3479015851."member_comment` SET commentlevel = '{$part}' WHERE id = ".$vids );
			}
			write_msg( "成功修改指定点评的信息状态为".$mlevel[$part]."！", $url, "writerecord" );
		}
		else
		{
			write_msg( "Undefined Action!" );
		}
	}
}
else
{
	write_msg( "请选定您要操作处理的点评！" );
}
if ( is_object( $db ) )
{
	$db->Close();
}
$qq3479015851_global = $db = $db_qq3479015851 = $part = NULL;
?>
