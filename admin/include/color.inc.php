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
$color = array('#ff0000' => '红色', '#006ffd' => '深蓝', '#444444' => '浅蓝', '#000000' => '黑色', '#46a200' => '绿色', '#ffff00' => '黄色', '#ffffff' => '白色');
function get_color_options($tcolor = '')
{
	global $color;

	foreach ($color as $k => $v ) {
		$SystemGlobalcfm .= '<option value=' . $k . ' style=background-color:' . $k;

		if ($k == $tcolor) {
			$SystemGlobalcfm .= ' selected';
		}

		$SystemGlobalcfm .= '>' . $v . '</option>';
	}

	return $SystemGlobalcfm;
}


?>
