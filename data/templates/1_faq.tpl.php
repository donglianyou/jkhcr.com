<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/aboutus.css" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/global/noerr.js" type="text/javascript"></script>
<title><?=$page_title?></title>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?> full"><script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<div class="header">
<div class="inner">
<div class="logo"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>" target="_blank"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm_global['SiteLogo']?>" title="<?=$SystemGlobalcfm_global['SiteName']?>"></a></div>
<div class="nav">
<a href="<?=$about['aboutus_uri']?>" <? if($part == 'aboutus') { ?>class="current"<?php } ?>>关于我们</a>
<a href="<?=$about['announce_uri']?>" <? if($part == 'announce') { ?>class="current"<?php } ?>>网站公告</a>
<a href="<?=$about['faq_uri']?>" <? if($part == 'faq') { ?>class="current"<?php } ?>>帮助中心</a>
<a href="<?=$about['friendlink_uri']?>" <? if($part == 'friendlink') { ?>class="current"<?php } ?>>友情链接</a>
<a href="<?=$about['sitemap_uri']?>" <? if($part == 'sitemap') { ?>class="current"<?php } ?>>网站地图</a>
</div>
</div>
</div><div class="clear"></div>
<div class="faq">
    <?php $i=1; ?>        <?php if(is_array($faq_type)){foreach($faq_type as $SystemGlobalcfm) { ?><dl class="qlist cfix">
<dt><i class="b-<?=$i?>"></i><?=$SystemGlobalcfm['typename']?></dt>
<dd class="cfix">
        <?php if(is_array($SystemGlobalcfm['faq'])){foreach($SystemGlobalcfm['faq'] as $w) { ?>        <a class="<? if($w['id'] == $faq['id']) { ?>current<?php } ?>" href="<?=$w['uri']?>" title="<?=$w['title']?>"><? echo cutstr($w['title'],20); ?></a>
        <?php }} ?>
</dd>
</dl><?php $i++; ?>        <?php }} ?>
<div class="clear"></div>
<div class="faqcontent">
<h1><?=$faq['title']?></h1>
<p>
<?=$faq['content']?>
</p>
</div>
</div>
<div class="clear"></div><div class="footer">	&copy; <?=$SystemGlobalcfm_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$SystemGlobalcfm_global['SiteBeian']?></a> <?=$SystemGlobalcfm_global['SiteStat']?> <span class="none_<?=$SystemGlobalcfm_qq3479015851['debuginfo']?>"><? if($cachetime) { ?>This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } ?></span><span class="my_mps"><strong><a href="<?=SysGlbCfm_WWW?>" target="_blank"><?=SysGlbCfm_SOFTNAME?></a></strong> <em><a href="<?=SysGlbCfm_BBS?>" target="_blank"><?=SysGlbCfm_VERSION?></a></em></span></div></body>
</html>