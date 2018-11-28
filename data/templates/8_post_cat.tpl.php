<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>发布信息 - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
<link type="text/css" rel="stylesheet" href="template/css/post.css">
<script>window['current'] = '发布信息';</script>
</head>
<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">
    
<?php include qq3479015851_tpl('header_search'); ?>
    <?php if(is_array($categories)){foreach($categories as $SystemGlobalcfm) { ?>    <dl class="business">
        <dt class="house"><i class="ico" style="background-image:url(<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm['icon']?>);"></i>发布<?=$SystemGlobalcfm['catname']?>信息</dt>
        <dd <? if($catid) { ?>style="display:block"<?php } ?>>
            <?php if(is_array($SystemGlobalcfm['children'])){foreach($SystemGlobalcfm['children'] as $c) { ?>            <a href="index.php?mod=post&catid=<?=$c['catid']?>&areaid=<?=$areaid?>"><?=$c['catname']?></a>
            <?php }} ?>
        </dd>
    </dl>
    <?php }} ?>
</div>
<script type="text/javascript">(function(){$('.business dt').bind('click',function(){var _this=$(this).parent();if(_this.hasClass('exp')){_this.removeClass('exp')}else{var scrollTop=document.body.scrollTop;_this.addClass('exp');window.scrollTo(0,scrollTop)}})}());</script>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>