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
define( "CURSCRIPT", "goods" );
require_once( dirname( __FILE__ )."/global.php" );
require_once( SysGlbCfm_INC."/db.class.php" );
if ( !defined( "IN_ADMIN" ) || !defined( "SysGlbCfm" ) )
{
				exit( "Access Denied" );
}
$part = $part ? trim( $part ) : "list";
$id = isset( $id ) ? intval( $id ) : "";
$cityid = isset( $cityid ) ? intval( $cityid ) : "";
chk_admin_purview( "purview_商品管理" );
if ( !submit_check( CURSCRIPT."_submit" ) )
{
				require_once( SysGlbCfm_ROOT."/plugin/goods/include/functions.php" );
				$here = ( $part == "edit" ? "修改" : "" )."已发布商品";
				if ( $part == "edit" )
				{
								@include_once( SysGlbCfm_DATA."/moneytype.inc.php" );
								if ( empty( $id ) )
								{
												write_msg( "商品编号不能为空！" );
								}
								$edit = $db->getRow( "SELECT * FROM `".$db_qq3479015851."goods` WHERE goodsid = '".$id."'" );
								if ( empty( $edit['goodsid'] ) )
								{
												write_msg( "该商品已不存在！" );
								}
								$acontent = get_editor( "content", "", $edit['content'], "100%", "400" );
				}
				else
				{
								$goodslevel = array( 1 => "<font color=green>已上架</font>", 2 => "<font color=blue>已下架</font>", 3 => "<font color=green>推荐</font>", 4 => "<font color=red>热卖</font>", 5 => "<font color=purple>促销</font>" );
								$goodsname = isset( $goodsname ) ? trim( $goodsname ) : "";
								$userid = isset( $userid ) ? trim( $userid ) : "";
								$catid = isset( $catid ) ? intval( $catid ) : "";
								$where = " WHERE 1";
								$where .= $gname != "" ? " AND a.goodsname LIKE '%".$goodsname."%'" : "";
								$where .= $userid != "" ? " AND a.userid = '".$userid."'" : "";
								$where .= !empty( $catid ) ? " AND a.catid IN(".qq3479015851_get_goods_children( $catid ).")" : "";
								$where .= $type == 1 ? " AND onsale = '1'" : "";
								$where .= $type == 2 ? " AND onsale = '2'" : "";
								$where .= $type == 3 ? " AND tuijian = '1'" : "";
								$where .= $type == 4 ? " AND remai = '1'" : "";
								$where .= $type == 5 ? " AND cuxiao = '1'" : "";
								$where .= $admin_cityid ? " AND cityid = '".$admin_cityid."'" : $cityid ? " AND cityid = '".$cityid."'" : "";
								$rows_num = $db->getOne( "SELECT COUNT(a.goodsid) FROM `".$db_qq3479015851."goods` AS a ".$where );
								$param = setparam( array( "part", "goodsname", "userid", "catid", "cityid", "type" ) );
								$goods = page1( "SELECT a.*,b.catname FROM `".$db_qq3479015851."goods` AS a LEFT JOIN `".$db_qq3479015851."goods_category` AS b ON a.catid = b.catid ".$where." ORDER BY a.dateline DESC" );
				}
				include( qq3479015851_tpl( "goods_".$part ) );
}
else
{
				if ( $part == "list" )
				{
								if ( empty( $selectedids ) )
								{
												write_msg( "您没有选中任何一个商品！" );
								}
								$create_in = create_in( $selectedids );
								if ( !$action && !in_array( $action, array( "delall", "goodslevel1", "goodslevel2", "goodslevel3", "goodslevel4", "goodslevel5" ) ) )
								{
												write_msg( "您尚未指定处理动作！" );
								}
								if ( $action == "delall" )
								{
												$query = $db->query( "SELECT * FROM `".$db_qq3479015851."goods` WHERE goodsid ".$create_in );
												while ( $row = $db->fetchRow( $query ) )
												{
																$delete[$row['id']]['picture'] = $row['picture'];
																$delete[$row['id']]['pre_picture'] = $row['pre_picture'];
												}
												foreach ( $delete as $k => $v )
												{
																@unlink( SysGlbCfm_ROOT.$v['picture'] );
																@unlink( SysGlbCfm_ROOT.$v['pre_picture'] );
												}
												$db->query( "DELETE FROM `".$db_qq3479015851."goods` WHERE goodsid ".$create_in );
												unset( $delete );
												unset( $row );
												unset( $query );
												unset( $create_in );
								}
								else if ( in_array( $action, array( "goodslevel1", "goodslevel2", "goodslevel3", "goodslevel4", "goodslevel5" ) ) )
								{
												switch ( $action )
												{
												case "goodslevel1" :
																$db->query( "UPDATE `".$db_qq3479015851."goods` SET onsale = '1' WHERE goodsid ".$create_in );
																break;
												case "goodslevel2" :
																$db->query( "UPDATE `".$db_qq3479015851."goods` SET onsale = '2' WHERE goodsid ".$create_in );
																break;
												case "goodslevel3" :
																$db->query( "UPDATE `".$db_qq3479015851."goods` SET tuijian = '1' WHERE goodsid ".$create_in );
																break;
												case "goodslevel4" :
																$db->query( "UPDATE `".$db_qq3479015851."goods` SET remai = '1' WHERE goodsid ".$create_in );
																break;
												case "goodslevel5" :
																$db->query( "UPDATE `".$db_qq3479015851."goods` SET cuxiao = '1' WHERE goodsid ".$create_in );
												}
												unset( $create_in );
												unset( $action );
								}
				}
				else if ( $part == "edit" )
				{
								if ( empty( $id ) )
								{
												write_msg( "商品编号不能为空！" );
								}
								if ( empty( $goodsname ) )
								{
												write_msg( "商品名称不能为空！" );
								}
								if ( empty( $content ) )
								{
												write_msg( "商品详情不能为空！" );
								}
								$name_file = "goods_image";
								$catid = intval( $catid );
								if ( $_FILES[$name_file]['name'] )
								{
												require_once( SysGlbCfm_INC."/upfile.fun.php" );
												$destination = "/goods/".date( "Ym" )."/";
												check_upimage($name_file);
												$SystemGlobalcfm_image = start_upload( $name_file, $destination, 0, $SystemGlobalcfm_qq3479015851['cfg_goods_limit']['width'], $SystemGlobalcfm_qq3479015851['cfg_goods_limit']['height'], $picture, $pre_picture );
												$picture = $SystemGlobalcfm_image[0];
												$pre_picture = $SystemGlobalcfm_image[1];
												unset( $SystemGlobalcfm_image );
								}
								unset( $name_file );
								$db->query( "UPDATE `".$db_qq3479015851."goods` SET goodsname='".$goodsname."',content='".$content."',cityid='".$cityid."',catid='".$catid."',picture='".$picture."',pre_picture='".$pre_picture."',dateline='".$timestamp."',cityid='".$cityid."',userid='".$userid."',oldprice='".$oldprice."',nowprice='".$nowprice."',gift='".$gift."',huoyuan='".$huoyuan."',rushi='".$rushi."',tuihuan='".$tuihuan."',jiayi='".$jiayi."',weixiu='".$weixiu."',fahuo='".$fahuo."',zhengpin='".$zhengpin."',onsale='".$onsale."',tuijian='".$tuijian."',remai='".$remai."',cuxiao='".$cuxiao."',baozhang='".$baozhang."' WHERE goodsid = '".$id."'" );
								$url = "?part=edit&id=".$id;
				}
				write_msg( "操作成功！", $url ? $url : "?part=list&cityid=".$cityid );
}
?>
