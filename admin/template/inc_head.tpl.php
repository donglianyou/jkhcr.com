<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title><?=$here?>  - powered by <?=SysGlbCfm_SOFTNAME?></title>
<link href='template/css/<?=SysGlbCfm_SOFTNAME?>.css' rel='stylesheet' type='text/css'>
<style>
body{ font-family:Arial, Helvetica, sans-serif!important;}
</style>
<script type='text/javascript' src='../template/global/qq3479015851.js'></script>
<script type='text/javascript' src='../template/global/noerr.js'></script>
<script type='text/javascript' src='js/loading.js'></script>
<link rel="stylesheet" href="../template/global/basic.css">
<link rel="stylesheet" href="../template/global/dropzone.min.css">
<script src="../template/global/jquery.min.js"></script>
<script src="../template/global/dropzone.min.js"></script>
<script language="javascript">
var current_domain = '<?php echo $SystemGlobalcfm_global[SiteUrl]; ?>';
function $$(obj){
	return parent.document.getElementById(obj);
}
function ascreen(){
	if($$('adminheader').style.display==''){
		fullscreen();
	} else if($$('adminheader').style.display=='none'){
		wrapscreen();
	}
}
function fullscreen(){
	$$('adminheader').style.display='none';
	$$('adminlefter').style.display='none';
	$obj('href').href='javascript:wrapscreen();';
}
function wrapscreen(){
	$$('adminheader').style.display='';
	$$('adminlefter').style.display='';
	$obj('href').href='javascript:fullscreen();';
}
</script>
<script type="text/javascript" src="../template/global/messagebox.js"></script>
</head>
<body <?php if($_GET['go'] == 'qq3479015851_config') echo "onLoad=\"parent.framRight.location='config.php'\"";?>>
<div class='bodytitle'>
    <div class='bodytitleleft'></div>
    <div class='bodytitletxt'><?=$here?></div>
    <div class='bodytitleright'></div>
    <?php if($part != 'phpinfo'){?>
    <div class='iicon'>
    <a href='javascript:window.location.reload();'>刷新</a>
    <a href='javascript:history.back();'>后退</a>
    <a href='javascript:history.go(1);'>前进</a>
	<a href='javascript:ascreen();' id="href">全屏</a>
    </div>
    <?php }?>
</div>
<div class="clear"></div>
<div style="margin-left:10px; margin-top:5px;margin-right:10px;">