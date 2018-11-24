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
!(defined('SysGlbCfm')) && exit('FORBIDDEN');
require_once SysGlbCfm_DATA . '/config.db.php';
require_once SysGlbCfm_INC . '/db.class.php';
$ip = '';
$ip = GetIP();
$infoid = (isset($_POST['infoid']) ? intval($_POST['infoid']) : '');
$infotitle = (isset($_POST['infotitle']) ? mhtmlspecialchars($_POST['infotitle']) : '');
$content = (isset($_POST['content']) ? mhtmlspecialchars($_POST['content']) : '');
$report_type = (isset($_POST['report_type']) ? intval($_POST['report_type']) : '');

if (0 < qq3479015851_count('info_report', 'WHERE infoid = \'' . $infoid . '\' AND ip = \'' . $ip . '\' AND pubtime > \'' . mktime(0, 0, 0) . '\'')) {
	echo '<center style="color:red; font-weight:bold">操作失败，该信息您已经举报过了！</font>';
	exit();
}

$db->query('INSERT INTO `' . $db_qq3479015851 . 'info_report` (report_type,content,infoid,infotitle,ip,pubtime)VALUES(\'' . $report_type . '\',\'' . $content . '\',\'' . $infoid . '\',\'' . $infotitle . '\',\'' . $ip . '\',\'' . $timestamp . '\')');
echo '<div style="margin:10px 15px"><font style="color:red; font-size:12px"><h1>感谢您的举报 :)</h1><br />● 在' . $SystemGlobalcfm_global[SiteName] . '，每天有数千条违规信息通过用户举报被删除。<br /><br />● 如果你是不小心点错了举报按钮，别担心。只有当一个信息收到一定数量的举报时才会被删除。</font></div>';

?>
