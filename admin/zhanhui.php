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
function bodyimg( $obj )
{
				if ( isset( $obj ) )
				{
								if ( preg_match( "<img.*src=[\"](.*?)[\"].*?>", $obj, $regs ) )
								{
												return $obj = $regs[1];
								}
				}
				else
				{
								return FALSE;
				}
}

function mystripslashes( $string )
{
				if ( !is_array( $string ) )
				{
								return stripslashes( $string );
				}
				foreach ( $string as $key => $val )
				{
								$string[$key] = new_stripslashes( $val );
				}
				return $string;
}

define( "CURSCRIPT", "zhanhui" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_DATA."/info.level.inc.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "SysGlbCfm" ) )
{
				exit( "Access Denied" );
}
$part = $part ? $part : "list";
$iscommend_arr = array( "0" => "正常", "1" => "<font color=red>推荐</font>" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				chk_admin_purview( "purview_新闻管理" );
				if ( $part == "list" )
				{
								$here = "网站新闻管理";
								$where .= $title != "" ? "WHERE a.title LIKE '%".$title."%'" : "WHERE 1";
								$where .= $catid ? " AND a.catid IN (".get_cat_children( $catid, "channel" ).")" : "";
								$where .= $cityid ? " AND a.cityid ='".$cityid."'" : "";
								$sql = "SELECT a.*,b.catname,c.cityname FROM `".$db_qq3479015851."zhanhui` AS a LEFT JOIN `{$db_qq3479015851}channel` AS b ON a.catid = b.catid LEFT JOIN `{$db_qq3479015851}city` AS c ON a.cityid=c.cityid {$where} ORDER BY a.id DESC";
								$rows_num = $db->getOne( "SELECT COUNT(*) FROM `".$db_qq3479015851."zhanhui` AS a {$where}" );
								$param = setparam( array( "part", "title", "catid", "cityid" ) );
								$zhanhui = page1( $sql );
								include( qq3479015851_tpl( "zhanhui_list" ) );
				}
				else if ( $part == "edit" && $id )
				{
								$row = $db->getRow( "SELECT * FROM ".$db_qq3479015851."zhanhui WHERE id = '{$id}'" );
								$acontent = get_editor( "content", "Default", $row[content], "100%", "600px" );
								$here = "编辑新闻";
								include( qq3479015851_tpl( CURSCRIPT ) );
				}
				else if ( $part == "add" )
				{
								$acontent = get_editor( "content", "Default", "", "100%", "600px" );
								$here = "添加新闻";
								include( qq3479015851_tpl( CURSCRIPT ) );
				}
				else if ( $part == "del" )
				{
								if ( empty( $id ) )
								{
												write_msg( "没有选择记录" );
								}
								qq3479015851_delete( "zhanhui", "WHERE id = '".$id."'" );
								write_msg( "删除新闻 ".$id." 成功", $url, "SysGlbCfm" );
				}
}
else if ( $part == "list" )
{
				$i = "";
				if ( is_array( $delids ) )
				{
								$i = 1;
								foreach ( $delids as $kids => $vids )
								{
												qq3479015851_delete( "zhanhui", "WHERE id = ".$vids );
								}
				}
				else
				{
								write_msg( "你没有指定新闻ID" );
				}
				if ( $i == 1 )
				{
								write_msg( "指定的新闻ID已经被删除！", $url, "insertecord" );
				}
}
else if ( $part == "add" )
{
				if ( !$title )
				{
								write_msg( "请填写新闻标题" );
				}
				if ( !$catid )
				{
								write_msg( "请填写分类名称" );
				}
				if ( $isjump == 1 )
				{
								if ( !$redirect_url )
								{
												write_msg( "请输入新闻跳转地址!" );
								}
				}
				if ( $isjump != 1 )
				{
								if ( !$content )
								{
												write_msg( "请填写新闻内容!" );
								}
				}
				$viewpath = $SystemGlobalcfm_global['SiteUrl']."/zhanhui.php?id=".$id;
				if ( $isjump == 1 )
				{
								$do_qq3479015851 = $db->query( "INSERT INTO `".$db_qq3479015851."zhanhui` (title,cityid,catid,redirect_url,isjump,isbold,iscommend,begintime,introduction,author,source,keywords) VALUES ('{$title}','{$cityid}','{$catid}','{$redirect_url}','1','{$isbold}','{$iscommend}','{$timestamp}','{$introduction}','{$author}','{$from}','{$keywords}')" );
				}
				else
				{
								$redirect_url = "";
								if ( $ifout == "bodyimg" )
								{
												$imgpath = bodyimg( mystripslashes( $content ) );
								}
								$do_qq3479015851 = $db->query( "INSERT INTO `".$db_qq3479015851."zhanhui` (title,cityid,keywords,catid,isbold,iscommend,content,hit,perhit,begintime,introduction,author,source,imgpath) VALUES\r\n('{$title}','{$cityid}','{$keywords}','{$catid}','{$isbold}','{$iscommend}','{$content}','{$hit}','{$perhit}','{$timestamp}','{$introduction}','{$author}','{$from}','{$imgpath}')" );
				}
				$id = $db->insert_id( );
				if ( is_array( $isfocus ) && $imgpath )
				{
								foreach ( $isfocus as $kfocus => $vfocus )
								{
												if ( $vfocus == "index" )
												{
																$typename = "网站首页";
												}
												else
												{
																$typename = "新闻首页";
												}
												$db->query( "INSERT INTO `".$db_qq3479015851."focus` (image,pre_image,words,url,pubdate,focusorder,typename)\r\n\t\t\t\tVALUES('{$imgpath}','{$imgpath}','{$title}','{$viewpath}','{$timestamp}','{$id}','{$typename}')" );
								}
								clear_cache_files( "focus_index" );
								clear_cache_files( "focus_news" );
				}
				$message = "成功增加一篇新闻 <<".$title.">>";
				write_msg( $message, "zhanhui.php" );
}
else if ( $part == "edit" )
{
				if ( !$id )
				{
								write_msg( "您未指定要编辑的新闻" );
				}
				if ( !$title )
				{
								write_msg( "请填写新闻标题" );
				}
				if ( !$catid )
				{
								write_msg( "请填写分类名称" );
				}
				if ( $isjump == 1 )
				{
								if ( !$redirect_url )
								{
												write_msg( "请输入新闻跳转地址!" );
								}
				}
				if ( $isjump != 1 )
				{
								if ( !$content )
								{
												write_msg( "请填写新闻内容!" );
								}
				}
				$viewpath = $SystemGlobalcfm_global['SiteUrl']."/zhanhui.php?id=".$id;
				if ( $isjump == 1 )
				{
								$do_qq3479015851 = $db->query( "UPDATE `".$db_qq3479015851."zhanhui` SET title = '{$title}' , redirect_url = '{$redirect_url}' , catid = '{$catid}', cityid = '{$cityid}' , keywords = '{$keywords}' , iscommend = '{$iscommend}' , isbold = '{$isbold}' , isjump = '1' , hit = '{$hit}' , perhit = '{$perhit}' , imgpath = '{$imgpath}' , author = '{$author}' , source = '{$from}' , introduction = '{$introduction}' WHERE id = '{$id}'" );
				}
				else
				{
								$redirect_url = "";
								if ( $ifout == "bodyimg" )
								{
												$imgpath = bodyimg( mystripslashes( $content ) );
								}
								$do_qq3479015851 = $db->query( "UPDATE `".$db_qq3479015851."zhanhui` SET title = '{$title}', content = '{$content}', keywords = '{$keywords}' , catid = '{$catid}' , cityid = '{$cityid}' , iscommend = '{$iscommend}' , isbold = '{$isbold}' , isjump = '0' , hit = '{$hit}' , perhit = '{$perhit}' ,begintime = '{$timestamp}' , imgpath = '{$imgpath}' , author = '{$author}' , source = '{$from}' , introduction = '{$introduction}' WHERE id = '{$id}'" );
				}
				$viewpath = $SystemGlobalcfm_global['SiteUrl']."/zhanhui.php?id=".$id;
				if ( is_array( $isfocus ) && $imgpath )
				{
								foreach ( $isfocus as $kfocus => $vfocus )
								{
												if ( $vfocus == "index" )
												{
																$typename = "网站首页";
												}
												else
												{
																$typename = "新闻首页";
												}
												$db->query( "INSERT INTO `".$db_qq3479015851."focus` (image,pre_image,words,url,pubdate,focusorder,typename,cityid)\r\n\t\t\t\tVALUES('{$imgpath}','{$imgpath}','{$title}','{$viewpath}','{$timestamp}','{$id}','{$typename}','{$cityid}')" );
								}
								clear_cache_files( "focus_index" );
								clear_cache_files( "focus_news" );
				}
				$message = "成功修改新闻 <<".$title.">>";
				write_msg( $message, "zhanhui.php?part=edit&id=".$id );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$SystemGlobalcfm_global = $db = $db_qq3479015851 = $part = NULL;
?>
