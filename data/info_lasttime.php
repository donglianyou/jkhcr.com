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
	exit('FORBIDDEN');
}

$info_lasttime = array();
$info_lasttime[0] = '长期有效';
$info_lasttime[7] = '一周';
$info_lasttime[30] = '一个月';
$info_lasttime[60] = '二个月';
$info_lasttime[365] = '一年';
function GetInfoLastTime($lasttime = '', $formname = 'endtime', $type = 'pc')
{
	global $info_lasttime;
	$info_lasttime_form = '<select name=\'' . $formname . '\' id=\'' . $formname . '\' ' . ($type == 'pc' ? 'class="input" require="true" datatype="limit"' : '') . ' msg="请选择信息的有效期限">';
	$info_lasttime_form .= '<option value=\'\'>请选择有效期限</option>';

	foreach ($info_lasttime as $k => $v ) {
		if ($k == $lasttime) {
			$info_lasttime_form .= '<option value=\'' . $k . '\' selected>' . $v . '</option>' . "\r\n";
		}
		else {
			$info_lasttime_form .= '<option value=\'' . $k . '\'>' . $v . '</option>' . "\r\n";
		}
	}

	$info_lasttime_form .= '</select>' . "\r\n";
	return $info_lasttime_form;
}


?>
