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
@define('SysGlbCfm_ROOT', ereg_replace('[/\\]{1,}', '/', substr(dirname(__FILE__), 0, -8)));
define('SysGlbCfm_INC', SysGlbCfm_ROOT . '/include');
define('SysGlbCfm_DATA', SysGlbCfm_ROOT . '/data');
define('SysGlbCfm_MEMBER', SysGlbCfm_ROOT . '/member');
define('SysGlbCfm_UPLOAD', SysGlbCfm_ROOT . '/attachment');
define('SysGlbCfm_TPL', SysGlbCfm_ROOT . '/template');
define('SysGlbCfm_ASS', SysGlbCfm_INC . '/assign');
define('SysGlbCfm_CACHE', SysGlbCfm_ROOT . '/cache');
define('TEMPLATEID', '1');
define('TPLDIR', 'default');
//define('TPLDIR', 'qq3479015851');

?>
