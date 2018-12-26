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
$part = $part ? trim( $part ) : "add";
chk_admin_purview( "purview_添加商品" );
if ( !submit_check( CURSCRIPT."_submit" )){
	require_once( SysGlbCfm_ROOT."/plugin/goods/include/functions.php" );
	$here = ( $part == "add" ? "添加" : "" )."商品";
	$acontent = get_editor( "content", "", "", "100%", "800" );
	include( qq3479015851_tpl( "goods_".$part ) );
}else{
	if ( $part == "add" )
	{
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
		$db->query('INSERT INTO `' . $db_qq3479015851 . 'goods` (goodsname,goodsbh,cityid,catid,oicq,oldprice,nowprice,content,pre_picture,picture,userid,dateline,tuihuan,jiayi,weixiu,fahuo,cuxiao,baozhang,huoyuan,gift) VALUES (\'' . $goodsname . '\',\'20181226lrz\',\'0\',\'' . $catid . '\',\'41554255\',\'' . $oldprice . '\',\'' . $nowprice . '\',\'' . $content . '\',\'' . $picture . '\',\'' . $picture . '\',\'admin\',\'' . $timestamp . '\',\'' . $tuihuan . '\',\'' . $jiayi . '\',\'' . $weixiu . '\',\'' . $fahuo . '\',\'' . $cuxiao . '\',\'' . $baozhang . '\',\'' . $huoyuan . '\',\'' . $gift . '\')');
		$id = $db->insert_id();
		$score_change = get_credit_score();
		$score_changer = $score_change['score']['rank']['goods'];
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET score = score' . $score_changer . ' WHERE userid = \'' . $s_uid . '\'');
		$score_change = $score_changer = NULL;
		write_msg( "操作成功！", $url ? $url : "goods_list.php?part=list");
	}else{
		
	}
}
?>