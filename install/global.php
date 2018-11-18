<?php

if (!defined('QQ3479015851')) {
	exit('FORBIDDEN');
}

@define('QQ3479015851_ROOT', ereg_replace('[/\\]{1,}', '/', substr(dirname(__FILE__), 0, -8)));
define('QQ3479015851_INC', QQ3479015851_ROOT . '/include');
define('QQ3479015851_DATA', QQ3479015851_ROOT . '/data');
define('QQ3479015851_MEMBER', QQ3479015851_ROOT . '/member');
define('QQ3479015851_UPLOAD', QQ3479015851_ROOT . '/attachment');
define('QQ3479015851_TPL', QQ3479015851_ROOT . '/template');
define('QQ3479015851_ASS', QQ3479015851_INC . '/assign');
require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_DATA . '/config.php';
require_once QQ3479015851_INC . '/common.fun.php';
function str_len($str)
{
	$length = strlen(preg_replace('/[\\x00-\\x7F]/', '', $str));

	if ($length) {
		return (strlen($str) - $length) + (intval($length / 3) * 2);
	}
	else {
		return strlen($str);
	}
}

function addslashes_deep($value)
{
	return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
}

function new_htmlspecialchars($value)
{
	$value = (is_array($value) ? array_map('new_htmlspecialchars', $value) : htmlspecialchars($value, ENT_QUOTES));
	return $value;
}

function write_lock()
{
	$file = @fopen(QQ3479015851_DATA . '/install.lock', 'wb+');

	if (!$file) {
		exit('打开文件失败');
		return false;
	}

	if (!@fwrite($file, 'QQ3479015851_INSTALLED')) {
		exit('写入文件失败');
		return false;
	}

	@fclose($fp);
}

function part_version($sql, $db_charset)
{
	$type = strtoupper(preg_replace('/^\\s*CREATE TABLE\\s+.+\\s+\\(.+?\\).*(ENGINE|TYPE)\\s*=\\s*([a-z]+?).*$/isU', '\\2', $sql));
	$type = (in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM');
	return preg_replace('/^\\s*(CREATE TABLE\\s+.+\\s+\\(.+?\\)).*$/isU', '\\1', $sql) . ('4.1' < mysql_get_server_info() ? ' ENGINE=' . $type . ' DEFAULT CHARSET=' . $db_charset : ' TYPE=' . $type);
}

function import($sql, $table, $db_charset)
{
	global $db;
	$fp = fopen($sql, 'rb');
	$sql = fread($fp, filesize($sql));
	fclose($fp);
	$sql = str_replace("\r", "\n", str_replace(' `my_', ' `' . $table, $sql));
	$sql = str_replace("\r", "\n", $sql);
	$sql = explode(';' . "\n", trim($sql));

	foreach ($sql as $key ) {
		$key = trim($key);

		if ($key) {
			if (substr($key, 0, 12) == 'CREATE TABLE') {
				$db->query(part_version($key, $db_charset));
			}
			else {
				$db->query($key);
			}
		}
		else {
			return false;
		}
	}

	return true;
	exit();
}

function chk_qq3479015851_install()
{
	if (file_exists(QQ3479015851_DATA . '/install.lock')) {
		exit('很抱歉，您已经安装过QQ3479015851！<br /><br />如需重新安装，请删除/data目录下的install.lock');
	}
}

function openfile($url)
{
	$str = '';
	$i = 0;
	$f = @file($url);

	while ($i < count($f)) {
		$str = $str . $f[$i] . '<br>';
		$i = $i + 1;
	}

	return $str;
}

function get_inurl()
{
	$php_self = ($_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);
	$php_domain = $_SERVER['SERVER_NAME'];
	$php_agent = $_SERVER['HTTP_USER_AGENT'];
	$php_referer = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
	$php_scheme = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://');
	$php_reuri = (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
	$php_port = ($_SERVER['SERVER_PORT'] == '80' ? '' : ':' . $_SERVER['SERVER_PORT']);
	$host_url = $php_scheme . $php_domain . $php_port;
	$site_url = $host_url . substr($php_self, 0, strrpos($php_self, '/'));
	$site_url = str_replace('/install', '', $site_url);
	return $site_url;
}


?>
