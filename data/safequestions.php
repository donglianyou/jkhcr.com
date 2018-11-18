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

$safequestions = array();
$safequestions[0] = '没安全提示问题';
$safequestions[1] = '你最喜欢的格言什么？';
$safequestions[2] = '你家乡的名称是什么？';
$safequestions[3] = '你读的小学叫什么？';
$safequestions[4] = '你的父亲叫什么名字？';
$safequestions[5] = '你的母亲叫什么名字？';
$safequestions[6] = '你最喜欢的偶像是谁？';
$safequestions[7] = '你最喜欢的歌曲是什么？';
function GetSafequestion($selid = 0, $formname = 'safequestion')
{
	global $safequestions;
	$safequestions_form = '<select name=\'' . $formname . '\' id=\'' . $formname . '\'>';

	foreach ($safequestions as $k => $v ) {
		if (($k == $selid) && ($k != '0')) {
			$safequestions_form .= '<option value=\'' . $k . '\' selected style=\'background-color:#6EB00C;color:white\'>' . $v . '</option>' . "\r\n";
		}
		else {
			$safequestions_form .= '<option value=\'' . $k . '\'>' . $v . '</option>' . "\r\n";
		}
	}

	$safequestions_form .= '</select>' . "\r\n";
	return $safequestions_form;
}


?>
