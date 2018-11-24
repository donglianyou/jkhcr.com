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

$ac = (in_array($ac, array('list', 'new', 'edit')) ? $ac : 'list');
$documenttype = get_member_docutype();

if (submit_check('document_submit')) {
	$name_file = 'docu_image';

	if (in_array($ac, array('new', 'edit'))) {
		require_once SysGlbCfm_DATA . '/config.inc.php';
		$title = (isset($_POST['title']) ? trim(mhtmlspecialchars($_POST['title'])) : '');
		$imgpath = (isset($_POST['imgpath']) ? mhtmlspecialchars($_POST['imgpath']) : '');
		$pre_imgpath = (isset($_POST['pre_imgpath']) ? mhtmlspecialchars($_POST['pre_imgpath']) : '');
		$author = (isset($_POST['author']) ? trim(mhtmlspecialchars($_POST['author'])) : '');
		$source = (isset($_POST['source']) ? trim(mhtmlspecialchars($_POST['source'])) : '');
		$tid = (isset($_POST['tid']) ? intval($_POST['tid']) : '');
		$content = (isset($_POST['content']) ? trim($_POST['content']) : '');
		$content = maddslashes($content);

		if (empty($title)) {
			write_msg('', '?m=document&type=corp&ac=' . $ac . '&error=30&tid=' . $tid . '&id=' . $id);
		}

		if (empty($author)) {
			write_msg('', '?m=document&type=corp&ac=' . $ac . '&error=31&tid=' . $tid . '&id=' . $id);
		}

		if (empty($author)) {
			write_msg('', '?m=document&type=corp&ac=' . $ac . '&error=32&tid=' . $tid . '&id=' . $id);
		}

		if (empty($content)) {
			write_msg('', '?m=document&type=corp&ac=' . $ac . '&error=33&tid=' . $tid . '&id=' . $id);
		}

		if (empty($tid)) {
			write_msg('', '?m=document&type=corp&ac=' . $ac . '&error=34&tid=' . $tid . '&id=' . $id);
		}
	}

	if ($ac == 'new') {
		if (($documenttype[$tid]['arrid'] == '2') && $_FILES[$name_file]['name']) {
			require_once SysGlbCfm_INC . '/upfile.fun.php';
			$destination = '/document/' . date('Ym') . '/';
			check_upimage($name_file);
			$SystemGlobalcfm_image = start_upload($name_file, $destination, $SystemGlobalcfm_global['cfg_upimg_watermark'], $SystemGlobalcfm_qq3479015851['cfg_normal_limit']['width'], $SystemGlobalcfm_qq3479015851['cfg_normal_limit']['height']);
			$imgpath = $SystemGlobalcfm_image[0];
			$pre_imgpath = $SystemGlobalcfm_image[1];
			$db->query('INSERT INTO `' . $db_qq3479015851 . 'member_docu` (title,author,source,pubtime,userid,content,imgpath,pre_imgpath,typeid) VALUES (\'' . $title . '\',\'' . $author . '\',\'' . $source . '\',\'' . $timestamp . '\',\'' . $s_uid . '\',\'' . $content . '\',\'' . $imgpath . '\',\'' . $pre_imgpath . '\',\'' . $tid . '\')');
		}
		else {
			$db->query('INSERT INTO `' . $db_qq3479015851 . 'member_docu` (title,author,source,pubtime,userid,content,typeid) VALUES (\'' . $title . '\',\'' . $author . '\',\'' . $source . '\',\'' . $timestamp . '\',\'' . $s_uid . '\',\'' . $content . '\',\'' . $tid . '\')');
		}

		$id = $db->insert_id();
		write_msg('', '?m=document&type=corp&success=8&id=' . $id . '&ac=edit');
	}
	else {
		if (($ac == 'edit') && !empty($id)) {
			if (!$row = $db->getRow('SELECT typeid FROM `' . $db_qq3479015851 . 'member_docu` ' . $where . ' AND id = \'' . $id . '\'')) {
				write_msg('', '?m=document&type=corp&ac=list&error=1');
			}

			if (($docutype_arr[$row['typeid']]['arrid'] == '2') && $_FILES[$name_file]['name']) {
				require_once SysGlbCfm_INC . '/upfile.fun.php';
				$destination = '/document/' . date('Ym') . '/';
				check_upimage($name_file);
				$SystemGlobalcfm_image = start_upload($name_file, $destination, $SystemGlobalcfm_global['cfg_upimg_watermark'], $SystemGlobalcfm_qq3479015851['cfg_normal_limit']['width'], $SystemGlobalcfm_qq3479015851['cfg_normal_limit']['height'], $imgpath, $pre_imgpath);
				$imgpath = $SystemGlobalcfm_image[0];
				$pre_imgpath = $SystemGlobalcfm_image[1];
				$db->query('UPDATE `' . $db_qq3479015851 . 'member_docu` SET title = \'' . $title . '\',content = \'' . $content . '\',author = \'' . $author . '\', source = \'' . $source . '\' ,pubtime = \'' . $timestamp . '\' ,imgpath = \'' . $imgpath . '\' , pre_imgpath = \'' . $pre_imgpath . '\' ' . $where . ' AND id = \'' . $id . '\'');
			}
			else {
				$db->query('UPDATE `' . $db_qq3479015851 . 'member_docu` SET title = \'' . $title . '\',content = \'' . $content . '\',author = \'' . $author . '\', source = \'' . $source . '\' ,pubtime = \'' . $timestamp . '\' ' . $where . ' AND id = \'' . $id . '\'');
			}

			write_msg('', '?m=document&type=corp&success=8&ac=edit&id=' . $id);
		}
		else {
			empty($selectedids) && write_msg('', '?m=document&type=corp&error=1&page=' . $page . '&tid=' . $tid . '&ac=' . $ac);
			$create_in = create_in($selectedids);
			$query = $db->query('SELECT * FROM `' . $db_qq3479015851 . 'member_docu` ' . $where . ' AND id ' . $create_in);

			while ($row = $db->fetchRow($query)) {
				$delete[$row['id']]['pre_imgpath'] = $row['pre_imgpath'];
				$delete[$row['id']]['imgpath'] = $row['imgpath'];
			}

			foreach ($delete as $k => $v ) {
				@unlink(SysGlbCfm_ROOT . $v['imgpath']);
				@unlink(SysGlbCfm_ROOT . $v['pre_imgpath']);
			}

			$db->query('DELETE FROM `' . $db_qq3479015851 . 'member_docu` ' . $where . ' AND id ' . $create_in);
			unset($delete);
			unset($row);
			unset($query);
			unset($create_in);
			write_msg('', '?m=document&type=corp&success=3&page=' . $page . '&tid=' . $tid . '&ac=' . $ac);
		}
	}
}
else {
	$tid = (isset($_GET['tid']) ? intval($_GET['tid']) : '');
	$ifcheck_arr = array('<font color=red>待审</font>', '<font color=green>正常</font>');

	if ($ac == 'list') {
		($tid == '') && ($tid = $db->getOne('SELECT MIN(typeid) FROM `' . $db_qq3479015851 . 'member_docutype` WHERE ifview = 2'));
		$where .= (!empty($tid) ? ' AND typeid = \'' . $tid . '\'' : '');
		$rows_num = qq3479015851_count('member_docu', $where);
		$param = setParam(array('m', 'type', 'tid', 'ac'));
		$document = page1('SELECT * FROM `' . $db_qq3479015851 . 'member_docu` ' . $where . ' ORDER BY id DESC');
	}
	else if ($ac == 'new') {
		$acontent = get_editor('content', 'Member', '', '100%', '500px');
	}
	else if ($ac == 'edit') {
		if (empty($id)) {
			write_msg('', '?m=document&type=corp&error=1&ac=' . $ac . '&page=' . $page);
		}

		$edit = $db->getRow('SELECT * FROM `' . $db_qq3479015851 . 'member_docu` ' . $where . ' AND id = \'' . $id . '\'');
		$tid = $edit['typeid'];
		$acontent = get_editor('content', 'Member', $edit['content'], '100%', '500px');
	}

	$location = location('corp');
	include in_array($ac, array('new', 'edit')) ? qq3479015851_tpl('document') : qq3479015851_tpl('document_' . $ac);
}

?>
