<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>系统提示 - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
<script src="template/js/jq_min.211.js"></script>
<script src="template/js/common.js"></script>
</head>

<body>
<script>SysGlbCfmWindowMsg('',1,'<?=$redirectmsg?>','<?=$url?>');</script>
</body>
</html>