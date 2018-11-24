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
define( "CURSCRIPT", "credit_set" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
$defaultrank = array( 1 => 10, 2 => 20, 3 => 40, 4 => 70, 5 => 120, 6 => 200, 7 => 400, 8 => 700, 9 => 1200, 10 => 1800, 11 => 2600, 12 => 4000, 13 => 10000, 14 => 30000, 15 => 60000 );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				chk_admin_purview( "purview_积分信用等级" );
				$here = "信用等级管理";
				if ( $ac == "update_credits" )
				{
								$score_change = get_credit_score( );
								@set_time_limit( 0 );
								$query = $db->query( "SELECT id,credit FROM `".$db_qq3479015851."member`" );
								while ( $row = $db->fetchRow( $query ) )
								{
												if ( $score_change )
												{
																foreach ( $score_change['credit_set']['rank'] as $level => $credi )
																{
																				if ( $row['credit'] <= $credi )
																				{
																								$credits = $level;
																				}
																				else
																				{
																								$credits = 16;
																				}
																}
																$credits -= 1;
												}
												$db->query( "UPDATE `".$db_qq3479015851."member` SET credits = '".$credits."' WHERE id = '".$row['id']."'" );
								}
								write_msg( "会员积分信用等级图标已更新成功！", "credit_set.php", "write_qq3479015851_records" );
								$score_change = $row = $credits = NULL;
								exit( );
				}
				$credit_set = $db->getOne( "SELECT value FROM `".$db_qq3479015851."config` WHERE type='credit_sco' AND description = 'credit_set'" );
				$credit_set = $credit_set ? $charset == "utf-8" ? utf8_unserialize( $credit_set ) : unserialize( $credit_set ) : array(
								"rank" => $defaultrank
				);
				include( qq3479015851_tpl( CURSCRIPT ) );
}
else
{
				if ( is_array( $credit_setnew['rank'] ) )
				{
								foreach ( $credit_setnew['rank'] as $rank => $mincredits )
								{
												$mincredits = intval( $mincredits );
												if ( $rank == 1 && $mincredits <= 0 )
												{
																write_msg( "信用度必须大于 0 才能进行评级！请返回修改。" );
												}
												else if ( 1 < $rank && $mincredits <= $credit_setnew['rank'][$rank - 1] )
												{
																write_msg( "信用等级 ".$rank." 的信用度必须大于上一等级的信用度！请返回修改。" );
												}
												$credit_setnew['rank'][$rank] = $mincredits;
								}
				}
				else
				{
								$credit_setnew['rank'] = $defaultrank;
				}
				$db->query( "DELETE FROM `".$db_qq3479015851."config` WHERE description = 'credit_set' AND type = 'credit_sco'" );
				$db->query( "INSERT INTO `".$db_qq3479015851."config` (description,value,type) values ('credit_set','".serialize( $credit_setnew )."','credit_sco')" );
				clear_cache_files( "credit_score" );
				write_msg( "信用等级管理更新成功！", "credit_set.php", "WriteRecord" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$SystemGlobalcfm_global = $db = $db_qq3479015851 = $part = NULL;
?>
