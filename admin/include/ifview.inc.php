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
$if_view = array(2 => '<font color=green>启用</font>', 1 => '<font color=red>不启用</font>');
function get_ifview_options($isview = '')
{
	global $if_view;

	foreach ($if_view as $key => $value ) {
		$qq3479015851 .= '<option value=' . $key;
		$qq3479015851 .= ($isview == $key ? ' style = "background-color:#6EB00C;color:white" selected>' : '>');
		$qq3479015851 .= $value . '</option>';
	}

	return $qq3479015851;
}


?>
