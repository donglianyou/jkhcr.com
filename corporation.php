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
define('IN_SMT',true);
define('CURSCRIPT','corp');
define('SysGlbCfm', true);

require_once dirname(__FILE__)."/data/config.php";
require_once dirname(__FILE__)."/include/global.php";

ifsiteopen();

$catid  	= isset($catid)  	? intval($catid)  : '';
$areaid 	= isset($areaid) 	? intval($areaid) : '';

require_once SysGlbCfm_DATA."/config.db.php";
require_once SysGlbCfm_INC."/db.class.php";

$seo	 	= get_seoset();
$rewrite	= $seo['seo_force_yp'];

if($Catid && $rewrite == 'rewrite'){
	$detail=explode("-",$Catid);
	if($detail[0] && in_array($detail[0],array('catid','areaid','page'))){
		$detail[1] = intval($detail[1]);
		for($i=0;$i<count($detail) ;$i++ ){
			$_GET[$detail[$i]]=$$detail[$i]=str_replace(array('#@#','#!#'),array('-','/'),$detail[++$i]);	
		}
		extract($_GET);
	}
	$Catid = $detail = NULL;
}


if($catid && !$cur = $db -> getRow("SELECT parentid,corpname FROM `{$db_qq3479015851}corp` WHERE corpid = '$catid'")){
	write_msg('当前商家分类不存在或者未被启用！');
}

$city = get_city_caches($cityid);
/*自动补充总站数据start*/
if($SystemGlobalcfm_global['cfg_independency'] && $cityid){
	$maincity = get_city_caches(0);
	$independency = explode(',',$SystemGlobalcfm_global['cfg_independency']);
	$independency = is_array($independency) ? $independency : array();
	if(in_array('advertisement',$independency)){
		$city['advertisement'] = empty($city['advertisement']) ? $maincity['advertisement'] : $city['advertisement'];
	}
	$maincity = NULL;
}

$cate_limit 	= !empty($catid) 	? " AND b.catid IN(".get_corp_children($catid).") "  : "";
$city_limit 	= !$city['cityid'] ? "": " AND a.cityid = '$city[cityid]'";
$city_limit 	.= !$areaid ? "": " AND a.areaid = '$areaid'";
$level_limit	= " AND a.status = '1' AND a.if_corp = '1'";

$sql = empty($cate_limit) ? "SELECT a.* FROM `{$db_qq3479015851}member` AS a WHERE 1 {$level_limit} {$cate_limit}{$city_limit} ORDER BY a.levelid DESC,a.jointime DESC" : "SELECT a.* FROM `{$db_qq3479015851}member` AS a LEFT JOIN `{$db_qq3479015851}member_category` AS b ON a.userid = b.userid WHERE 1 {$level_limit} {$cate_limit}{$city_limit} ORDER BY a.levelid DESC,a.jointime DESC";
$count_sql	= empty($cate_limit) ? "SELECT COUNT(a.id) FROM `{$db_qq3479015851}member` AS a WHERE 1 {$level_limit}{$city_limit}" : "SELECT COUNT(b.id) FROM `{$db_qq3479015851}member` AS a LEFT JOIN {$db_qq3479015851}member_category AS b ON a.userid = b.userid WHERE 1  {$level_limit}{$cate_limit}{$city_limit}";

$rows_num 	= $db -> getOne($count_sql);
$param		= setParam(array('catid','areaid'),$rewrite,'corporation-');
if(is_array($res = page1($sql,$SystemGlobalcfm_global['cfg_list_page_line'] ? $SystemGlobalcfm_global['cfg_list_page_line'] : 10))){
	foreach($res as $key => $val){
		$arr['userid']		= $val['userid'];
		$arr['per_certify']	= $val['per_certify'];
		$arr['com_certify']	= $val['com_certify'];
		$arr['jointime']	= $val['jointime'];
		$arr['credits']		= $val['credits'];
		$arr['credit']		= $val['credit'];
		$arr['prelogo']		= $val['prelogo'];
		$arr['tname']		= HighLight($val['tname'] ? $val['tname'] : $val['userid'],$keywords);
		$arr['uri'] 		= Rewrite('store',array('uid'=>$val['id']));
		$arr['uri_comment'] = Rewrite('store',array('uid'=>$val['id'],'part'=>'comment'));
		$arr['uri_contactus'] = Rewrite('store',array('uid'=>$val['id'],'part'=>'contactus'));
		$arr['uri_album'] 	= Rewrite('store',array('uid'=>$val['id'],'part'=>'album'));
		$arr['address']		= $val['address'] ? $val['address'] : ($val['busway'] ? $val['busway'] : '暂无地址'); 
		$arr['levelid']		= $val['levelid'];
		$arr['tel']			= $val['tel'] ? $val['tel'] : '暂无电话';
		$member[]			= $arr;
	}
}

$ypcategory = get_corp_tree(empty($cur['parentid']) ? $catid : $cur['parentid'],'corp');
if($city['cityid']){
	$area_list = $city['area'];
	if(is_array($area_list)){
		$area_list	= array_merge(array('0'=>array('areaid'=>'','areaname'=>'不限地区')),$area_list);
		if(is_array($area_list)){
			foreach($area_list as $areakey => $areaval){
				$area_list[$areakey]['uri'] = Rewrite('corp',array('catid'=>$catid,'areaid'=>$areaval['areaid']));
				$area_list[$areakey]['select'] = $areaval['areaid'] == $areaid ? '1' : 0;
			}
		}
	}
}

$loc 			= get_location('corp',$catid);
$page_title 	= $loc['page_title'];
$location		= $loc['location'];
$advertisement	= get_advertisement('other');
$adveritems		= $city['advertisement'];
$advertisement	= $advertisement['all'];

$pageview = page2($rewrite);
$certifymember = qq3479015851_get_members(10,1,'',1,1,'','',$city['cityid']);
$totalnum = $rows_num;
$documents = get_member_docu(10);
globalassign();
include qq3479015851_tpl(CURSCRIPT);

is_object($db) && $db->Close();
$city = $maincity = NULL;
unset($city,$maincity);
?>