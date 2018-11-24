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
$catid = isset( $catid ) ? intval( $catid ) : "";
$areaid = isset( $areaid ) ? intval( $areaid ) : "";
$page = isset( $page ) ? $page : 1;
if ( $catid )
{
				$corp = $db->getRow( "SELECT * FROM `".$db_qq3479015851."corp` WHERE corpid = '".$catid."'" );
				if ( !$corp )
				{
								errormsg( "该机构分类不存在！" );
				}
				$ypcategory = get_corp_tree( $corp['parentid'] ? $corp['parentid'] : $catid, "corp" );
				$parentcats = get_parent_cats( "corp", $catid );
				$parentcats = is_array( $parentcats ) ? array_reverse( $parentcats ) : "";
				$where = " WHERE a.status = '1' AND a.if_corp = '1'  AND b.catid IN(".get_corp_children( $catid ).") ";
				$where .= !$areaid ? "" : " AND a.areaid = '".$areaid."'";
				$where .= !$streetid ? "" : " AND a.streetid = '".$streetid."'";
				$perpage = $mobile_settings['mobiletopicperpage'] ? $mobile_settings['mobiletopicperpage'] : 10;
				$param = setparams( array( "mod", "cityid", "catid", "areaid", "streetid" ) );
				$sql = "SELECT a.* FROM `".$db_qq3479015851."member` AS a LEFT JOIN `".$db_qq3479015851."member_category` AS b ON a.userid = b.userid ".$where.$city_limit_a." ORDER BY a.id DESC";
				$count_sql = "SELECT COUNT(b.id) FROM `".$db_qq3479015851."member` AS a LEFT JOIN ".$db_qq3479015851."member_category AS b ON a.userid = b.userid ".$where.$city_limit_a;
				$rows_num = $db->getOne( $count_sql );
				$totalpage = ceil( $rows_num / $perpage );
				$num = intval( $page - 1 ) * $perpage;
				$page1 = page1( $sql, $perpage );
				foreach ( $page1 as $k => $val )
				{
								$arr['id'] = $val['id'];
								$arr['userid'] = $val['userid'];
								$arr['per_certify'] = $val['per_certify'];
								$arr['com_certify'] = $val['com_certify'];
								$arr['jointime'] = $val['jointime'];
								$arr['credits'] = $val['credits'];
								$arr['credit'] = $val['credit'];
								$arr['if_list'] = $val['if_list'];
								$arr['prelogo'] = $val['prelogo'] ? $val['prelogo'] : "/images/nophoto.gif";
								$arr['tname'] = highlight( $val['tname'] ? $val['tname'] : $val['userid'], $keywords );
								$arr['address'] = $val['address'] ? $val['address'] : $val['busway'] ? $val['busway'] : "暂无地址";
								$arr['levelid'] = $val['levelid'];
								$arr['tel'] = $val['tel'] ? $val['tel'] : "暂无电话";
								$member[] = $arr;
				}
				$pageview = pager( );
				include( qq3479015851_tpl( "corp_list" ) );
}
else
{
				$ypcategory = get_corp_tree( 0, "corp" );
				include( qq3479015851_tpl( "corp_all" ) );
}
?>
