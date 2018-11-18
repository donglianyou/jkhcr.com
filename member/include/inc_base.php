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
	exit('Forbidden');
}

if ($ac == 'nobind') {
	$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET openid = \'\' ' . $where);
	write_msg('', 'index.php?m=base&success=15');
}

if (submit_check('base_submit')) {
	$isemail = (isset($_POST['isemail']) ? intval($_POST['isemail']) : '');
	$isqq = (isset($_POST['isqq']) ? intval($_POST['isqq']) : '');
	$istel = (isset($_POST['istel']) ? intval($_POST['istel']) : '');
	$mobile = (isset($_POST['mobile']) ? trim(mhtmlspecialchars($_POST['mobile'])) : '');
	$cname = (isset($_POST['cname']) ? trim(mhtmlspecialchars($_POST['cname'])) : '');
	$qq = (isset($_POST['qq']) ? trim(mhtmlspecialchars($_POST['qq'])) : '');
	$email = (isset($_POST['email']) ? trim(mhtmlspecialchars($_POST['email'])) : '');
	$url = (isset($_POST['url']) ? trim(mhtmlspecialchars($_POST['url'])) : '');
	$sex = (isset($_POST['sex']) ? trim(mhtmlspecialchars($_POST['sex'])) : '');
	($isemail == 1) && $db->query('UPDATE `' . $db_qq3479015851 . 'information` SET email = \'' . $email . '\' ' . $where);
	($isqq == 1) && $db->query('UPDATE `' . $db_qq3479015851 . 'information` SET qq = \'' . $qq . '\' ' . $where);
	($istel == 1) && $db->query('UPDATE `' . $db_qq3479015851 . 'information` SET tel = \'' . $mobile . '\' ' . $where);
	if (($email == '') && ($qq == '') && ($tel == '')) {
		write_msg('', '?m=base&error=11');
	}

	$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET qq = \'' . $qq . '\', mobile = \'' . $mobile . '\' ,cname = \'' . $cname . '\', email = \'' . $email . '\' , sex = \'' . $sex . '\'  ' . $where);
	write_msg('', $url ? $url : '?m=base&success=1');
}
else {
	$location = location();
	include qq3479015851_tpl('base');
}

?>
