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

function get_admin_group( $typeid = "" )
{
				global $db;
				global $db_qq3479015851;
				$admin = $db->getAll( "SELECT * FROM `".$db_qq3479015851."admin_type` ORDER BY id desc" );
				foreach ( $admin as $row )
				{
								$qq3479015851 .= "<option value=\"".$row[id]."\"";
								$qq3479015851 .= $typeid == $row[id] ? "selected style=\"background-color:#6EB00C;color:white\"" : "";
								$qq3479015851 .= ">".$row[typename]."</option>";
				}
				return $qq3479015851;
}

define( "CURSCRIPT", "admin" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "QQ3479015851" ) )
{
				exit( "Access Denied" );
}
switch ( $do )
{
case "user" :
				$part = $part ? $part : "list";
				if ( $part == "list" )
				{
								chk_admin_purview( "purview_用户列表" );
								$where .= $typeid ? "AND a.typeid = 'typeid'" : "";
								$where .= $admin_cityid ? " AND a.cityid = '".$admin_cityid."'" : $cityid ? " AND a.cityid = '".$cityid."'" : "";
								$sql = "SELECT a.id,a.userid,a.cityid,a.uname,a.tname,a.logintime,a.loginip,a.typeid,b.typename FROM `".$db_qq3479015851."admin` AS a LEFT JOIN `".$db_qq3479015851."admin_type` AS b ON a.typeid = b.id WHERE 1 ".$where." ORDER BY a.typeid Asc";
								$admin = $db->getAll( $sql );
								$allcities = get_allcities( );
								$here = "管理员帐号管理";
								include( qq3479015851_tpl( "admin_user" ) );
				}
				else if ( $part == "add" )
				{
								chk_admin_purview( "purview_用户列表" );
								$here = "新增网站管理员帐号";
								include( qq3479015851_tpl( "admin_user_add" ) );
				}
				else if ( $part == "insert" )
				{
								$pwd = md5( trim( $pwd ) );
								if ( !is_email( $email ) )
								{
												write_msg( "电子邮件格式不正确。" );
								}
								if ( 0 < qq3479015851_count( "admin", "WHERE userid LIKE '".$userid."'" ) )
								{
												write_msg( "已经存在此帐号，请选择其它用户名！" );
								}
								$db->query( "INSERT INTO `".$db_qq3479015851."admin`(userid,cityid,uname,tname,pwd,typeid,email)\r\n\t\t\t\tVALUES('".$userid."','".$cityid."','".$uname."','".$tname."','".$pwd."','".$typeid."','".$email."'); " );
								write_admin_cache( );
								write_msg( "添加管理员 ".$userid." 成功", "?do=user", "record" );
				}
				else if ( $part == "edit" )
				{
								$id = $id ? $id : $db->getOne( "SELECT id FROM `".$db_qq3479015851."admin` WHERE userid = '".$userid."'" );
								$sql = "SELECT * FROM ".$db_qq3479015851."admin WHERE id = '".$id."'";
								$admin = $db->getRow( $sql );
								if ( !$admin )
								{
												write_msg( "该管理员帐号不存在！" );
								}
								if ( $admin_cityid && $admin['cityid'] != $admin_cityid )
								{
												write_msg( "该管理员并非隶属您的分站管理之下" );
								}
								$here = "修改管理员帐号";
								include( qq3479015851_tpl( "admin_user_edit" ) );
				}
				else
				{
								if ( $part == "update" )
								{
												if ( !is_email( $email ) )
												{
																write_msg( "电子邮件格式不正确。" );
																exit( );
												}
												$pwd = !empty( $pwd ) ? "pwd='".md5( $pwd )."'," : "";
												$db->query( "UPDATE ".$db_qq3479015851."admin SET ".$pwd." userid='".$userid."',cityid='".$cityid."',uname='".$uname."',typeid='".$typeid."',tname='".$tname."',email='".$email."' WHERE id = '".$id."'" );
												write_admin_cache( );
												write_msg( "网站管理员 ".$uname." 更改成功", "admin.php?do=user&part=edit&id=".$id, "record" );
								}
								else
								{
												if ( !( $part == "delete" ) )
												{
																break;
												}
												if ( empty( $id ) )
												{
																write_msg( "没有选择记录" );
												}
												else if ( qq3479015851_delete( "admin", "WHERE id = '".$id."'" ) )
												{
																write_admin_cache( );
																write_msg( "删除管理员 ".$id." 成功", "?do=user", "record" );
												}
												else
												{
																write_msg( "管理员删除失败！" );
												}
								}
				}
				break;
case "group" :
				if ( $admin_cityid )
				{
								write_msg( "您没有权限访问该页！" );
				}
				require_once( dirname( __FILE__ )."/include/qq3479015851.menu.inc.php" );
				$part = $part ? $part : "list";
				if ( $part == "list" )
				{
								chk_admin_purview( "purview_用户组" );
								$sql = "SELECT * FROM ".$db_qq3479015851."admin_type ORDER BY id desc";
								$group = $db->getAll( $sql );
								$here = "系统用户组管理";
								include( qq3479015851_tpl( "admin_group" ) );
				}
				else if ( $part == "add" )
				{
								chk_admin_purview( "purview_用户组" );
								$here = "新增用户组";
								include( qq3479015851_tpl( "admin_group_add" ) );
				}
				else if ( $part == "insert" )
				{
								$purview = is_array( $_POST['purview'] ) ? implode( ",", $_POST['purview'] ) : "";
								$typename = trim( $_POST['typename'] );
								$ifsystem = trim( $_POST['ifsystem'] );
								if ( !empty( $typename ) )
								{
												$sql = "select count(*) from ".$db_qq3479015851."admin_type where typename = '".$typename."'";
												if ( $db->getOne( $sql ) )
												{
																write_msg( "已经存在此用户组，请重新输入！" );
												}
								}
								$res = $db->query( "Insert Into `".$db_qq3479015851."admin_type`(id,typename,ifsystem,purviews)\r\n\t\t\t\tValues('','".$typename."','".$ifsystem."','".$purview."')" );
								write_admin_cache( );
								write_msg( "添加用户组 ".$typename." 成功", "?do=group", "record" );
				}
				else if ( $part == "edit" )
				{
								$sql = "SELECT * FROM ".$db_qq3479015851."admin_type WHERE id = '".$id."'";
								$group = $db->getRow( $sql );
								$purview = explode( ",", $group['purviews'] );
								$here = "修改用户组权限";
								include( qq3479015851_tpl( "admin_group_edit" ) );
				}
				else
				{
								if ( $part == "update" )
								{
												$purview = is_array( $purview ) ? implode( ",", $purview ) : "";
												$sql = "UPDATE `".$db_qq3479015851."admin_type` SET typename='".$typename."',ifsystem='".$ifsystem."',purviews='".$purview."' WHERE id = '".$id."'";
												if ( !( $res = $db->query( $sql ) ) )
												{
																break;
												}
												write_admin_cache( );
												write_msg( "用户组 ".$typename." 修改成功", "?do=group&part=edit&id=".$id, "record" );
								}
								else
								{
												if ( !( $part == "delete" ) )
												{
																break;
												}
												if ( empty( $id ) )
												{
																write_msg( "没有选择记录" );
												}
												else if ( 0 < qq3479015851_count( "admin", "WHERE typeid = '".$id."'" ) )
												{
																write_msg( "该用户组下尚有成员，不能删除！" );
												}
												else if ( qq3479015851_delete( "admin_type", "WHERE id = '".$id."'" ) )
												{
																write_admin_cache( );
																write_msg( "删除用户组 ".$id." 成功", "?do=group", "record" );
												}
												else
												{
																write_msg( "管理员用户组删除失败！" );
												}
								}
				}
}
if (is_object( $db ) )
{
				$db->Close( );
}
$db = $qq3479015851_global = $part = $action = $here = NULL;
?>
