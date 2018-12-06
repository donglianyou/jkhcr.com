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
<script type="text/javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/postlink.js"></script>
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
<div class="friendlink">
<div class="links">
        <?php if(is_array($flink)){foreach($flink as $k => $SystemGlobalcfm) { ?><div class="link">
<div class="tit"><?=$SystemGlobalcfm['typename']?></div>
<div class="clear"></div>
<div class="imgcont"><?php if(is_array($SystemGlobalcfm['imglink'])){foreach($SystemGlobalcfm['imglink'] as $w) { ?><a href="<?=$w['url']?>" target="_blank"><img alt="" src="<?=$w['weblogo']?>"></a>
<?php }} ?>
<div class="clearfix"></div>
</div>
<div class="cont"><?php if(is_array($SystemGlobalcfm['txtlink'])){foreach($SystemGlobalcfm['txtlink'] as $r) { ?><a href="<?=$r['url']?>"><?=$r['webname']?></a>
<?php }} ?>
</div>
</div>
<div class="clear"></div>
<?php }} ?>
<div class="link">
<div class="tit">申请步骤</div>
<div class="clear"></div>
<div class="contt">
1，请先在贵网站做好<?=$SystemGlobalcfm_global['SiteName']?>的友情链接：<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>链接文字：<?=$SystemGlobalcfm_global['SiteName']?></b> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>链接地址：<?=$SystemGlobalcfm_global['SiteUrl']?></b><br />
2，做好链接后，请在下方填写申请信息。 <br />
3，已经开通我站友情链接且内容健康，符合本站友情链接要求的网站，经管理员审核后，可以显示在此友情链接页面
</div> 
</div>
<div class="clear15"></div>
<div class="link">
<div class="tit">提交申请</div>
<div class="clear"></div>
<div class="contt">
<form name="form1" action="<?=$SystemGlobalcfm_global['SiteUrl']?>/about.php?" method="post" onSubmit="return submitForm();">
                    <input name="action" value="dopost" type="hidden">
                    <table cellpadding="0" cellspacing="0" class="link_table">
<tr>
<td>
网站类型：
</td>
<td style="height:34px;">
<select name="typeid"><? echo webtype_option(); ?></select>
</td>
</tr>
<tr>
<td>
网站名称：
</td>
<td style="height:34px;">
<input name="webname" type="text" style="width:350px"/></td>
</tr>
<tr>
<td>
网&nbsp;&nbsp;&nbsp;&nbsp;址：
</td>
<td style="height:34px;">
<input id="url" name="url" type="text" value="http://"  style="width:350px"/></td>
</tr>
 <tr>
<td>
图片地址：
</td>
   <td style="height:34px;">
<input id="weblogo" name="weblogo" type="text" value="http://"  style="width:350px"/></td>
</tr>
<tr>
<td height="35">
电子邮箱：
</td>
<td>
<input id="email" name="email" type="text"  style="width:350px"/></td>
</tr>
<tr>
<td width="61" valign="top">
网站介绍：
</td>
<td width="348" valign="top" style=" padding-bottom:5px; padding-top:5px;">
<textarea id="msg" name="msg" style="width:352px; height:100px;"></textarea></td>
</tr>
<tr>
<td height="35">
验证码：
</td>
<td style="height:34px;">
<input type="text" name="checkcode" class="text" style="width:70px"/> 
                            </td>
</tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_authcodefile']?>" alt="看不清，请点击刷新" class="authcode" align="absmiddle" onClick="this.src=this.src+'?'"/></td>
                        </tr>
<tr>
<td>&nbsp;

</td>
<td height="45" align="left" valign="middle">
<input type="submit" name="about_submit" class="submit" value="提交申请"/>
</td>
</tr>
</table>
</form>
</div>
</div>
</div>
</div>
<div class="clear"></div><div class="footer">	&copy; <?=$SystemGlobalcfm_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$SystemGlobalcfm_global['SiteBeian']?></a> <?=$SystemGlobalcfm_global['SiteStat']?> <span class="none_<?=$SystemGlobalcfm_qq3479015851['debuginfo']?>"><? if($cachetime) { ?>This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } ?></span><span class="my_mps"><strong><a href="<?=SysGlbCfm_WWW?>" target="_blank"><?=SysGlbCfm_SOFTNAME?></a></strong> <em><a href="<?=SysGlbCfm_BBS?>" target="_blank"><?=SysGlbCfm_VERSION?></a></em></span></div></body>
</html>