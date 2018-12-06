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
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/login.css" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/global/noerr.js" type="text/javascript"></script>
<script language="javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/login.js"></script>
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
<div class="log">
<form name="formLogin" method="post" action="<?=$SystemGlobalcfm_global['cfg_member_logfile']?>" onSubmit="return submitForm();">
<input name="mod" type="hidden" value="login">
<input name="action" type="hidden" value="dopost">
<input name="url" type="hidden" value="<?=$url?>">
<table class="formlogin" cellpadding="0" cellspacing="0">
<tr>
<td class="tdright">帐号</td>
<td colspan="2">
<input name="userid" type="text" class="input input-large" placeholder="帐号/邮箱/手机"/></td>
</tr>
<tr>
<td class="tdright">密码</td>
<td colspan="2"><input name="userpwd" type="password" class="input input-large" placeholder="密码"/></td>
</tr>
            <? if($SystemGlobalcfm_imgcode == 1) { ?>
<tr>
<td class="tdright">验证码</td>
<td colspan="2"><input type="text" name="checkcode" class="input input-small" placeholder="验证码"></td>
</tr>
            <tr>
<td class="tdright">&nbsp;</td>
<td colspan="2"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_authcodefile']?>" alt="看不清，请点击刷新" class="authcode" align="absmiddle" onClick="this.src=this.src+'?'"/>			</td>
</tr>
<?php } ?>
<tr>
<td>&nbsp;</td>
<td class="font12">&nbsp;<label for="remember"><input id="remember" name="memory" value="on" type="checkbox" class="checkbox" checked="checked"/> 下次自动登录</label></td>
</tr>
<tr>
<td class="tdright"></td>
<td align="left" colspan="2">
<input type="submit" name="log_submit"  class="typebtn" value="立即登录"/>
<br>
<div class="forreg">
<a href="?mod=forgetpass&cityid=<?=$cityid?>" target="_blank">忘记密码？</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="?mod=register&cityid=<?=$cityid?>">免费注册</a>
</div>
</td>
</tr>
            <? if($qqlogin['open'] == 1 || $wxlogin['open'] == 1) { ?>
<tr>
<td class="tdright qqlogin" style="height:60px"></td>
<td colspan="2" class="qqlogin"><br />
您也可以通过以下方式登录：
            <? if($qqlogin['open'] == 1) { ?>
<br /><br />
<a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/include/qqlogin/qq_login.php"><img src="/include/qqlogin/qqlogin.gif" align="absmiddle"></a>
            <?php } ?>
            <? if($wxlogin['open'] == 1) { ?>
            <br /><br />
<a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/include/wxlogin/wx_login.php"><img src="/include/wxlogin/wxlogin.gif" align="absmiddle"></a>
            <?php } ?>
</td>
</tr>
<?php } ?>
</table>
</form>
</div>
<div class="reg">
<a href="/" target="_blank"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/images/login/mayicms.png" alt="中国健康养生网"></a>
</div>
</div>
<div class="clear"></div><div class="footer">	&copy; <?=$SystemGlobalcfm_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$SystemGlobalcfm_global['SiteBeian']?></a> <?=$SystemGlobalcfm_global['SiteStat']?> <span class="none_<?=$SystemGlobalcfm_qq3479015851['debuginfo']?>"><? if($cachetime) { ?>This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } ?></span><span class="my_mps"><strong><a href="<?=SysGlbCfm_WWW?>" target="_blank"><?=SysGlbCfm_SOFTNAME?></a></strong> <em><a href="<?=SysGlbCfm_BBS?>" target="_blank"><?=SysGlbCfm_VERSION?></a></em></span></div></div>

</body>
</html>