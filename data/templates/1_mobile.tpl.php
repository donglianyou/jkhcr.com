<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>手机版，让你拥有更方便的浏览体验！</title>
<link rel="shortcut icon" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/post.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/m.css" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
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
<div class="clear"></div>
<div class="wapcontent">
<div class="wap_left">
</div>
<div class="wap_right">
<div class="input_domain">
<div class="input_words">通过手机/平板电脑浏览器输入即可访问网站</div>
<div class="inputdomain"><?=$mobile_settings['mdomain']?></div>
<div class="input_image">
                <div id="gzh"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/erweima.gif" valign="absmiddle"><br />关注微信公众号</div>
                <div><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/qrcode.php?value=<?=$mobile_settings['mdomain']?>&size=5.3" valign="absmiddle"><br />手机扫描二维码访问</div>
                </div>
</div>
</div>
</div>
<div class="clear"></div><div class="footer">	&copy; <?=$SystemGlobalcfm_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$SystemGlobalcfm_global['SiteBeian']?></a> <?=$SystemGlobalcfm_global['SiteStat']?> <span class="none_<?=$SystemGlobalcfm_qq3479015851['debuginfo']?>"><? if($cachetime) { ?>This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } ?></span><span class="my_mps"><strong><a href="<?=SysGlbCfm_WWW?>" target="_blank"><?=SysGlbCfm_SOFTNAME?></a></strong> <em><a href="<?=SysGlbCfm_BBS?>" target="_blank"><?=SysGlbCfm_VERSION?></a></em></span></div></div>
<script type="text/javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/iflogin.js"></script>
</body>
</html>