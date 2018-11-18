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
error_reporting(32767 ^ 8);
define('QQ3479015851', true);
define(CURSCRIPT, dirname(__FILE__));
require_once CURSCRIPT . '/pinyin.inc.php';
require_once CURSCRIPT . '/../../data/config.db.php';
define(QQ3479015851_DATA, CURSCRIPT . '/../../data');
$t = $value = $elementbyid = $ishead = '';
$t = trim($_GET['t']);
$ishead = intval($_GET['ishead']);
$value = GetPinyin($t, $ishead);
$elementbyid = ($ishead ? 'newdirectory' : 'newcitypy');
echo '<SCRIPT LANGUAGE="JavaScript">' . "\r\n\t\t\t" . '<!--' . "\r\n\t\t\t" . 'parent.document.getElementById("' . $elementbyid . '").value=\'' . $value . '\';' . "\r\n\t\t\t" . '//-->' . "\r\n\t\t\t" . '</SCRIPT>';
unset($value);
unset($t);
unset($ishead);
unset($elementbyid);

?>
