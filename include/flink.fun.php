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
function flink_pr()
{
	$flink_pr = array('0', '1', '2', '3', '3-10');
	return $flink_pr;
}

function flink_dayip()
{
	$flink_dayip = array('1000以下', '1000以上');
	return $flink_dayip;
}

function apply_flink_pr($pr = '')
{
	$flink_pr = flink_pr();

	foreach ($flink_pr as $k => $value ) {
		$str .= '<input type="radio" name="pr" value="' . $value . '" style="border:0" class="li"';
		$str .= ($value == $pr ? 'checked ' : '');
		$str .= '>' . $value;
	}

	return $str;
}

function apply_flink_dayip($dayip = '')
{
	$flink_dayip = flink_dayip();

	foreach ($flink_dayip as $k => $value ) {
		$str .= '<input type="radio" name="dayip" value="' . $value . '" style="border:0" class="li"';
		$str .= ($value == $dayip ? 'checked ' : '');
		$str .= '>' . $value;
	}

	return $str;
}

function webtype_option($typeid = '')
{
	$alltype = $GLOBALS['db']->getAll('SELECT * FROM ' . $GLOBALS['db_qq3479015851'] . 'flink_type ORDER BY id Asc');

	foreach ($alltype as $row ) {
		$return .= '<option value=' . $row[id];
		$return .= ($row[id] == $typeid ? 'selected style=\'background-color:#6EB00C;color:white\'' : '');
		$return .= '>' . $row[typename] . '</option>';
	}

	return $return;
}


?>
