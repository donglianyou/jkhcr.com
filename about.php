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
define('CURSCRIPT','about');
define('SysGlbCfm', true);
require_once dirname(__FILE__).'/include/global.php';
require_once dirname(__FILE__)."/data/config.php";
require_once SysGlbCfm_DATA.'/config.db.php';
require_once SysGlbCfm_INC.'/db.class.php';

ifsiteopen();
(!$part || !in_array($part,array('aboutus','friendlink','faq','announce','sitemap','googlemap'))) && $part = 'aboutus';
$id 	= isset($id) 	? intval($id) 	: '';
$page 	= isset($page) 	? intval($page) : '';
$action = isset($action)? trim($action) : '';
$cityid = $cityid 		? intval($cityid) : 0;

if($action == 'dopost'){
	if(!$randcode = qq3479015851_chk_randcode($checkcode)){
		write_msg('验证码输入错误，请返回重新输入');
	}
	$url 	 = $url 	? trim(mhtmlspecialchars($url)) 	: '';
	$webname = $webname ? trim(mhtmlspecialchars($webname)) : '';
	$weblogo = $weblogo ? trim(mhtmlspecialchars($weblogo)) : '';
	$msg	 = $msg		? textarea_post_change($msg)  : '';
	$email	 = $email	? trim(mhtmlspecialchars($email))	  : '';
	$typeid	 = $typeid  ? intval($typeid) 			  : '';
	if(empty($webname) || empty($url)) write_msg('网站名称和网址不能为空！');
	if($email && !is_email($email)) write_msg("您的email输入不正确！");
	$sql = "INSERT INTO `{$db_qq3479015851}flink`(url,webname,weblogo,msg,email,typeid,createtime,ischeck,cityid)
		VALUES('$url','$webname','$weblogo','$msg','$email','$typeid','$timestamp','1',$cityid); ";
	$res = $db->query($sql);
	$city = get_city_caches($cityid);
	write_msg("链接申请提交成功，管理员审核通过后显示",Rewrite('about',array('part'=>'friendlink')));
	exit;
}

$cache = get_cache_config();
require_once SysGlbCfm_INC.'/cachepages.class.php';

if($part == 'aboutus'){
	
	!$id && $id = $db -> getOne("SELECT MIN(id) FROM `{$db_qq3479015851}about`");
	
	$cachepages = new cachepages($cache['aboutus']['time'],'aboutus_'.$id);
	$cachetime = $cache['aboutus']['time'] > 0 ? true : false;
	$cachepages->cacheCheck();
	
	$aboutus_all = get_aboutus(0);
	$aboutus	 = get_aboutus($id);
	$loc		 = get_location('aboutus','',$aboutus['typename']);
	$page_title  = $loc['page_title'];
	$location	 = $loc['location'];
} elseif($part == 'announce'){
	
	$cachepages = new cachepages($cache['announce']['time'],'announce_'.$cityid);
	$cachetime = $cache['announce']['time'] > 0 ? true : false;
	$cachepages->cacheCheck();
	
	$city 		= get_city_caches($cityid);
	$city_limit = $city['cityid'] ? " AND cityid = '$city[cityid]'" : " AND cityid = '0'";
	$loc 		= get_location('aboutus','','网站公告');
	$query = $db -> query("SELECT * FROM `{$db_qq3479015851}announce` WHERE begintime<='$timestamp' AND (endtime='0' OR endtime>'$timestamp') {$city_limit} ORDER BY id DESC");
	while($row = $db -> fetchRow($query)){
		$arr['id'] 		= $row['id'];
		$arr['title'] 		= $row['title'];
		$arr['begintime']	= $row['begintime'] == 0 ? $row['pubdate'] : $row['begintime'];
		$arr['endtime'] 	= $row['endtime'];
		$arr['author'] 		= $row['author'];
		$arr['content'] 	= $row['redirecturl'] ? '<a href='.$row[redirecturl].' target=_blank>'.$row[redirecturl].'</a>' : $row['content'];
		$arr['uri'] 		= $row['redirecturl'] ? $row['redirecturl'] : Rewrite('about',array('part'=>'aboutus#'.$row['id']));
		$announce[]			= $arr;
	}
}elseif($part == 'faq'){
	!$id && $id = $db -> getOne("SELECT MIN(id) FROM `{$db_qq3479015851}faq`");
	
	$cachepages = new cachepages($cache['faq']['time'],'faq_'.$id);
	$cachetime = $cache['faq']['time'] > 0 ? true : false;
	$cachepages->cacheCheck();
	
	$faq_type 	= get_faq();
	if(!$faq 	= get_faq($id)) write_msg('您指定的帮助主题不存在！');
	$loc	  	= get_location('faq','',$faq['title']);
} elseif($part == 'friendlink'){
	require SysGlbCfm_INC."/flink.fun.php" ;
	
	$cachepages = new cachepages($cache['friendlink']['time'],'friendlink_'.$cityid);
	$cachetime = $cache['friendlink']['time'] > 0 ? true : false;
	$cachepages->cacheCheck();
	
	$city 		= get_city_caches($cityid);
	$loc 		= get_location('friendlink','','友情链接');
	$flink 		= get_flink();
}elseif($part == 'sitemap'){
	$loc = get_location('','','网站地图');
	
	$cachepages = new cachepages($cache['sitemap']['time'],'sitemap_'.$cityid);
	$cachetime = $cache['sitemap']['time'] > 0 ? true : false;
	$cachepages->cacheCheck();
	
	$city = get_city_caches($cityid);
	$categories = get_categories_tree(0,'category');
}
$page_title = $loc['page_title'];
$location 	= $loc['location']; 
globalassign();
include qq3479015851_tpl($part);
$cachetime && $cachepages->caching();

is_object($db) && $db->Close();
?>