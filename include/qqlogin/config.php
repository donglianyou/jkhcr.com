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
define('QQLOGIN', 1);
$data = NULL;
require_once dirname(__FILE__) . '/../../data/caches/qqlogin.php';
$_SESSION['appid'] = $data['appid'];
$_SESSION['appkey'] = $data['appkey'];
$_SESSION['callback'] = $data['callback'];
$_SESSION['scope'] = ($data['scope'] ? $data['scope'] : 'get_user_info');
unset($data);
function qq_login($appid, $scope, $callback)
{
	$_SESSION['state'] = md5(uniqid(rand(), true));
	$login_url = 'https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=' . $appid . '&redirect_uri=' . urlencode($callback) . '&state=' . $_SESSION['state'] . '&scope=' . $scope;
	header('Location:' . $login_url);
}

function do_post($url, $data)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_URL, $url);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}


?>
