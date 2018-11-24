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
define('SysGlbCfm', true);
define('MEMBERDIR', SysGlbCfm_ROOT . '/member');
require_once SysGlbCfm_INC . '/cache.fun.php';
require_once SysGlbCfm_INC . '/class.fun.php';
require_once SysGlbCfm_DATA . '/config.db.php';
require_once SysGlbCfm_INC . '/db.class.php';
require_once SysGlbCfm_INC . '/member.class.php';

if (!($id)) {
	write_msg('删除的信息主题ID不能为空！');
}

if (!($infoid = $db->getOne('SELECT id FROM `' . $db_qq3479015851 . 'information` WHERE id = \'' . $id . '\' AND info_level > 0'))) {
	write_msg('您要删除的信息不存在或者正在审核中!', 'olmsg');
}

$post = is_member_info($id);
$manage_pwd = (isset($_POST['manage_pwd']) ? trim($_POST['manage_pwd']) : '');
if (empty($manage_pwd) && !($post['ismember'])) {
	include SysGlbCfm_ROOT . '/template/box/info_write_pwd.html';
}
else {
	if (!(empty($manage_pwd)) || ($post['ismember'] == 1)) {
		if (($post['ismember'] == 0) && (qq3479015851_count('information', 'WHERE id = \'' . $id . '\' AND manage_pwd = \'' . md5($manage_pwd) . '\'') <= 0)) {
			write_msg('删除失败！您输入了错误的管理密码！');
		}

		if ($post['ismember'] == 1) {
			if (!($member_log->chk_in())) {
				@include SysGlbCfm_DATA . '/caches/authcodesettings.php';
				$authcodesettings = $data;
				$data = NULL;
				$gourl = 'delinfo';
				include SysGlbCfm_ROOT . '/template/box/login.html';
				$authcodesettings = NULL;
				exit();
			}
			else if ($s_uid != $post['userid']) {
				write_msg('删除失败！该信息不是您发布的！', 'olmsg');
				exit();
			}
		}

		$image = $db->getAll('SELECT id,path,prepath FROM `' . $db_qq3479015851 . 'info_img` WHERE infoid = \'' . $id . '\'');

		if (is_array($image)) {
			foreach ($image as $k => $v ) {
				@unlink(SysGlbCfm_ROOT . $v['prepath']);
				@unlink(SysGlbCfm_ROOT . $v['path']);
				qq3479015851_delete('info_img', 'WHERE id = ' . $v['id']);
			}
		}

		if (1 < $post[modid]) {
			qq3479015851_delete('information_' . $post[modid], 'WHERE id = \'' . $id . '\'');
		}

		qq3479015851_delete('information', 'WHERE id = \'' . $id . '\'');
		$url = ($post['ismember'] == 1 ? $SystemGlobalcfm_global['SiteUrl'] . '/member/index.php?m=info' : $SystemGlobalcfm_global['SiteUrl']);
		write_msg('成功删除编号为 ' . $id . ' 的信息主题！<br /><br /><input value="关闭窗口" type="button" onclick="parent.location.href=\'' . $url . '\';parent.closeopendiv();" style=\'margin-left:auto;margin-right:auto;\' class=\'blue\'>', olmsg);
	}
}

?>
