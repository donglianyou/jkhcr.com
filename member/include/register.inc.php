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
if (!defined('QQ3479015851')) {
	exit('Forbidden');
}

($qq3479015851_global['cfg_if_member_register'] != 1) && write_msg('操作失败！系统管理员关闭了新会员注册！');
if (!$mixcode || ($mixcode != md5($cookiepre))) {
	exit('您请求的来路不正确');
	exit();
}

$userid = ($userid ? mhtmlspecialchars($userid) : '');
$userpwd = trim($userpwd);
$reuserpwd = trim($reuserpwd);
$email = ($email ? mhtmlspecialchars($email) : '');
$tname = ($tname ? mhtmlspecialchars($tname) : '');
$cname = ($cname ? mhtmlspecialchars($cname) : '');
$sex = ($sex ? mhtmlspecialchars($sex) : '');
$tel = ($tel ? mhtmlspecialchars($tel) : '');
$fax = ($fax ? mhtmlspecialchars($fax) : '');
$address = ($address ? mhtmlspecialchars($address) : '');
$smscheckcode = ($smscheckcode ? intval($smscheckcode) : '');
$cityid = intval($cityid);
$areaid = intval($areaid);
$streetid = intval($streetid);
$qq = mhtmlspecialchars($qq);
$mobile = mhtmlspecialchars($mobile);
$introduce = ($introduce ? textarea_post_change($introduce) : '');
$ip = '';
$ip = GetIP();
$ip2area = $ipdata = '';
require_once QQ3479015851_INC . '/ip.class.php';
$ipdata = new ip();
$ipaddress = $ipdata->getaddress($ip);
$ip2area = $ipaddress['area1'] . $ipaddress['area2'];
$i = 1;
unset($ipdata);
unset($ipaddress);
$qq3479015851_global['cfg_member_regplace'] = ($qq3479015851_global['cfg_member_regplace'] ? str_replace('，', ',', $qq3479015851_global['cfg_member_regplace']) : '');
if (!empty($qq3479015851_global['cfg_member_regplace']) && !empty($ip2area)) {
	$allow_reg_area = array();
	$allow_reg_area = explode(',', $qq3479015851_global['cfg_member_regplace']);

	foreach ($allow_reg_area as $k => $v ) {
		if (strstr($ip2area, $v)) {
			$i = $i + 1;
		}
	}

	if ($i == 1) {
		write_msg('系统管理员已限制为<b style=\'color:red\'>' . $qq3479015851_global['cfg_member_regplace'] . '</b>本地IP，方能注册! <br />如果您要继续操作，请联系客服。', 'olmsg');
		exit();
	}

	unset($allow_reg_area);
	unset($ip2area);
	unset($i);
}

if (!empty($qq3479015851_global['cfg_forbidden_reg_ip'])) {
	foreach (explode(',', $qq3479015851_global['cfg_forbidden_reg_ip']) as $ctrlip ) {
		if (preg_match('/^(' . preg_quote($ctrlip = trim($ctrlip), '/') . ')/', $ip)) {
			$ctrlip = $ctrlip . '%';
			write_msg('您当前的IP <b style=\'color:red\'>' . $ip . '</b> 已被管理员加入黑名单，不允许注册网站会员！');
			exit();
		}
	}

	unset($ctrlip);
}

if (($authcodesettings['register'] == 1) && empty($activation) && !$randcode = qq3479015851_chk_randcode($checkcode)) {
	write_msg('验证码输入错误，请返回重新输入');
}

($reuserpwd != $userpwd) && empty($activation) && write_msg('你两次输入的密码不一致！');
$data = '';
@include QQ3479015851_DATA . '/caches/checkanswer_settings.php';

if (is_array($data)) {
	$whenregister = $data['whenregister'];
	$result = read_static_cache('checkanswer');
	if (($whenregister == '1') && is_array($result)) {
		if (!is_array($checkquestion) || empty($checkquestion['answer']) || empty($checkquestion['id'])) {
			write_msg('您还没有输入验证问题！');
		}

		if ($result[$checkquestion['id']]['answer'] != $checkquestion['answer']) {
			write_msg('您输入的验证问题答案不正确，请重新输入！');
		}
	}

	$result = $checkquestion = NULL;
}

if ($qq3479015851_global['cfg_member_verify'] == '4') {
	if (!$mobile) {
		write_msg('请输入您的手机号码!');
	}

	if (!is_mobile($mobile)) {
		write_msg('手机号格式不正确!');
	}

	if (0 < $db->getOne('SELECT COUNT(id) FROM `' . $db_qq3479015851 . 'member` WHERE mobile = \'' . $mobile . '\'')) {
		write_msg('该手机号已被注册请换一个手机号！');
	}

	if (!qq3479015851_chk_smsrandcode($smscheckcode, $mobile)) {
		write_msg('手机验证码输入不正确或与手机号不匹配！');
	}

	$userid = 'sj_' . $timestamp . rand(0, 100);
}

if (($reg_corp == '1') && (empty($tname) || empty($catid) || empty($cname))) {
	write_msg('带<font color=red>*</font>项为必填项，请认真填写！');
}

if (PASSPORT_TYPE == 'phpwind') {
	require QQ3479015851_ROOT . '/pw_client/uc_client.php';
	$checkuser = uc_check_username($userid);

	if ($checkuser == -2) {
		write_msg('用户名重复，请换一个用户名注册');
	}
	else if ($checkuser == -1) {
		write_msg('用户名不符合规范，请换一个用户名注册');
	}
	else if ($checkuser == 1) {
	}
	else {
		write_msg('未知错误，请换一个用户名注册');
	}

	if ($email) {
		$checkemail = uc_check_email($email);
		($checkemail == -3) && write_msg('Email格式不正确，请填写正确的Email');
		($checkemail == -4) && write_msg('该Email地址已重复，请更换一个Email地址');
	}

	uc_user_register($userid, md5($userpwd), $email);
}
else if (PASSPORT_TYPE == 'ucenter') {
	require QQ3479015851_ROOT . '/uc_client/client.php';
	if ($activation && ($activeuser = uc_get_user($activation))) {
		$userid = $activeuser[1];
		$uid = $activeuser[0];
	}
	else {
		$user = $db->getRow('SELECT id,userid FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $userid . '\'');
		if (uc_get_user($userid) && !$user['userid']) {
			write_msg('该用户无需注册，请重新登录', $qq3479015851_global[SiteUrl] . '/' . $qq3479015851_global['cfg_member_logfile']);
		}

		$email = ($email ? $email : $mobile . '@139.com');
		$uid = uc_user_register($userid, $userpwd, $email);

		if ($uid <= 0) {
			if ($uid == -1) {
				write_msg('用户名不合法');
			}
			else if ($uid == -2) {
				write_msg('包含不允许注册的词语');
			}
			else if ($uid == -3) {
				write_msg('用户名已经存在');
			}
			else if ($uid == -4) {
				write_msg('Email 格式有误');
			}
			else if ($uid == -5) {
				write_msg('Email 不允许注册');
			}
			else if ($uid == -6) {
				write_msg('该 Email 已经被注册');
			}
			else {
				write_msg('未定义');
			}
		}
		else {
			$userid = trim($userid);
			$userpwd = trim($userpwd);
			$email = trim($email);
		}
	}
}
else {
	$rs = CheckUserID($userid, '用户名');
	($rs != 'ok') && write_msg($rs);
	(20 < strlen($userid)) && write_msg('您的用户名多于20个字符，不允许注册！');
	((strlen($userid) < 3) || (strlen($userpwd) < 5)) && write_msg('你的用户名或密码过短(不能少于3个字符)，不允许注册！');
	$db->getOne('SELECT id FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $userid . '\' ') && write_msg('你指定的用户名 ' . $userid . ' 已存在，请使用别的用户名！');
}

if ($userid) {
	require QQ3479015851_INC . '/email.fun.php';
	$score_change = get_credit_score();
	$score_changer = $score_change['score']['rank']['register'];
	$score_changer = ($score_changer === 0 ? ' +0' : $score_changer);
	member_reg($userid, md5($userpwd), $email, $safequestion, $safeanswer, $openid, $cname);
	$uid = $db->insert_id();
	$money_own = $db->getOne('SELECT money_own FROM `' . $db_qq3479015851 . 'member_level` WHERE id = \'1\'');
	$money_own = ($money_own ? $money_own : 0);

	if ($reg_corp == 1) {
		if (is_array($catid)) {
			foreach ($catid as $kids => $vids ) {
				$db->query('INSERT INTO `' . $db_qq3479015851 . 'member_category` (userid,catid)VALUES(\'' . $userid . '\',\'' . $vids . '\')');
			}

			$catids = implode(',', $catid);
		}

		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET tname = \'' . $tname . '\' , cname = \'' . $cname . '\', catid = \'' . $catids . '\',cityid=\'' . $cityid . '\',areaid = \'' . $areaid . '\',qq = \'' . $qq . '\' , if_corp = \'1\' ,tel = \'' . $tel . '\' , mobile = \'' . $mobile . '\', money_own = \'' . $money_own . '\' ,introduce = \'' . $introduce . '\',address = \'' . $address . '\' ,score = score' . $score_changer . '  WHERE userid = \'' . $userid . '\'');
	}
	else {
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET mobile=\'' . $mobile . '\',money_own = \'' . $money_own . '\',score = score' . $score_changer . ' WHERE userid = \'' . $userid . '\'');
	}

	$score_change = $score_changer = NULL;
	if ($qq3479015851_global['cfg_member_reg_title'] && $qq3479015851_global['cfg_member_reg_content']) {
		$title = str_replace('{username}', $userid, $qq3479015851_global['cfg_member_reg_title']);
		$content = str_replace('{sitename}', $qq3479015851_global['SiteName'], $qq3479015851_global['cfg_member_reg_content']);
		$content = str_replace('{time}', GetTime($timestamp), $content);
		$content = str_replace('{username}', $userid, $content);
		sendpm('admin', $userid, $title, $content, 1);
	}

	$fromuid = mgetcookie('fromuid');
	$fromip = mgetcookie('fromip');
	if ($fromuid && ($qq3479015851_global['cfg_if_affiliate'] == 1)) {
		$fromuid = intval($fromuid);
		$fromip = trim($fromip);
		$score_changer = '+' . $qq3479015851_global['cfg_affiliate_score'];
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET score = score' . $score_changer . ' WHERE id = \'' . $fromuid . '\'');
	}

	if ($qq3479015851_global['cfg_member_verify'] == 3) {
		$code = base64_encode($uid . '.' . md5($uid . '+' . md5($userpwd)) . '.' . $timestamp);
		$webmail = NULL;

		if (send_validate_email($uid, $userid, $email, $code)) {
			$error = '2';
			$mailweb = explode('@', $email);
			$mailweb = strtoupper($mailweb[1]);

			switch ($mailweb) {
			case 'QQ.COM':
				$webmail = 'http://mail.qq.com';
				$webname = 'QQ邮箱';
				break;

			case '163.COM':
				$webmail = 'http://mail.163.com';
				$webname = '163邮箱';
				break;

			case '126.COM':
				$webmail = 'http://www.126.com';
				$webname = '126邮箱';
				break;

			case '188.COM':
				$webmail = 'http://www.188.com';
				$webname = '188邮箱';
				break;

			case 'YEAH.NET':
				$webmail = 'http://www.yeah.net';
				$webname = '网易yeah邮箱';
				break;

			case 'ALIYUN.COM':
				$webmail = 'http://mail.aliyun.com';
				$webname = '阿里云邮箱';
				break;

			case 'GMAIL.COM':
				$webmail = 'http://www.gmail.com';
				$webname = 'Gmail邮箱';
				break;

			case 'SOHU.COM':
				$webmail = 'http://mail.sohu.com';
				$webname = '搜狐邮箱';
				break;

			case 'SINA.COM.CN':
				$webmail = 'http://mail.sina.com.cn';
				$webname = '新浪邮箱';
				break;

			case 'SINA.NET':
				$webmail = 'http://mail.sina.net';
				$webname = '新浪邮箱';
				break;

			case 'FOXMAIL.COM':
				$webmail = 'http://mail.foxmail.com';
				$webname = 'foxmail邮箱';
				break;

			case 'HOTMAIL.COM':
				$webmail = 'http://mail.hotmail.com';
				$webname = '微软邮箱';
				break;

			case 'LIVE.COM':
				$webmail = 'http://mail.live.com';
				$webname = '微软邮箱';
				break;
			}
		}
		else {
			$error = '1';
		}

		globalassign();
		include qq3479015851_tpl('register_2');
	}
	else if ($qq3479015851_global['cfg_member_verify'] == 2) {
		$error = '3';
		globalassign();
		include qq3479015851_tpl('register_2');
	}
	else {
		$member_log->in($userid, md5($userpwd), 'off', 'noredirect');

		if (PASSPORT_TYPE == 'phpwind') {
			$user_login = uc_user_login($userid, md5($userpwd), 0);
			$ucsynlogin = $user_login['synlogin'];
			echo $ucsynlogin;
			echo qq3479015851_goto($url ? $url : $qq3479015851_global['SiteUrl'] . '/member/index.php');
		}
		else if (PASSPORT_TYPE == 'ucenter') {
			list($uid, $username, $password, $email) = uc_user_login($userid, $userpwd);
			echo uc_user_synlogin($uid);
			echo qq3479015851_goto($url ? $url : $qq3479015851_global['SiteUrl'] . '/member/index.php');
		}
		else {
			write_msg('恭喜！注册成功,现在正转入用户管理中心', $qq3479015851_global['SiteUrl'] . '/member/index.php');
		}
	}
}

?>
