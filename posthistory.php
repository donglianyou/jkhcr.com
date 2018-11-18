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
define('IN_SMT', true);
define('QQ3479015851', true);
define('CURSCRIPT', 'posthistory');
require_once dirname(__FILE__) . '/include/global.php';
require_once dirname(__FILE__) . '/data/config.php';
ifsiteopen();
require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_INC . '/db.class.php';

if (!is_file(QQ3479015851_DATA . '/install.lock')) {
	write_msg('', 'install/index.php');
}

if (!$tel) {
	write_msg('您要查找的电话不能为空！', 'olmsg');
}

$tel_decode = addslashes(base64_decode($tel));
$info = qq3479015851_get_infos('20', NULL, NULL, NULL, NULL, NULL, NULL, $tel_decode);
$numtotal = $db->getOne('SELECT COUNT(id) FROM `' . $db_qq3479015851 . 'information` WHERE tel = \'' . $tel_decode . '\'');
$numtotal = ($numtotal < 20 ? $numtotal : 20);
$loc = get_location('posthistory', '', '查看发贴记录');
$page_title = $loc['page_title'];
globalassign();
include qq3479015851_tpl(CURSCRIPT);
is_object($db) && $db->Close();

?>
