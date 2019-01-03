<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>联系方式 - <?=$store['tname']?> - <?=$SystemGlobalcfm_global['SiteName']?></title>
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
    <p class="mbox_t" pagetitle="地理位置"> <a href="javascript:void(0)"> <b>地理位置</b> </a> </p>
    <div class="intro">
    	<? if($store['mappoint']) { ?>
    	<iframe margin="0" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/map.php?title=<?=$store['tname']?>&isshow=1&p=<?=$store['mappoint']?>&width=300&height=272" width="100%" height="382" frameborder="0"></iframe>
    	<?php } else { ?>
        尚未标注地理坐标
        <?php } ?>
    </div>
    </div>
</div>
<?php include qq3479015851_tpl('footer'); ?>
<script>(function(){window['myScroll2'].scrollTo(-130,0);})(jQuery);</script>
</body>
</html>