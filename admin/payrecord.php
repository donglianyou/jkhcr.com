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
define( "CURSCRIPT", "payrecord" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
require_once( QQ3479015851_DATA."/moneytype.inc.php" );
$part = $part ? $part : "list";
if ( !defined( "IN_ADMIN" ) || !defined( "QQ3479015851" ) )
{
				exit( "Access Denied" );
}
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				chk_admin_purview( "purview_会员支付记录" );
				$here = "管理支付记录";
				$where = " WHERE 1";
				$rstarttime = $starttime ? strtotime( $starttime ) : 0;
				$rendtime = $endtime ? strtotime( $endtime ) : 0;
				$status = $status ? intval( $status ) : 1;
				$where .= $rstarttime ? " AND posttime >= '".$rstarttime."'" : "";
				$where .= $rendtime ? " AND posttime <= '".$rendtime."'" : "";
				if ( $keywords != "" )
				{
								switch ( $action )
								{
								case 1 :
												$where .= " AND orderid LIKE '%".$keywords."%'";
												break;
								case 2 :
												$where .= " AND userid LIKE '%".$keywords."%'";
												break;
								case 3 :
												$where .= " AND payip LIKE '%".$keywords."%'";
												break;
								case 4 :
												$where .= " AND paybz LIKE '%".$keywords."%'";
								}
				}
				if ( $status == 2 )
				{
								$where .= " AND ifadd = 1 AND (paybz = '支付完成' OR paybz = '支付成功')";
				}
				else if ( $status == 3 )
				{
								$where .= " AND ifadd = 0 AND paybz = '等待支付'";
				}
				$sql = "SELECT * FROM `".$db_qq3479015851."payrecord` ".$where." ORDER BY posttime DESC";
				$rows_num = qq3479015851_count( "payrecord", $where );
				$param = setparam( array( "starttime", "endtime", "keywords", "action", "status" ) );
				$list = page1( $sql );
				$starttime = $starttime ? date( "Y-m-d", $starttime ) : "";
				$endtime = $endtime ? date( "Y-m-d", $endtime ) : "";
				include( qq3479015851_tpl( CURSCRIPT ) );
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
				write_msg( "会员充值记录更新成功！", $url, "QQ3479015851Record" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$qq3479015851_global = $db = $db_qq3479015851 = $part = NULL;
?>
