<?php

echo '﻿';
define('QQ3479015851', true);
define('IN_AJAX', true);
define('IN_JSON', true);
require_once 'JSON.php';
require_once dirname(__FILE__) . '/../global.inc.php';
require_once QQ3479015851_INC . '/global.php';
require_once QQ3479015851_DATA . '/config.php';
require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_INC . '/upfile.fun.php';
require_once QQ3479015851_INC . '/db.class.php';
require_once QQ3479015851_INC . '/member.class.php';

if (!$member_log->chk_in()) {
	alert('请登录用户管理中心再上传图片!');
}

$watermark = (isset($watermark) ? $watermark : '');
$dopost = (isset($dopost) ? $dopost : '');
$imgwidthValue = (isset($imgwidthValue) ? $imgwidthValue : 400);
$imgheightValue = (isset($imgheightValue) ? $imgheightValue : 300);
$urlValue = (isset($urlValue) ? $urlValue : '');
$imgsrcValue = (isset($imgsrcValue) ? $imgsrcValue : '');
$imgurl = (isset($imgurl) ? $imgurl : '');
$small = (isset($small) ? $small : '');

if (empty($_FILES) === false) {
	$name_file = 'imgFile';
	$size = $qq3479015851_global['cfg_upimg_size'] * 1024;
	$upimg_allow = explode(',', $qq3479015851_global['cfg_upimg_type']);

	if ($size < $_FILES[$name_file]['size']) {
		alert('上传文件应小于' . $qq3479015851_global['cfg_upimg_size'] . 'KB');
	}

	if (!in_array(FileExt($_FILES[$name_file]['name']), $upimg_allow)) {
		alert('系统只允许上传' . $qq3479015851_global['cfg_upimg_type'] . '格式的图片！');
	}

	if (!preg_match('/^image\\//i', $_FILES[$name_file]['type'])) {
		alert('很抱歉，系统无法识别您上传的文件的格式，请换一张图片上传！');
	}

	$destination = '/editor/' . date('Ym') . '/';

	if ($_FILES[$name_file]['name']) {
		check_upimage($name_file);
		$qq3479015851_image = start_upload($name_file, $destination, $qq3479015851_global[cfg_upimg_watermark]);
		$imgsrcValue = $qq3479015851_image;
		$full_litfilename = $full_filename = QQ3479015851_ROOT . $qq3479015851_image;
		$sizes = getimagesize($full_filename);
		$imgwidthValue = $sizes[0];
		$imgheightValue = $sizes[1];
		$imgsize = filesize($full_litfilename);
		$db->query('INSERT INTO `' . $db_qq3479015851 . 'upload` (title,url,width,height,filesize,uptime,adminid) VALUES (\'' . $qq3479015851_image[0] . '\',\'' . $imgsrcValue . '\',\'' . $imgwidthValue . '\',\'' . $imgheightValue . '\',\'' . $imgsize . '\',\'' . $nowtime . '\',\'' . $s_uid . '\')');
		$file_url = $qq3479015851_global[SiteUrl] . $imgsrcValue;
	}

	header('Content-type: text/html; charset=utf-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 0, 'url' => $file_url));
	exit();
}
function alert($msg)
{
	global $charset;
	header('Content-type: text/html; charset=utf-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 1, 'message' => $msg));
	exit();
}


?>
