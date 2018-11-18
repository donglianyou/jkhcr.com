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
function is_qq($qq)
{
	if (ereg('^[1-9][0-9]{4,}$', $qq)) {
		return true;
	}
	else {
		return false;
	}
}

function is_email($C_mailaddr)
{
	if (!(eregi('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*$', $C_mailaddr))) {
		return false;
	}

	return true;
}

function is_www($C_weburl)
{
	if (!(ereg('^http://[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$', $C_weburl))) {
		return false;
	}

	return true;
}

function is_pwd($C_passwd)
{
	if (!(CheckLengthBetween($C_passwd, 4, 20))) {
		return false;
	}

	if (!(ereg('^[_a-zA-Z0-9]*$', $C_passwd))) {
		return false;
	}

	return true;
}

function is_tel($C_telephone)
{
	if (!(ereg('^[+]?[0-9]+([xX-][0-9]+)*$', $C_telephone))) {
		return false;
	}

	return true;
}


?>
