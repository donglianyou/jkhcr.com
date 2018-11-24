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

function get_city_area( $areaid = "" )
{
				global $db;
				global $db_qq3479015851;
				$query = $db->query( "SELECT * FROM ".$db_qq3479015851."city ORDER BY displayorder ASC" );
				while ( $row = $db->fetchRow( $query ) )
				{
								$list[$row['cityid']]['cityid'] = $row['cityid'];
								$list[$row['cityid']]['cityname'] = $row['cityname'];
								$list[$row['cityid']]['displayorder'] = $row['displayorder'];
								$list[$row['cityid']]['domain'] = $row['domain'];
								$list[$row['cityid']]['directory'] = $row['directory'];
								$list[$row['cityid']]['firstletter'] = $row['firstletter'];
				}
				$query = $db->query( "SELECT * FROM `".$db_qq3479015851."area` ORDER BY displayorder ASC" );
				while ( $row = $db->fetchRow( $query ) )
				{
								$list[$row['cityid']]['area'][$row['areaid']]['areaid'] = $row['areaid'];
								$list[$row['cityid']]['area'][$row['areaid']]['areaname'] = $row['areaname'];
				}
				return $list;
}

function write_city_file( $dirname, $cityid, $directory )
{
				global $SystemGlobalcfmdirectory;
				global $SystemGlobalcfm_global;
				global $db;
				global $db_qq3479015851;
				if ( !$cityid )
				{
								return;
				}
				if ( empty( $dirname ) )
				{
								$p = "";
								if ( in_array( $directory, $SystemGlobalcfmdirectory ) )
								{
												write_msg( "该目录名 <b>".$directory."</b> 与qq3479015851保留目录名重名<br /><br />请更换一个目录名后再试" );
												exit( );
								}
				}
				else
				{
								$p = "../";
				}
				$dirname = $dirname."/".$directory;
				if ( !createdir( SysGlbCfm_ROOT."/".$dirname ) )
				{
								write_msg( SysGlbCfm_ROOT."/".$dirname." 目录创建失败!" );
				}
				$string = "<?php\r\n\$cityid=".$cityid.";\r\nrequire dirname(__FILE__).'/../".$p."'.basename(__FILE__);\r\n?>";
				createfile( SysGlbCfm_ROOT.$dirname."/about.php", $string );
				createfile( SysGlbCfm_ROOT.$dirname."/index.php", $string );
				createfile( SysGlbCfm_ROOT.$dirname."/category.php", $string );
				createfile( SysGlbCfm_ROOT.$dirname."/information.php", $string );
				createfile( SysGlbCfm_ROOT.$dirname."/news.php", $string );
				createfile( SysGlbCfm_ROOT.$dirname."/coupon.php", $string );
				createfile( SysGlbCfm_ROOT.$dirname."/goods.php", $string );
				createfile( SysGlbCfm_ROOT.$dirname."/corporation.php", $string );
				createfile( SysGlbCfm_ROOT.$dirname."/group.php", $string );
}

function DelCity( $cityid )
{
				global $db;
				global $db_qq3479015851;
				global $SystemGlobalcfm_global;
				global $SystemGlobalcfmdirectory;
				$all = $db->getAll( "SELECT areaid FROM `".$db_qq3479015851."area` WHERE cityid = '".$cityid."'" );
				if ( is_array( $all ) )
				{
								foreach ( $all as $k => $v )
								{
												$areaids = $v[areaid].",";
								}
				}
				if ( $areaids = substr( $areaids, 0, -1 ) )
				{
								qq3479015851_delete( "street", "WHERE areaid IN(".$areaids.")" );
								unset( $areaids );
								unset( $all );
				}
				$directory = $db->getOne( "SELECT directory FROM `".$db_qq3479015851."city` WHERE cityid = '".$cityid."'" );
				if ( $directory && !in_array( $directory, $SystemGlobalcfmdirectory ) )
				{
								deldir( SysGlbCfm_ROOT.$SystemGlobalcfm_global['cfg_citiesdir']."/".$directory );
				}
				unset( $directory );
				qq3479015851_delete( "area", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "city", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "information", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "member", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "flink", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "admin", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "announce", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "focus", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "group", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "coupon", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "goods", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "news", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "lifebox", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "telephone", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "navurl", "WHERE cityid = '".$cityid."'" );
				qq3479015851_delete( "advertisement", "WHERE cityid = '".$cityid."'" );
}

define( "CURSCRIPT", "area" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "SysGlbCfm" ) )
{
				exit( "Access Denied" );
}
if ( $admin_cityid )
{
				write_msg( "您没有权限访问该页！" );
}
$SystemGlobalcfmdirectory = array( "admin", "api", "attachment", "backup", "data", "images", "include", "install", "member", "m", "plugin", "rewrite", "template", "uc_client" );
$rpp = 120;
$start = isset( $_GET['start'] ) && 1 < $_GET['start'] ? $_GET['start'] : 1;
$limit_start = $start - 1;
$end = $start + $rpp - 1;
$converted = 0;
$part = $part ? $part : "list";
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				if ( $part == "list" )
				{
								chk_admin_purview( "purview_已建分站" );
								if ( $areaid )
								{
												$areaid = intval( $areaid );
												$currentname = $db->getOne( "SELECT areaname FROM `".$db_qq3479015851."area` WHERE areaid = '".$areaid."'" );
												$list = $db->getAll( "SELECT * FROM `".$db_qq3479015851."street` WHERE areaid = '".$areaid."' ORDER BY displayorder ASC" );
								}
								else if ( $cityid )
								{
												$cityid = intval( $cityid );
												$currentname = $db->getOne( "SELECT cityname FROM `".$db_qq3479015851."city` WHERE cityid = '".$cityid."'" );
												$list = $db->getAll( "SELECT * FROM `".$db_qq3479015851."area` WHERE cityid = '".$cityid."' ORDER BY displayorder ASC" );
								}
								else
								{
												$keywords = trim( $keywords );
												$showperpage = intval( $showperpage );
												if ( $keywords )
												{
																if ( $type == "cityid" )
																{
																				$where = " AND cityid = '".$keywords."'";
																}
																else if ( $type == "directory" )
																{
																				$where = " AND directory = '".$keywords."'";
																}
																else if ( $type == "cityname" )
																{
																				$where = " AND cityname = '".$keywords."'";
																}
																else if ( $type == "provincename" )
																{
																				$provinceid = $db->getOne( "SELECT provinceid FROM `".$db_qq3479015851."province` WHERE provincename = '".$keywords."'" );
																				if ( $provinceid )
																				{
																								$where = " AND provinceid = '".$provinceid."'";
																				}
																}
																else
																{
																				$where = "";
																}
												}
												$province = $db->getAll( "SELECT * FROM `".$db_qq3479015851."province` ORDER BY displayorder ASC" );
												$param = setparam( array( "part", "keywords", "type", "showperpage" ) );
												$rows_num = $db->getOne( "SELECT count(cityid) FROM `".$db_qq3479015851."city` WHERE 1 ".$where." ORDER BY displayorder ASC" );
												$list = page1( "SELECT * FROM `".$db_qq3479015851."city` WHERE 1 ".$where." ORDER BY displayorder ASC", $showperpage );
								}
								$here = "地区列表";
								include( qq3479015851_tpl( "area_list" ) );
				}
				else if ( $part == "area_city_add" )
				{
								chk_admin_purview( "purview_添加分站" );
								if ( $action == "batch" )
								{
												$step = $step ? intval( $step ) : 1;
												if ( $step == 1 )
												{
																$province = $db->getAll( "SELECT * FROM `".$db_qq3479015851."province` ORDER BY displayorder ASC" );
												}
												$here = "批量增加分站";
												include( qq3479015851_tpl( "area_city_add_batch" ) );
								}
								else
								{
												$here = "增加单一分站";
												$province = $db->getAll( "SELECT * FROM `".$db_qq3479015851."province` ORDER BY displayorder ASC" );
												include( qq3479015851_tpl( "area_city_add" ) );
								}
				}
				else if ( $part == "area_add" )
				{
								chk_admin_purview( "purview_添加地区" );
								$here = "添加地区";
								$city_area = get_city_area( );
								include( qq3479015851_tpl( "area_add" ) );
				}
				else if ( $part == "area_street_add" )
				{
								chk_admin_purview( "purview_添加路段" );
								$here = "添加路段";
								$city_area = get_city_area( );
								include( qq3479015851_tpl( "area_street_add" ) );
				}
				else if ( $part == "edit" && $cityid )
				{
								$cityid = intval( $cityid );
								$city = $db->getRow( "SELECT * FROM ".$db_qq3479015851."city WHERE cityid = '".$cityid."'" );
								if ( !$city )
								{
												write_msg( "您选中的城市分站不存在！" );
								}
								$province = $db->getAll( "SELECT * FROM `".$db_qq3479015851."province` ORDER BY displayorder ASC" );
								$here = "编辑城市分站";
								include( qq3479015851_tpl( "area_city_edit" ) );
				}
				else if ( $part == "del" && $cityid )
				{
								delcity( $cityid );
								clear_cache_files( "changecity_cities" );
								clear_cache_files( "changeprovince_cities" );
								clear_cache_files( "city_".$cityid );
								clear_cache_files( "citysiteabout_".$cityid );
								clear_cache_files( "allcities" );
								clear_cache_files( "hot_cities" );
								write_msg( "成功删除编号为".$cityid."的城市分站", "?part=list", "SysGlbCfm_record" );
				}
				else if ( $part == "makealldir" )
				{
								$r = $db->getAll( "SELECT cityid,directory FROM `".$db_qq3479015851."city` WHERE `status` = '1' LIMIT ".$limit_start.",".$rpp );
								foreach ( $r as $k => $v )
								{
												write_city_file( $SystemGlobalcfm_global['cfg_citiesdir'], $v['cityid'], $v['directory'] );
												$converted = 1;
								}
								if ( $converted )
								{
												write_msg( "<img src=../images/loading.gif align=absmiddle /> 分站目录生成中...", "area.php?part=makealldir&start=".( $end + 1 ) );
								}
								else
								{
												write_msg( "恭喜！已生成全部分站目录！", "area.php", "write_record" );
								}
				}
				else if ( $part == "delalldir" )
				{
								$directory = $db->getAll( "SELECT directory FROM `".$db_qq3479015851."city` LIMIT ".$limit_start.",".$rpp );
								foreach ( $directory as $k => $v )
								{
												if ( empty( $SystemGlobalcfm_global['cfg_citiesdir'] ) && in_array( $v, $SystemGlobalcfmdirectory ) || !$v['directory'] && in_array( $v['directory'], $SystemGlobalcfmdirectory ) )
												{
																$converted = 1;
																deldir( SysGlbCfm_ROOT.$SystemGlobalcfm_global['cfg_citiesdir']."/".$v['directory'] );
												}
								}
								if ( $converted )
								{
												write_msg( "<img src=../images/loading.gif align=absmiddle /> 分站目录删除中...", "area.php?part=delalldir&start=".( $end + 1 ) );
								}
								else
								{
												write_msg( "恭喜！已删除全部分站目录！", "area.php", "write_record" );
								}
				}
				else if ( $part == "usedomain" )
				{
								$query = $db->query( "SELECT * FROM `".$db_qq3479015851."city`" );
								while ( $row = $db->fetchRow( $query ) )
								{
												$domaina = str_replace( "http://www.", "", $SystemGlobalcfm_global['SiteUrl'] );
												$domain = "http://".$row[directory].".".$domaina."/";
												$db->query( "UPDATE `".$db_qq3479015851."city` SET domain = '".$domain."' WHERE cityid = '".$row['cityid']."'" );
												$domain = NULL;
								}
								clear_cache_files( "allcities" );
								clear_cache_files( "hot_cities" );
								clear_cache_files( "changecity_cities" );
								write_msg( "全部分站已开启二级域名！", "area.php", "write_record" );
				}
				else if ( $part == "usenodomain" )
				{
								$db->query( "UPDATE `".$db_qq3479015851."city` SET domain = ''" );
								clear_cache_files( "allcities" );
								clear_cache_files( "hot_cities" );
								clear_cache_files( "changecity_cities" );
								write_msg( "全部分站已取消二级域名！", "area.php", "write_record" );
				}
}
else
{
				$return = $url ? $url : "area.php";
				if ( is_array( $batchnew ) && $step == 1 )
				{
								$displayorder = $db->getOne( "SELECT max(displayorder) FROM `".$db_qq3479015851."city`" );
								if ( empty( $batchnew['cityname'] ) )
								{
												write_msg( "分站城市名称不能为空，多个城市请以空格分隔开" );
								}
								$batchnew['cityname'] = trim( $batchnew['cityname'] );
								include( dirname( __FILE__ )."/include/pinyin.inc.php" );
								foreach ( explode( " ", $batchnew['cityname'] ) as $k => $v )
								{
												if ( !$db->getOne( "SELECT cityid FROM `".$db_qq3479015851."city` WHERE cityname = '".$v."'" ) )
												{
																$displayorder += 1;
																$arr['provinceid'] = $provinceid;
																$arr['cityname'] = $v;
																$arr['citypy'] = getpinyin( $v );
																$arr['directory'] = getpinyin( $v, 1 );
																$arr['directory'] = $db->getOne( "SELECT cityid FROM `".$db_qq3479015851."city` WHERE directory = '".$arr['directory']."'" ) ? $arr['citypy'] : $arr['directory'];
																$arr['firstletter'] = substr( $arr['citypy'], 0, 1 );
																$arr['domain'] = "";
																$arr['displayorder'] = $displayorder;
																$array[] = $arr;
												}
												else
												{
																$repeatwarning .= "<font color=red>".$v."</font> ";
												}
								}
								$repeatwarning .= $repeatwarning ? "有重复记录，已被系统自动省去" : "";
								$here = "批量增加分站";
								$step = 2;
								$provincename = $db->getOne( "SELECT provincename FROM `".$db_qq3479015851."province` WHERE provinceid = '".$batchnew['provinceid']."'" );
								include( qq3479015851_tpl( "area_city_add_batch" ) );
								$displayorder = NULL;
								exit( );
				}
				if ( $step == 2 && is_array( $batchnewcityname ) && is_array( $batchnewdirectory ) )
				{
								$batchnewprovinceid = intval( $batchnewprovinceid );
								foreach ( $batchnewcityname as $key => $q )
								{
												$batch_newcityname = trim( $q );
												$batch_newdirectory = mhtmlspecialchars( trim( $batchnewdirectory[$key] ) );
												$batch_newcitypy = mhtmlspecialchars( trim( $batchnewcitypy[$key] ) );
												$batch_newfirstletter = mhtmlspecialchars( trim( $batchnewfirstletter[$key] ) );
												$batch_newdisplayorder = mhtmlspecialchars( trim( $batchnewdisplayorder[$key] ) );
												$batch_newdomain = mhtmlspecialchars( trim( $batchnewdomain[$key] ) );
												$batch_newifhot = mhtmlspecialchars( trim( $batchnewifhot[$key] ) );
												if ( $batch_newcityname && $batch_newdirectory )
												{
																$db->query( "INSERT INTO `".$db_qq3479015851."city` (provinceid,cityname,citypy,displayorder,directory,domain,firstletter,ifhot) VALUES ('".$batchnewprovinceid."','".$batch_newcityname."','".$batch_newcitypy."','".$batch_newdisplayorder."','".$batch_newdirectory."','".$batch_newdomain."','".$batch_newfirstletter."','".$batch_newifhot."')" );
																write_city_file( $SystemGlobalcfm_global['cfg_citiesdir'], $db->insert_id( ), $batch_newdirectory );
												}
								}
								clear_cache_files( "allcities" );
								clear_cache_files( "changecity_cities" );
								clear_cache_files( "changeprovince_cities" );
								clear_cache_files( "hot_cities" );
								write_msg( "指定分站批量添加成功！", "area.php" );
								exit( );
				}
				if ( is_array( $actiondir ) )
				{
								switch ( $action )
								{
								case "mkdir" :
												foreach ( $actiondir as $k => $v )
												{
																write_city_file( $SystemGlobalcfm_global['cfg_citiesdir'], $k, $v );
												}
												break;
								case "deldir" :
												foreach ( $actiondir as $k => $v )
												{
																if ( empty( $SystemGlobalcfm_global['cfg_citiesdir'] ) && in_array( $v, $SystemGlobalcfmdirectory ) || !$v && in_array( $v, $SystemGlobalcfmdirectory ) )
																{
																				deldir( SysGlbCfm_ROOT.$SystemGlobalcfm_global['cfg_citiesdir']."/".$v );
																}
												}
												break;
								case "open" :
												foreach ( $actiondir as $k => $v )
												{
																$db->query( "UPDATE `".$db_qq3479015851."city` SET `status` = '1' WHERE `cityid` = '".$k."'" );
																if ( !$v && in_array( $v, $SystemGlobalcfmdirectory ) )
																{
																				write_city_file( $SystemGlobalcfm_global['cfg_citiesdir'], $k, $v );
																}
												}
												break;
								case "close" :
												foreach ( $actiondir as $k => $v )
												{
																$db->query( "UPDATE `".$db_qq3479015851."city` SET `status` = '0' WHERE `cityid` = '".$k."'" );
																if ( $v && !in_array( $v, $SystemGlobalcfmdirectory ) )
																{
																				deldir( SysGlbCfm_ROOT.$SystemGlobalcfm_global['cfg_citiesdir']."/".$v );
																}
																clear_cache_files( "city_".$k );
												}
												break;
								case "delcity" :
												foreach ( $actiondir as $k => $v )
												{
																delcity( $k );
																clear_cache_files( "city_".$k );
												}
												clear_cache_files( "changecity_cities" );
												clear_cache_files( "changeprovince_cities" );
												clear_cache_files( "allcities" );
												clear_cache_files( "hot_cities" );
												write_msg( "指定分站删除成功!", "area.php" );
												break;
												write_msg( "请选择您要进行的操作。" );
								}
								clear_cache_files( "allcities" );
								clear_cache_files( "changecity_cities" );
								clear_cache_files( "changeprovince_cities" );
								clear_cache_files( "hot_cities" );
								write_msg( "分站设置更新成功！", $return, "write_record" );
				}
				if ( is_array( $citynew ) )
				{
								if ( empty( $citynew['cityname'] ) )
								{
												write_msg( "城市分站名称不能为空！" );
								}
								if ( empty( $citynew['firstletter'] ) )
								{
												write_msg( "首字母不能为空！" );
								}
								if ( empty( $citynew['directory'] ) )
								{
												write_msg( "保存目录名称不能为空！" );
								}
								if ( empty( $citynew['citypy'] ) )
								{
												write_msg( "城市名全拼/英文全称不能为空！" );
								}
								$citynew['provinceid'] = intval( $citynew['provinceid'] );
								$citynew['cityname'] = trim( $citynew['cityname'] );
								$citynew['firstletter'] = trim( $citynew['firstletter'] );
								$citynew['direcoty'] = trim( $citynew['direcoty'] );
								$citynew['domain'] = trim( $citynew['domain'] );
								$citynew['citypy'] = trim( $citynew['citypy'] );
								$citynew['title'] = trim( $citynew['title'] );
								$citynew['keywords'] = trim( $citynew['keywords'] );
								$citynew['description'] = trim( $citynew['description'] );
								if ( 0 < $db->getOne( "SELECT count(cityid) FROM `".$db_qq3479015851."city` WHERE directory = '".$citynew['directory']."'" ) )
								{
												write_msg( $citynew['directory']." 目录名重复，请换一个目录名后再试!" );
								}
								if ( 0 < $db->getOne( "SELECT count(cityid) FROM `".$db_qq3479015851."city` WHERE cityname = '".$citynew['cityname']."'" ) )
								{
												write_msg( $citynew['cityname']." 城市分站重复，请检查是否已经添加过该分站!" );
								}
								if ( empty( $SystemGlobalcfm_global['cfg_citiesdir'] ) && in_array( $citynew['directory'], $SystemGlobalcfmdirectory ) )
								{
												write_msg( "该目录名 <b>".$citynew[directory]."</b> 与qq3479015851保留目录重名<br /><br />请更换一个目录名后再试" );
								}
								$db->query( "INSERT INTO `".$db_qq3479015851."city` (provinceid,cityname,citypy,displayorder,directory,mappoint,domain,firstletter,ifhot,title,keywords,description) VALUES ('".$citynew['provinceid']."','".$citynew['cityname']."','".$citynew['citypy']."','".$citynew['displayorder']."','".$citynew['directory']."','".$citynew['mappoint']."','".$citynew['domain']."','".$citynew['firstletter']."','".$citynew['ifhot']."','".$citynew['title']."','".$citynew['keywords']."','".$citynew['description']."')" );
								$cid = $db->insert_id( );
								write_city_file( $SystemGlobalcfm_global['cfg_citiesdir'], $cid, $citynew['directory'] );
								clear_cache_files( "changecity_cities" );
								clear_cache_files( "changeprovince_cities" );
								clear_cache_files( "hot_cities" );
								clear_cache_files( "allcities" );
								clear_cache_files( "city_".$cid );
								write_msg( "城市分站 ".$citynew['cityname']." 创建成功！", $return, "SysGlbCfm_record" );
				}
				if ( is_array( $cityedit ) )
				{
								if ( empty( $cityedit['cityname'] ) )
								{
												write_msg( "城市分站名称不能为空！" );
								}
								if ( empty( $cityedit['firstletter'] ) )
								{
												write_msg( "首字母不能为空！" );
								}
								if ( empty( $cityedit['directory'] ) )
								{
												write_msg( "保存目录名称不能为空！" );
								}
								if ( empty( $cityedit['citypy'] ) )
								{
												write_msg( "城市名全拼/英文全称不能为空！" );
								}
								$cityedit['provinceid'] = intval( $cityedit['provinceid'] );
								$cityedit['cityname'] = trim( $cityedit['cityname'] );
								$cityedit['firstletter'] = trim( $cityedit['firstletter'] );
								$cityedit['direcoty'] = trim( $cityedit['direcoty'] );
								$cityedit['domain'] = trim( $cityedit['domain'] );
								$cityedit['citypy'] = trim( $cityedit['citypy'] );
								$cityedit['title'] = trim( $cityedit['title'] );
								$cityedit['keywords'] = trim( $cityedit['keywords'] );
								$cityedit['description'] = trim( $cityedit['description'] );
								if ( empty( $SystemGlobalcfm_global['cfg_citiesdir'] ) && in_array( $cityedit['directory'], $SystemGlobalcfmdirectory ) )
								{
												write_msg( "该目录名 <b>".$cityedit[directory]."</b> 与qq3479015851保留目录重名<br /><br />请更换一个目录名后再试" );
								}
								$db->query( "UPDATE `".$db_qq3479015851."city` SET provinceid = '".$cityedit['provinceid']."',cityname = '".$cityedit['cityname']."' , citypy = '".$cityedit['citypy']."' , displayorder = '".$cityedit['displayorder']."' , directory = '".$cityedit['directory']."' , mappoint = '".$cityedit['mappoint']."' , domain = '".$cityedit['domain']."' , firstletter = '".$cityedit['firstletter']."' , ifhot = '".$cityedit['ifhot']."', title = '".$cityedit['title']."', keywords = '".$cityedit['keywords']."', description = '".$cityedit['description']."' WHERE cityid = '".$cityid."'" );
								if ( $cityedit['olddirectory'] != $cityedit['directory'] )
								{
												deldir( SysGlbCfm_ROOT."/c/".$cityedit['olddirectory'] );
								}
								clear_cache_files( "allcities" );
								clear_cache_files( "changecity_cities" );
								clear_cache_files( "changeprovince_cities" );
								clear_cache_files( "hot_cities" );
								write_city_file( $SystemGlobalcfm_global['cfg_citiesdir'], $cityid, $cityedit['directory'] );
								clear_cache_files( "city_".$cityid );
								write_msg( "城市分站 ".$cityedit[cityname]." 修改成功！", "area.php?part=edit&cityid=".$cityid, "qq3479015851" );
				}
				if ( is_array( $newarea ) )
				{
								if ( empty( $newarea['cityid'] ) )
								{
												write_msg( "请选择隶属的城市分站！" );
								}
								foreach ( explode( " ", trim( $newarea['areaname'] ) ) as $k => $v )
								{
												++$newarea['displayorder'];
												$len = strlen( $v );
												if ( $len < 2 || 30 < $len )
												{
																write_msg( "地区名必须在2个至30个字符之间" );
												}
												$db->query( "INSERT INTO `".$db_qq3479015851."area` (areaname,cityid,displayorder)VALUES('".$v."','".$newarea['cityid']."','".$newarea['displayorder']."')" );
												clear_cache_files( "city_".$newarea[cityid] );
								}
								write_msg( "分站地区增加成功！", "area.php?cityid=".$newarea[cityid], "SysGlbCfm_record" );
				}
				if ( is_array( $newstreet ) )
				{
								if ( empty( $newstreet['areaid'] ) )
								{
												write_msg( "请选择隶属的分站地区！" );
								}
								foreach ( explode( " ", trim( $newstreet['streetname'] ) ) as $k => $v )
								{
												++$newarea['newstreet'];
												$len = strlen( $v );
												if ( $len < 2 || 30 < $len )
												{
																write_msg( "街道名必须在2个至30个字符之间" );
												}
												$db->query( "INSERT INTO `".$db_qq3479015851."street` (streetname,areaid,displayorder)VALUES('".$v."','".$newstreet['areaid']."','".$newarea['newstreet']."')" );
												clear_cache_files( "city_".$newstreet[cityid] );
								}
								write_msg( "街道/路段增加成功！", "area.php?areaid=".$newstreet[areaid]."&cityid=".$cityid."&cityname=".$cityname, "SysGlbCfm_record" );
				}
				if ( is_array( $updatecity_displayorder ) )
				{
								foreach ( $updatecity_displayorder as $k => $v )
								{
												$db->query( "UPDATE `".$db_qq3479015851."city` SET displayorder = '".$v."' WHERE cityid = '".$k."'" );
								}
								clear_cache_files( "changecity_cities" );
								clear_cache_files( "changeprovince_cities" );
								clear_cache_files( "hot_cities" );
				}
				if ( is_array( $updatearea_areaname ) )
				{
								$return = "area.php?cityid=".$cityid;
								foreach ( $updatearea_areaname as $k => $v )
								{
												$db->query( "UPDATE `".$db_qq3479015851."area` SET areaname = '".$v."' WHERE areaid = '".$k."'" );
								}
				}
				if ( is_array( $updatearea_displayorder ) )
				{
								$return = "area.php?cityid=".$cityid;
								foreach ( $updatearea_displayorder as $k => $v )
								{
												$db->query( "UPDATE `".$db_qq3479015851."area` SET displayorder = '".$v."' WHERE areaid = '".$k."'" );
								}
				}
				if ( is_array( $updatestreet_displayorder ) )
				{
								$return = "area.php?cityid=".$cityid."&areaid=".$areaid."&cityname=".$cityname;
								foreach ( $updatestreet_displayorder as $k => $v )
								{
												$db->query( "UPDATE `".$db_qq3479015851."street` SET displayorder = '".$v."' WHERE streetid = '".$k."'" );
								}
				}
				if ( is_array( $updatestreet_streetname ) )
				{
								$return = "area.php?cityid=".$cityid."&areaid=".$areaid."&cityname=".$cityname;
								foreach ( $updatestreet_streetname as $k => $v )
								{
												$db->query( "UPDATE `".$db_qq3479015851."street` SET streetname = '".$v."' WHERE streetid = '".$k."'" );
								}
				}
				if ( is_array( $deletestreetid ) )
				{
								$return = "area.php?cityid=".$cityid."&areaid=".$areaid."&cityname=".$cityname;
								$db->query( "DELETE FROM `".$db_qq3479015851."street` WHERE ".create_in( $deletestreetid, "streetid" ) );
				}
				if ( is_array( $deleteareaid ) )
				{
								$return = "area.php?cityid=".$cityid;
								$db->query( "DELETE FROM `".$db_qq3479015851."street` WHERE ".create_in( $deleteareaid, "areaid" ) );
								$db->query( "DELETE FROM `".$db_qq3479015851."area` WHERE ".create_in( $deleteareaid, "areaid" ) );
				}
				write_msg( "分站地区更新成功！", $return, "SysGlbCfm_record" );
}
if ( is_object( $db ) )
{
				$db->Close( );
}
$db = $SystemGlobalcfm_global = $part = $action = $here = NULL;
?>
