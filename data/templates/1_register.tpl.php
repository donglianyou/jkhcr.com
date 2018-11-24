<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/login.css" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/global/noerr.js" type="text/javascript"></script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>"><div class="mheader">
<div class="mhead">
<div class="logo"><a href="<?=$city['domain']?>" target="_blank"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm_global['SiteLogo']?>" title="<?=$SystemGlobalcfm_global['SiteName']?>"/></a></div>
<div class="tit" >
<span>hi，欢迎来到<?=$SystemGlobalcfm_global['SiteName']?><a href="<?=$city['domain']?>" target="_blank"><?=$city['cityname']?></a>站！<a href="<?=$SystemGlobalcfm_global['cfg_postfile']?>?cityid=<?=$cityid?>" style="color:#ff6600">发信息&raquo;</a></span>
    </div>
</div>
</div><div class="clearfix"></div>
<div class="inner">
<div class="body">
<div class="registerpart">
<div class="step1">
<span class="cur">1. 选择注册类型</span>
<span>2. 填写注册信息</span>
<span>3. 登录会员中心</span>
</div>
            <a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_member_logfile']?>?mod=register&action=person&cityid=<?=$city['cityid']?>">
<div class="selecter">
<div class="ico"><span class="ico2"></span></div>
<div class="des">
<div class="tit">注册个人会员 ></div>
</div>
</div>
</a>
             <a class="selecter" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_member_logfile']?>?mod=register&action=store&cityid=<?=$city['cityid']?>">
            <div>
<div class="ico"><span class="ico1"></span></div>
<div class="des">
<div class="tit">注册机构会员 ></div>
</div>
</div>
            </a>
</div>
</div>
    <div class="clear"></div>
    <center>已有账号？去<a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_member_logfile']?>?cityid=<?=$cityid?>" class="godl">登录</a></center>
<div class="clear"></div><div class="footer">	&copy; <?=$SystemGlobalcfm_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$SystemGlobalcfm_global['SiteBeian']?></a> <?=$SystemGlobalcfm_global['SiteStat']?> <span class="none_<?=$SystemGlobalcfm_qq3479015851['debuginfo']?>"><? if($cachetime) { ?>This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } ?></span><span class="my_mps"><strong><a href="<?=SysGlbCfm_WWW?>" target="_blank"><?=SysGlbCfm_SOFTNAME?></a></strong> <em><a href="<?=SysGlbCfm_BBS?>" target="_blank"><?=SysGlbCfm_VERSION?></a></em></span></div></div>

</body>
</html>