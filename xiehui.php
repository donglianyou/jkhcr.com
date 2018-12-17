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
define('CSCRIPT','xiehui');

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
	write_msg('',$SystemGlobalcfm_global['SiteUrl'].'/m/index.php?mod=xiehui&id='.$id);
}


if($id) {
	define('CURSCRIPT','xiehui');
	$id = isset($id) ? intval($id) : '';
	if(!$xiehui = $db -> getRow("SELECT * FROM `{$db_qq3479015851}xiehui` WHERE id = '$id'")){
		write_msg('您所指定的新闻不存在或者已被删除！','/');
		exit;
	}
	
	$cityid = $xiehui['cityid'];
	$city = get_city_caches($cityid);
	
	
	$xiehui['view_url'] = Rewrite('xiehui',array('id'=>$xiehui['id'],'cityid'=>$xiehui['cityid']));
	
	if($xiehui['redirect_url'] != '' && $xiehui['isjump'] == 1) write_msg('请稍候，当前页面正跳转至 '.$xiehui[redirect_url].' ',$xiehui[redirect_url]);
	
	$loc				 = get_location('xhchannel',$xiehui[catid],$xiehui[title]);
	$location	 		 = $loc['location'];
	$page_title			 = $loc['page_title'];
	
	$advertisement			= get_advertisement('other');
	$adveritems				= $city['advertisement'];
	$advertisement			= $advertisement['all'];
	
	$xiehui['keywords']	 = $xiehui['keywords'] ? $xiehui['keywords'] : $xiehui['title'];
	$xiehui['description'] = mhtmlspecialchars(substring(clear_html($xiehui['content']),0,249));
	
	$xiehui['content'] = replace_insidelink($xiehui['content'],'xiehui');
	
} elseif($catid) {

	define('CURSCRIPT','xiehui_list');
	
	$city = get_city_caches($cityid);
	
	$catid = isset($catid) ? intval($catid) : 0;
	$channel = get_cat_info($catid,'xhchannel');
	if(!$channel) write_msg('您所指定的新闻栏目不存在或者已经删除！');
	$loc		= get_location('xhchannel',$catid);
	$location	= $loc['location'];
	$page_title	= $loc['page_title'];
	
	$seo		= get_seoset();
	$rewrite 	= $seo['seo_force_news'];
	
	$cat_children	= get_cat_children($catid,'xhchannel');
	$city_limit = $cityid ? " AND cityid = '$cityid'" : "";
	
	$param = setParam(array('catid'),$rewrite,'xiehui-');
	$rows_num = $db->getOne("SELECT COUNT(*) FROM `{$db_qq3479015851}xiehui` AS a WHERE catid IN($cat_children) {$city_limit}");
	$page1 = page1("SELECT * FROM {$db_qq3479015851}xiehui WHERE catid IN($cat_children) {$city_limit} ORDER BY id DESC",25);
	foreach($page1 as $kr => $r){
		$arr['begintime']   = $r['begintime'];
		$arr['hit']  		= $r['hit'];
		$arr['title']  	    = $r['title'];
		$arr['iscommend']  	= $r['iscommend'];
		$arr['content'] 	= clear_html($r['content']);
		$arr['uri']	  	  	= $r['isjump'] ? $r['redirect_url'] : Rewrite('xiehui',array('id'=>$r['id'],'cityid'=>$r['cityid']));
		$arr['imgpath'] 	= $r['imgpath'];
		$xiehui[]			  	= $arr;
	}
	
	$advertisement			= get_advertisement('other');
	$adveritems				= $city['advertisement'];
	$advertisement			= $advertisement['all'];
	
	$cat_list = get_categories_tree(empty($channel['parentid']) ? $catid : $channel['parentid'],'xhchannel');
	$pageview = page2($rewrite);
	
} else {

	define('CURSCRIPT','xiehui_index');
	
	$city = get_city_caches($cityid);
	
	$catquery = $db -> query("SELECT catid,catname,html_dir FROM `{$db_qq3479015851}xhchannel` WHERE parentid = '0' AND if_view = '2' ORDER BY catorder ASC");
	while($queryrow = $db -> fetchRow($catquery)){
		$_array['catid'] 	= $queryrow['catid'];
		$_array['catname'] 	= $queryrow['catname'];
		$_array['uri'] 		= Rewrite('xiehui',array('catid'=>$queryrow['catid'],'cityid'=>$city['cityid']));
		$channel[]		= $_array;
	}
	$city_limit = $cityid ? " AND cityid = '$cityid'" : "";
	for($i=0; $i<count($channel); $i++){
		$do_sql = $db -> query("SELECT iscommend,id,title,catid,begintime,isjump,redirect_url,cityid FROM `{$db_qq3479015851}xiehui` WHERE catid IN(".get_cat_children($channel[$i]['catid'],'xhchannel').") {$city_limit} ORDER BY begintime DESC LIMIT 0,8");
		while($row = $db -> fetchRow($do_sql)){
			$arr['id'] 			= $row['id'];
			$arr['iscommend'] 	= $row['iscommend'];
			$arr['title'] 		= $row['title'];
			$arr['begintime'] 	= $row['begintime'];
			$arr['uri']			= $row['isjump'] == 1 ? $row['redirect_url'] : Rewrite('xiehui',array('id'=>$row['id'],'cityid'=>$row['cityid']));
			
			$channel[$i]['xiehui'][] = $arr;
		}
	}
	
	$loc		= get_location('xiehui',0,$city[cityname].'协会专栏');
	$page_title = $loc['page_title'];
	$location	= $loc['location'];
	
	$s = array();
	$s['keywords'] = str_replace('{city}',$city['cityname'],$pluginsettings['xiehui']['seokeywords']);
	$s['description'] = str_replace('{city}',$city['cityname'],$pluginsettings['xiehui']['seodescription']);
	
	$advertisement	= get_advertisement('other');
	$adveritems		= $city['advertisement'];
	$advertisement	= $advertisement['all'];
}

globalassign();
include qq3479015851_tpl(CURSCRIPT);
is_object($db) && $db->Close();
?>