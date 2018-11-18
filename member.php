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
define('CURSCRIPT','login');
define('IN_SMT',true);
define('QQ3479015851', true);
define('IN_MANAGE',true);

require_once dirname(__FILE__)."/include/global.php";
require_once dirname(__FILE__)."/data/config.php";
require_once QQ3479015851_DATA."/config.db.php";
require_once QQ3479015851_INC."/db.class.php";

ifsiteopen();
if($qq3479015851_global['cfg_if_member_log_in'] != 1) write_msg("操作失败！系统管理员关闭了会员功能！");

$authcodesettings = read_static_cache('authcodesettings');
require_once QQ3479015851_MEMBER.'/include/common.func.php';

if(!in_array($mod,array(CURSCRIPT,'register','forgetpass','out','openlogin','validate'))){
	$mod = $_REQUEST['mod'] = CURSCRIPT;
}
require_once QQ3479015851_DATA."/config.inc.php";
require_once QQ3479015851_INC."/member.class.php";

$url   = isset($url) ? trim(checkhtml($url)) : '';
$action = isset($action) ? $action : '';
$action = ($qq3479015851_global['cfg_if_corp'] != 1 && $action == 'store') ? 'person' : $action;
$cityid = isset($cityid) ? intval($cityid) : '';

if(!submit_check('log_submit')){

	if($mod != 'out' && $mod != 'openlogin'){
		$member_log -> chk_in() && write_msg('','member/index.php');
	}
	
	switch($mod){
		case 'validate':
			if($code){
				$arr = explode('.',base64_decode($code));
				$uid = $arr[0];
				$user_info = $db -> getRow("SELECT id,userid,userpwd,email FROM `{$db_qq3479015851}member` WHERE id = '$uid'");
				
				if(($timestamp - $arr[2] < 1800) && $arr[1] == md5($user_info['id'].'+'.$user_info['userpwd'])){
					$db->query("UPDATE `{$db_qq3479015851}member` SET `status` = 1 WHERE id = '$user_info[id]'");
					$userid = $user_info['userid'];
					$uid = $user_info['id'];
					$email = $user_info['email'];
					$error = 4;
					globalassign();
					include qq3479015851_tpl('register_2');
				} else {
					$error = 5;
					globalassign();
					include qq3479015851_tpl('register_2');
				}
			}
		break;
		case 'out':
			if(PASSPORT_TYPE == 'ucenter'){
				$member_log -> out('noredirect');
				require QQ3479015851_ROOT.'/uc_client/client.php';
				$ucsynlogout = uc_user_synlogout();
				echo $ucsynlogout;
				echo qq3479015851_goto($url ? $url : $qq3479015851_global['SiteUrl'].'/'.$qq3479015851_global['cfg_member_logfile']);
			} elseif(PASSPORT_TYPE == 'phpwind'){
				$member_log -> out('noredirect');
				require QQ3479015851_ROOT.'/pw_client/uc_client.php';
				$ucsynlogout = uc_user_synlogout();
				echo $ucsynlogout;
				echo qq3479015851_goto($url ? $url : $qq3479015851_global['SiteUrl'].'/'.$qq3479015851_global['cfg_member_logfile']);
			} else {
				$member_log -> out(trim($url));
			}
		break;
		
		case 'login':
			$qqlogin = read_static_cache('qqlogin');
			$wxlogin = read_static_cache('wxlogin');
			
			$city = get_city_caches($cityid);
			$loc 		= get_location('login',0,'会员登录');
			$page_title = $loc['page_title'];
			$location 	= $loc['location'];
			$qq3479015851_imgcode = $authcodesettings['login'];
			globalassign();
			include qq3479015851_tpl(CURSCRIPT);
			
		break;
		
		case 'register':

			$qq3479015851_global['cfg_if_member_register'] != 1 && write_msg("操作失败！系统管理员关闭了新会员注册！");
			
			$city = get_city_caches($cityid);
			$loc 		= get_location('register',0,'会员注册');
			$page_title = $loc['page_title'];
			$location	= $loc['location'];
			
			if(in_array($action,array('store','person'))){
				require QQ3479015851_DATA.'/safequestions.php';
				$safequestion = GetSafequestion(0,'safequestion');
				$qq3479015851_imgcode = $authcodesettings['register'];
				$submit = '立即注册';
				if($action == 'store') $get_area_options = select_where_option('/include/selectwhere.php',$city['cityid'],$areaid,$streetid);
				if($action == 'store') $get_member_cat = get_member_cat();
				$mixcode = md5($cookiepre);
				
				$whenregister = '';
				$whenregister = $db -> getOne("SELECT value FROM `{$db_qq3479015851}config` WHERE description = 'whenregister' AND type = 'checkanswe'");
				if($whenregister == '1' && $checkanswer = read_static_cache('checkanswer')){
					$checkquestion['id']		= $randid = array_rand($checkanswer,1);
					$checkquestion['question']  = $checkanswer[$randid]['question'];
					$checkquestion['answer']	= $checkanswer[$randid]['answer'];
				}
				include qq3479015851_tpl($mod.'_'.$action);
			}else{
				include qq3479015851_tpl($mod);
			}
		break;
		
		case 'forgetpass':
			$uid = $uid ? intval($uid) : '';
			$code = $code ? mhtmlspecialchars($code) : '';
			if($code){
				$arr = explode('.',base64_decode($code));
				$uid = $arr[0];
				$user_info = $db -> getRow("SELECT id,userid,userpwd,email FROM `{$db_qq3479015851}member` WHERE id = '$uid'");
				
				if(($timestamp - $arr[2] < 1800) && $arr[1] == md5($user_info['id'].'+'.$user_info['userpwd'])){
					$userid = $user_info['userid'];
					$uid = $user_info['id'];
					$email = $user_info['email'];
					globalassign();
					include qq3479015851_tpl($mod.'_3');
				} else {
					$status = 'error';
					$msg = '该密码重设链接已失效！';
					globalassign();
					include qq3479015851_tpl(qq3479015851_tpl($mod.'_4'));
				}
			} else {
				$qq3479015851_imgcode = $authcodesettings['forgetpass'];
				globalassign();
				include qq3479015851_tpl($mod);
			}
			
		break;
	}
}else{
	include QQ3479015851_MEMBER.'/include/'.$mod.'.inc.php';
}

is_object($db) && $db->Close();
$city = $maincity = NULL;
unset($city,$maincity);
?>