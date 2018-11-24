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
define( "CURSCRIPT", "member_tpl" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
require_once( dirname( __FILE__ )."/include/ifview.inc.php" );
if ( $admin_cityid )
{
	write_msg( "您没有权限访问该页！" );
}
if ( !defined( "IN_ADMIN" ) || !defined( "SysGlbCfm" ) )
{
	exit( "Access Denied" );
}
if ( !submit_check( CURSCRIPT."_submit" ) )
{
	chk_admin_purview( "purview_模板点评" );
	if ( $part == "edit" )
	{
		$here = "会员模板设置修改";
		if ( $edit = $db->getrow( "SELECT * FROM ".$db_qq3479015851."member_tpl WHERE id = ".$id ) )
		{
			include( qq3479015851_tpl( CURSCRIPT."_edit" ) );
		}
		else
		{
			write_msg( "您所指定的模板不存在或者已被删除！" );
		}
	}
	else
	{
		$here = "会员模板设置";
		$list = $db->getall( "SELECT * FROM ".$db_qq3479015851.CURSCRIPT." ORDER BY displayorder ASC" );
		include( qq3479015851_tpl( CURSCRIPT ) );
	}
}
else
{
	if ( $part == "edit" )
	{
		$forward_url = "?part=edit&id=".$id;
		if ( empty( $displayorder ) )
		{
            write_msg( "模板名称和模板路径不能为空！" );
		}
		$db->query( "UPDATE `".$db_qq3479015851."member_tpl` SET tpl_name='{$tpl_name}',tpl_path='{$tpl_path}',if_view='{$isview}',displayorder='{$displayorder}',edittime='".time( ).( "' WHERE id = '".$id."'" ) );
		$i = 1;
	}
	else
	{
		if ( is_array( $delids ) )
		{
			$i = 1;
			foreach ( $delids as $kids => $vids )
			{
				qq3479015851_delete( CURSCRIPT, "WHERE id = ".$vids );
			}
		}
		if ( is_array( $displayorder ) )
		{
			$i = 1;
			foreach ( $displayorder as $keyorder => $vorder )
			{
				$db->query( "UPDATE `".$db_qq3479015851."member_tpl` SET displayorder = '{$vorder}' WHERE id = ".$keyorder );
			}
		}
		if ( is_array( $add ) && $add[tpl_name] && $add[tpl_path] )
		{
			$i = 1;
			$do_insert = $db->query( "INSERT INTO `".$db_qq3479015851."member_tpl` (tpl_name,tpl_path,if_view,displayorder,edittime) VALUES ('{$add['tpl_name']}','{$add['tpl_path']}','{$add['if_view']}','{$add['displayorder']}','".time( )."')" );
			if ( !$do_insert )
			{
                write_msg( "会员模板增加失败!" );
			}
		}
	}
	if ( $i != 1 || !$i )
	{
		write_msg( "您没有进行任何操作！" );
	}
	else
	{
		write_msg( "会员模板设置更新成功！", $forward_url, "SysGlbCfmRecord" );
	}
}
if ( is_object( $db ) )
{
	$db->Close();
}
$SystemGlobalcfm_global = $db = $db_qq3479015851 = $part = NULL;
?>
