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
define( "CURSCRIPT", "payapi" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
$part = $part ? $part : "list";
if ( !defined( "IN_ADMIN" ) || !defined( "SysGlbCfm" ) )
{
				exit( "Access Denied" );
}
chk_admin_purview( "purview_管理支付接口" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				$here = "管理支付接口";
				$payapi = $db->getAll( "SELECT * FROM `".$db_qq3479015851."payapi` ORDER BY payid DESC" );
				if ( !empty( $payid ) )
				{
								$paydetail = $db->getRow( "SELECT * FROM `".$db_qq3479015851."payapi` WHERE payid = '".$payid."'" );
				}
				include( qq3479015851_tpl( CURSCRIPT ) );
}
else
{
				$db->query( "UPDATE `".$db_qq3479015851."payapi` SET paytype= '".$paytype."',buytype= '".$buytype."',payuser='".$payuser."',payfee='".$payfee."',isclose='".$isclose."',payname='".$payname."',paysay='".$paysay."',payemail='".$payemail."',paykey='".$paykey."',appid='".$appid."',appkey='".$appkey."' WHERE payid = '".$payid."'" );
				write_msg( "支付接口设置更新成功！", $return_url, "write_record" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$SystemGlobalcfm_global = $db = $db_qq3479015851 = $part = NULL;
?>
