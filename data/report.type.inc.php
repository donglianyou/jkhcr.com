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

$report_type_arr = array();
$report_type_arr[1] = '违法信息';
$report_type_arr[2] = '分类错误';
$report_type_arr[3] = '虚假信息';
$report_type_arr[4] = '其它原因';
function get_report_type()
{
	global $report_type_arr;
	$SystemGlobalcfm .= '<select name=\'report_type\'>';

	foreach ($report_type_arr as $k => $value ) {
		$SystemGlobalcfm .= '<option value="' . $k . '">' . $value . '</option>';
	}

	$SystemGlobalcfm .= '</select>';
	return $SystemGlobalcfm;
}


?>
