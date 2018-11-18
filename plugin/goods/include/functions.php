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
function goods_category_tree($catid = 0, $ifview = '2')
{
	$data = read_static_cache('goods_category_tree');

	if ($catid == 0) {
		if ($data === false) {
			$parentid = 0;
			$bif_view = (($ifview == '2') || ($ifview == '1') ? ' AND a.if_view = \'' . $ifview . '\' AND b.if_view = \'' . $ifview . '\'' : '');
			$sql = 'SELECT a.catid, a.catname, a.color, a.if_view, b.catid AS childid, b.catname AS childname FROM `' . $GLOBALS['db_qq3479015851'] . 'goods_category` AS a LEFT JOIN `' . $GLOBALS['db_qq3479015851'] . 'goods_category` AS b ON b.parentid = a.catid WHERE a.parentid = \'' . $parentid . '\' ' . $bif_view . ' ORDER BY a.catorder ASC , catid ASC, b.catorder ASC';
			$res = $GLOBALS['db']->getAll($sql);
			$cat_arr = array();

			foreach ($res as $row ) {
				if ($row['if_view']) {
					$cat_arr[$row['catid']]['catid'] = $row['catid'];
					$cat_arr[$row['catid']]['catname'] = $row['catname'];
					$cat_arr[$row['catid']]['color'] = $row['color'];
					$cat_arr[$row['catid']]['if_view'] = $row['if_view'];
					$cat_arr[$row['catid']]['uri'] = Rewrite('goods', array('catid' => $row['catid']));

					if ($row['childid'] != NULL) {
						$cat_arr[$row['catid']]['children'][$row['childid']]['catid'] = $row['childid'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['catname'] = $row['childname'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['if_view'] = $row['if_view'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['color'] = $row['childcolor'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['uri'] = Rewrite('goods', array('catid' => $row['childid']));
					}
				}
			}

			write_static_cache('goods_category_tree', $cat_arr);
		}
		else {
			$cat_arr = $data;
		}
	}
	else {
		if (($data === NULL) || empty($data[$catid])) {
			$bif_view = (($ifview == '2') || ($ifview == '1') ? ' AND b.if_view = \'' . $ifview . '\'' : '');
			$parentid = $GLOBALS['db']->getOne('SELECT parentid FROM `' . $GLOBALS['db_qq3479015851'] . 'goods_category` WHERE catid = \'' . $catid . '\'');

			if ($parentid == 0) {
				$sql = 'SELECT a.catid, a.catname, a.catorder, a.if_view, b.catid AS childid, b.catname AS childname, b.catorder AS childorder FROM `' . $GLOBALS['db_qq3479015851'] . 'goods_category` AS a LEFT JOIN `' . $GLOBALS['db_qq3479015851'] . 'goods_category` AS b ON b.parentid = a.catid ' . $bif_view . ' WHERE a.catid = \'' . $catid . '\' ORDER BY catorder ASC , catid ASC, childorder ASC';
			}
			else {
				$sql = 'SELECT a.catid, a.catname, a.catorder, a.if_view, a.html_dir, a.htmlpath, b.catid AS childid, b.catname AS childname, b.catorder AS childorder FROM `' . $GLOBALS['db_qq3479015851'] . 'goods_category` AS a LEFT JOIN `' . $GLOBALS['db_qq3479015851'] . 'goods_category` AS b ON b.parentid = a.catid ' . $bif_view . ' WHERE b.parentid = \'' . $parentid . '\' ORDER BY catorder ASC , catid ASC, childorder ASC';
			}

			$res = $GLOBALS['db']->getAll($sql);
			$cat_arr = array();

			foreach ($res as $row ) {
				if ($row['if_view']) {
					$cat_arr[$row['catid']]['catid'] = $row['catid'];
					$cat_arr[$row['catid']]['catname'] = $row['catname'];
					$cat_arr[$row['catid']]['catorder'] = $row['catorder'];
					$cat_arr[$row['catid']]['if_view'] = $row['if_view'];
					$cat_arr[$row['catid']]['uri'] = Rewrite('goods', array('catid' => $row['catid']));

					if ($row['childid'] != NULL) {
						$cat_arr[$row['catid']]['children'][$row['childid']]['catid'] = $row['childid'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['catname'] = $row['childname'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['if_view'] = $row['if_view'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['catorder'] = $row['childorder'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['uri'] = Rewrite('goods', array('catid' => $row['childid']));
					}
				}
			}
		}
		else {
			$cat_arr[] = $data[$catid];
		}
	}

	return $cat_arr;
}

function goods_cat_list($catid = 0, $selected = 0, $re_type = true, $level = 0, $is_show_all = true)
{
	global $seoset;
	$data = read_static_cache('goods_category_pid_releate');

	if ($data === false) {
		$sql = 'SELECT c.catid, c.catname, c.parentid, c.if_view, c.catorder, COUNT(s.catid) AS has_children FROM `' . $GLOBALS['db_qq3479015851'] . 'goods_category` AS c LEFT JOIN `' . $GLOBALS['db_qq3479015851'] . 'goods_category` AS s ON s.parentid=c.catid GROUP BY c.catid ORDER BY c.parentid, c.catorder ASC';
		$res = $GLOBALS['db']->getAll($sql);
		$sql = NULL;
		$newres = array();

		if (count($res) <= 1000) {
			write_static_cache('goods_category_pid_releate', $res);
		}
	}
	else {
		$res = $data;
	}

	if (empty($res) == true) {
		return $re_type ? '' : array();
	}

	$options = goods_cat_options($catid, $res);
	$children_level = 99999;

	if ($is_show_all == false) {
		foreach ($options as $key => $val ) {
			if ($children_level < $val['level']) {
				unset($options[$key]);
			}
			else if ($val['is_show'] == 0) {
				unset($options[$key]);

				if ($val['level'] < $children_level) {
					$children_level = $val['level'];
				}
			}
			else {
				$children_level = 99999;
			}
		}
	}

	if (0 < $level) {
		if ($catid == 0) {
			$end_level = $level;
		}
		else {
			$first_item = reset($options);
			$end_level = $first_item['level'] + $level;
		}

		foreach ($options as $key => $val ) {
			if ($end_level <= $val['level']) {
				unset($options[$key]);
			}
		}
	}

	if ($re_type == true) {
		$select = '';

		foreach ($options as $var ) {
			$select .= '<option value="' . $var['catid'] . '" ';

			if (is_array($selected)) {
				$select .= (in_array($var['catid'], $selected) ? 'selected=\'ture\' style=\'background-color:#6eb00c; color:white!important;\'' : '');
			}
			else {
				$select .= ($selected == $var['catid'] ? 'selected=\'ture\' style=\'background-color:#6eb00c; color:white!important;\'' : '');
			}

			$select .= '>';

			if (0 < $var['level']) {
				$select .= str_repeat('&nbsp;', $var['level'] * 4);
			}

			$select .= '├ ' . mhtmlspecialchars($var['catname'], ENT_QUOTES) . '</option>';
		}

		return $select;
	}
	else {
		foreach ($options as $key => $value ) {
			$options[$key]['url'] = $value['catid'];
		}

		return $options;
	}
}

function goods_cat_options($spec_catid, $arr)
{
	$cat_options = array();

	if (isset($cat_options[$spec_cat_id])) {
		return $cat_options[$spec_cat_id];
	}

	if (!isset($cat_options[0])) {
		$level = $last_cat_id = 0;
		$options = $cat_id_array = $level_array = array();
		$data = read_static_cache('goods_category_option_static');

		if ($data === false) {
			while (!empty($arr)) {
				foreach ($arr as $key => $value ) {
					$cat_id = $value['catid'];
					if (($level == 0) && ($last_cat_id == 0)) {
						if (0 < $value['parentid']) {
							break;
						}

						$options[$cat_id] = $value;
						$options[$cat_id]['level'] = $level;
						$options[$cat_id]['id'] = $cat_id;
						$options[$cat_id]['name'] = $value['catname'];
						unset($arr[$key]);

						if ($value['has_children'] == 0) {
							continue;
						}

						$last_cat_id = $cat_id;
						$cat_id_array = array($cat_id);
						$level_array[$last_cat_id] = ++$level;
						continue;
					}

					if ($value['parentid'] == $last_cat_id) {
						$options[$cat_id] = $value;
						$options[$cat_id]['level'] = $level;
						$options[$cat_id]['id'] = $cat_id;
						$options[$cat_id]['name'] = $value['catname'];
						unset($arr[$key]);

						if (0 < $value['has_children']) {
							if (end($cat_id_array) != $last_cat_id) {
								$cat_id_array[] = $last_cat_id;
							}

							$last_cat_id = $cat_id;
							$cat_id_array[] = $cat_id;
							$level_array[$last_cat_id] = ++$level;
						}
					}
					else if ($last_cat_id < $value['parentid']) {
						break;
					}
				}

				$count = count($cat_id_array);

				if (1 < $count) {
					$last_cat_id = array_pop($cat_id_array);
				}
				else if ($count == 1) {
					if ($last_cat_id != end($cat_id_array)) {
						$last_cat_id = end($cat_id_array);
					}
					else {
						$level = 0;
						$last_cat_id = 0;
						$cat_id_array = array();
						continue;
					}
				}

				if ($last_cat_id && isset($level_array[$last_cat_id])) {
					$level = $level_array[$last_cat_id];
				}
				else {
					$level = 0;
				}
			}

			if (count($options) <= 2000) {
				write_static_cache('goods_category_option_static', $options);
			}
		}
		else {
			$options = $data;
		}

		$cat_options[0] = $options;
	}
	else {
		$options = $cat_options[0];
	}

	if (!$spec_cat_id) {
		return $options;
	}
	else {
		if (empty($options[$spec_cat_id])) {
			return array();
		}

		$spec_cat_id_level = $options[$spec_cat_id]['level'];

		foreach ($options as $key => $value ) {
			if ($key != $spec_cat_id) {
				unset($options[$key]);
			}
			else {
				break;
			}
		}

		$spec_cat_id_array = array();

		foreach ($options as $key => $value ) {
			if ((($spec_cat_id_level == $value['level']) && ($value['catid'] != $spec_cat_id)) || ($value['level'] < $spec_cat_id_level)) {
				break;
			}
			else {
				$spec_cat_id_array[$key] = $value;
			}
		}

		$cat_options[$spec_cat_id] = $spec_cat_id_array;
		return $spec_cat_id_array;
	}
}

function goods_parent_cats($cat = '')
{
	global $seo;

	if ($cat == 0) {
		return array();
	}

	$data = read_static_cache('goods_category_pid_releate');

	if ($data === false) {
		$arr = $GLOBALS['db']->getAll('SELECT catid, catname, parentid FROM `' . $GLOBALS['db_qq3479015851'] . 'goods_category`');
	}
	else {
		$arr = $data;
	}

	if (empty($arr)) {
		return array();
	}

	$index = 0;
	$cats = array();

	while (1) {
		foreach ($arr as $row ) {
			if ($cat == $row['catid']) {
				$cat = $row['parentid'];
				$cats[$index]['catid'] = $row['catid'];
				$cats[$index]['catname'] = $row['catname'];
				$cats[$index]['uri'] = Rewrite('goods', array('catid' => $row['catid']));
				$index++;
				break;
			}
		}

		if (($index == 0) || ($cat == 0)) {
			break;
		}
	}

	return $cats;
}


?>
