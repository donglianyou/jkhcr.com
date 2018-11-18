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
define( "CURSCRIPT", "template" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
$part = $part ? $part : "list";
if ( $admin_cityid )
{
				write_msg( "您没有权限访问该页！" );
}
if ( !defined( "IN_ADMIN" ) || !defined( "QQ3479015851" ) )
{
				exit( "Access Denied" );
}
chk_admin_purview( "purview_模板管理" );
$defaultset['portal'] = array( "banmian" => "portal", "indextopinfo" => "12", "newinfo" => "0", "announce" => "8", "faq" => "0", "news" => "7", "foreachinfo" => "0", "telephone" => "16", "lifebox" => "16", "goods" => "8" );
$defaultset['classic'] = array( "banmian" => "classic", "indextopinfo" => "12", "newinfo" => "0", "announce" => "8", "faq" => "0", "news" => "7", "foreachinfo" => "6", "telephone" => "12", "lifebox" => "24", "goods" => "8" );
$defaultset['simple'] = array( "banmian" => "simple", "indextopinfo" => "20", "newinfo" => "0", "announce" => "0", "faq" => "0", "news" => "0", "foreachinfo" => "0", "telephone" => "16", "lifebox" => "13", "goods" => "8" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				require_once( QQ3479015851_DATA."/template.inc.php" );
				$here = "模板管理";
				$tpl_index = $db->getOne( "SELECT value FROM `".$db_qq3479015851."config` WHERE type='tpl' AND description = 'tpl_set'" );
				$tpl_index = $tpl_index ? $charset == "utf-8" ? utf8_unserialize( $tpl_index ) : unserialize( $tpl_index ) : $defaultset['classic'];
				$tpl_index[smp_cats][first] = is_array( $tpl_index[smp_cats][first] ) ? $tpl_index[smp_cats][first] : array( );
				$tpl_index[smp_cats][second] = is_array( $tpl_index[smp_cats][second] ) ? $tpl_index[smp_cats][second] : array( );
				$tpl_index[smp_cats][third] = is_array( $tpl_index[smp_cats][third] ) ? $tpl_index[smp_cats][third] : array( );
				$tpl_index[smp_cats][fourth] = is_array( $tpl_index[smp_cats][fourth] ) ? $tpl_index[smp_cats][fourth] : array( );
				$cat = $db->getAll( "SELECT * FROM `".$db_qq3479015851."category` WHERE parentid = '0' ORDER BY catorder ASC" );
				if ( empty( $qq3479015851_global['head_style'] ) )
				{
								$qq3479015851_global['head_style'] = "nomal";
				}
				include( qq3479015851_tpl( CURSCRIPT ) );
}
else
{
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'cfg_tpl_dir' AND type = 'config'" );
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'bodybg' AND type = 'config'" );
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'screen_index' AND type = 'config'" );
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'screen_cat' AND type = 'config'" );
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'screen_info' AND type = 'config'" );
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'screen_search' AND type = 'config'" );
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'head_style' AND type = 'config'" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('cfg_tpl_dir','".$cfg_tpl_dir."','config')" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('bodybg','".$bodybg."','config')" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('screen_index','".$screen_index."','config')" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('screen_cat','".$screen_cat."','config')" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('screen_info','".$screen_info."','config')" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('screen_search','".$screen_search."','config')" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('head_style','".$head_style."','config')" );
				update_config_cache( );
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'tpl_set' AND type = 'tpl'" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('tpl_set','".serialize( $tpl_index )."','tpl')" );
				clear_cache_files( "tpl_index" );
				clear_cache_files( "telephone" );
				clear_cache_files( "lifebox" );
				clear_cache_files( "friendlink" );
				clear_cache_files( "faq" );
				write_msg( "模板设置更新成功！", $return_url, "write_record" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$qq3479015851_global = $db = $db_qq3479015851 = $part = NULL;
?>
