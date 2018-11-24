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
if (!defined('SysGlbCfm')) {
	exit('FORBIDDEN');
}

$information_level = array();
$information_level[0] = '<font color=red>待审</font>';
$information_level[1] = '<font color=#006acd>正常</font>';
$information_level[2] = '<font color=green>推荐</font>';
$info_upgrade_time = array();
$info_upgrade_time[1] = '1天';
$info_upgrade_time[7] = '7天';
$info_upgrade_time[30] = '30天';
$info_upgrade_time[90] = '90天';
$info_upgrade_time[365] = '365天';
$news_level = array();
$news_level[1] = '<font color=#006acd>正常</font>';
$news_level[2] = '<font color=green>推荐</font>';
function GetInfoLevel($level = '', $formname = 'info_level')
{
	global $information_level;
	$SystemGlobalcfm .= '<select name=\'' . $formname . '\' id=\'' . $formname . '\'>';
	$SystemGlobalcfm .= '<option value = "">请选择信息属性</option>';

	foreach ($information_level as $k => $v ) {
		if ($k == $level) {
			$SystemGlobalcfm .= '<option value=\'' . $k . '\' selected style=\'background-color:#6EB00C;color:white\'>' . $v . '</option>' . "\r\n";
		}
		else {
			$SystemGlobalcfm .= '<option value=\'' . $k . '\'>' . $v . '</option>' . "\r\n";
		}
	}

	$SystemGlobalcfm .= '</select>' . "\r\n";
	return $SystemGlobalcfm;
}

function GetUpgradeTime($time = '', $formname = 'upgrade_time')
{
	global $info_upgrade_time;
	$SystemGlobalcfm .= '<select name=\'' . $formname . '\' id=\'' . $formname . '\'>';

	foreach ($info_upgrade_time as $k => $v ) {
		if ($k == $time) {
			$SystemGlobalcfm .= '<option value=\'' . $k . '\' selected style=\'background-color:#6EB00C;color:white\'>' . $v . '</option>' . "\r\n";
		}
		else {
			$SystemGlobalcfm .= '<option value=\'' . $k . '\'>' . $v . '</option>' . "\r\n";
		}
	}

	$SystemGlobalcfm .= '</select>' . "\r\n";
	return $SystemGlobalcfm;
}

function GetNewsLevel($level = '', $formname = 'news_level')
{
	global $news_level;
	$SystemGlobalcfm .= '<select name=\'' . $formname . '\' id=\'' . $formname . '\'>';
	$SystemGlobalcfm .= '<option value = "">请选择新闻属性</option>';

	foreach ($news_level as $k => $v ) {
		if ($k == $level) {
			$SystemGlobalcfm .= '<option value=\'' . $k . '\' selected style=\'background-color:#6EB00C;color:white\'>' . $v . '</option>' . "\r\n";
		}
		else {
			$SystemGlobalcfm .= '<option value=\'' . $k . '\'>' . $v . '</option>' . "\r\n";
		}
	}

	$SystemGlobalcfm .= '</select>' . "\r\n";
	return $SystemGlobalcfm;
}


?>
