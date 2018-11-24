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
if (!defined('SysGlbCfm')) {
	exit('Forbidden');
}

$l = (!empty($_GET['l']) ? trim($_GET['l']) : 'normal');
$box = (!empty($_POST['box']) ? 1 : '');
$id = (isset($_REQUEST['id']) ? intval($_REQUEST['id']) : '');
require_once MEMBERDIR . '/include/common.func.php';

if ($ac == 'del') {
	empty($id) && write_msg('', '?m=info&error=1&l=' . $l . '&page=' . $page);
	$r = $db->getRow('SELECT a.*,b.modid FROM `' . $db_qq3479015851 . 'information` AS a LEFT JOIN `' . $db_qq3479015851 . 'category` AS b ON a.catid = b.catid ' . $wherea . ' AND a.id =' . $id);

	if (!empty($r['img_path'])) {
		$del = $db->getAll('SELECT path,prepath FROM `' . $db_qq3479015851 . 'info_img` WHERE infoid=\'' . $id . '\'');

		foreach ($del as $k => $v ) {
			if ($v['path']) {
				@unlink(SysGlbCfm_ROOT . $v['path']);
			}

			if ($v['prepath']) {
				@unlink(SysGlbCfm_ROOT . $v['prepath']);
			}
		}

		qq3479015851_delete('info_img', 'WHERE infoid = \'' . $id . '\'');
	}

	qq3479015851_delete('comment', 'WHERE type = \'information\' AND typeid = \'' . $id . '\'');

	if (1 < $r[modid]) {
		qq3479015851_delete('information_' . $r[modid], 'WHERE id = \'' . $id . '\'');
	}

	$db->query('DELETE FROM `' . $db_qq3479015851 . 'information` WHERE id = ' . $id);
	write_msg('', '?m=info&success=3&l=' . $l . '&page=' . $page);
}
else if ($ac == 'refresh') {
	($l == 'inormal') && write_msg('', '?m=info&error=7&l=inormal&page=' . $page);
	empty($id) && write_msg('', '?m=info&error=1&page=' . $page);
	$delmoney = $SystemGlobalcfm_global['cfg_member_info_refresh'];

	if ($money_own < $delmoney) {
		write_msg('', '?m=pay&error=2');
		exit();
	}

	(mgetcookie('refreshed' . $id) == 1) && write_msg('', '?m=info&error=3&page=' . $page);
	$activetime = $db->getOne('SELECT activetime FROM `' . $db_qq3479015851 . 'information` ' . $where . ' AND id = \'' . $id . '\'');
	$endtime = ($activetime == 0 ? 0 : ($activetime * 3600 * 24) + $timestamp);
	$db->query('UPDATE `' . $db_qq3479015851 . 'information` SET begintime = \'' . $timestamp . '\' , endtime = \'' . $endtime . '\' ' . $where . ' AND id = \'' . $id . '\'');
	msetcookie('refreshed' . $id, 1);

	if ($delmoney) {
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET money_own = money_own - \'' . $delmoney . '\' ' . $where);
	}

	write_money_use('编号为 ' . $id . ' 的信息主题被执行 <font color=red>刷新</font> 操作', '<font color=red>扣除金币 ' . $delmoney . ' </font>');
	write_msg('', '?m=info&success=2');
}
else if ($ac == 'red') {
	($l == 'inormal') && write_msg('', '?m=info&error=7&l=inormal&page=' . $page);
	empty($id) && write_msg('', '?m=info&error=1&page=' . $page);
	$delmoney = $SystemGlobalcfm_global['cfg_member_info_red'];

	if ($money_own < $delmoney) {
		write_msg('', '?m=pay&error=2');
	}

	$db->query('UPDATE `' . $db_qq3479015851 . 'information` SET ifred = \'1\' ' . $where . ' AND id =' . $id);

	if ($delmoney) {
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET money_own = money_own - \'' . $delmoney . '\' ' . $where);
	}

	write_money_use('编号为 ' . $id . ' 的信息主题被执行 <font color=red>标题套红</font> 操作', '<font color=red>扣除金币 ' . $delmoney . ' </font>');
	write_msg('', '?m=info&success=4&page=' . $page);
}
else if ($ac == 'bold') {
	($l == 'inormal') && write_msg('', '?m=info&error=7&l=inormal&page=' . $page);
	empty($id) && write_msg('', '?m=info&error=1&page=' . $page);
	$delmoney = $SystemGlobalcfm_global['cfg_member_info_bold'];

	if ($money_own < $delmoney) {
		write_msg('', '?m=pay&error=2');
	}

	$db->query('UPDATE `' . $db_qq3479015851 . 'information` SET ifbold = \'1\' ' . $where . ' AND id =' . $id);

	if ($delmoney) {
		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET money_own = money_own - \'' . $delmoney . '\' ' . $where);
	}

	write_money_use('编号为 ' . $id . ' 的信息主题被执行 <font color=red>标题加粗</font> 操作', '<font color=red>扣除金币 ' . $delmoney . ' </font>');
	write_msg('', '?m=info&success=5&page=' . $page);
}
else if ($ac == 'upgrade') {
	require_once SysGlbCfm_DATA . '/info.level.inc.php';
	unset($information_level);
	unset($news_level);

	if (empty($id)) {
		write_msg('', '?m=info&error=1&page=' . $page);
	}

	$location = location('user', '置顶信息');
	$row = $db->getRow('SELECT id,title,catid,upgrade_type,upgrade_type_list,upgrade_type_index FROM `' . $db_qq3479015851 . 'information` ' . $where . ' AND id = \'' . $id . '\'');

	if (empty($row['id'])) {
		write_msg('', '?m=info&error=1&page=' . $page);
	}

	include qq3479015851_tpl('info_upgrade');
}
else if ($ac == 'actionupgrade') {
	require_once SysGlbCfm_INC . '/class.fun.php';
	require_once SysGlbCfm_INC . '/cache.fun.php';
	$id = (isset($id) ? intval($id) : intval($_POST['id']));
	$catid = (isset($catid) ? intval($catid) : intval($_POST['catid']));
	$upgrade_time = (isset($upgrade_time) ? intval($upgrade_time) : intval($_POST['upgrade_time']));
	$upgrade_type = (isset($upgrade_type) ? trim($upgrade_type) : trim($_POST['upgrade_type']));
	$money_own = ($money_own ? $money_own : intval($_POST['money_own']));
	$iftop = (isset($iftop) ? intval($iftop) : intval($_POST['iftop']));
	$iflisttop = (isset($iflisttop) ? intval($iflisttop) : intval($_POST['iflisttop']));
	$ifindextop = (isset($ifindextop) ? intval($ifindextop) : intval($_POST['ifindextop']));
	$money_cost = $upgrade_time * $SystemGlobalcfm_global[$upgrade_type];
	$upgrade_time = ($upgrade_time * 3600 * 24) + $timestamp;
	if (empty($id) || empty($catid) || empty($upgrade_time) || !in_array($upgrade_type, array('cfg_member_upgrade_index_top', 'cfg_member_upgrade_top', 'cfg_member_upgrade_list_top'))) {
		if ($box) {
			write_msg('置顶失败，你选择置顶的信息主题编号为空或者置顶类型不正确');
		}
		else {
			write_msg('', '?m=info&ac=upgrade&error=4&id=' . $id);
		}
	}

	if ($money_own < $money_cost) {
		if ($box) {
			write_msg('您的账户余额不足，请先充值', 'member/index.php?m=pay&box=1', '', 1);
		}
		else {
			write_msg('', '?m=pay&error=2');
		}
	}

	if ($upgrade_type == 'cfg_member_upgrade_top') {
		if ($box) {
			($iftop == 2) && write_msg('该信息主题已处于大类置顶状态');
		}
		else {
			($iftop == 2) && write_msg('', '?m=info&ac=upgrade&error=5&id=' . $id);
		}

		$db->query('UPDATE `' . $db_qq3479015851 . 'information` SET upgrade_type = \'2\' , upgrade_time = \'' . $upgrade_time . '\' ' . $where . ' AND id = \'' . $id . '\'');
	}
	else if ($upgrade_type == 'cfg_member_upgrade_list_top') {
		if ($box) {
			($iflisttop == 2) && write_msg('该信息主题已处于小类置顶状态');
		}
		else {
			($iflisttop == 2) && write_msg('', '?m=info&ac=upgrade&error=5&id=' . $id);
		}

		$db->query('UPDATE `' . $db_qq3479015851 . 'information` SET upgrade_type_list = \'2\' , upgrade_time_list = \'' . $upgrade_time . '\' ' . $where . ' AND id = \'' . $id . '\'');
	}
	else if ($upgrade_type == 'cfg_member_upgrade_index_top') {
		if ($box) {
			($ifindextop == 2) && write_msg('该信息主题已处于首页置顶状态');
		}
		else {
			($ifindextop == 2) && write_msg('', '?m=info&ac=upgrade&error=6&id=' . $id);
		}

		$db->query('UPDATE `' . $db_qq3479015851 . 'information` SET upgrade_type_index = \'2\' , upgrade_time_index = \'' . $upgrade_time . '\' ' . $where . ' AND id = \'' . $id . '\'');
	}

	$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET money_own = money_own - \'' . $money_cost . '\' ' . $where);
	$caozuo = ($upgrade_type == 'cfg_member_upgrade_index_top' ? '首页置顶' : ($upgrade_type == 'cfg_member_upgrade_top' ? '大类置顶' : '小类置顶'));
	write_money_use('编号为 ' . $id . ' 的信息主题被执行 <font color=red>' . $caozuo . '</font> 操作', '<font color=red>扣除金币 ' . $money_cost . ' </font>');
	$$_request = array();
	$seo = get_seoset();

	if ($upgrade_type == 'cfg_member_upgrade_top') {
		$do_action = '大类置顶';
	}
	else if ($upgrade_type == 'cfg_member_upgrade_list_top') {
		$do_action = '小类置顶';
	}
	else if ($upgrade_type == 'cfg_member_upgrade_index_top') {
	}

	if ($box) {
		write_msg('恭喜，该信息主题已被<font color=red>' . $caozuo . '</font>！<br /><br /><input value="关闭窗口" type="button" onclick=\'parent.window.location.reload();parent.closeopendiv();\' style="margin-left:auto;margin-right:auto;" class="blue">', 'olmsg');
	}
	else {
		write_msg('', '?m=info&ac=upgrade&success=6&id=' . $id);
	}
}
else {
	require_once SysGlbCfm_DATA . '/info.level.inc.php';
	runcron();

	if ($l == 'normal') {
		$where .= '';
	}
	else if ($l == 'inormal') {
		$where .= ' AND a.info_level = \'0\' ';
	}
	else if ($l == 'tuiguang') {
		$where .= ' AND (upgrade_type > 1 OR upgrade_type_list > 1 OR upgrade_type_index > 1)';
	}

	$sql = 'SELECT a.* FROM ' . $db_qq3479015851 . 'information AS a ' . $where . ' ORDER BY a.begintime DESC';
	$rows_num = $db->getOne('SELECT COUNT(a.id) FROM `' . $db_qq3479015851 . 'information` AS a ' . $where);
	$param = setParam(array('m', 'l'));
	$list = array();
	$page1 = page1($sql, 10);

	foreach ($page1 as $k => $row ) {
		$arr['id'] = $row['id'];
		$arr['uri'] = Rewrite('info', array('dir_typename' => $row['dir_typename'], 'id' => $row['id'], 'cityid' => $row['cityid']));
		$arr['title'] = SpHtml2Text($row['title']);
		$arr['content'] = SpHtml2Text($row['content']);
		$arr['begintime'] = get_format_time($row['begintime']);
		$arr['endtime'] = $row['endtime'];
		$arr['upgrade_time'] = $row['upgrade_time'];
		$arr['upgrade_time_index'] = $row['upgrade_time_index'];
		$arr['upgrade_time_list'] = $row['upgrade_time_list'];
		$arr['info_level'] = $information_level[$row['info_level']];
		$arr['ifred'] = $row['ifred'];
		$arr['ifbold'] = $row['ifbold'];
		$arr['img_path'] = $row['img_path'];
		$arr['hit'] = $row['hit'];
		$arr['info_level'] = $row['info_level'];

		if ($timestamp <= $row['upgrade_time']) {
			if (1 < $row['upgrade_type']) {
				$arr['upgrade_type'] = 1;
			}
			else {
				$arr['upgrade_type'] = NULL;
			}
		}
		else {
			$arr['upgrade_type'] = NULL;
		}

		if ($timestamp <= $row['upgrade_time_list']) {
			if (1 < $row['upgrade_type_list']) {
				$arr['upgrade_type_list'] = 1;
			}
			else {
				$arr['upgrade_type_list'] = NULL;
			}
		}
		else {
			$arr['upgrade_type_list'] = NULL;
		}

		if ($timestamp <= $row['upgrade_time_index']) {
			if (1 < $row['upgrade_type_index']) {
				$arr['upgrade_type_index'] = 1;
			}
			else {
				$arr['upgrade_type'] = NULL;
			}
		}
		else {
			$arr['upgrade_type_index'] = NULL;
		}

		$list[] = $arr;
	}

	$location = location();
	include qq3479015851_tpl('info');
}

?>
