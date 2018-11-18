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
function mail_template_list()
{
	static $res;

	if ($res === NULL) {
		$data = read_static_cache('mail_template');

		if ($data == false) {
			$query = $GLOBALS['db']->query('SELECT * FROM `' . $GLOBALS['db_qq3479015851'] . 'mail_template` ORDER BY template_id DESC');

			while ($row = $GLOBALS['db']->fetchRow($query)) {
				$re[$row['template_code']]['template_id'] = $row['template_id'];
				$re[$row['template_code']]['is_sys'] = $row['is_sys'];
				$re[$row['template_code']]['template_code'] = $row['template_code'];
				$re[$row['template_code']]['is_html'] = $row['is_html'];
				$re[$row['template_code']]['template_subject'] = $row['template_subject'];
				$re[$row['template_code']]['template_content'] = $row['template_content'];
				$re[$row['template_code']]['last_modify'] = $row['last_modify'];
				$re[$row['template_code']]['last_send'] = $row['last_send'];
				$re[$row['template_code']]['is_html'] = $row['is_html'];
				$res = $re;
			}

			write_static_cache('mail_template', $res);
		}
		else {
			$res = $data;
		}
	}

	return $res;
}

function get_mail_setting()
{
	global $db;
	global $db_qq3479015851;
	static $res;

	if ($res === NULL) {
		$data = read_static_cache('mail_config');

		if ($data == false) {
			$re = $db->query('SELECT * FROM `' . $db_qq3479015851 . 'config` WHERE type=\'mail\'');

			while ($row = $db->fetchRow($re)) {
				$res[$row['description']] = $row['value'];
			}

			write_static_cache('mail_config', $res);
		}
		else {
			$res = $data;
		}
	}

	return $res;
}

function write_mail_sendrecord($email_to, $email_subject, $email_content, $error, $template_id)
{
	global $timestamp;
	$GLOBALS['db']->query('INSERT INTO `' . $GLOBALS['db_qq3479015851'] . 'mail_sendlist` (email,email_subject,email_content,error,last_send,template_id)VALUES(\'' . $email_to . '\',\'' . $email_subject . '\',\'' . $email_content . '\',\'' . $error . '\',\'' . $timestamp . '\',\'' . $template_id . '\')');
}

function send_email($email_to, $mail_subject, $mail_body, $mail_type = 'html', $template_id = '')
{
	$mail_cfg = get_mail_setting();

	if ($mail_cfg['mail_service'] == 'mail') {
		if (@mail($email_to, $mail_subject, $mail_body)) {
			write_mail_sendrecord($email_to, $mail_subject, $mail_body, 0, $template_id);
			return true;
		}
		else {
			write_mail_sendrecord($email_to, $mail_subject, $mail_body, 1, $template_id);
			return false;
		}
	}
	else if ($mail_cfg['mail_service'] == 'smtp') {
		require_once QQ3479015851_INC . '/email.class.php';
		$smtp = new smtp($mail_cfg['smtp_server'], $mail_cfg['smtp_serverport'], true, $mail_cfg['mail_user'], $mail_cfg['mail_pass']);
		$smtp->debug = false;

		if ($smtp->sendmail($email_to, $mail_cfg['smtp_mail'], $mail_subject, $mail_body, $mail_type)) {
			$error = 0;
		}
		else {
			$error = 1;
		}

		write_mail_sendrecord($email_to, $mail_subject, $mail_body, $error, $template_id);
		return $error == 0 ? true : false;
	}
	else if ($mail_cfg['mail_service'] == 'no') {
		return false;
	}
}

function send_pwd_email($uid, $userid, $email, $code)
{
	global $db;
	global $db_qq3479015851;
	global $qq3479015851_global;
	global $timestamp;
	$mailtmp = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'mail_template` WHERE template_id = \'1\'');

	if (empty($mailtmp)) {
		return false;
	}
	else {
		$mail_subject = $qq3479015851_global['SiteName'] . '密码修改';
		$code = $qq3479015851_global['SiteUrl'] . '/' . $qq3479015851_global['cfg_member_logfile'] . '?mod=forgetpass&code=' . $code;
		$mail_body = $mailtmp['template_content'];
		$mail_body = str_replace(array('{$user_name}', '{$reset_email}', '{$site_name}', '{$send_date}'), array($userid, $code, $qq3479015851_global['SiteName'], GetTime($timestamp)), $mail_body);
		return send_email($email, $mail_subject, $mail_body, 'html', 1);
	}
}

function send_validate_email($uid, $userid, $email, $code)
{
	global $db;
	global $db_qq3479015851;
	global $qq3479015851_global;
	global $timestamp;
	$mailtmp = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'mail_template` WHERE template_id = \'2\'');

	if (empty($mailtmp)) {
		return false;
	}
	else {
		$mail_subject = $qq3479015851_global['SiteName'] . '用户验证';
		$code = $qq3479015851_global['SiteUrl'] . '/' . $qq3479015851_global['cfg_member_logfile'] . '?mod=validate&code=' . $code;
		$mail_body = $mailtmp['template_content'];
		$mail_body = str_replace(array('{$user_name}', '{$validate_email}', '{$site_name}', '{$send_date}'), array($userid, $code, $qq3479015851_global['SiteName'], GetTime($timestamp)), $mail_body);
		return send_email($email, $mail_subject, $mail_body, 'html', 1);
	}
}


?>
