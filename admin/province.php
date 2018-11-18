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
define( "CURSCRIPT", "province" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
if ( $admin_cityid )
{
				write_msg( "您没有权限访问该页！" );
}
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				$here = "省份/直辖市管理";
				$province = $db->getAll( "SELECT * FROM `".$db_qq3479015851."province` ORDER BY displayorder ASC" );
				include( qq3479015851_tpl( "province" ) );
}
else
{
				if ( is_array( $provincename ) )
				{
								foreach ( $provincename as $key => $val )
								{
												$province_name = trim( $val );
												$display_order = intval( $displayorder[$key] );
												if ( $province_name )
												{
																$db->query( "UPDATE `".$db_qq3479015851."province` SET displayorder='".$display_order."',provincename='".$province_name."' WHERE provinceid='".$key."'" );
																unset( $province_name );
																unset( $display_order );
												}
								}
				}
				if ( is_array( $newdisplayorder ) && is_array( $newprovincename ) )
				{
								foreach ( $newprovincename as $key => $provincename )
								{
												$provincename = trim( $provincename );
												$displayorder = intval( $newdisplayorder[$key] );
												if ( $provincename )
												{
																$db->query( "INSERT INTO\t`".$db_qq3479015851."province` (displayorder,provincename) VALUES ( '".$displayorder."','".$provincename."')" );
																unset( $displayorder );
																unset( $provincename );
																unset( $cate_view );
												}
								}
				}
				if ( is_array( $delete ) )
				{
								$db->query( "DELETE FROM `".$db_qq3479015851."province` WHERE ".create_in( $delete, "provinceid" ) );
				}
				write_msg( "省份/直辖市设置更新成功", "?", "write_record" );
}
?>
