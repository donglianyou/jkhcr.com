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
define( "CURSCRIPT", "credit" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
$defaultrank = array( "com_certify" => "+50", "per_certify" => "+50", "coin_credit" => "+10" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				chk_admin_purview( "purview_积分信用等级" );
				$here = "信用值增减设置";
				require_once( SysGlbCfm_DATA."/moneytype.inc.php" );
				$credit = $db->getOne( "SELECT value FROM `".$db_qq3479015851."config` WHERE type='credit_sco' AND description = 'credit'" );
				$credit = $credit ? $charset == "utf-8" ? utf8_unserialize( $credit ) : unserialize( $credit ) : array(
								"rank" => $defaultrank
				);
				include( qq3479015851_tpl( CURSCRIPT ) );
}
else
{
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'credit' AND type = 'credit_sco'" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('credit','".serialize( $credit_new )."','credit_sco')" );
				clear_cache_files( "credit_score" );
				write_msg( "信用增减设置更新成功！", "credit.php", "WriteRecord" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$SystemGlobalcfm_global = $db = $db_qq3479015851 = $part = NULL;
?>
