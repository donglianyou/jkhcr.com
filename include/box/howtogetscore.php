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
require_once SysGlbCfm_INC . '/cache.fun.php';
$score_change = get_credit_score();
$array = array('注册成功' => 'register', '登录成功' => 'login', '发布分类信息' => 'information', '营业执照认证' => 'com_certify', '身份证认证' => 'per_certify');
@include SysGlbCfm_DATA . '/caches/plugin.php';
$pluginsettings = $data;
unset($data);

if (is_array($pluginsettings)) {
	foreach ($pluginsettings as $k => $v ) {
		if (($v['disable'] != 1) && ($v['flag'] != 'news')) {
			$array['发布' . $v['name']] = $v['flag'];
		}
	}
}

include SysGlbCfm_ROOT . '/template/box/howtogetscore.html';
$score_change = $array = $pluginsettings = NULL;

?>
