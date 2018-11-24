<?php
define('IN_SMT', true);
define('CURSCRIPT', 'post');
define('SysGlbCfm', true);
define('IN_MANAGE', true);

require_once dirname(__FILE__) . '/include/global.php';
require_once dirname(__FILE__) . '/data/config.php';
require_once SysGlbCfm_DATA . '/config.db.php';
require_once SysGlbCfm_INC . '/db.class.php';
require_once SysGlbCfm_INC . '/upfile.fun.php';
require_once SysGlbCfm_DATA . '/config.inc.php';
error_reporting(0);
ifsiteopen();

if(is_array($_FILES)){
	if($_FILES['file']['name']){
		$SystemGlobalcfm_img_w=0;
		$SystemGlobalcfm_img_h=0;
		$SystemGlobalcfm_preimg_w=0;
		$SystemGlobalcfm_preimg_h=0;
		$destination="/information/".date('Ym')."/";
		if(check_upimage_mulup('file')){
			$SystemGlobalcfm_image = start_upload('file',$destination,$SystemGlobalcfm_global['cfg_upimg_watermark'],$SystemGlobalcfm_qq3479015851['cfg_information_limit']['width'],$SystemGlobalcfm_qq3479015851['cfg_information_limit']['height']);
			die('{"jsonrpc" : "2.0", "result" : "success", "qq3479015851" : "'.$SystemGlobalcfm_image[1].'%%'.$SystemGlobalcfm_img_w.'%%'.$SystemGlobalcfm_img_h.'%%'.$SystemGlobalcfm_preimg_w.'%%'.$SystemGlobalcfm_preimg_h.'"}');
		}else{
			die('{"jsonrpc" : "2.0", "result" : "上传失败", "qq3479015851" : ""}');
		}	
	}
}else{
	die('{"jsonrpc" : "2.0", "result" : "error", "qq3479015851" : ""}');
}

?>
