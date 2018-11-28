<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>所有分类 - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
<link type="text/css" rel="stylesheet" href="template/css/all.css">
    <script>window['current'] = '信息分类';</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">

<div class="wrapper">
<?php include qq3479015851_tpl('header_search'); ?><?php if(is_array($cat_list)){foreach($cat_list as $SystemGlobalcfm) { ?><div class="navv">
<div class="nav_tt nav_ttbg1">
<? if($SystemGlobalcfm['icon']) { ?><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['icon']?>" align="center" valign="middle" class="icon">&nbsp;<?php } ?> 
<a href="index.php?mod=category&catid=<?=$SystemGlobalcfm['catid']?>&cityid=<?=$cityid?>"><?=$SystemGlobalcfm['catname']?></a>
<span class="apost"><a href="index.php?mod=post&catid=<?=$SystemGlobalcfm['catid']?>&cityid=<?=$cityid?>">发信息<i class="filt-arrowright"></i></a></span>
</div>
<div class="big_dl sale">
<ul>
    <?php if(is_array($SystemGlobalcfm['children'])){foreach($SystemGlobalcfm['children'] as $c) { ?><li class="one_third"><a href="index.php?mod=category&catid=<?=$c['catid']?>&cityid=<?=$cityid?>"><? echo cutstr($c['catname'],8); ?></a></li>
<?php }} ?>
</ul>
</div>
</div>
<?php }} ?>
</div>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>