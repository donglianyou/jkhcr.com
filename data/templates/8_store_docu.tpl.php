<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>机构动态 - 商家店铺 - <?=$SystemGlobalcfm_global['SiteName']?></title>
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
    <? if(!$docuid) { ?>
    	<p class="mbox_t" pagetitle="机构动态"> <a href="javascript:void(0)"> <b>机构动态</b> </a> </p>
        <ul class="infolst">
       <?php if(is_array($list)){foreach($list as $SystemGlobalcfm) { ?>        <li class="linkdetail" onclick="javascript:window.location.href='index.php?mod=store&id=<?=$store['id']?>&action=docu&docuid=<?=$SystemGlobalcfm['id']?>'" pageTitle="详情">
                <dd class="tit" style=""><?=$SystemGlobalcfm['title']?></dd>
                <dd class="tm"> <? echo GetTime($SystemGlobalcfm['pubtime'],'m-d'); ?></dd>
        </li>
       <?php }} else {{ ?>
        <li class="linkdetail">没有找到相关的机构动态！</li>
       <?php }} ?>
        </ul>
    <?php } else { ?>
    	<p class="mbox_t mbox_title" pagetitle="<?=$docu['title']?>"> <b><?=$docu['title']?></b> </p>
        <div class="p-pubtime">
        	<span class="p-hit">浏览人次：<?=$docu['hit']?>次</span> <span class="p-time">发布时间：<? echo GetTime($docu['pubtime'],'Y-m-d'); ?></span>
        </div>
        <div class="intro">
        <?=$docu['content']?>
        </div>
    <?php } ?>
    <? if($list) { ?>
<div class="pager">
    <?=$pageview?>
</div>
<?php } ?>
    </div>
    
</div>
<?php include qq3479015851_tpl('footer'); ?>
<script>(function(){window['myScroll2'].scrollTo(-130,0);})(jQuery);</script>
</body>
</html>