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
$flag = (isset($_GET['flag']) ? trim($_GET['flag']) : '');
$jscharset = (isset($_GET['jscharset']) ? intval($_GET['jscharset']) : '');
empty($flag) && exit('非法的参数请求！');
echo '<style>body:font-size:12px</style><textarea style="width:520px; height:50px;"><!--{qq3479015851tag_' . $flag . '}--></textarea><br /><br /><font style="font-size:12px">将编辑框内的代码复制到模板文件对应位置即可</font>';
exit();

?>
