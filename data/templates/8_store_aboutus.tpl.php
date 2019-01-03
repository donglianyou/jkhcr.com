<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>机构简介 - <?=$store['tname']?> - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
    <link type="text/css" rel="stylesheet" href="template/css/store.css">
    <script>window['current'] = '<?=$navi[$action]?>';</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">

    
<?php include qq3479015851_tpl('header_search'); ?>
    
    
<?php include qq3479015851_tpl('store_header'); ?>
    <div class="clearfix"></div>
    
    <div class="mbox userintro">
    <p class="mbox_t" pagetitle="机构简介"> <a href="javascript:void(0)"> <b>商家介绍</b> </a> </p>
    <div class="intro">
    <?=$store['introduce']?>
    </div>
    </div>
</div>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>