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
if (!(defined('SysGlbCfm'))) {
	exit('FORBIDDEN');
}
function inject_check($sql_str)
{
	return eregi('select|insert|update|delete|\'|\\/\\*|\\*|\\.\\.\\/|\\.\\/|union|into|load_file|outfile', $sql_str);
}

function verify($id = NULL, $type)
{
	if (inject_check($id)) {
		write_msg('', $global[SiteUrl] . '/index.php');
	}

	$id = intval($id);
	$id = ($id ? $id : $type);
	return $id;
}

function qq3479015851_str_check($str)
{
	$str = trim($str);

	if (!(get_magic_quotes_gpc())) {
		$str = addslashes($str);
	}

	$str = str_replace('%', '\\%', $str);
	return $str;
}

function qq3479015851_post_check($post)
{
	if (!(get_magic_quotes_gpc())) {
		$post = addslashes($post);
	}

	$post = str_replace('_', '\\_', $post);
	$post = str_replace('%', '\\%', $post);
	$post = htmlspecialchars($post);
	$post = str_replace("\n", '<br>', str_replace(' ', '&nbsp;', $post));
	return $post;
}


?>
