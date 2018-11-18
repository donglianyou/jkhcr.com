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
/*
 * ============================================================================
 * 版权所有 114mps研发团队，保留所有权利。
 * 网站地址: http://my.roebx.com；
 * 博客教程：http://blog.csdn.net/qq_35921430；
 * ----------------------------------------------------------------------------
 * 这是一个自由软件！您可以对程序代码进行修改和使用。
 * ============================================================================
 * 程序交流QQ：3479015851
 * QQ群 ：625621054  [入群提供技术支持,升级新功能]
`*/

!(defined('QQ3479015851')) && exit('FORBIDDEN');
$member_log = new qq3479015851_member_log($cookiepre);
class qq3479015851_member_log
{
	public $cookiepre;

	public function __construct($cookiepre)
	{
		$this->cookiepre = $cookiepre;
	}

	public function qq3479015851_member_log($cookiepre)
	{
		$this->__construct($cookiepre);
	}

	public function PutLogin($s_uid = '', $s_pwd = '', $memory = '')
	{
		global $cookiepre;
		global $cookiedomain;
		global $cookiepath;
		global $timestamp;
		$timestamp = ($timestamp ? $timestamp : time());

		if ($memory == 'on') {
			msetcookie('s_uid', $s_uid, 3600 * 24 * 30);
			msetcookie('s_pwd', mmd5($s_pwd, 'EN'), 3600 * 24 * 30);
		}
		else {
			msetcookie('s_uid', $s_uid, 0);
			msetcookie('s_pwd', mmd5($s_pwd, 'EN'));
		}
	}

	public function in($s_uid = '', $s_pwd = '', $memory = '', $url = '', $type = '')
	{
		global $qq3479015851_global;
		global $uid;
		global $db_qq3479015851;
		global $db;
		global $timestamp;
		global $do;
		global $qq3479015851_qq3479015851;
		if ($s_uid && $s_pwd) {
			$this->PutLogin($s_uid, $s_pwd, $memory);
			if (($do != 'power') && !(defined('WAP'))) {
				$timestamp = ($timestamp ? $timestamp : time());
				$loginip = GetIP();

				if ($qq3479015851_qq3479015851['cfg_iflogin_port'] == 1) {
					if ($loginip) {
						require_once 'ip.class.php';
						$ipdata = new ip();
						$a = $ipdata->getaddress($loginip);
						$ip2area = $a['area1'] . $a['area2'];
						$ip2area = iconv('GB2312','UTF-8',$ip2area);
					}
					else {
						$ip2area = '';
					}

					$browser = getbrowser();
					$os = getos();
					$port = getport();
				}
				else {
					$ip2area = $browser = $os = $port = '';
				}

				$db->query('DELETE FROM `' . $db_qq3479015851 . 'member_record_login` WHERE userid = \'' . $s_uid . '\'');
				$db->query('INSERT INTO `' . $db_qq3479015851 . 'member_record_login` (id,userid,userpwd,pubdate,ip,ip2area,browser,os,port,result) VALUES (\'\',\'' . $s_uid . '\',\'' . $userpwd . '\',\'' . $timestamp . '\',\'' . $loginip . '\',\'' . $ip2area . '\',\'' . $browser . '\',\'' . $os . '\',\'' . $port . '\',\'1\')');
				$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET logintime = \'' . $timestamp . '\' WHERE userid = \'' . $s_uid . '\'');
			}

			if ($url != 'noredirect') {
				if (empty($url) && empty($type)) {
					echo qq3479015851_goto($qq3479015851_global['SiteUrl'] . '/member/index.php');
				}
				else {
					if (!(empty($url)) && empty($type)) {
						$url = urldecode($url);
						echo qq3479015851_goto($url);
					}
				}
			}
		}
	}

	public function out($url = '')
	{
		global $qq3479015851_global;
		global $db;
		global $db_qq3479015851;
		global $timestamp;
		global $s_uid;
		$s_uid = mgetcookie('s_uid');
		$s_uid = (isset($s_uid) ? addslashes($s_uid) : '');
		$timestamp = ($timestamp ? $timestamp : time());
		if ($s_uid && !(defined('WAP'))) {
			$db->query('UPDATE `' . $db_qq3479015851 . 'member_record_login` SET outdate = \'' . $timestamp . '\' WHERE userid = \'' . $s_uid . '\'');
		}

		msetcookie('s_uid', '');
		msetcookie('s_pwd', '');

		if ($url == 'noredirect') {
		}
		else if (empty($url)) {
			echo qq3479015851_goto('../index.php');
		}
		else {
			$url = urldecode($url);
			echo qq3479015851_goto($url);
		}
	}

	public function chk_in()
	{
		global $db;
		global $db_qq3479015851;
		global $s_uid;
		global $cookie;
		$s_uid = mgetcookie('s_uid');
		$s_pwd = mgetcookie('s_pwd');

		if (empty($s_uid)) {
			msetcookie('s_uid', '');
			msetcookie('s_pwd', '');
			return false;
		}
		else {
			$m = $db->getRow('SELECT userpwd,openid FROM `' . $db_qq3479015851 . 'member` WHERE userid = \'' . $s_uid . '\'');
			if ($m['openid'] && !($m['userpwd'])) {
				return true;
			}
			else {
				return mmd5($m['userpwd'], 'EN', '', $this->cookiepre) == $s_pwd ? true : false;
			}
		}
	}

	public function get_info()
	{
		global $s_uid;
		global $db;
		global $db_qq3479015851;
		$s_uid = mgetcookie('s_uid');
		return $db->getRow('SELECT * FROM ' . $db_qq3479015851 . 'member WHERE userid = \'' . $s_uid . '\'');
	}
}


?>
