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
echo '<div style="font-size:12px; font-weight:100; margin:10px;">您还没有登录会员管理,本站并不强制要求你必须登录会员后才能发布信息<br /><br />但是注册会员后，您可以更方便地管理自己发布的信息，<a href="' . $SystemGlobalcfm_global['SiteUrl'] . '/' . $SystemGlobalcfm_global['cfg_member_logfile'] . '?url=' . $url . '" target=_top>点我登录</a></div>';

?>
