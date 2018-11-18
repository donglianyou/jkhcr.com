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
function get_group_class()
{
	global $db;
	global $db_qq3479015851;
	static $res;
	$data = read_static_cache('group_class');

	if ($data === false) {
		$query = $db->query('SELECT * FROM `' . $db_qq3479015851 . 'group_category` WHERE cate_view = \'1\' ORDER BY cate_order ASC');

		while ($row = $db->fetchRow($query)) {
			$res[$row['cate_id']]['cate_id'] = $row['cate_id'];
			$res[$row['cate_id']]['cate_name'] = $row['cate_name'];
			$res[$row['cate_id']]['cate_uri'] = plugin_url('group', array('cate_id' => $row['cate_id']));
		}

		write_static_cache('group_class', $res);
	}
	else {
		$res = $data;
	}

	return $res;
}

function get_groupclass_select($formname = 'cate_id', $cate_id = '', $ifselect = 'yes')
{
	global $db;
	global $db_qq3479015851;
	$data = get_group_class();
	$qq3479015851 .= ($ifselect == 'yes' ? '<select name="' . $formname . '" id="' . $formname . '">' : '');

	foreach ($data as $k => $v ) {
		$qq3479015851 .= '<option value="' . $v[cate_id] . '"';
		$qq3479015851 .= ($cate_id == $v['cate_id'] ? ' selected style="background-color:#6EB00C;color:white"' : '');
		$qq3479015851 .= '>' . $v[cate_name] . '</option>';
	}

	$qq3479015851 .= ($ifselect == 'yes' ? '</select>' : '');
	unset($data);
	return $qq3479015851;
}


?>
