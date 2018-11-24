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
function info_typemodels( $zym_7 = "" )
{
				global $db;
				global $db_qq3479015851;
				$zym_5 = "SELECT id,name,displayorder FROM `".$db_qq3479015851."info_typemodels` ORDER BY displayorder ASC";
				$zym_4 = $db->getAll( $zym_5 );
				foreach ( $zym_4 as $zym_1 => $zym_2 )
				{
								$zym_3 .= "<option value=\"".$zym_2[id]."\"";
								$zym_3 .= $zym_7 == $zym_2[id] ? "selected style=\"background-color:#6EB00C;color:white\"" : "";
								$zym_3 .= ">".$zym_2[name]."</option>";
				}
				return $zym_3;
}

@set_time_limit( 0 );
define( "CURSCRIPT", "category" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
require_once( dirname( __FILE__ )."/include/color.inc.php" );
require_once( dirname( __FILE__ )."/include/ifview.inc.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "SysGlbCfm" ) )
{
				exit( "Access Denied" );
}
$part = $part ? $part : "list";
$cat_color = $color;
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				require_once( SysGlbCfm_DATA."/html_type.inc.php" );
				if ( $part == "list" )
				{
								chk_admin_purview( "purview_信息分类" );
								$f_cat = cat_list( "category", 0, 0, FALSE );
								$here = "信息分类列表";
								include( qq3479015851_tpl( "category_list" ) );
				}
				else if ( $part == "edit" )
				{
								include( SysGlbCfm_DATA."/category_tpl.inc.php" );
								include( SysGlbCfm_DATA."/information_tpl.inc.php" );
								$cat = $db->getRow( "SELECT * FROM ".$db_qq3479015851."category WHERE catid = '{$catid}'" );
								$here = "编辑信息分类";
								$cat['description'] = $cat['description'] ? de_textarea_post_change( $cat['description'] ) : "";
								include( qq3479015851_tpl( "category_edit" ) );
				}
				else if ( $part == "add" )
				{
								include( SysGlbCfm_DATA."/category_tpl.inc.php" );
								include( SysGlbCfm_DATA."/information_tpl.inc.php" );
								chk_admin_purview( "purview_添加分类" );
								$maxorder = $db->getOne( "SELECT MAX(catorder) FROM ".$db_qq3479015851."category" );
								$maxorder += 1;
								$here = "添加信息分类";
								include( qq3479015851_tpl( "category_add" ) );
				}
				else if ( $part == "del" )
				{
								if ( empty( $catid ) )
								{
												write_msg( "没有选择记录" );
								}
								qq3479015851_delete( "category", "WHERE ".get_children( $catid, "catid" ) );
								qq3479015851_delete( "information", "WHERE ".get_children( $catid, "catid" ) );
								clear_cache_files( "category_option_static" );
								clear_cache_files( "category_pid_releate" );
								clear_cache_files( "category_tree" );
								clear_cache_files( "category_dir" );
								write_msg( "删除信息分类 ".$catid." 成功", "category.php?part=list", "SysGlbCfm" );
				}
}
else
{
				if ( $part != "list" )
				{
								require_once( dirname( __FILE__ )."/include/pinyin.inc.php" );
				}
				if ( $part == "list" )
				{
								if ( is_array( $catorder ) )
								{
												foreach ( $catorder as $key => $value )
												{
																$db->query( "UPDATE `".$db_qq3479015851."category` SET catorder = '{$value}' WHERE catid = ".$key );
												}
								}
								if ( is_array( $if_viewids ) )
								{
												$db->query( "UPDATE `".$db_qq3479015851."category` SET if_view = '1' " );
												foreach ( $if_viewids as $key )
												{
																$db->query( "UPDATE `".$db_qq3479015851."category` SET if_view = '2' WHERE catid = ".$key );
												}
								}
								else
								{
												$db->query( "UPDATE `".$db_qq3479015851."category` SET if_view = '1' " );
								}
								foreach ( array( "option_static", "pid_releate", "tree", "dir" ) as $range )
								{
												clear_cache_files( "category_".$range );
								}
								write_msg( "信息分类更新成功！", "?part=list", "record" );
				}
				else if ( $part == "add" )
				{
								$catname = explode( "\r\n", trim( $catname ) );
								$template = empty( $template ) ? "list" : trim( $template );
								$template_info = empty( $template_info ) ? "info" : trim( $template_info );
								$usecoin = isset( $usecoin ) ? intval( $usecoin ) : 0;
								$parentid = isset( $parentid ) ? intval( $parentid ) : 0;
								$gid = admin_get_gid( "", $parentid );
								if ( empty( $catname ) || !is_array( $catname ) )
								{
												write_msg( "请填写分类名称" );
								}
								if ( empty( $catorder ) )
								{
												$sql = "SELECT MAX(catorder) FROM ".$db_qq3479015851."category";
												$maxorder = $db->getOne( $sql );
												$catorder = $maxorder;
								}
								if ( is_array( $catname ) )
								{
												foreach ( $catname as $key => $value )
												{
																$value = trim( $value );
																++$catorder;
																$len = strlen( $value );
																if ( 30 < $len )
																{
																				write_msg( "分类名必须在2个至30个字符之间" );
																}
																$db->query( "INSERT INTO ".$db_qq3479015851."category (catname,usecoin,if_view,gid,parentid,modid,catorder,if_upimg,if_mappoint,dir_type,template,template_info) VALUES ('{$value}','{$usecoin}','{$isview}','{$gid}','{$parentid}','{$modid}','{$catorder}','{$if_upimg}','{$if_mappoint}','{$dir_type}','{$template}','{$template_info}')" );
																$insert_id = $db->insert_id( );
																if ( $parentid == 0 )
																{
																				if ( $dir_type == 1 )
																				{
																								$html_dir = "/".$insert_id."/";
																				}
																				else if ( $dir_type == 2 )
																				{
																								$html_dir = "/".getpinyin( $value )."/";
																								$dir_typename = getpinyin( $value );
																				}
																				else if ( $dir_type == 3 )
																				{
																								$html_dir = "/".getpinyin( $value, 1 )."/";
																								$dir_typename = getpinyin( $value, 1 );
																				}
																}
																else
																{
																				$row = $db->getRow( "SELECT * FROM `".$db_qq3479015851."category` WHERE catid = '{$parentid}'" );
																				if ( $dir_type == 1 )
																				{
																								$html_dir = ( $row['html_dir'] ? $row['html_dir'] : "/" ).$insert_id."/";
																				}
																				else if ( $dir_type == 2 )
																				{
																								$html_dir = ( $row['html_dir'] ? $row['html_dir'] : "/" ).getpinyin( $value )."/";
																								$dir_typename = getpinyin( $value );
																				}
																				else if ( $dir_type == 3 )
																				{
																								$html_dir = ( $row['html_dir'] ? $row['html_dir'] : "/" ).getpinyin( $value, 1 )."/";
																								$dir_typename = getpinyin( $value, 1 );
																				}
																}
																$gidquery = $gid ? "" : " ,gid='".$insert_id."' ";
																$db->query( "UPDATE `".$db_qq3479015851."category` SET dir_typename='{$dir_typename}',html_dir = '{$html_dir}'{$gidquery} WHERE catid = '{$insert_id}'" );
												}
												foreach ( array( "option_static", "pid_releate", "tree", "dir" ) as $range )
												{
																clear_cache_files( "category_".$range );
												}
												write_msg( "成功增加信息分类", "?part=list" );
								}
								else
								{
												write_msg( "信息分类添加失败，请按格式填写" );
								}
				}
				else if ( $part == "edit" )
				{
								$template = empty( $template ) ? "list" : trim( $template );
								$usecoin = isset( $usecoin ) ? intval( $usecoin ) : 0;
								if ( empty( $catname ) )
								{
												write_msg( "请填写信息分类名称" );
								}
								if ( $catid == $parentid )
								{
												write_msg( "隶属信息分类不能为自己！" );
								}
								$len = strlen( $catname );
								if ( 30 < $len )
								{
												write_msg( "信息分类名必须在2个至30个字符之间" );
								}
								$gid = admin_get_gid( $catid, $parentid );
								$description = $description ? textarea_post_change( $description ) : "";
								if ( $dir_type == 4 )
								{
												if ( !$mydir )
												{
																write_msg( "请填写自定义目录名！" );
												}
												$html_dir = "/".$mydir."/";
								}
								else if ( $parentid == 0 )
								{
												if ( $dir_type == 1 )
												{
																$html_dir = "/".$catid."/";
												}
												else if ( $dir_type == 2 )
												{
																$html_dir = "/".getpinyin( $catname )."/";
												}
												else if ( $dir_type == 3 )
												{
																$html_dir = "/".getpinyin( $catname, 1 )."/";
												}
								}
								else if ( $dir_type == 1 )
								{
												$html_dir = $catid."/";
								}
								else if ( $dir_type == 2 )
								{
												$html_dir = getpinyin( $catname )."/";
								}
								else if ( $dir_type == 3 )
								{
												$html_dir = getpinyin( $catname, 1 )."/";
								}
								if ( 1 < $db->getOne( "SELECT COUNT(catid) FROM `".$db_qq3479015851."category` WHERE dir_typename = '{$mydir}' AND dir_typename != ''" ) )
								{
												write_msg( "您指定的目录名".$mydir."已存在，请换一个名称！" );
												exit( );
								}
								$sql = "UPDATE ".$db_qq3479015851."category SET gid='{$gid}',catname='{$catname}',icon='{$icon}',usecoin='{$usecoin}',if_view = '{$isview}',color='{$fontcolor}',title='{$title}',keywords='{$keywords}',description='{$description}',parentid='{$parentid}',modid='{$modid}',catorder='{$catorder}',dir_type = '{$dir_type}', dir_typename = '{$mydir}', html_dir = '{$html_dir}' ,if_upimg='{$if_upimg}',if_mappoint='{$if_mappoint}',template='{$template}',template_info='{$template_info}' WHERE catid = '{$catid}'";
								$res = $db->query( $sql );
								if ( $children_mod == "1" )
								{
												$db->query( "UPDATE `".$db_qq3479015851."category` SET modid = '{$modid}' WHERE ".get_children( $catid, "catid" ) );
								}
								if ( $children_tpl == "1" )
								{
												$db->query( "UPDATE `".$db_qq3479015851."category` SET template = '{$template}' WHERE ".get_children( $catid, "catid" ) );
								}
								if ( $children_tplinfo == "1" )
								{
												$db->query( "UPDATE `".$db_qq3479015851."category` SET template_info = '{$template_info}' WHERE ".get_children( $catid, "catid" ) );
								}
								if ( $children_upload == "1" )
								{
												$db->query( "UPDATE `".$db_qq3479015851."category` SET if_upimg = '{$if_upimg}' WHERE ".get_children( $catid, "catid" ) );
								}
								if ( $children_map == "1" )
								{
												$db->query( "UPDATE `".$db_qq3479015851."category` SET if_mappoint = '{$if_mappoint}' WHERE ".get_children( $catid, "catid" ) );
								}
								if ( $children_des == "1" )
								{
												$db->query( "UPDATE `".$db_qq3479015851."category` SET description = '{$description}' WHERE ".get_children( $catid, "catid" ) );
								}
								if ( $children_usecoin == "1" )
								{
												$db->query( "UPDATE `".$db_qq3479015851."category` SET usecoin = '{$usecoin}' WHERE ".get_children( $catid, "catid" ) );
								}
								foreach ( array( "option_static", "pid_releate", "tree", "dir" ) as $range )
								{
												clear_cache_files( "category_".$range );
								}
								write_msg( "成功编辑信息分类 [".$catname."]", "?part=edit&catid=".$catid );
				}
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$db = $SystemGlobalcfm_global = $part = $action = $here = NULL;
?>
