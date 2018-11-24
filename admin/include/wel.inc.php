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
(!(defined('IN_ADMIN')) || !(defined('SysGlbCfm'))) && exit('Access Denied');
$gd_info = @gd_info();
$gd_version = (is_array($gd_info) ? $gd_info['GD Version'] : '<font color=red>不支持GD库</font>');
$cfg_if_tpledit = ($SystemGlobalcfm_qq3479015851[cfg_if_tpledit] == 0 ? '<font color=green>关闭</font>' : '<font color=red>开启</font>');
$if_del_install = (!(is_file(SysGlbCfm_ROOT . '/install/index.php')) ? '<font color=green>已删除</font>' : '<font color=red>未删除</font>');
$Register_Globals = (ini_get('Register_Globals') ? 'on' : 'off');
$Magic_Quotes_Gpc = (MAGIC_QUOTES_GPC ? 'on' : 'off');
$expose_php = (ini_get('expose_php') ? 'on' : 'off');
$cur_dir = getcwdOL();
$cur_dir = ($cur_dir == '/admin' ? '<font color=red title=不建议使用admin作为目录名>/admin</font>' : '<font color=green>' . $cur_dir . '</font>');
$latestbackup = $db->getOne('SELECT value FROM `' . $db_qq3479015851 . 'config` WHERE description = \'latestbackup\' AND type = \'database\'');
$parttime = round((0 < $latestbackup ? $timestamp - $latestbackup : 0) / (3600 * 24));

if (!($latestbackup)) {
	$message = '<font color=red>您尚未备份过114mps系统全部数据</font>';
}
else if (13 < $parttime) {
	$message = '<font color=red>您已经超过两周没有备份114mps系统全部数据了</font>';
}
else if ($parttime == 0) {
	$message = '<font color=green>您今天已经备份过114mps全部数据</font>';
}
else {
	$message = '您在 <font color=green>' . $parttime . '</font> 天前备份过114mps系统数据，上次备份：<font color=green>' . GetTime($latestbackup) . '</font>';
}

$message .= '，<a href="database.php?part=backup" style="text-decoration:underline">点此备份系统数据</a>';
$dsxx = qq3479015851_count('information', 'WHERE info_level = \'0\'');
$dshy = qq3479015851_count('member', 'WHERE status = \'0\'');
$welcome = array('常用操作' => "\r\n\t\t" . '<div>' . "\r\n\t\t" . '<span><input value="审核信息(' . $dsxx . ')" onclick="location.href=\'information.php?info_level=0\'" type="button" class="gray large"></span>' . "\r\n\t\t" . '<div><span><input value="审核会员(' . $dshy . ')" onclick="location.href=\'member.php?part=verify&do_action=default\'" type="button" class="gray large"></span>' . "\r\n\t\t" . '<span><input value="发布信息" onclick="window.open(\'../' . $SystemGlobalcfm_global[cfg_postfile] . '\'); target=\'_blank\'" type="button" class="gray large"></span><span><input value="清除缓存" onclick="location.href=\'config.php?part=cache_sys&return_url=' . urlencode('index.php?do=manage&part=right') . '\'" type="button" class="gray large"></span><span><input value="系统优化" onclick="location.href=\'optimise.php\'" type="button" class="gray large"></span></div>' . "\r\n\t\t\t", '数据统计' => $SystemGlobalcfm_count_str, '快捷操作' => "\r\n\t\t" . '<div class="mainnav">' . "\r\n\t\t" . '<ul>' . "\r\n\t\t" . '<li><a href="' . $SystemGlobalcfm_global[SiteUrl] . '" target="_blank"><img border="0" src="template/images/default/home.gif" />网站首页</a></li>' . "\r\n\t\t" . '<li><a href="#" onclick="parent.framRight.location=\'member.php\'"><img border="0" src="template/images/default/user.png" alt="审核注册" />审核注册</a></li>' . "\r\n\t\t" . '<li><a href="#" onclick="parent.framRight.location=\'announce.php?part=add\'"><img border="0" src="template/images/default/tpc.png" alt="审核主题" />发布公告</a></li>' . "\r\n\t\t" . '<li><a href="#" onclick="parent.framRight.location=\'information.php\'"><img border="0" src="template/images/default/post.png"/>分类信息</a></li>' . "\r\n\t\t" . '<li><a href="#" onclick="parent.framRight.location=\'friendlink.php\'"><img border="0" src="template/images/default/share.png" />审核链接</a></li>' . "\r\n\t\t" . '</ul>' . "\r\n\t\t" . '</div>' . "\r\n\t\t\t", '安全建议' => "\r\n\t\t" . '<span>在线编辑模板功能</span> 当前：' . $cfg_if_tpledit . '。建议您只有在十分必要的时候才开启它。请修改 /data/config.inc.php 关闭此功能<br />' . "\r\n" . '<span>系统 install目录</span> 当前：' . $if_del_install . '。为防止站外人员利用，建议您安装完成后，删除该目录<br />' . "\r\n" . '<span>系统管理目录</span> 当前：' . $cur_dir . '。建议您安装完成后，修改目录名（可直接修改）。<br />' . "\r\n" . '<span>数据安全</span>' . $message,  '服务器相关' => "\r\n\t\t" . '<div><span>服务器环境:</span>' . $_SERVER['SERVER_SOFTWARE'] . '</div>' . "\r\n\t\t" . '<div><span>服务器系统:</span>' . PHP_OS . '</div>' . "\r\n\t\t" . '<div><span>当前时间:</span>' . GetTime($timestamp) . ' ' . date('星期N', $timestamp) . '</div>' . "\r\n\t\t" . '<div><span>PHP程式版本:</span>' . PHP_VERSION . '</div>' . "\r\n\t\t" . '<div><span>Register_Globals:</span>' . $Register_Globals . ' &nbsp;&nbsp;<font color=red>[荐off]</font></div>' . "\r\n\t\t" . '<div><span>Magic_Quotes_Gpc:</span>' . $Magic_Quotes_Gpc . ' &nbsp;&nbsp;<font color=red>[荐on]</font></div>' . "\r\n\t\t" . '<div><span>expose_php:</span>' . $expose_php . ' &nbsp;&nbsp;<font color=red>[荐off]</font></div>' . "\r\n\t\t" . '<div><span>MYSQL版本:</span>' . $db->version() . '</div>' . "\r\n\t\t" . '<div><span>114mps目录: </span>' . SysGlbCfm_ROOT . '</div>' . "\r\n\t\t" . '<div><span>使用域名: </span>' . $_SERVER['SERVER_NAME'] . '</div>' . "\r\n\t\t" . '<div><span>脚本超时时间：</span>' . ini_get('max_execution_time') . '</div>' . "\r\n\t\t" . '<div><span>附件上传上限</span>' . ini_get('upload_max_filesize') . '</div>' . "\r\n\t\t" . '<div><span>GD库版本</span>' . $gd_version . '</div>' . "\r\n\t\t" . '<div><span>检测文件读写权限</span><a href=\'javascript:setbg("检测文件读写权限",305,380,"../box.php?part=sp_testdirs")\' class="icon_open" id="spanmymsg" >点此检测</a><div><div><div>' . "\r\n\t\t\t");

?>
