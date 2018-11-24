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

$ac = (isset($_GET['ac']) ? trim($_GET['ac']) : (isset($_POST['ac']) ? trim($_POST['ac']) : ''));
!in_array($ac, array('upload', 'list', 'edit', 'delete')) && ($ac = 'list');
$SystemGlobalcfm_image = '';

if (submit_check('album_submit')) {
	$title = (isset($_POST['title']) ? mhtmlspecialchars($_POST['title']) : '');
	include SysGlbCfm_DATA . '/config.inc.php';
	require_once SysGlbCfm_INC . '/upfile.fun.php';
	$name_file = 'album_up';

	if ($ac == 'upload') {
		if (empty($title)) {
			write_msg('', '?m=album&type=corp&ac=upload&error=28');
		}

		if ($_FILES[$name_file]['name']) {
			check_upimage($name_file);
			$destination = '/album/' . date('Ym') . '/';
			$SystemGlobalcfm_image = start_upload($name_file, $destination, $SystemGlobalcfm_global['cfg_upimg_watermark'], $SystemGlobalcfm_qq3479015851['cfg_memberalbum_limit']['width'], $SystemGlobalcfm_qq3479015851['cfg_memberalbum_limit']['height']);
			$sql = 'INSERT INTO `' . $db_qq3479015851 . 'member_album` (id,title,path,prepath,pubtime,userid)' . "\r\n\t\t\t\t\t" . 'Values(\'\',\'' . $title . '\',\'' . $SystemGlobalcfm_image[0] . '\',\'' . $SystemGlobalcfm_image[1] . '\',\'' . $timestamp . '\',\'' . $s_uid . '\')';
			$db->query($sql);
			unset($destination);
			unset($SystemGlobalcfm_image);
		}
		else {
			write_msg('', '?m=album&type=corp&ac=upload&error=29');
		}

		write_msg('', '?m=album&type=corp&ac=upload&success=12');
	}
	else if ($ac == 'edit') {
		$id = (isset($_POST['id']) ? intval($_POST['id']) : '');
		$path = (isset($_POST['path']) ? mhtmlspecialchars($_POST['path']) : '');
		$prepath = (isset($_POST['prepath']) ? mhtmlspecialchars($_POST['prepath']) : '');

		if (empty($id)) {
			write_msg('', '?m=album&type=corp&ac=list&error=1');
		}

		if (empty($title)) {
			write_msg('', '?m=album&type=corp&ac=edit&error=28&id=' . $id);
		}

		if ($_FILES[$name_file]['name']) {
			check_upimage($name_file);
			$destination = '/album/' . date('Ym') . '/';
			
			$SystemGlobalcfm_image = start_upload($name_file, $destination, 1, $SystemGlobalcfm_qq3479015851['cfg_memberalbum_limit']['width'], $SystemGlobalcfm_qq3479015851['cfg_memberalbum_limit']['height'], $path, $prepath);
			$path = $SystemGlobalcfm_image[0];
			$prepath = $SystemGlobalcfm_image[1];
			unset($destination);
			unset($SystemGlobalcfm_image);
		}

		$db->query('UPDATE `' . $db_qq3479015851 . 'member_album` SET title = \'' . $title . '\',path = \'' . $path . '\', prepath = \'' . $prepath . '\',pubtime = \'' . $timestamp . '\' ' . $where . ' AND id = \'' . $id . '\'');
		write_msg('', '?m=album&type=corp&ac=edit&success=8&id=' . $id);
	}
}
else {
	$id = (isset($_GET['id']) ? intval($_GET['id']) : '');

	if ($ac == 'upload') {
	}
	else if ($ac == 'list') {
		$sql = 'SELECT * FROM ' . $db_qq3479015851 . 'member_album ' . $where . ' ORDER BY id DESC';
		$rows_num = qq3479015851_count('member_album', $where);
		$param = setParam(array('m', 'type', 'ac'));
		$album = page1($sql);
	}
	else if ($ac == 'edit') {
		if (empty($id)) {
			write_msg('', '?m=album&type=corp&error=1');
		}

		$edit = $db->getRow('SELECT id,title,path,prepath FROM `' . $db_qq3479015851 . 'member_album` ' . $where . ' AND id  = \'' . $id . '\'');

		if (empty($edit['id'])) {
			write_msg('', '?m=album&type=corp&ac=list&error=27');
		}
	}
	else if ($ac == 'delete') {
		if (empty($id)) {
			write_msg('', '?m=album&type=corp&error=1');
		}

		if (!$row = $db->getRow('SELECT path,prepath FROM `' . $db_qq3479015851 . 'member_album` ' . $where . ' AND id  = \'' . $id . '\'')) {
			write_msg('', '?m=album&type=corp&ac=list&error=27');
		}
		else {
			@unlink(SysGlbCfm_ROOT . $row['path']);
			@unlink(SysGlbCfm_ROOT . $row['prepath']);
			$res = $db->query('DELETE FROM `' . $db_qq3479015851 . 'member_album` ' . $where . ' AND id  = \'' . $id . '\'');
		}

		write_msg('', '?m=album&type=corp&ac=list&success=8');
	}

	$location = location('corp');
	include qq3479015851_tpl('album_' . (in_array($ac, array('upload', 'edit')) ? 'upload' : $ac));
	unset($album);
}

?>
