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
!(defined('QQ3479015851')) && exit('FORBIDDEN');
$cfg_photo_type['gif'] = false;
$cfg_photo_type['jpeg'] = false;
$cfg_photo_type['png'] = false;
$cfg_photo_type['wbmp'] = false;
$cfg_photo_typenames = array();
$cfg_photo_support = '';
if (function_exists('imagecreatefromgif') && function_exists('imagegif')) {
	$cfg_photo_type['gif'] = true;
	$cfg_photo_typenames[] = 'image/gif';
	$cfg_photo_support .= 'GIF ';
}

if (function_exists('imagecreatefromjpeg') && function_exists('imagejpeg')) {
	$cfg_photo_type['jpeg'] = true;
	$cfg_photo_typenames[] = 'image/pjpeg';
	$cfg_photo_typenames[] = 'image/jpeg';
	$cfg_photo_support .= 'JPEG ';
}

if (function_exists('imagecreatefrompng') && function_exists('imagepng')) {
	$cfg_photo_type['png'] = true;
	$cfg_photo_typenames[] = 'image/png';
	$cfg_photo_typenames[] = 'image/x-png';
	$cfg_photo_support .= 'PNG ';
}

if (function_exists('imagecreatefromwbmp') && function_exists('imagewbmp')) {
	$cfg_photo_type['wbmp'] = true;
	$cfg_photo_typenames[] = 'image/wbmp';
	$cfg_photo_support .= 'WBMP ';
}
function check_upimage($file = 'filename')
{
	global $qq3479015851_global;
	$size = $qq3479015851_global['cfg_upimg_size'] * 1024;
	$upimg_allow = explode(',', $qq3479015851_global['cfg_upimg_type']);

	if ($size < $_FILES[$file]['size']) {
		write_msg('上传文件应小于' . $qq3479015851_global['cfg_upimg_size'] . 'KB');
		exit();
	}

	if (!(in_array(FileExt($_FILES[$file]['name']), $upimg_allow))) {
		write_msg('系统只允许上传' . $qq3479015851_global['cfg_upimg_type'] . '格式的图片！');
	}

	if (!(preg_match('/^image\\//i', $_FILES[$file]['type']))) {
		write_msg('很抱歉，系统无法识别您上传的文件的格式，请换一张图片上传！');
	}

	
	
 	$file=$_FILES[$file];
	$file= $file['tmp_name'];
	if(!getimagesize($file)){
		write_msg('系统只允许上传' . $qq3479015851_global['cfg_upimg_type'] . '格式的图片！');
	}
/* 	if(!exif_imagetype($file)){
		write_msg('系统只允许上传' . $qq3479015851_global['cfg_upimg_type'] . '格式的图片！');
	}
	if((exif_imagetype($file)+0)>3){
		write_msg('系统只允许上传' . $qq3479015851_global['cfg_upimg_type'] . '格式的图片！');
	}   */
	
	
	
	return true;
}



function check_upimage_mulup($file = 'filename')
{
	global $qq3479015851_global;
	$size = $qq3479015851_global['cfg_upimg_size'] * 1024;
	$upimg_allow = explode(',', $qq3479015851_global['cfg_upimg_type']);

	if ($size < $_FILES[$file]['size']) {
		//write_msg('上传文件应小于' . $qq3479015851_global['cfg_upimg_size'] . 'KB');
		return false;
		exit();
	}

	if (!(in_array(FileExt($_FILES[$file]['name']), $upimg_allow))) {
		//write_msg('系统只允许上传' . $qq3479015851_global['cfg_upimg_type'] . '格式的图片！');
		return false;
		exit();
	}

	if (!(preg_match('/^image\\//i', $_FILES[$file]['type']))) {
		//write_msg('很抱歉，系统无法识别您上传的文件的格式，请换一张图片上传！');
		return false;
		exit();
	}

	
	
 	$file=$_FILES[$file];
	$file= $file['tmp_name'];
	if(!getimagesize($file)){
		//write_msg('系统只允许上传' . $qq3479015851_global['cfg_upimg_type'] . '格式的图片！');
		return false;
		exit();
	}
/* 	if(!exif_imagetype($file)){
		write_msg('系统只允许上传' . $qq3479015851_global['cfg_upimg_type'] . '格式的图片！');
	}
	if((exif_imagetype($file)+0)>3){
		write_msg('系统只允许上传' . $qq3479015851_global['cfg_upimg_type'] . '格式的图片！');
	}   */

	return true;
}




function qq3479015851_check_upimage($file = 'filename')
{
	if (is_array($_FILES)) {
		for ($i = 0; $i < count($_FILES); $i++) {
			if ($_FILES[$file . $i]['name']) {
				check_upimage($file . $i);
			}
		}
	}
}

function upload_img_num($file = 'filename')
{
	if (is_array($_FILES)) {
		$num = 0;

		for ($i = 0; $i < count($_FILES); $i++) {
			$num = ($_FILES[$file . $i]['error'] != 4 ? $num + 1 : $num);
		}

		return $num;
	}
	else {
		return 0;
	}
}

function start_upload($file_name, $destination_folder, $watermark = 0, $limit_width = '', $limit_height = '', $edit_filename = '', $edit_pre_filename = '')
{
	global $qq3479015851_global;
	global $timestamp;
	//check_upimage($file_name);
	!(is_uploaded_file($_FILES[$file_name]['tmp_name'])) && write_msg('请重新选择您要上传的图片!');
	$file = $_FILES[$file_name];
	@createdir(QQ3479015851_UPLOAD . $destination_folder);
	$file_name = $file['tmp_name'];
	$pinfo = pathinfo($file['name']);
	$ftype = $pinfo['extension'];
	$fname = $pinfo[basename];
	if (empty($edit_filename) && empty($edit_pre_filename)) {
		$destination_file = $timestamp . random() . '.' . $ftype;
		$destination = QQ3479015851_UPLOAD . $destination_folder . $destination_file;
		$small_destination = QQ3479015851_UPLOAD . $destination_folder . 'pre_' . $destination_file;
	}
	else {
		$destination = QQ3479015851_ROOT . $edit_filename;
		$small_destination = QQ3479015851_ROOT . $edit_pre_filename;
		$forbidarray = array(QQ3479015851_ROOT . '/images/logo.gif', QQ3479015851_ROOT . '/images/nopic.gif', QQ3479015851_ROOT . '/images/nophoto.jpg', QQ3479015851_ROOT . '/images/noavatar.gif', QQ3479015851_ROOT . '/images/noavatar_small.gif');
		if (!(in_array($destination, $forbidarray)) && ($destination != QQ3479015851_ROOT)) {
			@unlink($destination);
		}

		if (!(in_array($small_destination, $forbidarray)) && ($destination != QQ3479015851_ROOT)) {
			@unlink($small_destination);
		}

		unset($forbidarray);
	}

	if (file_exists($destination)) {
		write_msg('同名图片已存在，请重新选择您要上传的图片！');
	}

	if (!(move_uploaded_file($file_name, $destination))) {
		write_msg('图片上传失败，请重新选择您要上传的图片！');
	}

	if (strstr($destination_folder, '/information/') && ('409600' < $file['size'])) {
		ImageResize($destination, 600, 600);
	}

	if (($watermark == 1) && function_exists('gd_info')) {
		WaterImg($destination);
	}

	if (!(empty($limit_width)) && !(empty($limit_height))) {
		ImageResize($destination, $limit_width, $limit_height, $small_destination);
		$qq3479015851_image = array();
		$qq3479015851_image[0] = ($edit_filename ? $edit_filename : '/attachment' . $destination_folder . $destination_file);
		$qq3479015851_image[1] = ($proportion != 1 ? ($edit_pre_filename ? $edit_pre_filename : '/attachment' . $destination_folder . 'pre_' . $destination_file) : $qq3479015851_image[0]);
	}
	else {
		$qq3479015851_image = ($edit_filename ? $edit_filename : '/attachment' . $destination_folder . $destination_file);
	}

	return $qq3479015851_image;
}

function ImageResize($srcFile, $toW, $toH, $toFile = '')
{
	global $cfg_photo_type;
	global $cfg_jpeg_query;
	global $qq3479015851_img_w;
	global $qq3479015851_img_h;
	global $qq3479015851_preimg_w;
	global $qq3479015851_preimg_h;
	
	if (empty($cfg_jpeg_query)) {
		$cfg_jpeg_query = 85;
	}

	if ($toFile == '') {
		$toFile = $srcFile;
	}

	$info = '';
	$srcInfo = GetImageSize($srcFile, $info);

	switch ($srcInfo[2]) {
	case 1:
		if (!($cfg_photo_type['gif'])) {
			return false;
		}

		$im = imagecreatefromgif($srcFile);
		break;

	case 2:
		if (!($cfg_photo_type['jpeg'])) {
			return false;
		}

		$im = imagecreatefromjpeg($srcFile);
		break;

	case 3:
		if (!($cfg_photo_type['png'])) {
			return false;
		}

		$im = imagecreatefrompng($srcFile);
		break;

	case 6:
		if (!($cfg_photo_type['bmp'])) {
			return false;
		}

		$im = imagecreatefromwbmp($srcFile);
		break;
	}

	$srcW = ImageSX($im);
	$qq3479015851_img_w=$srcW;
	$srcH = ImageSY($im);     
	$qq3479015851_img_h=$srcH;
	$toWH = $toW / $toH;
	$srcWH = $srcW / $srcH;

	if ($toWH <= $srcWH) {
		$ftoW = $toW;
		$ftoH = $ftoW * ($srcH / $srcW);
		$qq3479015851_preimg_w=floor($ftoW);
		$qq3479015851_preimg_h=floor($ftoH);
	}
	else {
		$ftoH = $toH;
		$ftoW = $ftoH * ($srcW / $srcH);
		$qq3479015851_preimg_w=floor($ftoW);
		$qq3479015851_preimg_h=floor($ftoH);
	}

	if (($toW < $srcW) || ($toH < $srcH)) {
		if (function_exists('imagecreatetruecolor')) {
			@$ni = imagecreatetruecolor($ftoW, $ftoH);

			if ($ni) {
				imagecopyresampled($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);
			}
			else {
				$ni = imagecreate($ftoW, $ftoH);
				imagecopyresized($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);
			}
		}
		else {
			$ni = imagecreate($ftoW, $ftoH);
			imagecopyresized($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);
		}

		switch ($srcInfo[2]) {
		case 1:
			imagegif($ni, $toFile);
			break;

		case 2:
			imagejpeg($ni, $toFile, $cfg_jpeg_query);
			break;

		case 3:
			imagepng($ni, $toFile);
			break;

		case 6:
			imagebmp($ni, $toFile);
			break;

		default:
			return false;
		}

		imagedestroy($ni);
	}
	else {
		copy($srcFile, $toFile);
	}

	imagedestroy($im);
	return true;
}

function gdversion()
{
	static $gd_version_number;

	if ($gd_version_number === NULL) {
		ob_start();
		phpinfo(8);
		$module_info = ob_get_contents();
		ob_end_clean();

		if (preg_match('/\\bgd\\s+version\\b[^\\d' . "\n\r" . ']+?([\\d\\.]+)/i', $module_info, $matches)) {
			$gdversion_h = $matches[1];
		}
		else {
			$gdversion_h = 0;
		}
	}

	return $gdversion_h;
}

function WaterImg($srcFile, $fromGo = 'up')
{
	global $qq3479015851_global;
	include QQ3479015851_DATA . '/watermark.inc.php';

	if ($photo_markup != '1') {
		return NULL;
	}

	$info = '';
	$srcInfo = GetImageSize($srcFile, $info);
	$srcFile_w = $srcInfo[0];
	$srcFile_h = $srcInfo[1];
	if (($srcFile_w < $photo_wwidth) || ($srcFile_h < $photo_wheight)) {
		return NULL;
	}

	if (($fromGo == 'up') && ($photo_markup == '0')) {
		return NULL;
	}

	if (($fromGo == 'down') && ($photo_markdown == '0')) {
		return NULL;
	}

	$trueMarkimg = QQ3479015851_ROOT . $photo_markimg;
	if (!(file_exists($trueMarkimg)) || empty($photo_markimg)) {
		$trueMarkimg = '';
	}

	ImgWaterMark($srcFile, $photo_waterpos, $trueMarkimg, $photo_watertext, $photo_fontsize, $photo_fontcolor, $photo_diaphaneity);
}

function ImgWaterMark($srcFile, $w_pos = 0, $w_img = '', $w_text = '', $w_font = 5, $w_color = '#FF0000', $w_pct)
{
	$font_type = QQ3479015851_DATA . '/ttf/number.ttf';
	if (empty($srcFile) || !(file_exists($srcFile))) {
		return NULL;
	}

	$info = '';
	$srcInfo = getimagesize($srcFile, $info);
	$srcFile_w = $srcInfo[0];
	$srcFile_h = $srcInfo[1];

	switch ($srcInfo[2]) {
	case 1:
		if (!(function_exists('imagecreatefromgif'))) {
			return NULL;
		}

		$srcFile_img = imagecreatefromgif($srcFile);
		break;

	case 2:
		if (!(function_exists('imagecreatefromjpeg'))) {
			return NULL;
		}

		$srcFile_img = imagecreatefromjpeg($srcFile);
		break;

	case 3:
		if (!(function_exists('imagecreatefrompng'))) {
			return NULL;
		}

		$srcFile_img = imagecreatefrompng($srcFile);
		break;

	case 6:
		if (!(function_exists('imagewbmp'))) {
			return NULL;
		}

		$srcFile_img = imagecreatefromwbmp($srcFile);
		break;

	default:
		return NULL;
	}

	if (!(empty($w_img)) && file_exists($w_img)) {
		$ifWaterImage = 1;
		$info = '';
		$water_info = getimagesize($w_img, $info);
		$width = $water_info[0];
		$height = $water_info[1];

		switch ($water_info[2]) {
		case 1:
			if (!(function_exists('imagecreatefromgif'))) {
				return NULL;
			}

			$water_img = imagecreatefromgif($w_img);
			break;

		case 2:
			if (!(function_exists('imagecreatefromjpeg'))) {
				return NULL;
			}

			$water_img = imagecreatefromjpeg($w_img);
			break;

		case 3:
			if (!(function_exists('imagecreatefrompng'))) {
				return NULL;
			}

			$water_img = imagecreatefrompng($w_img);
			break;

		case 6:
			if (!(function_exists('imagecreatefromwbmp'))) {
				return NULL;
			}

			$srcFile_img = imagecreatefromwbmp($w_img);
			break;

		default:
			return NULL;
		}
	}
	else {
		$ifWaterImage = 0;
		$ifttf = 1;
		@$temp = imagettfbbox($w_font, 0, $font_type, $w_text);
		$width = $temp[2] - $temp[6];
		$height = $temp[3] - $temp[7];
		unset($temp);
		if (empty($width) && empty($height)) {
			$width = strlen($w_text) * 10;
			$height = 20;
			$ifttf = 0;
		}
	}

	if ($w_pos == 0) {
		$wX = rand(0, $srcFile_w - $width);
		$wY = rand(0, $srcFile_h - $height);
	}
	else if ($w_pos == 1) {
		$wX = 5;

		if ($ifttf == 1) {
			$wY = $height + 5;
		}
		else {
			$wY = 5;
		}
	}
	else if ($w_pos == 2) {
		$wX = 5;
		$wY = ($srcFile_h - $height) / 2;
	}
	else if ($w_pos == 3) {
		$wX = 5;
		$wY = $srcFile_h - $height - 5;
	}
	else if ($w_pos == 4) {
		$wX = ($srcFile_w - $width) / 2;

		if ($ifttf == 1) {
			$wY = $height + 5;
		}
		else {
			$wY = 5;
		}
	}
	else if ($w_pos == 5) {
		$wX = ($srcFile_w - $width) / 2;
		$wY = ($srcFile_h - $height) / 2;
	}
	else if ($w_pos == 6) {
		$wX = ($srcFile_w - $width) / 2;
		$wY = $srcFile_h - $height - 5;
	}
	else if ($w_pos == 7) {
		$wX = $srcFile_w - $width - 5;

		if ($ifttf == 1) {
			$wY = $height + 5;
		}
		else {
			$wY = 5;
		}
	}
	else if ($w_pos == 8) {
		$wX = $srcFile_w - $width - 5;
		$wY = ($srcFile_h - $height) / 2;
	}
	else if ($w_pos == 9) {
		$wX = $srcFile_w - $width - 5;
		$wY = $srcFile_h - $height - 5;
	}
	else {
		$wX = ($srcFile_w - $width) / 2;
		$wY = ($srcFile_h - $height) / 2;
	}

	imagealphablending($srcFile_img, true);

	if ($ifWaterImage) {
		imagecopymerge($srcFile_img, $water_img, $wX, $wY, 0, 0, $width, $height, $w_pct);
	}
	else {
		if (!(empty($w_color)) && (strlen($w_color) == 7)) {
			$R = hexdec(substr($w_color, 1, 2));
			$G = hexdec(substr($w_color, 3, 2));
			$B = hexdec(substr($w_color, 5));
		}
		else {
			return NULL;
		}

		if ($ifttf == 1) {
			imagettftext($srcFile_img, $w_font, 0, $wX, $wY, imagecolorallocate($srcFile_img, $R, $G, $B), $font_type, $w_text);
		}
		else {
			imagestring($srcFile_img, $w_font, $wX, $wY, $w_text, imagecolorallocate($srcFile_img, $R, $G, $B));
		}
	}

	switch ($srcInfo[2]) {
	case 1:
		if (function_exists('imagegif')) {
			imagegif($srcFile_img, $srcFile);
		}

		break;

	case 2:
		if (function_exists('imagejpeg')) {
			imagejpeg($srcFile_img, $srcFile);
		}

		break;

	case 3:
		if (function_exists('imagepng')) {
			imagepng($srcFile_img, $srcFile);
		}

		break;

	case 6:
		if (function_exists('imagewbmp')) {
			imagewbmp($srcFile_img, $srcFile);
		}

		break;

	default:
		return NULL;
	}

	if (isset($water_info)) {
		unset($water_info);
	}

	if (isset($water_img)) {
		imagedestroy($water_img);
	}

	unset($srcInfo);
	imagedestroy($srcFile_img);
}


?>
