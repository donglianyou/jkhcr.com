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
 * QQ群 ：625621054  [入群提供技术支持]
`*/
define('IN_SMT',true);
define('CURSCRIPT','group');
define('QQ3479015851',TRUE);
define('DIR_NAV',dirname(__FILE__));

require_once DIR_NAV.'/include/global.php';
require_once QQ3479015851_DATA."/config.php";

ifsiteopen();
require_once QQ3479015851_DATA."/config.db.php";
require_once QQ3479015851_INC."/db.class.php";

$id 		= isset($id) 		? intval($id) 		: '';
$cate_id 	= isset($cate_id) 	? intval($cate_id) 	: 0;
$data 	 	= $pluginsettings	=	'';
$areaid 	= isset($areaid) 	? intval($areaid) 	: 0;
$cityid 	= isset($cityid) 	? intval($cityid) 	: 0;
$page	 	= isset($page)	   	? intval($page)	  	: 1;

!ifplugin(CURSCRIPT) && exit('管理员已禁用或未安装团购插件...');

if(!submit_check(CURSCRIPT.'_submit')){

	require_once DIR_NAV.'/plugin/group/include/functions.php';
	
	require_once QQ3479015851_DATA.'/grouplevel.inc.php';
	
	$group_class = get_group_class();
	
	if($id) {
		
		$group  = $db -> getRow("SELECT * FROM `{$db_qq3479015851}group` WHERE groupid = '$id' AND glevel > '0'");
		if(!$group['groupid']) write_msg('该团购活动不存在或者尚未通过审核！',$qq3479015851_global['SiteUrl']);
		$city = get_city_caches($group['cityid'] ? $group['cityid'] : $cityid);
		/*自动补充总站数据start*/
		if($qq3479015851_global['cfg_independency'] && $cityid){
			$maincity = get_city_caches(0);
			$independency = explode(',',$qq3479015851_global['cfg_independency']);
			$independency = is_array($independency) ? $independency : array();
			if(in_array('advertisement',$independency)){
				$city['advertisement'] = empty($city['advertisement']) ? $maincity['advertisement'] : $city['advertisement'];
			}
			$maincity = NULL;
		}
		/*自动补充总站数据end*/
		
		$group['remaindate'] = intval(($group['enddate'] - $timestamp)/(86400));
		
		$data = '';
		@include QQ3479015851_DATA.'/caches/area_option_static.php';
		$group['areaname'] = $data ? $data[$group['areaid']]['areaname'] : $db -> getOne("SELECT areaname FROM `{$db_qq3479015851}area` WHERE areaid = '$group[areaid]'");
		$data = NULL;
		
		/*团购介绍内链处理*/
		$group['content'] = replace_insidelink($group['content'],'group');
		
		$share = array();
		$share['title'] = urlencode($group['gname']);
		$share['url']	= plugin_url(CURSCRIPT,array('id'=>$group['groupid']));
		
		$loc = get_group_location($group['cate_id'],$group['gname']);
		$page_title = $loc['page_title'];
		$location	= $loc['location'];

		$advertisement	= get_advertisement('other');//获得全局广告
		$adveritems		= $city['advertisement'];
		$advertisement	= $advertisement['all'];
		
		$hotgroup = qq3479015851_get_groups(15,1);
		globalassign();
		include qq3479015851_tpl('view');
		
	} else {
	
		$city = get_city_caches($cityid);
		
		if($city['cityid']){
		/*自动补充总站数据start*/
		if($qq3479015851_global['cfg_independency'] && $cityid){
			$maincity = get_city_caches(0);
			$independency = explode(',',$qq3479015851_global['cfg_independency']);
			$independency = is_array($independency) ? $independency : array();
			if(in_array('advertisement',$independency)){
				$city['advertisement'] = empty($city['advertisement']) ? $maincity['advertisement'] : $city['advertisement'];
			}
			$maincity = NULL;
		}
		/*自动补充总站数据end*/
		
			$area_class = $city['area'];
			if(is_array($area_class)){
				//$area_class	= array_merge(array('0'=>array('areaid'=>'','areaname'=>'全部')),$area_class);
				if(is_array($area_class)){
					foreach($area_class as $areakey => $areaval){
						$area_class[$areakey]['uri'] = plugin_url(CURSCRIPT,array('cate_id'=>$cate_id,'areaid'=>$areaval['areaid']));
						$area_class[$areakey]['select'] = $areaval['areaid'] == $areaid ? '1' : 0;
					}
				}
			}
		}
		
		$where = "WHERE glevel > '0'";
		if($cate_id) $where .= " AND cate_id = '$cate_id'";
		if($cityid) $where .= " AND cityid = '$cityid'";
		if($areaid) $where .= " AND areaid = '$areaid'";
		
		$rows_num = $db -> getOne("SELECT COUNT(groupid) FROM `{$db_qq3479015851}group` $where");
		$param = setParam(array('cateid','areaid'));
		$group = page1("SELECT * FROM `{$db_qq3479015851}group` $where ORDER BY displayorder DESC");
		$list = array();
		foreach($group as $k => $v){
			$list[$v['groupid']]['groupid'] = $v['groupid'];
			$list[$v['groupid']]['gname'] = $v['gname'];
			$list[$v['groupid']]['des'] = clear_html($v['des']);
			$list[$v['groupid']]['enddate'] = $v['enddate'];
			$list[$v['groupid']]['meetdate'] = $v['meetdate'];
			$list[$v['groupid']]['gaddress'] = $v['gaddress'];
			$list[$v['groupid']]['glevel'] = $v['glevel'];
			$list[$v['groupid']]['signintotal'] = $v['signintotal'];
			$list[$v['groupid']]['commenturl'] = $v['commenturl'];
			$list[$v['groupid']]['pre_picture'] = $v['pre_picture'];
			$list[$v['groupid']]['uri'] = plugin_url('group',array('id'=>$v['groupid']));
		}
		
		$page_view = page2();
		$hotgroup = qq3479015851_get_groups('15',1);
		$hotgroup = $hotgroup ? $hotgroup : array();
		
		$loc = get_group_location($cate_id);
		$page_title = (empty($cate_id) && empty($areaid)) ? ($pluginsettings[CURSCRIPT]['seotitle'] ? $pluginsettings[CURSCRIPT]['seotitle'] : $loc['page_title']) : $loc['page_title'];
		$page_title = str_replace('{city}',$city['cityname'],$page_title);
		$location	= $loc['location'];
		
		$seo = array();
		$seo['keywords'] 	= str_replace('{city}',$city['cityname'],$pluginsettings[CURSCRIPT]['seokeywords']);
		$seo['description'] = str_replace('{city}',$city['cityname'],$pluginsettings[CURSCRIPT]['seodescription']);
		
		$advertisement	= get_advertisement('other');//获得全局广告
		$adveritems		= $city['advertisement'];
		$advertisement	= $advertisement['all'];
		
		globalassign();
		include qq3479015851_tpl('index');
	}

} else {
	
	$sname = $sname ? mhtmlspecialchars($sname) : '';
	$id = isset($id) ? intval($id) : '';
	$qqmsn = isset($qqmsn) ? mhtmlspecialchars($qqmsn) : '';
	$tel =  isset($tel) ? mhtmlspecialchars($tel) : '';
	$signinip = GetIP();
	$sex = isset($sex) ? mhtmlspecialchars($sex) : '';
	$message = isset($message) ? textarea_post_change($message) : '';
	$totalnumber = isset($totalnumber) ? intval($totalnumber) : '';
	$age = isset($age) ? mhtmlspecialchars($age) : '';
	
	if(empty($id)) write_msg('您报名的团购活动不存在！');
	if(empty($sname)) write_msg('姓名不能为空！');
	if(!$randcode = qq3479015851_chk_randcode($checkcode)){
		write_msg('验证码输入错误，请返回重新输入');
	}
	
	$db -> query("UPDATE `{$db_qq3479015851}group` SET signintotal = signintotal + 1 WHERE groupid = '$id'");
	$db -> query("INSERT INTO `{$db_qq3479015851}group_signin` (groupid,sname,sex,tel,age,qqmsn,signinip,dateline,totalnumber,message) VALUES ('$id','$sname','$sex','$tel','$age','$qqmsn','$signinip','$timestamp','$totalnumber','$message')");
	write_msg('报名提交成功，我们会尽快与您取得联系！',plugin_url(CURSCRIPT,array('id'=>$id)));
	
}

is_object($db) && $db->Close();
$city = $maincity = NULL;
unset($city,$maincity);

function get_group_location($cate_id=0,$str=''){
	global $db,$db_qq3479015851,$group_class,$city;
	
	$raquo = $GLOBALS['qq3479015851_global']['cfg_raquo'];
	$location   = '当前位置：<a href="'.($city['domain'] ? $city['domain'] : $GLOBALS['qq3479015851_global']['SiteUrl']).'">'.$city['cityname'].$GLOBALS['qq3479015851_global']['SiteName'].'</a>'.' <code>'.$raquo.'</code> '.' <a href="'.$city['domain'].plugin_url(CURSCRIPT,array('cate_id'=>0)).'">'.$city[cityname].'团购活动</a>';
	$page_title = $city['cityname'].'团购活动 - '.$GLOBALS['qq3479015851_global']['SiteName'];
	
	if(!empty($cate_id)){
		$page_title =  htmlspecialchars($group_class[$cate_id]['cate_name']) . ' - ' . $page_title;
		$location   .= ' <code> '.$raquo.' </code> <a href="' .$city['domain'].$group_class[$cate_id]['cate_uri'] . '">' .
		htmlspecialchars($group_class[$cate_id]['cate_name']).'</a>';
	}
	
	$page_title = $GLOBALS['qq3479015851_global']['SiteCity'].($GLOBALS['areaid'] ? get_areaname($GLOBALS['areaid']) : '').$page_title;
	
	if (!empty($str)){
        $page_title = $str.' - '.$page_title;
        $location   .= ' <code>'.$raquo.'</code> &nbsp;' .$str;
    }
	
	$cur = array('page_title'=>$page_title,'location'=>$location);
	unset($page_title,$cat,$location,$type,$group_class);
    return $cur;
}
?>