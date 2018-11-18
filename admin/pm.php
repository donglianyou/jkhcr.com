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
function member_groups( )
{
				global $db;
				global $db_qq3479015851;
				$all = $db->getAll( "SELECT * FROM `".$db_qq3479015851."member_level`" );
				foreach ( $all as $k => $v )
				{
								$qq3479015851 .= "<option value=".$v[id].">".$v[levelname]."</option>";
				}
				return $qq3479015851;
}

define( "CURSCRIPT", "pm" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
require_once( QQ3479015851_MEMBER."/include/common.func.php" );
if ( !in_array( $part, array( "outbox", "send", "del" ) ) )
{
				$part = "send";
}
chk_admin_purview( "purview_站内短消息" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				$here = $part == "send" ? "群发短消息" : "已发送短消息";
				if ( $part == "outbox" )
				{
								$sql = "SELECT * FROM `".$db_qq3479015851."member_pm` WHERE if_sys = '1' AND if_del = '0' ORDER BY id DESC";
								$rows_num = qq3479015851_count( "member_pm", "WHERE if_sys = '1'" );
								$param = setparam( array( "part" ) );
								$pm = page1( $sql );
				}
				else if ( $part == "send" && $id )
				{
								$pm_row = $db->getRow( "SELECT title,content FROM `".$db_qq3479015851."member_pm` WHERE id = '".$id."'" );
								$title = de_textarea_post_change( $pm_row['title'] );
								$content = de_textarea_post_change( $pm_row['content'] );
				}
				else if ( $part == "del" )
				{
								qq3479015851_delete( "member_pm", "WHERE id = '".$id."'" );
								write_msg( "编号为".$id."的短消息已成功删除！", $url, "writerecord" );
				}
				include( qq3479015851_tpl( CURSCRIPT."_".$part ) );
}
else
{
				if ( is_array( $delids ) )
				{
								foreach ( $delids as $kids => $vids )
								{
												qq3479015851_delete( "member_pm", "WHERE id = ".$vids );
								}
								write_msg( "指定的短消息已成功删除！", $url );
				}
				set_time_limit( 0 );
				$content = textarea_post_change( $content );
				if ( empty( $touser ) )
				{
								if ( empty( $group ) )
								{
												exit( "请指定发送用户名！" );
								}
				}
				echo "<style>*{font-size:12px}</style>";
				if ( is_array( $group ) )
				{
								foreach ( $group as $kid => $vid )
								{
												if ( !( $rgrow = $db->getAll( "SELECT userid FROM `".$db_qq3479015851."member` WHERE levelid = '".$vid."'" ) ) )
												{
																echo "该会员组下尚没有会员！";
												}
												else
												{
																foreach ( $rgrow as $row )
																{
																				$result = sendpm( $admin_id, $row[userid], $title, $content, 1 );
																				if ( $result[succ] == "yes" )
																				{
																								echo "发送状态：<font color=green>发送成功！</font> 接收用户：".$result[member]."<br>";
																				}
																				else
																				{
																								echo "发送状态：<font color=red>发送失败！</font> 接收用户：".$result[member]."<br>";
																				}
																				ob_flush( );
																				flush( );
																}
												}
								}
				}
				else
				{
								$touser = str_replace( "，", ",", $touser );
								$touser = explode( ",", $touser );
								foreach ( $touser as $kuser => $vuser )
								{
												$result = sendpm( $admin_id, $vuser, $title, $content, 1 );
												echo "<style>*{font-size:12px}</style>";
												if ( $result[succ] == "yes" )
												{
																echo "发送状态：<font color=green>发送成功！</font> 接收用户：".$result[member]."<br>";
												}
												else
												{
																echo "发送状态：<font color=red>发送失败！</font> 接收用户：".$result[member]."<br>";
												}
												ob_flush( );
												flush( );
								}
				}
				write_msg( "短消息发送结束", "olmsg", "record" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$qq3479015851_global = $db = $db_qq3479015851 = $part = NULL;
?>
