<?php

define('CURSCRIPT', 'info_type');
require_once dirname(__FILE__) . '/global.php';
require_once SysGlbCfm_INC . '/db.class.php';
$part = ($part ? $part : 'option_list');
(!(defined('IN_ADMIN')) || !(defined('SysGlbCfm'))) && exit('Access Denied');

if ($admin_cityid) {
	write_msg('您没有权限访问该页！');
}

if ($part == 'option_list') {
	chk_admin_purview('purview_字段管理');
	require_once SysGlbCfm_DATA . '/info.type.inc.php';
	$classid = ($classid ? $classid : $db->getOne('SELECT MAX(classid) FROM `' . $db_qq3479015851 . 'info_typeoptions`'));
	$here = '信息分类字段';
	$options = $db->getAll('SELECT * FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE classid =\'0\' ORDER BY displayorder DESC');
	$detail = $db->getRow('SELECT title,optionid FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE optionid =\'' . $classid . '\'');
	$option = $db->getAll('SELECT * FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE classid =\'' . $classid . '\' AND classid != \'0\' ORDER BY displayorder DESC');
	include qq3479015851_tpl('info_option');
}
else if ($part == 'option_add') {
	(empty($title) || empty($identifier) || empty($type) || empty($classid)) && write_msg('请填写完整相关信息！');

	if (0 < qq3479015851_count('info_typeoptions', 'WHERE identifier = \'' . $identifier . '\'')) {
		write_msg('变量名' . $identifer . '已存在，请换一个变量名');
		exit();
	}

	$res = $db->query('INSERT INTO `' . $db_qq3479015851 . 'info_typeoptions` (title,identifier,type,displayorder,classid,available,required,search)VALUES(\'' . $title . '\',\'' . $identifier . '\',\'' . $type . '\',\'' . $displayorder . '\',\'' . $classid . '\',\'' . $available . '\',\'' . $required . '\',\'' . $search . '\')');
	$optionid = $db->insert_id();
	clear_cache_files('mod_search_option');
	clear_cache_files('mod_search_identifier');
	write_msg('信息字段' . $title . '增加成功! 请继续编辑该字段详情以完成该操作!', '?part=option_edit&optionid=' . $optionid, 'qq3479015851.com.cn');
}
else if ($part == 'option_edit') {
	$optionid = intval($_GET['optionid']);
	$action = trim($_GET['action']);

	switch ($action) {
	case 'update':
		if (($search == 'on') && empty($rules[number][choices]) && empty($rules[select][choices]) && empty($rules[radio][choices]) && empty($rules[checkbox][choices])) {
			write_msg('该字段设计为参与搜索时，检索范围值不能留空！');
			exit();
		}

		$rule = $_POST['rules'];
		$rules = serialize(str_replace(' ', '', $rule[$typenew]));
		$db->query('UPDATE `' . $db_qq3479015851 . 'info_typeoptions` SET title=\'' . $title . '\',identifier=\'' . $identifier . '\',type=\'' . $typenew . '\',classid=\'' . $classid . '\',displayorder=\'' . $displayorder . '\',description=\'' . $description . '\',rules =\'' . $rules . '\',available=\'' . $available . '\',required=\'' . $required . '\',search=\'' . $search . '\' WHERE optionid = \'' . $optionid . '\'');
		$rl = str_replace(' ', '', $rule[$typenew]);
		$r = $db->getAll('SELECT id,options FROM `' . $db_qq3479015851 . 'info_typemodels` WHERE id > 1');

		foreach ($r as $k => $v ) {
			if (in_array($optionid, explode(',', $v['options'])) && ($db->num_rows($db->query('SHOW TABLES LIKE \'' . $db_qq3479015851 . 'information_' . $v[id] . '\'')) == 1)) {
				if ($typenew == 'text') {
					$option_sql = ' VARCHAR(' . ($rl[maxlength] ? $rl[maxlength] : 250) . ') NOT NULL';
				}
				else if ($typenew == 'textarea') {
					$option_sql = ' MEDIUMTEXT';
				}
				else if ($typenew == 'number') {
					$option_sql = ' DECIMAL(10,2) NOT NULL DEFAULT \'0\'';
				}
				else if ($typenew == 'radio') {
					$option_sql = ' TINYINT(1) NOT NULL DEFAULT \'0\'';
				}
				else if ($typenew == 'checkbox') {
					$option_sql = ' VARCHAR(100) NOT NULL DEFAULT \'0\'';
				}
				else if ($typenew == 'select') {
					$option_sql = ' TINYINT(1) NOT NULL DEFAULT \'0\'';
				}

				if (!(in_array($identifier, array('iid', 'id', 'content')))) {
					if ($db->num_rows($db->query('SHOW COLUMNS FROM `' . $db_qq3479015851 . 'information_' . $v[id] . '` LIKE \'' . $identifier . '\''))) {
						$sql = 'ALTER TABLE `' . $db_qq3479015851 . 'information_' . $v[id] . '` CHANGE `' . $identifier . '` `' . $identifier . '`  ' . $option_sql . ';';
					}
					else {
						$sql = 'ALTER TABLE `' . $db_qq3479015851 . 'information_' . $v[id] . '` ADD `' . $identifier . '` ' . $option_sql . ';';
					}
				}

				$db->query($sql);
			}
		}

		clear_cache_files('mod_search_option');
		clear_cache_files('mod_search_identifier');
		clear_cache_files('info_typeoptions');
		write_msg('信息字段 <b>' . $title . '</b> 属性修改成功！', '?part=option_edit&optionid=' . $optionid, 'MyMps');
		break;

	default:
		$options = $db->getAll('SELECT * FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE classid =\'0\' ORDER BY optionid DESC');
		$edit = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE optionid =\'' . $optionid . '\'');
		$here = '分类字段';
		$class_option = $db->getAll('SELECT optionid,title FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE classid = \'0\' ORDER BY displayorder,optionid DESC');

		if ($edit[rules]) {
			$serial_str = str_replace(PHP_EOL, " ", $edit[rules]);
			$serial_str= preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str ); 
			$rule = unserialize($serial_str);
			if ($edit[type] == 'number') {
				$rules[number] = $rule;
			}
			else if (is_array($rule)) {
				foreach ($rule as $w ) {
					$w = str_replace(" ",PHP_EOL,$w);
					$rules[$edit[type]] .= $w;
				}
			}
		}
		require_once SysGlbCfm_DATA . '/info.type.inc.php';
		include qq3479015851_tpl('info_option_edit');
		break;
	}
}
else if ($part == 'option_delall') {
	$a = $db->getAll('SELECT id,options FROM `' . $db_qq3479015851 . 'info_typemodels` WHERE id > 1');

	foreach ($id as $u => $w ) {
		if ($identifier = $db->getOne('SELECT identifier FROM  `' . $db_qq3479015851 . 'info_typeoptions` WHERE optionid = ' . $w)) {
			foreach ($a as $k => $v ) {
				if (($db->num_rows($db->query('SHOW TABLES LIKE \'' . $db_qq3479015851 . 'information_' . $v[id] . '\'')) == 1) && $db->num_rows($db->query('SHOW COLUMNS FROM `' . $db_qq3479015851 . 'information_' . $v[id] . '` LIKE \'' . $identifier . '\''))) {
					$db->query('ALTER TABLE `' . $db_qq3479015851 . 'information_' . $v[id] . '` DROP COLUMN `' . $identifier . '`;');
				}
			}
		}
	}

	foreach ($a as $i => $j ) {
		if ($j['options']) {
			$o = explode(',', $j['options']);

			if (is_array($o)) {
				$o = array_flip($o);
			}

			foreach ($id as $t => $b ) {
				if ($o[$b]) {
					unset($o[$b]);
				}
			}

			if (is_array($o)) {
				$o = array_flip($o);
			}

			if (is_array($o)) {
				$o = implode(',', $o);
			}

			$db->query('UPDATE `' . $db_qq3479015851 . 'info_typemodels` SET options = \'' . $o . '\' WHERE id = \'' . $j['id'] . '\'');
		}
	}

	clear_cache_files('mod_search_option');
	clear_cache_files('mod_search_identifier');
	clear_cache_files('info_typeoptions');
	write_msg('删除信息字段 ' . qq3479015851_del_all('info_typeoptions', $id, 'optionid') . ' 成功', $url, 'mymps');
}
else if ($part == 'option_type') {
	switch ($action) {
	case 'insert':
		$title = trim($_POST['title']);

		if (empty($title)) {
			write_msg('请填写类型名称');
		}

		$SystemGlobalcfm_in = $db->query('INSERT `' . $db_qq3479015851 . 'info_typeoptions` (title,classid) VALUES (\'' . $title . '\',\'0\')');
		write_msg('字段模型分类' . $title . '添加成功！', '?part=option_type', 'MYMPS.COM.CN');
		break;

	case 'update':
		empty($title) && write_msg('请填写类型名称');
		$SystemGlobalcfm_rs = $db->query('UPDATE `' . $db_qq3479015851 . 'info_typeoptions` SET title = \'' . $title . '\' WHERE optionid = \'' . $id . '\'');
		write_msg('字段模型分类' . $title . '修改成功！', '?part=option_type', 'MYMPS.COM.CN');
		break;

	case 'del':
		empty($id) && write_msg('您还没有选定编号');
		$SystemGlobalcfm_del = qq3479015851_delete('info_typeoptions', 'WHERE optionid = \'' . $id . '\'');
		write_msg('字段模型分类' . $id . '删除成功！', '?part=option_type', 'WWW.MYMPS.COM.CN');
		break;

	default:
		$here = '字段类别管理';
		$sql = 'SELECT optionid,classid,title FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE classid = 0';
		$type = $db->getAll($sql);
		include qq3479015851_tpl('info_option_type');
		break;
	}
}
else if ($part == 'mod') {
	switch ($action) {
	case 'insert':
		empty($name) && write_msg('请填写字段模型的名称');
		$displayorder = (trim($_POST['displayorder']) ? trim($_POST['displayorder']) : '0');
		$sql = 'INSERT `' . $db_qq3479015851 . 'info_typemodels` (id,name,type,displayorder) VALUES (\'\',\'' . $name . '\',\'0\',\'' . $displayorder . '\')';
		$db->query($sql);
		$mod_id = $db->insert_id();
		clear_cache_files('mod_search_option');
		clear_cache_files('mod_search_identifier');
		write_msg('字段模型 ' . $name . ' 增加成功! 请继续设置添加该模型所要应用的模型字段!', '?part=mod&action=edit&id=' . $mod_id, 'MyMPS.Com.cn');
		break;

	case 'update':
		empty($name) && write_msg('请输入字段模型的名称！');

		if (empty($options)) {
			write_msg('请至少选择一个字段！');
			exit();
		}

		$post_opt = (!(empty($options)) ? implode(',', $_POST['options']) : '');
		$db->query('UPDATE `' . $db_qq3479015851 . 'info_typemodels` SET name=\'' . $name . '\',displayorder=\'' . $displayorder . '\',options=\'' . $post_opt . '\' WHERE id = \'' . $id . '\'');

		if ($db->num_rows($db->query('SHOW TABLES LIKE \'' . $db_qq3479015851 . 'information_' . $id . '\'')) == 1) {
			if (1 < $id) {
				$options2 = implode(',', $options);
				$query = $db->query('SELECT `identifier` FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE optionid IN (' . $options2 . ')');

				while ($row = $db->fetchRow($query)) {
					$optionsarr[] = $row['identifier'];
				}

				$columns = $db->getAll('SHOW COLUMNS FROM `' . $db_qq3479015851 . 'information_' . $id . '`');

				foreach ($columns as $k => $v ) {
					if (!(in_array($v['Field'], array('id', 'iid', 'content'))) && !(in_array($v['Field'], $optionsarr))) {
						$db->query('ALTER TABLE `' . $db_qq3479015851 . 'information_' . $id . '` DROP COLUMN `' . $v[Field] . '`');
					}
				}
			}

			if (is_array($options)) {
				$option_sql = '';

				foreach ($options as $k => $v ) {
					if ($r = $db->getRow('SELECT identifier,type,rules FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE available = \'on\' AND optionid = \'' . $v . '\'')) {
						$identifier = $r['identifier'];
						$type = $r['type'];
						$rule = ($charset == 'gbk' ? unserialize($r['rules']) : utf8_unserialize($r['rules']));

						if ($type == 'text') {
							$option_sql = ' VARCHAR(' . ($rule[maxlength] ? $rule[maxlength] : 250) . ') NOT NULL';
						}
						else if ($type == 'textarea') {
							$option_sql = ' MEDIUMTEXT';
						}
						else if ($type == 'number') {
							$option_sql = ' DECIMAL(10,2) NOT NULL DEFAULT \'0\'';
						}
						else if ($type == 'radio') {
							$option_sql = ' TINYINT(1) NOT NULL DEFAULT \'0\'';
						}
						else if ($type == 'checkbox') {
							$option_sql = ' VARCHAR(100) NOT NULL DEFAULT \'0\'';
						}
						else if ($type == 'select') {
							$option_sql = ' TINYINT(1) NOT NULL DEFAULT \'0\'';
						}

						if (!(in_array($identifier, array('iid', 'id', 'content')))) {
							if ($db->num_rows($db->query('SHOW COLUMNS FROM `' . $db_qq3479015851 . 'information_' . $id . '` LIKE \'' . $identifier . '\''))) {
								$sql = 'ALTER TABLE `' . $db_qq3479015851 . 'information_' . $id . '` CHANGE `' . $identifier . '` `' . $identifier . '`  ' . $option_sql . ';';
							}
							else {
								$sql = 'ALTER TABLE `' . $db_qq3479015851 . 'information_' . $id . '` ADD `' . $identifier . '` ' . $option_sql . ';';
							}
						}
					}

					if (1 < $id) {
						$db->query($sql);
					}
				}
			}
		}
		else {
			if (is_array($options)) {
				$option_sql = '';

				foreach ($options as $k => $v ) {
					if ($r = $db->getRow('SELECT identifier,type,rules FROM `' . $db_qq3479015851 . 'info_typeoptions` WHERE available = \'on\' AND optionid = \'' . $v . '\'')) {
						$identifier = $r['identifier'];
						$type = $r['type'];
						$rule = ($charset == 'gbk' ? unserialize($r['rules']) : utf8_unserialize($r['rules']));

						if ($type == 'text') {
							$option_sql .= '`' . $identifier . '` VARCHAR(' . ($rule[maxlength] ? $rule[maxlength] : 250) . ') NOT NULL,';
						}
						else if ($type == 'textarea') {
							$option_sql .= '`' . $identifier . '` MEDIUMTEXT,';
						}
						else if ($type == 'number') {
							$option_sql .= '`' . $identifier . '` DECIMAL(10,2) NOT NULL DEFAULT \'0\',';
						}
						else if ($type == 'radio') {
							$option_sql .= '`' . $identifier . '` TINYINT(1) NOT NULL DEFAULT \'0\',';
						}
						else if ($type == 'checkbox') {
							$option_sql .= '`' . $identifier . '` VARCHAR(100) NOT NULL DEFAULT \'0\',';
						}
						else if ($type == 'select') {
							$option_sql .= '`' . $identifier . '` TINYINT(1) NOT NULL DEFAULT \'0\',';
						}
					}
				}
			}

			if (1 < $id) {
				$sqldb = ('4.1' < mysql_get_server_info() ? ' DEFAULT CHARSET=' . $dbcharset . ' ' : '');
				$sql = 'CREATE TABLE IF NOT EXISTS `' . $db_qq3479015851 . 'information_' . $id . '` (' . "\r\n\t\t\t\t\t" . '`iid` MEDIUMINT(7) NOT NULL auto_increment,' . "\r\n\t\t\t\t\t" . '`id` INT(10) NOT NULL DEFAULT \'0\',' . "\r\n\t\t\t\t\t" . $option_sql . "\r\n\t\t\t\t\t" . '`content` MEDIUMTEXT,' . "\r\n\t\t\t\t\t" . 'PRIMARY KEY  (`iid`),' . "\r\n\t\t\t\t\t" . 'KEY `id` (`id`)' . "\r\n\t\t\t\t\t" . ') ENGINE=MyISAM ' . $sqldb . ' AUTO_INCREMENT=1 ;';
				$db->query($sql);
			}
		}

		clear_cache_files('mod_search_option');
		clear_cache_files('mod_search_identifier');
		write_msg('字段模型 ' . $name . ' 修改成功', '?part=mod&action=edit&id=' . $id, 'BBS.MYMPS');
		break;

	case 'edit':
		$here = '字段模型设置';
		$edit = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'info_typemodels` WHERE id =\'' . $id . '\'');

		if (!(empty($edit['options']))) {
			$options = explode(',', $edit['options']);
		}

		$opt = get_all_options();
		include qq3479015851_tpl('info_mod_edit');
		break;

	case 'delall':
		if (is_array($id)) {
			foreach ($id as $k => $v ) {
				$db->query('DROP TABLE IF EXISTS `' . $db_qq3479015851 . 'information_' . $v . '`;');
			}

			qq3479015851_del_all('info_typemodels', $id);
			clear_cache_files('mod_search_option');
			clear_cache_files('mod_search_identifier');
			write_msg('成功删除指定字段模型', '?part=mod', 'mymps');
		}

		break;

	default:
		chk_admin_purview('purview_模型管理');
		$here = '字段模型管理';
		$mod = $db->getAll('SELECT * FROM `' . $db_qq3479015851 . 'info_typemodels` ORDER BY id ASC');
		$rows_num = qq3479015851_count('info_typemodels');
		$param = setParam(array('part'));
		$mod = page1('SELECT * FROM `' . $db_qq3479015851 . 'info_typemodels` ORDER BY id ASC');
		include qq3479015851_tpl('info_mod');
		break;
	}
}

is_object($db) && $db->Close();
$db = $SystemGlobalcfm_global = $part = $action = $here = NULL;
function get_type_option($identifier = '')
{
	global $var_type;

	foreach ($var_type as $k => $value ) {
		$mymps .= '<option value="' . $k . '"';
		$mymps .= ($identifier == $k ? ' selected' : '');
		$mymps .= '>' . $value . '(' . $k . ')</option>';
	}

	return $mymps;
}

function mb_unserialize_qq_3479015851($serial_str) { 
    $serial_str= preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );  
	$serial_str = str_replace(PHP_EOL, " ", $serial_str); 
    return unserialize($serial_str); 
} 




function get_qq3479015851_admin_info_type($rules = '')
{
	global $SystemGlobalcfm_admin_info_type;
	global $edit;
	global $rules;
	global $var_type;

	foreach ($SystemGlobalcfm_admin_info_type as $k => $value ) {
		$estyle = ($edit[type] != $k ? 'style="display:none"' : '');
		$str .= '<div id="style_' . $k . '" ' . $estyle . ' class="mytable"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="vbm"><tr class="firstr"><td colspan="2">' . $var_type[$k] . '(' . $k . ')</td></tr>' . $value . '</table></div>';
	}

	return $str;
}

function get_all_options()
{
	global $db;
	global $db_qq3479015851;
	$sql = 'SELECT optionid,title,type,identifier FROM `' . $db_qq3479015851 . 'info_typeoptions`';
	$optgroup = $db->getAll($sql . 'WHERE classid = 0 ORDER BY displayorder,optionid DESC');

	foreach ($optgroup as $k => $value ) {
		$opt .= '<optgroup label=' . $value[title] . '>';
		$op = $db->getAll($sql . 'WHERE classid != 0 AND classid = \'' . $value['optionid'] . '\' ORDER BY displayorder,optionid DESC');

		foreach ($op as $w => $y ) {
			$opt .= '<option value=' . $y[optionid] . '>' . $y[title] . ' / ' . $y[identifier] . ' / ' . $y[type] . '</option>';
		}

		$opt .= '</optgroup>';
	}

	return $opt;
}


?>
