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
!(defined('QQ3479015851')) && exit('FORBIDDEN');
$flag = (isset($_GET['flag']) ? trim($_GET['flag']) : '');
$jscharset = (isset($_GET['jscharset']) ? intval($_GET['jscharset']) : '');
empty($flag) && exit('非法的参数请求！');
echo '<style>body{font-size:12px}</style><textarea style="width:520px; height:50px;">' . mhtmlspecialchars('<script language="javascript" src="' . $qq3479015851_global['SiteUrl'] . '/javascript.php?flag=' . $flag . '" ' . ($jscharset == 1 ? 'charset="utf-8"' : '') . '></script>') . '</textarea><br /><br /><font style="font-size:12px">将编辑框内的代码复制到调用HTML对应位置即可</font>';
exit();

?>
