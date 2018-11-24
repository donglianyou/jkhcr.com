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

if ( CURSCRIPT != "wap" )
{
				exit( "FORBIDDEN" );
}
$id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : "";
if ( !$id )
{
				errormsg( "信息主题ID不能为空！" );
}
if ( !( $row = $db->getRow( "SELECT * FROM `".$db_qq3479015851."information` WHERE id = '".$id."' AND info_level >= 1" ) ) )
{
				errormsg( "该信息主题未通过审核或不存在！" );
}
$cityid = $row['cityid'];
$city = get_city_caches( $cityid );
$db->query( "UPDATE `".$db_qq3479015851."information` SET hit = hit + 1 WHERE id = '".$id."'" );
$row['endtime'] = get_info_life_time( $row['endtime'] );
$row['contactview'] = $row['endtime'] == "<font color=red>已过期</font>" && $SystemGlobalcfm_global['cfg_info_if_gq'] != 1 ? 0 : 1;
$rowr = $db->getRow( "SELECT catid,parentid,catname,template_info,modid,usecoin FROM `".$db_qq3479015851."category` WHERE catid = '".$row['catid']."'" );
$row['catid'] = $rowr['catid'];
$row['parentid'] = $rowr['parentid'];
$row['catname'] = $rowr['catname'];
$row['template_info'] = $rowr['template_info'];
$row['modid'] = $rowr['modid'];
$row['usecoin'] = $rowr['usecoin'];
$row['image'] = 0 < $row['img_count'] ? $db->getAll( "SELECT prepath,path,prewidth,preheight,width,height FROM `".$db_qq3479015851."info_img` WHERE infoid = '".$id."' ORDER BY id ASC" ) : FALSE;
$mayi = $db->getRow( "SELECT if_corp,per_certify,com_certify FROM `".$db_qq3479015851."member` WHERE userid = '".$row['userid']."'" );
$viewid = mgetcookie( "viewid" );
if ( $action == "seecontact" )
{
				if ( $iflogin == 1 )
				{
								$money_own = $db->getOne( "SELECT money_own FROM `".$db_qq3479015851."member` WHERE userid = '".$s_uid."'" );
								include( SysGlbCfm_ROOT."/member/include/common.func.php" );
								if ( $row['usecoin'] <= $money_own )
								{
												$db->query( "UPDATE `".$db_qq3479015851."member` SET money_own = money_own - '".$row['usecoin']."' WHERE userid = '".$s_uid."'" );
												write_money_use( "查看编号为".$id."的信息联系方式", "<font color=red>扣除金币 ".$row[usecoin]." </font>" );
												$echo = $row[qq] ? "<li><span class=\"attrName\">联系 Q Q：</span><span class=\"attrVal\"> ".$row[qq]."</span></li>" : "";
												$echo .= "<li>\r\n\t\t\t\t\t<span class=\"attrName\">联系电话：</span>\r\n\t\t\t\t\t<span class=\"attrVal\"><a class=\"fred\" href=\"tel:".$row[tel]."\">".$row[tel]."</a>&nbsp;&nbsp;".$row[contact_who]."</span>\r\n\t\t\t\t</li>\r\n\t\t\t\t<li>\r\n\t\t\t\t\t<p class=\"mt10\">\r\n\t\t\t\t\t\t<a href=\"tel:".$row[tel]."\" class=\"fangico dianhua\"><i></i>拨打电话</a>\r\n                        <a href=\"sms:".$row[tel]."\" class=\"fangico duanxin\"><i></i>短信咨询</a>\r\n\t\t\t\t\t</p>\r\n\t\t\t\t</li>";
												echo $echo;
								}
								else
								{
												echo "余额不足";
								}
								msetcookie( "viewid", $id, 86400 );
								exit( );
				}
				echo "请先登录";
				exit( );
}
if ( 1 < $rowr['modid'] )
{
				$extr = $db->getRow( "SELECT * FROM `".$db_qq3479015851."information_".$rowr[modid]."` WHERE id ='".$id."'" );
				if ( $extr )
				{
								$des = get_info_option_array( );
								unset( $extr['iid'] );
								unset( $extr['id'] );
								unset( $extr['content'] );
								foreach ( $extr as $k => $v )
								{
												$val = get_info_option_titval( $des[$k], $v );
												$arr['title'] = $val['title'];
												$arr['value'] = $val['value'];
												$row['extra'][] = $arr;
												$row[$k] = $v;
								}
								$des = NULL;
				}
}
include( qq3479015851_tpl( "info" ) );
?>
