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

define( "CURSCRIPT", "certification" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
$certify_arr = array( 1 => "营业执照", 2 => "个人身份证" );
$typeid = $typeid ? $typeid : "1";
$page = $page ? intval( $page ) : "1";
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				chk_admin_purview( "purview_实名认证" );
				$info_do_type = array( );
				$info_do_type['奖励相关'] = array( "证件属实" );
				$info_do_type['惩罚相关'] = array( "图片不够清晰", "虚假证件", "证件已过期" );
				if ( $part == "yes" && $userid )
				{
								$set = $typeid == 1 ? "com_certify = '1'," : "per_certify = '1',";
								$db->query( "UPDATE `".$db_qq3479015851."information` SET certify = '1' WHERE userid = '".$userid."'" );
								$score_change = get_credit_score( );
								$score_changer = $typeid == 1 ? $score_change['score']['rank']['com_certify'] : $score_change['score']['rank']['per_certify'];
								$credit_changer = $typeid == 1 ? $score_change['credit']['rank']['com_certify'] : $score_change['credit']['rank']['per_certify'];
								$credit = $db->getOne( "SELECT credit FROM `".$db_qq3479015851."member` WHERE userid = '".$userid."'" );
								$credit .= $credit_changer;
								if ( $score_change )
								{
												foreach ( $score_change['credit_set']['rank'] as $level => $credi )
												{
																if ( !( $credit <= $credi ) )
																{
																				continue;
																}
																$credits = $level;
																break;
												}
												$credits -= 1;
								}
								$db->query( "UPDATE `".$db_qq3479015851."member` SET ".$set." score = score".$score_changer." , credit = credit".$credit_changer.",credits = '".$credits."' WHERE userid = '".$userid."'" );
								$score_change = $credits = $score_changer = NULL;
								$here = "附加操作处理";
								$title = "尊敬的用户 ".$userid." ，您提交的实名认证审核已通过！";
								include( qq3479015851_tpl( "information_pm" ) );
				}
				else if ( $part == "no" && $userid )
				{
								if ( !$userid )
								{
												write_msg( "请指定会员用户名！" );
								}
								$set = $typeid == 1 ? "SET com_certify = '0'" : "SET per_certify = '0'";
								$db->query( "UPDATE `".$db_qq3479015851."member` ".$set." WHERE userid = '".$userid."'" );
								$db->query( "UPDATE `".$db_qq3479015851."information` SET certify = '0' WHERE userid = '".$userid."'" );
								$here = "附加操作处理";
								$nummoney = "-2";
								$title = "尊敬的用户 ".$userid." ，您提交的实名认证审核未能通过！";
								include( qq3479015851_tpl( "information_pm" ) );
				}
				else
				{
								$here = $certify_arr[$typeid]."验证";
								$sql = "SELECT a.*,b.per_certify,b.com_certify,b.tname,b.cname FROM `".$db_qq3479015851."certification` AS a LEFT JOIN `".$db_qq3479015851."member` AS b ON a.userid = b.userid WHERE a.typeid = '".$typeid."' ORDER BY a.id DESC";
								$rows_num = qq3479015851_count( "certification", "WHERE typeid = '".$typeid."'" );
								$param = setparam( array( "typeid" ) );
								$certification = page1( $sql );
								include( qq3479015851_tpl( CURSCRIPT ) );
				}
}
else
{
				if ( is_array( $delids ) )
				{
								foreach ( $delids as $kids => $vids )
								{
												$delrow = $db->getRow( "SELECT img_path FROM `".$db_qq3479015851."certification` WHERE id = '".$vids."'" );
												@unlink( QQ3479015851_ROOT.$delrow['img_path'] );
												unset( $delrow );
												qq3479015851_delete( CURSCRIPT, "WHERE id = ".$vids );
								}
								$message = "成功更新或删除会员认证提交记录！";
				}
				if ( $part == "sendpm" )
				{
								require_once( QQ3479015851_MEMBER."/include/common.func.php" );
								if ( !$userid )
								{
												write_msg( "您没有指定会员用户名！" );
								}
								if ( $if_money == 1 )
								{
												$db->query( "UPDATE `".$db_qq3479015851."member` SET money_own = money_own ".$money_num." WHERE userid = '".$userid."'" );
								}
								if ( $if_pm == 1 )
								{
												$msg .= $if_money == 1 ? "<br />金币变化：<b style=color:red>".$money_num."</b>" : "";
												$result = sendpm( $admin_id, $userid, $title, $msg, 1 );
								}
								$message = "用户 ".$userid." 实名认证审核更新成功！";
				}
				$forward_url = $forward_url ? $forward_url : "?typeid=".$typwid."&page=".$page;
				write_msg( $message, $forward_url );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$db = $qq3479015851_global = $part = $action = $here = NULL;
?>
