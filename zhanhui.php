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
define('SysGlbCfm',true);
define('CSCRIPT','zhanhui');

require_once dirname(__FILE__)."/include/global.php";
require_once SysGlbCfm_DATA."/config.php";
require_once SysGlbCfm_DATA."/config.db.php";
require_once SysGlbCfm_INC."/db.class.php";

ifsiteopen();
/*!ifplugin(CSCRIPT) && exit('管理员已禁用或未安装新闻插件...');*/

$id	= isset($id) ? intval($id) : '';
$catid = isset($catid) ? intval($catid) : 0;
$page = isset($page) ? intval($page) : 1;
$cityid = isset($cityid) ? intval($cityid) : 0;

if(!pcclient()){
	write_msg('',$SystemGlobalcfm_global['SiteUrl'].'/m/index.php?mod=zhanhui&id='.$id);
}


if($id) {
	define('CURSCRIPT','zhanhui');
	$id = isset($id) ? intval($id) : '';
	if(!$zhanhui = $db -> getRow("SELECT * FROM `{$db_qq3479015851}zhanhui` WHERE id = '$id'")){
		write_msg('您所指定的新闻不存在或者已被删除！','/');
		exit;
	}
	
	$cityid = $zhanhui['cityid'];
	$city = get_city_caches($cityid);
	
	
	$zhanhui['view_url'] = Rewrite('zhanhui',array('id'=>$zhanhui['id'],'cityid'=>$zhanhui['cityid']));
	
	if($zhanhui['redirect_url'] != '' && $zhanhui['isjump'] == 1) write_msg('请稍候，当前页面正跳转至 '.$zhanhui[redirect_url].' ',$zhanhui[redirect_url]);
	
	$loc				 = get_location('zhchannel',$zhanhui[catid],$zhanhui[title]);
	$location	 		 = $loc['location'];
	$page_title			 = $loc['page_title'];
	
	$advertisement			= get_advertisement('other');
	$adveritems				= $city['advertisement'];
	$advertisement			= $advertisement['all'];
	
	$zhanhui['keywords']	 = $zhanhui['keywords'] ? $zhanhui['keywords'] : $zhanhui['title'];
	$zhanhui['description'] = mhtmlspecialchars(substring(clear_html($zhanhui['content']),0,249));
	
	$zhanhui['content'] = replace_insidelink($zhanhui['content'],'zhanhui');
	
} elseif($catid) {

	define('CURSCRIPT','zhanhui_list');
	
	$city = get_city_caches($cityid);
	
	$catid = isset($catid) ? intval($catid) : 0;
	$channel = get_cat_info($catid,'zhchannel');
	if(!$channel) write_msg('您所指定的新闻栏目不存在或者已经删除！');
	$loc		= get_location('zhchannel',$catid);
	$location	= $loc['location'];
	$page_title	= $loc['page_title'];
	
	$seo		= get_seoset();
	$rewrite 	= $seo['seo_force_news'];
	
	$cat_children	= get_cat_children($catid,'zhchannel');
	$city_limit = $cityid ? " AND cityid = '$cityid'" : "";
	
	$param = setParam(array('catid'),$rewrite,'zhanhui-');
	$rows_num = $db->getOne("SELECT COUNT(*) FROM `{$db_qq3479015851}zhanhui` AS a WHERE catid IN($cat_children) {$city_limit}");
	$page1 = page1("SELECT * FROM {$db_qq3479015851}zhanhui WHERE catid IN($cat_children) {$city_limit} ORDER BY id DESC",25);
	foreach($page1 as $kr => $r){
		$arr['begintime']   = $r['begintime'];
		$arr['hit']  		= $r['hit'];
		$arr['title']  	    = $r['title'];
		$arr['iscommend']  	= $r['iscommend'];
		$arr['content'] 	= clear_html($r['content']);
		$arr['uri']	  	  	= $r['isjump'] ? $r['redirect_url'] : Rewrite('zhanhui',array('id'=>$r['id'],'cityid'=>$r['cityid']));
		$arr['imgpath'] 	= $r['imgpath'];
		$zhanhui[]			  	= $arr;
	}
	
	$advertisement			= get_advertisement('other');
	$adveritems				= $city['advertisement'];
	$advertisement			= $advertisement['all'];
	
	$cat_list = get_categories_tree(empty($channel['parentid']) ? $catid : $channel['parentid'],'zhchannel');
	$pageview = page2($rewrite);
	
} else {

	define('CURSCRIPT','zhanhui_index');
	
	$city = get_city_caches($cityid);
	
	$catquery = $db -> query("SELECT catid,catname,html_dir FROM `{$db_qq3479015851}zhchannel` WHERE parentid = '0' AND if_view = '2' ORDER BY catorder ASC");
	while($queryrow = $db -> fetchRow($catquery)){
		$_array['catid'] 	= $queryrow['catid'];
		$_array['catname'] 	= $queryrow['catname'];
		$_array['uri'] 		= Rewrite('zhanhui',array('catid'=>$queryrow['catid'],'cityid'=>$city['cityid']));
		$channel[]		= $_array;
	}
	$city_limit = $cityid ? " AND cityid = '$cityid'" : "";
	for($i=0; $i<count($channel); $i++){
		$do_sql = $db -> query("SELECT iscommend,id,title,catid,begintime,isjump,redirect_url,cityid FROM `{$db_qq3479015851}zhanhui` WHERE catid IN(".get_cat_children($channel[$i]['catid'],'zhchannel').") {$city_limit} ORDER BY begintime DESC LIMIT 0,8");
		while($row = $db -> fetchRow($do_sql)){
			$arr['id'] 			= $row['id'];
			$arr['iscommend'] 	= $row['iscommend'];
			$arr['title'] 		= $row['title'];
			$arr['begintime'] 	= $row['begintime'];
			$arr['uri']			= $row['isjump'] == 1 ? $row['redirect_url'] : Rewrite('zhanhui',array('id'=>$row['id'],'cityid'=>$row['cityid']));
			
			$channel[$i]['zhanhui'][] = $arr;
		}
	}
	
	$loc		= get_location('zhanhui',0,$city[cityname].'展会');
	$page_title = $loc['page_title'];
	$location	= $loc['location'];
	
	$s = array();
	$s['keywords'] = str_replace('{city}',$city['cityname'],$pluginsettings['zhanhui']['seokeywords']);
	$s['description'] = str_replace('{city}',$city['cityname'],$pluginsettings['zhanhui']['seodescription']);
	
	$advertisement	= get_advertisement('other');
	$adveritems		= $city['advertisement'];
	$advertisement	= $advertisement['all'];
}

globalassign();
include qq3479015851_tpl(CURSCRIPT);
is_object($db) && $db->Close();
?>