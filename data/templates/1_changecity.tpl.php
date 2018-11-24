<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/uaredirect.js" type="text/javascript"></script>
<script type="text/javascript">uaredirect("<?=$SystemGlobalcfm_global['SiteUrl']?>/m/index.php?mod=changecity&cityid=<?=$cityid?>");</script>
<? if(CURSCRIPT == 'changecity') { ?>
<title>切换分站-<?=$SystemGlobalcfm_global['SiteName']?></title>
<?php } else { ?>
<title><?=$page_title?></title>
<meta name="keywords" content="<?=$SystemGlobalcfm_global['seo_keywords']?>"/>
<meta name="description" content="<?=$SystemGlobalcfm_global['seo_description']?>"/>
<?php } ?>
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/post.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/changecity.css" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/jquery.autocomplete.min.js"></script> 
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/jquery.autocomplete.css" /><?php $allcities = get_allcities(); ?><script type="text/javascript"> 
var cities = [<?php $i=1; ?><?php if(is_array($allcities)){foreach($allcities as $k => $SystemGlobalcfm) { if($i > 1) { ?>,<?php } ?>{ name1: "<?=$SystemGlobalcfm['citypy']?>",name: "<?=$SystemGlobalcfm['directory']?>", to: "<?=$SystemGlobalcfm['cityname']?>" }<?php $i=$i+1; ?><?php }} ?>
]; 
$(function() {
$('#cityname').autocomplete(cities, { 
max: 20,
minChars: 0,
width: 166,
scrollHeight: 300,
matchContains: true,
autoFill: false,
formatItem: function(row, i, max) { 
return row.to; 
}, 
formatMatch: function(row, i, max) { 
return row.name1 + row.name + row.to; 
}, 
formatResult: function(row) { 
return row.to; 
} 
}); 
}); 
</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?> bodybg<?=$SystemGlobalcfm_global['cfg_tpl_dir']?><?=$SystemGlobalcfm_global['bodybg']?>"><script type="text/javascript">var current_domain="<?=$SystemGlobalcfm_global['SiteUrl']?>";var current_cityid="<?=$city['cityid']?>";var current_logfile="<?=$SystemGlobalcfm_global['cfg_member_logfile']?>";</script>
<div class="bartop">
<div class="barcenter">
<div class="barleft">
<ul class="barcity"><span><? if($city['cityname']) { ?><?=$city['cityname']?><?php } else { ?>总站<?php } ?></span>[<a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/changecity.php">切换分站</a>]</ul> 
<ul class="line"><u></u></ul>
            <ul class="barcang"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/desktop.php" target="_blank" title="点击右键，选择“目标另存为”，将此快捷方式保存到桌面即可">保存到桌面</a></ul>
<ul class="line"><u></u></ul>
<ul class="barpost"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_postfile']?>?cityid=<?=$cityid?>">快速发布信息</a></ul>
<ul class="line"><u></u></ul>
<ul class="bardel"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/delinfo.php?cityid=<?=$cityid?>" rel="nofollow">修改/删除信息</a></ul>
<ul class="line"><u></u></ul>
<ul class="barwap"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/mobile.php?cityid=<?=$cityid?>">手机浏览</a></ul>
</div>
<div class="barright" id="iflogin"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/images/loading.gif" border="0" align="absmiddle"></div>
</div>
</div>
<div class="clearfix"></div>
<div class="mhead">
<div class="logo"><a href="<? echo $city['domain']?$city['domain']:$SystemGlobalcfm_global['SiteUrl']; ?>" target="_blank"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm_global['SiteLogo']?>" title="<?=$SystemGlobalcfm_global['SiteName']?>"/></a></div>
<div class="font">
<span>
        <? if(CURSCRIPT == 'posthistory') { ?>发帖记录<?php } elseif(CURSCRIPT == 'space') { ?>用户中心<?php } elseif(CURSCRIPT == 'mobile') { ?>手机版<?php } elseif(CURSCRIPT == 'login') { ?>帐号升级<?php } elseif(CURSCRIPT == 'delinfo') { ?>修改/删除信息<?php } elseif(CURSCRIPT == 'post') { ?>发布信息<?php } else { ?>切换分站<?php } ?>
</span>
</div>
</div>
<div class="cleafix"></div><div class="body1000">
<div class="clear15"></div>
<div id="main" class="wrapper">
<div class="changecitydiv">
<div class="vhd">
            	<div class="vhd_l">
                <?php if(!$fromcity && $cityid=mgetcookie('cityid')) $fromcity = get_city_caches($cityid); if($fromcity) { ?><a href="<?=$fromcity['domain']?>" class="msubmit">进入<?=$SystemGlobalcfm_global['SiteName']?><b><?=$fromcity['cityname']?>站</b> &raquo;</a><b style="margin-left:20px;">或</b> <?php } ?>
                </div>
                <div class="vhd_r">
                <form id="changcityForm" action="<?=$SystemGlobalcfm_global['SiteUrl']?>/changecity.php?" method="post">
<b>输入分站名</b>
                <input type="text" placeholder="直接输入分站名" class="focus2" onBlur="this.className='focus2'" onFocus="this.className='focus1'" id="cityname" name="cityname" value=""/>
<input type="submit" value="进入分站" class="vsubmit"/>
</form>
                
</div>
</div>
<div class="clear15"></div>
            <div class="clear"></div>
            <? if($SystemGlobalcfm_global['cfg_cityshowtype'] == 'pinyin') { ?>
<div id="blist">
                热门分站：
                <?php $hotcities = get_hot_cities(); ?>                <?php $hotcities = $gloal_city ? $gloal_city : get_hot_cities(); ?>                <?php if(is_array($hotcities)){foreach($hotcities as $SystemGlobalcfm) { ?>                    <a href="<?=$SystemGlobalcfm['domain']?>"><?=$SystemGlobalcfm['cityname']?></a>
                <?php }} ?>
            </div>
            <?php } ?>
            <div class="clearfix"></div>
            
<dl id="clist" class="<?=$SystemGlobalcfm_global['cfg_cityshowtype']?>">
            <?php $cities = $SystemGlobalcfm_global['cfg_cityshowtype'] == 'province' ? get_changeprovince_cities() : get_changecity_cities(); ?>            <?php if(is_array($cities)){foreach($cities as $k => $citie) { ?>                <a name="alphabet-<?=$k?>"></a>
<div class="lister">
<dt><?=$k?></dt>
<dd>
                <?php if(is_array($citie)){foreach($citie as $u => $w) { ?><a href="<?=$w['domain']?>" <? if($w['ifhot'] == 1) { ?>class="fontred"<?php } ?>><?=$w['cityname']?></a>
<?php }} ?>
</dd>
</div>
<div class="clearfix"></div>
<?php }} ?>
</dl>
</div>
</div>
<div class="clear"></div>
    <div class="smp_box">
    <div class="smp_box_title">整站信息速递</div>
    <ul>
        <?php $ninfo = qq3479015851_get_infos(12); ?>        <?php if(is_array($ninfo)){foreach($ninfo as $SystemGlobalcfm) { ?>        <li><a title="<?=$SystemGlobalcfm['title']?>" href='<?=$SystemGlobalcfm['uri']?>'  style='' target=_blank><? echo cutstr($SystemGlobalcfm['title'],21); ?></a> [<em><? echo get_format_time($SystemGlobalcfm['begintime']);; ?></em>]</li>
        <?php }} ?>
    </ul>
    </div><div class="footer">	&copy; <?=$SystemGlobalcfm_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$SystemGlobalcfm_global['SiteBeian']?></a> <?=$SystemGlobalcfm_global['SiteStat']?> <span class="none_<?=$SystemGlobalcfm_qq3479015851['debuginfo']?>"><? if($cachetime) { ?>This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } ?></span><span class="my_mps"><strong><a href="<?=SysGlbCfm_WWW?>" target="_blank"><?=SysGlbCfm_SOFTNAME?></a></strong> <em><a href="<?=SysGlbCfm_BBS?>" target="_blank"><?=SysGlbCfm_VERSION?></a></em></span></div></div>
</body>
</html>
<p id="back-to-top"><a href="#top"><span></span></a></p>
<script type="text/javascript">loadDefault(["iflogin","scrolltop"]);</script>