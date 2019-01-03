<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>商家店铺 - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
    <link type="text/css" rel="stylesheet" href="template/css/corpall.css">
    <script>window['current'] = '商家店铺';</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">
    
<?php include qq3479015851_tpl('header_search'); ?>
    <?php $i =1; ?>    <?php if(is_array($ypcategory)){foreach($ypcategory as $SystemGlobalcfm) { ?>    <div class="navv">
    <div class="nav_tt nav_ttbg1">&nbsp; 
    <span class="lico ico<?=$i?>"></span>
    <a href="index.php?mod=corp&catid=<?=$SystemGlobalcfm['corpid']?>&cityid=<?=$cityid?>"><?=$SystemGlobalcfm['corpname']?><i class="filt-arrowright"></i></a>
    </div>
    <div class="big_dl sale">
        <ul>
            <?php if(is_array($SystemGlobalcfm['children'])){foreach($SystemGlobalcfm['children'] as $c) { ?>            <li class="one_third"><a href="index.php?mod=corp&catid=<?=$c['corpid']?>&cityid=<?=$cityid?>"><? echo cutstr($c['corpname'],8); ?></a></li>
            <?php }} ?>
        </ul>
    </div>
    </div>
    <?php $i=$i+1; ?>    <?php }} ?>
</div>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>