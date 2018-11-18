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
function get_docuarr_options( $arrid = "" )
{
				global $docu_arr;
				foreach ( $docu_arr as $key => $value )
				{
								$qq3479015851 .= "<option value=".$key."";
								$qq3479015851 .= $arrid == $key ? " style = \"background-color:#6EB00C;color:white\" selected>" : ">";
								$qq3479015851 .= $value."</option>";
				}
				return $qq3479015851;
}

define( "CURSCRIPT", "document" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( QQ3479015851_INC."/db.class.php" );
require_once( dirname( __FILE__ )."/include/ifview.inc.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "QQ3479015851" ) )
{
				exit( "Access Denied" );
}
$docu_arr = array( 1 => "文章", 2 => "图文" );
$do = $do ? $do : "type";
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				if ( $do == "type" )
				{
								chk_admin_purview( "purview_会员文档" );
								$here = "会员文档模型管理";
								if ( $part == "edit" )
								{
												$typeid = intval( $typeid );
												$edit = $db->getRow( "SELECT * FROM `".$db_qq3479015851."member_docutype` WHERE typeid = ".$typeid );
												include( qq3479015851_tpl( CURSCRIPT."_".$do."_".$part ) );
												exit( );
								}
								$notice = "<li>如果你原有的模型已正式投入使用，请谨慎删除原模型</li>";
								$docu = $db->getAll( "SELECT * FROM `".$db_qq3479015851."member_docutype` ORDER BY displayorder ASC" );
				}
				else
				{
								chk_admin_purview( "purview_会员文档" );
								$here = "会员文档管理";
								$doc_level = array( "待审", "正常" );
								$rows_num = $db->getOne( "SELECT COUNT(*) FROM `".$db_qq3479015851."member_docu`" );
								$param = setparam( array( "do", "part" ) );
								$docu = page1( "SELECT * FROM `".$db_qq3479015851."member_docu` ORDER BY pubtime DESC" );
				}
				include( $do == "document" ? qq3479015851_tpl( CURSCRIPT ) : qq3479015851_tpl( CURSCRIPT."_type" ) );
}
else
{
				if ( $part == "edit" )
				{
								$forward_url = "?part=edit&typeid=".$typeid;
								if ( empty( $typename ) )
								{
												write_msg( "请填写完整模型相关信息！" );
								}
								$db->query( "UPDATE `".$db_qq3479015851."member_docutype` SET typename='".$typename."',arrid='".$arrid."',ifview='".$ifview."',displayorder='".$displayorder."' WHERE typeid = '".$typeid."'" );
								$i = 1;
				}
				else
				{
								if ( is_array( $delids ) )
								{
												$i = 1;
												foreach ( $delids as $kids => $vids )
												{
																if ( $do == "type" )
																{
																				qq3479015851_delete( "member_docutype", "WHERE typeid = ".$vids );
																}
																else
																{
																				qq3479015851_delete( "member_docu", "WHERE id = ".$vids );
																}
												}
								}
								if ( is_array( $displayorder ) )
								{
												$i = 1;
												foreach ( $displayorder as $keyorder => $vorder )
												{
																$db->query( "UPDATE `".$db_qq3479015851."member_docutype` SET displayorder = '".$vorder."' WHERE typeid = ".$keyorder );
												}
								}
								if ( is_array( $add ) && $add[typename] && $add[displayorder] )
								{
												$i = 1;
												$do_insert = $db->query( "INSERT INTO `".$db_qq3479015851."member_docutype` (typename,arrid,ifview,displayorder) VALUES ('".$add['typename']."','".$add['arrid']."','".$add['ifview']."','".$add['displayorder']."')" );
												if ( !$do_insert )
												{
																write_msg( "文档模型增加失败!" );
												}
								}
				}
				if ( $i != 1 || !$i )
				{
								write_msg( "您没有进行任何操作！" );
				}
				else
				{
								clear_cache_files( "document_type" );
								write_msg( $do == "type" ? "会员文档模型设置更新成功！" : "会员文档更新成功！", $forward_url, "QQ3479015851Record" );
				}
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$db = $qq3479015851_global = $part = $action = $here = NULL;
?>
