<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公司简介-<?=$store['tname']?>-<?=$SystemGlobalcfm_global['SiteName']?></title>
<link href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/spaces/store/css/<?=$store['template']?>.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php include qq3479015851_tpl('header'); ?>
<div class="content">
<?php include qq3479015851_tpl('sider'); ?>
<div class="cright">
    <div class="box"> 
<div class="tit"><span>公司简介</span></div> 
            <div class="con about cfix"> 
            <?=$store['introduce']?>
            <div class="clear"></div>
            </div>
    </div>
</div>
</div>
<div class="clear15"></div>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>