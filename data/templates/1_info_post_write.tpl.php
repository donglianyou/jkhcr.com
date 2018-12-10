<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/post.css" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<? if($post['upload_type']==2 || $post['action'] == 'add') { ?> 
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/qq3479015851/upload/jquery-1.10.2.min.js" type="text/javascript"></script>
<script language="javascript">
var BASE_URL = "<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/qq3479015851/upload";
</script>

<?php } else { ?>
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript">var current_domain = '<?=$SystemGlobalcfm_global['SiteUrl']?>';loadDefault(['a_ddimgview','validator.common','validator','post'])</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?> bodybg<?=$SystemGlobalcfm_global['cfg_tpl_dir']?><?=$SystemGlobalcfm_global['bodybg']?>"><script type="text/javascript">var current_domain="<?=$SystemGlobalcfm_global['SiteUrl']?>";var current_cityid="<?=$city['cityid']?>";var current_logfile="<?=$SystemGlobalcfm_global['cfg_member_logfile']?>";</script>
<div class="bartop">
<div class="barcenter">
<div class="barleft">
<!--<ul class="barcity"><span><? if($city['cityname']) { ?><?=$city['cityname']?><?php } else { ?>总站<?php } ?></span>[<a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/changecity.php">切换分站</a>]</ul> -->
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
<div class="cleafix"></div><? if($cat['if_mappoint'] == 1) { ?>
<script language="javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/global/messagebox.js"></script>
<?php } ?>
<div class="body1000">
<div class="clear15"></div>
<div class="wrapper" id="main">
<? if($post['action'] == 'edit') { ?>
<div class="step2">
<span><font class="number">1</font> 输入管理密码</span>
<span class="cur"><font class="number">2</font> 填写信息内容</span>
<span><font class="number">3</font> 完成信息修改</span>
</div>
<?php } else { ?>
<div class="step2">
<span><font class="number">1</font> 选择信息分类 <a onClick="if(!confirm('重选分类将清空您当前填写的数据，您确定要重选分类吗？'))return false;" href="?action=input&cityid=<?=$cityid?>">(重选)</a></span>
<span class="cur"><font class="number">2</font> 填写信息内容</span>
<span><font class="number">3</font> 发布成功</span>
</div>
<?php } ?>
<div id="fenlei2">
<div class='publish-detail'>
        <div style="display:none;">
            <iframe width=0 height=0 src='' id="iframe_area" name="iframe_area"></iframe> 
            <iframe width=0 height=0 src='' id="iframe_street" name="iframe_street"></iframe> 
            <form method="post" target="iframe_area" id="form_area"></form>
        </div>
        <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="<?=$SystemGlobalcfm_global['cfg_postfile']?>?action=<?=$post['action']?>">
        <input name="act" value="dopost" type="hidden">
        <input name="ismember" value="<?=$post['ismember']?>" type="hidden">
        <input name="catid" value="<?=$post['catid']?>" type="hidden">
        <input name="id" value="<?=$post['id']?>" type="hidden">
<input name="mixcode" value="<?=$post['mixcode']?>" type="hidden">
        <input type="hidden" id="lat" name="lat" value="">
        <input type="hidden" id="lng" name="lng" value="">
<div class="p-line">
<label class="p-label"><span class="red required">*</span>  所属分类：</label>
<div class="publish-detail-item">
<b><?=$cat['parentname']?></b> > <b><?=$cat['catname']?></b> &nbsp;&nbsp;<? if($post['action'] != 'edit') { ?><a onClick="if(!confirm('更改分类将清空您当前填写的数据，您确定要更改分类吗？'))return false;" href="?action=input">更改分类</a><?php } ?>
</div>
</div>
<? if($cat_option) { ?>
<div class="p-line">
<label class="p-label"><span class="red required">*</span>  下属分类：</label>
<div class="publish-detail-item">
<select name="catid" class="input" require="true" datatype="limit" msg="请选择下属分类" onChange="location.href='?cityid=<?=$cityid?>&catid='+(this.options[this.selectedIndex].value)">
<option value="">请选择所属分类</option>
                    <?php if(is_array($cat_option)){foreach($cat_option as $SystemGlobalcfm) { ?><option value="<?=$SystemGlobalcfm['catid']?>"><?=$SystemGlobalcfm['catname']?></option>
<?php }} ?>
</select>
</div>
</div>		
<?php } else { ?>
<input name="catid" value="<?=$post['catid']?>" type="hidden">
<?php } ?>
        <? if(!$cat_option) { ?>
<div class="clearfix"></div>
<div class="p-line">
<label class="p-label"><span class="red required">*</span>  有效期：</label>
<div class="publish-detail-item">
<?=$post['GetInfoLastTime']?>
</div>
</div>	

<div class="p-line">
<label class="p-label"><span class="red required">*</span>  信息标题：</label>
<div class="publish-detail-item">
<input type="text" maxlength="50" name="title" class="input input-60 errinput" value="<?=$post['title']?>" require="true" datatype="limit" msg="信息标题不能为空"/>
</div>
</div>
        
        <? if($cat['if_mappoint'] == 1) { ?>
<div class="p-line">
<label class="p-label">地理位置：</label>
<div class="publish-detail-item">
<input name="markmap" type="button" value="点击标注" class="mappoint" onclick="setbg('地图标注',500,410,'map_pub.php?action=markpoint&width=500&height=310&p=<?=$post['mappoint']?>&cityname=<?=$city['citypy']?>')">
<input id="mappoint" type="text" maxlength="25" name="mappoint" class="input input-small" value="<?=$post['mappoint']?>" /> 
</div>
</div>
<?php } ?>
        <?php if(is_array($post['qq3479015851_extra_value'])){foreach($post['qq3479015851_extra_value'] as $SystemGlobalcfm) { ?><div class="p-line">
<label class="p-label"><? if($SystemGlobalcfm['required'] == 1) { ?><span class="red required">*</span><?php } ?><?=$SystemGlobalcfm['title']?>：</label>
<div class="publish-detail-item">
<?=$SystemGlobalcfm['value']?> <span id="<?=$SystemGlobalcfm['title']?>"></span>
</div>
</div>
<?php }} ?>
        
<? if($post['upload_type']==1 || $post['action'] == 'edit') { ?> 
<? if($post['upload_img']) { ?>
<div class="p-line">
<label class="p-label">上传图片：</label>
<div class="publish-detail-item">
<?=$post['upload_img']?>
</div>
</div>
<?php } ?>
<?php } ?>	

<? if($post['upload_type']==2 || $post['action'] == 'add') { ?> 
<link rel="stylesheet" type="text/css" href="<?=$mymps_global['SiteUrl']?>/template/default/qq3479015851/upload/webuploader.css">
<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/qq3479015851/upload/webuploader.js"></script>
<input type="hidden" name="uploadNumLimit" id="uploadNumLimit" value="<?=$post['cfg_upimg_number']?>">
<div class="p-line">
<label class="p-label">上传图片：</label>
<div class="publish-detail-item">
<input type="hidden" name="totalPicNum" form="form1" value="0" id="totalPicNum">	
<div id="uploader-qq3479015851" class="wu-example">
<div id="fileList" class="uploader-list">
</div>
<div id="filePicker" class="webuploader-container">
<div class="webuploader-pick">选择图片(最多<?=$post['cfg_upimg_number']?>张)</div>
<div id="rt_rt_1bb1gqll5lns1bo31m52139sn2l4" style="position: absolute; top: 0px; left: 0px; width: 94px; height: 44px; overflow: hidden; bottom: auto; right: auto;">
<input type="file" name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/*">
<label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label>

</div>

</div>
</div>

</div>
</div>

<script type="text/javascript" src="<?=$mymps_global['SiteUrl']?>/template/default/qq3479015851/upload/qq3479015851.js"></script>

<?php } ?>	




<div class="p-line">
<label class="p-label"><span class="red required">*</span>  内容详情：</label>
<div class="publish-detail-item">
<span class="contentinner"><?=$acontent?></span><span id="content"></span>
</div>
</div>
        
        <div class="clear"></div>
<div class="contact">
            <div class="p-line">
                <label class="p-label"><span class="red required">*</span>  联系人：</label>
                <div class="publish-detail-item">
                    <input name="contact_who" type="text" class="input input-large" value="<?=$post['contact_who']?>" require="true" datatype="chinese" msg="请填写您的称呼，如刘女士"/>
                </div>
            </div>
            
            <div class="p-line">
                <label class="p-label"><span class="red required">*</span>  联系电话：</label>
                <div class="publish-detail-item">
                    <input name="tel" type="text" class="input input-large" value="<?=$post['mobile']?>" datatype="mobile" require="true" msg="请填写您的手机号码">
                </div>
            </div>
            
            <div class="p-line">
                <label class="p-label">  联系QQ：</label>
                <div class="publish-detail-item">
                    <input name="qq" type="text" class="input input-large" value="<?=$post['qq']?>" require="qq" datatype="qq" msg="请填写准确的QQ号，形式如123456"/>
                </div>
            </div>
            
            <!--<div class="p-line">
                <label class="p-label">电子邮箱：</label>
                <div class="publish-detail-item">
                    <input name="email" type="text" class="input input-large" value="<?=$post['email']?>" require="email" datatype="email" msg="请填写准确的电子邮箱帐号">
                </div>
            </div>-->
        </div>
        <? if($post['action'] == 'input' && $post['ismember'] != 1) { ?>
<div class="p-line">
<label class="p-label"><span class="red required">*</span>  管理密码：</label>
<div class="publish-detail-item">
<input name="manage_pwd" type="text" class="input input-small" value="" datatype="limit" require="true" msg="请牢记密码用于以后修改/删除此信息"> 
</div>
</div>
        <?php } elseif($post['action'] == 'edit' && $post['ismember'] != 1) { ?>
<div class="p-line">
<label class="p-label">  管理密码：</label>
<div class="publish-detail-item">
<input name="manage_pwd" type="text" class="input input-small" value=""> <font style="font-size:12px; line-height:32px;"> 若不修改密码，请留空</font>
</div>
</div>
<?php } ?>

        <? if($post['imgcode']) { ?>
<div class="p-line">
<label class="p-label"><span class="red required">*</span>  验证码：</label>
<div class="publish-detail-item">
<input name="checkcode" type="text" class="input input-small" value="" datatype="limit|ajax" require="true" msg="请填写图中的验证码" url="<?=$SystemGlobalcfm_global['SiteUrl']?>/javascript.php?part=chk_authcode" msgid="code">
<span id="code"></span>
</div>
</div>
        <div class="p-line">
<label class="p-label">&nbsp;</label>
<div class="publish-detail-item">
<img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_authcodefile']?>" title="看不清，请点击刷新" align="absmiddle" style="cursor:pointer;" onClick="this.src=this.src+'?'" class="authcode"/>
</div>
</div>
<?php } ?>

        <? if($checkquestion) { ?>
<div class="p-line">
<label class="p-label"><span class="red required">*</span>  验证问答：</label>
<div class="publish-detail-item">
<input name="checkquestion[answer]" value="" type="text" msgid="wer" class="input input-small" datatype="limit|ajax" require="true" msg="请填写验证问题的答案" url="<?=$SystemGlobalcfm_global['SiteUrl']?>/javascript.php?part=chk_answer&id=<?=$checkquestion['id']?>"/>
<div class="qfont"><?=$checkquestion['question']?></div>
<span id="wer"></span><input name="checkquestion[id]" type="hidden" value="<?=$checkquestion['id']?>"/> 
</div>
</div>
<?php } ?>
<p class='p-submit'>
<input type="submit" id="fabu" class="fabu1" onclick="postcheck()" value="确认提交" ct="submit"/>
</p>
<div class="clear"></div>
<div id='formsubmittips' class='small p-submit'>
信息填写越完整详细，越能提高排名增加可信度！<br />您的IP是：<span style="color:red"><?=$post['ip']?></span>，请不要发布虚假信息、重复信息
</div>
        <?php } ?>
</form>
</div>
</div>
</div>
<div class="clear"></div><div class="footer">	&copy; <?=$SystemGlobalcfm_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$SystemGlobalcfm_global['SiteBeian']?></a> <?=$SystemGlobalcfm_global['SiteStat']?> <span class="none_<?=$SystemGlobalcfm_qq3479015851['debuginfo']?>"><? if($cachetime) { ?>This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } ?></span><span class="my_mps"><strong><a href="<?=SysGlbCfm_WWW?>" target="_blank"><?=SysGlbCfm_SOFTNAME?></a></strong> <em><a href="<?=SysGlbCfm_BBS?>" target="_blank"><?=SysGlbCfm_VERSION?></a></em></span></div></div>
<script type="text/javascript">loadDefault(['iflogin','validator3'])</script>
</body>
</html>