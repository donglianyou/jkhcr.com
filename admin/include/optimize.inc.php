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
if ($action == 'do_qq3479015851') {
	if (!$optimize || !is_array($optimize)) {
		write_msg('未选择需要维护项，请返回至少选择一项。');
		exit();
	}

	$optimize_arr = array('check' => '检查', 'repair' => '修复', 'analyze' => '分析', 'optimize' => '优化');
	$goodresults = $tables = array();
	$query = $db->query('SHOW TABLE STATUS');

	while ($myval = $db->fetch_array($query)) {
		if (substr($myval['Name'], 0, strlen($dbpre)) == $dbpre) {
			$tables[] = $myval['Name'];
		}
	}

	foreach ($optimize as $val ) {
		if (array_key_exists($val, $optimize_arr)) {
			$newtable = &$tables;

			foreach ($newtable as $table ) {
				$result = ($db->query($val . ' TABLE ' . $table) ? '<font color="#339900">成功</font>' : '<font color="#FF0000">失败</font>');
				$goodresults[] = array('do' => $optimize_arr[$val], 'table' => $table, 'result' => $result);
			}
		}
	}

	if ($goodresults && is_array($goodresults) && (0 < count($goodresults))) {
		$here = 'SysGlbCfm数据库维护';
		$SystemGlobalcfm .= qq3479015851_admin_tpl_global_head();
		$SystemGlobalcfm .= '<div id=' . SysGlbCfm_SOFTNAME . '><table class="vbm" border="0" cellspacing="0" cellpadding="0"><tr class="firstr"><td>操作</td><td>操作的数据表</td><td>结果</td></tr>';

		foreach ($goodresults as $result ) {
			$SystemGlobalcfm .= '<tr><td width="10%" bgcolor="white">' . $result['do'] . '</td><td width="80%"  bgcolor="white">' . $result['table'] . '</td><td width="10%"  bgcolor="white">' . $result['result'] . '</td></tr>';
		}

		$SystemGlobalcfm .= '</table></div>';
		$SystemGlobalcfm .= qq3479015851_admin_tpl_global_foot();
		echo $SystemGlobalcfm;
	}
	else {
		write_msg('操作失败！');
		exit();
	}
}
else {
	$query = $db->query('SHOW TABLE STATUS');
	$SystemGlobalcfm_rows_total = $plugin_rows_total = $other_rows_total = $SystemGlobalcfm_Index_length = $other_Index_length = $SystemGlobalcfm_Data_free = $other_Data_free = $SystemGlobalcfm_Data_length = $other_Data_length = 0;

	while ($info = $db->fetch_array($query)) {
		$info['Index_length_unit'] += sizeunit(@intval($info['Index_length']));
		$info['Data_free_unit'] += sizeunit(@intval($info['Data_free']));
		$info['Data_length_unit'] += sizeunit(@intval($info['Data_length']));

		if (substr($info['Name'], 0, strlen($db_qq3479015851)) == $db_qq3479015851) {
			$SystemGlobalcfm_table_info[] = $info;
			$SystemGlobalcfm_rows_total += $info['Rows'];
			$SystemGlobalcfm_Index_length += $info['Index_length'];
			$SystemGlobalcfm_Data_free += $info['Data_free'];
			$SystemGlobalcfm_Data_length += $info['Data_length'];
		}
		else {
			$other_table_info[] = $info;
			$other_rows_total += $info['Rows'];
			$other_Index_length += $info['Index_length'];
			$other_Data_free += $info['Data_free'];
			$other_Data_length += $info['Data_length'];
		}
	}

	$here = '数据库维护';
	include qq3479015851_tpl('qq3479015851_optimize');
}

?>
