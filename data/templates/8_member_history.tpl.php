<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>浏览记录 - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
<link type="text/css" rel="stylesheet" href="template/css/member.css">
    <script>window['current'] = '浏览记录';</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">
<?php include qq3479015851_tpl('header_search'); ?>
<div class="ucenter">
<ul class="u_infolst" id="userHistory" style="margin-top:-40px">
<script src="template/js/history.js"></script>
</ul>
<div class="btn_clearhistory" onClick="clearCookie();location.reload();">清空历史浏览记录</div>
</div>
</div>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>