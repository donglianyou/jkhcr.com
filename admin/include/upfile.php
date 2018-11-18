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
define('QQ3479015851', true);
define('IN_AJAX', true);
define('CURSCRIPT', 'upfile');
include dirname(__FILE__) . '/../../include/global.php';
require_once QQ3479015851_DATA . '/config.inc.php';
require_once QQ3479015851_DATA . '/config.php';
require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_INC . '/admin.class.php';
require_once QQ3479015851_INC . '/db.class.php';
@header('Content-type: text/html; charset=' . $charset);

if (!$qq3479015851_admin->qq3479015851_admin_chk_getinfo()) {
	exit('Access Denied!');
}
else {
	define('IN_ADMIN', true);
}

$destination = (isset($destination) ? trim($destination) : '');

if ($delfile) {
	if ($adv == 1) {
		$delfile == str_replace($qq3479015851_global['SiteUrl'], '', $delfile);
	}

	@unlink(QQ3479015851_ROOT . trim($delfile));
}

$id = (isset($id) ? trim($id) : 'imgsrc');
$adv = intval($adv);
if (is_array($_FILES) && submit_check(CURSCRIPT . '_submit')) {
	!$destination && ($destination = 'other');
	require_once QQ3479015851_INC . '/upfile.fun.php';
	$name_file = 'qq3479015851_img';
	check_upimage($name_file);

	if ($_FILES[$name_file]['name']) {
		$watermark = (!empty($watermark) ? $qq3479015851_global['cfg_upimg_watermark'] : 0);

		if ($qq3479015851_image = start_upload($name_file, '/' . $destination . '/' . date('Ym') . '/', $watermark, $width, $height)) {
			$msg = '图片上传成功！';
			$path = $qq3479015851_image;
		}
		else {
			$msg = '图片上传失败！';
			$path = '';
		}
	}
	else {
		$msg = '图片上传失败！';
		$path = '';
	}

	echo '<script laguage=javascript>alert(\'' . $msg . '\');window.parent.document.getElementById("' . $id . '").value=\'' . ($adv == 1 ? $qq3479015851_global['SiteUrl'] : '') . $path . '\';</script><a href=\'?adv=1&destination=' . $destination . '&watermark=' . $watermark . '&delfile=' . $path . '\' style=\'font-size:12px\'>点此重新上传图片</a>';
}
else {
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\r\n" . '<html xmlns="http://www.w3.org/1999/xhtml">' . "\r\n" . '<head>' . "\r\n" . '<meta http-equiv=\'Content-Type\' content=\'text/html; charset=utf-8\'>' . "\r\n" . '<title>upfile</title>' . "\r\n" . '<link href=\'../template/css/qq3479015851.css\' rel=\'stylesheet\' type=\'text/css\'>' . "\r\n" . '<script language="javascript" src="../js/vbm.js"></script>' . "\r\n" . '<body style=" margin:0; padding:0px;">' . "\r\n" . '  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px #c5d8e8 solid; padding:22px; background-color:#f5fbff">' . "\r\n" . '<form name="form1" enctype="multipart/form-data" action="?" method="post">' . "\r\n" . '<input name="destination" value="';
	echo $destination;
	echo '" type="hidden">' . "\r\n" . '<input name="width" value="';
	echo $width;
	echo '" type="hidden">' . "\r\n" . '<input name="height" value="';
	echo $height;
	echo '" type="hidden">' . "\r\n" . '<input name="watermark" value="';
	echo $watermark;
	echo '" type="hidden">' . "\r\n" . '<input name="adv" value="1" type="hidden">' . "\r\n" . '    <tr>' . "\r\n" . '      <td rowspan="3" width="180"><img src="../template/images/pview.gif" width="150" id="picview" name="picview" /></td>' . "\r\n" . '      <td valign="top"><input name="qq3479015851_img" type="file" id="litpic" style="width:200px; border:1px #999 solid; float:left" onchange="SeePic(document.picview,document.form1.litpic);"/>' . "\r\n" . '</td>' . "\r\n" . '    </tr>' . "\r\n" . '    <tr>' . "\r\n" . '      <td valign="bottom"><input name="upfile_submit" type="submit" value="开始上传" class="gray mini"/></td>' . "\r\n" . '    </tr>' . "\r\n" . '</form>' . "\r\n" . '  </table>' . "\r\n" . '</body>' . "\r\n" . '</html>' . "\r\n";
}

?>
