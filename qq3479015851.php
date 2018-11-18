<?php
define('IN_SMT', true);
define('CURSCRIPT', 'post');
define('QQ3479015851', true);
define('IN_MANAGE', true);

require_once dirname(__FILE__) . '/include/global.php';
require_once dirname(__FILE__) . '/data/config.php';
require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_INC . '/db.class.php';
require_once QQ3479015851_INC . '/upfile.fun.php';
require_once QQ3479015851_DATA . '/config.inc.php';
error_reporting(0);
ifsiteopen();

if(is_array($_FILES)){
	if($_FILES['file']['name']){
		$qq3479015851_img_w=0;
		$qq3479015851_img_h=0;
		$qq3479015851_preimg_w=0;
		$qq3479015851_preimg_h=0;
		$destination="/information/".date('Ym')."/";
		if(check_upimage_mulup('file')){
			$qq3479015851_image = start_upload('file',$destination,$qq3479015851_global['cfg_upimg_watermark'],$qq3479015851_qq3479015851['cfg_information_limit']['width'],$qq3479015851_qq3479015851['cfg_information_limit']['height']);
			die('{"jsonrpc" : "2.0", "result" : "success", "qq3479015851" : "'.$qq3479015851_image[1].'%%'.$qq3479015851_img_w.'%%'.$qq3479015851_img_h.'%%'.$qq3479015851_preimg_w.'%%'.$qq3479015851_preimg_h.'"}');
		}else{
			die('{"jsonrpc" : "2.0", "result" : "上传失败", "qq3479015851" : ""}');
		}	
	}
}else{
	die('{"jsonrpc" : "2.0", "result" : "error", "qq3479015851" : ""}');
}

?>
