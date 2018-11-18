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

@set_time_limit( 0 );
define( "CURSCRIPT", "city" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "QQ3479015851" ) )
{
				exit( "Access Denied" );
}
if ( $admin_cityid )
{
				write_msg( "您没有权限访问该页！" );
}
$qq3479015851directory = array( "admin", "api", "attachment", "backup", "data", "html", "images", "include", "install", "member", "mypub", "plugin", "public", "rewrite", "template", "uc_client" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				$here = "分站设置";
				chk_admin_purview( "purview_分站设置" );
				include( qq3479015851_tpl( "city" ) );
}
else
{
				if ( $cfg_redirectpage == "citysite" )
				{
								$cfg_redirectpage = $cfg_redirectpagee ? $cfg_redirectpagee : "";
				}
				foreach ( $qq3479015851directory as $k => $v )
				{
								if ( !( $cfg_citiesdir == "/".$v ) )
								{
												continue;
								}
								write_msg( "您提交的目录名与系统目录重复，请更换一个目录名" );
								exit( );
				}
				qq3479015851_delete( "config", "WHERE description = 'cfg_citiesdir'" );
				qq3479015851_delete( "config", "WHERE description = 'cfg_independency'" );
				qq3479015851_delete( "config", "WHERE description = 'cfg_redirectpage'" );
				qq3479015851_delete( "config", "WHERE description = 'cfg_cityshowtype'" );
				if ( is_array( $independency ) )
				{
								foreach ( $independency as $k => $v )
								{
												$cfg_independency .= $v.",";
								}
								$cfg_independency = substr( $cfg_independency, 0, -1 );
				}
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description, value) VALUES ('cfg_independency', '".$cfg_independency."')" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description, value) VALUES ('cfg_citiesdir', '".$cfg_citiesdir."')" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description, value) VALUES ('cfg_redirectpage', '".$cfg_redirectpage."')" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description, value) VALUES ('cfg_cityshowtype', '".$cfg_cityshowtype."')" );
				update_config_cache( );
				unset( $admin_global );
				clear_cache_files( "city_0" );
				clear_cache_files( "allcities" );
				clear_cache_files( "changecity_cities" );
				clear_cache_files( "changeprovince_cities" );
				write_msg( "成功更新城市分站相关设置", "city.php", "write_record" );
}
?>
