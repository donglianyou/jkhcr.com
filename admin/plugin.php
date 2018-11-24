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
define( "CURSCRIPT", "plugin" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) )
{
				exit( "Access Denied" );
}
chk_admin_purview( "purview_已安装插件" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				if ( $op == "disable" && !empty( $id ) )
				{
								$db->query( "UPDATE `".$db_qq3479015851."plugin` SET disable = '1' WHERE id = '".$id."'" );
								write_plugin_cache( );
								echo "<script language=\"javascript\">window.parent.framLeft.location.reload(); </script><style>body,*,html{font-size:12px;}</style>";
								write_msg( "成功禁用该插件！", "plugin.php", "write_record" );
				}
				else if ( $op == "able" && !empty( $id ) )
				{
								$db->query( "UPDATE `".$db_qq3479015851."plugin` SET disable = '0' WHERE id = '".$id."'" );
								write_plugin_cache( );
								echo "<script language=\"javascript\">window.parent.framLeft.location.reload(); </script><style>body,*,html{font-size:12px;}</style>";
								write_msg( "成功启用该插件！", "plugin.php", "write_record" );
				}
				else if ( $op == "edit" && !empty( $id ) )
				{
								$here = "插件详情";
								$edit = $db->getRow( "SELECT * FROM `".$db_qq3479015851."plugin` WHERE id = '".$id."'" );
								if ( !$edit['flag'] )
								{
												write_msg( "您所指定的插件不存在！" );
								}
								$edit['config'] = $charset == "utf-8" ? utf8_unserialize( $edit['config'] ) : unserialize( $edit['config'] );
								include( qq3479015851_tpl( "plugin_edit" ) );
				}
				else
				{
								$here = "插件管理";
								$plugin = $db->getAll( "SELECT * FROM `".$db_qq3479015851."plugin`" );
								include( qq3479015851_tpl( CURSCRIPT ) );
				}
}
else
{
				if ( $op == "edit" && !empty( $id ) )
				{
								$config = serialize( $config );
								$db->query( "UPDATE `".$db_qq3479015851."plugin` SET name='".$name."',config = '".$config."' WHERE id = '".$id."'" );
								$return = "plugin.php?op=edit&id=".$id;
				}
				write_plugin_cache( );
				echo "<script language=\"javascript\">window.parent.framLeft.location.reload(); </script><style>body,*,html{font-size:12px;}</style>";
				write_msg( "插件配置更新成功！<br />若未出现插件的管理菜单，请F5刷新浏览器", $return ? $return : "plugin.php", "write_admin_record" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$SystemGlobalcfm_global = $db = $op = $db_qq3479015851 = $part = NULL;
?>
