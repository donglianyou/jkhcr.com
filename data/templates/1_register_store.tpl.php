<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/login.css" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/validator.common.js"></script> 
<script type="text/javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/validator.js"></script> 
<script type="text/javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/sendsms<? echo $SystemGlobalcfm_imgcode == 1 ? '' : 2;; ?>.js"></script>
<title><?=$page_title?></title>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?> bodybg<?=$SystemGlobalcfm_global['cfg_tpl_dir']?><?=$SystemGlobalcfm_global['bodybg']?>"><div class="mheader">
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
<div class="step2">
<span>1. 选择注册类型<a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_member_logfile']?>?mod=register">（点此重选）</a></span>
<span class="cur">2. 注册机构会员</span>
<span>3. 登录会员中心</span>
</div>
<div class="regdetail">
<div class="partname">
<div class="li1"><a class="current">帐号注册</a></div>
</div>
                <div style="display:none;">
<iframe width=0 height=0 src='' id="iframe_area" name="iframe_area"></iframe> 
<iframe width=0 height=0 src='' id="iframe_street" name="iframe_street"></iframe> 
<form method="post" target="iframe_area" id="form_area"></form>
</div>
<form method="post" action="<?=$SystemGlobalcfm_global['cfg_member_logfile']?>" name="registerform" id="registerform">
<div class="partinput">
<input name="mod" value="register" type="hidden"/>
<input name="reg_corp" value="1" type="hidden"/>
<input name="mixcode" value="<?=$mixcode?>" type="hidden">
<table class="formlogin" cellpadding="0" cellspacing="0">
<? if($SystemGlobalcfm_global['cfg_member_verify'] == 4) { ?>
                    <tr>
<td class="tdright"><font color=red>*</font>手机：</td>
<td>
<input name="mobile" id="reg_mobile" type="text" class="input input-large" require="true" datatype="mobile|limit|ajax" url="<?=$SystemGlobalcfm_global['SiteUrl']?>/javascript.php?part=chk_remobile" min="4" max="20" msg="请输入您的手机号码">&nbsp;
</td>
</tr>
                    <?php } else { ?>
<tr>
<td class="tdright"><font color=red>*</font>用户名：</td>
<td>
<input name="userid" id="reg_username" type="text" class="input input-large" require="true" datatype="userName|limit|ajax" url="<?=$SystemGlobalcfm_global['SiteUrl']?>/javascript.php?part=chk_remember" min="4" max="20" msg="可输入字母、数字、下划线，不得少于4个字符">&nbsp;
</td>
</tr>
<tr>
<td class="tdright"><font color=red>*</font>电子邮箱：</td>
<td><input name="email" type="text" class="input input-large" require="true" datatype="email|limit|ajax" url="<?=$SystemGlobalcfm_global['SiteUrl']?>/javascript.php?part=chk_remail" id="email" msg="用于找回密码，邮箱格式不正确">
</td>
</tr>
                    <?php } ?>
<tr>
<td class="tdright"><font color=red>*</font>登录密码：</td>
<td>
<input id="reg_password" name="userpwd" type="password" class="input input-large" require="true" datatype="limitB" min="6" max="16" msg="密码不得少于6个字符或超过16个字符！" maxlength="16">
</td>
</tr>
<tr>
<td scope="row" class="tdright">&nbsp;</td>
<td>
<div id="pw_check_1" class="pw_check">
<span><strong class="c_orange">弱</strong></span>
<span>中</span>
<span>强</span>
</div>
<div id="pw_check_2" class="pw_check" style="display:none;">
<span>弱</span>
<span><strong class="c_orange">中</strong></span>
<span>强</span>
</div>
<div id="pw_check_3" class="pw_check" style="display:none;">
<span>弱</span>
<span>中</span>
<span><strong class="c_orange">强</strong></span>
</div>
</td>
</tr>
<tr>
<td class="tdright"><font color=red>*</font>确认密码：</td>
<td><input name="reuserpwd" type="password" to="userpwd" class="input input-large" msg="两次输入的密码不一致" id="pwdconfirm" require="true" datatype="repeat">
</td>
</tr>
</table>
</div>
<div class="clear"></div>
<div class="partname">
<div class="li1"><a class="current">机构资料</a></div>
</div>
<div class="partinput">
<table class="formlogin" cellpadding="0" cellspacing="0">
            <tr>
<td class="tdright"><font color=red>*</font>机构名称：</td>
<td><input type="text" name="tname" class="input input-large" require="true" datatype="limit" min="1" msg="机构名称不能为空！"/>
</td>
</tr>
            <tr>
<td class="tdright"><font color=red>*</font>所属区域：</td>
<td>
<?=$get_area_options?>
<span id="地区"></span>
</td>
</tr>
            <tr>
<td class="tdright"><font color=red>*</font>所属行业：</td>
<td class="catid"><?=$get_member_cat?></td>
</tr>
<tr>
<td class="tdright" valign="top"><font color=red>*</font>机构简介：</td>
<td><textarea name="introduce" style="width:260px; height:300px;"  require="true" datatype="limit" msg="请填写机构简介" class="input"></textarea>
</td>
</tr>
            <tr>
<td class="tdright"><font color=red>*</font>联系人：</td>
<td><input type="text" name="cname" class="input input-5" require="true" datatype="limit" min="1" msg="请输入您的姓名"/>
</td>
</tr>
            <tr>
<td class="tdright">QQ号码：</td>
<td><input type="text" name="qq" class="input input-large" require="qq" datatype="qq" msg="请填写正确的QQ号码"/>
</td>
</tr>
            <tr>
<td class="tdright"><font color=red>*</font>固定电话：</td>
<td><input type="text" name="tel" class="input input-large" require="true" datatype="limit" min="1" msg="请输入联系电话"/>
</td>
</tr>
            <tr>
<td class="tdright"><font color=red>*</font>联系地址：</td>
<td><input type="text" name="address" class="input input-large" require="true" datatype="limit" min="1" msg="请填写机构地址"/>
</td>
</tr>
            </tbody>
            <? if($SystemGlobalcfm_imgcode == 1) { ?>
            <tr>
            <td class="tdright"><font color=red>*</font>验证码：</td>
            <td><input type="text" name="checkcode" datatype="limit|ajax" require="true" class="input" id="checkcode" min="1" msgid="code" msg="请输入下方的图片验证码" url="<?=$SystemGlobalcfm_global['SiteUrl']?>/javascript.php?part=chk_authcode"> <span id="code"></span>
            </td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_authcodefile']?>" id="checkcode" align="absmiddle" title="看不清，请点击刷新" onClick="this.src=this.src+'?'" class="authcode"/></td>
            </tr>
<?php } ?>
            <? if($checkquestion) { ?>
<tr>
<td class="tdright"><font color=red>*</font>验证回答：</td>
<td><input name="checkquestion[answer]" id="checkanswer" msgid="wer" value="" type="text" class="input input-small" datatype="limit|ajax" require="true" msg="请填写验证答案" url="<?=$SystemGlobalcfm_global['SiteUrl']?>/javascript.php?part=chk_answer&id=<?=$checkquestion['id']?>"/>
<div class="qfont"><?=$checkquestion['question']?></div>
<input name="checkquestion[id]" type="hidden" value="<?=$checkquestion['id']?>"/>
<span id="wer"></span>
</td>
</tr>
<?php } ?>
            <? if($SystemGlobalcfm_global['cfg_member_verify'] == 4) { ?>
            <tr>
            <td class="tdright"><font color=red>*</font>手机验证码：</td>
            <td>
            <input type="text" name="smscheckcode" datatype="limit|ajax" require="true" class="input input-small" id="smscheckcode" min="1" msg="请输入收到的短信验证码，10分钟内输入有效" msgid="smscode" url="<?=$SystemGlobalcfm_global['SiteUrl']?>/javascript.php?part=chk_smsauthcode">
            <input type="button" name="sendmsg" value="点击获取手机验证码" onclick="sendmsgbutton();" id="sendmsg" class="disabled">
            <span id="smscode"></span>
            </td>
            </tr>
            <?php } ?>
            <tr>
<td class="tdright" style="height: 44px"></td>
<td style="height: 44px"><input type="submit" name="log_submit" value="同意协议，完成注册" onclick="return AllInputCheck();" id="agreereg" class="go_reg" />
</td>
</tr>
</table>
</div>
</form>
<div class="xiyi">
<div id="xieyi">
<div class="xieye_nr">
<p>欢迎光临<?=$SystemGlobalcfm_global['SiteName']?>！<?=$SystemGlobalcfm_global['SiteName']?>致力于为您提供最优质、最便捷的服务。在访问<?=$SystemGlobalcfm_global['SiteName']?>的同时，也请您仔细阅读我们的协议条款。您需要同意该条款才能注册成为我们的用户。一经注册，将视为接受并遵守该条款的所有约定。<br /></p>
<p>
1．用户应按照<?=$SystemGlobalcfm_global['SiteName']?>的注册、登陆程序和相应规则进行注册、登陆，注册信息应真实可靠，信息内容如有变动应及时更新。<br />
<br />
2．用户应在适当的栏目或地区发布信息，所发布信息内容必须真实可靠，不得违反<?=$SystemGlobalcfm_global['SiteName']?>对发布信息的禁止性规定。用户对其自行发表、上传或传送的内容负全部责任。<br />
<br />
3．遵守中华人民共和国相关法律法规，包括但不限于《中华人民共和国计算机信息系统安全保护条例》、《计算机软件保护条例》、《最高人民法院关于审理涉及计算机网络著作权纠纷案件适用法律若干问题的解释(法释[2004]1号)》、《互联网电子公告服务管理规定》、《互联网新闻信息服务管理规定》、《互联网著作权行政保护办法》和《信息网络传播权保护条例》等有关计算机互联网规定和知识产权的法律和法规、实施办法。<br />
<br />
4．所有用户不得在<?=$SystemGlobalcfm_global['SiteName']?>任何版块发布、转载、传送含有下列内容之一的信息，否则<?=$SystemGlobalcfm_global['SiteName']?>有权自行处理并不通知用户：<br />
(1)违反宪法确定的基本原则的； (2)危害国家安全，泄漏国家机密，颠覆国家政权，破坏国家统一的； (3)损害国家荣誉和利益的； (4)煽动民族仇恨、民族歧视，破坏民族团结的； (5)破坏国家宗教政策，宣扬邪教和封建迷信的；  (6)散布淫秽、色情、赌博、暴力、恐怖或者教唆犯罪的； (7)侮辱或者诽谤他人，侵害他人合法权益的；  (8)含有法律、行政法规禁止的其他内容的。<br />
</p>
</div>
</div>
 </div>
</div>

</div>
</div>
<div class="clear"></div><div class="footer">	&copy; <?=$SystemGlobalcfm_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$SystemGlobalcfm_global['SiteBeian']?></a> <?=$SystemGlobalcfm_global['SiteStat']?> <span class="none_<?=$SystemGlobalcfm_qq3479015851['debuginfo']?>"><? if($cachetime) { ?>This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } ?></span><span class="my_mps"><strong><a href="<?=SysGlbCfm_WWW?>" target="_blank"><?=SysGlbCfm_SOFTNAME?></a></strong> <em><a href="<?=SysGlbCfm_BBS?>" target="_blank"><?=SysGlbCfm_VERSION?></a></em></span></div></div>

</body>
</html>
<script language="javascript" type="text/javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/validator2.js"></script> 