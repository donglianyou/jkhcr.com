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
function write_money_use($info = '', $cost = '')
{
	global $db;
	global $db_qq3479015851;
	global $s_uid;
	global $timestamp;
	$timestamp = ($timestamp ? $timestamp : time());

	if ($db->query('INSERT INTO `' . $db_qq3479015851 . 'member_record_use` (userid,paycost,subject,pubtime) VALUES (\'' . $s_uid . '\',\'' . $cost . '\',\'' . $info . '\',\'' . $timestamp . '\')')) {
		return true;
	}
	else {
		return false;
	}
}

function member_reg($userid, $userpwd, $email = '', $safequestion = '', $safeanswer = '', $openid = '', $cname = '', $status = '', $openid_wx = '', $logo = '', $prelogo = '')
{
	global $SystemGlobalcfm_global;
	global $db;
	global $db_qq3479015851;
	global $member_log;
	global $timestamp;

	if ($openid) {
		if ($db->getOne('SELECT id FROM `' . $db_qq3479015851 . 'member` WHERE openid = \'' . $openid . '\'')) {
			write_msg('openid已重复!请重新完善帐号信息！');
		}
	}

	if ($openid_wx) {
		if ($db->getOne('SELECT id FROM `' . $db_qq3479015851 . 'member` WHERE openid_wx = \'' . $openid_wx . '\'')) {
			write_msg('openid已重复!请重新完善帐号信息！');
		}
	}

	$ip = GetIP();
	$safeanswer = trim($safeanswer);
	$row = $db->getRow('SELECT money_own FROM `' . $db_qq3479015851 . 'member_level` WHERE id = \'1\'');
	$money_own = $row['money_own'];
	$status = (($status == 1) || ($SystemGlobalcfm_global['cfg_member_verify'] == 1) || ($SystemGlobalcfm_global['cfg_member_verify'] == 4) ? 1 : 0);
	$sql = 'INSERT INTO `' . $db_qq3479015851 . 'member`(id,userid,userpwd,logo,prelogo,email,safequestion,safeanswer,levelid,joinip,loginip,jointime,logintime,money_own,openid,openid_wx,cname,status) VALUES (\'\',\'' . $userid . '\',\'' . $userpwd . '\',\'' . $logo . '\',\'' . $prelogo . '\',\'' . $email . '\',\'' . $safequestion . '\',\'' . $safeanswer . '\',\'1\',\'' . $ip . '\',\'' . $ip . '\',\'' . $timestamp . '\',\'' . $timestamp . '\',\'' . $money_own . '\',\'' . $openid . '\',\'' . $openid_wx . '\',\'' . $cname . '\',\'' . $status . '\')';
	$db->query($sql);
}

function sendpm($fromuser = '', $touser = '', $title = '', $content = '', $if_sys = 0)
{
	global $db;
	global $db_qq3479015851;
	global $timestamp;
	$fromuser = ($fromuser ? mhtmlspecialchars($fromuser) : '');
	$touser = ($touser ? mhtmlspecialchars($touser) : '');
	$title = ($title ? mhtmlspecialchars($title) : '');
	$content = ($content ? $content : '');
	$pubtime = ($timestamp ? $timestamp : time());
	$result = array();
	$title = str_replace('\'', '"', $title);
	$content = str_replace('\'', '"', $content);
	empty($title) && ($title = substring($content, 0, 15));

	if (empty($touser)) {
		exit('请指定要发短消息的用户名');
	}

	if (empty($content) || ($fromuser == $touser)) {
		$result['succ'] = 'no';
		$result['member'] = $touser;
		return $result;
		exit();
	}

	if (!$ifuser = $db->getOne('SELECT userid FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $touser . '\'')) {
		$result['succ'] = 'no';
		$result['member'] = $touser;
	}
	else {
		$db->query('INSERT INTO `' . $db_qq3479015851 . 'member_pm` (title,content,fromuser,touser,pubtime,if_sys) VALUES (\'' . $title . '\',\'' . $content . '\',\'' . $fromuser . '\',\'' . $touser . '\',\'' . $pubtime . '\',\'' . $if_sys . '\')');
		$result['succ'] = 'yes';
		$result['member'] = $touser;
	}

	return $result;
}


?>
